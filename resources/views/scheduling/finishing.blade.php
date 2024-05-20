@extends('layouts.master')
@extends('layouts.get-status-form')


@section('title', 'Página Inicial')

@section('content')

    <!--==================== MAIN ====================-->
    <main class="main">
        <br>
        <!--==================== WHO ====================-->
        <section class="who section" id="who">
            <span class="section__subtitle">Agendado</span>
            <h2 class="section__title"> Tudo certo por aqui</h2>

            <p class="agenda__description">
                Seu horario já foi agendado. Com sucesso. Não se atrase!! Obrigado.
            </p>


            <h3 class="professional"><i class="ri-user-2-fill"></i> Profissional: {{ $professional->name }}</h3>
            @include('layouts.get-status-form')

            <div class="popular__container container grid">
                <article class="popular__card">
                    <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">
                    <h2 class="popular__name">{{ $service->name }}</h2>
                    <span class="popular__description">Corte apenas</span>
                    <span class="popular__price">R$ {{ $service->value }}</span>
                </article>
            </div>

            <br><br>
            <input type="hidden" name="pro" value="{{ $professional->id }}">
            <input type="hidden" name="service" value="{{ $service->id }}">

        </section>
    </main>

@endsection
