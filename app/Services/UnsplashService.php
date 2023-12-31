<?php


namespace App\Services;


class UnsplashService

{
    const RANDOM_IMAGE_URL = 'https://source.unsplash.com/random/1000x500';


    public function getRandomImage(): string
    {
        return $this->getFinalRedirectedUrl(self::RANDOM_IMAGE_URL);
    }

    public function getFinalRedirectedUrl($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);

        curl_exec($ch);

        // Get the final redirected URL
        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);

        return $finalUrl;
    }
}
