<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'edition',
        'publication_year',
        'price'
    ];

    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'book_authors',
            'book_id',
            'author_id'
        );
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_books',
            'book_id',
            'subject_id'
        );
    }

}
