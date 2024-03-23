<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchKeyword = request()->input('s');
        $jobs = collect();
        if(!empty($searchKeyword)){// search logic
            $jobs = Job::where('title', 'LIKE', "%$searchKeyword%")->limit(10)->get();
        }else{
            $jobs = Job::with(['favorites' => function($query){
                $user = request()->user('sanctum');
                $query->where('user_id', $user?->id);
            }, 'location:id,name', 'jobType:id,name', 'category:id,name', 'company:id,name,description', 'recruiter:id,name'])->paginate(20);
        }


        $jobResourceCollection = JobResource::collection($jobs);

        return response()->json($jobResourceCollection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($jobId)
    {
        $job = Job::with(['favorites' => function($query){
            $user = request()->user('sanctum');
            $query->where('user_id', $user?->id);
        }, 'location:id,name', 'jobType:id,name', 'category:id,name', 'company:id,name,description', 'recruiter:id,name'])->find($jobId);

        return response()->json(new JobResource($job));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }

    /**
     * List of user's favorite jobs
     */
    public function favoriteJobs()
    {
        $userFavorites = auth()->user()->favorites;
        foreach($userFavorites as $job){
            $job->favorites = [$job->id];
        }
        $userFavoritesResource = JobResource::collection($userFavorites);

        return response()->json($userFavoritesResource);
    }

    /**
     * Store a job in user's favorite list
     */
    public function favorite(Job $job)
    {
        if(! $job){
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found.'
            ], 404);
        }

        // check if the user has already chosen this job as favorite
        foreach(auth()->user()->favorites()->get() as $favorite){
            if($favorite->id === $job->id){
                return response()->json([
                    'status' => 'error',
                    'message' => 'This job is already in your favorite list.'
                ], 400);
            }
        }

        // attach the job to user's favorite list
        auth()->user()->favorites()->attach($job->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Job added to favorite list.'
        ], 201);
    }

    /**
     * Remove a job from user's favorite list
     */
    public function unfavorite(Job $job)
    {
        if(empty($job)){
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found.'
            ], 404);
        }

        // detach the job from user's favorite list
        $detached = auth()->user()->favorites()->detach($job->id);

        if(empty($detached)){
            return response()->json([
                'status' => 'failed',
                'message' => 'Job was not in your favorite list.'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Job removed from favorite list.'
        ], 201);
    }
}
