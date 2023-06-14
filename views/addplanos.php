<div class="container">
  <div class="card">
    <h5 class="card-header">Adicionar Planos</h5>
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
            Valor:
            <input type="text" name="valor" id="valor" class="form-control valor" required>
            Valor Instalação:
            <input type="text" name="valor_instalacao" id="valor_instalacao" class="form-control valor">
            Senha Padrão Autenticação:
            <input type="password" name="senha_padrao_autenticacao" class="form-control">
            Senha Padrão Central:
            <input type="password" name="senha_padrao_central" class="form-control">
          </div>

          <div class="col-sm">
            Download:
            <input type="text" name="download" id="download" class="form-control" required>
            Upload:
            <input type="text" name="upload" id="upload" class="form-control" required>
            Burst Ativado:
            <select class="form-control" name="burst" id="burst">
              <option value="NAO">NÃO</option>
              <option value="SIM">SIM</option>
            </select>
            Burst Download:
            <input type="text" name="burst_download" id="burst_download" class="form-control" required disabled>
            Burst Upload:
            <input type="text" name="burst_upload" id="burst_upload" class="form-control" required disabled>
            Prioridade:
            <select class="form-control" name="prioridade" id="prioridade">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
            </select>
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <hr>
            <button type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."planos"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>

<script> var BASE_URL = '<?php echo BASE_URL; ?>' </script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addplanos.js"></script>
