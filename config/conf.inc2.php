<?php
	header('Content-Type: text/html; charset=UTF-8');
	date_default_timezone_set('America/Sao_Paulo');
	
	// Banco de Dados para configuração
	$url = "localhost";     // IP do host
	$dbname="transporte";          // Nome do database
	$usuario="root";        // Usuário do database
	$password="97385153";           // Senha do database
	
	// Tabelas do Banco de Dados
	
	$tb_motorista = "motorista";
	$tb_viagem = "viagem";
    $tb_login = "login";
	
?>