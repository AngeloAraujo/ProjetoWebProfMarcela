<?php

require_once "../config/conexao.php";
include '../connect/connect.php';

$acao = '';
if (isset($_GET["acao"]))
    $acao = $_GET["acao"];

if ($acao == "excluir") {
    $codigo = 0;
    if (isset($_GET["idviagem"])) {
        $codigo = $_GET["idviagem"];
        excluir($codigo);
    }
} else {
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
        if ($acao == "salvar") {
            $codigo = 0;
            if (isset($_POST["idviagem"])) {
                $codigo = $_POST["idviagem"];
                if ($codigo == 0)
                    inserir();
                else
                    alterar($codigo);
            }
        }
    }
}

function excluir($codigo)
{
    $sql = " DELETE FROM viagem WHERE idviagem = $codigo;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    if ($result == 1)
        header('location:listaviagem.php');
    else
        header('location:listaviagem.php');
}

function alterar($codigo)
{
   
    $vet = carregarTelaParaVetor();
    var_dump($vet);
    $sql = 'UPDATE ' . $GLOBALS['tb_viagem'] .
        ' SET id_motorista = "' . $vet['motorista'] . '"' .
        ', partida = "' . $vet['partida'] . '"' .
        ', destino = "' . $vet['destino'] . '"' .
        ', dataviagem = "' . $vet['dataviagem'] . '"' .
        ' WHERE idviagem = ' . $codigo;
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    
    if ($result == 1)
        header('location:cadviagem.php?msg="sa"&acao=editar&idviagem=' . $codigo);
    else
        header('location:cadviagem.php?msg="er"&acao=editar&idviagem=' . $codigo);
}

function inserir()
{

    $dados = carregarTelaParaVetor();
    var_dump($dados);

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO viagem (idviagem, partida, destino, dataviagem, id_motorista) 
                            VALUES (:idviagem, :partida, :destino, :dataviagem, :id_motorista)');
    $codigo = $dados['idviagem'];
    $partida = $dados['partida'];
    $destino = $dados['destino'];
    $dataviagem = $dados['dataviagem'];
    $motorista_codigo = $dados['motorista'];
    $stmt->bindParam(':idviagem', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':partida', $partida, PDO::PARAM_STR);
    $stmt->bindParam(':destino', $destino, PDO::PARAM_STR);
    $stmt->bindParam(':dataviagem', $dataviagem, PDO::PARAM_STR);
    $stmt->bindParam(':id_motorista', $motorista_codigo, PDO::PARAM_INT);

    $stmt->execute();

    header("location:cadviagem.php");

}

function carregarTelaParaVetor()
{
    $vet = array();
    $vet['idviagem'] = $_POST["idviagem"];
    $vet['motorista'] = $_POST["motorista"];
    $vet['partida'] = $_POST["partida"];
    $vet['destino'] = $_POST["destino"];
    $vet['dataviagem'] = $_POST["dataviagem"];
    return $vet;
}

function carregaBDParaVetor($codigo)
{
    $sql = "SELECT * FROM viagem WHERE idviagem = $codigo;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $dados = array();
    while ($row = mysqli_fetch_array($result)) {
        $dados['idviagem'] = $row['idviagem'];
        $dados['motorista'] = $row['id_motorista'];
        $dados['partida'] = $row['partida'];
        $dados['destino'] = $row['destino'];
        $dados['dataviagem'] = $row['dataviagem'];
    }
    return $dados;
}
	