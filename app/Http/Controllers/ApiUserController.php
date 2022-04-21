<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Note;
use App\Repositories\UserRepository\IUserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Api Users controller
 */
class ApiUserController extends Controller
{
    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $namePart
     * @return UserResource
     */
    public function showBySearch($namePart) {
        return new UserResource($this->userRepository->findByNamePart($namePart, [Auth::user()->id]));
    }

    /**
     * @param Note $note
     * @return UserResource
     */
    public function showBySharedNote(Note $note) {
        return new UserResource($this->userRepository->findBySharedNote($note));
    }
}
