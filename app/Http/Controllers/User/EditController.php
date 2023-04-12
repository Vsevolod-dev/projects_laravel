<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

class EditController extends BaseController
{
    public function __invoke() {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }
}
