<?php

namespace App\Repositories\UserRepository;

use App\Models\User;

/**
 * Database user repository
 */
class DbUserRepository implements IUserRepository {

    function findByNamePart($text, $exceptIds = [])
    {
        $query =  User::query()
            ->select('id','name')
            ->where('name','like',"$text%")
            ->limit(50)
            ->orderBy('name');

        foreach ($exceptIds as $exceptId) {
            $query->whereNot('id',$exceptId);
        }
        return $query->get();
    }

    function findBySharedNote($note)
    {
        $query =  User::query()
            ->select('users.id','users.name')
            ->join('shared_notes','users.id','=','shared_notes.user_id')
            ->where('shared_notes.note_id','=',$note->id)
            ->orderByDesc('shared_notes.id');

        return $query->get();
    }
}
