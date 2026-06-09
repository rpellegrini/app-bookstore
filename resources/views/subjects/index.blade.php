@extends('layouts.app')

@section('title', 'Livros')

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Lista de Assuntos</h3>

            <a href="{{ route('subject.create') }}" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus"></i> Novo Assunto
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
                        <!--<th width="10%">ID</th>-->
                        <th width="80%">Descrição</th>
                        <th width="20%">Ações</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($subjects as $subject)
                        <tr>
                            <td>{{$subject->description}}</td>
                            <td>
                                {{--<a href="#" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>--}}

                                <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $subject->id }}"
                                        data-name="{{ $subject->description }}"
                                        data-toggle="modal"
                                        data-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                Nenhum assunto cadastrado.
                            </td>
                        </tr>
                    @endforelse

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
                    Deseja realmente excluir o assunto
                    <strong id="authorName"></strong>?
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
                    let description = $(this).data('description');

                    $('#authorName').text(description);

                    let url = "{{ route('subject.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    $('#deleteForm').attr('action', url);

                });

            });
        </script>
    @endpush
@endsection


