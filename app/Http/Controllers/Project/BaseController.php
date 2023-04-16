<?php


namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Services\Project\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
