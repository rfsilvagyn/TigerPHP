<?php
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;

$id = 'ID: '.$dadosEstoque['tb_movimentacaoestoque']['id'];
$data = 'DATA: '.$dadosEstoque['tb_movimentacaoestoque']['data'];
$tipo = 'TIPO: '.$dadosEstoque['tb_movimentacaoestoque']['tipo'];
$usuario = 'USUARIO: '.$dadosEstoque['tb_movimentacaoestoque']['usuario'];
$solicitante = 'SOLICITANTE: '.$dadosEstoque['tb_movimentacaoestoque']['solicitante'];
$armazem = 'ARMAZEM: '.$dadosEstoque['tb_movimentacaoestoque']['armazem'];

try {
  $connector = new NetworkPrintConnector($dadosEmpresa['ipescpos'], $dadosEmpresa['portaescpos']);
  $printer = new Printer($connector);

  $printer->text("================================================\n");
  $printer->text("$id\n");
  $printer->text("$data\n");
  $printer->text("$tipo\n");
  $printer->text("$usuario\n");
  $printer->text("$armazem\n");
  $printer->text("================================================\n");

  foreach ($dadosEstoque['tb_estoque'] as $item) {
    $printer->text('PRODUTO: '.$item['produto']."\n");
    $printer->text('QUANTIDADE: '.$item['quantidade']."\n");
    $printer->text('UNIDADE: '.$item['unidade']."\n");
    $printer->text("================================================\n");
  }

  $printer->text(" \n");
  $printer->text(" \n");
  $printer->text(" \n");
  $printer->text(" \n");
  $printer->text("------------------------------------------------\n");
  $printer->text("$solicitante\n");

  $printer->feed();
  $printer->cut();
  $printer->close();
} catch (Exception $e) {

  echo $e;
  exit;
  echo json_encode(["success" => false, "message" => "Erro de comunicação com a impressora!"]);
}

?>
