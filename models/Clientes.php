<?php
class Clientes extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CLIENTES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_clientes WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CLIENTES COM FILTRO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodosFiltro($filtro, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_clientes WHERE
    nome LIKE :filtro OR cpf LIKE :filtro AND tb_empresas_id = :tb_empresas_id ";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':filtro', '%'.$filtro.'%');
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();


    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_clientes WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tipo, $cpf, $cnpj, $fantasia, $inscricao_estadual, $inscricao_municipal, $data_nascimento, $nome, $rg, $rg_emissor, $pai, $mae, $nacionalidade,
  $naturalidade, $estado_civil, $sexo, $profissao, $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento,
  $ponto_referencia, $latitude, $longitude, $soube_empresa, $contatos, $tb_empresas_id) {

    $sql = "INSERT INTO tb_clientes SET
    tipo = :tipo,
    cpf = :cpf,
    cnpj = :cnpj,
    fantasia = :fantasia,
    inscricao_estadual = :inscricao_estadual,
    inscricao_municipal = :inscricao_municipal,
    data_nascimento = :data_nascimento,
    nome = :nome,
    rg = :rg,
    rg_emissor = :rg_emissor,
    pai = :pai,
    mae = :mae,
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
    latitude = :latitude,
    longitude = :longitude,
    soube_empresa = :soube_empresa,
    data_cadastro = NOW(),
    tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);

    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':cnpj', $cnpj);
    $sql->bindValue(':fantasia', $fantasia);
    $sql->bindValue(':inscricao_estadual', $inscricao_estadual);
    $sql->bindValue(':inscricao_municipal', $inscricao_municipal);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':rg', $rg);
    $sql->bindValue(':rg_emissor', $rg_emissor);
    $sql->bindValue(':pai', $pai);
    $sql->bindValue(':mae', $mae);
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
    $sql->bindValue(':latitude', $latitude);
    $sql->bindValue(':longitude', $longitude);
    $sql->bindValue(':soube_empresa', $soube_empresa);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);

    $sql->execute();

    $tb_clientes_id = $this->db->lastInsertId();

    foreach ($contatos as $item) {

      $sqlc = "INSERT INTO tb_contatos SET contato = :contato, tipo = :tipo, tb_clientes_id = :tb_clientes_id";
      $sqlc = $this->db->prepare($sqlc);
      $sqlc->bindValue(':tipo', $item['tipocontato']);
      $sqlc->bindValue(':contato', $item['contato']);
      $sqlc->bindValue(':tb_clientes_id', $tb_clientes_id);
      $sqlc->execute();
    }
    return $tb_clientes_id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $tipo, $cpf, $cnpj, $fantasia, $inscricao_estadual, $inscricao_municipal, $data_nascimento, $nome, $rg, $rg_emissor, $pai, $mae, $nacionalidade,
  $naturalidade, $estado_civil, $sexo, $profissao, $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento,
  $ponto_referencia, $latitude, $longitude, $soube_empresa, $tb_empresas_id) {

    $sql = "UPDATE tb_clientes SET
    tipo = :tipo,
    cpf = :cpf,
    cnpj = :cnpj,
    fantasia = :fantasia,
    inscricao_estadual = :inscricao_estadual,
    inscricao_municipal = :inscricao_municipal,
    data_nascimento = :data_nascimento,
    nome = :nome,
    rg = :rg,
    rg_emissor = :rg_emissor,
    pai = :pai,
    mae = :mae,
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
    latitude = :latitude,
    longitude = :longitude,
    soube_empresa = :soube_empresa
    WHERE id = :id AND tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);

    $sql->bindValue(':id', $id);
    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':cnpj', $cnpj);
    $sql->bindValue(':fantasia', $fantasia);
    $sql->bindValue(':inscricao_estadual', $inscricao_estadual);
    $sql->bindValue(':inscricao_municipal', $inscricao_municipal);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':rg', $rg);
    $sql->bindValue(':rg_emissor', $rg_emissor);
    $sql->bindValue(':pai', $pai);
    $sql->bindValue(':mae', $mae);
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
    $sql->bindValue(':latitude', $latitude);
    $sql->bindValue(':longitude', $longitude);
    $sql->bindValue(':soube_empresa', $soube_empresa);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);

    $sql->execute();
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    $sqlr = "DELETE FROM tb_contasreceber WHERE tb_clientes_id = :tb_clientes_id";
    $sqlr = $this->db->prepare($sqlr);
    $sqlr->bindValue(':tb_clientes_id', $id);
    $sqlr->execute();

    $sqla = "DELETE FROM tb_contratos WHERE tb_clientes_id = :tb_clientes_id";
    $sqla = $this->db->prepare($sqla);
    $sqla->bindValue(':tb_clientes_id', $id);
    $sqla->execute();

    $sqlc = "DELETE FROM tb_contatos WHERE tb_clientes_id = :tb_clientes_id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':tb_clientes_id', $id);
    $sqlc->execute();


    $sql = "DELETE FROM tb_clientes WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





}
?>
