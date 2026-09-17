<form action="{{ route('pesquisa') }}" method="GET">
    <div class="search-box">

        <input
            type="text"
            name="search"
            value = "{{ request('search') }}"
            placeholder="Buscar produtos, marcas e mais..."
        >

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"><img src="/img/lupa.png" alt="lupa"></i>
        </button>

    </div>
</form>