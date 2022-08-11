<?php

namespace App\Services;

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

            if($items){
                $items->getCollection()->transform(function ($value) {
                    return [
                        'id' => $value->id,
                        'name' => $value->name,
                        'text' => Str::limit($value->text, 150, '...'),
                        'created_at' => $value->created_at->format('d.m.Y'),
                        'slug' => $value->slug,
                        'type' => $value->type,
                        'user' => $value->user->only(['id', 'name', 'gender', 'slug']),
                        'image' => $value->image->only(['path']),
                    ];
                });
            }


            return $items;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
