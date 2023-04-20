<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __invoke(string $name)
    {
        $path = getenv('HOME') . '/images/'.$name;
        if (file_exists($path)){
            return response()->file($path);
        } else {
            return response()->json(['result' => false], 404);
        }
    }
}
