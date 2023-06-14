<div class="container">

  <div class="card">
    <h5 class="card-header">Editar Titulo</h5>
    <div class="card-body">

      <form class="" method="post">

        <div class="row">
          <div class="col-sm-2">
            <label>Contrato:</label>
            <input disabled type="text" id="contrato" class="form-control" value="<?php echo $dadosReceber['tb_contratos_id'];?>">
          </div>
          <div class="col-sm">
            <label>Cliente:</label>
            <input type="hidden" name="tb_clientes_id" id="tb_clientes_id" class="form-control" value="<?php echo $dadosReceber['tb_clientes_id'];?>">
            <input disabled type="text" id="nome_cliente" class="form-control" value="<?php echo $dadosReceber['nome_cliente'];?>">
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <label>Conta:</label>
            <input disabled type="text" id="conta" class="form-control" value="<?php echo $dadosReceber['nome_conta'];?>">
          </div>

          <div class="col-sm-2">
            <label>Status:</label>
            <input disabled type="text" id="status" class="form-control" value="<?php echo $dadosReceber['status'];?>">
          </div>
          <div class="col-sm-1">
            <label>Remessa:</label>
            <input disabled type="text" id="remessa" class="form-control" value="<?php echo $dadosReceber['remessa'];?>">
          </div>
          <div class="col-sm-2">
            <label>Data da Remessa:</label>
            <input disabled type="text" id="data_remessa" class="form-control" value="<?php if ($dadosReceber['data_remessa'] != '') { echo date('d/m/Y', strtotime($dadosReceber['data_remessa'])); } ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-2">
            <label>Data Vencimento:</label>
            <input type="text" name="data_vencimento" id="data_vencimento" class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosReceber['data_vencimento']));?>">
          </div>
          <div class="col-sm-2">
            <label>Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo number_format($dadosReceber['valor'], 2, ',', '.');?>">
          </div>
          <div class="col-sm">
            <label>Referência:</label>
            <input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $dadosReceber['referencia'];?>">
          </div>

        </div>


        <br>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosReceber['tb_clientes_id']."?tabs=financeiro"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/editreceber.js"></script>
