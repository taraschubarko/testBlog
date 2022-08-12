<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImageFFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'imageF';
    }
}
