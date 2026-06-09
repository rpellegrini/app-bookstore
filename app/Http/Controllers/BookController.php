<?php

namespace App\Http\Controllers;

use App\Exceptions\BookUpdateException;
use App\Http\Requests\StoreBookRequest;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\SubjectRepositoryInterface;
use App\Services\CreateBookService;
use App\Services\UpdateBookService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\BookCreationException;

class BookController extends Controller
{
    private $authorRepository;
    private $subjectRepository;
    private $createBookService;
    private $updateBookService;
    private $bookRepository;

    public function __construct(AuthorRepositoryInterface  $authorRepository,
                                SubjectRepositoryInterface $subjectRepository,
                                CreateBookService          $createBookService,
                                UpdateBookService          $updateBookService,
                                BookRepositoryInterface    $bookRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->subjectRepository = $subjectRepository;
        $this->createBookService = $createBookService;
        $this->updateBookService = $updateBookService;
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->all();
        return view('books.index', ['books' => $books]);
    }

    public function create()
    {
        $authors = $this->authorRepository->all();
        $subjects = $this->subjectRepository->all();
        return view('books.create', ['authors' => $authors, 'subjects' => $subjects]);
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $this->createBookService->execute(
                $request->all()
            );

            return redirect()
                ->route('book.index')
                ->with('success', 'Livro cadastrado com sucesso!');

        } catch (BookCreationException $e) {

            Log::error('Erro ao cadastrar livro', [
                'exception' => $e,
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Não foi possível cadastrar o livro.');
        }

    }

    public function edit($id)
    {
        $book = $this->bookRepository->find($id);
        $authors = $this->authorRepository->all();
        $subjects = $this->subjectRepository->all();
        return view('books.edit', ['book' => $book, 'authors' => $authors, 'subjects' => $subjects]);
    }

    public function update(StoreBookRequest $request, $id)
    {
        try {
            $this->updateBookService->execute($id, $request->all());

            return redirect()
                ->route('book.index')
                ->with('success', 'Livro atualizado com sucesso!');

        } catch (BookUpdateException $e) {

            Log::error('Erro ao atualizar livro', [
                'exception' => $e,
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $book = $this->bookRepository->find($id);

            if (!$book) {
                return redirect()
                    ->route('book.index')
                    ->with('error', 'Assunto não encontrado!');
            }
            $book->delete();

            return redirect()
                ->route('book.index')
                ->with('success', 'Assunto excluído com sucesso!');

        } catch (QueryException $e) {
            return redirect()
                ->route('book.index')
                ->with('error', 'Não foi possível excluir o assunto!');
        }
    }


}
