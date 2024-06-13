@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'Horários')

@section('content')

    <br>
    <div class="container">
        <div class="section">
            <div class="content">
                <h2>HORÁRIOS</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section" style="padding: 20px; border-radius: 10px; background-color: #f8f9fa;">
        {{-- Formulário para Horas de Funcionamento --}}
<h3>Horas de Funcionamento</h3>
<form action="{{ route('scheduling.store.hours') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="opening_time">Horário de Abertura</label>
        <input type="time" name="opening_time" id="opening_time" class="form-control" value="{{ $opening_time }}" required>
    </div>

    <div class="form-group">
        <label for="closing_time">Horário de Fechamento</label>
        <input type="time" name="closing_time" id="closing_time" class="form-control" value="{{ $closing_time }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>


<div class="container">
    <div class="section" style="padding: 20px; border-radius: 10px; background-color: #f8f9fa;">
        {{-- Formulário para Horas de Funcionamento Especiais --}}
        <h3>Horas de Funcionamento Especiais</h3>
        <form action="{{ route('scheduling.store.special_hours') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="day_of_week">Dia da Semana</label>
                <select name="day_of_week" id="day_of_week" class="form-control" required>
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
                <input type="time" name="special_opening_time" id="special_opening_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="special_closing_time">Horário de Fechamento</label>
                <input type="time" name="special_closing_time" id="special_closing_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>



            <hr>

            {{-- Formulário para Dias da Semana --}}
            <h3>Dias da Semana</h3>
<form action="{{ route('scheduling.store.days') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Dias da Semana</label><br>

        @foreach (['monday' => 'Segunda-feira', 'tuesday' => 'Terça-feira', 'wednesday' => 'Quarta-feira', 'thursday' => 'Quinta-feira', 'friday' => 'Sexta-feira', 'saturday' => 'Sábado', 'sunday' => 'Domingo'] as $day => $dayLabel)
            @php
                $schedule = $weeklySchedules->firstWhere('day_of_week', $day);
            @endphp
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="days[]" id="{{ $day }}" value="{{ $day }}" {{ $schedule ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $day }}">
                    {{ $dayLabel }}
                    @if ($schedule && $schedule->opening_time && $schedule->closing_time)
    - {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->opening_time)->format('H:i') }} às {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->closing_time)->format('H:i') }}
@endif

                </label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>





    

        <hr>

        {{-- Formulário para Folgas --}}
        <h3>Folgas</h3>
        <form action="{{ route('scheduling.store.off_days') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="off_days">Folgas</label>
                <input type="date" name="off_days[]" id="off_days" class="form-control" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        @if(isset($prohibitedDays['off_day']))
            <h4>Folgas Registradas:</h4>
            <ul>
                @foreach($prohibitedDays['off_day'] as $day)
                    <li>{{ $day->date }}</li>
                @endforeach
            </ul>

            <form action="{{ route('scheduling.delete.day') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="off_day_delete">Deletar Folga</label>
                    <select name="date" id="off_day_delete" class="form-control" required>
                        @foreach($prohibitedDays['off_day'] as $day)
                            <option value="{{ $day->date }}">{{ $day->date }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="type" value="off_day">
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif

        <hr>

        {{-- Formulário para Férias --}}
        <h3>Férias</h3>
        <form action="{{ route('scheduling.store.vacation') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="vacation_start">Início das Férias</label>
                <input type="date" name="vacation_start" id="vacation_start" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="vacation_end">Fim das Férias</label>
                <input type="date" name="vacation_end" id="vacation_end" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        @if(isset($prohibitedDays['vacation_start']) || isset($prohibitedDays['vacation_end']))
            <h4>Férias Registradas:</h4>
            <ul>
                @foreach($prohibitedDays['vacation_start'] as $day)
                    <li>Início: {{ $day->date }}</li>
                @endforeach
                @foreach($prohibitedDays['vacation_end'] as $day)
                    <li>Fim: {{ $day->date }}</li>
                @endforeach
            </ul>
        @endif

        <hr>

        {{-- Formulário para Feriados --}}
        <h3>Feriados</h3>
        <form action="{{ route('scheduling.store.holidays') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="holidays">Feriados</label>
                <input type="date" name="holidays[]" id="holidays" class="form-control" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        @if(isset($prohibitedDays['holiday']))
            <h4>Feriados Registrados:</h4>
            <ul>
                @foreach($prohibitedDays['holiday'] as $day)
                    <li>{{ $day->date }}</li>
                @endforeach
            </ul>

            <form action="{{ route('scheduling.delete.day') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="holiday_delete">Deletar Feriado</label>
                    <select name="date" id="holiday_delete" class="form-control" required>
                        @foreach($prohibitedDays['holiday'] as $day)
                            <option value="{{ $day->date }}">{{ $day->date }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="type" value="holiday">
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif

        </div>
    </div>

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: #d4823a;
            /* Cor de fundo do site */
            color: #fff;
            /* Cor do texto */
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
            /* Sombra envolta */
            z-index: 1;
            max-width: 100%;
            /* Largura máxima igual à largura da tela */
        }

        .dropdown-item {
            border-radius: 5px;
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #d4823a;
        }

        .dropdown-menu.show {
            display: block;
        }
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
