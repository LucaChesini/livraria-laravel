@extends('includes.layout')
@section('pageTitle')
    Vendas
@endsection

@section('content')
    <h1 class="my-3">Cadastro de Vendas</h1>
    <form id="form-cliente" class="row g-3" method="POST">
        @csrf
        <div class="col-6">
            <label for="dataInclusao" class="form-label">Data de inclusão:</label>
            <input type="text" class="form-control" id="dataInclusao" name="dataInclusao" disabled>
            <span class="text-danger" id="dataInclusao-error"></span>
        </div>
        <div class="col-6">
            <label for="nf" class="form-label">NF:</label>
            <input type="text" class="form-control" id="nf" name="nf" disabled>
            <span class="text-danger" id="nf-error"></span>
        </div>
        <!-- Clientes -->
        <div class="row mb-3 mt-4">
            <div class="col-12">
                <button type="button" class="btn btn-info" id="btn-selecionar-cliente">Selecionar cliente</button>
                <div class="modal fade" id="modal-clientes" tabindex="-1" role="dialog"
                    aria-labelledby="modal-clientes-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-clientes-label">Buscar cliente</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 d-flex align-items-end">
                                    <div class="flex-grow-1">
                                        <label for="nomeCpf" class="form-label">Buscar nome/CPF do cliente:</label>
                                        <input type="text" class="form-control" id="nomeCpf" name="nomeCpf">
                                    </div>
                                    <div>
                                        <button id="buscarCliente" class="btn btn-primary ms-2 align-self-start"
                                            type="button">Buscar</button>
                                    </div>
                                </div>
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabela-clientes">
                                        <!-- Aqui serão inseridos os clientes -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="nf" class="form-label">Nome do cliente:</label>
                        <input type="text" class="form-control" id="nome" name="nome"
                            placeholder="Nome do Cliente" disabled>
                    </div>
                    <div class="col-6">
                        <label for="cpf" class="form-label">Cliente - CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf"
                            placeholder="CPF do Cliente" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- Livros -->
        <div class="row mb-3 mt-4">
            <div class="col-12">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-info" id="btn-selecionar-livro">Selecionar livro</button>
                    </div>
                    <div class="col-md-auto">
                        Valor total da venda: <h4 class="text-success" id="valorTotal"></h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="produto" class="form-label">Produto:</label>
                        <input type="text" class="form-control" id="produto" name="produto" disabled>
                    </div>
                    <div class="col-md-2">
                        <label for="quantidade" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="1">
                    </div>
                    <div class="col-md-4">
                        <label for="valor_unitario" class="form-label">Valor Unitário:</label>
                        <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" disabled>
                    </div>
                </div>
                <div class="modal fade" id="modal-livros" tabindex="-1" role="dialog"
                    aria-labelledby="modal-livros-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-livros-label">Buscar livro</h4>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 d-flex align-items-end">
                                    <div class="flex-grow-1">
                                        <label for="codigo" class="form-label">Buscar código do livro:</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo">
                                    </div>
                                    <div>
                                        <button id="buscarLivro" class="btn btn-primary ms-2 align-self-start"
                                            type="button">Buscar</button>
                                    </div>
                                </div>
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Núm. Páginas</th>
                                            <th>Valor Unitário</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabela-livros">
                                        <!-- Aqui serão inseridos os livros -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unitário</th>
                                </tr>
                            </thead>
                            <tbody id="livros-selecionados">
                                <!-- Livros selecionados serão inseridos aqui -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-3 mt-4"></div>
                <div class="col-4 d-flex align-items-end justify-content-end">
                    <button type="submit" class="btn btn-success mx-2">Salvar</button>
                    <a href='{{ route('vendas.index') }}' class="btn btn-danger mx-2">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btn-selecionar-cliente').click(function() {
                $('#modal-clientes').modal('show');
                $.ajax({
                    url: '{{ route('api.clientes.index') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var clientes = response.clientes;
                        var tabelaClientes = $('#tabela-clientes');
                        tabelaClientes.empty();

                        $.each(clientes, function(index, cliente) {
                            var row = $('<tr>');
                            row.append($('<td>').text(cliente.nome));
                            row.append($('<td>').text(cliente.cpf));

                            var btnSelecionar = $('<button>')
                                .attr('id', 'btn-selecionar-' + cliente.id)
                                .attr('type', 'button')
                                .addClass('btn btn-success btn-sm')
                                .text('Selecionar')
                                .click(function(event) {
                                    event.preventDefault();
                                    $('#nome').val(cliente.nome);
                                    $('#cpf').val(cliente.cpf);
                                    $('#modal-clientes').modal('hide');
                                });

                            row.append($('<td>').append(btnSelecionar));
                            tabelaClientes.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar clientes:', error);
                    }
                });
            });

            $('#modal-clientes').on('click', '.btn-close', function() {
                $('#modal-clientes').modal('hide');
            });

            $('#buscarCliente').click(function() {
                var query = $('#nomeCpf').val();
                $.ajax({
                    url: '{{ route('api.clientes.busca') }}',
                    method: 'GET',
                    data: {
                        cliente: query
                    },
                    dataType: 'json',
                    success: function(response) {
                        var clientes = response.clientes;
                        var tabelaClientes = $('#tabela-clientes');
                        tabelaClientes.empty();

                        $.each(clientes, function(index, cliente) {
                            var row = $('<tr>');
                            row.append($('<td>').text(cliente.nome));
                            row.append($('<td>').text(cliente.cpf));

                            var btnSelecionar = $('<button>')
                                .attr('id', 'btn-selecionar-' + cliente.id)
                                .addClass('btn btn-success btn-sm')
                                .text('Selecionar')
                                .click(function(event) {
                                    event.preventDefault();
                                    $('#nome').val(cliente.nome);
                                    $('#cpf').val(cliente.cpf);
                                    $('#modal-clientes').modal('hide');
                                });

                            row.append($('<td>').append(btnSelecionar));
                            tabelaClientes.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar clientes:', error);
                    }
                });
            });

            $('#btn-selecionar-livro').click(function() {
                $('#modal-livros').modal('show');
                $.ajax({
                    url: '{{ route('api.livros.index') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var livros = response.livros;
                        var tabelaLivros = $('#tabela-livros');
                        tabelaLivros.empty();
                        $.each(livros, function(index, livro) {
                            var row = $('<tr>');
                            row.append($('<td>').text(livro.id));
                            row.append($('<td>').text(livro.descricao));
                            row.append($('<td>').text(livro.numeroPaginas));
                            row.append($('<td>').text(livro.valor));

                            var btnSelecionar = $('<button>')
                                .attr('id', 'btn-selecionar-' + livro.id)
                                .attr('type', 'button')
                                .addClass('btn btn-success btn-sm')
                                .text('Selecionar')
                                .click(function(event) {
                                    event.preventDefault();
                                    
                                    var livroJaSelecionado = false;
                                    $('#livros-selecionados tr').each(function() {
                                        if ($(this).find('td:first')
                                            .text() == livro.id) {
                                            livroJaSelecionado = true;
                                            return false;
                                        }
                                    });
                                    if (!livroJaSelecionado) {
                                        $('#produto').val(livro.descricao);
                                        $('#valor_unitario').val(livro.valor);
                                        var quantidade = $('#quantidade').val();
                                        var valorUnitario = livro.valor;
                                        var valorTotal = quantidade * valorUnitario;
                                        var livroRow = $('<tr>');
                                        livroRow.append($('<td>').text(livro
                                            .descricao));
                                        livroRow.append($('<td>').text(
                                            quantidade));
                                        livroRow.append($('<td>').text(
                                            valorUnitario));

                                        $('#livros-selecionados').append(livroRow);

                                        calcularValorTotal();
                                        $('#modal-livros').modal('hide');
                                    } else {
                                        alert('Este livro já foi selecionado.');
                                    }
                                });

                            row.append($('<td>').append(btnSelecionar));
                            tabelaLivros.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar livros:', error);
                    }
                });
            });

            $('#modal-livros').on('click', '.btn-close', function() {
                $('#modal-livros').modal('hide');
            });

            $('#buscarLivro').click(function() {
                var query = $('#codigo').val();
                $.ajax({
                    url: '{{ route('api.livros.busca') }}',
                    method: 'GET',
                    data: {
                        livro: query
                    },
                    dataType: 'json',
                    success: function(response) {
                        var livros = response.livros;
                        var tabelaLivros = $('#tabela-livros');
                        tabelaLivros.empty();
                        
                        $.each(livros, function(index, livro) {
                            var row = $('<tr>');
                            row.append($('<td>').text(livro.id));
                            row.append($('<td>').text(livro.descricao));
                            row.append($('<td>').text(livro.numeroPaginas));
                            row.append($('<td>').text(livro.valor));

                            var btnSelecionar = $('<button>')
                                .attr('id', 'btn-selecionar-' + livro.id)
                                .addClass('btn btn-success btn-sm')
                                .text('Selecionar');

                            row.append($('<td>').append(btnSelecionar));
                            tabelaLivros.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar livros:', error);
                    }
                });
            });

            function calcularValorTotal() {
                var valorTotal = 0;

                $('#livros-selecionados tr').each(function() {
                    var quantidade = parseInt($(this).find('td:nth-child(2)').text());
                    var valorUnitario = parseFloat($(this).find('td:nth-child(3)').text());
                    var subtotal = quantidade * valorUnitario;
                    valorTotal += subtotal;
                });
                $('#valorTotal').text('R$ ' + valorTotal.toFixed(2));
            }
        });
    </script>
@endsection
