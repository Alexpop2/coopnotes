<?php

namespace App\Repositories\NoteRepository;

use App\Models\Note;

/**
 * Database notes repository
 */
class DbNoteRepository implements INoteRepository {

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Note::all();
    }

    /**
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByUser($user)
    {
        return Note::query()
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findById($id)
    {
        return Note::query()
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findSharedByUser($user)
    {
        return Note::query()
            ->select('notes.*','shared_notes.approved', 'shared_notes.id AS shared_id')
            ->join('shared_notes', 'notes.id', '=', 'shared_notes.note_id')
            ->where('shared_notes.user_id', $user->id)
            ->orderByDesc('notes.id')
            ->get();
    }
}
