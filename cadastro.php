<?php
try {
    include "abrir_transacao.php";
    include_once 'conecta-sqlite.php';
include_once "operacoes.php";

function validar($usuario) {
  
    return strlen($usuario["Nome"])
        && strlen($usuario["Nome"]) 
        && strlen($usuario["Idade"])
        && strlen($usuario["Idade"])
        && strlen($usuario["Email"])
        && strlen($usuario["Email"])
        && $usuario["Senha"]
        && $usuario["Senha"];
        
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $alterar = isset($_GET["Nome_ID"]);
    if ($alterar) {
        $Nome_ID = $_GET["Nome_ID"];
        $usuario = buscar_usuario($Nome_ID);
        if ($usuario == null) die("Não existe!");
    } else {
        $Nome_ID = "";
        $usuario = [
            "Nome" => "",
            "Idade" => "",
            "Email" => "",
            "Senha" => "",
              
        ];
    }
    $validacaoOk = true;

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alterar = isset($_POST["Nome_ID"]);

    if ($alterar) {
        $usuario = [
            "Nome" => $_POST["Nome"],
            "Idade" => $_POST["Idade"],
            "Email" => $_POST["Email"],
            "Senha" => $_POST["Senha"],
            

        ];
        $validacaoOk = validar($usuario);
        if ($validacaoOk) alterar_usuario($usuario);
    } else {
        $usuario = [
            "Nome" => $_POST["Nome"],
            "Idade" => $_POST["Idade"],
            "Email" => $_POST["Email"],
            "Senha" => $_POST["Senha"],
        ];
        $validacaoOk = validar($usuario);
        if ($validacaoOk) $id = inserir_usuario($usuario);
    }

    if ($validacaoOk) {
        header("Location: listagem.php");
        $transacaoOk = true;
    }
} else {
    die("Método não aceito");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de folhas</title>
        <script>
            function confirmar() {
                if (!confirm("Tem certeza que deseja salvar os dados?")) return;
                document.getElementById("formulario").submit();
            }

            function excluir() {
                if (!confirm("Tem certeza que deseja excluir o usuario?")) return;
                document.getElementById("excluir-usuario").submit();
            }
        </script>
    </head>
    <body>
        <form method="POST" action="cadastro.php" id="formulario">
            <?php if (!$validacaoOk) {?>
                <div>
                    <p>Preencha os campos corretamente!</p>
                </div>
            <?php } ?>
            <?php if ($alterar) { ?>
                <div>
                    <label for="Nome_ID">Nome_ID:</label>
                    <input type="text" id="Nome_ID" name="Nome_ID" value="<?= $usuario["Nome_ID"] ?>" readonly>
                </div>
            <?php } ?>
            <div>
                <label for="Nome">Nome:</label>
                <input type="text" id="Nome" name="Nome" value="<?= $usuario["Nome"] ?>">
            </div>
            <div>
                <label for="Idade">Idade:</label>
                <input type="text" id="Idade" name="Idade" value="<?= $usuario["Idade"] ?>">
            </div>
            <div>
                <label for="local"> Email:</label>
                <input type="text" id="Email" name="Email" value="<?= $usuario["Email"] ?>">
            </div>
            <div>
                <label for="Senha">Senha:</label>
                <input type="text" id="Senha" name="Senha" value="<?= $usuario["Senha"] ?>">
            </div>
           
            <div>
                <button type="button" onclick="confirmar()">Salvar</button>
            </div>
        </form>
        <?php if ($alterar) { ?>
            <form action="excluir.php"
                    method="POST"
                    style="display: none"
                    id="excluir-usuario">
                <input type="hidden" name="Nome_ID" value="<?= $excluir_usuario["Nome_ID"] ?>" >
            </form>
            <button type="button" onclick="excluir()">Excluir</button>
        <?php } ?>
    </body>
</html>

<?php
$transacaoOk = true;

} finally {
    include "fechar_transacao.php"; 
}
?>
