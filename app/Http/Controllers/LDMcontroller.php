<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LDMcontroller extends Controller
{
    public function index()
    {
        $dados = Product::with(['category', 'brand', 'images'])->get();

        return view('welcome', [
            'dados' => $dados,
            'pesquisa' => null,
        ]);
    }

    public function add()
    {
        $marcas = Brand::all();
        $categorias = Category::all();

        return view('pagina.add', compact('marcas', 'categorias'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'qty' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'private' => ['required', 'boolean'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['file', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ]);

        $dados['slug'] = Str::slug($dados['name']).'-'.Str::lower(Str::random(6));

        $images = $request->file('images', []);

        DB::transaction(function () use ($dados, $images): void {
            $product = Product::create($dados);

            foreach ($images as $position => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image->store('products/'.$product->id, 'public'),
                    'is_main' => $position === 0,
                    'position' => $position,
                ]);
            }
        });

        return redirect('/')->with(
            'success',
            'Produto adicionado com sucesso.'
        );
    }

    public function detalls(?Product $product = null)
    {
        $product ??= Product::query()->where('active', true)->firstOrFail();

        $product->load([
            'category',
            'brand',
            'images' => fn ($query) => $query
                ->orderByDesc('is_main')
                ->orderBy('position'),
        ]);

        $relatedProducts = Product::with(['category', 'brand', 'images'])
            ->where('active', true)
            ->whereKeyNot($product->getKey())
            ->when($product->category_id, function ($query) use ($product) {
                $query->where('category_id', $product->category_id);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('pagina.detallsProducts', compact('product', 'relatedProducts'));
    }
}