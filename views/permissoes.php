<div class="container">
  <div class="card">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

      <li class="nav-item">
        <a class="nav-link active" id="tabGrupos" data-toggle="tab" href="#divgrupos" role="tab" aria-controls="grupos" aria-selected="false">Grupos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="tabPermissoes" data-toggle="tab" href="#divpermissoes" role="tab" aria-controls="permissoes" aria-selected="false">Permissões</a>
      </li>

    </ul>

    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active" id="divgrupos" role="tabpanel" aria-labelledby="tabGrupos">

        <div class="card-header">
          <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>grupospermissoes/adicionar"><i class="fas fa-plus-square"></i> Novo</a>
        </div>
        <div class="card-body">
          <table id="grupos" class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dadosGrupos as $grupos): ?>
                <tr>
                  <td><?php echo $grupos['id']; ?></td>
                  <td><?php echo $grupos['nome']; ?></td>
                  <td width="160">
                    <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>grupospermissoes/editar/<?php echo $grupos['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>grupospermissoes/deletar/<?php echo $grupos['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>

      <div class="tab-pane fade" id="divpermissoes" role="tabpanel" aria-labelledby="tabPermissoes">

        <div class="card-header">
          <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>permissoes/adicionar"><i class="fas fa-plus-square"></i> Novo</a>
        </div>
        <div class="card-body">
          <table id="permissoes" class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dadosPermissoes as $permissao): ?>
                <tr>
                  <td><?php echo $permissao['id']; ?></td>
                  <td><?php echo $permissao['nome']; ?></td>
                  <td width="100">
                    <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>permissoes/deletar/<?php echo $permissao['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <?php
  if(!empty($_GET['tabs'])){
    switch ($_GET['tabs']) {
      case 'grupos':
      echo "<script>$('#tabGrupos').tab('show')</script>";
      break;

      case 'permissoes':
      echo "<script>$('#tabPermissoes').tab('show')</script>";
      break;

      default:
      echo "<script>$('#tabGrupos').tab('show')</script>";
      break;
    }
  }
  ?>


  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/permissoes.js"></script>
