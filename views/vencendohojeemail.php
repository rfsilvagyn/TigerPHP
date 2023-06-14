<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/components/bootstrap/css/bootstrap.min.css"/>
  <meta charset="utf-8">
  <title>Contas a Pagar</title>
</head>
<body>
  <div class="container-fluid">



    <br>

    <h3> Contas a Pagar - Hoje </h3>
    <table class="table-sm table-bordered" style="width:100%" border="1">
      <thead>
        <tr class="table-success">
          <th>Documento</th>
          <th>Fornecedor</th>
          <th>Vencimento</th>
          <th>Saldo</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dadosPagarHoje as $pagar): ?>
          <tr style="text-align: center;">
            <td style="text-align:left;"><?php echo $pagar['documento']; ?></td>
            <td style="text-align:left;"><?php echo $pagar['fornecedor']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($pagar['data_vencimento'])); ?></td>
            <td style="text-align:right;"><?php echo number_format($pagar['saldo'], 2, ',', '.'); ?> </td>
            <td><?php echo $pagar['status']; ?> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <br>

    <?php if (isset($dadosPagarVencidos) && !empty($dadosPagarVencidos)): ?>

      <h3> Contas a Pagar - Vencidas </h3>
      <table class="table-sm table-bordered" style="width:100%" border="1">
        <thead>
          <tr class="table-danger">
            <th>Documento</th>
            <th>Fornecedor</th>
            <th>Vencimento</th>
            <th>Saldo</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dadosPagarVencidos as $pagar): ?>
            <tr style="text-align: center;">
              <td style="text-align:left;"><?php echo $pagar['documento']; ?></td>
              <td style="text-align:left;"><?php echo $pagar['fornecedor']; ?></td>
              <td><?php echo date('d/m/Y', strtotime($pagar['data_vencimento'])); ?></td>
              <td style="text-align:right;"><?php echo number_format($pagar['saldo'], 2, ',', '.'); ?> </td>
              <td><?php echo $pagar['status']; ?> </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


    <?php endif; ?>









  </div>
</body>
</html>
