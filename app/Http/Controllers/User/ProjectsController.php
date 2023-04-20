<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Models\Project;

class ProjectsController extends BaseController
{
    public function __invoke($user_id) {
        $query = Project::query();
        if (isset($user_id)) $query->where('user_id', $user_id);
        $posts = $query->get();

        return view('post.index', compact('posts'));
    }
}
