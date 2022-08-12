<?php

namespace App\Services;

use App\Http\Resources\Post\PostItemResource;
use App\Models\ImageF;
use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService implements PostServiceInterface
{
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
            $path = storage_path('app/public/images');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            foreach ($images as $image){
                $file = Storage::disk('public')->put('images', new \Illuminate\Http\File($image));
                $i = pathinfo($file);
                $post->image()->save(new ImageF([
                    'path' => 'images/'.$i['basename']
                ]));
            }
            return  true;
        } catch (\Exception $exception) {
            logger($exception);
            abort(500, $exception->getMessage());
        }
    }
}
