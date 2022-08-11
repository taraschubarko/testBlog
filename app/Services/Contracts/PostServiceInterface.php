<?php

namespace App\Services\Contracts;

interface PostServiceInterface
{
    //Список блогу на головній
    public function listOnMain(): object;
}
