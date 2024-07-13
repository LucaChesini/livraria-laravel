<?php

namespace App\Http\Controllers;

use App\Services\VendasService;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    protected $vendasService;

    public function __construct(VendasService $vendasService)
    {
        $this->vendasService = $vendasService;
    }

    public function show()
    {
        $vendas = $this->vendasService->show();

        return response()->json(['vendas' => $vendas]);
    }

    public function buscaVenda(Request $request)
    {
        $vendas = $this->vendasService->buscaVenda($request);

        return response()->json(['vendas' => $vendas]);
    }

    public function store(Request $request)
    {
        $venda = $this->vendasService->store($request);

        return response()->json(['venda' => $venda]);
    }
}
