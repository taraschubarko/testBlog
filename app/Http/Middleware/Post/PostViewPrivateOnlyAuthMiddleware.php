<?php

namespace App\Http\Middleware\Post;

use Closure;
use Illuminate\Http\Request;

class PostViewPrivateOnlyAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $post = $request->route()->parameter('post');

        switch ($post->type) {
            case 'private':
                if (!auth()->check()) {
                    abort(403);
                } else {
                    return $next($request);
                }
                break;
            case 'public':
                return $next($request);
                break;
        }
    }
}
