<div class="header-actions">

    <a
        class="header-promo"
        href="{{ route('pesquisa', ['search' => 'Roupas']) }}"
        aria-label="Ver produtos de roupas"
    >
        <img
            src="{{ asset('img/michele1.png') }}"
            alt="Ver produtos de roupas"
        >
    </a>

    <details class="mobile-menu">
        <summary aria-label="Abrir menu de categorias">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
        </summary>
        <div class="mobile-menu-panel">
            <strong>Categorias</strong>
            <a href="{{ route('pesquisa', ['search' => 'Roupas']) }}">Roupas</a>
            <a href="{{ route('pesquisa', ['search' => 'Acessórios de celular']) }}">Acessórios de celular</a>
            <a href="{{ route('pesquisa', ['search' => 'Papelaria']) }}">Papelaria</a>
        </div>
    </details>

    <a href="#" class="action-item action-cart mobile-cart" aria-label="Carrinho">
        <img src="{{ asset('img/carrinho.png') }}" alt="Carrinho">
        <span class="badge">3</span>
    </a>

</div>