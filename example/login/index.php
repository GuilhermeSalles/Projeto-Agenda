<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon/icon.png" type="image/x-icon" />
    <title>Barbearia TG</title>

    <script src="https://kit.fontawesome.com/7c3c15621b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
</head>

<body>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/login.css">
    <div class="login">
        <div class="login__content">
            <div class="login__img">

                <img src="assets/img/login/fundo.png" class="pequeno" style="margin-bottom: 40px; width: 502px;" alt="">

            </div>

            <div class="login__forms">
                <form action="/login" method="POST" class="login__registre" id="login-in">
                    <h1 class="login__title">Acesso restrito</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="login" placeholder="Usuário" class="login__input">
                    </div>

                    <div class="login__box input">
                        <div class="input__overlay" id="input-overlay"></div>
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Senha" class="login__input input__password" id="input-pass">
                        <i class='bx bx-hide input__icon' id="input-icon"></i>
                    </div>

                    <a href="#" class="login__forgot">Esqueceu a senha?</a>


                    <a href="#" class="login__button">Entrar</a>

                    <div>
                        <span class="login__account">Quer entrar com google ?</span>
                        <span class="login__signin" id="sign-up">Clique aqui</span>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--===== MAIN JS =====-->
    <script src="assets/js/login.js"></script>
</body>

</html>