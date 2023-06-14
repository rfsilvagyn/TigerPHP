<div class="container-fluid">
  <div class="card">
    <div class="card-header">

      <div class="form-row">
        <div class="col-8">
          <a class="btn btn-primary" href="<?php echo BASE_URL;?>fornecedores/adicionar"><i class="fas fa-plus-square"></i> Novo</a>
        </div>

        <div class="col-4">
          <?php if (isset($_GET['erro']) && !empty($_GET['erro'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $_GET['erro']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <div class="card-body">
      <table id="fornecedores" class="table table-bordered">
        <thead>
          <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>CNPJ</th>
            <th>Endereço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosFornecedores as $fornecedores): ?>
            <tr>
              <td><?php echo $fornecedores['nome']; ?></td>
              <td><?php echo $fornecedores['cpf']; ?></td>
              <td><?php echo $fornecedores['cnpj']; ?></td>
              <td><?php echo $fornecedores['endereco']; ?></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>fornecedores/editar/<?php echo $fornecedores['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>fornecedores/deletar/<?php echo $fornecedores['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/fornecedores.js"></script>
