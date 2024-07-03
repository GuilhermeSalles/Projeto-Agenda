@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'Horários')

@section('content')

    <br>
    <div class="container">
        <div class="section">
            <div class="content">
                <h2 class="section__title">HORÁRIOS</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section"
            style="padding: 20px; border-radius: 10px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            {{-- Formulário para Horas de Funcionamento --}}
            <h3 class="section__subtitle" style="text-align: center; color: #333; ">Horário de Funcionamento</h3>
            <br>
            <form action="{{ route('scheduling.store.hours') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="opening_time">Horário de Abertura</label>
                    <input type="time" name="opening_time" id="opening_time" class="form-control"
                        value="{{ $opening_time }}" required>
                </div>

                <div class="form-group">
                    <label for="closing_time">Horário de Fechamento</label>
                    <input type="time" name="closing_time" id="closing_time" class="form-control"
                        value="{{ $closing_time }}" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            <br>

            {{-- Formulário para Horas de Funcionamento Especiais --}}
            <h3 class="section__subtitle" style="text-align: center; color: #333; ">Horas de Funcionamento Especiais</h3>
            <br>
            <form action="{{ route('scheduling.store.special_hours') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="day_of_week">Dia da Semana</label>

                    <br>
                    <select name="day_of_week" id="day_of_week" class="form-control" required style="text-align: center">
                        <option value="monday">Segunda-feira</option>
                        <option value="tuesday">Terça-feira</option>
                        <option value="wednesday">Quarta-feira</option>
                        <option value="thursday">Quinta-feira</option>
                        <option value="friday">Sexta-feira</option>
                        <option value="saturday">Sábado</option>
                        <option value="sunday">Domingo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="special_opening_time">Horário de Abertura</label>
                    <input type="time" name="special_opening_time" id="special_opening_time" class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label for="special_closing_time">Horário de Fechamento</label>
                    <input type="time" name="special_closing_time" id="special_closing_time" class="form-control"
                        required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            <br>
            {{-- Formulário para Dias da Semana --}}
            <h3 class="section__subtitle" style="text-align: center; color: #333; ">Dias da Semana</h3>
            <form action="{{ route('scheduling.store.days') }}" method="POST">
                @csrf
                <div class="form-group">

                    @foreach (['monday' => 'Segunda-feira', 'tuesday' => 'Terça-feira', 'wednesday' => 'Quarta-feira', 'thursday' => 'Quinta-feira', 'friday' => 'Sexta-feira', 'saturday' => 'Sábado', 'sunday' => 'Domingo'] as $day => $dayLabel)
                        @php
                            $schedule = $weeklySchedules->firstWhere('day_of_week', $day);
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="days[]" id="{{ $day }}"
                                value="{{ $day }}" {{ $schedule ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $day }}">
                                {{ $dayLabel }}
                                @if ($schedule && $schedule->opening_time && $schedule->closing_time)
                                    -
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->opening_time)->format('H:i') }}
                                    às
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->closing_time)->format('H:i') }}
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            <br>

            {{-- Formulário para Folgas --}}
            <h3 class="section__subtitle" style="text-align: center; color: #333; ">Folgas</h3>
            <form action="{{ route('scheduling.store.off_days') }}" method="POST">
                @csrf
                <div class="form-group">

                    <br>
                    <input type="date" name="off_days[]" id="off_days" class="form-control" multiple required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            @if (isset($prohibitedDays['off_day']))
                <h4>Folgas Registradas:</h4>
                <ul>
                    @foreach ($prohibitedDays['off_day'] as $day)
                        <li>{{ $day->date }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('scheduling.delete.day') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="off_day_delete">Deletar Folga</label>
                        <select name="date" id="off_day_delete" class="form-control" required>
                            @foreach ($prohibitedDays['off_day'] as $day)
                                <option value="{{ $day->date }}">{{ $day->date }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="type" value="off_day">
                    </div>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            @endif

            <br>

            {{-- Formulário para Férias --}}
            <h3 class="section__subtitle" style="text-align: center; color: #333; ">Férias</h3>
            <form action="{{ route('scheduling.store.vacation') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="vacation_start">Início das Férias</label>
                    <input type="date" name="vacation_start" id="vacation_start" class="form-control" required>
                </div>

                <br>

                <div class="form-group">
                    <label for="vacation_end">Fim das Férias</label>
                    <input type="date" name="vacation_end" id="vacation_end" class="form-control" required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Salvar</button>


                @if (isset($prohibitedDays['vacation_start']) || isset($prohibitedDays['vacation_end']))
                    <h4>Férias Registradas:</h4>
                    <ul>
                        @foreach ($prohibitedDays['vacation_start'] as $day)
                            <li>Início: {{ $day->date }}</li>
                        @endforeach
                        @foreach ($prohibitedDays['vacation_end'] as $day)
                            <li>Fim: {{ $day->date }}</li>
                        @endforeach
                    </ul>
                @endif

                <br>
                <br>

                {{-- Formulário para Feriados --}}
                <h3 class="section__subtitle" style="text-align: center; color: #333; ">Feriados</h3>
                <form action="{{ route('scheduling.store.holidays') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="holidays">Feriados</label>
                        <input type="date" name="holidays[]" id="holidays" class="form-control" multiple required>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>

                @if (isset($prohibitedDays['holiday']))
                    <h4>Feriados Registrados:</h4>
                    <ul>
                        @foreach ($prohibitedDays['holiday'] as $day)
                            <li>{{ $day->date }}</li>
                        @endforeach
                    </ul>

                    <form action="{{ route('scheduling.delete.day') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="holiday_delete">Deletar Feriado</label>
                            <select name="date" id="holiday_delete" class="form-control" required>
                                @foreach ($prohibitedDays['holiday'] as $day)
                                    <option value="{{ $day->date }}">{{ $day->date }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="type" value="holiday">
                        </div>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                @endif

                <br>
                <br>

                {{-- Formulário para Saídas Especiais --}}
                <h3 class="section__subtitle" style="text-align: center; color: #333; ">Saídas Especiais</h3>
                <form id="special-exits" action="{{ route('scheduling.store.special-exit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="day">Data:</label>
                        <input type="date" name="day" id="day" class="form-control" min="{{ date('Y-m-d') }}"
                            value="{{ $specialDay }}" required>

                            <script>
                            document.getElementById('day').addEventListener('change', function() {
                                const date = this.value;
                
                                const url = `/admin/times?date=${date}#special-exits`;

                                // Recarregar a página com a nova URL
                                window.location.href = url;
                            });
                        </script>

                        <?php
                        use Carbon\Carbon;
                        ?>

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

                                // Calcule quantos intervalos de 30 minutos são necessários
                                $intervals = ceil($durationMinutes / 30);

                                // Adicione os horários ocupados ao array
                                $startedTime = $formattedTime;
                                for ($i = 1; $i < $intervals; $i++) {
                                    $newTime = date('H:i', strtotime($startedTime . ' + 30 minutes'));
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

                            <select name="time" id="time" class="form-control">
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

                                    // Incrementar 30 minutos
                                    $currentTime->addMinutes(30);
                                }
                                ?>
                            </select>
                        </div>

                        <label for="duration">Duração</label>
                        <select name="duration" id="duration" class="form-control" required>
                            <option value="30">30 minutos</option>
                            <option value="60">1 hora</option>
                            <option value="90">1 hora e 30 minutos</option>
                            <option value="120">2 horas</option>
                        </select>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>


                <br>
                <br>

                @if (isset($specialExits))
                    <h3 style="text-align: center; color: #333;">Saídas Registradas:</h3>
                    <br>

                    <form action="{{ route('scheduling.delete.special-exit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="date">Deletar Saída</label>
                            <select name="date" id="date" class="form-control" required>
                                @foreach ($specialExits as $day)
                                    <option value="{{ $day->id }}">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $day->date)->format('d/m') }}
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $day->time)->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="type" value="holiday">
                        </div>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                @endif

        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <style>
        .centered-list {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            list-style-type: none;
            padding-left: 0;
        }

        /* Estilo para o formulário */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: bold;
        }

        /* Estilo para o select */
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Estilo para os inputs de tipo time */
        input[type="time"].form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Estilo para o botão */
        .btn-primary {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Botão primário */
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--first-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: var(--font-medium);
            font-size: var(--normal-font-size);
        }

        .btn-primary:hover {
            background-color: var(--first-color-alt);
            transform: translateY(-2px);
        }

        /* Botão de perigo (excluir) */
        .btn-danger {
            width: 100%;
            padding: 0.75rem;
            background-color: #e3342f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: var(--font-medium);
            font-size: var(--normal-font-size);
        }

        .btn-danger:hover {
            background-color: #cc1f1a;
            transform: translateY(-2px);
        }

        /* Alinhamento do botão dentro do container */
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
        }


        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: var(--first-color);
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: .5rem;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            border-radius: .5rem;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
            max-width: 100%;
        }

        .dropdown-item {
            border-radius: 5px;
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: var(--first-color);
        }

        .dropdown-menu.show {
            display: block;
        }

        /* Estilo para inputs de data e hora */
        input[type="date"],
        input[type="time"] {
            background-color: var(--container-color);
            color: var(--title-color);
            border: 1px solid var(--text-color);
            border-radius: 5px;
            padding: 0.5rem;
            width: 100%;
        }

        input[type="date"]:focus,
        input[type="time"]:focus {
            outline: none;
            border-color: var(--first-color);
        }

        `
    </style>

    <script>
        function toggleDropdown(event) {
            var dropdownMenu = event.currentTarget.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdownMenus = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdownMenus.length; i++) {
                    var openDropdown = dropdownMenus[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

@endsection
