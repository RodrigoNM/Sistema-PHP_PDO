<?php
ob_start(); session_start();
require_once '../funcoes/banco/conexao.php';
require_once '../funcoes/login/login.php';
require_once '../funcoes/crud/crud.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
sleep(1);
switch($acao){
    //REALIZA LOGIN
    case 'login':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (login($login, $senha)) {
            //CRIA A SESSÃO
            $_SESSION['usuario'] = pegaLogin($login);
        } else {
            $dados = pegaLogin($login);
        }
        if (empty($login) || empty($senha)) {
            echo 'vazio';
        } elseif (!$dados) {
            echo 'naoexiste';
        } elseif ($dados->senha != $senha) {
            echo 'senhadiferente';
        }
    break;

//REALIZA CADASTRO
    case 'cadastro':
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
        $dtnasc = filter_input(INPUT_POST, 'dtnasc', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (cadastro($nome, $sexo, $dtnasc, $email, $login, $senha)) {
            echo 'cadastrou';
        }
        break;

//REALIZA EDIÇÃO
    case 'edit':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if (atualizar($nome, $login, $senha, $id)) {
            echo 'atualizou';
        }
    break;

//RELIZA EXCLUSÃO   
    case 'excluir':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (excluir($id)) {
            echo 'excluiu';
        }
    break;
    
    default:
        echo 'ERRO DEFAULT controller.php!';
    break;
}
ob_end_flush();