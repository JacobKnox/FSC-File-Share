<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
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
    public function view(?User $user, ?Comment $comment): Response
    {
        return ($comment?->visible || $user?->checkRoles(['mod', 'admin'], False) || $user?->id === $comment?->user_id) ? Response::allow() : Response::deny("This comment is not visible to all users right now.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): Response
    {
        return $user ? Response::allow() : Response::deny("Must be an authenticated user.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, ?Comment $comment): Response
    {
        return ($user?->id === $comment?->user_id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You are not the owner of this comment.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?Comment $comment): Response
    {
        return ($user?->id === $comment?->user_id || $user?->checkRoles(['mod', 'admin'], False)) ? Response::allow() : Response::deny("You are not the owner of this comment.");
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
