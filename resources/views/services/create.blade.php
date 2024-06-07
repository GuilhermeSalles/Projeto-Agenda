@extends('layouts.master')

@section('title', 'Novo Serviço')

@section('content')
<section class="dad-div section" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="form-container">
        <h1>Novo Serviço</h1>

        <form action="{{ route('services.store') }}" method="POST" onsubmit="formatInput()">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="duration">Duração:</label>
                <select id="duration" name="duration" class="form-control">
                    <option value="30">30 Minutos</option>
                    <option value="60">1 hora</option>
                    <option value="90">1 Hora 30 Minutos</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Valor:</label>
                <input type="text" id="value" name="value" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</section>

<script>
    function formatInput() {
        var valueInput = document.getElementById("value");
        // Substituir vírgula por ponto
        valueInput.value = valueInput.value.replace(',', '.');
    }
</script>
@endsection
