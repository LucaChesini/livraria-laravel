<?php

namespace Database\Seeders;

use App\Models\Livro;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivrosTableSeeder extends Seeder
{
    public function run()
    {
        $livros = [
            [
                'nome' => 'Livro A',
                'descricao' => 'Descrição do Livro A',
                'numeroPaginas' => 200,
                'valor' => 50.00,
                'dataPublicacao' => Carbon::now()->subDays(30),
            ],
            [
                'nome' => 'Livro B',
                'descricao' => 'Descrição do Livro B',
                'numeroPaginas' => 150,
                'valor' => 40.00,
                'dataPublicacao' => Carbon::now()->subDays(45),
            ],
            [
                'nome' => 'Livro C',
                'descricao' => 'Descrição do Livro C',
                'numeroPaginas' => 180,
                'valor' => 45.00,
                'dataPublicacao' => Carbon::now()->subDays(60),
            ],
            [
                'nome' => 'Livro D',
                'descricao' => 'Descrição do Livro D',
                'numeroPaginas' => 220,
                'valor' => 55.00,
                'dataPublicacao' => Carbon::now()->subDays(25),
            ],
            [
                'nome' => 'Livro E',
                'descricao' => 'Descrição do Livro E',
                'numeroPaginas' => 190,
                'valor' => 48.00,
                'dataPublicacao' => Carbon::now()->subDays(40),
            ],
        ];

        foreach ($livros as $livroData) {
            Livro::updateOrCreate(
                ['nome' => $livroData['nome']],
                $livroData
            );
        }
    }
}
