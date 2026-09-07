@extends('layouts.main')

@section('title', 'Busca')

@section('content')
    <div class="container">
        <h2>Busca de Produtos</h2>
        <p>Resultados para: {{ $busca }}</p>
        
    </div>
@endsection