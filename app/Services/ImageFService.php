<?php

namespace App\Services;

use App\Models\ImageF;
use App\Services\Contracts\ImageFServiceInterface;
use Illuminate\Support\Facades\Storage;

class ImageFService implements ImageFServiceInterface
{
    public function delete(ImageF $image): bool
    {
        try {
            Storage::disk('public')->delete($image->path);
            if($image->delete()){
                return true;
            }
            return  false;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
