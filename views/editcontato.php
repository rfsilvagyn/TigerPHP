<div class="container">

  <div class="card">
    <h5 class="card-header">Editar Contato</h5>
    <div class="card-body">

      <form class="" method="post">

        <div class="row">
          <div class="col-sm">
            <label>Tipo Contato:</label>
            <select class="form-control" id="tipocontato" name="tipo">
              <option value="FIXO" <?=($dadosContatos['tipo'] == 'FIXO')?'selected':''?> >FIXO</option>
              <option value="CELULAR" <?=($dadosContatos['tipo'] == 'CELULAR')?'selected':''?> >CELULAR</option>
              <option value="EMAIL" <?=($dadosContatos['tipo'] == 'EMAIL')?'selected':''?> >EMAIL</option>
            </select>
          </div>

          <div class="col-sm">
            <label>Contato:</label>
            <input type="text" name="contato" id="contato" class="form-control" value="<?php echo $dadosContatos['contato'];?>">
            <input hidden type="text" name="tb_clientes_id" value="<?php echo $dadosContatos['tb_clientes_id'];?>" readonly>
          </div>
        </div>

        <br>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosContatos['tb_clientes_id']."?tabs=dados"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addclientes.js"></script>
