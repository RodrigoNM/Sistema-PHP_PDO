<?php

//CONSTANTES
define('HOST', 'localhost');
define('LOGIN', 'postgres');
define('SENHA', 'postgres');
define('DBNAME', 'bd_login_web');

//FUNÇÃO DE CONEXÃO
function conecta() {
    $dns = "pgsql:host=".HOST.";dbname=".DBNAME;
    
    try {
        $conn = new PDO($dns, LOGIN, SENHA);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
        
    } catch (PDOException $erro) {
        echo $erro->getMessage();
    }
}