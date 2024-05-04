<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/icon/icon.png') }}" type="image/x-icon" />
    <title>Barbearia TG</title>

    <script src="https://kit.fontawesome.com/7c3c15621b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

</head>

<body>
    <!-- ===== CSS ===== -->
    <div class="login">
        <div class="login__content">
            <div class="login__img">

                <img src="{{ asset('assets/img/login/fundo.png') }}" class="pequeno"
                    style="margin-bottom: 40px; width: 502px;" alt="">

            </div>

            <div class="login__forms">
                <form action="{{ route('login.auth') }}" method="POST" class="login__registre" id="login-in">
                    @csrf
                    <h1 class="login__title">Acesso restrito</h1>
                    @if ($mensagem = Session::get('erro'))
                        <h4 class="login__account">{{ $mensagem }}</h4>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <h4 class="login__account">{{ $error }}</h4>
                        @endforeach

                    @endif

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="email" name="email" placeholder="Email" class="login__input">
                    </div>


                    <div class="login__box input">
                        <div class="input__overlay" id="input-overlay"></div>
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Senha" class="login__input input__password"
                            id="input-pass">
                        <i class='bx bx-hide input__icon' id="input-icon"></i>
                    </div>
                    <a href="#" class="login__forgot">Esqueceu a senha?</a>

                    <button type="submit" class="login__button" style="width: 100%; display: block;">Entrar</button>


                    <div>
                        <span class="login__account">Quer entrar com google ?</span>
                        <span class="login__signin" id="sign-up">Clique aqui</span>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <!--===== MAIN JS =====-->
    <script src="{{ asset('assets/js/login.js') }}"></script>

    <script>
        document.getElementById("input-icon").addEventListener("click", function() {
            var passwordInput = document.getElementById("input-pass");
            var icon = document.getElementById("input-icon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");
            }
        });
    </script>
    
</body>

</html>