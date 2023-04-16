<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;

class DestroyController extends BaseController
{
    public function __invoke(Project $project) {
        $project->delete();
        return redirect()->route('project.index');
    }
}
