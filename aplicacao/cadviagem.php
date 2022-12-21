<!DOCTYPE html>
<?php
include "acaoviagem.php";
include '../connect/connect.php';
include "menu.php";
$acao = '';
$id = '';
$dados;
if (isset($_GET["acao"]))
    $acao = $_GET["acao"];
if ($acao == "editar") {
    if (isset($_GET["idviagem"])) {
        $codigo = $_GET["idviagem"];
        $dados = carregaBDParaVetor($codigo);
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $title; ?></title>
</head>

<body>

    <form action="acaoviagem.php" id="form" method="post">
        <div id="telaproduto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar viagem</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"> Código
                            <input class="form-control" readonly type="text" name="idviagem" id="idviagem" value="<?php if ($acao == "editar") echo $dados['idviagem'];
                                                                                                    else echo 0; ?>"><br>
                        </div>
                        <div class="form-group"> Cidade de Partida:
                            <input class="form-control" required=true type="text" name="partida" id="partida" value="<?php if ($acao == "editar") echo $dados['partida']; ?>"><br>
                        </div>
                        <div class="form-group"> Cidade de Destino:
                            <input class="form-control" required=true type="text" name="destino" id="destino" value="<?php if ($acao == "editar") echo $dados['destino']; ?>"><br>
                        </div>
                        <div class="form-group"> Data da Viagem:
                            <input class="form-control" required=true type="date" name="dataviagem" id="dataviagem" value="<?php if ($acao == "editar") echo $dados['dataviagem']; ?>"><br>
                        </div>
                        <div class="form-group"><label for="">Motorista</label>
                            <select class="form-control" name="motorista" id="motorista">
                                <?php
                                $sql = "SELECT * FROM transporte.motorista;";
                                var_dump($sql);
                                #$pdo = Conexao::getInstance();
                                #$consulta = $pdo->query($sql);
                                $result = mysqli_query($conexao, $sql);
                                var_dump($result);
                                #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['idmotorista'] . '"';
                                    if ($acao == "editar" && $dados['motorista'] == $row['idmotorista'])
                                        echo ' selected';
                                    echo '>' . $row['nome'] ." ".$row['sobrenome']. '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-success" name="acao" value="salvar" id="acao" type="submit">Salvar</button>
                            <button class="btn btn-outline-primary"><a href="listaviagem.php">Listar</a></button><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
</body>

</html>