<?php
class App extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function login($login, $senha) {
    $array = array();
    $sql = "SELECT id, login, nome, email FROM tb_usuarios WHERE login = :login AND senha = :senha";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':login', $login);
    $sql->bindValue(':senha', MD5($senha));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
      $array['validado'] = true;
      return $array;
    } else {
      $array['validado'] = false;
      return $array;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterChamados($id_executor) {
    $array = array();

    $sql = "SELECT c.id, c.descricao, c.valor_total, c.status, c.prioridade, i.nome as cliente, o.endereco_instalacao,
    o.bairro_instalacao, o.cidade_instalacao, a.nome as categoria, u.id as id_executor, u.nome as executor FROM tb_chamados AS c
    LEFT JOIN tb_clientes as i ON i.id = c.tb_clientes_id
    LEFT JOIN tb_contratos as o ON o.id = c.tb_contratos_id
    LEFT JOIN tb_categorias_chamados as a ON a.id = c.tb_categorias_chamados_id
    LEFT JOIN tb_usuarios as u ON u.id = c.id_usuario_executor
    WHERE u.id = :id_executor AND c.status <> 'FINALIZADO'";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_executor', $id_executor);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CHAMADO POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterChamado($id) {
    $array = array();

    $sql = "SELECT c.*, a.nome as categoria, u.nome as usuario FROM tb_chamados AS c
    LEFT JOIN tb_categorias_chamados as a ON a.id = c.tb_categorias_chamados_id
    LEFT JOIN tb_usuarios as u ON u.id = c.id_usuario_executor
    WHERE c.id = :id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKIN CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkin($id, $latitude_checkin, $longitude_checkin) {
    $array = array();

    $data_checkin = date('Y-m-d');
    $hora_checkin = date('H:i');
    $status = 'INICIADO';

    $sql = "UPDATE tb_chamados SET data_checkin = :data_checkin, hora_checkin = :hora_checkin, latitude_checkin = :latitude_checkin,
    longitude_checkin = :longitude_checkin, status = :status WHERE id = :id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->bindValue('data_checkin', $data_checkin);
    $sql->bindValue('hora_checkin', $hora_checkin);
    $sql->bindValue('latitude_checkin', $latitude_checkin);
    $sql->bindValue('longitude_checkin', $longitude_checkin);
    $sql->bindValue('status', $status);
    $sql->execute();
    return $id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKOUT CHAMADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkout($id, $latitude_checkout, $longitude_checkout) {
    $array = array();

    $data_checkout = date('Y-m-d');
    $hora_checkout = date('H:i');
    $status = 'FINALIZADO';

    $sql = "UPDATE tb_chamados SET data_checkout = :data_checkout, hora_checkout = :hora_checkout, latitude_checkout = :latitude_checkout,
    longitude_checkout = :longitude_checkout, status = :status WHERE id = :id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->bindValue('data_checkout', $data_checkout);
    $sql->bindValue('hora_checkout', $hora_checkout);
    $sql->bindValue('latitude_checkout', $latitude_checkout);
    $sql->bindValue('longitude_checkout', $longitude_checkout);
    $sql->bindValue('status', $status);
    $sql->execute();
    return $id;

  }



}
?>
