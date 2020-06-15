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

    <script src="<?php echo base_url('assets/scripts/informacoes_usuarios.js'); ?>"></script>
    <link rel="stylesheet" href='<?php echo base_url("assets/css/estilo_listage .css"); ?>'>

    <style>
        html,body {
            height: 100%;
            font-family: Helvetica, "Trebuchet MS", sans-serif;
            background: #faf9f9;
        }
        
    </style>

    <title>Listagem de usuários</title>
</head>

<body class="row">
    <header class="col-12 bg-dark img-thumbnail">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src='<?php echo "assets/img/logo.png"; ?>' class="d-inline-block align-top">
            </div>

            <ul class="px-4 navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="voltar" href="#">Voltar</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="col-12">
        <div class="row justify-content-around py-5">

            <div class="col-10">
                <div class="card">
                    <div class="card-header text-center">
                        Informações dos usuários
                    </div>
                    <div class="p-0 card-body">
                        <table id="tabela" class="text-center table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>cpf</th>
                                    <th>email</th>
                                    <th>Grau de acesso</th>
                                    <th>Alterar / Remover</th>
                                </tr>
                            </thead>

                            <tbody id="tabela_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="col-12 mt-4 text-white bg-dark align-self-end">
        <div class="py-3 container">
            Orgulhosamente desenvolvido por talvez um estagiário da Mind Consulting 2020.
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src='<?php echo base_url("assets/bootstrap4/js/bootstrap.min.js"); ?>'></script>
</body>

</html>