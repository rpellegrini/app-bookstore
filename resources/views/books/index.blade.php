@extends('layouts.app')

@section('title', 'Livros')

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Lista de Livros</h3>

            <a href="{{ route('book.create') }}" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus"></i> Novo Livro
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>

                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Título</th>
                        <th>Editora</th>
                        <th>Edição</th>
                        <th>Ano Publicação</th>
                        <th>Preço</th>
                        <th width="180">Ações</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($books as $book)

                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->edition}}</td>
                            <td>{{$book->publication_year}}</td>
                            <td>{{'R$ '.number_format($book->price, 2, ',', '.')}}</td>

                            <td>
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $book->id }}"
                                        data-name="{{ $book->title }}"
                                        data-toggle="modal"
                                        data-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Confirmar exclusão</h5>
                </div>

                <div class="modal-body">
                    Deseja realmente excluir esse livro
                    <strong id="titleBook"></strong>?
                </div>

                <div class="modal-footer">

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Excluir
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {

                $('.btn-delete').on('click', function () {

                    let id = $(this).data('id');
                    let title = $(this).data('title');

                    $('#titleBook').text(title);

                    let url = "{{ route('book.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    $('#deleteForm').attr('action', url);

                });

            });
        </script>
    @endpush

@endsection
