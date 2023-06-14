<div class="container-fluid">
  <div class="card">
    <div class="card-header">

      <div class="form-row">
        <div class="col-8">
          <a class="btn btn-primary" href="<?php echo BASE_URL;?>clientes/adicionar"><i class="fas fa-plus-square"></i> Novo</a>
        </div>

        <div class="col-4">

          <form method="get" >

            <div class="input-group">
              <div class="input-group sm-2">

                <input type="text" class="form-control" name="buscaCliente" value="<?php if(isset($filtro)) { echo $filtro; } ?>">

                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                </div>
              </div>


            </div>

          </div>
        </form>

      </div>

    </div>
    <div class="card-body">

      <table id="clientes" class="table table-bordered" style="width:100%">
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
          <?php foreach ($dadosClientes as $cliente): ?>
            <tr>
              <td><?php echo $cliente['nome']; ?></td>
              <td><?php echo $cliente['cpf']; ?></td>
              <td><?php echo $cliente['cnpj']; ?></td>
              <td><?php echo $cliente['endereco']; ?></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>clientes/editar/<?php echo $cliente['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>clientes/deletar/<?php echo $cliente['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/clientes.js"></script>
