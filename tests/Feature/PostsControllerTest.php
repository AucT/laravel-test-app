<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->get(route('posts.index'));
        $response->assertOk();
    }

    public function test_index_not_auth()
    {
        $response = $this->get(route('posts.index'));
        $response->assertStatus(302);
    }

    public function test_index_not_user()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);


        $response = $this->get(route('posts.index'));
        $response->assertStatus(302);
    }

}
