<?php

namespace Core\Books\Controllers;

use Carbon\Carbon;
use Core\Books\Models\Books;
use Core\Books\Repository\BooksPicturesRepositoryInterface;
use Core\Books\Repository\BooksRepositoryInterface;
use Core\Books\Requests\BooksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Core\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class BooksController extends Controller
{

    protected BooksRepositoryInterface $booksRepository;
    protected BooksPicturesRepositoryInterface $booksPicturesRepository;
    public function __construct(BooksRepositoryInterface $booksRepository, BooksPicturesRepositoryInterface $booksPicturesRepository)
    {
        $this->booksRepository = $booksRepository;
        $this->booksPicturesRepository = $booksPicturesRepository;
    }

    public function storeImage($image, $book, $file)
    {
        $imageName = $book->owner->id . '-book' . $book->id . '-picture-' . time() . rand(1, 1000) . '.' . $image->extension();
        $image->move(public_path($file), $imageName);
        return $imageName;
    }

    public function store(BooksRequest $resquest)
    {
        $bookData = $resquest->validated();
        $otherBookData = ['added_at' => Carbon::now()];
        $book = $this->booksRepository->make(array_merge($bookData, $otherBookData));
        $book = $this->booksRepository->associate($book, ['owner' => Auth::user()]);
        if (count($bookData['books_pictures']) > 0) {
            foreach ($bookData['books_pictures'] as $bookPicture) {
                $bookPictureName = $this->storeImage($bookPicture, $book, 'books-pictures-folder');
                $newBookPicture = $this->booksPicturesRepository->make([
                    'image' => $bookPictureName
                ]);
                $newBookPicture = $this->booksPicturesRepository->associate($newBookPicture, ['book' => $book]);
            }
        }
        return response(['message' => "Livre enregistré avec succès", 'data' => $book], 200);
    }

    public function show(Books $book)
    {
        Gate::authorize('owner', $book);
        $book = $this->booksRepository->findOneBy([['id' => $book->id]], ['booksPictues', 'owner']);
        return response(['message' => 'Livre récupéré avec succès', 'data' => $book], 200);
    }

    public function delete(Books $book)
    {
        Gate::authorize('owner', $book);
        if ($this->booksRepository->delete($book)) {
            return response(["message" => "Livre supprimé avec succès"], 200);
        }
    }

    public function update(Books $book, BooksRequest $resquest)
    {
        Gate::authorize('owner', $book);
        $bookUpdated =  $this->booksRepository->update($resquest->validated(), $book);
        return response(["message" => "Livre modifié avec succès", "data" => $bookUpdated], 200);
    }

    public function getBooksByParameters(Request $request)
    {
        $querys = $request->query();

        $conditions = [];

        if (array_key_exists('owner', $querys) && !is_null($querys['owner'])) {
            $conditions[] = ['owner_id', $querys['owner']];
        }

        if (array_key_exists('class', $querys) && !is_null($querys['class'])) {
            $class = [0, 1, 2, 3, 4, 5, 6];
            if (!in_array($querys["class"], $class)) {
                return response(['message' => "Veuillez sélectionner une classe entre la 6ème et la terminale"], 422);
            }
            $conditions[] = ['class', $querys['class']];
        }

        if (array_key_exists('subject', $querys) && !is_null($querys['subject'])) {
            $subjects = ["mathematiques", "pct", "francais", "anglais", "allemand", "svt", "philosophie"];
            if (!in_array($querys["subject"], $subjects)) {
                return response(['message' => "Veuillez sélectionner une matière parmi la liste de nos matières disponibles"], 422);
            }
            $conditions[] = ['subject', $querys['subject']];
        }

        $books = $this->booksRepository->findBy($conditions, ['owner'],['booksPictues']);
        return response(['message' => "Livres récupérés avec  succès", "data" => $books], 200);
    }
}
