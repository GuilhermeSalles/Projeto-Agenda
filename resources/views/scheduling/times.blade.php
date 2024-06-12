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
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="monday" value="monday" {{ $weeklySchedules->contains('day_of_week', 'monday') ? 'checked' : '' }}>
            <label class="form-check-label" for="monday">Segunda-feira</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="tuesday" value="tuesday" {{ $weeklySchedules->contains('day_of_week', 'tuesday') ? 'checked' : '' }}>
            <label class="form-check-label" for="tuesday">Terça-feira</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="wednesday" value="wednesday" {{ $weeklySchedules->contains('day_of_week', 'wednesday') ? 'checked' : '' }}>
            <label class="form-check-label" for="wednesday">Quarta-feira</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="thursday" value="thursday" {{ $weeklySchedules->contains('day_of_week', 'thursday') ? 'checked' : '' }}>
            <label class="form-check-label" for="thursday">Quinta-feira</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="friday" value="friday" {{ $weeklySchedules->contains('day_of_week', 'friday') ? 'checked' : '' }}>
            <label class="form-check-label" for="friday">Sexta-feira</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="saturday" value="saturday" {{ $weeklySchedules->contains('day_of_week', 'saturday') ? 'checked' : '' }}>
            <label class="form-check-label" for="saturday">Sábado</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="days[]" id="sunday" value="sunday" {{ $weeklySchedules->contains('day_of_week', 'sunday') ? 'checked' : '' }}>
            <label class="form-check-label" for="sunday">Domingo</label>
        </div>
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
