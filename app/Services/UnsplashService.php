<?php


namespace App\Services;


class UnsplashService

{
    const RANDOM_IMAGE_URL = 'https://source.unsplash.com/random/1000x500';
    private ImageService $imageService;

    /**
     * UnsplashService constructor.
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    public function saveRandomImage(): string
    {
        return $this->imageService->uploadFile(
            self::RANDOM_IMAGE_URL,
            ImageService::POSTS_FOLDER
        );
    }


    public function downloadRandomImageFromUnsplash(): string
    {
        $image = file_get_contents(self::RANDOM_IMAGE_URL);
        $imageName = uniqid() . '.jpg';
        $fullPath = storage_path("app/public/" . ImageService::POSTS_FOLDER . "/" . $imageName);
        file_put_contents($fullPath, $image);
        return ImageService::POSTS_FOLDER . "/" . $imageName;
    }
}
