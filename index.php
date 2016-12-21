<?php
session_start();
require_once 'funcoes/banco/conexao.php';
require_once './funcoes/crud/crud.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - BEM VINDO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/estilos.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="css/estiloCadastroUsuario.css"/>

    </head>
    <body>
        <div id="cadastrar"><a href="#" id="novoUsuario" title="Cadastre-se e faça parte da nossa equipe!">Cadaste-se&raquo;</a></div>

        <div class="container">
            <div class="login">
                <h2>ÁREA RESTRITA</h2>
                <div class="retorno"></div>
                <form action="" class="form" method="post" name="form_login">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" name="login" class="form-control input-lg" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" name="senha" class="form-control input-lg" placeholder="Senha">
                    </div>


                    <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> Logar</button>
                    <img src="img/load.gif" class="load" alt="Carregando!" style="display: none">
                </form>
                <center><img src="img/load-bar.gif" align="center" id="load" 
                             alt="Carregando" style="display: none"/></center>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cadastre-se</h4>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="js/mascara.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/novoUsuario.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>