<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPostsController extends Controller
{
    //
    public function index(Request $request)
    {
        return inertia('User/PageUserPosts', [
            'items' => $request->user()->posts()->paginate()
        ]);
    }
}
