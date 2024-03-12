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
}
