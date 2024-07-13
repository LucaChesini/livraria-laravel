<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venda_livros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id')->nullable();
            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->unsignedBigInteger('livro_id')->nullable();
            $table->foreign('livro_id')->references('id')->on('livros');
            $table->decimal('valor_unitario', 8, 2);
            $table->integer('quantidade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venda_livros');
    }
};
