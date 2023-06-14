<?php
class Contratos extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id) {
    $array = array();

    $sql = "SELECT c.*, p.valor as valor, p.nome as plano, v.nome as vencimento, b.nome as conta, i.nome as cliente FROM tb_contratos AS c
    LEFT JOIN tb_planos as p ON p.id = c.tb_planos_id
    LEFT JOIN tb_vencimentos as v ON v.id = c.tb_vencimentos_id
    LEFT JOIN tb_contas as b ON b.id = c.tb_contas_id
    LEFT JOIN tb_clientes as i ON i.id = c.tb_clientes_id
    WHERE c.id = :id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTRATOS FILTRO POR CODIGO DO CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT c.*, p.nome as plano, v.nome as vencimento FROM tb_contratos AS c
    LEFT JOIN tb_planos as p ON p.id = c.tb_planos_id
    LEFT JOIN tb_vencimentos as v ON v.id = c.tb_vencimentos_id
    WHERE c.tb_clientes_id = :id AND c.tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CONTRATOS ATIVOS FILTRO POR CODIGO DO CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterAtivos($tb_clientes_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT c.*, p.nome as plano, v.nome as vencimento FROM tb_contratos AS c
    LEFT JOIN tb_planos as p ON p.id = c.tb_planos_id
    LEFT JOIN tb_vencimentos as v ON v.id = c.tb_vencimentos_id
    WHERE c.tb_clientes_id = :tb_clientes_id AND c.tb_empresas_id = :tb_empresas_id AND c.status = 'ATIVO'";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_clientes_id', $tb_clientes_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($login, $senha_autenticacao, $senha_central, $tipo_autenticacao, $auto_mac, $ip, $mac, $login_simultaneo,
  $tb_clientes_id, $tb_pops_id, $tb_planos_id, $tb_nas_id, $tb_contas_id, $tb_vencimentos_id, $tb_vendedores_id, $tipo_contrato,
  $cep_cobranca, $bairro_cobranca, $cidade_cobranca, $endereco_cobranca, $uf_cobranca, $numero_cobranca, $complemento_cobranca, $ponto_referencia_cobranca,
  $cep_instalacao, $bairro_instalacao, $cidade_instalacao, $endereco_instalacao, $uf_instalacao, $numero_instalacao, $complemento_instalacao, $ponto_referencia_instalacao, $tb_empresas_id) {

    $sql = "INSERT INTO tb_contratos SET
    login = :login,
    senha_autenticacao = :senha_autenticacao,
    senha_central = :senha_central,
    tipo_autenticacao = :tipo_autenticacao,
    auto_mac = :auto_mac,
    ip = :ip,
    mac = :mac,
    login_simultaneo = :login_simultaneo,
    tb_clientes_id = :tb_clientes_id,
    tb_pops_id = :tb_pops_id,
    tb_planos_id = :tb_planos_id,
    tb_nas_id = :tb_nas_id,
    tb_contas_id = :tb_contas_id,
    tb_vencimentos_id = :tb_vencimentos_id,
    tb_vendedores_id = :tb_vendedores_id,
    tipo_contrato = :tipo_contrato,
    cep_cobranca = :cep_cobranca,
    bairro_cobranca = :bairro_cobranca,
    cidade_cobranca = :cidade_cobranca,
    endereco_cobranca = :endereco_cobranca,
    uf_cobranca = :uf_cobranca,
    numero_cobranca = :numero_cobranca,
    complemento_cobranca = :complemento_cobranca,
    ponto_referencia_cobranca = :ponto_referencia_cobranca,
    cep_instalacao = :cep_instalacao,
    bairro_instalacao = :bairro_instalacao,
    cidade_instalacao = :cidade_instalacao,
    endereco_instalacao = :endereco_instalacao,
    uf_instalacao = :uf_instalacao,
    numero_instalacao = :numero_instalacao,
    complemento_instalacao = :complemento_instalacao,
    ponto_referencia_instalacao = :ponto_referencia_instalacao,
    data_cadastro = NOW(),
    tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':login', $login);
    $sql->bindValue(':senha_autenticacao', $senha_autenticacao);
    $sql->bindValue(':senha_central', $senha_central);
    $sql->bindValue(':tipo_autenticacao', $tipo_autenticacao);
    $sql->bindValue(':auto_mac', $auto_mac);
    $sql->bindValue(':ip', $ip);
    $sql->bindValue(':mac', $mac);
    $sql->bindValue(':login_simultaneo', $login_simultaneo);
    $sql->bindValue(':tb_clientes_id', $tb_clientes_id);
    $sql->bindValue(':tb_pops_id', $tb_pops_id);
    $sql->bindValue(':tb_planos_id', $tb_planos_id);
    $sql->bindValue(':tb_nas_id', $tb_nas_id);
    $sql->bindValue(':tb_contas_id', $tb_contas_id);
    $sql->bindValue(':tb_vencimentos_id', $tb_vencimentos_id);
    $sql->bindValue(':tb_vendedores_id', $tb_vendedores_id);
    $sql->bindValue(':tipo_contrato', $tipo_contrato);
    $sql->bindValue(':cep_cobranca', $cep_cobranca);
    $sql->bindValue(':bairro_cobranca', $bairro_cobranca);
    $sql->bindValue(':cidade_cobranca', $cidade_cobranca);
    $sql->bindValue(':endereco_cobranca', $endereco_cobranca);
    $sql->bindValue(':uf_cobranca', $uf_cobranca);
    $sql->bindValue(':numero_cobranca', $numero_cobranca);
    $sql->bindValue(':complemento_cobranca', $complemento_cobranca);
    $sql->bindValue(':ponto_referencia_cobranca', $ponto_referencia_cobranca);
    $sql->bindValue(':cep_instalacao', $cep_instalacao);
    $sql->bindValue(':bairro_instalacao', $bairro_instalacao);
    $sql->bindValue(':cidade_instalacao', $cidade_instalacao);
    $sql->bindValue(':endereco_instalacao', $endereco_instalacao);
    $sql->bindValue(':uf_instalacao', $uf_instalacao);
    $sql->bindValue(':numero_instalacao', $numero_instalacao);
    $sql->bindValue(':complemento_instalacao', $complemento_instalacao);
    $sql->bindValue(':ponto_referencia_instalacao', $ponto_referencia_instalacao);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    return $tb_clientes_id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $login, $senha_autenticacao, $senha_central, $tipo_autenticacao, $auto_mac, $ip, $mac, $login_simultaneo,
  $tb_pops_id, $tb_planos_id, $tb_nas_id, $tb_contas_id, $tb_vencimentos_id, $tb_vendedores_id, $tipo_contrato, $cep_cobranca, $bairro_cobranca,
  $cidade_cobranca, $endereco_cobranca, $uf_cobranca, $numero_cobranca, $complemento_cobranca, $ponto_referencia_cobranca, $cep_instalacao,
  $bairro_instalacao, $cidade_instalacao, $endereco_instalacao, $uf_instalacao, $numero_instalacao, $complemento_instalacao, $ponto_referencia_instalacao, $tb_empresas_id) {
    $array = array();

    $sql = "UPDATE tb_contratos SET
    login = :login,
    senha_autenticacao = :senha_autenticacao,
    senha_central = :senha_central,
    tipo_autenticacao = :tipo_autenticacao,
    auto_mac = :auto_mac,
    ip = :ip,
    mac = :mac,
    login_simultaneo = :login_simultaneo,
    tb_pops_id = :tb_pops_id,
    tb_planos_id = :tb_planos_id,
    tb_nas_id = :tb_nas_id,
    tb_contas_id = :tb_contas_id,
    tb_vencimentos_id = :tb_vencimentos_id,
    tb_vendedores_id = :tb_vendedores_id,
    tipo_contrato = :tipo_contrato,
    cep_cobranca = :cep_cobranca,
    bairro_cobranca = :bairro_cobranca,
    cidade_cobranca = :cidade_cobranca,
    endereco_cobranca = :endereco_cobranca,
    uf_cobranca = :uf_cobranca,
    numero_cobranca = :numero_cobranca,
    complemento_cobranca = :complemento_cobranca,
    ponto_referencia_cobranca = :ponto_referencia_cobranca,
    cep_instalacao = :cep_instalacao,
    bairro_instalacao = :bairro_instalacao,
    cidade_instalacao = :cidade_instalacao,
    endereco_instalacao = :endereco_instalacao,
    uf_instalacao = :uf_instalacao,
    numero_instalacao = :numero_instalacao,
    complemento_instalacao = :complemento_instalacao,
    ponto_referencia_instalacao = :ponto_referencia_instalacao
    WHERE id = :id AND tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':login', $login);
    $sql->bindValue(':senha_autenticacao', $senha_autenticacao);
    $sql->bindValue(':senha_central', $senha_central);
    $sql->bindValue(':tipo_autenticacao', $tipo_autenticacao);
    $sql->bindValue(':auto_mac', $auto_mac);
    $sql->bindValue(':ip', $ip);
    $sql->bindValue(':mac', $mac);
    $sql->bindValue(':login_simultaneo', $login_simultaneo);
    $sql->bindValue(':tb_pops_id', $tb_pops_id);
    $sql->bindValue(':tb_planos_id', $tb_planos_id);
    $sql->bindValue(':tb_nas_id', $tb_nas_id);
    $sql->bindValue(':tb_contas_id', $tb_contas_id);
    $sql->bindValue(':tb_vencimentos_id', $tb_vencimentos_id);
    $sql->bindValue(':tb_vendedores_id', $tb_vendedores_id);
    $sql->bindValue(':tipo_contrato', $tipo_contrato);
    $sql->bindValue(':cep_cobranca', $cep_cobranca);
    $sql->bindValue(':bairro_cobranca', $bairro_cobranca);
    $sql->bindValue(':cidade_cobranca', $cidade_cobranca);
    $sql->bindValue(':endereco_cobranca', $endereco_cobranca);
    $sql->bindValue(':uf_cobranca', $uf_cobranca);
    $sql->bindValue(':numero_cobranca', $numero_cobranca);
    $sql->bindValue(':complemento_cobranca', $complemento_cobranca);
    $sql->bindValue(':ponto_referencia_cobranca', $ponto_referencia_cobranca);
    $sql->bindValue(':cep_instalacao', $cep_instalacao);
    $sql->bindValue(':bairro_instalacao', $bairro_instalacao);
    $sql->bindValue(':cidade_instalacao', $cidade_instalacao);
    $sql->bindValue(':endereco_instalacao', $endereco_instalacao);
    $sql->bindValue(':uf_instalacao', $uf_instalacao);
    $sql->bindValue(':numero_instalacao', $numero_instalacao);
    $sql->bindValue(':complemento_instalacao', $complemento_instalacao);
    $sql->bindValue(':ponto_referencia_instalacao', $ponto_referencia_instalacao);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $sqlc = "SELECT tb_clientes_id FROM tb_contratos WHERE id = :id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':id', $id);
    $sqlc->execute();

    if ($sqlc->rowCount() > 0) {
      $array = $sqlc->fetch();
    }
    return $array['tb_clientes_id'];

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ATIVAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function ativar($status, $id, $tb_empresas_id) {

    //ATUALIZA O STATUS DO CONTRATO NA TABELA DE CONTRATOS
    $sql = "UPDATE tb_contratos SET status = :status, data_ativacao = NOW() WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //BUSCA INFORMACOES DO CLIENTE E PLANO PELO ID DO CONTRATO
    $sqlc = "SELECT c.tb_clientes_id, c.senha_autenticacao, c.auto_mac, c.mac, c.login, c.tb_planos_id, p.nome as nome_plano, p.prioridade FROM tb_contratos AS c
    LEFT JOIN tb_planos as p ON p.id = c.tb_planos_id
    WHERE c.id = :id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':id', $id);
    $sqlc->execute();

    if ($sqlc->rowCount() > 0) {
      $array = $sqlc->fetch();
      $senha_autenticacao = $array['senha_autenticacao'];
      $auto_mac = $array['auto_mac'];
      $mac = $array['mac'];
      $login = $array['login'];
      $id_plano_tiger = $array['tb_planos_id'];
      $plano = $array['nome_plano'];
      $prioridade = $array['prioridade'];
    }

    //VERIFICA SE O CAMPO MAC AUTOMATICA ESTA ATIVO PARA ALTERAR O CAMPO OP DO RADIUS
    if ($auto_mac == 'ATIVADO') {
      $op_mac = ':=';
    } else {
      $op_mac = '==';
    }

    //MONTA ATRIBUTOS PARA PARA INSERIR NA TABELA RADCHECK DO RADIUS
    $arrayAttribute = [
      [ 'attribute' => 'Cleartext-Password', 'op' => ':=', 'value' => $senha_autenticacao ],
      [ 'attribute' => 'Calling-Station-Id', 'op' => $op_mac, 'value' => $mac ]
    ];

    //ADICIONA O USUARIO NO BANCO DE DADOS RADIUS TABELA RADCHECK
    $sql = "INSERT INTO radcheck SET id_contrato_tiger = :id_contrato_tiger, username = :username, attribute = :attribute, op = :op, value = :value";
    $sql = $this->dbradius->prepare($sql);
    foreach( $arrayAttribute as $item ) {
      $sql->bindValue(':id_contrato_tiger', $id);
      $sql->bindValue(':username', $login);
      $sql->bindValue(':attribute', $item['attribute']);
      $sql->bindValue(':op', $item['op']);
      $sql->bindValue(':value', $item['value']);
      $sql->execute();
    }

    //ADICIONA PLANO DO USUARIO NO BANCO DE DADOS RADIUS NA TABELA RADUSERGROUP
    $sql = "INSERT INTO radusergroup SET id_contrato_tiger = :id_contrato_tiger, username = :username, id_plano_tiger = :id_plano_tiger, groupname = :groupname, priority = :priority";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_contrato_tiger', $id);
    $sql->bindValue(':username', $login);
    $sql->bindValue(':id_plano_tiger', $id_plano_tiger);
    $sql->bindValue(':groupname', $plano);
    $sql->bindValue(':priority', $prioridade);
    $sql->execute();

    //RETORNA O ID DO CLIENTE
    return $array['tb_clientes_id'];

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DESATIVAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function desativar($status, $id, $tb_empresas_id) {

    //ATUALIZA O STATUS DO CONTRATO NA TABELA DE CONTRATOS
    $sql = "UPDATE tb_contratos SET status = :status, data_desativacao = NOW() WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //BUSTA INFORMACOES DO CLIENTE PELO ID DO CONTRATO
    $sqlc = "SELECT tb_clientes_id FROM tb_contratos WHERE id = :id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':id', $id);
    $sqlc->execute();

    if ($sqlc->rowCount() > 0) {
      $array = $sqlc->fetch();
    }

    //DELETA PLANO DO USUARIO NO BANCO DE DADOS RADIUS NA TABELA RADUSERGROUP
    $sql = "DELETE FROM radusergroup WHERE id_contrato_tiger = :id_contrato_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_contrato_tiger', $id);
    $sql->execute();

    //DELETA USUARIO NO BANCO DE DADOS RADIUS NA TABELA RADCHECK
    $sql = "DELETE FROM radcheck WHERE id_contrato_tiger = :id_contrato_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_contrato_tiger', $id);
    $sql->execute();

    //RETORNA O ID DO CLIENTE
    return $array['tb_clientes_id'];

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $sqlc = "SELECT tb_clientes_id FROM tb_contratos WHERE id = :id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':id', $id);
    $sqlc->execute();

    if ($sqlc->rowCount() > 0) {
      $array = $sqlc->fetch();
    }

    $sql = "DELETE FROM tb_contasreceber WHERE tb_contratos_id = :tb_contratos_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_contratos_id', $id);
    $sql->execute();

    $sql = "DELETE FROM tb_contratos WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    return $array['tb_clientes_id'];
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE EXISTE LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function existeLogin($login, $tb_empresas_id) {
    $sql = "SELECT login FROM tb_contratos WHERE login = :login AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':login', $login);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
      return true;
    } else {
      return false;
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //COMPARA LOGIN PARA EDICAO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comparaLogin($id, $tb_empresas_id) {
    $sql = "SELECT login FROM tb_contratos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array['login'];
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
?>
