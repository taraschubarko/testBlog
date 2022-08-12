<?php

namespace App\Observers;

use App\Facades\ImageFFacade;
use App\Models\Post;

class PostObserver
{
    public function deleted(Post $post)
    {
        if($post->images()->count()){
            $post->images()->each(function ($image){
                ImageFFacade::delete($image);
            });
        }
    }
}
