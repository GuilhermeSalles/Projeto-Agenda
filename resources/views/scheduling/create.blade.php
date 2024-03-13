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
    <h2 class="section__title"> Selecione o serviço que deseja agendar</h2>


    <div class="container">

        <a href="{{ URL::previous() }}" class="button voltar">
        Voltar<i class="ri-arrow-left-line"></i>
        </a>

        <br><br>
        <hr>
        <br><br>

        <h1>{{ $professional->name }}</h1>

        <br>

        <div class="popular__container container grid">
            @foreach($services as $service)
                <article class="popular__card">

                    <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

                        <h3 class="popular__name">{{ $service->name }}</h3>
                        <span class="popular__description">Corte apenas</span>

                        <span class="popular__price">{{ $service->value }}</span>
                        
                        <br>
                        
                        <a href="{{ route('scheduling.create-select-service', [$professional->id, $service->id]) }}" class="popular__price">Selecionar</a>
                </article>
            @endforeach
        </div>

</div>


</section>

@endsection