<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;
use App\Models\User;

class ShowController extends BaseController
{
    public function __invoke(Project $project) {
        $user = User::findOrFail($project->user_id);
        return view('project.show', compact('project', 'user'));
    }
}
