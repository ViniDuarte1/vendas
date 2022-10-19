<?php
session_start();
include('verifica_login.php');
// Conecta ao banco de dados
include 'connect.php';

// SE botão submit vai incluir novo registro
if (isset($_POST['submit'])) {
    $id   = $_POST['id'];
    $nome = $_POST['nome'];
    // Comando SQL que insere um novo usuario
    $sql = "insert into vendedor (nome) values
    ('$nome')";
    // Comando que executa o SQL na conexão do banco
    $result = mysqli_query($con,$sql);
    // se incluiu novo usuário, abre a página caddisplay.php
    if ($result) {
        header('location:venddisplay.php');
    } else {
        die(mysqli_error($con));
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Vendedores</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Vendedores</h1>
        <!-- Grupo de input para incluir no método POST pelo botão Enviar -->
        <form method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome">
            </div>
        <!-- Botão enviar: submit para incluir novo usuário -->
            <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
        <!-- Botão Voltar para o caddisplay sem incluir novo usuário -->
            <button type="button" class="btn btn-primary"><a href="venddisplay.php" style="color: white;"> Voltar</a></button>

        </form>
    </div>
</body>

</html>