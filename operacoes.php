<?php

include_once "conecta-sqlite.php";

function inserir_usuario($usuario) {
    global $pdo;
    $sql = "INSERT INTO usuario (Nome, Idade, Email, Senha) " .
            "VALUES (:Nome, :Idade, :Email, :Senha)";
    $pdo->prepare($sql)->execute($usuario);
    return $pdo->lastInsertId();
}

function alterar_usuario($usuario) {
    global $pdo;
    $sql = "UPDATE usuario SET " .
            "Nome = :Nome, " .
            "Idade = :Idade, " .
            "Email = :Email, ".
            "Senha = :Senha, " .
            "WHERE Nome_ID = :Nome_ID";
    $pdo->prepare($sql)->execute();
}

function excluir_usuario($Nome_ID) {
    global $pdo;
    $sql = "DELETE FROM usuario WHERE Nome_ID = :Nome_ID";
    $pdo->prepare($sql)->execute(["Nome_ID" => $Nome_ID]);
}

function listar_todos_usuario() {
    global $pdo;
    $sql = "SELECT * FROM usuario";
    $resultados = [];
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch()) {
        $resultados[] = $linha;
        
    }
    return $resultados;
}

function buscar_usuario($Nome_ID) {
    global $pdo;
    $sql = "SELECT * FROM usuario WHERE Nome_ID = :Nome_ID";
    $resultados = [];
    $consulta = $pdo->prepare($sql);
    $consulta->execute(["Nome_ID" => $Nome_ID]);
    return $consulta->fetch();
}



