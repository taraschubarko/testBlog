<?php

namespace App\Services\Contracts;

use App\Models\ImageF;

interface ImageFServiceInterface
{
    public function delete(ImageF $image): bool;
}
