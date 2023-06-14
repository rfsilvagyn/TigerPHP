<?php

require "assets/bancos/bradesco/funcoes_bradesco.php";

foreach ($dReceber as $dadosReceber) {
  // DADOS DO BOLETO PARA O SEU CLIENTE
  $dias_de_prazo_para_pagamento     = 5;
  $taxa_boleto                      = 0;
  $data_venc                        = $dadosReceber['data_vencimento']; //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
  $valor_cobrado                    = $dadosReceber['valor']; // "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
  $valor_cobrado                    = str_replace(",", ".",$valor_cobrado);
  $valor_boleto                     = number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

  $dadosboleto["nosso_numero"]      = $dadosReceber['id'];   // "75896452";  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
  $dadosboleto["numero_documento"]  = $dadosboleto["nosso_numero"];	// Num do pedido ou do documento = Nosso numero
  $dadosboleto["data_vencimento"] 	= date('d/m/Y', strtotime($dadosReceber['data_vencimento']));// Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
  $dadosboleto["data_documento"] 		= date('d/m/Y', strtotime($dadosReceber['data_emissao']));    //date("d/m/Y"); // Data de emiss�o do Boleto
  $dadosboleto["data_processamento"]= date('d/m/Y', strtotime($dadosReceber['data_emissao'])); // Data de processamento do boleto (opcional)
  $dadosboleto["valor_boleto"]      = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

  // DADOS DO SEU CLIENTE
  $dadosboleto["sacado"]            = $dadosReceber['nome_cliente']  . " - CPF/CNPJ: " . $dadosReceber['cpf_cliente'];
  $dadosboleto["endereco1"]         = $dadosReceber['endereco_cliente'];
  $dadosboleto["endereco2"]         = $dadosReceber['cidade_cliente'] . " - " . $dadosReceber['uf_cliente'] . " - CEP: " . $dadosReceber['cep_cliente'];

  // INFORMACOES PARA O CLIENTE
  $dadosboleto["demonstrativo1"] 		= $dadosReceber['referencia'];
  $dadosboleto["demonstrativo2"] 		= "";
  $dadosboleto["demonstrativo3"] 		= "";
  $dadosboleto["instrucoes1"]       = "- Apos o vencimento, cobrar multa de ".$dadosReceber['tx_multa']."% e Juros de ".$dadosReceber['tx_juros']."% ao dia";
  $dadosboleto["instrucoes2"]       = "- Nao receber apos 90 (noventa) dias do vencimento";
  $dadosboleto["instrucoes3"]       = "- Em caso de duvidas entre em contato conosco";
  $dadosboleto["instrucoes4"]       = "";

  // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
  $dadosboleto["quantidade"]        = "001";
  $dadosboleto["valor_unitario"]    = $valor_boleto;
  $dadosboleto["aceite"]            = "";
  $dadosboleto["especie"]           = "R$";
  $dadosboleto["especie_doc"]       = "DS";

  // ---------------------- DADOS FIXOS DE CONFIGURACAO DO SEU BOLETO --------------- //

  // DADOS DA SUA CONTA - BRADESCO
  $dadosboleto["agencia"]          	  = $dadosReceber['agencia'];         //" 1100"; // Num da agencia, sem digito
  $dadosboleto["agencia_dv"]          = $dadosReceber['agencia_dv'];     // "0"; // Digito do Num da agencia
  $dadosboleto["conta"]               = $dadosReceber['conta'];             // "0102003"; 	// Num da conta, sem digito
  $dadosboleto["conta_dv"]            = $dadosReceber['conta_dv'];         //"4"; 	// Digito do Num da conta

  // DADOS PERSONALIZADOS - BRADESCO
  $dadosboleto["conta_cedente"]       = $dadosReceber['conta'];         // "0102003"; // ContaCedente do Cliente, sem digito (Somente N�meros)
  $dadosboleto["conta_cedente_dv"]  	= $dadosReceber['conta_dv'];    // "4"; // Digito da ContaCedente do Cliente
  $dadosboleto["carteira"]            = $dadosReceber['carteira'];                      // "06";  // C�digo da Carteira: pode ser 06 ou 03

  // SEUS DADOS
  $dadosboleto["identificacao"]       = $dadosReceber['nome_empresa'];
  $dadosboleto["cpf_cnpj"]            = $dadosReceber['cnpj_empresa'];                                                                    //  "";
  $dadosboleto["endereco"]            = $dadosReceber['endereco_empresa'];                                                            // "Coloque o endere�o da sua empresa aqui";
  $dadosboleto["cidade_uf"]           = $dadosReceber['cidade_empresa'] . "/" . $dadosReceber['uf_empresa'];    //  "Cidade / Estado";
  $dadosboleto["cedente"]             = $dadosReceber['nome_empresa'];                                                                   // "Coloque a Raz�o Social da sua empresa aqui";

  $codigobanco = "237";
  $codigo_banco_com_dv = geraCodigoBanco($codigobanco);
  $nummoeda = "9";
  $fator_vencimento = fator_vencimento($dadosboleto["data_vencimento"]);

  //valor tem 10 digitos, sem virgula
  $valor = formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
  //agencia � 4 digitos
  $agencia = formata_numero($dadosboleto["agencia"],4,0);
  //conta � 6 digitos
  $conta = formata_numero($dadosboleto["conta"],6,0);
  //dv da conta
  $conta_dv = formata_numero($dadosboleto["conta_dv"],1,0);
  //carteira � 2 caracteres
  $carteira = $dadosboleto["carteira"];

  //nosso n�mero (sem dv) � 11 digitos
  $nnum = formata_numero($dadosboleto["carteira"],2,0).formata_numero($dadosboleto["nosso_numero"],11,0);
  //dv do nosso n�mero
  $dv_nosso_numero = digitoVerificador_nossonumero($nnum);

  //conta cedente (sem dv) � 7 digitos
  $conta_cedente = formata_numero($dadosboleto["conta_cedente"],7,0);
  //dv da conta cedente
  $conta_cedente_dv = formata_numero($dadosboleto["conta_cedente_dv"],1,0);

  //$ag_contacedente = $agencia . $conta_cedente;

  // 43 numeros para o calculo do digito verificador do codigo de barras
  $dv = digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$agencia$nnum$conta_cedente".'0', 9, 0);
  // Numero para o codigo de barras com 44 digitos
  $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$agencia$nnum$conta_cedente"."0";

  $nossonumero = substr($nnum,0,2).'/'.substr($nnum,2).'-'.$dv_nosso_numero;
  $agencia_codigo = $agencia."-".$dadosboleto["agencia_dv"]." / ". $conta_cedente ."-". $conta_cedente_dv;


  $dadosboleto["codigo_barras"] = $linha;
  $dadosboleto["linha_digitavel"] = monta_linha_digitavel($linha);
  $dadosboleto["agencia_codigo"] = $agencia_codigo;
  $dadosboleto["nosso_numero"] = $nossonumero;
  $dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

  // NAO ALTERAR!
  $tipo = 'C';
  if ($tipo == 'B') {
    require "assets/bancos/bradesco/layout_bradesco_boleto.php";
  } if ($tipo == 'C') {
    require "assets/bancos/bradesco/layout_bradesco_carne.php";
  }
}

?>
