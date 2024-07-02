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

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-select {
                    background-color: #f8f9fa;
                    color: #333;
                    padding: 10px 20px;
                    border: 1px solid #d4823a;
                    border-radius: .5rem;
                    cursor: pointer;
                }

                .agendamentos-list {
                    border: none;
                   
                    padding: 15px 10px;
                    border-radius: 10px;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: baseline;
                    box-shadow: #ccc 0px 0px 5px;
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

                    <a class="button"
                        href="{{ route('scheduling.all', ['date' => now('America/Sao_Paulo')->format('Y-m-d')]) }}"
                        style="margin-right: 10px;">Hoje</a>
                    <a class="button" href="{{ route('scheduling.admin.create', auth()->user()->id) }}"
                        style="margin-left: 10px;">Adicionar</a>
                </div>

                <!-- Saldo -->
                <h2 style="text-align: center;">Saldo de {{ $date == null ? 'hoje' : $date->format('d/m') }}: <b>R$
                        {{ number_format($soma, 2, ',', '.') }}</b></h2>

                <!-- Lista de agendamentos -->
                <ul class="container">
                    @foreach ($schedulings as $scheduling)
                        <li class="agendamentos-list">
                            <span>{{ explode(' ', $scheduling->name)[0] }}</span>
                            <span
                                style="font-size: .7rem;">{{ \App\Models\Service::find($scheduling->service)->name }}</span>
                            <span>{{ \Carbon\Carbon::createFromFormat('H:i:s', $scheduling->time)->format('H:i') }}</span>
                            <div class="dropdown">
                                <select class="dropdown-select"
                                    onchange="handleActionChange(this, '{{ $scheduling->id }}')">
                                    <option value="">Ações</option>
                                    @switch($scheduling->fulfilled)
                                        @case(0)
                                            <option value="cancel">Cancelar</option>
                                            <option value="concluir">Concluir</option>
                                        @break

                                        @case(1)
                                            <option value="reabrir">Reabrir</option>
                                        @break

                                        @case(2)
                                            <option value="reabrir">Reabrir</option>
                                        @break

                                        @default
                                            <option value="">Algo deu errado</option>
                                    @endswitch
                                </select>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <script>
                    function handleActionChange(select, id) {
                        const value = select.value;
                        if (value === 'cancel') {
                            document.getElementById(`cancel-form-${id}`).submit();
                        } else if (value === 'concluir') {
                            document.getElementById(`concluir-form-${id}`).submit();
                        } else if (value === 'reabrir') {
                            document.getElementById(`reabrir-form-${id}`).submit();
                        }
                    }
                </script>

                @foreach ($schedulings as $scheduling)
                    @switch($scheduling->fulfilled)
                        @case(0)
                            <form id="cancel-form-{{ $scheduling->id }}" method="POST" action="{{ route('scheduling.cancel') }}"
                                style="display: none;">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                            </form>

                            <form id="concluir-form-{{ $scheduling->id }}" method="POST"
                                action="{{ route('scheduling.finishe') }}" style="display: none;">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                            </form>
                        @break

                        @case(1)
                            <form id="reabrir-form-{{ $scheduling->id }}" method="POST" action="{{ route('scheduling.reset') }}"
                                style="display: none;">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                            </form>
                        @break

                        @case(2)
                            <form id="reabrir-form-{{ $scheduling->id }}" method="POST" action="{{ route('scheduling.reset') }}"
                                style="display: none;">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                            </form>
                        @break
                    @endswitch
                @endforeach
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
