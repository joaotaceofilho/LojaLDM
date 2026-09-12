@extends('layouts.main')

@section('title', 'LDM')

@section('content')

<main class="catalog-container">

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif


    {{-- Cabeçalho do catálogo --}}
    
    @include('components.catalog-carousel')


    {{-- Produtos --}}
    @include('components.cart-itens')

</main>

@endsection

