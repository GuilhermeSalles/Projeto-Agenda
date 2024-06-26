@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'DashBoard')


@section('content')


    <!--==================== WHO ====================-->
    <section class="who section">


        <div class="popular__container container grid">
            @foreach ($services as $service)
                <article class="popular__card">
                    <h3 class="popular__name">{{ $service->name }}</h3>
                    <span class="popular__description">{{ $service->description}}</span>

                    <span class="popular__price">R$ {{ $service->value }}</span>

                    <br>

                    <a href="{{ route('scheduling.admin.create-select-service', [$professional->id, $service->id]) }}"
                        class="button agendar">Selecionar</a>


                </article>
            @endforeach
        </div>



    </section>

@endsection
