@extends('layouts.master')

@section('title', 'Novo Serviço')

@section('content')
<section class="dad-div section" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="form-container">
        <h1>Novo Serviço</h1>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="duration">Duração:</label>
                <input type="text" id="duration" name="duration" class="form-control">
            </div>
            <div class="form-group">
                <label for="value">Valor:</label>
                <input type="text" id="value" name="value" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</section>
@endsection
