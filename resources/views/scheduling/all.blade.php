@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'DashBoard')

@section('content')

    <br>
    <div class="container">
        <div class="section">
            <div class="content">
                <h2>AGENDA</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <style>
                .worked-days {
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    align-items: center;
                    margin-bottom: 20px;
                }

                .worked-days select {
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 10px;
                    margin-right: 10px;
                }

                .worked-days a {
                    background-color: var(--first-color);
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 10px;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                #ul-calendar {
                    max-height: 300px;
                    overflow-y: scroll;
                }

                .whatsapp-button {
                    background-color: var(--whatsapp-color);
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 10px;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    margin-top: 20px;
                }

                .whatsapp-button i {
                    margin-right: 8px;
                }

                .agendamentos-list {
                    border: none;
                    margin: 10px 10px;
                    padding: 15px 10px;
                    border-radius: 10px;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    box-shadow: #ccc 0px 0px 5px;
                }

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-toggle {
                    background-color: #d4823a;
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
                    background-color: #d4823a;
                }

                .dropdown:hover .dropdown-menu {
                    display: block;
                }

                #chart-container {
                    width: 100%;
                    height: auto;
                }
            </style>

            <section class="dad-div section">

                <!-- Select para dias de trabalho -->
                <div class="worked-days">
                    <select id="ul-calendar" onchange="location = this.value;">
                        @foreach ($uniqueDates as $scheduledDate)
                            <option value="{{ route('scheduling.all', $scheduledDate['date']->format('Y-m-d')) }}"
                                {{ $date && $date->isSameDay($scheduledDate['date']) ? 'selected' : '' }}>
                                {{ $scheduledDate['date']->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>

                    <a class="button" href="{{ route('scheduling.all', ['date' => now()->format('Y-m-d')]) }}">Hoje</a>
                </div>

                <!-- Saldo -->
                <h2 style="text-align: center;">Saldo de {{ $date == null ? 'hoje' : $date->format('d/m') }}: <b>R$
                        {{ number_format($soma, 2, ',', '.') }}</b></h2>

                <!-- Lista de agendamentos -->
                <ul class="container">
                    @foreach ($schedulings as $scheduling)
                        <li class="agendamentos-list">
                            <span>{{ explode(' ', $scheduling->name)[0] }}</span>
                            <span style="font-size: .7rem;">{{ \App\Models\Service::find($scheduling->service)->name }}</span>
                            <span>{{ \Carbon\Carbon::createFromFormat('H:i:s', $scheduling->time)->format('H:i') }}</span>
                            {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', $scheduling->date)->format('d-m') }}   --}}
                            <div class="dropdown">
                                <button class="dropdown-toggle">Ações</button>
                                <div class="dropdown-menu">
                                    @switch($scheduling->fulfilled)
                                        @case(0)
                                            <form method="POST" action="{{ route('scheduling.cancel') }}">
                                                @csrf
                                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                                <button type="submit" class="dropdown-item">Cancelar</button>
                                            </form>

                                            <form method="POST" action="{{ route('scheduling.finishe') }}">
                                                @csrf
                                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                                <button type="submit" class="dropdown-item">Concluir</button>
                                            </form>
                                        @break

                                        @case(1)
                                            <span class="dropdown-item">Concluído</span>

                                            <form method="POST" action="{{ route('scheduling.reset') }}">
                                                @csrf
                                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                                <button type="submit" class="dropdown-item">Reabrir</button>
                                            </form>
                                        @break

                                        @case(2)
                                            <span class="dropdown-item">Cancelado</span>

                                            <form method="POST" action="{{ route('scheduling.reset') }}">
                                                @csrf
                                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                                <button type="submit" class="dropdown-item">Reabrir</button>
                                            </form>
                                        @break

                                        @default
                                            <span class="dropdown-item">Algo deu errado, por favor tente novamente!</span>
                                    @endswitch
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Gráfico com Chart.js -->
            <section>
                <div id="chart-container">
                    <canvas id="chart_div"></canvas>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var ctx = document.getElementById('chart_div').getContext('2d');
                        var dataValueArray = @json($uniqueDates);

                        var data = {
                            labels: dataValueArray.map(function(pair) {
                                return new Date(pair.date).toLocaleDateString();
                            }),
                            datasets: [{
                                label: 'Valores',
                                data: dataValueArray.map(function(pair) {
                                    return pair.total;
                                }),
                                backgroundColor: 'rgba(216, 122, 79, 0.5)',
                                borderColor: 'rgba(21, 123, 79, 0.2)',
                                borderWidth: 1
                            }]
                        };

                        var options = {
                            responsive: true,
                            scales: {
                                x: {
                                    type: 'time',
                                    time: {
                                        unit: 'day',
                                        tooltipFormat: 'DD/MM/YYYY'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Data'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Valor (R$)'
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return 'R$ ' + value.toFixed(2).replace('.', ',');
                                        }
                                    }
                                }
                            }
                        };

                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: data,
                            options: options
                        });
                    });
                </script>
            </section>
        </div>
    </div>

@endsection
