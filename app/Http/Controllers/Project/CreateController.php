<?php

namespace App\Http\Controllers\Project;

use App\Models\Category;
use App\Models\Tag;

class CreateController extends BaseController
{
    public function __invoke() {
        // $categories = Category::all();
        $tags = Tag::all();

        return view('project.create', compact(/*'categories',*/ 'tags'));
    }
}
