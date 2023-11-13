<?php

namespace App\Policies;

use App\Models\Bug;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BugPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): Response
    {
        return $user?->checkRoles(['mod', 'admin'], False) ? Response::allow() : Response::deny("Must have at least moderator privileges.");
    }

    /**
     * Determine whether the user can push models to GitHub issues
     */
    public function push(?User $user): Response
    {
        return $user?->checkRoles(['mod', 'admin'], False) ? Response::allow() : Response::deny("Must have at least moderator privileges.");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ?Bug $bug): Response
    {
        return ($user?->checkRoles(['mod', 'admin'], False) || $user?->id === $bug?->reporter) ? Response::allow() : Response::deny("You must either be the reporter or a moderator.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, ?Bug $bug): Response
    {
        return ($user?->id === $bug?->reporter || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You must be the reporter or a moderator.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?Bug $bug): Response
    {
        return ($user?->id === $bug?->reporter || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You must be the reporter or a moderator.");
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
