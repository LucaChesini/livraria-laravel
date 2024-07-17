<?php

namespace App\Services;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesService
{
    public function show()
    {
        $clientes = Cliente::all();

        return $clientes;
    }

    public function store(array $data)
    {
        $dataNascimento = Carbon::createFromFormat('Y-m-d', $data['dataNascimento']);

        $cliente = new Cliente([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone'],
            'dataNascimento' => $dataNascimento->format('Y-m-d'),
        ]);

        $cliente->save();

        return $cliente;
    }

    public function buscaClientes(Request $request)
    {
        $clientes = Cliente::where(function($query) use ($request){
            $query->where('nome', 'like', "%{$request->cliente}%")
            ->orWhere('cpf', 'like', "%{$request->cliente}%");
        })->get();

        return $clientes;
    }
}