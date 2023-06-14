<?php
class Pagar extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODAS AS CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();
    $status = 'VENCIDO';

    $sql = "SELECT p.*, f.nome as fornecedor FROM tb_contaspagar as p
    LEFT JOIN tb_fornecedores as f ON f.id = p.tb_fornecedores_id
    WHERE p.status = :status OR p.data_vencimento = CURRENT_DATE AND p.tb_empresas_id = :tb_empresas_id
    ORDER BY p.data_vencimento";
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
  //OBTER CONTAS A PAGAR POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT p.*, f.nome as fornecedor FROM tb_contaspagar as p
    LEFT JOIN tb_fornecedores as f ON f.id = p.tb_fornecedores_id
    WHERE p.id = :id AND p.tb_empresas_id = :tb_empresas_id ";
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
  //OBTER CONTAS A PAGAR FILTRADO POR STATUS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterStatus($status, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT p.*, f.nome as fornecedor FROM tb_contaspagar as p
    LEFT JOIN tb_fornecedores as f ON f.id = p.tb_fornecedores_id
    WHERE p.status = :status AND p.tb_empresas_id = :tb_empresas_id
    ORDER BY p.data_vencimento";
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
  //ADICIONAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_fornecedores_id, $nota_fiscal, $data_lancamento, $referencia, $tb_planocontas_id, $tb_formaspagamento_id, $parcelas, $tb_empresas_id) {
    $array = array();

    foreach ($parcelas as $item) {

      $sql =
      "INSERT INTO tb_contaspagar SET
      tb_fornecedores_id = :tb_fornecedores_id,
      nota_fiscal = :nota_fiscal,
      documento = :documento,
      data_lancamento = :data_lancamento,
      data_vencimento = :data_vencimento,
      valor = :valor, referencia = :referencia,
      tb_planocontas_id = :tb_planocontas_id,
      tb_formaspagamento_id = :tb_formaspagamento_id,
      tb_empresas_id = :tb_empresas_id";

      $sql = $this->db->prepare($sql);
      $sql->bindValue(':tb_fornecedores_id', $tb_fornecedores_id);
      $sql->bindValue(':nota_fiscal', $nota_fiscal);
      $sql->bindValue(':data_lancamento', $data_lancamento);
      $sql->bindValue(':tb_planocontas_id', $tb_planocontas_id);
      $sql->bindValue(':tb_formaspagamento_id', $tb_formaspagamento_id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->bindValue(':data_vencimento', $item['vencimento']);
      $sql->bindValue(':valor', $item['valor']);
      $sql->bindValue(':referencia', strtoupper($item['referencia']));
      $sql->bindValue(':documento', $item['documento']);

      $sql->execute();
    }

    return $this->db->lastInsertId();


  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id, $tb_fornecedores_id, $nota_fiscal, $documento, $data_lancamento, $data_vencimento, $valor, $acrescimo, $referencia, $tb_planocontas_id, $tb_formaspagamento_id, $tb_empresas_id) {
    $array = array();
    $hoje = date('yy-m-d');

    if (strtotime($data_vencimento) >= strtotime($hoje)) {
      $sql = "UPDATE tb_contaspagar SET status = :status
      WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->bindValue(':status', 'ABERTO');
      $sql->execute();
    }

    $sql = "UPDATE tb_contaspagar SET tb_fornecedores_id = :tb_fornecedores_id, nota_fiscal = :nota_fiscal, documento = :documento, data_lancamento = :data_lancamento, data_vencimento = :data_vencimento, valor = :valor, acrescimo = :acrescimo, referencia = :referencia, tb_planocontas_id = :tb_planocontas_id, tb_formaspagamento_id = :tb_formaspagamento_id
    WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_fornecedores_id', $tb_fornecedores_id);
    $sql->bindValue(':nota_fiscal', $nota_fiscal);
    $sql->bindValue(':documento', $documento);
    $sql->bindValue(':data_lancamento', $data_lancamento);
    $sql->bindValue(':data_vencimento', $data_vencimento);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':acrescimo', $acrescimo);
    $sql->bindValue(':referencia', $referencia);
    $sql->bindValue(':tb_planocontas_id', $tb_planocontas_id);
    $sql->bindValue(':tb_formaspagamento_id', $tb_formaspagamento_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();
    return $id;

  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    $array = array();

    $sql = "DELETE FROM tb_contaspagar WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //BAIXAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function baixar($tb_contaspagar_id, $data, $valor, $saldo, $tb_contas_id, $tb_formaspagamento_id, $tb_empresas_id) {
    $array = array();

    if ($valor >= $saldo) {
      $status = 'PAGO';
    } else {
      $status = 'PARCIAL';
    }

    $sql = "INSERT INTO tb_lancamentospagar SET tb_contaspagar_id = :tb_contaspagar_id, data = :data, valor = :valor, tb_contas_id = :tb_contas_id, tb_formaspagamento_id = :tb_formaspagamento_id, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sql->bindValue(':data', $data);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':tb_contas_id', $tb_contas_id);
    $sql->bindValue(':tb_formaspagamento_id', $tb_formaspagamento_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    $sqla = "SELECT SUM(valor) AS valor_pago FROM tb_lancamentospagar
    WHERE tb_contaspagar_id = :tb_contaspagar_id AND tb_empresas_id = :tb_empresas_id";
    $sqla = $this->db->prepare($sqla);
    $sqla->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sqla->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqla->execute();

    if ($sqla->rowCount() > 0) {
      $array = $sqla->fetch(PDO::FETCH_ASSOC);
      $valor_pago = number_format($array['valor_pago'], 2, '.', '');
    }

    $sqlc = "UPDATE tb_contaspagar SET status = :status, valor_pago = :valor_pago WHERE id = :tb_contaspagar_id AND tb_empresas_id = :tb_empresas_id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':status', $status);
    $sqlc->bindValue(':valor_pago', $valor_pago);
    $sqlc->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sqlc->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqlc->execute();

    return $tb_contaspagar_id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ESTORNAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function estornar($id, $tb_empresas_id) {
    $array = array();
    //COM ID DO LANCAMENTO PAGAR PEGO O CONTAS A PAGAR ID E O VALOR
    $sqla = "SELECT * FROM tb_lancamentospagar WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sqla = $this->db->prepare($sqla);
    $sqla->bindValue(':id', $id);
    $sqla->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqla->execute();

    if ($sqla->rowCount() > 0) {
      $array = $sqla->fetch(PDO::FETCH_ASSOC);
      $tb_contaspagar_id = $array['tb_contaspagar_id'];
      $valor = number_format($array['valor'], 2, '.', '');
    }
    //DELETO O LANCAMENTO PAGAR
    $sql = "DELETE FROM tb_lancamentospagar WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //RECALCULO O VALOR TOTAL PAGO
    $sqlb = "SELECT SUM(valor) AS valor_pago FROM tb_lancamentospagar
    WHERE tb_contaspagar_id = :tb_contaspagar_id AND tb_empresas_id = :tb_empresas_id";
    $sqlb = $this->db->prepare($sqlb);
    $sqlb->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sqlb->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqlb->execute();

    if ($sqlb->rowCount() > 0) {
      $array = $sqlb->fetch(PDO::FETCH_ASSOC);
      $valor_pago = number_format($array['valor_pago'], 2, '.', '');
    }

    //VERIFICO SE EXISTE REGISTRO DE PAGAMENTO AINDA POR ID DA CONTAS A PAGAR PARA DEFINIR O STATUS DO TITULO
    $sqld = "SELECT * FROM tb_lancamentospagar
    WHERE tb_contaspagar_id = :tb_contaspagar_id AND tb_empresas_id = :tb_empresas_id";
    $sqld = $this->db->prepare($sqld);
    $sqld->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sqld->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqld->execute();

    if ($sqld->rowCount() > 0) {
      $parcial = true;
    } else {
      $parcial = false;
    }

    if ($parcial) {
      $status = 'PARCIAL';
    } else {
      $status = 'ABERTO';
    }
    //ATUALIZO O TITULO COM NOVO STATUS E VALOR PAGO
    $sqlc = "UPDATE tb_contaspagar SET status = :status, valor_pago = :valor_pago WHERE id = :tb_contaspagar_id AND tb_empresas_id = :tb_empresas_id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':status', $status);
    $sqlc->bindValue(':valor_pago', $valor_pago);
    $sqlc->bindValue(':tb_contaspagar_id', $tb_contaspagar_id);
    $sqlc->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqlc->execute();

    return $tb_contaspagar_id;

  }



}
?>
