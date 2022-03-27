<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Repositories\NoteRepository\INoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiNoteController extends Controller
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
     * @return NoteResource
     */
    public function index()
    {
        return new NoteResource($this->noteRepository->findByUser(Auth::user()));
    }

    /**
     * Display a listing of shared notes by user.
     *
     * @return NoteResource
     */
    public function showShared()
    {
        return new NoteResource($this->noteRepository->findSharedByUser(Auth::user()));
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
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
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
