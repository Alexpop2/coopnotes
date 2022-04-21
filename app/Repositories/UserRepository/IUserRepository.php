<?php

namespace App\Repositories\UserRepository;

interface IUserRepository {
    function findByNamePart($text);
    function findBySharedNote($note);
}
