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
    <meta itemprop="description" content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende" />
    <meta itemprop="image" content="https://barbeariatg.com/assets/img/logo2.png">
    <link rel="publisher" href="https://barbeariatg.com/">

    <!-- Open Graph Facebook / WhatsApp -->
    <meta property="og:title" content="Barbeatria TG - O Melhor da região">
    <meta property="og:description" content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende">
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
    <meta name="twitter:description" content="Barbeatria TG - Agende um horário conosoco, acessa nosso site e agende">
    <meta name="twitter:image" content="https://barbeariatg.com/assets/img/logo2.png">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon" />

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== 	CHART JS ===== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!--=============== NAV ===============-->
    <div class="nav" id="nav">
        <nav class="nav__content">
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-chevron-right'></i>
            </div>

            <a href="#" class="nav__logo">
                <img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAASJJREFUSEvFlN0RgjAQhPekEewEOwG1BX/e1DcHWxC1E+nENKKnEX8mYu4iAyOvgf24zd4SOn6oY30EAXiexuBoAUYKwIBQgs4rWh+M9oMqgOfjBBc+fhEy6FFG620pQXTAdHQCEHtEDOVFvzGAJ8MURHvRhh4NpCnECXg6XAC0lH3mJeW7le8dGeD3/63HnNFmd2gISGNcInvB3dyB/SshRYDiv/1eTVEFee1BcreCYRCds1b2QFsk7TxoAk2k+R7YmDIlt2qorHGfqjKYzc8xfVysXTBfeuowT23ULBJTo3n1JVV1gNw9GqLWTQ4grBo0hlsdLmA22j86X1PxnzNK2hSD5wsfE4jVHAp1bPoEcKiKmP28eOn+d9FamaYNEUnjCv0HdhkB1kXQAAAAAElFTkSuQmCC" />
                <span class="nav__logo-name">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }} </span>
            </a>

            <div class="nav__list">

                <a href="{{ route('admin.dashboard') }}" class="nav__link {{ Request::is('admin/dashboard') ? 'active-link' : '' }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="nav__name">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.profissionais') }}" class="nav__link {{ Request::is('admin/profissionais') ? 'active-link' : '' }}">
                    <i class='bx bx-download'></i>
                    <span class="nav__name">Profissionais</span>
                </a>
                
                <a href="{{ route('admin.services') }}" class="nav__link {{ Request::is('admin/services') ? 'active-link' : '' }}">
                    <i class='bx bx-book-add'></i>
                    <span class="nav__name">Serviços</span>
                </a>
                
                <a class="nav__link">
                    <i class='bx bx-moon' id="theme-button"></i>
                    <span class="nav__name">Tema</span>
                </a>

                <a href="{{ route('login.logout') }}" class="nav__link logout">
                    <i class='bx bx-exit'></i>
                    <span class="nav__name">Sair</span>
                </a>
            </div>
        </nav>
    </div>

    <!--=============== MAIN ===============-->

    <main class="main">
        @yield('content')
    </main>


    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/js/menu.js') }}"></script>

</body>

</html>
