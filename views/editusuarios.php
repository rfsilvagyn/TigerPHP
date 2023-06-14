<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/addusuarios.css">

<div class="container">

  <div class="card">
    <h5 class="card-header">Editar</h5>

    <div class="card-body">

      <form method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="col-sm">
            Login:
            <input type="text" name="login" id="login" value="<?php echo $dadosUsuarios['login'];?>" class="form-control" readonly>
            Senha:
            <div class="input-group sm-2">
              <input disabled type="password" name="senha" id="senha" class="form-control">
              <div class="input-group-prepend">
                <button type="button" id="btnAlterarSenha" class="btn btn-warning"><i class="fas fa-key"></i></i></button>
              </div>
            </div>
            Confirma Senha:
            <input disabled type="password" id="confirmasenha" class="form-control">

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
            <input type="text" name="nome" value="<?php echo $dadosUsuarios['nome'];?>" class="form-control">

            E-mail:
            <input type="text" name="email" id="email" value="<?php echo $dadosUsuarios['email'];?>" class="form-control">

            Grupo:
            <select name="grupo" id="grupo" class="form-control">
              <?php foreach($dadosGrupos as $grupo): ?>
                <option value="<?php echo $grupo['id']; ?>" <?php echo ($grupo['id']==$dadosUsuarios['tb_gruposusuarios_id'])?'selected=selected':''; ?>><?php echo $grupo['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <button type="submit" class="btn btn-primary" id="btnSalvar"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."usuarios"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>


<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/editusuarios.js"></script>
