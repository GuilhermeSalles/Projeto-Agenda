@extends('layouts.master')

@section('title', 'Página Inicial')

@section('content')

  <!--==================== WHO ====================-->
  <section class="who section" id="who">
      <span class="section__subtitle">Agendamentos</span>
      <h2 class="section__title">Gerencie: </h2>
      
      <ul class="container">
        <h1>Saldo de hoje: <b>{{ $soma}}</b></h1>
          
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

@endsection