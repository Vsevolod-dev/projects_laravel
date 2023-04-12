<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;

class ShowController extends BaseController
{
    public function __invoke(Post $post) {
        $user = User::findOrFail($post->user_id);
        return view('post.show', compact('post', 'user'));
    }
}
