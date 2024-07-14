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

    public function store(Request $request)
    {
        $data = Carbon::createFromFormat('Y-m-d', $request->dataNascimento);

        $cliente = new Cliente([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dataNascimento' => $data->format('Y-m-d'),
        ]);

        $cliente->save();

        return $cliente;
    }

    public function buscaClientes(Request $request)
    {
        $clientes = Cliente::where(function($query) use ($request){
            $query->where('nome', 'like', "%{$request->cliente}%")
            ->orWhere('cpf', $request->cliente);
        })->get();

        return $clientes;
    }
}