<?php

namespace App\Services\Contracts;

use App\Models\Post;

interface PostServiceInterface
{
    //Список блогу на головній
    public function listOnMain(): object;
    //Завантаження картинок постів
    public function uploadImages(array $images, Post $post): bool;
}
