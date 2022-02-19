<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php' ?>
    <title>Login</title>
</head>

<body>
    <section id="section_login" class="form my-4 mx-5">
        <div class="container">
            <div class="row row-user no-gutters">
                <div class="col-lg-5 d-flex justify-content-center">
                    <img src="public/images/home.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="font-weight-bold py-3">Teste Promobit</h1>
                    <h4>Entrar na sua conta</h4>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" id="login_email" placeholder="Email" class="form-control my-3 p-4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" id="login_password" placeholder="Senha" class="form-control my-3 p-4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button id="btn_login" class="btn1 mt-3 mb-5">Login</button>
                        </div>
                    </div>
                    <!--<a href="forgot-password">Esqueci a senha</a>-->
                    <p>Ainda não possui uma conta?<a href="javascript:sectionLogin(false)"> Se registre</a></p>
                </div>
            </div>
        </div>
    </section>
    <section id="section_register" class="form my-4 mx-5" style='display:none'>
        <div class="container">
            <div class="row row-user no-gutters">
                <div class="col-lg-5">
                    <img src="public/images/home.jpg" alt="" class="img-fluid" style="height:100%"/>
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="font-weight-bold py-3">Teste Promobit</h1>
                    <h4>Entrar na sua conta</h4>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" id="register_name" placeholder="Nome" class="form-control my-3 p-4" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" id="register_email" placeholder="Email" class="form-control my-3 p-4" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" id="register_password" placeholder="Senha" class="form-control my-3 p-4" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" id="register_confirm_password" placeholder="Confirmar Senha" class="form-control my-3 p-4" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button id="btn_register" class="btn1 mt-3 mb-5">Registrar</button>
                        </div>
                    </div>
                    <p>Já possui uma conta?<a href="javascript:sectionLogin(true)">Entrar</a></p>
                </div>
            </div>
        </div>
    </section>
</body>
<?php include 'utils.php' ?>
<script src='public/js/utils.js'></script>
<script src='public/js/user.js'></script>

</html>