<?php

namespace App\Services\Contracts;

use App\Models\ImageF;

interface ImageFServiceInterface
{
    //завантаження файлу зображення
    public function upload($path, $image): array;
    //Видалення файлу зображення
    public function delete(ImageF $image): bool;
}
