<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): Response
    {
        return $user->checkRoles(['mod', 'admin'], False) ? Response::allow() : Response::deny("Must have at least moderator privileges.");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ?Report $report): Response
    {
        return ($user->checkRoles(['mod', 'admin'], False) || $user?->id === $report->reporter) ? Response::allow() : Response::deny("Must have at least moderator privileges or be the reporter.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, ?Report $report): Response
    {
        return ($user->checkRoles(['mod', 'admin'], False) || $user?->id === $report->reporter) ? Response::allow() : Response::deny("Must have at least moderator privileges or be the reporter.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?Report $report): Response
    {
        return ($user->checkRoles(['mod', 'admin'], False) || $user?->id === $report->reporter) ? Response::allow() : Response::deny("Must have at least moderator privileges or be the reporter.");
    }

    /**
     * Determine whether the user can resolve the report
     */
    public function resolve(?User $user): Response
    {
        return $user->checkRoles(['mod', 'admin'], False) ? Response::allow() : Response::deny("Must have at least moderator privileges.");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user): Response
    {
        return ($user->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user): Response
    {
        return ($user->checkRoles(['admin'])) ? Response::allow() : Response::deny("Must have admin privileges.");
    }
}
