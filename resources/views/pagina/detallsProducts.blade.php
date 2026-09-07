@extends('layouts.main')

@section('title', 'Detalhes do Produto')

@section('content')
    <main>
        <section class="detail-shell">
            <p class="eyebrow">Experiência de compra</p>
            <h1>Detalhes do produto</h1>
            <p>Veja uma prévia visual do item selecionado no catálogo.</p>
            <img class="detail-image" src="/img/toddy.jpg" alt="Produto em destaque">
            <a class="primary-button" href="{{ url('/') }}">Voltar ao catálogo</a>
        </section>
    </main>
@endsection