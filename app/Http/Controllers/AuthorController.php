<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        $authors = $this->authorRepository->all();
        return view('authors.index', ['authors' => $authors]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        try {
            $dataAuthor = [
                'name' => $request->name
            ];
            $this->authorRepository->create($dataAuthor);

            return redirect()
                ->route('author.index')
                ->with('success', 'Autor cadastrado com sucesso.');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao tentar salvar autor no banco de dados.');
        }

    }

    public function destroy($id)
    {
        try {
            $author = $this->authorRepository->find($id);

            if (!$author) {
                return redirect()
                    ->route('author.index')
                    ->with('error', 'Autor não encontrado!');
            }
            $author->delete();

            return redirect()
                ->route('author.index')
                ->with('success', 'Autor excluído com sucesso!');

        } catch (QueryException $e) {

            return redirect()
                ->route('author.index')
                ->with('error', 'Não foi possível excluir o autor!');

        }
    }

    public function edit($id)
    {
        $author = $this->authorRepository->find($id);
        return view('authors.edit', ['author' => $author]);
    }

    public function update(StoreAuthorRequest $request, $id)
    {
        try {
            $this->authorRepository->update($id, [
                'name' => $request->name
            ]);

            return redirect()
                ->route('author.index')
                ->with('success', 'Autor atualizado com sucesso!');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Não foi possível atualizar o autor!');
        }
    }


}
