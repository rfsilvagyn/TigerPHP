<div class="container">
  <div class="card">
    <h5 class="card-header">Editar Produtos</h5>
    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body" >
      <form method="post">

        <div class="row">
          <div class="col-sm">
            <input type="text" name="id" id="id" class="form-control" value="<?php echo $dadosProdutos['id'] ?>" hidden>
            Nome:
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $dadosProdutos['nome'] ?>" required>
            Unidade:
            <input type="text" name="unidade" id="unidade" class="form-control" value="<?php echo $dadosProdutos['unidade'] ?>" required>
            Qtn. Mínima:
            <input type="text" name="quantidade_minima" id="quantidade_minima" class="form-control quantidade" value="<?php echo $dadosProdutos['quantidade_minima'] ?>" required>
            Status:
            <select class="form-control" name="status" id="status">
              <option value="ATIVO" <?=($dadosProdutos['status'] == 'ATIVO')?'selected':''?> >ATIVO</option>
              <option value="INATIVO" <?=($dadosProdutos['status'] == 'INATIVO')?'selected':''?> >INATIVO</option>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm">
            <hr>

            <table class="table table-bordered table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Armazem</th>
                  <th>Saldo</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dadosEstoque as $estoque): ?>
                  <tr>
                    <td><?php echo $estoque['tb_produtos_id'] ?></td>
                    <td><?php echo $estoque['nome_armazem'] ?></td>
                    <td><?php echo $estoque['saldo'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>


            <hr>
            <button type="submit" id="btnSalvar" class="btn btn-gradient-primary btn-fw"><i class="mdi mdi-content-save-all"></i> Salvar</button>
            <a class="btn btn-gradient-secondary btn-fw" href="<?php echo BASE_URL."produtos"; ?>"><i class="mdi mdi-backspace"></i> Voltar</a>
          </div>

        </div>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/addprodutos.js"></script>
