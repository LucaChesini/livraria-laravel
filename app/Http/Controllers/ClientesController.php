<?php

namespace App\Http\Controllers;

use App\Services\ClientesService;
use Illuminate\Http\Request;

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
        $cliente = $this->clientesService->store($request);

        return response()->json(['cliente' => $cliente]);
    }

    public function buscaClientes(Request $request)
    {
        $clientes = $this->clientesService->buscaClientes($request);

        return response()->json(['clientes' => $clientes]);
    }
}
