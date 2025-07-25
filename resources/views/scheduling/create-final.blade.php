@extends('layouts.master')
@extends('layouts.get-status-form')

@section('title', 'Página Inicial')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            margin-left: 1.5rem;
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
            font-size: 1.5em;
            padding: 0 0.2em;
            background: var(--first-color);
            color: white;
            border-radius: 30%
        }

        .coolinput {
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
        }

        .flatpickr-day.disabled-day {
            background-color: #ffcccc !important;
            /* Fundo vermelho */
            color: black !important;
            /* Texto preto */
            pointer-events: none;
            /* Evita interações */
            cursor: not-allowed;
            /* Muda o cursor para indicar que é desativado */
        }
    </style>

    <!--==================== WHO ====================-->
    <section class="who section" id="who">
        <span class="section__subtitle">Agendar</span>
        <h2 class="section__title">Agora preencha os dados para marcar seu horário!!</h2>

        <a href="{{ URL::previous() }}" class="button voltar">
            <i class="ri-arrow-left-line"></i>
        </a>
        <h3 class="professional"><i class="ri-user-2-fill"></i> Profissional: {{ $professional->name }}</h3>
        @include('layouts.get-status-form')

        <div class="popular__container container centerH">
            <article class="popular__card">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">
                <h2 class="popular__name">{{ $service->name }}</h2>
                <span class="popular__description">{{ $service->description }}</span>
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

                        <?php
                        use Carbon\Carbon;
                        ?>







                        <div class="coolinput">
                            <label for="date1">Data:</label>
                            <input type="text" id="date1" name="date1">

                            <!-- Campo de data escondido que será enviado para o banco de dados -->
                            <input type="hidden" id="date" name="date">
                        </div>


                        @php
                            $notWorkingDays = [];

                            $daysOfWeekMap = [
                                'sunday' => 0,
                                'monday' => 1,
                                'tuesday' => 2,
                                'wednesday' => 3,
                                'thursday' => 4,
                                'friday' => 5,
                                'saturday' => 6,
                            ];

                        @endphp

                        @foreach ($weeklySchedules as $day)
                            @if ($day->working == 0)
                                @php
                                    array_push($notWorkingDays, $daysOfWeekMap[$day->day_of_week]);
                                @endphp
                            @endif
                        @endforeach

                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var today = new Date();
                                var formattedToday = today.toLocaleDateString('pt-BR', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric'
                                });

                                // Função para obter a data da URL e formatá-la
                                function getQueryParam(param) {
                                    var queryString = window.location.search;
                                    var urlParams = new URLSearchParams(queryString);
                                    return urlParams.get(param);
                                }

                                function formatDateToDDMMYYYY(dateStr) {
                                    if (!dateStr) return '';
                                    const [year, month, day] = dateStr.split('-');
                                    return `${day}-${month}-${year}`;
                                }

                                function formatDateToYYYYMMDD(dateStr) {
                                    if (!dateStr) return '';
                                    const [day, month, year] = dateStr.split('-');
                                    return `${year}-${month}-${day}`;
                                }

                                var urlDate = getQueryParam('date');
                                var initialDate = urlDate ? formatDateToDDMMYYYY(urlDate) : formattedToday;

                                flatpickr("#date1", {
                                    minDate: today,
                                    dateFormat: "d-m-Y", // Exibição para o usuário
                                    locale: {
                                        firstDayOfWeek: 0,
                                        weekdays: {
                                            shorthand: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
                                            longhand: ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira",
                                                "Quinta-feira", "Sexta-feira", "Sábado"
                                            ],
                                        },
                                        months: {
                                            shorthand: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out",
                                                "Nov", "Dez"
                                            ],
                                            longhand: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho",
                                                "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
                                            ],
                                        }
                                    },
                                    disable: [

                                        /*function(date) {
                                            return date.getDay() === 6; // Desabilita Sábados
                                        }*/
                                    ],
                                    onChange: function(selectedDates, dateStr, instance) {
                                        // Atualiza o valor do input visível para a data selecionada no formato dd-mm-yyyy
                                        instance.input.value = dateStr; // Garante o formato dd-mm-yyyy

                                        // Atualiza o valor do input escondido para yyyy-mm-dd
                                        const hiddenDateInput = document.getElementById('date');
                                        hiddenDateInput.value = formatDateToYYYYMMDD(dateStr); // Converte para yyyy-mm-dd

                                        // Atualiza a URL com a nova data
                                        const date = hiddenDateInput.value;
                                        const id = '<?php echo $id; ?>'; // Substitua pelo ID apropriado
                                        const service_id = '<?php echo $service_id; ?>'; // Substitua pelo ID do serviço apropriado
                                        const url = `/scheduling/create/${id}/service/${service_id}?date=${date}`;

                                        // Recarrega a página com a nova URL
                                        window.location.href = url;
                                    },
                                    onDayCreate: function(dObj, dStr, fp, dayElem) {

                                        const diasDesativados = <?php echo json_encode($notWorkingDays); ?>;

                                        //if (dayElem.dateObj.getDay() === 6) {
                                        if (diasDesativados.includes(dayElem.dateObj.getDay())) {
                                            dayElem.classList.add('disabled-day');
                                            dayElem.style.backgroundColor = "#ffcccc"; // Fundo vermelho
                                            dayElem.style.color = "#000"; // Texto preto
                                        }

                                    }
                                });

                                // Define a data inicial no campo de entrada visível
                                document.getElementById('date1').value = initialDate;

                                // Atualiza o campo escondido quando a página é carregada
                                const initialHiddenDate = formatDateToYYYYMMDD(initialDate);
                                document.getElementById('date').value = initialHiddenDate;
                            });
                        </script>




                        <div class="coolinput">
                            <label>Horário </label>

                            <?php
                            // Crie um array associativo para mapear os horários dos agendamentos
                            $schedulingTimes = [];
                            foreach ($schedulings as $scheduling) {
                                // Converta o formato "00:00:00" para "00:00"
                                $formattedTime = substr($scheduling->time, 0, 5);
                                $schedulingTimes[$formattedTime] = $formattedTime;
                            
                                // Obtenha a duração do serviço em minutos
                                $durationMinutes = (int) $scheduling->services->duration;
                            
                                // Calcule quantos intervalos de 60 minutos são necessários
                                $intervals = ceil($durationMinutes / 60);
                            
                                // Adicione os horários ocupados ao array
                                $startedTime = $formattedTime;
                                for ($i = 1; $i < $intervals; $i++) {
                                    $newTime = date('H:i', strtotime($startedTime . ' + 1 hour'));
                                    $schedulingTimes[$newTime] = $newTime;
                                    $startedTime = $newTime;
                                }
                            }
                            ?>


                            <style>
                                .scheduling {
                                    color: red;
                                    /* Define a cor dos horários com agendamento */
                                }
                            </style>

                            <select name="time" id="time">
                                <?php
                                // Convertendo $opening_time e $closing_time para objetos Carbon
                                $openingTime = Carbon::createFromFormat('H:i', $opening_time);
                                $closingTime = Carbon::createFromFormat('H:i', $closing_time);
                                
                                // Iterando de $openingTime a $closingTime em intervalos de 30 minutos
                                $currentTime = $openingTime;
                                while ($currentTime < $closingTime) {
                                    $time = $currentTime->format('H:i');
                                
                                    // Verifique se há um agendamento para o horário atual
                                    if (isset($schedulingTimes[$time])) {
                                        echo "<option value='$time' disabled>$time - agendado</option>";
                                    } else {
                                        echo "<option value='$time'>$time</option>";
                                    }
                                
                                    // Incrementar 60 minutos
                                    $currentTime->addMinutes(60);
                                }
                                ?>
                            </select>
                        </div>

                        <br>
                        <hr class="style-eight">

                        <div class="coolinput">
                            <label for="">Nome</label>
                            <input type="text" name="name" id="name" placeholder="Escreva seu nome aqui!">
                        </div>
                        <div class="coolinput">
                            <label for="">Telefone</label>
                            <input type="text" name="phone" id="phone" placeholder="(xx)xxxxx-xxxx" value="">
                        </div>

                        <div class="form-group" style="text-align: center">
                            <button class="button" type="submit"> <i class="ri-calendar-check-line"></i>
                                Agendar</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
