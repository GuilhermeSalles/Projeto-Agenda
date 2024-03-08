@extends('layouts.master')

@section('title', 'Página Inicial')

@section('content')
  <!--==================== HOME ====================-->
  <section class="home section" id="home">
    <div class="home__container container grid">
      <img src="{{ asset('assets/img/home.png') }}" alt="home image" class="home__img" />

      <div class="home__data">
        <h1 class="home__title">
          Barbearia TG

          <div>Agende um Horário!</div>
        </h1>

        <p class="home__description">
          Clique no botão abaixo para acessar a agenda e marcar o que
          deseja, escolhendo também com quem você quer.
        </p>

        <a href="https://wa.me/5519984445559" class="button">
          Agendar <i class="ri-arrow-right-circle-line"></i>
        </a>
      </div>
    </div>

    <img src="{{ asset('assets/img/leaf-branch-2.png') }}" alt="home image" class="home__leaf-1" />
    <img src="{{ asset('assets/img/leaf-branch-4.png') }}" alt="home image" class="home__leaf-2" />
  </section>
 <!--==================== POPULAR ====================-->
 <section class="popular section" id="popular">
  <span class="section__subtitle">Cortes Populares</span>
  <h2 class="section__title"> Os Cortes mais feitos</h2>

  <div class="popular__container container grid">
    <article class="popular__card">
      <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

      <h3 class="popular__name">Cabelo</h3>
      <span class="popular__description">Corte apenas</span>

      <span class="popular__price">R$30,00</span>
    </article>

    <article class="popular__card">
      <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

      <h3 class="popular__name">Combo CB</h3>
      <span class="popular__description">Corte e Barba</span>

      <span class="popular__price">R$50,00</span>
    </article>

    <article class="popular__card">
      <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

      <h3 class="popular__name">Combo CBS</h3>
      <span class="popular__description">Corte, Barba e Sombrancelha</span>

      <span class="popular__price">R$60,00</span>
    </article>
    <article class="popular__card">
      <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

      <h3 class="popular__name">Barba</h3>
      <span class="popular__description">Apenas Barba</span>

      <span class="popular__price">R$25,00</span>
    </article>
    <article class="popular__card">
      <img src="{{ asset('assets/img/favicon.png') }}" alt="popula image" class="popular__img">

      <h3 class="popular__name">Combo S</h3>
      <span class="popular__description">Corte e Sombrancelha</span>

      <span class="popular__price">R$40,00</span>
    </article>
  </div>
</section>

  <!--==================== ABOUT ====================-->
  <section class="about section" id="about">
    <div class="about__container container grid">
      <div class="about__data">
        <span class="section__subtitle">Sobre Nos</span>
        <h2 class="section__title about__title">
          <div>
            <img src="{{ asset('assets/img/home-title.png') }}" alt="about image"/>Providenciamos
          </div>
          o melhor.
        </h2>

        <p class="about_description">
          Um ambiente incrível para cuidar do seu visual. Descubra uma
          experiência única, onde o talento dos nossos profissionais se une
          à paixão pelo estilo. Aventure-se conosco e transforme-se.
        </p>
      </div>

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9957.974446636164!2d-47.14026629808728!3d-22.97751678637303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8b6179eb1f2a7%3A0x4133dbf50bea0ad0!2sBarbearia%20TG!5e1!3m2!1spt-BR!2sbr!4v1686674327703!5m2!1spt-BR!2sbr" width="600" height="450" style="border: 0" allowfullscreen="" loading="fast" referrerpolicy="no-referrer-when-downgrade" class="about__iframe"></iframe>
    </div>
    <img src="{{ asset('assets/img/leaf-branch-1.png') }}" alt="about image" class="about__leaf">
  </section>

  <!-- ==================== RECENTLY ====================
      <section class="recently section" id="recently"></section>

      ==================== NEWSLETTER ====================
      <section class="newsletter section"></section>-->
@endsection
