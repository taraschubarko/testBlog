<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageF extends Model
{
    use HasFactory;

    protected $table = 'image_files';

    protected $guarded = [
        'id'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
