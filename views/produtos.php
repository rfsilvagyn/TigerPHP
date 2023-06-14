<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="form-row">
        <div class="col-8">
          <a class="btn btn-gradient-primary btn-sm" href="<?php echo BASE_URL;?>produtos/adicionar"><i class="mdi mdi-plus-circle-multiple-outline"></i> Novo</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table id="produtos" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Unidade</th>
            <th>Qtn. Mínima</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosProdutos as $produto): ?>
            <tr>
              <td><?php echo $produto['id']; ?></td>
              <td><?php echo $produto['nome']; ?></td>
              <td><?php echo $produto['unidade']; ?></td>
              <td><?php echo $produto['quantidade_minima']; ?></td>
              <td><?php echo $produto['status']; ?></td>
              <td>
                <a class="btn btn-gradient-success btn-sm" href="<?php echo BASE_URL;?>produtos/editar/<?php echo $produto['id']; ?>"><i class="mdi mdi-tooltip-edit"></i> Editar</a>
                <a class="btn btn-gradient-danger btn-sm" href="<?php echo BASE_URL;?>produtos/deletar/<?php echo $produto['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="mdi mdi-delete"></i> Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/produtos.js"></script>
