<div class="container">
  <div class="card">
    <div class="card-header">

      <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>planos/adicionar"><i class="fas fa-plus-square"></i> Novo</a>

    </div>
    <div class="card-body">
      <table id="planos" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Download</th>
            <th>Upload</th>
            <th>Valor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosPlanos as $plano): ?>
            <tr>
              <td><?php echo $plano['id']; ?></td>
              <td><?php echo $plano['nome']; ?></td>
              <td><?php echo $plano['download']; ?></td>
              <td><?php echo $plano['upload']; ?></td>
              <td style="text-align:right;"><?php echo number_format($plano['valor'], 2, ',', '.'); ?> </td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>planos/editar/<?php echo $plano['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>planos/deletar/<?php echo $plano['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/planos.js"></script>
