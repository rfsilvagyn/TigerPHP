<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//INICIO FUNCOES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function completaDireira($palavra,$limite){
  $retorno=str_pad($palavra, $limite, '0');
  return $retorno;
}
/*Campos Numéricos (“Picture 9”)
• Alinhamento: sempre à direita, preenchido com zeros à esquerda, sem máscara de edição;
• Não utilizados: preencher com zeros.
*/
function picture_9($palavra,$limite){
  $var=str_pad($palavra, $limite, "0", STR_PAD_LEFT);
  return $var;
}

/*
Campos Alfanuméricos (“Picture X”)
• Alinhamento: sempre à esquerda, preenchido com brancos à direita;
• Não utilizados: preencher com brancos;
• Caracteres: maiúsculos, sem acentuação, sem ‘ç’, sem caracteres especiais.
*/

function picture_x( $palavra, $limite ){
  $var = str_pad( $palavra, $limite, " ", STR_PAD_RIGHT );
  $var = remover_acentos( $var );
  if( strlen( $palavra ) >= $limite ){
    $var = substr( $palavra, 0, $limite );
  }
  $var = strtoupper( $var );// converte em letra maiuscula
  return $var;
}

function sequencial($i)
{
  if($i < 10)
  {
    return zeros(0,5).$i;
  }
  else if($i > 10 && $i < 100)
  {
    return zeros(0,4).$i;
  }
  else if($i > 100 && $i < 1000)
  {
    return zeros(0,3).$i;
  }
  else if($i > 1000 && $i < 10000)
  {
    return zeros(0,2).$i;
  }
  else if($i > 10000 && $i < 100000)
  {
    return zeros(0,1).$i;
  }
}

function zeros($min,$max)
{
  $x = ($max - strlen($min));
  for($i = 0; $i < $x; $i++)
  {
    $zeros .= '0';
  }
  return $zeros.$min;
}

function complementoRegistro($int,$tipo)
{
  if($tipo == "zeros")
  {
    $space = '';
    for($i = 1; $i <= $int; $i++)
    {
      $space .= '0';
    }
  }
  else if($tipo == "brancos")
  {
    $space = '';
    for($i = 1; $i <= $int; $i++)
    {
      $space .= ' ';
    }
  }

  return $space;
}


$erros = 0;
$extensao = ".TST";

// achar o digito verificador do nosso numero

function digitoVerificador_nossonumero( $numero ) {
  $resto2 = modulo_11($numero, 7, 1);
  $digito = 11 - $resto2;
  if ($digito == 10) {
    $dv = "P";
  } elseif($digito == 11) {
    $dv = 0;
  } else {
    $dv = $digito;
  }
  return $dv;
}

// FUNÇÕES
// Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco

function formata_numero($numero,$loop,$insert,$tipo = "geral") {
  if ($tipo == "geral") {
    $numero = str_replace(",","",$numero);
    while(strlen($numero)<$loop){
      $numero = $insert . $numero;
    }
  }
  if ($tipo == "valor") {
    /*
    retira as virgulas
    formata o numero
    preenche com zeros
    */
    $numero = str_replace(",","",$numero);
    while(strlen($numero)<$loop){
      $numero = $insert . $numero;
    }
  }
  if ($tipo == "convenio") {
    while(strlen($numero)<$loop){
      $numero = $numero . $insert;
    }
  }
  return $numero;
}


