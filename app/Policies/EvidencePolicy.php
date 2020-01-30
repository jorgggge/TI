<?php

namespace App\Policies;

use App\Evidences;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EvidencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any evidences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Evidences $evidences)
    {
        return true;
    }

    /**
     * Determine whether the user can view the evidences.
     *
     * @param  \App\User  $user
     * @param  \App\Evidences  $evidences
     * @return mixed
     */
    public function view(User $user, Evidences $evidences)
    {
        //
        return $user->companyId === $evidences->companyId;
    }

    /**
     * Determine whether the user can create evidences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the evidences.
     *
     * @param  \App\User  $user
     * @param  \App\Evidences  $evidences
     * @return mixed
     */
    public function update(User $user, Evidences $evidences)
    {
        //
    }

    /**
     * Determine whether the user can delete the evidences.
     *
     * @param  \App\User  $user
     * @param  \App\Evidences  $evidences
     * @return mixed
     */
    public function delete(User $user, Evidences $evidences)
    {
        //
    }

    /**
     * Determine whether the user can restore the evidences.
     *
     * @param  \App\User  $user
     * @param  \App\Evidences  $evidences
     * @return mixed
     */
    public function restore(User $user, Evidences $evidences)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the evidences.
     *
     * @param  \App\User  $user
     * @param  \App\Evidences  $evidences
     * @return mixed
     */
    public function forceDelete(User $user, Evidences $evidences)
    {
        //
    }
}