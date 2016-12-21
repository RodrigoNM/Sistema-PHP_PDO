<?php
ob_start(); session_start();
require_once 'funcoes/banco/conexao.php';
require_once 'funcoes/login/login.php';
require_once 'funcoes/crud/crud.php';
logado('usuario');
if (isset($_GET['logout']) && $_GET['logout'] == 'true'){
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Locadora - Rodrigo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/estilos.css" rel="stylesheet" media="screen">

    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
<!--                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->
                    <a class="navbar-brand" href="#">LOCADORA</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">

                    <p class="pull-right logout">
                        Bem Vindo: Rodrigo &nbsp
                        <a href="?logout=true" class="btn btn-danger">Sair</a>
                    </p>

                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="linha">HOME</h2>
                    <div class="box">

                        <div class="box-title">Filmes Cadastrados</div>
                        <div class="box-content nopadding">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Data de Nascimento</th>
                                        <th>Email</th>
                                        <th>Login</th>
                                        <th width="200">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td  colspan="5"><img src="img/load.gif" class="load" alt="Carregando"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <h2 class="linha">Menu</h2>
                    <div class="bloco">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge"><?php echo count(listarUsuario()); ?></span>
                                Registros
                            </li>
                        </ul>
                        
                        <div class="list-group">
                            <a href="#" class="list-group-item active">Administrador</a>
                            <a href="#" class="list-group-item" id="janela">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cadastro</h4>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/painel.js"></script>
    </body>
</html>
<?php ob_end_flush(); 