<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;

class EditController extends BaseController
{
    public function __invoke(Project $project) {
        // $categories = Category::all();
        $tags = Tag::all();

        return view('project.edit', compact('project', 'tags'));
    }
}
