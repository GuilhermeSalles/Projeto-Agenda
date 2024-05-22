@extends('layouts.master')

@section('title', 'Editar Serviço')

@section('content')

<section class="dad-div section" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="form-container">
        <h1>Editar Serviço</h1>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}" required>
            </div>
            <div class="form-group">
                <label for="duration">Duração:</label>
                <input type="text" id="duration" name="duration" class="form-control" value="{{ $service->duration }}">
            </div>
            <div class="form-group">
                <label for="value">Valor:</label>
                <input type="text" id="value" name="value" class="form-control" value="{{ $service->value }}">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</section>
@endsection
