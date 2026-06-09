<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //use HasFactory;
    protected $fillable = [
        'name'
    ];

    public $messages = [
        'name.required' => 'O campo nome é obrigatório',
    ];

    /*public function books()
    {
        return $this->belongsToMany(
            Book::class,
            'book_authors',
            'author_id',
            'book_id'
        );
    }*/

}
