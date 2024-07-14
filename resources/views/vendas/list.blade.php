@extends('includes.layout')
@section('pageTitle')
Vendas
@endsection

@section('content')
    <h1 class="my-3">Listagem de Vendas</h1>
    <div class="d-flex mt-3">
        <form id="form-busca" class="d-flex flex-grow-1" role="search">
            @csrf
            <input id="string-busca" class="form-control me-2 flex-grow-1" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
            <button id="buscar" class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
        <a href='#' class="btn btn-info ms-3">Adicionar Venda</a>
    </div>
    <div class="mt-5">
        <ul id='lista' class="list-group" style="max-height: 70vh;overflow: auto;"></ul>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function obterVendas() {
            $.ajax({
                url: '{{ route("api.vendas.index") }}',
                method: 'GET',
                success: function(response) {
                    $.each(response.vendas, function(index, venda) {
                        var livros = ""
                        var quantidade = 0
                        $.each(venda.livros, function(index, livro) {
                            if (index == 0) {
                                livros = livro.nome;
                            } else {
                                livros = livros.concat(', ', livro.nome);
                            }
                            quantidade += livro.pivot.quantidade;
                        })
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50">
                                    <div class="text-secondary">Cliente</div>
                                    <div class="fs-4">${venda.cliente.nome}</div>
                                    <div class="text-secondary">Livros</div>
                                    <div class="overflow-x-auto fs-4">
                                        ${livros}
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <div class="text-center text-secondary">QTD. Entregue</div>
                                        <div class="text-center fs-4">${quantidade}</div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <div class="text-center text-secondary">Valor Total</div>
                                        <div class="text-center fs-4">${venda.valor_total}</div>
                                    </div>
                                </div>
                                <div><button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                            </li>
                        `);
                    });
                }
            });
        }

        obterVendas();

        $('#form-busca').submit(function() {
            event.preventDefault();
            var query = $('#string-busca').val();
            $.ajax({
                url: '{{ route("api.vendas.busca") }}',
                method: 'GET',
                data: { venda: query },
                success: function(response) {
                    $('#lista').empty();
                    $.each(response.vendas, function(index, venda) {
                        var livros = ""
                        var quantidade = 0
                        $.each(venda.livros, function(index, livro) {
                            if (index == 0) {
                                livros = livro.nome;
                            } else {
                                livros = livros.concat(', ', livro.nome);
                            }
                            quantidade += livro.pivot.quantidade;
                        })
                        $('#lista').append(`
                            <li class="list-group-item d-flex align-items-center">
                                <div class="w-50">
                                    <div class="text-secondary">Cliente</div>
                                    <div class="fs-4">${venda.cliente.nome}</div>
                                    <div class="text-secondary">Livros</div>
                                    <div class="overflow-x-auto fs-4">
                                        ${livros}
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <div class="text-center text-secondary">QTD. Entregue</div>
                                        <div class="text-center fs-4">${quantidade}</div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <div class="text-center text-secondary">Valor Total</div>
                                        <div class="text-center fs-4">${venda.valor_total}</div>
                                    </div>
                                </div>
                                <div><button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                            </li>
                        `);
                    });
                }
            });
        });
    })
</script>
@endsection