<div class="container">
  <div class="card">
    <h5 class="card-header">Adicionar Comprovante</h5>
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
            Tipo:
            <select class="form-control" name="tipo" id="tipo" required>
              <option value="PIX">PIX</option>
              <option value="TED">TED</option>
              <option value="TEV">TEV</option>
              <option value="DEPOSITO">DEPOSITO</option>
            </select>
            Data:
            <input type="text" name="data" id="data" class="form-control data" required>
            Hora:
            <input type="text" name="hora" id="hora" class="form-control hora" required>
            Numero:
            <input type="text" name="numero" id="numero" class="form-control" required>
            Banco:
            <select class="form-control" name="tb_contas_id" id="tb_contas_id" required>
              <?php foreach($dadosContas as $conta): ?>
                <option value="<?php echo $conta['id']; ?>"><?php echo $conta['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm">
            Valor:
            <input type="text" name="valor" id="valor" class="form-control valor" required>
            Vencimento:
            <input type="text" name="vencimento" id="vencimento" class="form-control data" required>
            Contrato:
            <input type="text" name="contrato" id="contrato" class="form-control" required>
            Cliente:
            <input type="text" name="cliente" id="cliente" class="form-control" required>
            Nome:
            <input type="text" name="nome" id="nome" class="form-control" required>
            Status:
            <input type="text" name="status" id="status" class="form-control" value="CADASTRADO" readonly>
          </div>
        </div>

        <br>
        <div class="row">
          <div class="col-sm">
            <hr>
            <button type="submit" id="btnSalvar" class="btn btn-gradient-primary btn-fw"><i class="mdi mdi-content-save-all"></i> Salvar</button>
            <a class="btn btn-gradient-secondary btn-fw" href="<?php echo BASE_URL."comprovantes"; ?>"><i class="mdi mdi-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addprodutos.js"></script> -->
