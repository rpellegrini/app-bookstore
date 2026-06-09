@extends('layouts.app')

@section('title', 'Editar Assunto')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2 class="card-title">Editar Assunto</h2>

            <a href="{{ route('subject.index') }}" class="btn btn-secondary btn-sm float-right">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('subject.update', $subject->id) }}" method="POST">
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
                    <label for="name">Descrição *</label>

                    <input
                        type="text"
                        id="description"
                        name="description"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('name', $subject->description) }}"
                    >
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-success">
                    Atualizar
                </button>

                <a href="{{ route('subject.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection
