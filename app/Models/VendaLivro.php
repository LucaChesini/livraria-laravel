<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaLivro extends Model
{
    use HasFactory;

    protected $fillable = [
        'livro_id',
        'venda_id',
        'valor_unitario',
        'quantidade'
    ];
}
