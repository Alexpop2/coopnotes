<?php

namespace App\Repositories\NoteRepository;

/**
 * Notes repository interface
 */
interface INoteRepository {
    /**
     * Get all notes from all users
     * @return mixed
     */
    public function all();

    /**
     * Get all notes from user
     * @param $user
     * @return mixed
     */
    public function findByUser($user);

    /**
     * Get note by ID
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Get all shared notes by user
     * @param $user
     * @return mixed
     */
    public function findSharedByUser($user);
}
