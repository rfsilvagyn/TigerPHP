<?php
require '../../config.php';

//Garantir que seja lido sem problemas
header("Content-Type: text/plain");

//Capturar CPF, Data de Nascimento e Token
$token = TOKEN_HUB;

$url = "http://ws.hubdodesenvolvedor.com.br/v2/cpf/?cpf=".$_REQUEST["cpf"]."&data=".$_REQUEST["data"]."&token=".$token;

///Criando Comunicação cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$retorno = curl_exec($ch);
curl_close($ch);

 //Ajuda a ser lido mais rapidamente
$retorno = json_decode($retorno);
echo json_encode($retorno, JSON_PRETTY_PRINT);

?>
