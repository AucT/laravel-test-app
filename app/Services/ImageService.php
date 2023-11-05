<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class ImageService
{
    const AVATARS_FOLDER = 'avatars';

    public function updateAvatar(User $user, UploadedFile $file): User
    {
        $filePath = $file->store(self::AVATARS_FOLDER, 'public');

        (new ImageManager())
            ->make(storage_path('app/public/' . $filePath))
            ->resize(128, 128)
            ->save();


        if ($user->avatar) {
            Storage::delete('public/' .self::AVATARS_FOLDER .'/' . $user->avatar);
        }

        $user->avatar = str_replace(self::AVATARS_FOLDER .'/', '', $filePath);
        $user->save();

        return $user;
    }
}
