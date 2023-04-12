<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function __invoke(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().rand(1,99).'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        return response()->json(['success' => $imageName]);
    }
}
