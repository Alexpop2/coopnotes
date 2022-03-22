<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Repositories\NoteRepository\INoteRepository;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{

    /**
     * @var INoteRepository
     */
    private $noteRepository;

    /**
     * @param INoteRepository $noteRepository
     */
    public function __construct(INoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userNotes = $this->noteRepository->findByUser(Auth::user());
        return Inertia::render('Notes/Index', [
            'userNotes' => $userNotes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function create()
    {
        $note = Note::create([
            'user_id' => Auth::user()->id,
        ]);
        return Redirect::route("notes.edit", $note->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return Response
     */
    public function edit(Note $note)
    {
        return Inertia::render('Notes/Edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->all());

        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
