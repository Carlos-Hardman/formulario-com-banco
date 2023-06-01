<?php
try {
    include "abrir_transacao.php";
    include_once "operacoes.php";
    

$Nome_ID = (int) $_POST["Nome_ID"];
$id = excluir_usuario($Nome_ID);

header("Location: listagem.php");

$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>
