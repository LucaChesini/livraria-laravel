@extends('includes.layout')
@section('pageTitle')
Clientes
@endsection

@section('content')
    <div class="d-flex mt-3">
        <form id="form-busca" class="d-flex flex-grow-1" role="search">
            @csrf
            <input id="string-busca" class="form-control me-2 flex-grow-1" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
            <button id="buscar" class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
        <a href="#" class="btn btn-info ms-3">Adicionar Cliente</a>
    </div>
    <div class="mt-5">
        <ul id='lista' class="list-group">
            {{-- <li class="list-group-item d-flex align-items-center">
                <div class="w-50">Nome</div>
                <div class="flex-grow-1">
                    <div class='text-center'>CPF</div>
                    <div class='text-center'>Telefone</div>
                </div>
                <div>Ações</div>
            </li> --}}
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
                success: function(clientes) {
                    $.each(clientes.clientes, function(index, cliente) {
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50">${cliente.nome}</div>
                                <div class="flex-grow-1">
                                    <div class="text-center">${cliente.cpf}</div>
                                    <div class="text-center">${cliente.telefone}</div>
                                </div>
                                <div>Ações</div>
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
                success: function(clientes) {
                    $('#lista').empty();
                    $.each(clientes.clientes, function(index, cliente) {
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50">${cliente.nome}</div>
                                <div class="flex-grow-1">
                                    <div class="text-center">${cliente.cpf}</div>
                                    <div class="text-center">${cliente.telefone}</div>
                                </div>
                                <div>Ações</div>
                            </li>
                        `);
                    });
                }
            });
        });
    })
</script>
@endsection