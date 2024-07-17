@extends('includes.layout')
@section('pageTitle')
Clientes
@endsection

@section('content')
    <h1 class="my-3">Listagem de Clientes</h1>
    <div class="d-flex mt-3">
        <form id="form-busca" class="d-flex flex-grow-1" role="search">
            @csrf
            <input id="string-busca" class="form-control me-2 flex-grow-1" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
            <button id="buscar" class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
        <a href='{{route("clientes.create")}}' class="btn btn-info ms-3">Adicionar Cliente</a>
    </div>
    <div class="mt-5">
        <ul id='lista' class="list-group" style="max-height: 70vh;overflow: auto;">
        </ul>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function obterClientes() {
            $.ajax({
                url: '{{ route("api.clientes.index") }}',
                method: 'GET',
                success: function(response) {
                    $.each(response.clientes, function(index, cliente) {
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50 fs-4">${cliente.nome}</div>
                                <div class="flex-grow-1">
                                    <div class="text-center"><span class="text-secondary">CPF: </span>${cliente.cpf}</div>
                                    <div class="text-center"><span class="text-secondary">Fone: </span>${cliente.telefone}</div>
                                </div>
                                <div>
                                    <a href="clientes/${cliente.id}/editar" class="btn btn-primary mx-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </div>
                            </li>
                        `);
                    });
                }
            });
        }

        obterClientes();

        $('#form-busca').submit(function() {
            event.preventDefault();
            var query = $('#string-busca').val();
            $.ajax({
                url: '{{ route("api.clientes.busca") }}',
                method: 'GET',
                data: { cliente: query },
                success: function(response) {
                    $('#lista').empty();
                    $.each(response.clientes, function(index, cliente) {
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50 fs-4">${cliente.nome}</div>
                                <div class="flex-grow-1">
                                    <div class="text-center"><span class="text-secondary">CPF: </span>${cliente.cpf}</div>
                                    <div class="text-center"><span class="text-secondary">Fone: </span>${cliente.telefone}</div>
                                </div>
                                <div>
                                    <a href="clientes/${cliente.id}/editar" class="btn btn-primary mx-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </div>
                            </li>
                        `);
                    });
                }
            });
        });
    })
</script>
@endsection