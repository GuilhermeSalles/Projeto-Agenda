@extends('layouts.master')
@extends('layouts.get-status-form')


@section('title', 'Página Inicial')

@section('content')
    <style>
        .scheduling-form {}

        .scheduling-form hr {
            display: block;
            margin: 20px 0px;
        }

        /* Estilos personalizados */
        .scheduling-form form {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .scheduling-form form .form-group {
            margin-bottom: 20px;
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

        /* Estilo para todos os inputs */
        .scheduling-form input[type=text],
        .scheduling-form input[type=date],
        .scheduling-form select {
            padding: 11px 10px;
            font-size: 1.25rem;
            border: 2px var(--first-color) solid;
            border-radius: 5px;
            background: white;
            width: 100%;
            margin-top: 0.5rem;
            box-sizing: border-box;
            /* Garante que o padding não aumente a largura do input */
        }

        .scheduling-form input[type=text]:focus,
        .scheduling-form input[type=date]:focus,
        .scheduling-form select:focus {
            outline: none;
        }

        .scheduling-form label {
            font-size: 1.25rem;
            color: var(--title-color);
            margin-bottom: 0.5rem;
            display: block;
            text-align: center;
        }

        hr.style-eight {
            overflow: visible;
            /* For IE */
            padding: 0;
            border: none;
            border-top: medium double var(--title-color);
            color: var(--title-color);
            text-align: center;
        }

        hr.style-eight:after {
            content: "TG";
            display: inline-block;
            position: relative;
            top: -0.7em;
            font-size: 2.5em;
            padding: 0 0.25em;
            background: var(--first-color);
            color: white;
            border-radius: 30% 
        }
    </style>

    <!--==================== WHO ====================-->
    <section class="who section" id="who">
        <span class="section__subtitle">Agendar</span>
        <h2 class="section__title"> Agora preencha os dados para marcar seu horario!!</h2>

        <a href="{{ URL::previous() }}" class="button voltar">
            <i class="ri-arrow-left-line"></i>
        </a>
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

        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-6">
                    <form class="scheduling-form" method="POST" action="{{ route('scheduling.store') }}">
                        @csrf

                        <input type="hidden" name="pro" value="{{ $professional->id }}">
                        <input type="hidden" name="service" value="{{ $service->id }}">

                        <div class="coolinput">
                            <label for="">Nome</label>
                            <input type="text" name="name" id="name" placeholder="Escreva seu nome aqui!">
                        </div>
                        <br>
                        <div class="coolinput">
                            <label for="">Telefone</label>
                            <input type="text" name="phone" id="phone" placeholder="(xx)xxxxx-xxxx" value="">
                        </div>

                        <br>
                        <hr class="style-eight">

                        <?php

use Carbon\Carbon;
            ?>

                        <div class="coolinput">
                            <label for="">Data</label>
                            <input type="date" name="date" id="date" value="{{ Carbon::parse($date)->format('Y-m-d') }}">
                        </div>

                        <script>
    document.getElementById('date').addEventListener('change', function() {
        const date = this.value;
        const id = '<?php echo $id; ?>'; // Substitua pelo ID apropriado
        const service_id = '<?php echo $service_id; ?>'; // Substitua pelo ID do serviço apropriado

        const url = `/scheduling/create/${id}/service/${service_id}?date=${date}`;
        
        // Recarregar a página com a nova URL
        window.location.href = url;
    });
</script>



                        <div class="coolinput">
    <label for="">Horário </label>
    <?php
        // Crie um array associativo para mapear os horários dos agendamentos
        $schedulingTimes = [];
        foreach ($schedulings as $scheduling) {
            // Converta o formato "00:00:00" para "00:00"
            $formattedTime = substr($scheduling->time, 0, 5);
            $schedulingTimes[$formattedTime] = $formattedTime;

            // Obtenha a duração do serviço como um float
            $durationFloat = $scheduling->services->duration;
            $durationInt = (int)($durationFloat) - 1 ;
            
            $timesPerHour = $durationInt/60 ;
            

            $startedTime = $formattedTime;
            for($i = 0  ; $i < (($timesPerHour < 1) ? 1 : ceil($timesPerHour) + 1); $i++){
                $newTime = date('H:i', strtotime($startedTime . ' +  30 minutes'));
                $schedulingTimes[$newTime] = $newTime;
                $startedTime = $newTime;
            }

            $endTime = date('H:i', strtotime($formattedTime . ' + ' . $durationInt . ' minutes'));
            $schedulingTimes[$endTime] = $endTime;

            
        }

    ?>

    <style>
        .scheduling {
            color: red; /* Define a cor dos horários com agendamento */
        }
    </style>

    <select name="time" id="time">

    
        <?php
    
// Obter a data e hora atual na região de São Paulo
$now = Carbon::now('America/Sao_Paulo');
$now = Carbon::parse('2024-06-05 11:23:21');

// Arredondar a próxima hora com intervalos de 30 minutos no futuro
$roundedHour = $now->addMinutes(30 - ($now->minute % 30))->startOfHour();

        // Itere sobre as 24 horas do dia em intervalos de 30 minutos
        for ($hour = $roundedHour->hour; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 30) {
                // Formate a hora e os minutos como "HH:MM"
                $time = sprintf('%02d:%02d', $hour, $minute);

                // Verifique se há um agendamento para o horário atual
                if (isset($schedulingTimes[$time])) {
                    echo "<option value='$time' disabled>$time - agendado</option>";
                } else {
                    echo "<option value='$time'>$time</option>";
                }
            }
        }
        ?>
    </select>
    </div>


                        <div class="form-group text-center">
                            <button class="button" type="submit"> <i class="ri-calendar-check-line"></i>
                                Agendar</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
