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

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

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
}
