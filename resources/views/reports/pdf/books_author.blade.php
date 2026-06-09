<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Livros por Autor</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background: #f2f2f2;
        }

        h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Relatório de Livros por Autor</h1>

@foreach($booksByAuthor as $authorName => $books)

    <h3>{{ $authorName }}</h3>

    <table>
        <thead>
        <tr>
            <th>Livro</th>
            <th>Editora</th>
            <th>Ano</th>
            <th>Valor</th>
            <th>Assunto</th>
        </tr>
        </thead>

        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->publication_year }}</td>
                <td>R$ {{ number_format($book->price, 2, ',', '.') }}</td>
                <td>{{ $book->subject_description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endforeach

</body>
</html>
