@extends('layouts.master')

@section('title', 'Editar Profissional')

@section('content')

<head>
    <!-- Outros links e metatags -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
    <section class="dad-div section" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="form-container">
            <h1>Editar Profissional</h1>

            <form action="{{ route('professionals.update', $professional->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $professional->name }}" placeholder="Digite o nome do profissional">
                </div>

                <div class="card">
                    <h5>Serviços Associados</h5>
                    @foreach($proServices as $proService)
                        <p>{{ $proService->name }}</p>
                    @endforeach
                </div>

                <div class="card">
                    <h5>Selecionar Novos Serviços</h5>
                    <select name="services[]" id="services" class="form-control select2" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ in_array($service->id, $professional->specializations) ? 'selected' : '' }}>
                                {{ $service->name }} - {{ $service->value }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
    
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Selecione os serviços",
                allowClear: true
            });
        });
    </script>
@endsection
