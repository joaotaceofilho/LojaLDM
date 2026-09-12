



    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="search-layout">


        {{-- SIDEBAR --}}
        <aside class="search-sidebar">

            <div class="filter-section">

                <h3>Filtros</h3>

                <a href="{{ route('pesquisa', ['search' => $dados]) }}"
                   class="clear-filters">
                    Limpar filtros
                </a>

            </div>


            <div class="filter-section">

                <h4>Categoria</h4>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Eletrônicos</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Roupas</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Alimentos</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Casa</span>
                </label>

            </div>


            <div class="filter-section">

                <h4>Marca</h4>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Samsung</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Apple</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>LG</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Outras</span>
                </label>

            </div>


            <div class="filter-section">

                <h4>Preço</h4>

                <div class="price-filter">

                    <input
                        type="number"
                        placeholder="Mínimo"
                        min="0"
                    >

                    <span>até</span>

                    <input
                        type="number"
                        placeholder="Máximo"
                        min="0"
                    >

                </div>

            </div>


            <div class="filter-section">

                <h4>Disponibilidade</h4>

                <label class="filter-option">
                    <input type="checkbox">
                    <span>Em estoque</span>
                </label>

            </div>

        </aside>


        {{-- PRODUTOS --}}
        <main class="search-results">


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
                        <strong>"{{ $busca }}"</strong>.
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


                            {{-- IMAGEM --}}
                            <div class="search-product-image">

                                <img
                                    src="{{ asset('img/toddy.jpg') }}"
                                    alt="{{ $dado->name }}"
                                >

                            </div>


                            {{-- INFORMAÇÕES --}}
                            <div class="search-product-info">


                                {{-- CATEGORIA --}}
                                @if($dado->category)

                                    <span class="search-product-category">
                                        {{ $dado->category }}
                                    </span>

                                @endif


                                {{-- NOME --}}
                                <h2 class="search-product-name">

                                    {{ $dado->name }}

                                </h2>


                                {{-- MARCA --}}
                                @if($dado->marca)

                                    <p class="search-product-brand">

                                        Marca:
                                        <strong>
                                            {{ $dado->marca }}
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

</div>

