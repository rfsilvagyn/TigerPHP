<?php
class Cron extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ALTERAR STATUS DOS CONTAS A PAGAR PARA VENCIDO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function statusVencidoPagar() {
    $array = array();
    $status = 'VENCIDO';

    $sql = "UPDATE tb_contaspagar SET status = :status WHERE data_vencimento < CURDATE() AND status = 'ABERTO'";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('status', $status);
    $sql->execute();

    return true;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ALTERAR STATUS DOS CONTAS A PAGAR PARA VENCIDO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function statusVencidoReceber() {
    $array = array();
    $status = 'VENCIDO';

    $sql = "UPDATE tb_contasreceber SET status = :status WHERE data_vencimento < CURDATE() AND status = 'ABERTO'";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('status', $status);
    $sql->execute();

    return true;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function diasAtrasoReceber() {
    $array = array();

    $sql = "UPDATE tb_contasreceber SET dias_atraso = DATEDIFF( CURDATE(), data_vencimento ) WHERE status != 'PAGO'";
    $sql = $this->db->prepare($sql);
    $sql->execute();

    return true;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A PAGAR VENCENDO NO DIA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function vencendoHojePagar($tb_empresas_id) {
    $array = array();

    $sql = "SELECT p.*, f.nome as fornecedor FROM tb_contaspagar as p
    LEFT JOIN tb_fornecedores as f ON f.id = p.tb_fornecedores_id
    WHERE p.data_vencimento = CURDATE() AND p.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A PAGAR VENCIDOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function vencidosPagar($tb_empresas_id) {
    $array = array();
    $status = 'VENCIDO';

    $sql = "SELECT p.*, f.nome as fornecedor FROM tb_contaspagar as p
    LEFT JOIN tb_fornecedores as f ON f.id = p.tb_fornecedores_id
    WHERE p.status = :status AND p.tb_empresas_id = :tb_empresas_id
    ORDER BY p.data_vencimento";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('status', $status);
    $sql->bindValue('tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER E-MAIL CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterEmailPagar($id) {
    $array = array();

    $sql = "SELECT email_contasapagar, enviar_email_contasapagar FROM tb_empresas WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ALTERA STATUS COMPROVANTES CONFIRMADOS PARA ARQUIVAMOS APOS 10 DIAS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function arquivaComprovantes() {
    $array = array();
    $status = 'ARQUIVADO';

    $sql = "UPDATE tb_comprovantes SET status = :status WHERE data_cadastro <= CURDATE() - INTERVAL 10 DAY AND status = 'CONFIRMADO'";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('status', $status);
    $sql->execute();

    return true;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}
?>
