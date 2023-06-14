<?php
class Fornecedores extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS FORNECEDORES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_fornecedores WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER FORNECEDOR POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_fornecedores WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tipo, $cpf, $cnpj, $data_nascimento, $fantasia, $nome, $rg, $rg_emissor, $pai,
  $inscricao_estadual, $mae, $inscricao_municipal, $nacionalidade, $naturalidade, $estado_civil, $sexo, $profissao,
  $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento, $ponto_referencia, $tel_fixo, $tel_celular, $tb_empresas_id) {

    $sql = "SELECT * FROM tb_fornecedores WHERE cnpj = :cnpj AND tb_empresas_id = :tb_empresas_id AND cpf = :cpf";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':cnpj', $cnpj);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return false;
    } else {
      $sql = "INSERT INTO tb_fornecedores SET
      tipo = :tipo,
      cpf = :cpf,
      cnpj = :cnpj,
      data_nascimento = :data_nascimento,
      fantasia = :fantasia,
      nome = :nome,
      rg = :rg,
      rg_emissor = :rg_emissor,
      pai = :pai,
      inscricao_estadual = :inscricao_estadual,
      mae = :mae,
      inscricao_municipal = :inscricao_municipal,
      nacionalidade = :nacionalidade,
      naturalidade = :naturalidade,
      estado_civil = :estado_civil,
      sexo = :sexo,
      profissao = :profissao,
      cep = :cep,
      bairro = :bairro,
      cidade = :cidade,
      endereco = :endereco,
      uf = :uf,
      numero = :numero,
      complemento = :complemento,
      ponto_referencia = :ponto_referencia,
      tel_fixo = :tel_fixo,
      tel_celular = :tel_celular,
      data_cadastro = NOW(),
      tb_empresas_id = :tb_empresas_id";

      $sql = $this->db->prepare($sql);

      $sql->bindValue(':tipo', $tipo);
      $sql->bindValue(':cpf', $cpf);
      $sql->bindValue(':cnpj', $cnpj);
      $sql->bindValue(':data_nascimento', $data_nascimento);
      $sql->bindValue(':fantasia', $fantasia);
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':rg', $rg);
      $sql->bindValue(':rg_emissor', $rg_emissor);
      $sql->bindValue(':pai', $pai);
      $sql->bindValue(':inscricao_estadual', $inscricao_estadual);
      $sql->bindValue(':mae', $mae);
      $sql->bindValue(':inscricao_municipal', $inscricao_municipal);
      $sql->bindValue(':nacionalidade', $nacionalidade);
      $sql->bindValue(':naturalidade', $naturalidade);
      $sql->bindValue(':estado_civil', $estado_civil);
      $sql->bindValue(':sexo', $sexo);
      $sql->bindValue(':profissao', $profissao);
      $sql->bindValue(':cep', $cep);
      $sql->bindValue(':bairro', $bairro);
      $sql->bindValue(':cidade', $cidade);
      $sql->bindValue(':endereco', $endereco);
      $sql->bindValue(':uf', $uf);
      $sql->bindValue(':numero', $numero);
      $sql->bindValue(':complemento', $complemento);
      $sql->bindValue(':ponto_referencia', $ponto_referencia);
      $sql->bindValue(':tel_fixo', $tel_fixo);
      $sql->bindValue(':tel_celular', $tel_celular);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();

      return true;
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $tipo, $cpf, $cnpj, $data_nascimento, $fantasia, $nome, $rg, $rg_emissor, $pai,
  $inscricao_estadual, $mae, $inscricao_municipal, $nacionalidade, $naturalidade, $estado_civil, $sexo, $profissao,
  $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento, $ponto_referencia, $tel_fixo, $tel_celular, $tb_empresas_id) {

    $sql = "UPDATE tb_fornecedores SET
    tipo = :tipo,
    cpf = :cpf,
    cnpj = :cnpj,
    data_nascimento = :data_nascimento,
    fantasia = :fantasia,
    nome = :nome,
    rg = :rg,
    rg_emissor = :rg_emissor,
    pai = :pai,
    inscricao_estadual = :inscricao_estadual,
    mae = :mae,
    inscricao_municipal = :inscricao_municipal,
    nacionalidade = :nacionalidade,
    naturalidade = :naturalidade,
    estado_civil = :estado_civil,
    sexo = :sexo,
    profissao = :profissao,
    cep = :cep,
    bairro = :bairro,
    cidade = :cidade,
    endereco = :endereco,
    uf = :uf,
    numero = :numero,
    complemento = :complemento,
    ponto_referencia = :ponto_referencia,
    tel_fixo = :tel_fixo,
    tel_celular = :tel_celular
    WHERE id = :id AND tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);

    $sql->bindValue(':id', $id);
    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':cnpj', $cnpj);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':fantasia', $fantasia);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':rg', $rg);
    $sql->bindValue(':rg_emissor', $rg_emissor);
    $sql->bindValue(':pai', $pai);
    $sql->bindValue(':inscricao_estadual', $inscricao_estadual);
    $sql->bindValue(':mae', $mae);
    $sql->bindValue(':inscricao_municipal', $inscricao_municipal);
    $sql->bindValue(':nacionalidade', $nacionalidade);
    $sql->bindValue(':naturalidade', $naturalidade);
    $sql->bindValue(':estado_civil', $estado_civil);
    $sql->bindValue(':sexo', $sexo);
    $sql->bindValue(':profissao', $profissao);
    $sql->bindValue(':cep', $cep);
    $sql->bindValue(':bairro', $bairro);
    $sql->bindValue(':cidade', $cidade);
    $sql->bindValue(':endereco', $endereco);
    $sql->bindValue(':uf', $uf);
    $sql->bindValue(':numero', $numero);
    $sql->bindValue(':complemento', $complemento);
    $sql->bindValue(':ponto_referencia', $ponto_referencia);
    $sql->bindValue(':tel_fixo', $tel_fixo);
    $sql->bindValue(':tel_celular', $tel_celular);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    return $id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    try {
      $sql = "DELETE FROM tb_fornecedores WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();

      return true;
    } catch (\Exception $e) {
      return false;
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
?>
