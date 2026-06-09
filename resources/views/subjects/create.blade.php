@extends('layouts.app')

@section('title', 'Novo Assunto')

@section('content')

    <div class="card">

        <div class="card-header">
            <h2 class="card-title">Cadastro de Assunto</h2>

            <a href="{{ route('subject.index') }}" class="btn btn-secondary btn-sm float-right">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('subject.store') }}" method="POST">
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
                    <label>Descrição</label>
                    <input
                        type="text"
                        name="description"
                        class="form-control"
                        maxlength="20"
                        value="{{ old('name') }}">
                </div>

            </div>


            <div class="card-footer">

                <button type="submit" class="btn btn-success">Salvar</button>

                <a href="{{ route('subject.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection
