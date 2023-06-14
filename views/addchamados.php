<div class="container">

  <div class="card">
    <h5 class="card-header">Adicionar Chamado | <?php echo $dadosClientes['nome'] ?></h5>
    <div class="card-body">

      <form class="" method="post">
        <input type="hidden" name="tb_clientes_id" value="<?php echo $dadosClientes['id']; ?>">
        <input type="hidden" name="id_usuario_abertura" value="<?php echo $nomeUsuario['id']; ?>">


        <div class="row">
          <div class="col-sm">
            <label>Tipo:</label>
            <select class="form-control" id="tipo" name="tipo" required>
              <option value="EXTERNO">EXTERNO</option>
              <option value="INTERNO">INTERNO</option>
            </select>

            <label>Prioridade:</label>
            <select class="form-control" id="prioridade" name="prioridade" required>
              <option value="ALTA">ALTA</option>
              <option value="MEDIA">MÉDIA</option>
              <option value="BAIXA">BAIXA</option>
            </select>

            <label>Categoria:</label>
            <select class="form-control" id="tb_categorias_chamados_id" name="tb_categorias_chamados_id" required>
              <option value=""></option>
              <?php foreach($dadosCategoria as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
              <?php endforeach; ?>
            </select>

            <label>Contrato:</label>
            <select class="form-control" id="tb_contratos_id" name="tb_contratos_id" required>
              <?php foreach($dadosContratos as $contratos): ?>
                <option value="<?php echo $contratos['id']; ?>"><?php echo $contratos['id'] .' - '. $contratos['endereco_instalacao'] ?></option>
              <?php endforeach; ?>
            </select>

            <label>Usuário Executor:</label>
            <select class="form-control" id="id_usuario_executor" name="id_usuario_executor" required>
              <?php foreach($dadosUsuarios as $usuarios): ?>
                <option value="<?php echo $usuarios['id']; ?>"><?php echo $usuarios['nome']?></option>
              <?php endforeach; ?>
            </select>

            <label>Valor Total:</label>
            <input type="text" id="valor_total" name="valor_total" class="form-control">
          </div>

          <div class="col-sm">
            <label>Data Agendamento:</label>
            <input type="text" id="data_agendamento" name="data_agendamento" class="form-control">

            <label>Hora Agendamento:</label>
            <input type="text" id="hora_agendamento" name="hora_agendamento" class="form-control">

            <label>Data Abertura:</label>
            <input type="text" id="data_abertura" name="data_abertura" class="form-control" readonly value="<?php echo date('d/m/Y') ?>">

            <label>Hora Abertura:</label>
            <input type="text" id="hora_abertura" name="hora_abertura" class="form-control" readonly value="<?php echo date('H:i') ?>">

            <label>Usuário Abertura:</label>
            <input type="text" class="form-control" readonly value="<?php echo $nomeUsuario['nome']; ?>">
          </div>

          <div class="col-sm">
            <label>Data Check-In:</label>
            <input type="text" id="data_checkin" name="data_checkin" class="form-control" readonly>

            <label>Hora Check-In:</label>
            <input type="text" id="hora_checkin" name="hora_checkin" class="form-control" readonly>

            <label>Data Check-Out:</label>
            <input type="text" id="data_checkout" name="data_checkout" class="form-control" readonly>

            <label>Hora Check-Out:</label>
            <input type="text" id="hora_checkout" name="hora_checkout" class="form-control" readonly>

          </div>
        </div>

        <label>Descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required>


        <br>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosClientes['id']."?tabs=chamados"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>

</div>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addchamados.js"></script>
