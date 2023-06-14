<div class="container">
  <div class="card">
    <h5 class="card-header">Editar Plano</h5>
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
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $dadosPlanos['id'] ?>" required>
            Nome:
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $dadosPlanos['nome'] ?>" required>
            Valor:
            <input type="text" name="valor" id="valor" class="form-control valor" value="<?php echo $dadosPlanos['valor'] ?>" required>
            Valor Instalação:
            <input type="text" name="valor_instalacao" id="valor_instalacao" class="form-control valor" value="<?php echo $dadosPlanos['valor_instalacao'] ?>">
            Senha Padrão Autenticação:
            <input type="password" name="senha_padrao_autenticacao" class="form-control" value="<?php echo $dadosPlanos['senha_padrao_autenticacao'] ?>">
            Senha Padrão Central:
            <input type="password" name="senha_padrao_central" class="form-control" value="<?php echo $dadosPlanos['senha_padrao_central'] ?>">
          </div>

          <div class="col-sm">
            Download:
            <input type="text" name="download" id="download" class="form-control" value="<?php echo $dadosPlanos['download'] ?>" required>
            Upload:
            <input type="text" name="upload" id="upload" class="form-control" value="<?php echo $dadosPlanos['upload'] ?>" required>
            Burst Ativado:
            <select class="form-control" name="burst" id="burst">
              <option value="NAO" <?=($dadosPlanos['burst'] == 'NAO')?'selected':''?> >NÃO</option>
              <option value="SIM" <?=($dadosPlanos['burst'] == 'SIM')?'selected':''?> >SIM</option>
            </select>
            Burst Download:
            <input type="text" name="burst_download" id="burst_download" class="form-control" value="<?php echo $dadosPlanos['burst_download'] ?>" required disabled>
            Burst Upload:
            <input type="text" name="burst_upload" id="burst_upload" class="form-control" value="<?php echo $dadosPlanos['burst_upload'] ?>" required disabled>
            Prioridade:
            <select class="form-control" name="prioridade" id="prioridade">
              <option value="1" <?=($dadosPlanos['prioridade'] == '1')?'selected':''?> >1</option>
              <option value="2" <?=($dadosPlanos['prioridade'] == '2')?'selected':''?> >2</option>
              <option value="3" <?=($dadosPlanos['prioridade'] == '3')?'selected':''?> >3</option>
              <option value="4" <?=($dadosPlanos['prioridade'] == '4')?'selected':''?> >4</option>
              <option value="5" <?=($dadosPlanos['prioridade'] == '5')?'selected':''?> >5</option>
              <option value="6" <?=($dadosPlanos['prioridade'] == '6')?'selected':''?> >6</option>
              <option value="7" <?=($dadosPlanos['prioridade'] == '7')?'selected':''?> >7</option>
              <option value="8" <?=($dadosPlanos['prioridade'] == '8')?'selected':''?> >8</option>
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
