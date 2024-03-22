@extends('layouts.master')

@section('title', 'Detalhes do Profissional')

@section('content')
    <section class="dad-div section">
        <div class="container">
            <h1>Detalhes do Profissional</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nome: {{ $professional->name }}</h5>
                    <p class="card-text">ID: {{ $professional->id }}</p>
                    <!-- Adicione outros detalhes do profissional conforme necessário -->
                </div>
            </div>
            <a href="{{ route('professionals.edit', $professional->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </section>
@endsection
