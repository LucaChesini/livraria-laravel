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
        $data = $request->all();
        $data['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
        $validator = Validator::make( $data, [
            "nome" => "required",
            "cpf" => "required|min:11|max:11|unique:clientes,cpf",
            "telefone" => "required",
            "dataNascimento" => "required"

        ],[
            "nome.required" => "O campo nome deve ser preenchido",
            "cpf.required" => "O campo cpf deve ser preenchido",
            "cpf.min" => "O campo cpf deve possuir 11 dígitos",
            "cpf.max" => "O campo cpf deve possuir 11 dígitos",
            "cpf.unique" => "Esse cpf já está cadastrado",
            "telefone.required" => "O campo telefone deve ser preenchido",
            "dataNascimento.required" => "O campo data de nascimento deve ser preenchido",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cliente = $this->clientesService->store($data);

        return response()->json(['cliente' => $cliente]);
    }

    public function buscaClientes(Request $request)
    {
        $clientes = $this->clientesService->buscaClientes($request);

        return response()->json(['clientes' => $clientes]);
    }
}
