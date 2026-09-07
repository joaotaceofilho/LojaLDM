@extends('layouts.main')

@section('title', 'Home')

```blade
@section('content')

<main class="catalog-container">

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif


    {{-- Cabeçalho do catálogo --}}
    <section class="catalog-hero">

        <div class="catalog-hero-content">

            <span class="eyebrow">
                Catálogo LDM
            </span>

            <h1>
                Encontre o que você procura
            </h1>

            <p>
                Produtos selecionados para deixar sua compra
                mais simples, rápida e segura.
            </p>

        </div>

        <div class="catalog-hero-action">

            <a
                class="primary-button"
                href="{{ url('/pagina/add') }}"
            >
                + Adicionar produto
            </a>

        </div>

    </section>


    {{-- Produtos --}}
    @if($dados->isEmpty())

        <section class="empty-state">

            <div class="empty-icon">
                📦
            </div>

            <h2>
                Nenhum produto encontrado
            </h2>

            <p>
                Não encontramos produtos para esta busca.
            </p>

        </section>

    @else

        <section
            class="product-grid"
            aria-label="Lista de produtos"
        >

            @foreach($dados as $dado)

                <article class="produto-card">


                    {{-- =========================
                         CAIXA DA IMAGEM
                    ========================== --}}

                    <div class="produto-image-box">

                        <div class="produto-image">

                            <img
                                src="{{ asset('img/toddy.jpg') }}"
                                alt="{{ $dado->name }}"
                            >

                        </div>

                    </div>


                    {{-- =========================
                         INFORMAÇÕES DO PRODUTO
                    ========================== --}}

                    <div class="produto-content">

                        {{-- Categoria --}}
                        <span class="produto-category">
                            {{ $dado->category }}
                        </span>


                        {{-- Nome --}}
                        <h2 class="produto-name">
                            {{ $dado->name }}
                        </h2>


                        {{-- Descrição --}}
                        <p class="produto-description">
                            {{ $dado->description }}
                        </p>


                        {{-- Informações --}}
                        <div class="produto-info">

                            <div class="produto-info-item">

                                <span class="info-label">
                                    Estoque
                                </span>

                                <strong>
                                    {{ $dado->qty }}
                                </strong>

                            </div>


                            <div class="produto-info-item">

                                <span class="info-label">
                                    Marca
                                </span>

                                <strong>
                                    {{ $dado->marca }}
                                </strong>

                            </div>

                        </div>


                        {{-- Botão --}}
                        <a
                            class="produto-link"
                            href="{{ url('/product/' . $dado->id) }}"
                        >
                            Ver produto
                            <span>→</span>
                        </a>

                    </div>

                </article>

            @endforeach

        </section>

    @endif

</main>

@endsection
```
