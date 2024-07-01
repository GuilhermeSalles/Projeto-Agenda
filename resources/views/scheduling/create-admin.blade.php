@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'DashBoard')

@section('content')

    <div class="container">
        <div class="section">
            <div class="content">
                <h2>Serviços</h2>
            </div>
        </div>
    </div>
    <!--==================== WHO ====================-->


    <div class="popular__container container" style="display: flex; flex-direction: column; align-items: center; margin-bottom:9rem;">
        @foreach ($services as $service)
            <article class="popular__card"
                style="width: 100%; max-width: 600px; text-align: center; margin: 10px 0; padding: 20px;">
                <h3 class="popular__name">{{ $service->name }}</h3>
                <span class="popular__description">{{ $service->description }}</span>
                <span class="popular__price">R$ {{ $service->value }}</span>
                <br>
                <a href="{{ route('scheduling.admin.create-select-service', [$professional->id, $service->id]) }}"
                    class="button agendar">Selecionar</a>
            </article>
        @endforeach
    </div>

@endsection
