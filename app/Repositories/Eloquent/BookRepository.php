<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::orderBy('title')->get();
    }

    public function find(int $id)
    {
        return Book::findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
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
