<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\SubjectRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->all();
        return view('subjects.index', ['subjects' => $subjects]);
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'description' => $request->description
            ];
            $subject = $this->subjectRepository->create($data);

            return redirect()
                ->route('subject.index')
                ->with('success', 'Assunto cadastrado com sucesso.');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao tentar salvar assusnto no banco de dados.');
        }

    }

    public function edit($id)
    {
        $subject = $this->subjectRepository->find($id);
        return view('subjects.edit', ['subject' => $subject]);
    }

    public function update(Request $request, $id)
    {

        try {
            $subject = $this->subjectRepository->find($id);
            if (!$subject) {
                return redirect()
                    ->route('subject.index')
                    ->with('error', 'Assunto não encontrado!');
            }

            $subject->description = $request->description;
            $subject->save();
            return redirect()
                ->route('subject.index')
                ->with('success', 'Assunto atualizado com sucesso!');


        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Não foi possível atualizar o assunto!');
        }
    }

    public function destroy($id)
    {
        try {
            $author = $this->subjectRepository->find($id);

            if (!$author) {
                return redirect()
                    ->route('subject.index')
                    ->with('error', 'Assunto não encontrado!');
            }
            $author->delete();

            return redirect()
                ->route('subject.index')
                ->with('success', 'Assunto excluído com sucesso!');

        } catch (QueryException $e) {
            return redirect()
                ->route('subject.index')
                ->with('error', 'Não foi possível excluir o assunto!');
        }
    }

}
