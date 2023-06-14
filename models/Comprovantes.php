<?php
class Comprovantes extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS COMPROVANTES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();
    $status = 'ARQUIVADO';

    $sql = "SELECT c.id, c.tipo, c.data, c.valor, c.vencimento, c.contrato, c.cliente, c.nome, c.status, o.nome AS nome_conta, u.nome AS nome_usuario
    FROM tb_comprovantes c
    LEFT JOIN tb_usuarios u ON c.tb_usuarios_id = u.id
    LEFT JOIN tb_contas o ON c.tb_contas_id = o.id
    WHERE c.status != :status AND c.tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER COMPROVANTE POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT c.id, c.tipo, c.data, c.valor, c.vencimento, c.contrato, c.cliente, c.nome, c.status, o.nome AS nome_conta, u.nome AS nome_usuario
    FROM tb_comprovantes c
    LEFT JOIN tb_usuarios u ON c.tb_usuarios_id = u.id
    LEFT JOIN tb_contas o ON c.tb_contas_id = o.id
    WHERE c.id = :id AND c.tb_empresas_id = :tb_empresas_id";
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
  //ADICIONAR COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tipo, $data, $hora, $numero, $tb_contas_id, $valor, $vencimento, $contrato, $cliente, $nome, $tb_usuarios_id, $tb_empresas_id) {
    $array = array();

    $sql = "INSERT INTO tb_comprovantes SET tipo = :tipo, data = :data, hora = :hora, numero = :numero, tb_contas_id = :tb_contas_id, valor = :valor,
    vencimento = :vencimento, contrato = :contrato, cliente = :cliente, nome = :nome, data_cadastro = NOW(), tb_usuarios_id = :tb_usuarios_id, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':data', $data);
    $sql->bindValue(':hora', $hora);
    $sql->bindValue(':numero', $numero);
    $sql->bindValue(':tb_contas_id', $tb_contas_id);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':vencimento', $vencimento);
    $sql->bindValue(':contrato', $contrato);
    $sql->bindValue(':cliente', $cliente);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':tb_usuarios_id', $tb_usuarios_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIRMAR COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function confirmar($id, $tb_empresas_id) {
    $array = array();
    $status = 'CONFIRMADO';

    $sql = "UPDATE tb_comprovantes SET status = :status WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ALERTA COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function alerta($id, $tb_empresas_id) {
    $array = array();
    $status = 'ERRO';

    $sql = "UPDATE tb_comprovantes SET status = :status WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }



}
?>
