<<<<<<< HEAD
@extends('admin.master')
@extends('admin.get-status-form')

@section('title', 'DashBoard')

@section('content')

<br>
<div class="container">
    <div class="section">
        <div class="content">
            <h2>DASHBOARD</h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="section">
        <style>
        .worked-days{

        }

        .worked-days a{
            padding:
        }

        .dad-div div{
            display: flex;
            flex-direction: row;
            justify-content: center;

        }




        #ul-calendar{
            max-height: 300px;
            overflow-y: scroll;
        }

    </style>

    <section class="dad-div section">
        <span class="section__subtitle">Agendamentos</span>
            <h2 class="section__title">Gerencie: </h2>
        <!--==================== WHO ====================-->

        <div>
        <section class="who section" id="who">
        

            <ul class="container">

                <div class="worked-days">
                    
                <select id="ul-calendar">
                    @foreach($uniqueDates as $scheduledDate)
                        <option value="{{ route('scheduling.all', $scheduledDate['date']) }}"  {{ $date == $scheduledDate['date'] ? 'selected' : '' }}>    {{ $scheduledDate['date']->format('d/m/Y') }}</option>
                    @endforeach
                </select>

                
                <script>
                    $(document).ready(function(){
                        $('#ul-calendar').change(function(){
                            var selectedUrl = $(this).val();
                            window.location.href = selectedUrl; // Redirecionar para a URL selecionada
                        });
                    });
                </script>



                    <a class="button" href="{{ route('scheduling.all') }}">Hoje</a>
                </div>



                <h1>Saldo de {{ $date == null ? 'hoje' : $date->format('d/m/Y') }}: <b>R$ {{ $soma }}</b></h1>
                
                @foreach($schedulings as $scheduling)
                    <li class="">


                        <span class="">{{ $scheduling->name }}</span>

                        <span class="">
                            {{ $scheduling->service }}
                        </span>

                        <span class="">{{ $scheduling->date }}</span>

                        @switch($scheduling->fulfilled)
                                @case(0)
                            <form method="POST" action="{{ route('scheduling.cancel') }}" class="button">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                <button>Cancelar<i class="ri-arrow-right-circle-line"></i></button>
                            </form>

                            <form method="POST" action="{{ route('scheduling.finishe') }}" class="button">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                <button>Concluir<i class="ri-arrow-right-circle-line"></i></button>
                            </form>
                        @break
                            @case(1)
                                Concluido

                                <form method="POST" action="{{ route('scheduling.reset') }}" class="button">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                <button>Reabrir<i class="ri-arrow-right-circle-line"></i></button>
                            </form>
                            @break

                            @case(2)
                                Cancelado
                                
                                <form method="POST" action="{{ route('scheduling.reset') }}" class="button">
                                @csrf
                                <input type='hidden' name="id" value="{{ $scheduling->id }}">
                                <button>Reabrir<i class="ri-arrow-right-circle-line"></i></button>
                                </form>
                            @break

                            @default
                                Algo deu errado, por favor tente novamente!
                        @endswitch

                        </li>
                @endforeach
            </ul>

        </section>

        <?php

            // brincando de estatisticas 

            $datesArray = $uniqueDates;

            // Inicializa um array para armazenar os dados de data e valor
            $dataValueArray = [];

            // Itera sobre os objetos Carbon no array
            foreach ($datesArray as $carbonDate) {
                // Extrai a data no formato desejado
                $data = $carbonDate["date"];
                
                // Crie um valor fictício ou substitua pelo valor que desejar
                $valor =  $carbonDate["total"];

                // Adiciona a data e o valor ao array
                $dataValueArray[] = [$data, $valor];
            }

            // Agora $dataValueArray contém os pares de data e valor no formato desejado
        ?>

        <section>
            <div id="chart_div" style="width: 100%; height: 400px;"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('date', 'Data');
                    data.addColumn('number', 'Valor');

                    // Seu vetor de data e valor PHP
                    var dataValueArray = <?php echo json_encode($dataValueArray); ?>;

                    // Converter cada par de data e valor para o formato esperado pelo Google Charts
                    dataValueArray.forEach(function(pair) {
                        pair[0] = new Date(pair[0]);
                    });

                    // Adicionar os dados ao DataTable
                    data.addRows(dataValueArray);

                    var options = {
                        title: 'Gráfico de Barras de Exemplo',
                        legend: { position: 'bottom' }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            </script>
        </section>
            </div>
    </section>
    </div>
</div>

@endsection
=======
<h1>Olá {{ auth()->user()->firstName }} {{ auth()->user()->lastName }} </h1>
>>>>>>> views
