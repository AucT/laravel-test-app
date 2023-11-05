<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string image
 * @property mixed title
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected static function booted(): void
    {
        static::deleted(function (Post $post) {
            $imageService = new ImageService();
            $imageService->deleteImage($post->image);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
