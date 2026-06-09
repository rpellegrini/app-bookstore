<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewBooksByAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW vw_books_by_author AS
            SELECT
                b.id AS book_id,
                b.title,
                b.publisher,
                b.edition,
                b.publication_year,
                b.price,
                a.id AS author_id,
                a.name AS author_name,
                s.id AS subject_id,
                s.description AS subject_description
            FROM books b
            INNER JOIN book_authors ab
                ON ab.book_id = b.id
            INNER JOIN authors a
                ON a.id = ab.author_id
            INNER JOIN subject_books bs
                ON bs.book_id = b.id
            INNER JOIN subjects s
                ON s.id = bs.subject_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vw_books_by_author');
    }
}
