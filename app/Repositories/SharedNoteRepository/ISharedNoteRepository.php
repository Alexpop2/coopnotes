<?php

namespace App\Repositories\SharedNoteRepository;

/**
 * Shared Notes repository interface
 */
interface ISharedNoteRepository {
    /**
     * Get all shared notes
     * @return mixed
     */
    public function all();

    /**
     * Get all notes from user
     * @param $note
     * @return mixed
     */
    public function findAllByNote($note);

    /**
     * Get all shared notes for user
     * @param $user
     * @return mixed
     */
    public function findAllByUser($user);

    /**
     * Get shared note for user
     * @param $user
     * @return mixed
     */
    public function findAllByUserAndNote($user, $note);

    /**
     * Get shared note by ID
     * @param $id
     * @return mixed
     */
    public function findById($id);
}
