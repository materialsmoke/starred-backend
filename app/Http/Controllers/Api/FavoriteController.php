<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Resources\JobResource;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userFavorites = auth()->user()->favorites;
        foreach($userFavorites as $job){
            $job->favorites = [$job->id];
        }
        $userFavoritesResource = JobResource::collection($userFavorites);

        return response()->json($userFavoritesResource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        $jobId = request()->get('job_id');
        $job = Job::find($jobId);
        
        if(! $job){
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found.'
            ], 404);
        }

        auth()->user()->favorites()->attach($job->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Job added to favorite list.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jobId)
    {
        $job = Job::find($jobId);
        if(empty($job)){
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found.'
            ], 404);
        }
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
