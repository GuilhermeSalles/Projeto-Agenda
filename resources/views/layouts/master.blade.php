<!DOCTYPE html>
  <html lang="pt">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!--=============== CSS ===============-->
  
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <title>Barbearia TG</title>
  </head>

  <body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
      <nav class="nav container">
        <a href="#" class="nav__logo">
          <img src="{{ asset('assets/img/logo.png') }}" alt="logo" />
          Barbearia TG
        </a>
        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list grid">
            <li class="nav__item">
              <a href="#home" class="nav__link">Início</a>
            </li>

            <li class="nav__item">
              <a href="#about" class="nav__link">Sobre nos</a>
            </li>

            <li class="nav__item">
              <a href="#popular" class="nav__link">Cortes</a>
            </li>

            <li class="nav__item">
              <a href="/Agendamento/#who" class="nav__link">Agenda</a>
            </li>

            <!-- Close button -->
            <div class="nav__close" id="nav-close">
              <i class="ri-close-line"></i>
            </div>

            <img src="{{ asset('assets/img/leaf-branch-4.png') }}" alt="nav image" class="nav__img-1" />
            <img src="{{ asset('assets/img/leaf-branch-3.png') }}" alt="nav image" class="nav__img-2" />
          </ul>
        </div>
        <div class="nav__buttons">
          <!-- Theme change button -->
          <i class="ri-moon-line change-theme" id="theme-button"></i>

          <!-- Toggle button -->
          <div class="nav__toggle" id="nav-toggle">
            <i class="ri-apps-2-line"></i>
          </div>
        </div>
      </nav>
    </header>

    <main class="main">
        @yield('content')
    </main>

  <!--==================== FOOTER ====================-->
  <footer class="footer">
    <div class="footer__container container grid">
      <div>
        <a href="#" class="footer__logo">
          <img src="{{ asset('assets/img/logo.png') }}" alt="logo image">
          Barbearia TG
        </a>

        <p class="footer__description">
          Talento dos nossos profissionais se une <br>
          à paixão pelo estilo. Aventure-se <br>
          conosco e transforme-se.
        </p>
      </div>

      <div class="footer__content">
        <div>
          <h3 class="footer__title">Menu Principal</h3>

          <ul class="footer__links">
            <li>
              <a href="#home" class="footer__link">Início</a>
            </li>
            <li>
              <a href="#about" class="footer__link">Sobre nos</a>
            </li>
            <li>
              <a href="#popular" class="footer__link">Cortes</a>
            </li>
          </ul>
        </div>


        <div>
          <h3 class="footer__title">Info</h3>

          <ul class="footer__links">
            <li>
              <a href="#" class="footer__link">Contato</a>
            </li>
            <li>
              <a href="#" class="footer__link">Agendar</a>
            </li>
            <li>
              <a href="#" class="footer__link">Videos</a>
            </li>
          </ul>
        </div>



        <div>
          <h3 class="footer__title">Endereço</h3>

          <ul class="footer__links">
            <li class="footer__information">
              R. Gravataí, 33 - Parque Dom Pedro II <br>
              Campinas - SP, 13056-421
            </li>

            <li class="footer__information">
              Segunda á Sexta 10:00 - 21:00
            </li>
          </ul>
        </div>



        <div>
          <h3 class="footer__title">Social</h3>

          <ul class="footer__links">
            <a href="https://www.instagram.com/bar.beariatg/" target="_blank" class="footer__social-link">
              <i class="ri-instagram-fill"></i>
            </a>
          </ul>
        </div>

      </div>
    </div>
    <div class="footer__info container">
      <div class="footer__card">
        <img src="{{ asset('assets/img/footer-card-1.png') }}" alt="footer image">
        <img src="{{ asset('assets/img/footer-card-2.png') }}" alt="footer image">
        <img src="{{ asset('assets/img/footer-card-3.png') }}" alt="footer image">
        <img src="{{ asset('assets/img/footer-card-4.png') }}" alt="footer image">
      </div>

      <span class="footer__copy">
        &#169 Copyright Guilherme Baltazar. All rights reserved
      </span>

    </div>

  </footer>

  <!--========== SCROLL UP ==========-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-line"></i>
  </a>
  <!--=============== SCROLLREVEAL ===============-->
  <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>

  <!--=============== MAIN JS ===============-->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>