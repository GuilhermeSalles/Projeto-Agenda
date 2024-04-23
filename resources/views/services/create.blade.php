<!-- resources/views/services/create.blade.php -->

@extends('layouts.master')

@section('title', 'Novo Serviço')

@section('content')
<section class="dad-div section">
        <div class="container">
    <h1>Novo Serviço</h1>

    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="duration">Duração:</label>
            <input type="text" id="duration" name="duration">
        </div>
        <div>
            <label for="value">Valor:</label>
            <input type="text" id="value" name="value">
        </div>
        <button type="submit">Salvar</button>
    </form>
</div>
</section>
@endsection
