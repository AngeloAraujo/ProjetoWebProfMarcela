<!DOCTYPE html>
<?php
include_once "acao.php";
include_once "../config/conf.inc.php";
include "menu.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar') {
    $codigo = isset($_GET['idmotorista']) ? $_GET['idmotorista'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


</head>


<body>


    <form action="acao.php" method="post">
        <!-- esse formulário envia os dados para o arquivo acao.php -->

        <div id="telaproduto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Motorista</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">Id:
                            <input class="form-control" readonly type="number" name="idmotorista" id="idmotorista" value="<?php if ($acao == "editar") echo $dados['idmotorista'];
                                                                                                                            else echo 0; ?>"><br>
                        </div>
                        <div class="form-group">Nome
                            <input class="form-control" required=true type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome']; ?>"><br>
                        </div>
                        <div class="form-group">Sobrenome:
                            <input class="form-control" type="text" id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenome" value="<?php if ($acao == "editar") echo $dados['sobrenome']; ?>"><br>
                        </div><br>
                        <div class="form-group">E-mail:
                            <input class="form-control" type="email" id="email" name="email" placeholder="Digite seu e-mail" value="<?php if ($acao == "editar") echo $dados['email']; ?>"><br>
                        </div><br>
                        <div class="form-group">Senha:
                            <input class="form-control" type="password" id="senha" name="senha" placeholder="Digite uma senha" value="<?php if ($acao == "editar") echo $dados['senha']; ?>"><br>
                        </div><br>
                        <div class="form-group">Data de Nascimento:
                            <input class="form-control" type="date" id="dtnasc" name="dtnasc" onchange=preencher() value="<?php if ($acao == "editar") echo $dados['dtnasc']; ?>"><br>
                        </div><br>
                        <div class="form-group">Idade:
                            <input class="form-control" type="text" id="idade" name="idade" value="<?php if ($acao == "editar") echo $dados['idade']; ?>"><br>
                        </div><br>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Endereço</label>
                            </div>
                            <div class="form-group">
                                <select class="form-select" aria-label=".form-select-sm example" id="endereco" name="endereco">
                                    <option selected>Escolher</option>
                                    <option value="Avenida" <?php if (($acao == "editar") and $_GET['endereco'] == 'Avenida') echo 'selected'; ?>>Avenida</option>
                                    <option value="Rua" <?php if (($acao == "editar") and $_GET['endereco'] == 'Rua') echo 'selected'; ?>>Rua</option>
                                    <option value="Estrada" <?php if (($acao == "editar") and $_GET['endereco'] == 'Estrada') echo 'selected'; ?>>Estrada</option>
                                    <option value="Outros" <?php if (($acao == "editar") and $_GET['endereco'] == 'Outros') echo 'selected'; ?>>Outros</option>
                                </select>
                            </div><br>
                            <input class="form-control" type="text" id="enderecorua" name="enderecorua" value="<?php if ($acao == "editar") echo $dados['enderecorua']; ?>">

                        </div>
                        <div class="form-group">Cidade:
                            <input class="form-control" type="text" id="cidade" name="cidade" value="<?php if ($acao == "editar") echo $dados['cidade']; ?>">
                        </div>

                        <div class="form-group">Telefone para Contato:
                            <input class="form-control" type="text" id="telefone" name="telefone" value="<?php if ($acao == "editar") echo $dados['telefone']; ?>">
                        </div><br>
                     

                        <div>
                            <input class="btn btn-outline-secondary" type="submit" name="acao" value="Salvar" name="acao">
                            <input class="btn btn-outline-secondary" type="reset" value="Limpar">
                            <a href="index.html"><button class="btn btn-outline-primary">Voltar ao Menu
                                    Inicial</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function preencher() {


            let userInput = document.getElementById('dtnasc').value;
            let data = new Date(userInput);
            let dataatual = new Date();
            var currentY = dataatual.getFullYear();

            var prevY = data.getFullYear();

            var ageY = currentY - prevY;

            console.log(ageY);

            document.getElementById("idade").value = ageY;
        }
    </script>
    </container>
</body>

</html>