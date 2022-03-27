<?php

namespace App\Repositories\SharedNoteRepository;

use App\Models\SharedNote;

/**
 * Database shared notes repository
 */
class DbSharedNoteRepository implements ISharedNoteRepository {

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return SharedNote::all();
    }

    /**
     * @param $note
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function findAllByNote($note)
    {
        return SharedNote::query()
            ->where('note_id', $note->id)
            ->orderByDesc('updated_at')
            ->get();
    }

    /**
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function findAllByUser($user)
    {
        return SharedNote::query()
            ->where('user_id', $user->id)
            ->orderByDesc('updated_at')
            ->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findById($id)
    {
        return SharedNote::query()
            ->where('id', $id)
            ->first();
    }

    public function findAllByUserAndNote($user, $note)
    {
        return SharedNote::query()
            ->where('note_id', $note->id)
            ->where('user_id', $user->id)
            ->first();
    }
}
