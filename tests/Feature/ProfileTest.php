<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ImageService;
use App\Services\ProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use function PHPUnit\Framework\assertEquals;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_profile_avatar_can_be_updated(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/profile/avatar', [
                'avatar' =>  UploadedFile::fake()->image('avatar.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertNotNull($user->avatar);
        assertEquals(true, Storage::fileExists('public/' .ImageService::AVATARS_FOLDER .'/' . $user->avatar));


        //Second time
        $oldAvatar = $user->avatar;
        $response = $this
            ->actingAs($user)
            ->post('/profile/avatar', [
                'avatar' =>  UploadedFile::fake()->image('avatar2.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertNotNull($user->avatar);
        assertEquals(true, Storage::fileExists('public/' .ImageService::AVATARS_FOLDER .'/' . $user->avatar));
        assertEquals(false, Storage::fileExists('public/' .ImageService::AVATARS_FOLDER .'/' . $oldAvatar));

    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
