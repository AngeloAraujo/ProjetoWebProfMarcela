<?php

require_once "../config/conexao.php";
define('JSON',$_SERVER['DOCUMENT_ROOT'].'/motorista.json');

    // Se foi enviado via GET para acaousuario entra aqui
    $acaousuario = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acaousuario == "excluir"){
        $codigo = isset($_GET['idmotorista']) ? $_GET['idmotorista'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acaousuario entra aqui
    $acaousuario = isset($_POST['acao']) ? $_POST['acao'] : "";

    if ($acaousuario == "Salvar"){
        $codigo = isset($_POST['idmotorista']) ? $_POST['idmotorista'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        $nome = $dados['nome'];
        $sobrenome = $dados['sobrenome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $dtnasc = $dados['dtnasc'];
        $idade = $dados['idade'];
        $endereco = $dados['endereco'];
        $enderecorua = $dados['enderecorua'];
        $cidade = $dados['cidade'];
        $telefone = $dados['telefone'];
        

      //  var_dump($dados);
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO motorista (nome, sobrenome, email, senha, dtnasc, idade, endereco, enderecorua, cidade, telefone) 
        VALUES(:nome, :sobrenome, :email, :senha, :dtnasc, :idade, :endereco, :enderecorua, :cidade, :telefone)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':dtnasc', $dtnasc, PDO::PARAM_STR);
        $stmt->bindParam(':idade', $idade, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':enderecorua', $enderecorua, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        
        var_dump($stmt);
        $stmt->execute();
        header("location:cadUsuario.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        var_dump($dados);
        $nome = $dados['nome'];
        $sobrenome = $dados['sobrenome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $dtnasc = $dados['dtnasc'];
        $idade = $dados['idade'];
        $endereco = $dados['endereco'];
        $enderecorua = $dados['enderecorua'];
        $cidade = $dados['cidade'];
        $telefone = $dados['telefone'];
        $codigo = $dados['idmotorista'];
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('UPDATE motorista SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha, dtnasc = :dtnasc, idade = :idade, 
        endereco = :endereco, enderecorua = :enderecorua, cidade = :cidade, telefone = :telefone  WHERE idmotorista = :idmotorista');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':dtnasc', $dtnasc, PDO::PARAM_STR);
        $stmt->bindParam(':idade', $idade, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':enderecorua', $enderecorua, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':idmotorista', $codigo, PDO::PARAM_INT);
        $stmt->execute();
        header("location:listamotorista.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from motorista WHERE idmotorista = :idmotorista');
        $stmt->bindParam(':idmotorista', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:listamotorista.php");
        
        //echo "Excluir".$codigo;

    }


    // Busca um item pelo código no BD
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT motorista.idmotorista, motorista.nome, motorista.sobrenome ,motorista.senha, motorista.email,
                                motorista.idade , motorista.dtnasc , motorista.endereco, motorista.enderecorua,
                                motorista.cidade, motorista.telefone
                                FROM transporte.motorista where motorista.idmotorista = $codigo");
       
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idmotorista'] = $linha['idmotorista'];
            $dados['nome'] = $linha['nome'];
            $dados['sobrenome'] = $linha['sobrenome'];
            $dados['senha'] = $linha['senha'];
            $dados['email'] = $linha['email'];
            $dados['idade'] = $linha['idade'];
            $dados['dtnasc'] = $linha['dtnasc'];
            $dados['endereco'] = $linha['endereco'];
            $dados['enderecorua'] = $linha['enderecorua'];
            $dados['cidade'] = $linha['cidade'];
            $dados['telefone'] = $linha['telefone'];
            

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['idmotorista'] = $_POST['idmotorista'];
        $dados['nome'] = $_POST['nome'];
        $dados['sobrenome'] = $_POST['sobrenome'];
        $dados['senha'] = $_POST['senha'];
        $dados['email'] = $_POST['email'];
        $dados['idade'] = $_POST['idade'];
        $dados['dtnasc'] = $_POST['dtnasc'];
        $dados['endereco'] = $_POST['endereco'];
        $dados['enderecorua'] = $_POST['enderecorua'];
        $dados['cidade'] = $_POST['cidade'];
        $dados['telefone'] = $_POST['telefone'];
        
        file_put_contents(JSON,json_encode($dados));

        return $dados;
        
    }
   
