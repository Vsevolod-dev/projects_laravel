<?php

namespace App\Http\Controllers\User;

// use App\Http\Filters\PostFilter;

use App\Http\Controllers\User\BaseController;
// use App\Http\Requests\Post\FilterRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

// use App\Http\Resources\Post\PostResource;
// use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke($id = null) {

        $user = $id ? User::findOrFail($id) : auth()->user();

        return view('profile.index', compact('user'));
    }
}
