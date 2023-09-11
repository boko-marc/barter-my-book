<?php

namespace Core\Books\Repository;

use Core\Books\Models\BooksPictures;
use Core\Repository\Eloquent\BaseRepository;

class BooksPicturesRepository extends BaseRepository implements BooksPicturesRepositoryInterface
{

    public function __construct(BooksPictures $booksPictures)
    {
        parent::__construct($booksPictures);
    }
}
