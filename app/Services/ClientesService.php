<?php

namespace App\Services;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientesService
{
    public function show()
    {
        $clientes = Cliente::all();

        return $clientes;
    }

    public function store(Request $request)
    {
        $data = Carbon::createFromFormat('d/m/Y', $request->dataNascimento);

        $cliente = new Cliente([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dataNascimento' => $data->format('Y-m-d'),
        ]);

        $cliente->save();

        return $cliente;
    }
}