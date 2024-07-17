@extends('includes.layout')
@section('pageTitle')
Clientes
@endsection

@section('content')
    <h1 class="my-3">Cadastro de Clientes</h1>
    <form id="form-cliente" class="row g-3" method="POST">
        @csrf
        <div class="col-12">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
            <span class="text-danger" id="nome-error"></span>
        </div>
        <div class="col-8">
            <label for="cpf" class="form-label">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf">
            <span class="text-danger" id="cpf-error"></span>
        </div>
        <div class="col-4">
            <label for="dataNascimento" class="form-label">Data de nascimento:</label>
            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
            <span class="text-danger" id="dataNascimento-error"></span>
        </div>
        <div class="col-5">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="number" class="form-control" id="telefone" name="telefone">
            <span class="text-danger" id="telefone-error"></span>
        </div>
        <div class="col-3"></div>
        <div class="col-4 d-flex align-items-end justify-content-end">
            <button type="submit" class="btn btn-success mx-2">Salvar</button>
            <a href='{{route("clientes.index")}}' class="btn btn-danger mx-2">Cancelar</a>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#form-cliente').submit(function(event) {
            event.preventDefault();
            $('.text-danger').html('');
            $.ajax({
                url: '{{ route("api.clientes.store") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#form-cliente')[0].reset();
                    window.location.href = "{{ route('clientes.index')}}";
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key + '-error').html("");
                        var lista = '<ul>';
                        $.each(value, function(index, error) {
                            lista += '<li>' + error + '</li>';
                        });
                        lista += '</ul>';
                        $('#' + key + '-error').html(lista);
                    });
                }
            });
        });
    })
</script>
@endsection