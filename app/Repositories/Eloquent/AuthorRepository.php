<?php

namespace App\Repositories\Eloquent;

use App\Models\Author;
use App\Repositories\Contracts\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function all()
    {
        return Author::orderBy('name')->get();
    }

    public function find(int $id)
    {
        return Author::findOrFail($id);
    }

    public function create(array $data)
    {
        return Author::create($data);
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
