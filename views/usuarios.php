<div class="container">
  <div class="card">
    <div class="card-header">

      <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>usuarios/adicionar"><i class="fas fa-plus-square"></i> Novo</a>

    </div>
    <div class="card-body">
      <table id="usuarios" class="table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Grupo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosUsuarios as $usuario): ?>
            <tr>
              <td><?php echo $usuario['id']; ?></td>
              <td><?php echo $usuario['login']; ?></td>
              <td><?php echo $usuario['nome']; ?></td>
              <td><?php echo $usuario['email']; ?></td>
              <td><?php echo $usuario['grupo']; ?></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>usuarios/editar/<?php echo $usuario['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>usuarios/deletar/<?php echo $usuario['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/usuarios.js"></script>
