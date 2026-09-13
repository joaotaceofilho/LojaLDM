<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LDMcontroller;
use App\Models\Product;

Route::get('/', [LDMcontroller::class, 'index']);
Route::get('/pagina/detallsProducts', [LDMcontroller::class, 'detalls']);
Route::get('/product/{product}', [LDMcontroller::class, 'detalls'])->name('product.show');
Route::get('/pagina/add', [LDMcontroller::class, 'add']);
Route::post('/pagina/add', [LDMcontroller::class, 'store']);

Route::get('/pesquisa', function () {

    $pesquisa = request('search');

    $dados = Product::with(['category', 'brand', 'images'])
        ->where(function ($query) use ($pesquisa) {

            $query->where('name', 'like', "%{$pesquisa}%")
                ->orWhere('description', 'like', "%{$pesquisa}%")
                ->orWhere('sku', 'like', "%{$pesquisa}%")

                ->orWhereHas('brand', function ($query) use ($pesquisa) {
                    $query->where('name', 'like', "%{$pesquisa}%");
                })

                ->orWhereHas('category', function ($query) use ($pesquisa) {
                    $query->where('name', 'like', "%{$pesquisa}%");
                });

        })
        ->where('active', true)
        ->get();

    return view('welcome', [
        'pesquisa' => $pesquisa,
        'dados' => $dados
    ]);

})->name('pesquisa');





Route::get('/contato', function () {
   return view('contact');
});

Route::get('/search', function () {
    $busca = request('search');
    return view('search', ['busca' => $busca]);
}); 