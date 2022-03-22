<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\SharedNote;
use App\Models\User;
use App\Repositories\SharedNoteRepository\ISharedNoteRepository;
use Illuminate\Http\Request;

class SharedNoteController extends Controller
{

    /**
     * @var ISharedNoteRepository
     */
    private $sharedNoteRepository;

    /**
     * @param ISharedNoteRepository $sharedNoteRepository
     */
    public function __construct(ISharedNoteRepository $sharedNoteRepository)
    {
        $this->sharedNoteRepository = $sharedNoteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Http\Response
     */
    public function show(SharedNote $sharedNote)
    {
        //
    }

    /**
     * Display all shared notes by note.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function showByNote(Note $note)
    {
        return $this->sharedNoteRepository->findAllByNote($note);
    }

    /**
     * Display all shared notes by user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showByUser(User $user)
    {
        return $this->sharedNoteRepository->findAllByUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SharedNote $sharedNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SharedNote  $sharedNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(SharedNote $sharedNote)
    {
        //
    }
}
