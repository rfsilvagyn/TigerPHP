<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/carne.css">
</head>
<body>
  <table cellspacing="0" cellpadding="0" summary="Carnê com recibo lateral à esquerda">
    <tr>
      <td>
        <table cellspacing="0" cellpadding="0" summary="Recibo do sacado" id="recibo">
          <thead>
            <tr>
              <th><img src="<?php echo BASE_URL?>assets/bancos/bradesco/logobradesco.jpg" alt="Logo Banco" width="150" height="40" /></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>N<sup>o</sup> Documento</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["numero_documento"]; ?></td>
            </tr>
            <tr>
              <td>Vencimento</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["data_vencimento"]; ?></td>
            </tr>
            <tr>
              <td>Ag./C&oacute;d. Cedente</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["agencia_codigo"]; ?></td>
            </tr>
            <tr>
              <td>Nosso N&uacute;mero</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["nosso_numero"]; ?></td>
            </tr>
            <tr>
              <td>Vl. Documento</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["valor_boleto"]; ?></td>
            </tr>
            <tr>
              <td>(-) Desconto</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(+) Mora/Multa</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(+) Outros Acr&eacute;s.</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(=) Valor Cobrado</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Sacado</td>
            </tr>
            <tr>
              <td><?php echo $dadosboleto["sacado"]; ?></td>
            </tr>
          </tbody>
        </table>
      </td>
      <td>
        <table cellspacing="0" cellpadding="0" summary="Ficha de compensação" id="compensacao">
          <tbody>
            <tr>
              <td colspan="2"><img src="<?php echo BASE_URL?>assets/bancos/bradesco/logobradesco.jpg" alt="Logo Banco" width="150" height="40" /></td>
              <td class="cod_banco"><?php echo $dadosboleto["codigo_banco_com_dv"]; ?></td>
              <td colspan="4" class="dest"><?php echo $dadosboleto["linha_digitavel"]; ?></td>
            </tr>
            <tr>
              <td colspan="6">Local de Pagamento</td>
              <td>Vencimento</td>
            </tr>
            <tr class="bold">
              <td colspan="6" class="left">Qualquer agência bancária.</td>
              <td class="dest"><?php echo $dadosboleto["data_vencimento"]; ?></td>
            </tr>
            <tr>
              <td colspan="6">Cedente</td>
              <td>Ag&ecirc;ncia / C&oacute;d. Cedente</td>
            </tr>
            <tr class="bold">
              <td colspan="6" class="left"><?php echo $dadosboleto["cedente"]; ?></td>
              <td><?php echo $dadosboleto["agencia_codigo"]; ?></td>
            </tr>
            <tr>
              <td>Data Documento</td>
              <td colspan="2">N&uacute;mero do Documento</td>
              <td>Esp&eacute;cie Doc.</td>
              <td>Aceite</td>
              <td>Data Processamento</td>
              <td>Nosso N&uacute;mero</td>
            </tr>
            <tr class="bold">
              <td><?php echo $dadosboleto["data_documento"]; ?></td>
              <td colspan="2"><?php echo $dadosboleto["numero_documento"]; ?></td>
              <td><?php echo $dadosboleto["especie_doc"]; ?></td>
              <td><?php echo $dadosboleto["aceite"]; ?></td>
              <td><?php echo $dadosboleto["data_processamento"]; ?></td>
              <td><?php echo $dadosboleto["nosso_numero"]; ?></td>
            </tr>
            <tr>
              <td>Uso do Banco</td>
              <td>Carteira</td>
              <td>Esp&eacute;cie</td>
              <td colspan="2">Quantidade</td>
              <td>(x) Valor</td>
              <td>(=) Valor do Documento</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
              <td><?php echo $dadosboleto["carteira"]; ?></td>
              <td><?php echo $dadosboleto["especie"]; ?></td>
              <td colspan="2"><?php echo $dadosboleto["quantidade"]; ?></td>
              <td>&nbsp;</td>
              <td><?php echo $dadosboleto["valor_boleto"]; ?></td>
            </tr>
            <tr>
              <td colspan="6" rowspan="8"><p>Instru&ccedil;&otilde;es (Texto de responsabilidade do cedente)</p>
                <p>
                  <?php echo $dadosboleto["instrucoes1"]?><br />
                  <?php echo $dadosboleto["instrucoes2"]?><br />
                  <?php echo $dadosboleto["instrucoes3"]?><br />
                  <?php echo $dadosboleto["instrucoes4"]?>
                </p>
              </td>
              <td>(-) Desconto</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(+) Mora / Multa</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(+) Outros Acr&eacute;scimos</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>(=) Valor Cobrado</td>
            </tr>
            <tr class="bold">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="6">
                <?php echo $dadosboleto["sacado"]; ?> <br>
                <?php echo $dadosboleto["endereco1"]; ?> - <?php echo $dadosboleto["endereco2"]; ?>
              </td>
              <td>Ficha de Compensa&ccedil;&atilde;o</td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="6"><?php fbarcode($dadosboleto["codigo_barras"]); ?></td>
              <td colspan="2">Autentica&ccedil;&atilde;o Mec&acirc;nica</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
