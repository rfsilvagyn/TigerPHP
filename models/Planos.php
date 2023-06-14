<?php
class Planos extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS PLANOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_planos WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_planos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
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
  //ADICIONAR PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($nome, $download, $upload, $burst, $burst_download, $burst_upload, $prioridade, $valor, $valor_instalacao,
  $senha_padrao_autenticacao, $senha_padrao_central, $tb_empresas_id) {
    $array = array();

    //ADICIONA PLANO BANCO DE DADOS DO TIGER
    $sql = "INSERT INTO tb_planos SET nome = :nome, download = :download, upload = :upload, burst = :burst, burst_download = :burst_download,
    burst_upload = :burst_upload, prioridade = :prioridade, valor = :valor, valor_instalacao = :valor_instalacao,
    senha_padrao_autenticacao = :senha_padrao_autenticacao, senha_padrao_central = :senha_padrao_central, tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':download', $download);
    $sql->bindValue(':upload', $upload);
    $sql->bindValue(':burst', $burst);
    $sql->bindValue(':burst_download', $burst_download);
    $sql->bindValue(':burst_upload', $burst_upload);
    $sql->bindValue(':prioridade', $prioridade);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':valor_instalacao', $valor_instalacao);
    $sql->bindValue(':senha_padrao_autenticacao', $senha_padrao_autenticacao);
    $sql->bindValue(':senha_padrao_central', $senha_padrao_central);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $id_plano_tiger = $this->db->lastInsertId();

    //ADICIONAR PLANO BANCO DE DADOS RADIUS TABELA RADGROUPCHECK
    $array = [
      [ 'attribute' => 'Service-Type', 'op' => '==', 'value' => 'Framed-User' ],
      [ 'attribute' => 'Framed-Protocol', 'op' => ':=', 'value' => 'PPP' ]
    ];

    $sql = "INSERT INTO radgroupcheck SET id_plano_tiger = :id_plano_tiger, groupname = :groupname, attribute = :attribute, op = :op, value = :value";
    $sql = $this->dbradius->prepare($sql);

    foreach( $array as $item ) {
      $sql->bindValue(':id_plano_tiger', $id_plano_tiger);
      $sql->bindValue(':groupname', $nome);
      $sql->bindValue(':attribute', $item['attribute']);
      $sql->bindValue(':op', $item['op']);
      $sql->bindValue(':value', $item['value']);
      $sql->execute();
    }

    //VERIFICA SE O PLANO TEM BURST ATIVADO OU NAO
    if ($burst == 'SIM') {
      $velocidade = $upload.'k/'.$download.'k '.$burst_upload.'k/'.$burst_download.'k '.$upload.'k/'.$download.'k 120/120 '.$prioridade;
    } else {
      $velocidade = $upload.'k/'.$download.'k';
    }

    //ADICIONA PLANO BANCO DE DADOS RADIUS TABELA RADGROUPREPLY
    $array = [
      [ 'attribute' => 'Acct-Interim-Interval', 'op' => ':=', 'value' => '300' ],
      [ 'attribute' => 'Mikrotik-Rate-Limit', 'op' => ':=', 'value' => $velocidade ]
    ];

    $sql = "INSERT INTO radgroupreply SET id_plano_tiger = :id_plano_tiger, groupname = :groupname, attribute = :attribute, op = :op, value = :value";
    $sql = $this->dbradius->prepare($sql);

    foreach( $array as $item ) {
      $sql->bindValue(':id_plano_tiger', $id_plano_tiger);
      $sql->bindValue(':groupname', $nome);
      $sql->bindValue(':attribute', $item['attribute']);
      $sql->bindValue(':op', $item['op']);
      $sql->bindValue(':value', $item['value']);
      $sql->execute();
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $nome, $download, $upload, $burst, $burst_download, $burst_upload, $prioridade, $valor, $valor_instalacao,
  $senha_padrao_autenticacao, $senha_padrao_central, $tb_empresas_id) {
    $array = array();


    //EDITA PLANO BANCO DE DADOS DO TIGER
    $sql = "UPDATE tb_planos SET nome = :nome, download = :download, upload = :upload, burst = :burst, burst_download = :burst_download,
    burst_upload = :burst_upload, prioridade = :prioridade, valor = :valor, valor_instalacao = :valor_instalacao,
    senha_padrao_autenticacao = :senha_padrao_autenticacao, senha_padrao_central = :senha_padrao_central, tb_empresas_id = :tb_empresas_id
    WHERE id = :id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':download', $download);
    $sql->bindValue(':upload', $upload);
    $sql->bindValue(':burst', $burst);
    $sql->bindValue(':burst_download', $burst_download);
    $sql->bindValue(':burst_upload', $burst_upload);
    $sql->bindValue(':prioridade', $prioridade);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':valor_instalacao', $valor_instalacao);
    $sql->bindValue(':senha_padrao_autenticacao', $senha_padrao_autenticacao);
    $sql->bindValue(':senha_padrao_central', $senha_padrao_central);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //EDITAR PLANO BANCO DE DADOS RADIUS TABELA RADGROUPCHECK
    $sql = "UPDATE radgroupcheck SET groupname = :groupname WHERE id_plano_tiger = :id_plano_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_plano_tiger', $id);
    $sql->bindValue(':groupname', $nome);
    $sql->execute();





    //VERIFICA SE O PLANO TEM BURST ATIVADO OU NAO
    if ($burst == 'SIM') {
      $velocidade = $upload.'k/'.$download.'k '.$burst_upload.'k/'.$burst_download.'k '.$upload.'k/'.$download.'k 120/120 '.$prioridade;
    } else {
      $velocidade = $upload.'k/'.$download.'k';
    }

    //ALTERA PLANO BANCO DE DADOS RADIUS TABELA RADGROUPREPLY - VELOCIDADE DO PLANO
    $attribute = 'Mikrotik-Rate-Limit';

    $sql = "UPDATE radgroupreply SET value = :value WHERE id_plano_tiger = :id_plano_tiger AND attribute = :attribute";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_plano_tiger', $id);
    $sql->bindValue(':attribute', $attribute);
    $sql->bindValue(':value', $velocidade);
    $sql->execute();

    //ALTERA PLANO BANCO DE DADOS RADIUS TABELA RADGROUPREPLY - NOME DO PLANO
    $sql = "UPDATE radgroupreply SET groupname = :groupname WHERE id_plano_tiger = :id_plano_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_plano_tiger', $id);
    $sql->bindValue(':groupname', $nome);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    $array = array();
    //DELETA PLANO BANCO DE DADOS DO TIGER
    $sql = "DELETE FROM tb_planos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $sql = "DELETE FROM radgroupcheck WHERE id_plano_tiger = :id_plano_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_plano_tiger', $id);
    $sql->execute();

    $sql = "DELETE FROM radgroupreply WHERE id_plano_tiger = :id_plano_tiger";
    $sql = $this->dbradius->prepare($sql);
    $sql->bindValue(':id_plano_tiger', $id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
?>
