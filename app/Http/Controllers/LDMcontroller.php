<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class LDMcontroller extends Controller
{
    public function index()
    {
        $dados = Product::all();
        return view('welcome',['dados' => $dados]);
    }


    public function add()
    {
        return view('pagina.add');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:100'],
            'qty' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'private' => ['required', 'boolean'],
        ]);

        Product::create($dados);

        return redirect('/')->with('success', 'Produto adicionado com sucesso.');
    }


    public function detalls()
    {
        return view('pagina.detallsProducts');
    }
}



