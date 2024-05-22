@extends('layouts.master')

@section('title', 'Detalhes do Profissional')

@section('content')
    <section class="dad-div section" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="container" style="max-width: 600px;">
            <h1 style="text-align: center; margin-bottom: 2rem;">Detalhes do Profissional</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nome: {{ $professional->name }}</h5>
                    <p class="card-text">ID: {{ $professional->id }}</p>
                    <!-- Adicione outros detalhes do profissional conforme necessário -->

                    <h5 class="card-title">Serviços Associados:</h5>
                    @foreach ($professional->services as $service)
                        <p class="card-text">{{ $service->name }}</p>
                    @endforeach

                    <div style="margin-top: 2rem;">
                        <a href="{{ route('admin.profissionais') }}" class="btn btn-primary">Voltar Profissionais</a>
                        <a href="{{ route('professionals.edit', $professional->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
