<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request) {
        $data = $request->validated();

        /** @var User $user */
        $user = auth()->user();
        $user->update($data);
        $user->fresh();
        
        return redirect()->route('profile.index');
    }
}
