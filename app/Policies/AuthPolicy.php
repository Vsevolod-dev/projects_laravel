<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthPolicy
{
    use HandlesAuthorization;

    public function auth(User $user, User $model)
    {
        // dd($model->id);
        return auth()->user();
    }
}
