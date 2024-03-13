@extends('layouts.master')

@section('title', 'Página Inicial')

@section('content')

  <!--==================== WHO ====================-->
  <section class="who section" id="who">
      <span class="section__subtitle">Funcionário</span>
      <h2 class="section__title">Quais são!</h2>
      
      <div class="who__container container grid">
          
          @foreach($professionals as $professional)
              <article class="who__card">
                  <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="who__img">

                  <h3 class="who__name">{{ $professional->name }}</h3>
                  <span class="who__description">
                    @foreach($professional->services as $service)
                      {{ $service->name }}<br>
                    @endforeach
                  </span>

                  <span class="who__price">{{ $professional->workingDays }}</span>

                  <a href="{{ route('scheduling.create', [$professional->id]) }}" class="button agendar">
                    Agendar Agora<i class="ri-arrow-right-circle-line"></i>
                  </a>
              </article>

              
          @endforeach
          
    
      </div>

  </section>

@endsection