<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">

    <!-- Geolocalização -->
    <meta name="geo.position" content="-22.9101744;-47.0593274">
    <meta name="geo.region" content="BR-SP">
    <meta name="geo.placename" content="Campinas, São Paulo, Brasil">

    <!-- SEO Geral -->
    <title>Barbeatria TG - O Melhor da região</title>
    <meta name="description" content="Barbeatria TG - O Melhor da região" />
    <meta name="author" content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende">

    <!-- Google+ / Schema.org -->
    <meta itemprop="name" content="Barbeatria TG - O Melhor da região">
    <meta itemprop="description"
        content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende" />
    <meta itemprop="image" content="https://barbeariatg.com/assets/img/logo2.png">
    <link rel="publisher" href="https://barbeariatg.com/">

    <!-- Open Graph Facebook / WhatsApp -->
    <meta property="og:title" content="Barbeatria TG - O Melhor da região">
    <meta property="og:description"
        content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende">
    <meta property="og:url" content="https://barbeariatg.com/">
    <meta property="og:site_name" content="Barbeatria TG - O Melhor da região">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://barbeariatg.com/assets/img/logo2.png">
    <meta property="og:image:width" content="1080">
    <meta property="og:image:height" content="1080">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="Barbeatria TG">
    <meta name="twitter:title" content="Barbeatria TG - O Melhor da região">
    <meta name="twitter:description"
        content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende">
    <meta name="twitter:image" content="https://barbeariatg.com/assets/img/logo2.png">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon" />

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
                        <a href="/#home" class="nav__link">Início</a>
                    </li>

                    <li class="nav__item">
                        <a href="/#about" class="nav__link">Sobre nos</a>
                    </li>

                    <li class="nav__item">
                        <a href="/#popular" class="nav__link">Cortes</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('scheduling.index') }}" class="nav__link">Agendar</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('scheduling.all') }}" class="nav__link">Agendamentos</a>
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
                    {{-- <img src="{{ asset('assets/img/logo.png') }}" alt="logo image"> --}}
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
                            <a href="https://wa.me/5519984445559" target="_blank" class="footer__link">Contato</a>
                        </li>
                        <li>
                            <a href="https://wa.me/5519984445559" target="_blank" class="footer__link">Agendar</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/bar.beariatg/" target="_blank"
                                class="footer__link">Videos</a>
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
                            Segunda á Sexta 09:00 - 19:00 <br>
                            Domingos 08:00 - 12:00
                        </li>
                    </ul>
                </div>



                <div>
                    <h3 class="footer__title">Social</h3>

                    <ul class="footer__links">
                        <a href="https://www.instagram.com/bar.beariatg/" target="_blank"
                            class="footer__social-link">
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
