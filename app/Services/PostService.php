<?php

namespace App\Services;

use App\Http\Resources\Post\PostItemResource;
use App\Models\ImageF;
use App\Models\Post;
use App\Services\Contracts\ImageFServiceInterface;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService implements PostServiceInterface
{
    public $imageFService;

    public function __construct(ImageFServiceInterface $imageFService)
    {
        $this->imageFService = $imageFService;
    }

    public function listOnMain(): object
    {
        try {
            $q = Post::query();
            $q->with(['image', 'user']);
            $types = auth()->check() ? array_flip(config('posts.type')) : ['public'];
            $q->whereIn('type', $types);
            $q->where('status', 'published');
            $q->orderByDesc('created_at');
            $items = $q->paginate();

            return PostItemResource::collection($items);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function uploadImages(array $images, Post $post): bool
    {
        try {
            $path = 'images';
            foreach ($images as $image) {
                $i = $this->imageFService->upload($path, $image);
                $post->image()->save(new ImageF([
                    'path' => $path . '/' . $i['basename']
                ]));
            }
            return true;
        } catch (\Exception $exception) {
            logger($exception);
            abort(500, $exception->getMessage());
        }
    }
}
