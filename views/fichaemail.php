<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Ficha de Venda</title>
</head>
<body>

  <h1> Ficha de Venda </h1>

  Tipo: <?php echo strtoupper($dados['tipo']) ?> <br>
  CPF: <?php echo strtoupper($dados['cpf']) ?> <br>
  CNPJ: <?php echo strtoupper($dados['cnpj']) ?> <br>
  Data de Nascimento: <?php echo strtoupper($dados['data_nascimento']) ?> <br>
  Fantasia: <?php echo strtoupper($dados['fantasia']) ?> <br>
  Nome: <?php echo strtoupper($dados['nome']) ?> <br>
  RG: <?php echo strtoupper($dados['rg']) ?> <br>
  RG Emissor: <?php echo strtoupper($dados['rg_emissor']) ?> <br>
  Inscricao Estadual: <?php echo strtoupper($dados['inscricao_estadual']) ?> <br>
  Inscricao Municipal: <?php echo strtoupper($dados['inscricao_municipal']) ?> <br>
  Nome do Pai: <?php echo strtoupper($dados['pai']) ?> <br>
  Nome da Mae: <?php echo strtoupper($dados['mae']) ?> <br>
  Nacionalidade: <?php echo strtoupper($dados['nacionalidade']) ?> <br>
  Naturalidade: <?php echo strtoupper($dados['naturalidade']) ?> <br>
  Estado Civil: <?php echo strtoupper($dados['estado_civil']) ?> <br>
  Sexo: <?php echo strtoupper($dados['sexo']) ?> <br>
  Profissao: <?php echo strtoupper($dados['profissao']) ?> <br>
  CEP: <?php echo strtoupper($dados['cep']) ?> <br>
  Bairro: <?php echo strtoupper($dados['bairro']) ?> <br>
  Cidade: <?php echo strtoupper($dados['cidade']) ?> <br>
  Endereco: <?php echo strtoupper($dados['endereco']) ?> <br>
  UF: <?php echo strtoupper($dados['uf']) ?> <br>
  Numero: <?php echo strtoupper($dados['numero']) ?> <br>
  Ponto de Referencia: <?php echo strtoupper($dados['ponto_referencia']) ?> <br>
  Valor da Instalação: <?php echo strtoupper($dados['valor_instalacao']) ?> <br>
  Plano: <?php echo strtoupper($dados['plano']) ?> <br>
  Vencimento: <?php echo strtoupper($dados['vencimento']) ?> <br>
  Login: <?php echo strtolower($dados['login']) ?> <br>
  Como Soube da Empresa: <?php echo strtoupper($dados['soube_empresa']) ?> <br>
  Vendedor: <?php echo strtoupper($dadosUsuarios['nome']) ?> <br> <br>

  <table style="width:50%">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Contato</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contatos as $contato): ?>
        <tr style="text-align: center;">
          <td><?php echo $contato['tipocontato']; ?></td>
          <td><?php echo $contato['contato']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>




</body>
</html>
