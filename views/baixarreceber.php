<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/baixarreceber.css"/>
<div class="container">
  <div class="card">
    <h5 class="card-header">Baixar Contas a Receber</h5>
    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body">
      <form id="formBaixa" class="" method="post">
        <div class="row">

          <div class="col-sm-5">
            <input type="text" name="tb_contasreceber_id" id="id" class="form-control" value="<?php echo $dadosReceber['id']; ?>">

            Data Lançamento:
            <input type="text" name="data" id="data" class="form-control" value="<?php echo date('d-m-yy') ?>" required>

            Valor:
            <input type="text" name="valor" id="valor" class="form-control valor" value="" required>

          </div>

          <div class="col-sm-4">
            Conta:
            <select type="text" name="tb_contas_id" id="tb_contas_id" class="form-control" required>
              <?php foreach($dadosContas as $contas): ?>
                <option value="<?php echo $contas['id']; ?>"><?php echo $contas['nome']; ?></option>
              <?php endforeach; ?>
            </select>

            Forma de Pagamento:
            <select type="text" name="tb_formaspagamento_id" id="tb_formaspagamento_id" class="form-control" required>
              <?php foreach($dadosFormasPagamento as $formasPagamento): ?>
                <option value="<?php echo $formasPagamento['id']; ?>"><?php echo $formasPagamento['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-sm-3" style="text-align: center;">
            Status:
            <input type="text" id="status" class="form-control" value="<?php echo $dadosReceber['status'] ?>" readonly>
            Valor:
            <input type="text" id="valor_titulo" class="form-control valor" value="<?php echo $dadosReceber['valor'] ?>" readonly>
            Valor Juros:
            <input type="text" id="valor_juros" class="form-control valor" value="<?php echo $dadosReceber['valor_juros'] ?>" readonly>
            Valor Multa:
            <input type="text" id="valor_multa" class="form-control valor" value="<?php echo $dadosReceber['valor_multa'] ?>" readonly>
            Valor Total:
            <input type="text" id="valor_total" class="form-control valor" value="<?php echo $dadosReceber['valor_total'] ?>" readonly>
            Valor Pago:
            <input type="text" id="valor_pago" class="form-control valor" value="<?php echo $dadosReceber['valor_pago'] ?>" readonly>
            Saldo:
            <input type="text" id="saldo" class="form-control valor" value="<?php echo $dadosReceber['saldo'] ?>" readonly>
            <input hidden name="saldo" type="text" class="form-control valor" value="<?php echo $dadosReceber['saldo'] ?>">

          </div>

        </div>


        <br>
        <div class="row">
          <div class="col-sm">
            <button type="button" id="btnSalvar" onclick="subFormBaixa()" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."pagar"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>
        </div>
      </form>
      <br>

      <div class="row">
        <div class="col-sm-12">
          <table id="lancamentosreceber" class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Conta</th>
                <th>Forma</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dadosLancamentosReceber as $lancamentosreceber): ?>
                <tr>
                  <td><?php echo $lancamentosreceber['id'] ?></td>
                  <td><?php echo date('d/m/Y', strtotime($lancamentosreceber['data'])) ?></td>
                  <td><?php echo number_format($lancamentosreceber['valor'], 2, ',', '.'); ?> </td>
                  <td><?php echo $lancamentosreceber['nome_contas'] ?></td>
                  <td><?php echo $lancamentosreceber['nome_formaspagamento'] ?></td>
                  <td><a class="btn btn-warning btn-sm" href="<?php echo BASE_URL;?>receber/estornar/<?php echo $lancamentosreceber['id']; ?>"onclick="return confirm('Deseja Estornar?')"><i class="fas fa-undo"></i> Estornar</a> </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- <script> var BASE_URL = '<?php echo BASE_URL; ?>' </script> -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/baixarreceber.js"></script>
