<form action="{{ route('pesquisa') }}" method="GET">
    <div class="search-box">

        <input
            type="text"
            name="search"
            value = "{{ request('pesquisa') }}"
            placeholder="Buscar produtos, marcas e mais..."
        >

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass">🔍</i>
        </button>

    </div>
</form>