<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageF>
 */
class ImageFFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $path = storage_path('app/public/images');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $im = 'https://source.unsplash.com/random/600x600?sig=' . fake()->numberBetween(1, 20);
        $filename = Str::random(10). '.png';
        Image::make($im)->save(storage_path('app/public/images/' . $filename));

        return [
            'path' => 'images/' . $filename,
        ];
    }
}
