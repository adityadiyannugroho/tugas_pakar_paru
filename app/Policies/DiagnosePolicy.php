<?php

namespace App\Policies;

use App\Diagnose;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    public function view(User $user, Diagnose $diagnose)
    {
        return $user->diagnoses()->find($diagnose->id) != null
            && $diagnose->diseases()->count() != 0
            || $user->is_admin
                ? true
                : false;
    }

    public function create(User $user)
    {
        return true;
    }

    public function edit(User $user, Diagnose $diagnose)
    {
        return $user->diagnoses()->find($diagnose->id) != null
                ? true
                : false;
    }

    public function delete(User $user, Diagnose $diagnose)
    {
        return $user->diagnoses()->find($diagnose->id) != null
            ? true
            : false;
    }
}
