<?php

namespace Tests\Feature;

use App\Models\Job;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUserCanMakeAJobFavorite()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/favorites', [
            "job_id" => $job->id
        ]);
        $response->assertJson(["status" => "success","message" => "Job added to favorite list."]);
        $response->assertStatus(201);
    }

    public function testUserCanSeeAJobIsFavorite()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/favorites', [
            "job_id" => $job->id
        ]);
        $response = $this->actingAs($user)->get('/api/jobs');
        $contents = $response->decodeResponseJson();
        $isFavorite = $contents[0]['favorites'];
        $this->assertEquals(true, $isFavorite);
        $response->assertStatus(200);
    }

    public function testUserCanRemoveAFavoriteJob()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $response = $this->actingAs($user)->post('/api/favorites', [
            "job_id" => $job->id
        ]);
        $response = $this->actingAs($user)->delete('/api/favorites/' . $job->id);
        $response->assertJson([
            "status" => "success",
            "message" => "Job removed from favorite list."
        ]);
        $response->assertStatus(201);
    }
}
