<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SETA COR DO GRID DE ACORDO COM STATUS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function corStatus($status){
  $label = array(
    'ABERTO' => 'table-secondary',
    'PAGO' => 'table-success',
    'PARCIAL' => 'table-primary',
    'VENCIDO' => 'table-danger',
  );
  return $label[$status];
}
?>



<div class="container-fluid">
  <div class="card">
    <div class="card-header">

      <div class="form-row">
        <div class="col-8">
          <a class="btn btn-primary" href="<?php echo BASE_URL;?>pagar/adicionar"><i class="fas fa-plus-square"></i> Novo</a>
        </div>
        <div class="col-4">
          <div class="input-group">
            <div class="input-group sm-2">

            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="card-body">

      <table id="pagar" class="table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Documento</th>
            <th>Nota Fiscal</th>
            <th>Fornecedor</th>
            <th>Referência</th>
            <th>Vencimento</th>
            <th>Valor</th>
            <th>Acréscimo</th>
            <th>Vl. Total</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosPagar as $pagar): ?>
            <tr class="<?php echo corStatus($pagar['status']);?>">
              <td><?php echo $pagar['documento']; ?></td>
              <td><?php echo $pagar['nota_fiscal']; ?></td>
              <td><?php echo $pagar['fornecedor']; ?></td>
              <td><?php echo $pagar['referencia']; ?></td>
              <td><?php echo date('d/m/Y', strtotime($pagar['data_vencimento'])); ?></td>
              <td style="text-align:right;"><?php echo number_format($pagar['valor'], 2, ',', '.'); ?> </td>
              <td style="text-align:right;color:red;"><?php echo number_format($pagar['acrescimo'], 2, ',', '.'); ?> </td>
              <td style="text-align:right;"><?php echo number_format($pagar['valor_total'], 2, ',', '.'); ?> </td>
              <td><?php echo $pagar['status']; ?> </td>
              <td>
                <?php if ($pagar['status'] == 'ABERTO' || $pagar['status'] == 'VENCIDO'): ?>
                  <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>pagar/editar/<?php echo $pagar['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                  <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>pagar/deletar/<?php echo $pagar['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                <?php endif ?>
                <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>pagar/baixar/<?php echo $pagar['id']; ?>"><i class="fas fa-cash-register"></i> Baixar</a>
                <?php if ($pagar['status'] != 'PAGO' ) : ?>

                <?php endif ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="card-footer">

        <div class="form-row">

          <div class="col-2">
            <form method="post" >
              <div class="input-group">
                <button class="btn btn-success" type="submit" name="status" value="PAGO">Pagos</button>
              </div>
            </div>

            <div class="col-3">
              <div class="input-group">
                <button class="btn btn-secondary" type="submit" name="status" value="ABERTO">Abertos</button>
              </div>
            </div>

            <div class="col-2">
              <div class="input-group">
                <button class="btn btn-primary" type="submit" name="status" value="PARCIAL">Parcialmente</button>
              </div>
            </div>

            <div class="col-3">
              <div class="input-group justify-content-md-center">
                <button class="btn btn-danger" type="submit" name="status" value="VENCIDO">Vencidos</button>
              </div>
            </div>

            <div class="col-2">
              <div class="input-group">
                <button class="btn btn-warning" type="submit" name="status" value="">Todos</button>
              </div>
            </div>
          </div>
        </form>


      </div>



    </div>
  </div>
</div>


<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/pagar.js"></script>
