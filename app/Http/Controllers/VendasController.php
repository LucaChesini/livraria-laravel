<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Livro;
use App\Models\Venda;
use App\Models\VendaLivro;
use App\Services\VendasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            "nome" => "required",
            "cpf" => "required",
            "produto" => "required",
        ],[
            "nome.required" => "O campo nome deve ser preenchido",
            "cpf.required" => "O campo cpf deve ser preenchido",
            "produto.required" => "O campo produto deve ser preenchido",
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $livros = json_decode($request->livros, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Formato inválido para livros.'], 400);
        }

        $venda = $this->criarVenda($request, $livros);
        $this->criarLivrosVendidos($livros, $venda);

        return response()->json(['venda' => $venda]);
    }

    public function criarVenda($request, $livros)
    {
        $cliente = $this->obterCliente($request);
        $valorTotal = $this->calcularValorTotal($livros);
        
        $venda = Venda::firstOrCreate([
            'cliente_id' => $cliente->id,
            'valor_total' => $valorTotal
        ]);

        return $venda;
    }

    public function obterCliente($request)
    {
        return Cliente::where('cpf', $request->cpf)->first();
    }

    public function calcularValorTotal($livros)
    {
        $valorTotal = 0;

        foreach ($livros as $livro) {
            $valorTotal += $livro['valor_unitario'] * $livro['quantidade'];
        }

        return $valorTotal;
    }

    public function criarLivrosVendidos($livros, $venda)
    {
        foreach ($livros as $livro) {
            VendaLivro::firstOrCreate([
               'venda_id' => $venda->id,
               'livro_id' => $this->obterIdLivro($livro),
               'valor_unitario' => $livro['valor_unitario'],
               'quantidade' => $livro['quantidade']
            ]);
        }
    }

    public function obterIdLivro($livro)
    {
        return Livro::where('descricao', $livro['descricao'])->value('id');
    }
}
