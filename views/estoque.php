<div class="container-fluid">
  <div class="card">
    <h5 class="card-header">Movimentação de Estoque</h5>
    <div class="card-body">

      <table id="tbEstoque" class="table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Tipo</th>
            <th>Solicitante</th>
            <th>Usuário</th>
            <th>Armazém</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosEstoque as $estoque): ?>
            <tr>
              <td><?php echo $estoque['id']; ?></td>
              <td><?php echo date('d/m/Y', strtotime($estoque['data'])); ?></td>
              <td><?php echo $estoque['tipo']; ?></td>
              <td><?php echo $estoque['solicitante']; ?></td>
              <td><?php echo $estoque['usuario']; ?></td>
              <td><?php echo $estoque['armazem']; ?></td>
              <td>
                <button type="button" class="btn btn-gradient-success btn-sm comprovante" data-id="<?php echo $estoque['id']; ?>"><i class="mdi mdi-printer"></i> Comprovante</a></button>
                <a class="btn btn-gradient-info btn-sm" href="<?php echo BASE_URL;?>estoque/detalhes/<?php echo $estoque['id']; ?>"><i class="mdi mdi-details"></i> Detalhes</a>
                <a class="btn btn-gradient-danger btn-sm" href="<?php echo BASE_URL;?>estoque/estornar/<?php echo $estoque['id']; ?>" onclick="return confirm('Deseja Estornar?')"><i class="mdi mdi-undo-variant"></i> Estornar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/estoque.js"></script>
