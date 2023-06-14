<div class="container">
  <div class="card">

    <h5 class="card-header">Selecione os Titulos para Remessa - Total: <?php if (isset($dadosReceber['quantidade']) && !empty($dadosReceber['quantidade'])): ?>
      <?php echo ($dadosReceber['quantidade']); ?>
    <?php endif; ?>

  </h5>

  <div class="card-body">
    <div class="row">
      <div class="col-sm">

        <?php if (isset($dadosReceber['informacoes']) && !empty($dadosReceber['informacoes'])): ?>

          <table id="tbTitulosRemessa" class="table table-bordered">
            <thead>
              <tr>
                <th style="text-align: center;" width="1">
                  <input type="checkbox" id="marcaTodos">
                </th>
                <th>N. Con</th>
                <th>N. Doc</th>
                <th>Emissão</th>
                <th>Vencimento</th>
                <th>Valor</th>
                <th>Conta</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($dadosReceber['informacoes'] as $receber): ?>
                <tr>
                  <td style="text-align: center;">
                    <input type="checkbox" class="marcaTitulo" value="<?php echo $receber['id']; ?>">
                  </td>
                  <td><?php echo $receber['tb_contratos_id']; ?></td>
                  <td><?php echo $receber['id']; ?></td>
                  <td><?php echo date('d/m/Y', strtotime($receber['data_emissao'])); ?></td>
                  <td><?php echo date('d/m/Y', strtotime($receber['data_vencimento'])); ?></td>
                  <td><?php echo number_format($receber['valor'], 2, ',', '.'); ?></td>
                  <td><?php echo $receber['nome_conta']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>

          </table>

        <?php endif; ?>

      </div>
    </div>

    <br>
    <form id="dados" action="<?php echo BASE_URL ?>receber/geraremessa" method="post">


      <div class="row">
        <div class="col-sm">
          <input type="hidden" name="ids" id="ids">
          <button type="button" id="btnGerarRemessa" class="btn btn-success"><i class="fas fa-bolt"></i> Gerar</button>
          <a class="btn btn-secondary" href="<?php echo BASE_URL."receber/filtroremessa"; ?>"><i class="fas fa-backspace"></i> Voltar</a>
        </div>

      </div>
    </form>
  </div>
</div>
</div>


<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/resultadoremessa.js"></script>
