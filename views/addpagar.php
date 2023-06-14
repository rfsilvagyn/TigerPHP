<div class="container">
  <div class="card">
    <h5 class="card-header">Adicionar Contas a Pagar - Parcelas</h5>

    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body" >
      <form method="post">
        <div class="row">
          <div class="col-sm">
            Fornecedor:
            <select name="tb_fornecedores_id" id="tb_fornecedores_id" class="form-control" required>
              <?php foreach($dadosFornecedores as $fornecedor): ?>
                <option value=""></option>
                <option value="<?php echo $fornecedor['id']; ?>"><?php echo $fornecedor['nome']; ?></option>
              <?php endforeach; ?>
            </select>
            Referência:
            <input type="text" name="referencia" id="referencia" class="form-control" required>
            Nota Fiscal:
            <input type="text" name="nota_fiscal" id="nota_fiscal" class="form-control">
            Documento:
            <input type="text" name="documento" id="documento" class="form-control">
            Plano de Contas:
            <select type="text" name="tb_planocontas_id" id="tb_planocontas_id" class="form-control" required>
              <?php foreach($dadosPlanosContas as $planoContas): ?>
                <option value="<?php echo $planoContas['id']; ?>"><?php echo $planoContas['nome']; ?></option>
              <?php endforeach; ?>
            </select>
            Forma de Pagamento:
            <select type="text" name="tb_formaspagamento_id" id="tb_formaspagamento_id" class="form-control" required>
              <?php foreach($dadosFormasPagamento as $formaPagamento): ?>
                <option value="<?php echo $formaPagamento['id']; ?>"><?php echo $formaPagamento['nome']; ?></option>
              <?php endforeach; ?>
            </select>
            <br>
          </div>
          <div class="col-sm">

            Data Lançamento:
            <input type="text" name="data_lancamento" id="data_lancamento" class="form-control" value="<?php echo date('d-m-Y') ?>" required>
            Parcelas:
            <input type="text" id="parcelas" class="form-control quantidade">
            Valor:
            <input type="text" id="valor" class="form-control valor" required>

          </div>
        </div>

        <br>
        <div id="divParcelas" style="display: none;" class="card">
          <div class="card-header">
            Espelho Parcelas
          </div>
          <table class="table table-bordered" id="tabelaParcelas">
            <thead>
              <tr>
                <th scope="col">Documento</th>
                <th scope="col">Vencimento</th>
                <th scope="col">Valor</th>
                <th scope="col">Referência</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              </tr>
            </tbody>
          </table>
        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <button type="button" class="btn btn-warning" id="btnGerar"><i class="fas fa-bolt"></i> Gerar</button>
            <button type="button" disabled class="btn btn-danger" id="btnLimpar"><i class="fas fa-undo-alt"></i> Limpar</button>
            <button type="submit" disabled id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."pagar"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addpagar.js"></script>
