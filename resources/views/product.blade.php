@extends('layouts.main')

@section('title', 'Produto')

@section('content')
    <main>
        @if($id != null)
            <section class="detail-shell">
                <p class="eyebrow">Produto selecionado</p>
                <h1>Detalhes do produto</h1>
                <p>Informações sobre o produto de código <strong>#{{ $id }}</strong>.</p>
                <img class="detail-image" src="/img/toddy.jpg" alt="Imagem do produto">
                <a class="primary-button" href="{{ url('/') }}">Voltar ao catálogo</a>
            </section>
        
    @else
            <section class="empty-state">
                Produto não encontrado. Por favor, forneça um ID de produto válido.
            </section>
    @endif
    </main>
@endsection