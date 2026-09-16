@extends('layouts.main')

@section('title', 'Categorias')

@section('content')

<main>
    <section class="form-shell">
        <p class="eyebrow">Área do vendedor</p>
        <h1>Adicionar categoria</h1>
        <p class="form-intro">Cadastre uma categoria principal ou escolha uma categoria pai para criar uma subcategoria.</p>

        @if(session('success'))
            <div class="form-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="form-errors" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="product-form" action="{{ url('/pagina/categorias') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="parent_id">Categoria pai</label>
                <select id="parent_id" name="parent_id">
                    <option value="">Nenhuma, criar categoria principal</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('parent_id') == $categoria->id)>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-actions">
                <a class="secondary-button" href="{{ url('/') }}">Cancelar</a>
                <button class="primary-button" type="submit">Salvar categoria</button>
            </div>
        </form>

        @if($categorias->isNotEmpty())
            <div class="category-tree">
                <h2>Categorias cadastradas</h2>
                @foreach($categorias as $categoria)
                    <p><strong>{{ $categoria->name }}</strong></p>
                    @foreach($categoria->children->sortBy('name') as $subcategoria)
                        <p class="subcategory-item">— {{ $subcategoria->name }}</p>
                    @endforeach
                @endforeach
            </div>
        @endif
    </section>
</main>

@endsection