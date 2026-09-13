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

        Schema::create('product', function (Blueprint $table) {

            $table->id();

            /*
             * RELACIONAMENTOS
             */

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->nullOnDelete();


            /*
             * INFORMAÇÕES DO PRODUTO
             */

            $table->string('name', 150);

            $table->string('slug', 180)->unique();

            $table->text('description')->nullable();


            /*
             * VENDA
             */

            $table->decimal('price', 10, 2);

            $table->integer('qty')->default(0);

            $table->string('sku', 100)
                ->nullable()
                ->unique();

            /*
             * CONTROLE
             */

            $table->boolean('private')->default(false);

            $table->boolean('active')->default(true);

            $table->timestamps();

        });

    /**---------------------------------------------------------------------- */
       /* Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('marca', 100);
            $table->integer('qty');
            $table->text('description');
            $table->string('category', 100);
            $table->boolean("private");
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
