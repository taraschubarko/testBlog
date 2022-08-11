<?php

namespace App\Http\Controllers;

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

}
