<?php
class LancamentosPagar extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS PLANOS FILTRADO POR ID DA CONTA A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_contaspagar_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT l.*, c.nome as nome_contas, f.nome as nome_formaspagamento FROM tb_lancamentospagar as l
    LEFT JOIN tb_contas as c ON c.id = l.tb_contas_id
    LEFT JOIN tb_formaspagamento as f ON f.id = l.tb_formaspagamento_id
    WHERE l.tb_contaspagar_id = :tb_contaspagar_id AND l.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
?>
