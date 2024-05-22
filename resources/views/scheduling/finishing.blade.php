@extends('layouts.master')
@extends('layouts.get-status-form')

@section('title', 'Página Inicial')

@section('content')

    <section class="who section store">
        <span class="section__subtitle">Agendado</span>
        <h2 class="section__title">Tudo certo por aqui</h2>

        <p class="agenda__description">
            Seu horário já foi agendado com sucesso. Obrigado!
        </p>

        <h3 class="professional" style="text-align: center"><i class="ri-user-2-fill"></i> Profissional: {{ $professional->name }}</h3>
        
        <!-- Adicione aqui a data e horário marcado -->
        <p class="agenda__description">
            Data e Horário: <!-- aqui vai uma rota -->
        </p>

        @include('layouts.get-status-form')

        <div class="popular__container container grid">
            <article class="popular__card">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="popular image" class="popular__img">
                <h2 class="popular__name">{{ $service->name }}</h2>
                <span class="popular__description">Corte apenas</span>
                <span class="popular__price">R$ {{ $service->value }}</span>
            </article>
        </div>

        <br><br>
        <input type="hidden" name="pro" value="{{ $professional->id }}">
        <input type="hidden" name="service" value="{{ $service->id }}">
        
        <!-- Botão de Confirmação via WhatsApp -->
        <div class="whatsapp-button" style="text-align: center; margin-top: 20px;">
            <a href="https://api.whatsapp.com/send?phone=5519984445559&text=Olá, tudo bem? Aqui é <!-- aqui vai uma rota com nome do cliente -->, agendei via site com Profissional: {{ $professional->name }} o Serviço: {{ $service->name }} Data e Horário: <!-- aqui vai uma rota --> no Valor: R$ {{ $service->value }}" class="button" style="background-color: var(--whatsapp-color); color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                <i class="ri-whatsapp-fill" style="margin-right: 8px;"></i>Confirme via WhatsApp
            </a>
        </div>
        
    </section>

@endsection
