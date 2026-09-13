@extends('layouts.main')

@section('title', 'Área do vendedor')

@section('content')

<main>
    <section class="form-shell">

    <p class="eyebrow">Área do vendedor</p>

    <h1>Adicionar produto</h1>

    <p class="form-intro">
        Cadastre as informações do produto para exibi-lo no catálogo.
    </p>

    <form class="product-form"
          action="{{ url('/pagina/add') }}"
            method="POST"
            enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="private" value="0">

        {{-- Nome --}}
        <div class="form-group">
            <label for="name">Nome do produto</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        {{-- Marca --}}
        <div class="form-group">
            <label for="brand_id">Marca</label>

            <select id="brand_id" name="brand_id" required>

                <option value="">
                    Selecione uma marca
                </option>

                @foreach($marcas as $marca)

                    <option
                        value="{{ $marca->id }}"
                        {{ old('brand_id') == $marca->id ? 'selected' : '' }}
                    >
                        {{ $marca->name }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- Preço --}}
        <div class="form-group">
            <label for="price">Preço</label>

            <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price') }}"
                min="0"
                step="0.01"
                required
            >
        </div>

        {{-- Quantidade --}}
        <div class="form-group">
            <label for="qty">Quantidade em estoque</label>

            <input
                type="number"
                id="qty"
                name="qty"
                value="{{ old('qty') }}"
                min="0"
                required
            >
        </div>

        {{-- Descrição --}}
        <div class="form-group">
            <label for="description">Descrição</label>

            <textarea
                id="description"
                name="description"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Categoria --}}
        <div class="form-group">
            <label for="category_id">Categoria</label>

            <select id="category_id" name="category_id" required>

                <option value="">
                    Selecione uma categoria
                </option>

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        {{ old('category_id') == $categoria->id ? 'selected' : '' }}
                    >
                        {{ $categoria->name }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- Imagens --}}
        <div class="form-group">
            <label for="images">Imagens do produto</label>

            <input
                type="file"
                id="images"
                name="images[]"
                accept="image/jpeg,image/png,image/webp"
                multiple
            >

            <small>Envie até 10 imagens. A primeira será a imagem principal.</small>
        </div>

        @if($errors->any())
            <div class="form-errors" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Botões --}}
        <div class="form-actions">

            <a
                class="secondary-button"
                href="{{ url('/') }}"
            >
                Cancelar
            </a>

            <button
                class="primary-button"
                type="submit"
            >
                Publicar produto
            </button>

        </div>

    </form>

</section>

</main>

@endsection
