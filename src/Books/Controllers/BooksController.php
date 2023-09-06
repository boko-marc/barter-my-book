<?php

namespace Core\Books\Controllers;

use Core\Books\Repository\BooksRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Core\Controllers\Controller;

class BooksController extends Controller
{

    protected BooksRepositoryInterface $booksRepository;
    public function __construct(BooksRepositoryInterface $booksRepository)
    {
        $this->booksRepository = $booksRepository;
    }
}
