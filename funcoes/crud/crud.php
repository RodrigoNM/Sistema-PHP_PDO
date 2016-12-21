<?php

// FUNÇÃO DE CADASTRO
function cadastro($nome, $sexo, $dtnasc, $email, $login, $senha) {
    $pdo = conecta();

    try {
        $sql = "INSERT INTO usuario (nome, sexo, dtnasc, email, login, senha)
                VALUES (?, ?, ?, ?, ?, ?)";

        $usuario = $pdo->prepare($sql);
        $usuario->bindValue(1, $nome, PDO::PARAM_STR);
        $usuario->bindValue(2, $sexo, PDO::PARAM_STR);
        $usuario->bindValue(3, $dtnasc, PDO::PARAM_STR);
        $usuario->bindValue(4, $email, PDO::PARAM_STR);
        $usuario->bindValue(5, $login, PDO::PARAM_STR);
        $usuario->bindValue(6, $senha, PDO::PARAM_STR);
        $usuario->execute();

        if ($usuario->rowCount() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

//FUNÇÃO DE LISTAR
function listarUsuario() {
    $pdo = conecta();
    try {
        $sql = "SELECT * FROM usuario";

        $listar = $pdo->query($sql);

        if ($listar->rowCount() > 0) {
            return $listar->fetchAll(PDO::FETCH_OBJ);
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//FUNÇÃO DE PEGA ID
function pegaId($id) {
    $pdo = conecta();
    try {
        $sql = "SELECT * FROM usuario WHERE id = ?";

        $pegaid = $pdo->prepare($sql);
        $pegaid->bindValue(1, $id, PDO::PARAM_INT);
        $pegaid->execute();

        if ($pegaid->rowCount() > 0) {
            return $pegaid->fetch(PDO::FETCH_OBJ);
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//FUNÇÃO ATUALIZAR
function atualizar($nome, $login, $senha, $id) {
    $pdo = conecta();
    try {
        $sql = "UPDATE usuario SET nome = ?, login = ?, senha = ? WHERE id = ?";

        $atualizar = $pdo->prepare($sql);
        $atualizar->bindValue(1, $nome, PDO::PARAM_STR);
        $atualizar->bindValue(2, $login, PDO::PARAM_STR);
        $atualizar->bindValue(3, $senha, PDO::PARAM_STR);
        $atualizar->bindValue(4, $id, PDO::PARAM_INT);
        $atualizar->execute();

        if ($atualizar->rowCount() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//FUNÇÃO EXCLUIR
function excluir($id) {
    $pdo = conecta();
    try {
        $sql = "DELETE FROM usuario WHERE id = ?";

        $excluir = $pdo->prepare($sql);
        $excluir->bindValue(1, $id, PDO::PARAM_INT);
        $excluir->execute();

        if ($excluir->rowCount() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
