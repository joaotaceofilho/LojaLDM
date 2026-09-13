<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained('product')
                ->cascadeOnDelete();

            /*
             * IDENTIFICAÇÃO
             */

            $table->string('name', 150)->nullable();

            $table->string('sku', 100)
                ->nullable()
                ->unique();


            /*
             * VENDA
             */
            $table->decimal('price', 10, 2)->nullable();

            $table->integer('qty')->default(0);


            /*
             * ATRIBUTOS
             *
             * Exemplos:
             *
             * {
             *     "cor": "Preto",
             *     "tamanho": "M"
             * }
             *
             * ou:
             * * {
             *     "cor": "Azul",
             *     "armazenamento": "256GB",
             *     "ram": "8GB"
             * }
             */

            $table->json('attributes')->nullable();

            $table->boolean('active')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
