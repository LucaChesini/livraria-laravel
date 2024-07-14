@extends('includes.layout')

@section('pageTitle')
Inicial
@endsection

@section('content')
    <div>
        <h1>Inicio</h1>
    </div>
    <div class='d-flex justify-content-evenly'>
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h2 class='card-title'>Clientes</h2>
                <p class='card-text'>Página de listagem de clientes</p>
                <a href='{{route('clientes.index')}}' class='btn btn-primary'>Acessar</a>
            </div>
        </div>
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h2 class='card-title'>Vendas</h2>
                <p class='card-text'>Página de listagem de vendas</p>
                <a href='#' class='btn btn-primary'>Acessar</a>
            </div>
        </div>
    </div>
@endsection