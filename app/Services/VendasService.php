<?php

namespace App\Services;

use App\Models\Livro;
use App\Models\Venda;
use App\Models\VendaLivro;
use Illuminate\Http\Request;

class VendasService
{
    public function show()
    {
        $vendas = Venda::with('livros')->with('cliente')->get();

        return $vendas;
    }

    public function buscaVenda(Request $request)
    {
        $venda = Venda::where(function ($query) use ($request) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->venda . '%');
            })
            ->orWhereHas('livros', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->venda . '%');
            });
        })
        ->with(['cliente', 'livros'])
        ->get();

        return $venda;
    }

    public function store(Request $request)
    {
        $venda = new Venda([
            'cliente_id' => $request->cliente_id,
            'valor_total' => 0
        ]);

        $valorTotal = 0;
        $livrosVenda = [];

        foreach ($request->livros as $item) {
            $livro = Livro::find($item['id']);
            $quantidade = $item['quantidade'];
            $valorUnitario = $livro->valor;

            $valorTotal += $valorUnitario * $quantidade;

            $livrosVenda[] = [
                'livro_id' => $livro->id,
                'quantidade' => $quantidade,
                'valor_unitario' => $valorUnitario,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $venda->save();

        $venda->livros()->attach($livrosVenda);

        $venda->valor_total = $valorTotal;
        $venda->save();

        return $venda;
    }
}