<?php
class Grupospermissoes extends Model {

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS GRUPOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_gruposusuarios WHERE tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_gruposusuarios WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
      $array['parametros'] = explode(',', $array['parametros']);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($nome, $parametros, $tb_empresas_id) {

    if ($parametros) {
      $parametros = implode(',', $parametros);
    } else {
      $parametros = '';
    }


    $sql = "INSERT INTO tb_gruposusuarios SET nome = :nome, parametros = :parametros, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':parametros', $parametros);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $usuarios = new Usuarios();

    if ($usuarios->temUsuarioNoGrupo($id) == false) {
      $sql = "DELETE FROM tb_gruposusuarios WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->execute();
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($nome, $parametros, $id, $tb_empresas_id) {
    if ($parametros) {
      $parametros = implode(',', $parametros);
    } else {
      $parametros = '';
    }

    $sql = "UPDATE tb_gruposusuarios SET nome = :nome, parametros = :parametros, tb_empresas_id = :tb_empresas_id WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':parametros', $parametros);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->bindValue(':id', $id);
    $sql->execute();
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
?>
