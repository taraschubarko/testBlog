<?php

namespace Database\Seeders;

use App\Models\ImageF;
use App\Models\Post;
use App\Models\PostNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(50)->hasImages(1)->create()->map(function ($post) {
            if ($post->status === 'canceled') {
                PostNote::factory()->create([
                    'post_id' => $post->id,
                ]);
            }
        });
    }
}
