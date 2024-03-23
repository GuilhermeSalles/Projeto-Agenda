@extends('layouts.master')

@section('title', 'Editar Profissional')

@section('content')
    <section class="dad-div section">
        <div class="container">
            <h1>Editar Profissional</h1>
            <form action="{{ route('professionals.update', $professional->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $professional->name }}" placeholder="Digite o nome do profissional">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </section>
@endsection
