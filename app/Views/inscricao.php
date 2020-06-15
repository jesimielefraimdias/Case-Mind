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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
     crossorigin="anonymous"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href='<?php echo base_url("assets/bootstrap4/bootstrap/bootstrap.min.css"); ?>'>

    <link rel="stylesheet" href='<?php echo base_url("assets/css/estilo_inscricao.css"); ?>'>

    <style>
        html, body {
            height: 100%;
            font-family: Helvetica, "Trebuchet MS", sans-serif;
            background: #faf9f9;
        }
    </style>
    <title>Formulário de cadastro</title>

</head>

<body class = "row">
    <header class="col-12 bg-dark">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src='<?php echo "assets/img/logo.png"; ?>' class="d-inline-block align-top">
            </div>

            <ul class="px-5 navbar-nav ml-auto">
                <li class="nav-item">
                    <a id="login" class="nav-link" href="#">Login</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class = "col-12">
        <div class="row justify-content-around">
            <div class="row justify-content-around">

                <div class="row card col-10">
                    <div class="card-header row">
                        Inscrever-se:
                    </div>

                    <form id="form_inscricao" class="card-body row justify-content-around" enctype="multipart/form-data">

                        <div class="col-3 form-group text-center align-self-center">
                            <input class="btn btn-block btn-info" type="file" id="imagem_perfil" name="imagem_perfil" class="btn">
                            <img src='<?php echo "assets/img/perfil.jpg"; ?>' id="imagem_perfil_previa" name="imagem_perfil_previa" class="img-fluid .img-thumbnail">
                            <div class="d-block text-danger" id="erro_imagem"></div>
                        </div>

                        <div class="col-9 align-self-center">
                            <div class="col-12 form-group">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" id="nome" name="nome" placeholder="Digite seu nome">
                                <span class="text-danger" id="erro_nome"></span>
                            </div>

                            <div class="col-12 form-group">
                                <label for="cpf">CPF:</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" placeholder="Digite seu cpf">
                                <span class="text-danger" id="erro_cpf"></span>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="email">E-mail:</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Digite seu e-mail">
                            <span class="text-danger" id="erro_email"></span>
                        </div>

                        <div class="col-6 form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" id="senha" name="senha" placeholder="Crie uma senha">
                            <span class="text-danger" id="erro_senha"></span>
                        </div>

                        <div class="row col-12 justify-content-around">
                            <input class="col-6 btn btn-large btn-info" type="submit" id="inscrever_se" value="Inscrever-se">
                            <div class="col-12 text-danger text-center" id="erro_inserir"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="col-12 bg-dark align-self-end">
        <div class="container">
            Orgulhosamente desenvolvido por talvez um estagiário da Mind Consulting 2020.
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src='<?php echo base_url("assets/bootstrap4/js/bootstrap.min.js"); ?>'></script>
</body>

</html>