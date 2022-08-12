<?php

namespace App\Services;

use App\Models\ImageF;
use App\Services\Contracts\ImageFServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageFService implements ImageFServiceInterface
{

    public function upload($path, $image): array
    {
        try {
            $dir = storage_path('app/public/' . $path);
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0777, true, true);
            }
            $file = Storage::disk('public')->put($path, new \Illuminate\Http\File($image));
            return pathinfo($file);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function delete(ImageF $image): bool
    {
        try {
            Storage::disk('public')->delete($image->path);
            if ($image->delete()) {
                return true;
            }
            return false;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
