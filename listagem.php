<?php
try {
    include "abrir_transacao.php";
include_once "operacoes.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Listagem de Usuario</title>
    </head>
    <body>
        <?php $resultado = listar_todos_usuario(); ?>
        <table>
            <tr>
                <th scope="column" style='padding:0px 20px 0px;'>Nome_ID</th>
                <th scope="column" style='padding:0px 20px 0px;'>Nome</th>
                <th scope="column" style='padding:0px 20px 0px;'>Idade</th>
                <th scope="column" style='padding:0px 20px 0px;'>Email</th>
                <th scope="column" style='padding:0px 20px 0px;'>Senha</th>
                <th scope="column" style='padding:0px 20px 0px;'></th>
                <th scope="column" style='padding:0px 20px 0px;'></th>
            </tr>
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td style='padding:0px 35px 0px;'><?= $linha["Nome_ID"] ?></td>
                    <td style='padding:0px 35px 0px;'><?= $linha["Nome"] ?></td>
                    <td style='padding:0px 35px 0px;'><?= $linha["Idade"] ?></td>
                    <td style='padding:0px 35px 0px;'><?= $linha["Email"] ?></td>
                    <td style='padding:0px 35px 0px;'><?= $linha["Senha"] ?></td>
                    <td>
                        <button type="button">
                            <a href="cadastro.php?Nome_ID=<?= $linha["Nome_ID"] ?>">Editar</a>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <button type="button"><a href="cadastro.php">Criar novo</a></button>
    </body>
</html>

<?php

$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>

