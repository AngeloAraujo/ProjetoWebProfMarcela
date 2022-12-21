 
<!DOCTYPE html>
<?php
require_once "../config/conexao.php";
?>
<html lang="pt-br">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Lista de Usuários</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
        table {
            text-align: center;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 5px;
            border-style: hidden;
            /* hide standard table (collapsed) border */
            box-shadow: 0 0 0 1px black;
            /* this draws the table border  */
        }

        tr,
        th,
        td {
            border: 1px solid black;
        }

        th {
            width: 150px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
<?php
    include  "menu.php" ;
?>

    <form method="POST">
    <div id="telaproduto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Viagens</h5></div>
   <div class="modal-body">
        <div class="form-group"> <b>Consultar por: </b><br>
        <input type="radio" name="optionSearchUser" id="" value="idviagem" required>Código<br>
        <input type="radio" name="optionSearchUser" id="" value="destino" required>Destino<br>
        <div class="form-group"> <b>Ordenar por:</b><br>
        <input type="radio" name="optionOrderUser" id="" value="idviagem" required>Código<br>
        <input type="radio" name="optionOrderUser" id="" value="dataviagem" required>Data da viagem<br>
        <br>
        <input class="form-control" type="text" name="valorUser"> <br>
        <input class="btn btn-outline-warning bt-xs"  type="submit" value="Consultar">
        <button class="btn btn-outline-danger bt-xs"><a  href="cadviagem.php">Nova Viagem</a></button>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </form>
    <?php
  try {

    $optionSearchUser = isset($_POST["optionSearchUser"]) ? $_POST["optionSearchUser"] : "";
    $optionOrderUser = isset($_POST["optionOrderUser"]) ? $_POST["optionOrderUser"] : "idviagem";
    $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

    $sql = ("SELECT viagem.idviagem, partida, destino, dataviagem,id_motorista, nome, sobrenome  FROM viagem, motorista WHERE viagem.id_motorista = motorista.idmotorista;");   

    if ($optionSearchUser != "") {
        if ($optionSearchUser == "idviagem") {
            $sql = (" SELECT viagem.idviagem, partida, destino, dataviagem,id_motorista, nome, sobrenome FROM viagem, motorista WHERE viagem.id_motorista = motorista.idmotorista AND viagem.idviagem = $valorUser ORDER BY $optionOrderUser;"); 
        }elseif ($optionSearchUser == "destino") {
            $sql =(" SELECT viagem.idviagem,partida, destino, dataviagem,id_motorista, nome, sobrenome FROM viagem, motorista WHERE viagem.id_motorista = motorista.idmotorista AND $optionSearchUser LIKE '$valorUser%' ORDER BY $optionOrderUser;");   
        }  
    } 
    if($valorUser == ""){
        $sql =  ("SELECT viagem.idviagem,partida, destino, dataviagem,id_motorista, nome, sobrenome FROM viagem, motorista WHERE viagem.id_motorista = motorista.idmotorista ORDER BY $optionOrderUser;");
    }

    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    
    echo "<br><div class='table-responsive'><table class='table table-hover table-dark'><tr><th scope='col'>Codigo da Viagem</th><th scope='col'>Partida</th scope='col'><th>Destino</th>
    <th scope='col'>Data da Viagem</th><th scope='col'>Codigo do Motorista</th><th scope='col'>Nome</th><th scope='col'>Sobrenome</th>
    <th scope='col'>Alterar</th><th scope='col'>Excluir</th></tr></div>";
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        
?> 
        <tr>
            <td><?php echo $linha['idviagem']; ?></td>
            <td><?php echo $linha['partida']; ?></td>
            <td><?php echo $linha['destino']; ?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['dataviagem'])); ?></td>
            <td><?php echo $linha['id_motorista']; ?></td>
            <td><?php echo $linha['nome']; ?></td>
            <td><?php echo $linha['sobrenome']; ?></td>
            <td><a href='cadviagem.php?acao=editar&idviagem=<?php echo $linha['idviagem']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acaoviagem.php?acao=excluir&idviagem=<?php echo $linha['idviagem']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
        </tr>
    <?php } ?>
    </table>
<?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

</body>

</html>