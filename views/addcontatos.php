<div class="container">

  <div class="card">
    <h5 class="card-header">Adicionar Contato</h5>
    <div class="card-body">

      <form class="" method="post">

        <label>Tipo Contato:</label>
        <select class="form-control" id="tipocontato" name="tipo">
          <option value="FIXO">FIXO</option>
          <option value="CELULAR">CELULAR</option>
          <option value="EMAIL">EMAIL</option>
        </select>

        <label>Contato:</label>
        <input type="text" id="contato" name="contato" placeholder="" class="form-control">
        <input hidden type="text" name="tb_clientes_id" value="<?php echo $tb_clientes_id ?>"><br>

        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$tb_clientes_id."?tabs=dados"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>

</div>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addclientes.js"></script>
