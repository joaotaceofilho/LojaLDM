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

        {{-- Categoria principal --}}
        <div class="form-group">
            <label for="category_id">Categoria</label>

            <select id="category_id" name="category_id" required>

                <option value="">
                    Selecione uma categoria
                </option>

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        {{ old('category_id', old('parent_category_id')) == $categoria->id ? 'selected' : '' }}
                    >
                        {{ $categoria->name }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- Subcategoria --}}
        <div class="form-group">
            <label for="subcategory_id">Subcategoria</label>

            <select id="subcategory_id" name="subcategory_id" disabled>

                <option value="">
                    Selecione uma subcategoria (opcional)
                </option>

                @foreach($categorias as $categoria)
                    @foreach($categoria->children->sortBy('name') as $subcategoria)
                        <option
                            value="{{ $subcategoria->id }}"
                            data-parent="{{ $categoria->id }}"
                            {{ old('subcategory_id') == $subcategoria->id ? 'selected' : '' }}
                        >
                            {{ $subcategoria->name }}
                        </option>
                    @endforeach
                @endforeach

            </select>

            <small class="subcategory-hint">Escolha uma categoria para ver as opções disponíveis.</small>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
        const hint = document.querySelector('.subcategory-hint');

        function updateSubcategories() {
            const categoryId = categorySelect.value;
            let hasOptions = false;

            Array.from(subcategorySelect.options).forEach(function (option, index) {
                if (index === 0) {
                    option.hidden = false;
                    return;
                }

                const belongsToCategory = option.dataset.parent === categoryId;
                option.hidden = !belongsToCategory;
                hasOptions = hasOptions || belongsToCategory;
            });

            subcategorySelect.disabled = !categoryId || !hasOptions;

            if (!hasOptions) {
                subcategorySelect.value = '';
            }

            hint.textContent = hasOptions
                ? 'Selecione uma subcategoria, se aplicável.'
                : 'Esta categoria não possui subcategorias.';
        }

        categorySelect.addEventListener('change', updateSubcategories);
        updateSubcategories();
    });
</script>

@endsection
