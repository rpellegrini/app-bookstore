@extends('layouts.app')

@section('title', 'Novo Livro')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2 class="card-title">Cadastro de Livro</h2>

            <a href="{{ route('book.index') }}" class="btn btn-secondary btn-sm float-right">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('book.store') }}" method="POST">
            @csrf

            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>

                        <i class="fas fa-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>

                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label>Título *</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label>Editora *</label>
                    <input
                        type="text"
                        name="publisher"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('publisher') }}">
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Edição *</label>
                            <input
                                type="number"
                                name="edition"
                                class="form-control"
                                min="1"
                                value="{{ old('edition') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ano de Publicação *</label>
                            <input
                                type="text"
                                name="publication_year"
                                id="publication_year"
                                class="form-control"
                                maxlength="4"
                                placeholder="2026"
                                value="{{ old('publication_year') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Valor</label>
                            <input
                                type="text"
                                name="price"
                                id="price"
                                class="form-control"
                                value="{{ old('price') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Autores *</label>

                            <select name="authors[]"
                                    class="form-control select2"
                                    multiple>

                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">
                                        {{ $author->name }}
                                    </option>
                                @endforeach

                            </select>

                            <small class="text-muted">
                                Opção de selecionar mais de um autor.
                            </small>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Assuntos *</label>

                            <select name="subjects[]"
                                    class="form-control select2"
                                    multiple>

                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->description }}
                                    </option>
                                @endforeach

                            </select>

                            <small class="text-muted">
                                Opção de selecionar mais de um assunto.
                            </small>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-success">Salvar</button>

                <a href="{{ route('book.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('.select2').select2({
                width: '100%'
            });

            $('#price').maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ',',
                allowZero: true
            });

        });
    </script>
@endpush
