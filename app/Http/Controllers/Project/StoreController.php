<?php

namespace App\Http\Controllers\Project;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request) {
        $data = $request->validated();

        $project = $this->service->store($data);

        // if ($project instanceof Project) {
        //     return new ProjectResource($project);
        // } else {
        //     return $project;
        // }

        return redirect()->route('project.index');
    }
}
