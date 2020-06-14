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

    <!-- Iconic CSS-->
    <link rel="stylesheet" href='<?php echo base_url("assets/iconic/font/css/open-iconic-bootstrap.css"); ?>'>

    <!-- fontawesome CSS-->
    <link rel="stylesheet" href='<?php echo base_url("assets/fontawesome/css/all.css"); ?>'>

    <script src="<?php echo base_url('assets/scripts/home.js'); ?>"></script>
    <title>Home usuário</title>
</head>

<body>
    <header class="bg-dark img-thumbnail">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src='<?php echo "assets/img/logo.png"; ?>' class="d-inline-block align-top">
            </div>

            <ul class="px-4 navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="sair" href="#">Sair</a>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="row">
            <div class="bg-secondary col-2">
                <nav id="home_nav" class="navbar">
                    <ul class="pl-2 navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" id="documentacao" href="#">Documentação</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="meus_dados" href="#">Meus dados</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="alterar_dados" href="#">Alterar meus dados</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div id="info" class="mx-2 pb-4 py-1 col-9 row border">
                
            </div>
    </section>

    <footer class="mt-4 text-white bg-dark align-self-end">
        <div class="py-3 container">
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