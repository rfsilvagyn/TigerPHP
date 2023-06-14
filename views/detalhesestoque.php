<div class="container-fluid">
  <div class="card">
    <h5 class="card-header">Detalhes Movimentação de Estoque</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-sm">
          <label>ID:</label>
          <input type="text" class="form-control" value="<?php echo $dadosEstoque['tb_movimentacaoestoque']['id'] ?>" disabled>
          <label>Data:</label>
          <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosEstoque['tb_movimentacaoestoque']['data'])) ?>" disabled>
          <label>Tipo:</label>
          <input type="text" class="form-control" value="<?php echo $dadosEstoque['tb_movimentacaoestoque']['tipo'] ?>" disabled>
        </div>
        <div class="col-sm">
          <label>Solicitante:</label>
          <input type="text" class="form-control" value="<?php echo $dadosEstoque['tb_movimentacaoestoque']['solicitante'] ?>" disabled>
          <label>Usuário:</label>
          <input type="text" class="form-control" value="<?php echo $dadosEstoque['tb_movimentacaoestoque']['usuario'] ?>" disabled>
          <label>Armazém:</label>
          <input type="text" class="form-control" value="<?php echo $dadosEstoque['tb_movimentacaoestoque']['armazem'] ?>" disabled>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-sm">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Produto</th>
                <th>Unidade</th>
                <th>Quantidade</th>
                <th>NS</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dadosEstoque['tb_estoque'] as $estoque): ?>
                <tr>
                  <td><?php echo $estoque['produto']; ?></td>
                  <td><?php echo $estoque['unidade']; ?></td>
                  <td><?php echo $estoque['quantidade']; ?></td>
                  <td><?php echo $estoque['ns']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-sm">
          <a class="btn btn-gradient-secondary btn-fw" href="<?php echo BASE_URL."estoque"; ?>"><i class="mdi mdi-backspace"></i> Voltar</a>
        </div>
      </div>
    </div>
  </div>
</div>
