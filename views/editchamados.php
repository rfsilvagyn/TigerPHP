<div class="container">

  <div class="card">
    <h5 class="card-header">Editar Chamado | <?php echo $dadosChamados['id'] ?> | <?php echo $dadosChamados['nome_cliente'] ?></h5>
    <div class="card-body">

      <form class="" method="post">

        <input type="hidden" name="id" value="<?php echo $dadosChamados['id'] ?>">
        <input type="hidden" name="tb_clientes_id" value="<?php echo $dadosChamados['tb_clientes_id'] ?>">

        <div class="row">
          <div class="col-sm">
            <label>Tipo:</label>
            <select class="form-control" id="tipo" name="tipo" required>
              <option value="EXTERNO" <?=($dadosChamados['tipo'] == 'EXTERNO')?'selected':''?> >EXTERNO</option>
              <option value="INTERNO" <?=($dadosChamados['tipo'] == 'INTERNO')?'selected':''?> >INTERNO</option>
            </select>

            <label>Prioridade:</label>
            <select class="form-control" id="prioridade" name="prioridade" required>
              <option value="ALTA" <?=($dadosChamados['prioridade'] == 'ALTA')?'selected':''?> >ALTA</option>
              <option value="MEDIA" <?=($dadosChamados['prioridade'] == 'MEDIA')?'selected':''?> >MÉDIA</option>
              <option value="BAIXA" <?=($dadosChamados['prioridade'] == 'BAIXA')?'selected':''?> >BAIXA</option>
            </select>

            <label>Categoria:</label>
            <select class="form-control" id="tb_categorias_chamados_id" name="tb_categorias_chamados_id" required>
              <option value=""></option>
              <?php foreach($dadosCategoria as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>" <?php echo ($categoria['id'] ==  $dadosChamados['tb_categorias_chamados_id'] ? 'selected' : '');?>> <?php  echo $categoria['nome'] ?></option>
              <?php endforeach; ?>
            </select>

            <label>Contrato:</label>
            <input type="text" class="form-control" readonly value="<?php echo $dadosChamados['tb_contratos_id'] ?>">

            <label>Usuário Executor:</label>
            <select class="form-control" id="id_usuario_executor" name="id_usuario_executor" required>
              <?php foreach($dadosUsuarios as $usuarios): ?>
                <option value="<?php echo $usuarios['id']; ?>" <?php echo ($usuarios['id'] ==  $dadosChamados['id_usuario_executor'] ? 'selected' : '');?>> <?php  echo $usuarios['nome'] ?></option>
              <?php endforeach; ?>
            </select>

            <label>Valor Total:</label>
            <input type="text" id="valor_total" name="valor_total" class="form-control" value="<?php echo $dadosChamados['valor_total'] ?>">
          </div>

          <div class="col-sm">
            <label>Data Agendamento:</label>
            <input type="text" id="data_agendamento" name="data_agendamento" class="form-control" value="<?php if ($dadosChamados['data_agendamento'] != '') { echo date('d/m/Y', strtotime($dadosChamados['data_agendamento'])); } ?> ">

            <label>Hora Agendamento:</label>
            <input type="text" id="hora_agendamento" name="hora_agendamento" class="form-control" value="<?php echo $dadosChamados['hora_agendamento'] ?>">

            <label>Data Abertura:</label>
            <input type="text" id="data_abertura" class="form-control" readonly value="<?php echo date('d/m/Y', strtotime($dadosChamados['data_abertura'])) ?>">

            <label>Hora Abertura:</label>
            <input type="text" id="hora_abertura" class="form-control" readonly value="<?php echo $dadosChamados['hora_abertura'] ?>">

            <label>Usuário Abertura:</label>
            <input type="text" class="form-control" readonly value="<?php echo $dadosChamados['usuario_abertura']; ?>">

            <label>Status:</label>
            <input type="text" id="status" class="form-control" readonly value="<?php echo $dadosChamados['status']; ?>">
          </div>

          <div class="col-sm">
            <label>Data Check-In:</label>
            <input type="text" id="data_checkin" class="form-control" readonly value="<?php if ($dadosChamados['data_checkin'] != '') { echo date('d/m/Y', strtotime($dadosChamados['data_checkin'])); } ?> ">

            <label>Hora Check-In:</label>
            <input type="text" id="hora_checkin" class="form-control" readonly value="<?php echo $dadosChamados['hora_checkin'] ?>">

            <label>Data Check-Out:</label>
            <input type="text" id="data_checkout" class="form-control" readonly value="<?php if ($dadosChamados['data_checkout'] != '') { echo date('d/m/Y', strtotime($dadosChamados['data_checkout'])); } ?> ">

            <label>Hora Check-Out:</label>
            <input type="text" id="hora_checkout" class="form-control" readonly value="<?php echo $dadosChamados['hora_checkout'] ?>">

            <?php if ($dadosChamados['latitude_checkin'] && $dadosChamados['longitude_checkin'] != null ): ?>
              <label>Coordenadas:</label>
              <br> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $dadosChamados['latitude_checkin'] ?>,<?php echo $dadosChamados['longitude_checkin'] ?>">Check-In</a>
            <?php endif; ?>
            <?php if ($dadosChamados['latitude_checkout'] && $dadosChamados['longitude_checkout'] != null ): ?>
              <br> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $dadosChamados['latitude_checkout'] ?>,<?php echo $dadosChamados['longitude_checkout'] ?>">Check-Out</a>
            <?php endif; ?>

          </div>
        </div>

        <label>Descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required value="<?php echo $dadosChamados['descricao'] ?>">


        <br>
        <button id="btnSalvar" type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a id="btnVoltar" class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosChamados['tb_clientes_id']."?tabs=chamados"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

        <a id="btnCheckin" class="btn btn-success" href="<?php echo BASE_URL."chamados/checkin/".$dadosChamados['id']; ?>"><i class="fas fa-check"></i> Fazer Check-In</a>
        <a id="btnCheckout" class="btn btn-warning" href="<?php echo BASE_URL."chamados/checkout/".$dadosChamados['id']; ?>"><i class="fas fa-check-double"></i> Fazer Check-Out</a>
      </form>

    </div>
  </div>

</div>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/editchamados.js"></script>
