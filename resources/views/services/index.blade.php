<!-- resources/views/services/index.blade.php -->

@extends('layouts.master')

@section('title', 'Editar Serviço')

@section('content')
<section class="dad-div section">
        <div class="container">
    <h1>Lista de Serviços</h1>
    <a href="{{ route('services.create') }}">Novo Serviço</a>

    <ul>
        @foreach ($services as $service)
            <li>{{ $service->name }} - <a href="{{ route('services.edit', $service->id) }}">Editar</a> | 
                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
</section>
@endsection
