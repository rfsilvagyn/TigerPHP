<?php
class Produtos extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS PRODUTOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_produtos WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER PRODUTO POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_produtos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
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
  //ADICIONAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($nome, $unidade, $quantidade_minima, $tb_empresas_id) {
    $array = array();

    $sql = "INSERT INTO tb_produtos SET nome = :nome, unidade = :unidade, quantidade_minima = :quantidade_minima, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':unidade', $unidade);
    $sql->bindValue(':quantidade_minima', $quantidade_minima);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $nome, $unidade, $quantidade_minima, $status, $tb_empresas_id) {
    $array = array();

    $sql = "UPDATE tb_produtos SET nome = :nome, unidade = :unidade, quantidade_minima = :quantidade_minima,
    status = :status WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':unidade', $unidade);
    $sql->bindValue(':quantidade_minima', $quantidade_minima);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    $array = array();

    try {
      $sql = "DELETE FROM tb_produtos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
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
