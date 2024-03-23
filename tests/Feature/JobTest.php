<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    public function testIfVisitorCanSeeJobs()
    {
        $user = User::factory()->create();
        $jobs = Job::factory(10)->create();
        $response = $this->actingAs($user)->get('/api/jobs');
        $response->assertStatus(200);
    }

    public function testIfVisitorCanSeeAJob()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->get('/api/jobs/' . $job->id);
        $response->assertStatus(200);
    }

    public function testUserCanMakeAJobFavorite()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response->assertJson(["status" => "success","message" => "Job added to favorite list."]);
        $response->assertStatus(201);
    }

    public function testUserCanNotMakeAJobFavoriteTwice()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response->assertStatus(201);
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response->assertStatus(400);
    }

    public function testUserCanSeeAJobIfItIsFavorite()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response = $this->actingAs($user)->get('/api/jobs');
        $contents = $response->decodeResponseJson();
        $isFavorite = $contents[0]['is_favorite'];
        $this->assertEquals(true, $isFavorite);
        $response->assertStatus(200);
    }

    public function testUserCanRemoveAFavoriteJob()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response = $this->actingAs($user)->delete('/api/jobs/' . $job->id . '/unfavorite');
        $response->assertJson([
            "status" => "success",
            "message" => "Job removed from favorite list."
        ]);
        $response->assertStatus(201);
    }

    public function testUserCanNotRemoveAFavoriteJobTwice()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/jobs/' . $job->id . '/favorite');
        $response = $this->actingAs($user)->delete('/api/jobs/' . $job->id . '/unfavorite');
        $response = $this->actingAs($user)->delete('/api/jobs/' . $job->id . '/unfavorite');
        $response->assertStatus(400);
    }
}
