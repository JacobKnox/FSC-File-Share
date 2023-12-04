<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ?User $model): Response
    {
        return ($model?->visible || $user?->checkRoles(['mod', 'admin'], False) || $user?->id === $model?->id) ? Response::allow() : Response::deny("This user is not visible to all users right now.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): Response
    {
        return (!$user || $user?->checkRoles(['admin'])) ? Response::allow() : Response::deny("You are currently logged into an account and do not have administrator privileges.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, ?User $model): Response
    {
        return ($user?->id === $model?->id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("Hey, that's not your account!", 403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?User $model): Response
    {
        return ($user?->id === $model?->id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("Hey, that's not your account!", 403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user): Response
    {
        return ($user?->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user): Response
    {
        return ($user?->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }
}
