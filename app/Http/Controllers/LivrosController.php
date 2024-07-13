<?php

namespace App\Http\Controllers;

use App\Services\LivrosService;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    protected $livrosService;

    public function __construct(LivrosService $livrosService)
    {
        $this->livrosService = $livrosService;
    }

    public function show()
    {
        $livros = $this->livrosService->show();

        return response()->json(['livros' => $livros]);
    }

    public function buscaLivro(Request $request)
    {
        $livro = $this->livrosService->buscaLivro($request);

        return response()->json(['livro' => $livro]);
    }
}
