<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LDMcontroller;
use App\Models\Product;

Route::get('/', [LDMcontroller::class, 'index']);
Route::get('/pagina/detallsProducts', [LDMcontroller::class, 'detalls']);
Route::get('/pagina/add', [LDMcontroller::class, 'add']);
Route::post('/pagina/add', [LDMcontroller::class, 'store']);

Route::get('/produtos', function () {

    $pesquisa = request('search');

    $dados = Product::where('name', 'like', "%$pesquisa%")
        ->orWhere('marca', 'like', "%$pesquisa%")
        ->orWhere('description', 'like', "%$pesquisa%")
        ->orWhere('category', 'like', "%$pesquisa%")
        ->get();

    return view('welcome', compact('dados'));
})->name('produtos');





Route::get('/contato', function () {
   return view('contact');
});

#Route::get('/product/{id?}', function ($id = null) {
   # return view('product', ['id' => $id]);
#});

#route::get('/product/{id}', [LDMcontroller::class, 'show'])->name('product.show');


Route::get('/search', function () {
    $busca = request('search');
    return view('search', ['busca' => $busca]);
}); 