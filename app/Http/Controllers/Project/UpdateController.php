<?php

namespace App\Http\Controllers\Project;

use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Project $project) {
        $data = $request->validated();

        $project = $this->service->update($project, $data);
        if ($project instanceof Project) {
            // return new ProjectResource($project);
            return redirect()->route('project.show', $project->id);
        } else {
            return $project;
        }

    }
}
