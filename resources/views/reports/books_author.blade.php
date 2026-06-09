@extends('layouts.app')

@section('title', 'Relatório de Livros por Autor')

@section('content')

    <div class="card">

        <div class="card-header">

            <div class="row w-100">

                <div class="col-md-6">
                    <h3 class="card-title">
                        Relatório de Livros por Autor
                    </h3>
                </div>

                <div class="col-md-6 text-right">
                    <a href="{{ route('reports.books-author.pdf') }}"
                       class="btn btn-danger btn-sm">
                        Exportar PDF
                    </a>
                </div>

            </div>

        </div>

        <div class="card-body">

            @if($booksByAuthor->isEmpty())

                <div class="alert alert-info mb-0">
                    Nenhum registro encontrado para o relatório.
                </div>

            @else

                @foreach($booksByAuthor as $authorName => $books)

                    <div class="card mb-4">

                        <div class="card-header bg-light">
                            <strong>
                                {{ $authorName }}
                            </strong>

                        </div>

                        <div class="card-body p-0">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm mb-0">
                                    <thead>
                                    <tr>
                                        <th>Livro</th>
                                        <th>Editora</th>
                                        <th width="90">Edição</th>
                                        <th width="120">Ano</th>
                                        <th width="130">Valor</th>
                                        <th>Assunto</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->publisher }}</td>
                                            <td>{{ $book->edition }}</td>
                                            <td>{{ $book->publication_year }}</td>
                                            <td>
                                                R$ {{ number_format($book->price, 2, ',', '.') }}
                                            </td>
                                            <td>{{ $book->subject_description }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>

                @endforeach

            @endif

        </div>

    </div>

@endsection
