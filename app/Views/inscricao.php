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
    <script src="<?php echo base_url('assets/scripts/inscricao.js'); ?>"></script>

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
     crossorigin="anonymous"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href='<?php echo base_url("assets/bootstrap4/bootstrap/bootstrap.min.css"); ?>'>

    <!-- Iconic CSS-->
    <link rel="stylesheet" href='<?php echo base_url("assets/iconic/font/css/open-iconic-bootstrap.css"); ?>'>

    <!-- fontawesome CSS-->
    <link rel="stylesheet" href='<?php echo base_url("assets/fontawesome/css/all.css"); ?>'>

    <title>Formulário de cadastro</title>

    <style>
       
    </style>
</head>

<body>
    <header class="bg-dark img-thumbnail">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src='<?php echo "assets/img/logo.png"; ?>' class="d-inline-block align-top">
            </div>

            <ul class="px-4 navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('Login_controller'); ?>">Login</a>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="row justify-content-around">

            <div class="row justify-content-around pt-5">

                <div class="row card col-10">
                    <div class="card-header row">
                        Inscrever-se
                    </div>

                    <form class="card-body row justify-content-around">
                        <div class="col-12 form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Digite seu nome">
                            <span class = "text-danger" id ="erro_nome"></span>
                        </div>

                        <div class="col-12 form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Digite seu e-mail">
                            <span class = "text-danger" id ="erro_email"></span>
                        </div>

                        <div class="col-12 form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" id="senha" name="senha" placeholder="Crie uma senha">
                            <span class = "text-danger" id ="erro_senha"></span>
                        </div>

                        <div class="row col-12 justify-content-around">
                            <input class="col-6 btn btn-large btn-info" type="submit" id="inscrever_se" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="align-self-end text-white bg-dark">
        <div class="container py-3">
            Orgulhosamente desenvolvido por talvez um estagiário da Mind Consulting 2020.
        </div>
    </footer>
    <input id="base_url" type="hidden" value="<?php echo base_url(); ?>" ;>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src='<?php echo base_url("assets/bootstrap4/js/bootstrap.min.js"); ?>'></script>
</body>

</html>