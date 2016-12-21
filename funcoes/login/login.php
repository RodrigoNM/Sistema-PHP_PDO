<?php

//FUNÇÃO LOGIN
function login($login, $senha){
    $pdo = conecta();
    try {
        $sql = "SELECT * FROM usuario WHERE login = ? AND  senha = ?";
        
        $logar = $pdo->prepare($sql);
        $logar->bindValue(1, $login, PDO::PARAM_STR);
        $logar->bindValue(2, $senha, PDO::PARAM_STR);
        $logar->execute();
        
        if ($logar->rowCount() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//PEGA LOGIN
function pegaLogin($login){
        $pdo = conecta();
    
    try {
        $sql = "SELECT * FROM usuario WHERE login = ?";
        
        $byLogin = $pdo->prepare($sql);
        $byLogin->bindValue(1, $login, PDO::PARAM_STR);
        $byLogin->execute();
        
        if ($byLogin->rowCount() == 1) {
            return $byLogin->fetch(PDO::FETCH_OBJ);
        } else {
            return FALSE;
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//VALIDA SE O USUARIO LOGADO
function logado($sessao){
    if (!isset($_SESSION[$sessao]) || empty($_SESSION[$sessao])){
        header("Location: index.php");
    } else {
        return TRUE;
    }
}