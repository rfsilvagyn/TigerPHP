<?php
class Estoque extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODAS AS MOVIMENTACOES DO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT m.*, u.nome AS usuario, us.nome AS solicitante, a.nome AS armazem FROM tb_movimentacaoestoque AS m
    LEFT JOIN tb_usuarios AS u ON u.id = m.tb_usuarios_id
    LEFT JOIN tb_usuarios AS us ON us.id = m.id_solicitante
    LEFT JOIN tb_armazem AS a ON a.id = m.tb_armazem_id
    WHERE m.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER MOVIMENTACAO POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT m.*, u.nome AS usuario, us.nome AS solicitante, a.nome AS armazem FROM tb_movimentacaoestoque AS m
    LEFT JOIN tb_usuarios AS u ON u.id = m.tb_usuarios_id
    LEFT JOIN tb_usuarios AS us ON us.id = m.id_solicitante
    LEFT JOIN tb_armazem AS a ON a.id = m.tb_armazem_id
    WHERE m.id = :id AND m.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array['tb_movimentacaoestoque'] = $sql->fetch(PDO::FETCH_ASSOC);
    }

    $sql = "SELECT e.*, p.nome AS produto, a.nome AS armazem, p.unidade FROM tb_estoque AS e
    LEFT JOIN tb_produtos AS p ON p.id = e.tb_produtos_id
    LEFT JOIN tb_armazem AS a ON a.id = e.tb_armazem_id
    WHERE e.tb_movimentacaoestoque_id = :tb_movimentacaoestoque_id AND e.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_movimentacaoestoque_id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array['tb_estoque'] = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ENTRADA NO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function entrada( $tipo, $tb_armazem_id, $produtos, $tb_usuarios_id, $tb_empresas_id ) {
    $array = array();

    $sql = "INSERT INTO tb_movimentacaoestoque SET data = NOW(), tipo = :tipo, tb_armazem_id = :tb_armazem_id, tb_usuarios_id = :tb_usuarios_id,
    tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':tb_armazem_id', $tb_armazem_id);
    $sql->bindValue(':tb_usuarios_id', $tb_usuarios_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $tb_movimentacaoestoque_id = $this->db->lastInsertId();

    foreach ($produtos as $item) {

      $sql = "INSERT INTO tb_estoque SET quantidade = :quantidade, ns = :ns, tipo = :tipo, tb_produtos_id = :tb_produtos_id, tb_armazem_id = :tb_armazem_id,
      tb_movimentacaoestoque_id = :tb_movimentacaoestoque_id, tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':quantidade', $item['quantidade']);
      $sql->bindValue(':ns', strtoupper($item['ns']));
      $sql->bindValue(':tipo', $tipo);
      $sql->bindValue(':tb_produtos_id', $item['produto']);
      $sql->bindValue(':tb_armazem_id', $tb_armazem_id);
      $sql->bindValue(':tb_movimentacaoestoque_id', $tb_movimentacaoestoque_id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SAIDA NO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function saida( $tipo, $tb_armazem_id, $produtos, $tb_usuarios_id, $id_solicitante, $tb_empresas_id ) {
    $array = array();

    $sql = "INSERT INTO tb_movimentacaoestoque SET data = NOW(), tipo = :tipo, tb_armazem_id = :tb_armazem_id, tb_usuarios_id = :tb_usuarios_id,
    id_solicitante = :id_solicitante, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tipo', $tipo);
    $sql->bindValue(':tb_armazem_id', $tb_armazem_id);
    $sql->bindValue(':tb_usuarios_id', $tb_usuarios_id);
    $sql->bindValue(':id_solicitante', $id_solicitante);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $tb_movimentacaoestoque_id = $this->db->lastInsertId();

    foreach ($produtos as $item) {

      $sql = "INSERT INTO tb_estoque SET quantidade = :quantidade, ns = :ns, tipo = :tipo, tb_produtos_id = :tb_produtos_id, tb_armazem_id = :tb_armazem_id,
      tb_movimentacaoestoque_id = :tb_movimentacaoestoque_id, tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':quantidade', $item['quantidade']);
      $sql->bindValue(':ns', strtoupper($item['ns']));
      $sql->bindValue(':tipo', $tipo);
      $sql->bindValue(':tb_produtos_id', $item['produto']);
      $sql->bindValue(':tb_armazem_id', $tb_armazem_id);
      $sql->bindValue(':tb_movimentacaoestoque_id', $tb_movimentacaoestoque_id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER ESTOQUE DO PRODUTO POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterEstoque($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM vw_estoquesaldo WHERE tb_produtos_id = :tb_produtos_id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_produtos_id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }






}
?>
