<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- 
        * Viewport é toda área que o usuário consegue visualizar.
        * Width=device-width, é a largura do dispositivo em questão.
        * initial-scale, define, basicamente, a escala inicial do site, por exemplo, o zoom inicial.
        * shrink-to-fit, ele não deixa reduzir o conteúdo.

    -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="<?php echo base_url('assets/scripts/jquery-3.5.1.js'); ?>"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
   

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
     crossorigin="anonymous"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href='<?php echo base_url("assets/bootstrap4/bootstrap/bootstrap.min.css"); ?>'>

    <link rel="stylesheet" type = "text/css" href='<?php echo base_url("assets/css/estilo_inscricao.css"); ?>'>

    <script src="<?php echo base_url('assets/scripts/login.js'); ?>"></script>
    
    <title>Login</title>
    <style>
        html,body {
            height: 100%;
            font-family: Helvetica, "Trebuchet MS", sans-serif;
            background: #faf9f9;
        }
        
    </style>
</head>

<body class = "row">
    <header class="col-12 bg-dark">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src='<?php echo "assets/img/logo.png";?>' class="d-inline-block align-top">
            </div>

            <ul class="px-5 navbar-nav ml-auto">
                <li class="nav-item">
                    <a id = "inscrever_se" class="nav-link" href="#">Inscreva-se</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class = "col-12">
        <div class="row justify-content-around">
            <div class="col-4 py-5">
                <div class="card">
                    <div class="card-header">
                        Login:
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input name="emailorcpf" id="emailorcpf" type="text" class="form-control" placeholder="E-mail ou CPF">
                                <div class = "text-danger" id ="erro_emailorcpf"></div>
                            </div>

                            <div class="form-group">
                                <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha">
                                <div class = "text-danger" id ="erro_senha"></div>
                            </div>
                            <input id="entrar" class="mb-4 btn btn-lg btn-info btn-block" type="submit" value="Entrar">
                        </form>
                        <div class = "text-center text-danger" id ="erro_login"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="col-12 align-self-end text-white bg-dark">
        <div class="container py-3">
            Orgulhosamente desenvolvido por talvez um estagiário da Mind Consulting 2020.
        </div>
    </footer>    
    
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src='<?php echo base_url("assets/bootstrap4/js/bootstrap.min.js"); ?>'></script>
</body>

</html>