<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminPostEditResource;
use App\Http\Resources\Admin\AdminPostsListResource;
use App\Models\Post;
use App\Models\PostNote;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $posts = Post::query()->orderByDesc('created_at')->paginate();
        $posts = $posts ? AdminPostsListResource::collection($posts) : null;
        return inertia('Admin/PageAdminPosts', [
            'items' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return inertia('Admin/PageAdminPostCreate', [
            'config' => config('posts')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @return
     */
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
        if ($this->postService->uploadImages($data['image_files'], $post)) {
            return redirect(route('dashboard.posts.index'));
        }
        abort(500, 'Post create Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return
     */
    public function edit(Post $post)
    {
        return inertia('Admin/PageAdminEditPost', [
            'item' => AdminPostEditResource::make($post),
            'config' => config('posts'),
            'gallery' => $post->images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'type' => 'required|string',
            'status' => 'sometimes|string',
            'image_files' => 'sometimes',
            'note.text' => 'sometimes',
        ]);
        $post->update($data);
        if ($data['image_files']) {
            $this->postService->uploadImages($data['image_files'], $post);
        }
        if ($data['note']['text']) {
            $post->note()->updateOrCreate([
                'text' => $data['note']['text']
            ]);
        }
        return redirect(route('dashboard.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
