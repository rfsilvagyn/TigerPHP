<div class="container">
  <div class="card">
    <h5 class="card-header">Filtro Titulos Remessa</h5>
    <form id="dados" action="<?php echo BASE_URL ?>receber/resultadoremessa" method="post">
      <div class="card-body">
        <div class="row">



          <div class="col-sm">
            Conta:
            <select class="form-control" id="conta" name="conta">
              <?php foreach($dadosContas as $contas): ?>
                <option value="<?php echo $contas['id']; ?>"><?php echo $contas['nome']; ?></option>
              <?php endforeach; ?>
            </select>
            Vencimento Inicial:
            <input type="text" name="vencimento_inicial" id="vencimento_inicial" class="form-control">
          </div>

          <div class="col-sm">
            Status Contrato:
            <select class="form-control" name="status_contrato" id="status_contrato">
              <option value="ATIVO">ATIVO</option>
              <option value="INATIVO">INATIVO</option>
              <option value=""></option>
            </select>
            Vencimento Final:
            <input type="text" name="vencimento_final" id="vencimento_final" class="form-control">
          </div>

        </div>

        <div class="row">
          <div class="col-sm">
            Cliente:
            <input type="text" name="nome_cliente" id="nome_cliente" class="form-control">
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-sm">
            <button type="submit" id="btnBuscar" class="btn btn-success"><i class="fas fa-search"></i> Buscar</button>
          </div>

        </div>

      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/filtroremessa.js"></script>
