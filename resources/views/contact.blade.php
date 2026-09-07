@extends('layouts.main')

@section('title', 'Contato')

@push('styles')
    @vite('resources/css/contact.css')
@endpush

@section('content')
    <div class="container">
        <h2>Entre em Contato</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required placeholder="Seu nome">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required placeholder="seu@email.com">
            </div>

            <div class="form-group">
                <label for="assunto">Assunto</label>
                <input type="text" id="assunto" name="assunto" required placeholder="Motivo do contato">
            </div>

            <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" required placeholder="Escreva sua mensagem aqui..."></textarea>
            </div>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
@endsection