<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/addusuarios.css">

<div class="container">
  <div class="card">
    <h5 class="card-header">Adicionar</h5>
    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body">
      <form method="post" enctype="multipart/form-data">

        <div class="row">

          <div class="col-sm">
            Login:
            <input type="text" name="login" id="login" class="form-control" required>
            Senha:
            <input type="password" name="senha" id="senha" class="form-control" required>
            Confima Senha:
            <input type="password" id="confirmasenha" class="form-control" required>

            <div class="form-group">
              Foto:
              <input type="file" name="foto" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Buscar</button>
                </span>
              </div>
            </div>
            
          </div>

          <div class="col-sm">
            Nome:
            <input type="text" name="nome" class="form-control" required>
            E-mail:
            <input type="text" name="email" id="email" class="form-control" required>
            Grupo:
            <select name="grupo" id="grupo" class="form-control" required>
              <?php foreach($dadosGrupos as $grupo): ?>
                <option value="<?php echo $grupo['id']; ?>"><?php echo $grupo['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <button disabled type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."usuarios"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>



<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addusuarios.js"></script>
