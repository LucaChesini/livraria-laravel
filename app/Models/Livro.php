<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'venda_livros', 'livro_id', 'venda_id')
                ->withPivot('valor_unitario', 'quantidade');
    }
}
