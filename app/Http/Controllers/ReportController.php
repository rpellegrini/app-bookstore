<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function booksByAuthor()
    {
        $booksByAuthor = DB::table('vw_books_by_author')
            ->orderBy('author_name')
           // ->orderBy('book_title')
            ->get()
            ->groupBy('author_name');


        return view('reports.books_author', compact('booksByAuthor'));

    }

    public function booksByAuthorPDF()
    {
        $booksByAuthor = DB::table('vw_books_by_author')
            ->orderBy('author_name')
            // ->orderBy('book_title')
            ->get()
            ->groupBy('author_name');


        return view('reports.pdf.books_author', compact('booksByAuthor'));
    }
}
