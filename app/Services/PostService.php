<?php

namespace App\Services;

use App\Http\Resources\Post\PostItemResource;
use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
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
}
