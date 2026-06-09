<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('book.index');
});

Route::group(['prefix' => 'book'], function () {
    Route::get('index', [BookController::class, 'index'])->name('book.index');
    Route::get('create', [BookController::class, 'create'])->name('book.create');
    Route::post('store', [BookController::class, 'store'])->name('book.store');
    Route::delete('destroy/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('update/{id}', [BookController::class, 'update'])->name('book.update');

});

Route::group(['prefix' => 'author'], function () {
    Route::get('index', [AuthorController::class, 'index'])->name('author.index');
    Route::get('create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('destroy/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
});

Route::group(['prefix' => 'subject'], function () {
    Route::get('index', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('store', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('update/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('destroy/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
});

Route::group(['prefix' => 'reports'], function () {
    Route::get('books/author', [ReportController::class, 'booksByAuthor'])->name('reports.books-author');
    Route::get('books/author/pdf', [ReportController::class, 'booksByAuthorPDF'])->name('reports.books-author.pdf');
});