function modulo_11($num, $base=9, $r=0)  {
  /**
  *   Autor:
  *           Pablo Costa <pablo@users.sourceforge.net>
  *
  *   Função:
  *    Calculo do Modulo 11 para geracao do digito verificador
  *    de boletos bancarios conforme documentos obtidos
  *    da Febraban - www.febraban.org.br
  *
  *   Entrada:
  *     $num: string numérica para a qual se deseja calcularo digito verificador;
  *     $base: valor maximo de multiplicacao [2-$base]
  *     $r: quando especificado um devolve somente o resto
  *
  *   Saída:
  *     Retorna o Digito verificador.
  *
  *   Observações:
  *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
  *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
  */

  $soma = 0;
  $fator = 2;

  /* Separacao dos numeros */
  for ($i = strlen($num); $i > 0; $i--) {
    // pega cada numero isoladamente
    $numeros[$i] = substr($num,$i-1,1);
    // Efetua multiplicacao do numero pelo falor
    $parcial[$i] = $numeros[$i] * $fator;
    // Soma dos digitos
    $soma += $parcial[$i];
    if ($fator == $base) {
      // restaura fator de multiplicacao para 2
      $fator = 1;
    }
    $fator++;
  }

  /* Calculo do modulo 11 */
  if ($r == 0) {
    $soma *= 10;
    $digito = $soma % 11;
    if ($digito == 10) {
      $digito = 0;
    }
    return $digito;
  } elseif ($r == 1){
    $resto = $soma % 11;
    return $resto;
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FIM FUNCOES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//NAO ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function remover_acentos($str)
{
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', '', '', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', '', '', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', '', 'Z', 'z', 'Z', 'z', '', '', '?', '', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'" );
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " " );
  return str_replace($a, $b, $str);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PODE SER ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// DADOS DO ARQUIVO DE REMESSA
$numero_sequencial_arquivo = $ultimaRemessa; //NUMERO DA REMESSA.
$extensao_arquivo          = ".REM"; //EXTENSAO DO ARQUIVO DE REMESSA .TST PARA TESTE .REM PARA PRODUCAO

// DADOS DO EMITENTE
$cpf_cnpj                  = str_pad(strtr($dReceber[0]['cnpj_empresa'], array('-' => '', '.' => '', '/' => '')), 14, '0', STR_PAD_LEFT); //CNPJ EMITENTE DO BOLETO
$empresa_beneficiario      = remover_acentos($dReceber[0]['nome_empresa']); //NOME DA EMPRESA EMITENTE DO BOLETO

// DADOS BANCARIOS
$carteira                  = str_pad($dReceber[0]['carteira'], 2, '0', STR_PAD_LEFT); //NUMERO DA CARTEIRA - 2 DIGITOS
$agencia                   = substr($dReceber[0]['agencia'], 0, 5); //NUMERO DA AGENCIA - 5 DIGITOS
$conta                     = $dReceber[0]['conta']; //NUMERO DA CONTA
$dv_conta                  = $dReceber[0]['conta_dv']; //DIGITO VERIFICADOR DA CONTA
$codigo_beneficiario       = $dReceber[0]['convenio']; //NUMERO DO CONVENIO

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//NAO ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$arquivo                   = "CB" . date("d") . date("m") . $numero_sequencial_arquivo . $extensao_arquivo;
$num_banco                 = substr($dReceber[0]['codigo_banco'], 0, 3);
$nome_banco                = 'BRADESCO';
$filename                  = $arquivo;
$conteudo                  = '';
$lote_sequencial           = 1;
$lote_servico              = 1;
$header                    = '';
$registro_t1               = '';
$linha_9                   = '';
$conteudo_meio             = '';
$num_seq_linha             = 1;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//NAO ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$header .= "0";
$header .= "1";
$header .= "REMESSA";
$header .= "01";
$header .= picture_x("COBRANCA",15);
$header .= picture_9($codigo_beneficiario,20);
$header .= picture_x($empresa_beneficiario,30);
$header .= picture_9($num_banco,3);
$header .= picture_x($nome_banco,15);
$header .= date("dmy"); //DDMMYY
$header .= complementoRegistro(8,"brancos");
$header .= "MX";
$header .= picture_9($numero_sequencial_arquivo,7); //NUMERO DA REMESSA
$header .= complementoRegistro(277,"brancos");
$header .= picture_9($num_seq_linha,6);
$header .= chr(13).chr(10);
$num_seq_linha++;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PODE ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

foreach ($dReceber as $dadosReceber) { //INICIO DO LOOP PARA MONTAGEM DO ARQUIVO

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //PODE ALTERAR
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $nosso_numero       = $dadosReceber['id']; // DEVE TER 11 DIGITOS

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //NAO ALTERAR
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $numero_documento             = $nosso_numero;
  $nnum                         = formata_numero( $carteira,2,0 ).formata_numero( $nosso_numero,11,0 ) ;
  $dv_nn                        = digitoVerificador_nossonumero( $nnum );
  $dv_nosso_numero              = $dv_nn;
  $enderecamento_aviso_debito   = '2';
  $especie_titulo               = '12';
  $valor_iof                    = '0';
  $valor_abatimento             = '0';

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //PODE ALTERAR
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $data_emissao_boleto          = date('dmy', strtotime($dadosReceber['data_emissao'])); //DATA EMISSAO FORMATO DDMMYY
  $data_vencimento_boleto       = date('dmy', strtotime($dadosReceber['data_vencimento'])); //DATA VENCIMENTO FORMATO DDMMYY
  $valor_boleto                 = str_replace(',', '', number_format($dadosReceber['valor'], 2, ',', '.')); //VALOR DO BOLETO FORMATO SOMENTE NUMEROS

  // JUROS
  $data_juros                   = date('dmy', strtotime($dadosReceber['data_juros'])); //DATA INCIDENCIA JUROS FORMATO DDMMAA
  $valor_por_dia_de_atraso      = number_format($dadosReceber['valor']*$dadosReceber['tx_juros']/100/30, 2, '', '.'); //VALOR POR DIA DE ATRASO EM REAIS SOMENTE NUMEROS EXEMPLO R$ 0,02 MULTA POR DIA FORMATO 002

  // MULTA
  $tipo_multa                   = '2'; //TIPO MULTA 2 = PORCENTAGEM / 1 = VALOR / 0 = SEM MULTA
  $data_multa                   = date('dmy', strtotime($dadosReceber['data_juros'])); //DATA INCIDENCIA MULTA FORMATO DDMMAA
  $valor_multa                  = completaDireira($dadosReceber['tx_multa'],3); //VALOR EM PERCENTUAL EXEMPLO 1,00% MULTA POR MES FORMATO 100

  // DESCONTO
  $data_limite_desc             = '000000'; //DATA LIMITE DESCONTO 0 = DESATIVADO
  $valor_desconto               = '000'; // VALOR DO DESCONTO 000 = 0% / 500 => 5%

  // PAGADOR
  $tipo_inscricao_pagador       = '1';  //TIPO CLIENTE 1 = FISICA / 2 = JURIDICA
  $numero_inscricao_pagador     = str_pad(strtr($dadosReceber['cpf_cliente'], array('-' => '', '.' => '')), 14, '0', STR_PAD_LEFT); // CPF OU CNPJ - 14 DIGITOS
  $nome_pagador                 = remover_acentos(substr($dadosReceber['nome_cliente'], 0, 40)); //NOME PAGADOR - 40 DIGITOS
  $endereco_pagador             = remover_acentos(substr($dadosReceber['endereco_cliente'], 0, 40 )); //ENDERECO PAGADOR - 40 DIGITOS
  $cep_pagador                  = substr($dadosReceber['cep_cliente'], 0, 5); //PRIMEIROS 5 DIGITOS CEP PAGADOR
  $cep_pagador_sufixo           = substr($dadosReceber['cep_cliente'], 6, 9); //ULTIMOS 3 DIGITOS CEP PAGADOR

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //NAO ALTERAR
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $registro_t1 .= "1";
  $registro_t1 .= complementoRegistro(5,"brancos");
  $registro_t1 .= complementoRegistro(1,"brancos");
  $registro_t1 .= complementoRegistro(5,"brancos");
  $registro_t1 .= complementoRegistro(7,"brancos");
  $registro_t1 .= complementoRegistro(1,"brancos");
  $registro_t1 .= '0';
  $registro_t1 .= picture_9($carteira,3);
  $registro_t1 .= picture_9($agencia,5);
  $registro_t1 .= picture_9($conta,7);
  $registro_t1 .= picture_9($dv_conta,1);
  $registro_t1 .= picture_9($numero_documento,25);
  $registro_t1 .= complementoRegistro(3,"zeros");
  $registro_t1 .= picture_9($tipo_multa,1);
  $registro_t1 .= picture_9($valor_multa,4);
  $registro_t1 .= picture_9($nosso_numero,11);
  $registro_t1 .= picture_9($dv_nosso_numero,1);
  $registro_t1 .= complementoRegistro(10,'zeros');
  $registro_t1 .= picture_9('2',1);
  $registro_t1 .= 'N';
  $registro_t1 .= complementoRegistro(10,'brancos');
  $registro_t1 .= complementoRegistro(1,'brancos');
  $registro_t1 .= picture_9($enderecamento_aviso_debito,1);
  $registro_t1 .= complementoRegistro(2,'brancos');
  $registro_t1 .= "01";
  $registro_t1 .= picture_9($numero_documento,10);
  $registro_t1 .= picture_9($data_vencimento_boleto,6);
  $registro_t1 .= picture_9($valor_boleto,13);
  $registro_t1 .= complementoRegistro(3,"zeros");
  $registro_t1 .= complementoRegistro(5,"zeros");
  $registro_t1 .= picture_x($especie_titulo,2);
  $registro_t1 .= "N";
  $registro_t1 .= picture_9($data_emissao_boleto,6);
  $registro_t1 .= complementoRegistro(2,"zeros");
  $registro_t1 .= complementoRegistro(2,"zeros");
  $registro_t1 .= picture_9($valor_por_dia_de_atraso,13);
  $registro_t1 .= picture_9($data_limite_desc,6);
  $registro_t1 .= picture_9($valor_desconto,13);
  $registro_t1 .= picture_9($valor_iof,13);
  $registro_t1 .= picture_9($valor_abatimento,13);
  $registro_t1 .= picture_9($tipo_inscricao_pagador,2);
  $registro_t1 .= picture_9($numero_inscricao_pagador,14);
  $registro_t1 .= picture_x( remover_acentos( $nome_pagador ),40);
  $registro_t1 .= picture_x( remover_acentos( $endereco_pagador ),40);
  $registro_t1 .= complementoRegistro(12,"brancos");
  $registro_t1 .= picture_9($cep_pagador,5);
  $registro_t1 .= picture_9($cep_pagador_sufixo,3);
  $registro_t1 .= complementoRegistro(60,"brancos");
  $registro_t1 .= picture_9($num_seq_linha,6);
  $registro_t1 .= chr(13).chr(10);
  $lote_sequencial++;
  $num_seq_linha++;
  $conteudo_meio .= $registro_t1;
} //FIM DO LOOP PARA MONTAGEM DO ARQUIVO
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//NAO ALTERAR
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$linha_9 .= '9';
$linha_9 .= complementoRegistro(393,"brancos");
$linha_9 .= picture_9($num_seq_linha,6);
$linha_9 .= chr(13).chr(10);
$conteudo = $header.$registro_t1.$linha_9;
if (!$handle = fopen('./remessa/'.$filename, 'w+')){
  erro("<div align='center'>&nbsp;Nao foi possivel abrir o arquivo ($filename)</div><br>");
}
if (fwrite($handle, "$conteudo") === FALSE){
  echo "<div align='center'>&nbsp;Nao foi possivel escrever no arquivo ($filename)</div><br>";
}
fclose($handle);
echo "<div align='center'>&nbsp;Arquivo de remessa gerado com sucesso!";
?>
<br>
<br>
<a href="<?php echo BASE_URL."remessa/".$filename;?>" target="_blank" download><?php echo $filename;?></a>   <!-- NOME DA PASTA ONDE A REMESSA FICARA -->
