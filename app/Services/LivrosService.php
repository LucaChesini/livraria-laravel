<?php

namespace App\Services;

use App\Models\Livro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LivrosService
{
    public function show()
    {
        $livros = Livro::all();

        return $livros;
    }

    public function buscaLivro(Request $request)
    {
        $livro = Livro::find($request->livro);
        
        return ['livros' => $livro];
    }
}