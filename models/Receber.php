<?php
class Receber extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodosRemessa($conta, $vinicial, $vfinal, $status, $cliente, $tb_empresas_id) {
    $array = array();
    $where = array();

    $sql = "SELECT r.*, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia, c.agencia_dv as agencia_dv,
    c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira, l.nome as nome_cliente, l.cpf as cpf_cliente,
    l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente, l.cep as cep_cliente, e.nome as nome_empresa, e.cnpj as cnpj_empresa,
    e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

    FROM tb_contasreceber as r
    LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
    LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
    LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
    LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id
    WHERE ";

    //CONDICAO FIXA - EMPRESA, SEM REMESSA, DATA DE VENCIMENTO MAIOR QUE DATA ATUAL E CONTA
    $where[] = "r.tb_empresas_id = :tb_empresas_id AND remessa IS NULL AND data_vencimento > CURDATE( )";
    $where[] = "r.tb_contas_id = :tb_contas_id";

    //VERIFICA SE FOI INFORMADO PARA INICIAL E DATA FINAL PARA ADICIONAR AO WHERE
    if (!empty($vinicial) && !empty($vfinal)) {
      $where[] = "r.data_vencimento BETWEEN :vinicial AND :vfinal";
    }

    //VERIFICA SE FOI INFORMADO STATUS PARA ADICIONAR AO WHERE
    if (!empty($status)) {
      $where[] = "o.status = :status";
    }

    //VERIFICA SE FOI INFORMADO NOME DO CLIENTE PARA ADICIONAR AO WHERE
    if (!empty($cliente)) {
      $where[] = "l.nome = :cliente";
    }

    //JUNTA TODOS AS CONDICOES NO WHERE
    $sql .= implode(' AND ', $where);

    $sql = $this->db->prepare($sql);

