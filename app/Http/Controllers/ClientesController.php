<?php

namespace App\Http\Controllers;

use App\Services\ClientesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    protected $clientesService;

    public function __construct(ClientesService $clientesService)
    {
        $this->clientesService = $clientesService;
    }

    public function show()
    {
        $clientes = $this->clientesService->show();

        return response()->json(['clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nome" => "required",
            "cpf" => "required|unique:clientes,cpf",
            "telefone" => "required",
            "dataNascimento" => "required"

        ],[
            "nome.required" => "O campo nome deve ser preenchido",
            "cpf.required" => "O campo cpf deve ser preenchido",
            "cpf.unique" => "Esse cpf já está cadastrado",
            "telefone.required" => "O campo telefone deve ser preenchido",
            "dataNascimento.required" => "O campo data de nascimento deve ser preenchido",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cliente = $this->clientesService->store($request);

        return response()->json(['cliente' => $cliente]);
    }

    public function buscaClientes(Request $request)
    {
        $clientes = $this->clientesService->buscaClientes($request);

        return response()->json(['clientes' => $clientes]);
    }
}
