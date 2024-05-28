@extends('layouts.master')
@extends('layouts.get-status-form')


@section('title', 'Página Inicial')

@section('content')
    <style>
        .scheduling-form hr {
            display: block;
            margin: 20px 0px;
        }

        .scheduling-form,
        .scheduling-form input,
        .scheduling-form select {
            font-size: 2vw;
        }

        .scheduling-form .button {
            margin-top: 40px;
        }

        .professional {
            text-align: center;
        }

        .voltar {
            padding: 1rem;
            margin-left: 1.25rem;
        }
    </style>


    <!--==================== WHO ====================-->
    <section class="who section">
        <span class="section__subtitle">Agendar</span>
        <h2 class="section__title"> Selecione o serviço que deseja agendar</h2>

        <a href="{{ URL::previous() }}" class="button voltar">
            <i class="ri-arrow-left-line"></i>
        </a>

        <h3 class="professional"><i class="ri-user-2-fill"></i> Profissional: {{ $professional->name }}</h3>


        <br><br>
        <hr>
        <br><br>

        <br>

        <div class="popular__container container grid">
            @foreach ($services as $service)
                <article class="popular__card">

                    <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

                    <h3 class="popular__name">{{ $service->name }}</h3>
                    <span class="popular__description">Corte apenas</span>

                    <span class="popular__price">R$ {{ $service->value }}</span>

                    <br>

                    <a href="{{ route('scheduling.create-select-service', [$professional->id, $service->id]) }}"
                        class="button agendar">Selecionar</a>


                </article>
            @endforeach
        </div>



    </section>

@endsection
