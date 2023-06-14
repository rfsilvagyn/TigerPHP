<div class="container">
  <div class="card">
    <h5 class="card-header">Editar Grupo de Permissões</h5>
    <div class="card-body">
      <form method="post">

        <div class="row">
          <div class="col-sm">
            <label>Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $dadosGrupos['nome']; ?>" required>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm">
            <table id="permissoes" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dadosPermissoes as $permissao): ?>
                  <tr>
                    <td> <input type="checkbox" class="form-check-primary" name="parametros[]" value="<?php echo $permissao['id']; ?>" id="p_<?php echo $permissao['id']; ?>" <?php echo (in_array($permissao['id'], $dadosGrupos['parametros']))?'checked="checked"':''; ?>> </td>
                    <td> <label class="form-check-label" for="p_<?php echo $permissao['id']; ?>"> <?php echo $permissao['nome']; ?>  </label> </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <hr>

        <button type="submit" id="btnSalvar" class="btn btn-gradient-primary btn-fw"><i class="mdi mdi-content-save-all"></i> Salvar</button>
        <a class="btn btn-gradient-secondary btn-fw" href="<?php echo BASE_URL."permissoes"; ?>"><i class="mdi mdi-backspace"></i> Voltar</a>

      </form>
    </div>
  </div>
</div>
