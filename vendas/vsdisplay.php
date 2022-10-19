<?php
session_start();
include('verifica_login.php');
// conectar ao banco de dados
include 'connect.php';
// informar o comando select para exibir
$sql = 'SELECT S.ID id, S.IDPRODUTO idproduto, P.NOME produto, 
        S.IDVENDEDOR idvendedor, V.NOME vendedor,
        S.QUANTIDADE quantidade, S.PRECO preco, S.DATAVENDA datavenda
     FROM VENDA S, PRODUTO P, VENDEDOR V
     WHERE P.ID = S.IDPRODUTO AND V.ID = S.idvendedor';
// ao apertar button Consulta, submit para pesquisa parcial. linha 34.
if (isset($_POST['submit'])) {
    $pesqnome = $_POST['pesqnome'];
    $sql = 'select * from venda where nome like "%' . $pesqnome . '%"';
} else {
    $pesqnome = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Consulta Vendas</title>
</head>

<body>
<div class="alert alert-primary" style="text-align: right;">
        Olá, <a href="caddisplay.php"> <?php echo $_SESSION['login']; ?>
        </a>
        <!-- Botão Menu para voltar à tela principal do sistema -->
        <button type="button" class="btn btn-primary">
            <a href="menu.php" style="color: white;"> Menu</a></button>
        <!-- Botão Menu para sair do sistema -->
        <button type="button" class="btn btn-primary">
            <a href="logout.php" style="color: white;">Sair</a></button>
        </a>
    </div>
 </div>
    <!-- prepara button submit para executar consulta no PHP. Linha 7 -->
    <form method="post">
        <div class="container">
            <br>
            <div class="container">
                <div class="jumbotron" style="padding-top: 2px; padding-bottom: 12px;">
                    <h3 class="text-center">Pesquisa Vendas</h3>
                    <label for="">Vendedor Parcial</label>
                    <!-- valor a ser inserido como like no Select Linha 9 -->
                    <input type="text" name="pesqnome" value="<?php echo $pesqnome ?>">
                    <!-- botão responsável pelo submit para consulta parcial do Select -->
                    <button type="submit" name="submit" class="btn btn-primary">Consulta</button>
                </div>
            </div>
            <!-- Botão Inclusão para incluir novo usuário -->
            <button type="button" class="btn btn-primary">
                <a href="vsuser.php" style="color: white;"> Inclusão</a></button>


<!-- Inicio da tabela de consulta -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">CodProd</th>
                        <th scope="col">Produto</th>
                        <th scope="col">CodVend</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">DataVenda</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Executa o SELECT para exibir dados na tabela
                    $result = mysqli_query($con, $sql);
                    // Se retornou dados, monta a tabela por quantidade de registros.
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $idproduto = $row['idproduto'];
                            $idvendedor = $row['idvendedor'];
                            echo "<tr>
                           <td>" . $row['id'] . "</td>
                           <td>" . $row['idproduto'] . "</td>
                           <td>" . $row['produto'] . "</td>
                           <td>" . $row['idvendedor'] . "</td>
                           <td>" . $row['vendedor'] . "</td>
                           <td>" . $row['quantidade'] . "</td>
                           <td>" . $row['preco'] . "</td>
                           <td>" . $row['datavenda'] . "</td>
                           <td>
                           <button type='button' class='btn btn-success'>
                           <a href='vsupdate.php?updateid=".$id."&upidproduto=".$idproduto.
                                    "&upidvendedor=".$idvendedor."' style='color:white;'> Altera </a> </button>
                           <button type='button' class='btn btn-danger'>
                           <a href='vsdelete.php?deleteid=" . $id . "' style='color:white;'> Exclui </a> </button> </td>";
                        //    Acima, no último TD, são gerados os botões Altera e Exclui
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</body>

</html>