<?php

namespace App\Http\Controllers\Project;

use App\Http\Filters\ProjectFilter;
use App\Http\Requests\Project\FilterRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request) {

        // $this->authorize('view', auth()->user());

        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(ProjectFilter::class, ['queryParams' => array_filter($data)]);
        $projects = Project::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        // $projects = Project::where('is_published', 1)
        //     ->where('category_id', $data['category_id'])
        //     ->get();

        // $query = Project::query();
        // if (isset($data['category_id'])) $query->where('category_id', $data['category_id']);
        // if (isset($data['title'])) $query->where('title', 'like', "%{$data['title']}%");
        // if (isset($data['content'])) $query->where('content', 'like', "%{$data['content']}%");
        // $projects = $query->get();

        // $projects = Project::paginate(10);

        // return ProjectResource::collection($projects);

        return view('project.index', compact('projects'));
    }
}
