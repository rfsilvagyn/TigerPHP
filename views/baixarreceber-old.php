<div class="container" style="width:850px">

  <div class="card">
    <h5 class="card-header">Baixar Titulo</h5>
    <div class="card-body">

      <form class="" method="post">

        <div class="row">
          <div class="col-sm-2">
            <label>Contrato:</label>
            <input readonly type="text" name="tb_contratos_id" class="form-control" value="<?php echo $dadosReceber['tb_contratos_id'];?>">
          </div>
          <div class="col-sm-3">
            <label>Conta:</label>
            <input disabled type="text" id="conta" class="form-control" value="<?php echo $dadosReceber['nome_conta'];?>">
            <input hidden type="text" name="tb_contas_id" class="form-control" value="<?php echo $dadosReceber['tb_contas_id'];?>">
          </div>
          <div class="col-sm">
            <label>Cliente:</label>
            <input type="hidden" name="tb_clientes_id" id="tb_clientes_id" class="form-control" value="<?php echo $dadosReceber['tb_clientes_id'];?>">
            <input disabled type="text" id="nome_cliente" class="form-control" value="<?php echo $dadosReceber['nome_cliente'];?>">
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <label>Data Vencimento:</label>
            <input disabled type="text" id="data_vencimento" class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosReceber['data_vencimento']));?>">
          </div>
          <div class="col-sm">
            <label>Valor Original:</label>
            <input disabled type="text" id="valor_original" class="form-control" value="<?php echo number_format($dadosReceber['valor'], 2, ',', '.');?>">
          </div>
          <div class="col-sm">
            <label>Valor Atualizado:</label>
            <input disabled type="text" id="valor_atualizado" class="form-control" value="
            <?php
            $dtVencimento = implode('/', array_reverse(explode('-', $dadosReceber['data_vencimento'])));
            $dtVencimento = str_replace('/', '-', $dtVencimento);
            $dtVencimento = strtotime($dtVencimento);

            $dtAtual = date('d-m-Y');
            $dtAtual = strtotime($dtAtual);

            $diasAtraso = ($dtAtual - $dtVencimento) / 86400;

            $vlAtual = $dadosReceber['valor'];
            $percentualMulta = $dadosReceber['tx_multa'];
            $valorMulta = $vlAtual * $percentualMulta / 100;
            $percentualJuros = $dadosReceber['tx_juros'];

            if ($diasAtraso <= 0) {
              $vlAtualizado = $vlAtual;
            } else {
              $valorJuros = ($vlAtual * $percentualJuros / 100) * $diasAtraso;
              $vlAtualizado = $vlAtual + $valorMulta + $valorJuros;
            }
            echo number_format($vlAtualizado, 2, ',', '.');
            ?>">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <label>Valor Pago:</label>
            <input type="text" id="valor_pago" name="valor_pago" class="form-control" onblur="calculaSaldo();">
            <label>Desconto:</label>
            <input type="text" id="desconto" name="valor_desconto" class="form-control" onblur="calculaSaldo();" style="color: blue">
            <label>Acréscimo:</label>
            <input type="text" id="acrescimo" name="valor_acrescimo" class="form-control" onblur="calculaSaldo();" style="color: red">
            <label>Saldo:</label>
            <input readonly type="text" id="saldo" name="saldo" class="form-control">
          </div>
        </div>

        <br>
        <button disabled type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosReceber['tb_clientes_id']."?tabs=financeiro"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/baixarreceber.js"></script>
