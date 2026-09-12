@extends('layouts.main')

@section('title', 'area do vendedor')

@section('content')
    <main>
        <section class="form-shell">
            <p class="eyebrow">Área do vendedor</p>
            <h1>Adicionar produto</h1>
            <p class="form-intro">Cadastre as informações do produto para exibi-lo no catálogo.</p>

            <form class="product-form" action="{{ url('/pagina/add') }}" method="POST">

                @csrf

                <input type="hidden" name="private" value="0">

                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" required>
                </div>

                <div class="form-group">
                    <label for="qty">Quantidade em estoque</label>
                    <input type="number" id="qty" name="qty" min="0" required>
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select id="category" name="category" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="Alimentos">Alimentos</option>
                        <option value="Bebidas">Bebidas</option>
                        <option value="Eletrônicos">Eletrônicos</option>
                        <option value="Roupas">Roupas</option>
                        <option value="Higiene">Higiene</option>
                        <option value="Papelaria">Papelaria</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>

                <div class="form-actions">
                    <a class="secondary-button" href="{{ url('/') }}">Cancelar</a>
                    <button class="primary-button" type="submit">Publicar produto</button>
                </div>

            </form>
        </section>
    </main>



@endsection