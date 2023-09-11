<?php

namespace Core\Books\Repository;

use Core\Books\Models\Books;
use Core\Repository\Eloquent\BaseRepository;

class BooksRepository extends BaseRepository implements BooksRepositoryInterface
{

    public function __construct(Books $books)
    {
        parent::__construct($books);
    }
}
