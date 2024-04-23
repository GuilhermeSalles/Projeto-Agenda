<!-- resources/views/services/edit.blade.php -->

@extends('layouts.master')

@section('title', 'Editar Serviço')

@section('content')

<section class="dad-div section">
        <div class="container">
    <h1>Editar Serviço</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $service->name }}" required>
        </div>
        <div>
            <label for="duration">Duração:</label>
            <input type="text" id="duration" name="duration" value="{{ $service->duration }}">
        </div>
        <div>
            <label for="value">Valor:</label>
            <input type="text" id="value" name="value" value="{{ $service->value }}">
        </div>
        <button type="submit">Salvar</button>
    </form>

</div>
</section>
@endsection
