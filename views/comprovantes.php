<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SETA COR DO GRID DE CHAMADOS ACORDO COM STATUS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function corStatusChamados($status){
  $label = array(
    'CADASTRADO' => 'table-secondary',
    'ERRO' => 'table-danger',
    'CONFIRMADO' => 'table-success'
  );
  return $label[$status];
}
?>


<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="form-row">
        <div class="col-8">
          <a class="btn btn-gradient-primary btn-sm" href="<?php echo BASE_URL;?>comprovantes/adicionar"><i class="mdi mdi-plus-circle-multiple-outline"></i> Novo</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table id="comprovantes" class="table table-bordered">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Conta</th>
            <th>Data</th>
            <th>Contrato</th>
            <th>Cliente</th>
            <th>Vencimento</th>
            <th>Status</th>
            <th>Usuário</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosComprovantes as $comprovante): ?>
            <tr class="<?php echo corStatusChamados($comprovante['status']);?>">
              <td><?php echo $comprovante['tipo']; ?></td>
              <td><?php echo $comprovante['nome']; ?></td>
              <td><?php echo number_format($comprovante['valor'], 2, ',', '.') ?></td>
              <td><?php echo $comprovante['nome_conta']; ?></td>
              <td><?php echo date ('d/m/Y', strtotime($comprovante['data'])) ?></td>
              <td><?php echo $comprovante['contrato']; ?></td>
              <td><?php echo $comprovante['cliente']; ?></td>
              <td><?php echo date ('d/m/Y', strtotime($comprovante['vencimento'])) ?></td>
              <td><?php echo $comprovante['status']; ?></td>
              <td><?php echo $comprovante['nome_usuario']; ?></td>
              <td>
                <?php if ( $comprovante['status'] != 'CONFIRMADO' ): ?>
                  <a class="btn btn-gradient-success btn-sm" href="<?php echo BASE_URL;?>comprovantes/confirmar/<?php echo $comprovante['id']; ?>"><i class="mdi mdi-check"></i></a>
                  <a class="btn btn-gradient-danger btn-sm" href="<?php echo BASE_URL;?>comprovantes/alerta/<?php echo $comprovante['id']; ?>"><i class="mdi mdi-sync-alert"></i></a>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/comprovantes.js"></script>
