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

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
     crossorigin="anonymous"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4/bootstrap/bootstrap.min.css">

    <!-- Iconic CSS-->
    <link rel="stylesheet" href="iconic/font/css/open-iconic-bootstrap.css">

    <!-- fontawesome CSS-->
    <link rel="stylesheet" href="fontawesome/css/all.css">

    <title>Login</title>

    <style>
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header class="bg-dark img-thumbnail">
        <nav class="navbar">
            <div class="px-4 navbar-brand">
                <img src="imagens/logo.png" class="d-inline-block align-top">
            </div>

            <ul class="px-4 navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logoff.html">Sair</a>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="row justify-content-around py-5">
            <div class="col-9">
                <div class="card">
                    <div class="card-header text-center">
                        Informações dos usuários
                    </div>
                    <div class="p-0 card-body">
                        <table class="text-center table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>id</th>
                                    <th>Email</th>
                                    <th>Nome</th>
                                    <th>Grau de acesso</th>
                                    <th>Alterar / Remover</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>00001</td>
                                    <td>jesimiel.dias@gmail.com</td>
                                    <td>Jesimiel</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-warning">Alterar</button>
                                        <button class="btn btn-danger">Remover</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>00001</td>
                                    <td>jesimiel.dias@gmail.com</td>
                                    <td>Jesimiel</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-warning">Alterar</button>
                                        <button class="btn btn-danger">Remover</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>00001</td>
                                    <td>jesimiel.dias@gmail.com</td>
                                    <td>Jesimiel</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-warning">Alterar</button>
                                        <button class="btn btn-danger">Remover</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark">
        <div class=" container py-3">
            Orgulhosamente desenvolvido por talvez um estagiário da Mind Consulting 2020.
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="bootstrap4/js/bootstrap.min.js"></script>

</body>

</html>