<?php

namespace App\Repositories\Eloquent;

use App\Models\Subject;
use App\Repositories\Contracts\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function all()
    {
        return Subject::orderBy('description')->get();
    }

    public function find(int $id)
    {
        return Subject::findOrFail($id);
    }

    public function create(array $data)
    {
        return Subject::create($data);
    }

    public function update(int $id, array $data)
    {
        $author = $this->find($id);
        $author->update($data);

        return $author;
    }

    public function delete(int $id): bool
    {
        $author = $this->find($id);

        return $author->delete();
    }
}
