<?php

namespace App\Services;

use App\Exceptions\BookCreationException;
use App\Traits\NormalizePriceTrait;
use Exception;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\BookRepositoryInterface;

class CreateBookService
{
    use NormalizePriceTrait;

    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute(array $data)
    {
        try {

            DB::beginTransaction();

            $book = $this->bookRepository->create([
                'title' => $data['title'],
                'publisher' => $data['publisher'],
                'edition' => $data['edition'],
                'publication_year' => $data['publication_year'],
                'price' => $this->normalizePrice($data['price']),
            ]);

            $book->authors()->sync($data['authors']);
            $book->subjects()->sync($data['subjects']);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            throw new BookCreationException(
                'Falha ao cadastrar o livro.',
                0,
                $e
            );
        }

        return $book;
    }
}
