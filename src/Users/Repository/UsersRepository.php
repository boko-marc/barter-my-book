<?php

namespace Core\Users\Repository;

use Core\Users\Models\User;
use Core\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
