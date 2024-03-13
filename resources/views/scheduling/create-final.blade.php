@extends('layouts.master')
@extends('layouts.get-status-form')


@section('title', 'Página Inicial')

@section('content')
    <style>
        .scheduling-form{

        }


        .scheduling-form hr{
            display: block;
            margin: 20px 0px;
        }

        .scheduling-form, .scheduling-form input, .scheduling-form select{
            font-size: 2vw;
        }

        .scheduling-form .button{
            margin-top: 40px;
        }
    </style>


    <!--==================== WHO ====================-->
    <section class="who section" id="who">
    <span class="section__subtitle">Agendar</span>
    <h2 class="section__title"> Agora preencha os dados para marcar seu horario!!</h2>


    <div class="container">

        <a href="{{ URL::previous() }}" class="button voltar">
        Voltar<i class="ri-arrow-left-line"></i>
        </a>

        <br><br>
        <hr>
        <br><br>

        <h1>{{ $professional->name }}</h1>

        @include('layouts.get-status-form')

        <div class="popular__container container grid">
            <article class="popular__card">

                <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

                    <h3 class="popular__name">{{ $service->name }}</h3>
                    <span class="popular__description">Corte apenas</span>

                    <span class="popular__price">{{ $service->value }}</span>
                    
                    <br>
                    
                    <a href="{{ route('scheduling.create-select-service', [$professional->id, $service->id]) }}" href="#" class="popular__price">Selecionar</a>
            </article>
        </div>

        <br><br>

    <form class="scheduling-form" method="POST" action="{{ route('scheduling.store') }}">
        @csrf

        <input type="text" name="pro" value="{{ $professional->id }}">
        <input type="text" name="service" value="{{ $service->id }}">

        <label class="popular__name" for="name">Seu nome: </label>
        <input type="text" name="name" id="name" value="Natã Coimbra">
        <br> 
        <label class="popular__name" for="phone">Telefone: </label>
        <input type="text" name="phone" id="phone" value="(19) 98175-5678">

        <hr>

        <label class="popular__name" for="date">Data: </label>
        <input type="date" name="date" id="date" value="2024-04-01">


        <label class="popular__name" for="time">Horário: </label>
        <input type="time" name="time" id="time" value="13:00">

        <br>

        <input class="button" type="submit" value="Agendar">
    </form>
</div>


</section>

@endsection