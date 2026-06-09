@extends('layouts.app')

@section('title', 'Novo Livro')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2 class="card-title">Cadastro de Autor</h2>

            <a href="{{ route('author.index') }}" class="btn btn-secondary btn-sm float-right">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('author.store') }}" method="POST">
            @csrf

            <div class="card-body">

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
                    <label>Nome</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('name') }}">
                </div>

            </div>


            <div class="card-footer">

                <button type="submit" class="btn btn-success">Salvar</button>

                <a href="{{ route('author.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection
