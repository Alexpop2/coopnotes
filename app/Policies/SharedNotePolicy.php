<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\SharedNote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SharedNotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SharedNote $sharedNote)
    {
        return $sharedNote->user_id === $user->id || $sharedNote->note->user_id === $user->id
            ? Response::allow()
            : Response::deny('You don\'t have permission to open this');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SharedNote $sharedNote)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SharedNote $sharedNote)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SharedNote $sharedNote)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SharedNote $sharedNote)
    {
        //
    }
}