    //BINDVALUE FIXO - EMPRESA E CONTA
    $sql->bindValue(':tb_contas_id', $conta);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);

    //VERIFICA SE FOI INFORMADO DATA INICIAL E DATA FINAL PARA FAZER O BINDVALUE
    if (!empty($vinicial) && !empty($vfinal)) {
      $sql->bindValue(':vinicial', $vinicial);
      $sql->bindValue(':vfinal', $vfinal);
    }

    //VERIFICA SE FOI INFORMADO STATUS PARA FAZER O BINDVALUE
    if (!empty($status)) {
      $sql->bindValue(':status', $status);
    }

    //VERIFICA SE FOI INFORMADO O NOME DO CLIENTE PARA FAZER O BINDVALUE
    if (!empty($cliente)) {
      $sql->bindValue(':cliente', $cliente);
    }


    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array['informacoes'] = $sql->fetchAll(PDO::FETCH_ASSOC);
      $array['quantidade'] = $sql->rowCount(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A RECEBER POR CLIENTE COM STATUS ABERTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodosPorClienteAbertos($tb_clientes_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT r.*, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia,
    c.agencia_dv as agencia_dv, c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira,
    l.nome as nome_cliente, l.cpf as cpf_cliente, l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente,
    l.cep as cep_cliente, e.nome as nome_empresa, e.cnpj as cnpj_empresa, e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

    FROM tb_contasreceber as r
    LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
    LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
    LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
    LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id

    WHERE l.id = :tb_clientes_id AND r.status != 'PAGO' AND r.status != 'CANCELADO' AND r.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_clientes_id', $tb_clientes_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A RECEBER POR CLIENTE COM STATUS PAGO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodosPorClientePagos($tb_clientes_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT r.*, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia, c.agencia_dv as agencia_dv,
    c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira, l.nome as nome_cliente, l.cpf as cpf_cliente,
    l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente, l.cep as cep_cliente, e.nome as nome_empresa, e.cnpj as cnpj_empresa,
    e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

    FROM tb_contasreceber as r
    LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
    LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
    LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
    LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id
    WHERE l.id = :tb_clientes_id AND r.status = 'PAGO' AND r.tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_clientes_id', $tb_clientes_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CONTAS A RECEBER POR CLIENTE COM STATUS CANCELADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodosPorClienteCancelados($tb_clientes_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT r.*, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia, c.agencia_dv as agencia_dv,
    c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira, l.nome as nome_cliente, l.cpf as cpf_cliente,
    l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente, l.cep as cep_cliente, e.nome as nome_empresa, e.cnpj as cnpj_empresa,
    e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

    FROM tb_contasreceber as r
    LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
    LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
    LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
    LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id
    WHERE l.id = :tb_clientes_id AND r.status = 'CANCELADO' AND r.tb_empresas_id = :tb_empresas_id";

    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_clientes_id', $tb_clientes_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT r.*, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia, c.agencia_dv as agencia_dv,
    c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira, l.id as tb_clientes_id, l.nome as nome_cliente,
    l.cpf as cpf_cliente, l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente, l.cep as cep_cliente, e.nome as nome_empresa,
    e.cnpj as cnpj_empresa, e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

    FROM tb_contasreceber as r
    LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
    LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
    LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
    LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id
    WHERE r.id = :id AND r.tb_empresas_id = :tb_empresas_id";

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
  //OBTER CONTAS A RECEBER - VARIOS ID'S
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterVarios($ids, $tb_empresas_id) {
    $array = array();

    foreach ($ids as $v) {
      $sql = "SELECT r.*, c.codigo_banco as codigo_banco, c.nome as nome_conta, c.tx_juros as tx_juros, c.tx_multa as tx_multa, c.agencia as agencia,
      c.agencia_dv as agencia_dv, c.conta as conta, c.conta_dv as conta_dv, c.convenio as convenio, c.carteira as carteira, l.nome as nome_cliente,
      l.cpf as cpf_cliente, l.endereco as endereco_cliente, l.cidade as cidade_cliente, l.uf as uf_cliente, l.cep as cep_cliente, e.nome as nome_empresa,
      e.cnpj as cnpj_empresa, e.endereco as endereco_empresa, e.cidade as cidade_empresa, e.uf as uf_empresa

      FROM tb_contasreceber as r
      LEFT JOIN tb_contas as c ON c.id = r.tb_contas_id
      LEFT JOIN tb_contratos as o ON o.id = r.tb_contratos_id
      LEFT JOIN tb_clientes as l ON l.id = o.tb_clientes_id
      LEFT JOIN tb_empresas as e ON e.id = r.tb_empresas_id
      WHERE r.id IN (:id) AND r.tb_empresas_id = :tb_empresas_id";

      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $v, PDO::PARAM_INT);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();


      if ($sql->rowCount() > 0) {
        $array[] = $sql->fetch(PDO::FETCH_ASSOC);
      }
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE TEM FATURAS E RETORNA SIM OU NAO E CASO TENHA RETORNA TAMBEM A DATA DA ULTIMA FATURA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterUltimo($tb_contratos_id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT data_vencimento FROM tb_contasreceber WHERE tb_contratos_id = :tb_contratos_id AND tb_empresas_id = :tb_empresas_id AND status != 'CANCELADO' ORDER BY data_vencimento DESC LIMIT 1";
    $sql = $this->db->prepare($sql);
    $sql->bindValue('tb_empresas_id', $tb_empresas_id);
    $sql->bindValue('tb_contratos_id', $tb_contratos_id);
    $sql->execute();

    if ($sql->rowCount() >0 ) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
      $array = $array + array('cliente_novo' => 'N');
      return $array;
    } else {
      $array = array('cliente_novo' => 'S', 'data_vencimento' => '');
      return $array;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONA CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_contratos_id, $tb_contas_id, $parcelas, $tb_empresas_id) {
    $array = array();

    //PEGA A TAXA DE JUROS E TAXA DE MULTA PELO ID DA CONTA
    $sql = "SELECT tx_juros, tx_multa FROM tb_contas WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $tb_contas_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
      $tx_juros = $array['tx_juros'];
      $tx_multa = $array['tx_multa'];
    }

    foreach ($parcelas as $item) {

      $sql = "INSERT INTO tb_contasreceber SET tb_contratos_id = :tb_contratos_id, tb_contas_id = :tb_contas_id, tx_juros = :tx_juros,
      tx_multa = :tx_multa, data_vencimento = :data_vencimento, valor = :valor, referencia = :referencia, tb_empresas_id = :tb_empresas_id, data_emissao = NOW()";

      $sql = $this->db->prepare($sql);
      $sql->bindValue(':tb_contratos_id', $tb_contratos_id);
      $sql->bindValue(':tb_contas_id', $tb_contas_id);
      $sql->bindValue(':tx_juros', $tx_juros);
      $sql->bindValue(':tx_multa', $tx_multa);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->bindValue(':data_vencimento', $item['vencimento']);
      $sql->bindValue(':valor', $item['valor']);
      $sql->bindValue(':referencia', $item['referencia']);
      $sql->execute();
    }

    $sql = "SELECT tb_clientes_id FROM tb_contratos WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $tb_contratos_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $array['tb_clientes_id'];
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CANCELAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function cancelar($titulos, $tb_empresas_id) {
    //ALTERADO O STATUS DOS TITULOS PARA CANCELADO
    foreach ($titulos as $v) {
      $sql = "UPDATE tb_contasreceber SET status = 'CANCELADO', data_cancelamento = NOW() WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $v, PDO::PARAM_INT);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();

    }

    //RETORNA O ID DO CLIENTE PARA PODER VOLTAR A PAGINA NOS TITULOS DO CLIENTE
    $sql = "SELECT c.tb_clientes_id FROM tb_contratos AS c
    LEFT JOIN tb_contasreceber as r ON r.tb_contratos_id = c.id
    WHERE r.id = :id AND c.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $titulos[0]);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array['tb_clientes_id'];

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DESCANCELAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function descancelar($id, $tb_empresas_id) {
    //ALTERADO O STATUS DOS TITULOS PARA ABERTO
    $sql = "UPDATE tb_contasreceber SET status = 'ABERTO', data_cancelamento = NULL WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //RETORNA O ID DO CLIENTE PARA PODER VOLTAR A PAGINA NOS TITULOS DO CLIENTE
    $sql = "SELECT c.tb_clientes_id FROM tb_contratos AS c
    LEFT JOIN tb_contasreceber as r ON r.tb_contratos_id = c.id
    WHERE r.id = :id AND c.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array['tb_clientes_id'];

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($data_vencimento, $valor, $referencia, $id, $tb_empresas_id){
    $sql = "UPDATE tb_contasreceber SET data_vencimento = :data_vencimento, valor = :valor, referencia = :referencia WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':data_vencimento', $data_vencimento);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':referencia', $referencia);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);

    $sql->execute();
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //BAIXAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function baixar($tb_contasreceber_id, $data, $valor, $saldo, $tb_contas_id, $tb_formaspagamento_id, $tb_empresas_id) {
    $array = array();

    //DEFINE O STATUS DO PAGAMENTO
    $status = ($valor >= $saldo) ? 'PAGO' : 'PARCIAL';

    //INSERE O REGISTRO DA TABELA DE LANCAMENTOS DE CONTAS A RECEBER
    $sql = "INSERT INTO tb_lancamentosreceber SET tb_contasreceber_id = :tb_contasreceber_id, data = :data, valor = :valor, tb_contas_id = :tb_contas_id, tb_formaspagamento_id = :tb_formaspagamento_id, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_contasreceber_id', $tb_contasreceber_id);
    $sql->bindValue(':data', $data);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':tb_contas_id', $tb_contas_id);
    $sql->bindValue(':tb_formaspagamento_id', $tb_formaspagamento_id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //CONSULTA O VALOR TOTAL PAGO ATUALIZADO
    $sqla = "SELECT SUM(valor) AS valor_pago FROM tb_lancamentosreceber
    WHERE tb_contasreceber_id = :tb_contasreceber_id AND tb_empresas_id = :tb_empresas_id";
    $sqla = $this->db->prepare($sqla);
    $sqla->bindValue(':tb_contasreceber_id', $tb_contasreceber_id);
    $sqla->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqla->execute();

    if ($sqla->rowCount() > 0) {
      $array = $sqla->fetch(PDO::FETCH_ASSOC);
      $valor_pago = number_format($array['valor_pago'], 2, '.', '');
    }

    //ATUALIZA A TABELA DE CONTAS A RECEBER COM STATUS E VALOR PAGO ATUALIZADO
    $sqlc = "UPDATE tb_contasreceber SET status = :status, valor_pago = :valor_pago WHERE id = :tb_contasreceber_id AND tb_empresas_id = :tb_empresas_id";
    $sqlc = $this->db->prepare($sqlc);
    $sqlc->bindValue(':status', $status);
    $sqlc->bindValue(':valor_pago', $valor_pago);
    $sqlc->bindValue(':tb_contasreceber_id', $tb_contasreceber_id);
    $sqlc->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sqlc->execute();

    return $tb_contasreceber_id;

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}


?>
