<?php
class Vendedores extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS VENDEDORES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_vendedores WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
?>