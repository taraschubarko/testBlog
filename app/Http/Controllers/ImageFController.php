<?php

namespace App\Http\Controllers;

use App\Models\ImageF;
use App\Services\Contracts\ImageFServiceInterface;
use Illuminate\Http\Request;

class ImageFController extends Controller
{
    public $service;

    public function __construct(ImageFServiceInterface $service)
    {
        $this->service = $service;
    }
    //
    public function destroy(ImageF $image)
    {
        $this->service->delete($image);
        return redirect()->back();
    }
}
