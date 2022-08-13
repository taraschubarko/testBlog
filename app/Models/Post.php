<?php

namespace App\Models;

use App\Facades\PostFacade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function images()
    {
        return $this->morphMany(ImageF::class, 'imageable');
    }

    public function image()
    {
        return $this->morphOne(ImageF::class, 'imageable');
    }

    public function notes()
    {
        return $this->hasMany(PostNote::class);
    }

    public function note()
    {
        return $this->hasOne(PostNote::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
