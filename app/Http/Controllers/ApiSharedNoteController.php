<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\SharedNote;
use App\Models\User;
use App\Repositories\SharedNoteRepository\ISharedNoteRepository;
use Illuminate\Http\Request;

class ApiSharedNoteController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Note $note, User $user)
    {
        $this->authorize('view', $note);

        $sharedNote = SharedNote::create([
            'user_id' => $user->id,
            'note_id' => $note->id
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
        ], 201);
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
     * @param  \App\Models\SharedNote  $shared
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Note $note, SharedNote $shared)
    {
        $this->authorize('view', $shared);

        if($request->approved)
            $shared->approved = $request->approved;
        $shared->save();

        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SharedNote  $shared
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Note $note, SharedNote $shared)
    {
        $this->authorize('view', $shared);

        $shared->delete();

        return response()->json([
            'status' => 'success',
            'msg'    => 'Okay',
        ], 201);
    }

    public function destroyByNoteAndUser(Note $note, User $user)
    {
        $shared = $this->sharedNoteRepository->findAllByUserAndNote($user,$note);
        $this->destroy($note, $shared);
    }
}
