{{-- CONTEÚDO PRINCIPAL --}}
@php
    $emBusca = filled($pesquisa ?? null);
@endphp

<div class="search-layout {{ $emBusca ? 'has-filters' : 'without-filters' }}">


    {{-- SIDEBAR --}}
    @if($emBusca)
    <aside class="search-sidebar">

        <form action="{{ route('pesquisa') }}" method="GET">

            <input type="hidden" name="search" value="{{ $pesquisa }}">

        <div class="filter-section">

            <h3>Filtros</h3>

                <a href="{{ route('pesquisa', ['search' => $pesquisa]) }}"
               class="clear-filters">
                Limpar filtros
            </a>

        </div>


        <div class="filter-section">

            <h4>Categoria</h4>

            <div class="filter-list">
                @foreach($categorias as $categoria)
                    <label class="filter-option">
                        <input type="checkbox" name="categories[]" value="{{ $categoria->id }}"
                            @checked(in_array($categoria->id, (array) request('categories', [])))>
                        <span>{{ $categoria->name }}</span>
                    </label>
                @endforeach
            </div>

        </div>


        <div class="filter-section">

            <h4>Marca</h4>

            <div class="filter-list">
                @foreach($marcas as $marca)
                    <label class="filter-option">
                        <input type="checkbox" name="brands[]" value="{{ $marca->id }}"
                            @checked(in_array($marca->id, (array) request('brands', [])))>
                        <span>{{ $marca->name }}</span>
                    </label>
                @endforeach
            </div>

        </div>


        <div class="filter-section">

            <h4>Preço</h4>

            <div class="price-filter">

                <input
                    type="number"
                    name="min_price"
                    placeholder="Mínimo"
                    min="0"
                    step="0.01"
                    value="{{ request('min_price') }}"
                >

                <span>até</span>

                <input
                    type="number"
                    name="max_price"
                    placeholder="Máximo"
                    min="0"
                    step="0.01"
                    value="{{ request('max_price') }}"
                >

            </div>

        </div>


        <div class="filter-section">

            <h4>Disponibilidade</h4>

            <label class="filter-option">
                <input type="checkbox" name="in_stock" value="1" @checked(request()->boolean('in_stock'))>
                <span>Em estoque</span>
            </label>

        </div>

            <div class="filter-section">
                <button type="submit" class="search-product-button">Aplicar filtros</button>
            </div>

        </form>

    </aside>
    @endif


    {{-- PRODUTOS --}}
    <main class="search-results" id="produtos">


        {{-- BARRA DE RESULTADOS --}}
        <div class="results-toolbar">

            <div>

                <strong>
                    {{ $dados->count() }}
                </strong>

                @if($dados->count() == 1)
                    produto encontrado
                @else
                    produtos encontrados
                @endif

            </div>


            <div class="sort-box">

                <label for="ordenacao">
                    Ordenar:
                </label>

                <select id="ordenacao">

                    <option value="relevancia">
                        Mais relevantes
                    </option>

                    <option value="menor-preco">
                        Menor preço
                    </option>

                    <option value="maior-preco">
                        Maior preço
                    </option>

                </select>

            </div>

        </div>


        {{-- CASO NÃO ENCONTRE PRODUTOS --}}
        @if($dados->isEmpty())

            <section class="empty-search">

                <div class="empty-search-icon">
                    📦
                </div>

                <h2>
                    Nenhum produto encontrado
                </h2>

                <p>
                    Não encontramos produtos para
                    <strong>"{{ $pesquisa }}"</strong>.
                </p>

                <p>
                    Tente pesquisar por outro nome,
                    marca ou categoria.
                </p>

                <a href="{{ url('/') }}">
                    Voltar para a página inicial
                </a>

            </section>

        @else


            {{-- GRID --}}
            <div class="search-product-grid">

                @foreach($dados as $dado)

                    <article class="search-product-card">

                        @php
                            $imagemPrincipal = $dado->images->firstWhere('is_main', true) ?? $dado->images->first();
                        @endphp

                        {{-- IMAGEM --}}
                        <div class="search-product-image">

                            <img
                                src="{{ $imagemPrincipal ? asset('storage/'.$imagemPrincipal->image) : asset('img/toddy.jpg') }}"
                                alt="{{ $dado->name }}"
                            >

                        </div>


                        {{-- INFORMAÇÕES --}}
                        <div class="search-product-info">


                            {{-- CATEGORIA --}}
                            @if($dado->category)

                                <span class="search-product-category">
                                    {{ $dado->category->name }}
                                </span>

                            @endif


                            {{-- NOME --}}
                            <h2 class="search-product-name">

                                {{ $dado->name }}

                            </h2>


                            {{-- MARCA --}}
                            @if($dado->brand)

                                <p class="search-product-brand">

                                    Marca:

                                    <strong>
                                        {{ $dado->brand->name }}
                                    </strong>

                                </p>

                            @endif


                            {{-- DESCRIÇÃO --}}
                            @if($dado->description)

                                <p class="search-product-description">

                                    {{ $dado->description }}

                                </p>

                            @endif


                            {{-- ESTOQUE --}}
                            <div class="search-product-stock">

                                @if($dado->qty > 0)

                                    <span class="stock-available">
                                        Em estoque
                                    </span>

                                    <span>
                                        {{ $dado->qty }} unidades
                                    </span>

                                @else

                                    <span class="stock-unavailable">
                                        Produto indisponível
                                    </span>

                                @endif

                            </div>


                            {{-- BOTÃO --}}
                            <a
                                href="{{ url('/product/' . $dado->id) }}"
                                class="search-product-button"
                            >
                                Ver produto
                                <span>→</span>
                            </a>


                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </main>

</div>


{{-- ROLAGEM AUTOMÁTICA PARA OS RESULTADOS --}}
@if($emBusca)

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const produtos = document.getElementById('produtos');

            if (produtos) {

                produtos.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

            }

        });
    </script>

@endif