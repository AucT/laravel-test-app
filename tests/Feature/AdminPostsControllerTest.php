<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPostsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get(route('admin.posts.index'));
        $response->assertOk();
    }

    public function test_create()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get(route('admin.posts.create'));
        $response->assertOk();
    }

    public function test_store()
    {
        $postData = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];

        $this->actingAs(User::factory()->create(['is_admin' => true]));
        $response = $this->post(route('admin.posts.store'), $postData);
        $response->assertStatus(302);

        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_store_not_authed()
    {
        $postData = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];

        $response = $this->post(route('admin.posts.store'), $postData);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('posts', $postData);
    }

    public function test_store_user()
    {
        $postData = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];
        $this->actingAs(User::factory()->create(['is_admin' => false]));
        $response = $this->post(route('admin.posts.store'), $postData);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('posts', $postData);
    }

    public function test_edit()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('admin.posts.edit', $post));
        $response->assertOk();
    }


    public function test_update()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);
        $post = Post::factory()->create(['user_id' => $user->id]);


        $postData = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];

        $response = $this->patch(route('admin.posts.update', $post), $postData);
        $response->assertRedirect();
        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_image_update()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);
        $post = Post::factory()->create(['user_id' => $user->id]);

        $oldImage = $post->image;

        $response = $this->post(route('admin.posts.image.update', $post));
        $response->assertOk();

        $post->refresh();

        self::assertFalse($oldImage == $post->image);
        self::assertNotNull($post->image);
    }

    public function test_destroy()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('admin.posts.delete', $post));
        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
