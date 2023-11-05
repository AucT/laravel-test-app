<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class ImageService
{
    const AVATARS_FOLDER = 'avatars';
    const POSTS_FOLDER = 'posts';




    public function updateAvatar(User $user, UploadedFile $file): User
    {
        $filePath = $file->store(self::AVATARS_FOLDER, 'public');

        (new ImageManager())
            ->make(storage_path('app/public/' . $filePath))
            ->resize(128, 128)
            ->save();


        $this->deleteAvatar($user->avatar);

        $user->avatar = str_replace(self::AVATARS_FOLDER .'/', '', $filePath);
        $user->save();

        return $user;
    }

    public function deleteAvatar(?string $avatar): void
    {
        $this->deleteImage(self::AVATARS_FOLDER . '/' . $avatar);
    }

    public function deleteImage(?string $image): void
    {
        if (!$image) {
            return;
        }
        Storage::delete("public/$image");
    }

    public function uploadFile(string $url, string $folder): string
    {
        $filePath = "$folder/" . uniqid() . '.jpg';
        $fullPath = storage_path("app/public/$filePath");
        $this->downloadFile($url, $fullPath);
        return $filePath;
    }

    public function downloadFile(string $url, string $path)
    {
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $ch = curl_init($url);
        $fp = fopen($path, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }


}
