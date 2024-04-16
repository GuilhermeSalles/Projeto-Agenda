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

        </section>
    </main>

@endsection
