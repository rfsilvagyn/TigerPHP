<?php
$qtdMeses = 12;
$hoje = new DateTime();
$hoje->modify('first day of this month');
?>
<form method="post">
  <div class="container">

    <div class="card">
      <h6 class="card-header">Adicionar Contas a Receber</h6>
      <div class="card-body">

        <div class="card">
          <div class="card-header">
            <?php echo $dadosContrato['cliente']; ?>
          </div>
          <div class="card-body">


            <div class="row">
              <div class="col-sm">
                <label>Data Ativação:</label>
                <input disabled type="text" id="data_ativacao" value="<?php echo date('d/m/Y', strtotime($dadosContrato['data_ativacao'])); ?>" class="form-control">
              </div>
              <div class="col-sm">
                <label>Vencimento:</label>
                <input disabled type="text" id="vencimento" value="<?php echo $dadosContrato['vencimento']; ?>" class="form-control">
              </div>
              <div class="col-sm">
                <label>Valor:</label>
                <input disabled type="text" id="valor" value="<?php echo number_format($dadosContrato['valor'], 2, ',', '.'); ?>" class="form-control">
              </div>
              <div class="col-sm">
                <label>N. Contrato:</label>
                <input readonly type="text" id="contrato" name="tb_contratos_id" value="<?php echo $dadosContrato['id']; ?>" class="form-control">
                <input hidden type="text" id="conta" name="tb_contas_id" value="<?php echo $dadosContrato['tb_contas_id']; ?>" class="form-control">
                <input hidden type="text" id="conta" name="tb_clientes_id" value="<?php echo $dadosContrato['tb_clientes_id']; ?>" class="form-control">
                <input hidden type="text" id="cliente_novo" value="<?php echo $dadosReceberUltimo['cliente_novo']; ?>" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label id="lb_primeira">Primeira:</label>
                <select id="primeira" class="form-control">
                  <?php for ($i = 0; $i < $qtdMeses; $i++) : ?>
                    <option value="<?php echo $hoje->format('m/Y'); ?>"><?php echo $hoje->format('m/Y'); ?></option>
                    <?php $hoje->modify('+1 month');
                  endfor; ?>
                </select>
                <label hidden id="lb_ultima_fatura">Ultima Fatura:</label>
                <input hidden readonly type="text" id="ultima_fatura" value="<?php echo date('d/m/Y', strtotime($dadosReceberUltimo['data_vencimento'])); ?>" class="form-control">
              </div>
              <div class="col-sm">
                <label>Parcelas:</label>
                <input type="text" id="parcelas" value="12" class="form-control">
              </div>
              <div class="col-sm">
                <label>Conta:</label>
                <input readonly type="text" id="conta" value="<?php echo $dadosContrato['conta'] ?>" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <br>

        <div id="divParcelas" style="display: none;" class="card">
          <div class="card-header">
            Espelho Parcelas
          </div>
          <table class="table table-bordered table-hover" id="tabelaParcelas">
            <thead>
              <tr>
                <th scope="col">Vencimento</th>
                <th scope="col">Valor</th>
                <th scope="col">Referência</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              </tr>
            </tbody>
          </table>
        </div>

        <br>

        <button type="button" class="btn btn-warning" id="btnGerar"><i class="fas fa-bolt"></i> Gerar</button>
        <button type="button" disabled class="btn btn-danger" id="btnLimpar"><i class="fas fa-undo-alt"></i> Limpar</button>

        <button type="submit" disabled class="btn btn-primary" id="btnSalvar"><i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL ?>clientes/editar/<?php echo $dadosContrato['tb_clientes_id']?>?tabs=financeiro"><i class="fas fa-backspace"></i> Voltar</a>

      </div>
    </div>

  </div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addreceber.js"></script>
