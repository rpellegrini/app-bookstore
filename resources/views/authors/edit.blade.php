@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2 class="card-title">Editar Autor</h2>

            <a href="{{ route('author.index') }}" class="btn btn-secondary btn-sm float-right">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('author.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                    <label for="name">Nome *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('name', $author->name) }}"
                    >
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-success">
                    Atualizar
                </button>

                <a href="{{ route('author.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection
