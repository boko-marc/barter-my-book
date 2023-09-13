<?php

namespace Core\Books\Policies;

use Core\Books\Models\Books;

use Core\Users\Models\User;
use Illuminate\Auth\Access\Response;

class BooksPolicies
{


    /**
     * Determine whether the user own  the book.
     */
    public function owner(User $user, Books $books): bool|string
    {
        return $user->id === $books->owner_id
            ? Response::allow()
            : Response::deny("Vous n'êtes pas auteur de ce livre.");
    }
}
