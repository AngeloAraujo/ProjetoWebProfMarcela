 
<!DOCTYPE html>
<?php

include "../config/conexao.php";
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
    <title>Lista de Motorista</title>
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
                    <h5 class="modal-title">Motorista</h5></div>
   <div class="modal-body">
        <div class="form-group">
        Consultar por: 
        <input type="radio" name="optionSearchUser" id="" value="idmotorista" required>Código
        <input type="radio" name="optionSearchUser" id="" value="nome" required>Nome
        <div class="form-group"> Ordenar por:
        <input type="radio" name="optionOrderUser" id="" value="idmotorista" required>Código
        <input type="radio" name="optionOrderUser" id="" value="nome" required>Nome
        
    
        <input class="form-control" type="text" name="valorUser"> <br>
        <input class="btn btn-outline-warning bt-xs"  type="submit" value="Consultar">
        <button class="btn btn-outline-danger bt-xs"><a  href="cadUsuario.php">Cadastrar Novo Motorista</a></button>
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
        $optionOrderUser = isset($_POST["optionOrderUser"]) ? $_POST["optionOrderUser"] : "idmotorista";
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

        $sql = ("SELECT idmotorista, nome, sobrenome, dtnasc, idade, email, endereco, enderecorua , cidade , telefone, senha FROM motorista WHERE motorista.idmotorista = endereco.idmotorista;");   

        if ($optionSearchUser != "") {
            if ($optionSearchUser == "idmotorista") {
                $sql = ("SELECT idmotorista, nome, sobrenome, dtnasc, idade, email, endereco, enderecorua , cidade , telefone, senha  FROM motorista 
                WHERE  motorista.idmotorista = $valorUser ORDER BY $optionOrderUser;"); 
            }elseif ($optionSearchUser == "nome") {
                $sql =("SELECT idmotorista, nome, sobrenome, dtnasc, idade, email, endereco, enderecorua , cidade , telefone, senha FROM motorista
                 WHERE motorista.idmotorista =idmotorista AND $optionSearchUser LIKE '$valorUser%' ORDER BY $optionOrderUser;");   
            } 
        } 
        if($valorUser == ""){
            $sql =  ("SELECT idmotorista, nome, sobrenome, dtnasc, idade, email, endereco, enderecorua , cidade , telefone, senha FROM motorista WHERE motorista.idmotorista = idmotorista ORDER BY $optionOrderUser;");
        }

        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);

        echo "<br><div class='table-responsive'><table class='table table-hover table-dark'><tr><th scope='col'>Codigo</th><th scope='col'>Nome</th scope='col'><th>Sobrenome</th><th scope='col'>Idade</th>
        <th scope='col'>Data de Nascimento</th><th scope='col'>E-mail</th><th scope='col'>Endereco</th><th scope='col'>Enderecorua</th>
        <th scope='col'>Cidade</th><th scope='col'>Telefone</th><th scope='col'>Senha</th><th scope='col'>Alterar</th><th scope='col'>Excluir</th></tr></div>";
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <tr>
                <td scope="row"><?php echo $linha['idmotorista']; ?></td>
                <td scope="row"><?php echo $linha['nome']; ?></td>
                <td scope="row"><?php echo $linha['sobrenome']; ?></td>
                <td scope="row"><?php echo $linha['dtnasc']; ?></td>
                <td scope="row"><?php echo $linha['idade']; ?></td>
                <td scope="row"><?php echo $linha['email']; ?></td>
                <td scope="row"><?php echo $linha['endereco']; ?></td>
                <td scope="row"><?php echo $linha['enderecorua']; ?></td>
                <td scope="row"><?php echo $linha['cidade']; ?></td>
                <td scope="row"><?php echo $linha['telefone']; ?></td>
                <td scope="row"><?php echo $linha['senha']; ?></td>
        
                <td scope="row"><a href='cadUsuario.php?acao=editar&idmotorista=<?php echo $linha['idmotorista']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                <td scope="row"><a href="javascript:excluirRegistro('acao.php?acao=excluir&idmotorista=<?php echo $linha['idmotorista']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
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