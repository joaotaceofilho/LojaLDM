<form action="{{ route('produtos') }}" method="GET">
    <div class="search-box">

        <input
            type="text"
            name="search"
            placeholder="Buscar produtos, marcas e mais..."
        >

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

    </div>
</form>