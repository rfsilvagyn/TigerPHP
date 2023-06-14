<div class="container">
  <div class="card">
    <h5 class="card-header">Entrada Estoque</h5>
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
            Data:
            <input readonly type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" required>
            Tipo:
            <input readonly type="text" name="tipo" id="tipo" class="form-control" value="ENTRADA" required>
            Armazém:
            <select name="tb_armazem_id" class="form-control" id="armazem" required>
              <?php foreach($dadosArmazem as $armazem): ?>
                <option value="" hidden>Selecione um Armazém</option>
                <option value="<?php echo $armazem['id']; ?>"><?php echo $armazem['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <br>


        <div class="form-inline">

          <div class="input-group mb-2 mr-sm-2">
            <select class="form-control form-control-lg" id="produto">
              <?php foreach($dadosProdutos as $produtos): ?>
                <option></option>
                <option unidade="<?php echo $produtos['unidade']; ?>" value="<?php echo $produtos['id']; ?>"><?php echo $produtos['nome']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="input-group mb-2 mr-sm-2">
            <input type="text" size="15px" class="form-control form-control-sm quantidade" id="quantidade" placeholder="Quantidade">
          </div>
          <div class="input-group mb-2 mr-sm-2">
            <input type="text" size="15px" class="form-control form-control-sm" id="ns" placeholder="NS">
          </div>
          <button type="button" id="addproduto" class="btn btn-gradient-primary mb-2"><i class="fas fa-plus-circle"></i> Adicionar</button>
        </div>


        <table id="table_produtos" class="table table-striped table-bordered">
          <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Unidade</th>
            <th>NS</th>
            <th>Ações</th>
          </tr>
        </table>

        <br>

        <div class="row">
          <div class="col-sm">
            <button type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>"><i class="fas fa-backspace"></i> Voltar</a>
          </div>
        </div>


      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/entradaestoque.js"></script>
