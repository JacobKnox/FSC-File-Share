<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user?->checkRoles(['mod', 'admin'], False) ? Response::allow() : Response::deny("Must have at least moderator privileges.");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, File $file): Response
    {
        return ($file?->visible || $user?->checkRoles(['mod', 'admin'], False) || $user?->id === $file?->user_id) ? Response::allow() : Response::deny("This file is not visible to all users right now.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user ? Response::allow() : Response::deny("Must be an authenticated user.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, File $file): Response
    {
        return ($user?->id === $file?->user_id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You are not the owner of this file.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, File $file): Response
    {
        return ($user?->id === $file?->user_id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You are not the owner of this file.");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, File $file): Response
    {
        return ($user?->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, File $file): Response
    {
        return ($user?->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }
}
