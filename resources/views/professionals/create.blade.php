@extends('layouts.master')

@section('title', 'Novo Profissional')

@section('content')
    <section class="dad-div section">
        <div class="container">
            <h1>Criar Novo Profissional</h1>
            <form action="{{ route('professionals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Digite o nome do profissional">
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
            </form>
        </div>
    </section>
@endsection
