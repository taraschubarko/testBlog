<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostEditResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return inertia('Public/PageIndex', [
            'items' => $this->postService->listOnMain()
        ]);
    }

    public function show(Post $post)
    {
        return inertia('Public/PagePost', [
            'item' => PostResource::make($post)
        ]);
    }

    public function create()
    {
        $postConfig = config('posts');
        return inertia('Post/PagePostCreate', [
            'type' => $postConfig['type']
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'type' => 'required|string',
            'image_files' => 'required',
        ]);
        $data['status'] = 'crated';
        $data['user_id'] = auth()->id();
        $post = Post::query()->create($data);
        if($this->postService->uploadImages($data['image_files'], $post)){
            return redirect(route('my.posts'));
        }
        abort(500, 'Post create Error');
    }

    public function edit(Post $post)
    {
        $postConfig = config('posts');
        return inertia('Post/PagePostEdit', [
            'form' => PostEditResource::make($post),
            'gallery' => $post->images,
            'type' => $postConfig['type']
        ]);
    }

}
