<div class="container">

  <div class="card">
    <h5 class="card-header">Desativar</h5>
    <div class="card-body">

      <form method="post">

        <div class="row">

          <div class="col-sm">
            N. Contrato:
            <input readonly type="text" class="form-control" value="<?php echo $dadosContratos['id']; ?>">
            Nome:
            <input readonly type="text" class="form-control" value="<?php echo $dadosContratos['cliente']; ?>">
          </div>
          <div class="col-sm">
            Data Desativação:
            <input readonly type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>">
            Status:
            <input readonly type="text" class="form-control" name="status" value="INATIVO">
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL;?>clientes/editar/<?php echo $dadosContratos['tb_clientes_id'];?>?tabs=contratos"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>

</div>
