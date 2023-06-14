<div class="container">
  <div class="card">
    <h5 class="card-header">Editar Contas a Pagar</h5>
    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body">
      <form class="" method="post">

        <div class="row">

          <div class="col-sm">
            Fornecedor:
            <select name="tb_fornecedores_id" id="tb_fornecedores_id" class="form-control" required>

              <?php foreach($dadosFornecedores as $fornecedor): ?>
                <option value="<?php echo $fornecedor['id']; ?>" <?php echo ($fornecedor['id'] ==  $dadosPagar['tb_fornecedores_id'] ? 'selected' : '');?>> <?php  echo $fornecedor['nome']; ?> </option>
              <?php endforeach; ?>

            </select>
            Nota Fiscal:
            <input type="text" name="nota_fiscal" id="nota_fiscal" class="form-control" value="<?php echo $dadosPagar['nota_fiscal']; ?>">
            Documento:
            <input type="text" name="documento" id="documento" class="form-control" value="<?php echo $dadosPagar['documento']; ?>">
            Data Lançamento:
            <input type="text" name="data_lancamento" id="data_lancamento" class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosPagar['data_lancamento'])); ?>" required>
            Data Vencimento:
            <input type="text" name="data_vencimento" id="data_vencimento" class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosPagar['data_vencimento'])); ?>" required>
            Valor:
            <input type="text" name="valor" id="valor" class="form-control valor" value="<?php echo $dadosPagar['valor']; ?>"required>
            Acréscimo:
            <input type="text" name="acrescimo" id="acrescimo" class="form-control valor" value="<?php echo $dadosPagar['acrescimo']; ?>">
            Referência:
            <input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $dadosPagar['referencia']; ?>" required>
            Plano de Contas:
            <select type="text" name="tb_planocontas_id" id="tb_planocontas_id" class="form-control" required>
              <?php foreach($dadosPlanosContas as $planoContas): ?>
                <option value="<?php echo $planoContas['id']; ?>" <?php echo ($planoContas['id'] ==  $dadosPagar['tb_planocontas_id'] ? 'selected' : '');?>> <?php  echo $planoContas['nome']; ?> </option>
              <?php endforeach; ?>
            </select>
            Forma de Pagamento:
            <select type="text" name="tb_formaspagamento_id" id="tb_formaspagamento_id" class="form-control" required>
              <?php foreach($dadosFormasPagamento as $formaPagamento): ?>
                <option value="<?php echo $formaPagamento['id']; ?>" <?php echo ($formaPagamento['id'] ==  $dadosPagar['tb_formaspagamento_id'] ? 'selected' : '');?>> <?php  echo $formaPagamento['nome']; ?> </option>
              <?php endforeach; ?>
            </select>

            <br>
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <button type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."pagar"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>

<script> var BASE_URL = '<?php echo BASE_URL; ?>' </script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/editpagar.js"></script>
