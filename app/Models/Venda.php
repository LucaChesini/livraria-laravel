<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'valor_total'
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'venda_livros', 'venda_id', 'livro_id')
                ->withPivot('valor_unitario', 'quantidade');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
