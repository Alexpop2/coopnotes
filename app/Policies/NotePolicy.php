<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\SharedNote;
use App\Models\User;
use App\Repositories\NoteRepository\INoteRepository;
use App\Repositories\SharedNoteRepository\ISharedNoteRepository;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    use HandlesAuthorization;

    private $sharedNoteRepository;

    public function __construct(ISharedNoteRepository $sharedNoteRepository)
    {
        $this->sharedNoteRepository = $sharedNoteRepository;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Note $note)
    {
        $sharedNote = $this->sharedNoteRepository->findAllByUserAndNote($user,$note);
        return ($note->user_id === $user->id) || (!empty($sharedNote) && $sharedNote->user_id === $user->id)
            ? Response::allow()
            : Response::deny('You don\'t have permission to open this');
    }
}
