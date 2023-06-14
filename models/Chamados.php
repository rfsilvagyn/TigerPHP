<?php
class Chamados extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CHAMADOS FILTRO POR CODIGO DO CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_clientes_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT c.*, a.nome as categoria, u.nome as usuario FROM tb_chamados AS c
    LEFT JOIN tb_categorias_chamados as a ON a.id = c.tb_categorias_chamados_id
    LEFT JOIN tb_usuarios as u ON u.id = c.id_usuario_executor
    WHERE c.tb_clientes_id = :tb_clientes_id AND c.tb_empresas_id = :tb_empresas_id";

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
  //OBTER CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT c.*, a.nome as categoria, u.nome as usuario_executor, u1.nome as usuario_abertura, cl.nome as nome_cliente FROM tb_chamados AS c
    LEFT JOIN tb_categorias_chamados as a ON a.id = c.tb_categorias_chamados_id
    LEFT JOIN tb_usuarios as u ON u.id = c.id_usuario_executor
    LEFT JOIN tb_usuarios as u1 ON u1.id = c.id_usuario_abertura
    LEFT JOIN tb_clientes as cl ON cl.id = c.tb_clientes_id
    WHERE c.id = :id AND c.tb_empresas_id = :tb_empresas_id";

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
  //ADICIONAR CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_clientes_id, $id_usuario_abertura, $tipo, $tb_categorias_chamados_id, $prioridade, $data_abertura, $data_checkin,
  $data_checkout, $hora_abertura, $hora_checkin, $hora_checkout, $descricao, $tb_contratos_id, $id_usuario_executor, $valor_total, $data_agendamento, $hora_agendamento, $tb_empresas_id) {
    $array = array();

    $sql = "INSERT INTO tb_chamados SET tb_clientes_id = :tb_clientes_id, id_usuario_abertura = :id_usuario_abertura, tipo = :tipo, tb_categorias_chamados_id = :tb_categorias_chamados_id,
    prioridade = :prioridade, data_abertura = :data_abertura, data_checkin = :data_checkin, data_checkout = :data_checkout, hora_abertura = :hora_abertura, hora_checkin = :hora_checkin,
    hora_checkout = :hora_checkout, descricao = :descricao, tb_contratos_id = :tb_contratos_id, id_usuario_executor = :id_usuario_executor, valor_total = :valor_total, data_agendamento = :data_agendamento,
    hora_agendamento = :hora_agendamento, tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue('tb_clientes_id', $tb_clientes_id);
    $sql->bindValue('id_usuario_abertura', $id_usuario_abertura);
    $sql->bindValue('tipo', $tipo);
    $sql->bindValue('tb_categorias_chamados_id', $tb_categorias_chamados_id);
    $sql->bindValue('prioridade', $prioridade);
    $sql->bindValue('data_abertura', $data_abertura);
    $sql->bindValue('data_checkin', $data_checkin);
    $sql->bindValue('data_checkout', $data_checkout);
    $sql->bindValue('hora_abertura', $hora_abertura);
    $sql->bindValue('hora_checkin', $hora_checkin);
    $sql->bindValue('hora_checkout', $hora_checkout);
    $sql->bindValue('descricao', $descricao);
    $sql->bindValue('tb_contratos_id', $tb_contratos_id);
    $sql->bindValue('id_usuario_executor', $id_usuario_executor);
    $sql->bindValue('valor_total', $valor_total);
    $sql->bindValue('hora_agendamento', $hora_agendamento);
    $sql->bindValue('data_agendamento', $data_agendamento);
    $sql->bindValue('tb_empresas_id', $tb_empresas_id);

    $sql->execute();

    return $tb_clientes_id;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $tb_clientes_id, $tipo, $prioridade, $tb_categorias_chamados_id, $id_usuario_executor,
  $descricao, $hora_agendamento, $data_agendamento, $valor_total, $tb_empresas_id) {
    $array = array();

    $sql = "UPDATE tb_chamados SET tipo = :tipo, prioridade = :prioridade, tb_categorias_chamados_id = :tb_categorias_chamados_id,
    id_usuario_executor = :id_usuario_executor, descricao = :descricao, hora_agendamento = :hora_agendamento, data_agendamento = :data_agendamento,
    valor_total = :valor_total WHERE id = :id AND tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->bindValue('tb_empresas_id', $tb_empresas_id);
    $sql->bindValue('tipo', $tipo);
    $sql->bindValue('prioridade', $prioridade);
    $sql->bindValue('tb_categorias_chamados_id', $tb_categorias_chamados_id);
    $sql->bindValue('id_usuario_executor', $id_usuario_executor);
    $sql->bindValue('descricao', $descricao);
    $sql->bindValue('hora_agendamento', $hora_agendamento);
    $sql->bindValue('data_agendamento', $data_agendamento);
    $sql->bindValue('valor_total', $valor_total);

    $sql->execute();

    return $tb_clientes_id;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKIN CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkin($id, $tb_empresas_id) {
    $array = array();
    $resultado = array();
    $data_checkin = date('Y-m-d');
    $hora_checkin = date('H:i');
    $status = 'INICIADO';

    $sql = "SELECT status from tb_chamados WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    if ($resultado['status'] == 'ABERTO') {
      $sql = "UPDATE tb_chamados SET data_checkin = :data_checkin, hora_checkin = :hora_checkin, status = :status WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue('id', $id);
      $sql->bindValue('data_checkin', $data_checkin);
      $sql->bindValue('hora_checkin', $hora_checkin);
      $sql->bindValue('status', $status);
      $sql->bindValue('tb_empresas_id', $tb_empresas_id);
      $sql->execute();
      return $id;
    } else {
      return $id;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKOUT CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkout($id, $tb_empresas_id) {
    $array = array();
    $data_checkout = date('Y-m-d');
    $hora_checkout = date('H:i');
    $status = 'FINALIZADO';

    $sql = "SELECT status from tb_chamados WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    if ($resultado['status'] == 'INICIADO') {
      $sql = "UPDATE tb_chamados SET data_checkout = :data_checkout, hora_checkout = :hora_checkout, status = :status WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue('id', $id);
      $sql->bindValue('data_checkout', $data_checkout);
      $sql->bindValue('hora_checkout', $hora_checkout);
      $sql->bindValue('status', $status);
      $sql->bindValue('tb_empresas_id', $tb_empresas_id);
      $sql->execute();
      return $id;
    }else {
      return $id;
    }
  }


}
?>
