<div class="container">
  <div class="card">
    <h5 class="card-header">Adicionar Produtos</h5>
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
            Nome:
            <input type="text" name="nome" id="nome" class="form-control" required>
            Unidade:
            <input type="text" name="unidade" id="unidade" class="form-control" required>
            Qtn. Mínima:
            <input type="text" name="quantidade_minima" id="quantidade_minima" class="form-control quantidade" value="10" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <hr>
            <button type="submit" id="btnSalvar" class="btn btn-gradient-primary btn-fw"><i class="mdi mdi-content-save-all"></i> Salvar</button>
            <a class="btn btn-gradient-secondary btn-fw" href="<?php echo BASE_URL."produtos"; ?>"><i class="mdi mdi-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addprodutos.js"></script>
