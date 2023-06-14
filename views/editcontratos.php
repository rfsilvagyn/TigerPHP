<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/addcontratos.css"/>

<div class="container">

  <div class="card">
    <h6 class="card-header">Editar Contrato | Número: <?php echo $dadosContratos['id']; ?> | Cliente: <?php echo $dadosContratos['cliente']; ?></h6>
    <div class="card-body">

      <form id="cliente" class="" method="post">

        <div class="card">
          <div class="card-header">
            Dados Acesso
          </div>
          <div class="card-body">


            <div class="row">
              <div class="col-sm">
                <label>Login:</label>
                <input type="hidden" id="contrato_id" value="<?php echo $dadosContratos['id']; ?>">
                <input type="text" id="login" onblur="comparaLogin(contrato_id.value);" name="login" class="form-control" value="<?php echo $dadosContratos['login']; ?>" required>
              </div>
              <div class="col-sm">
                <label>NAS:</label>
                <select class="form-control" id="tb_nas_id" name="tb_nas_id" required>
                  <?php foreach($dadosNas as $nas): ?>
                    <option value="<?php echo $nas['id']; ?>" <?php echo ($nas['id'] ==  $dadosContratos['tb_nas_id'] ? 'selected' : '');?>> <?php  echo $nas['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Plano de Acesso:</label>
                <select class="form-control" id="tb_planos_id" name="tb_planos_id" required>
                  <?php foreach($dadosPlanos as $planos): ?>
                    <option value="<?php echo $planos['id']; ?>" <?php echo ($planos['id'] ==  $dadosContratos['tb_planos_id'] ? 'selected' : '');?>> <?php  echo $planos['nome']; ?> - R$ <?php echo $planos['valor']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm">
                <label>Tipo de Autenticação:</label>
                <select class="form-control" id="tipo_autenticacao" name="tipo_autenticacao" required>
                  <option value="PPPOE" <?=($dadosContratos['tipo_autenticacao'] == 'PPPOE')?'selected':''?> >PPPOE</option>
                  <option value="DHCP" <?=($dadosContratos['tipo_autenticacao'] == 'DHCP')?'selected':''?> >DHCP</option>
                </select>
              </div>
              <div class="col-sm">
                <label>MAC Automático:</label>
                <select class="form-control" id="auto_mac" name="auto_mac" required>
                  <option value="ATIVADO" <?=($dadosContratos['auto_mac'] == 'ATIVADO')?'selected':''?> >ATIVADO</option>
                  <option value="DESATIVADO" <?=($dadosContratos['auto_mac'] == 'DESATIVADO')?'selected':''?> >DESATIVADO</option>
                </select>
              </div>
              <div class="col-sm">
                <label>IP Fixo:</label>
                <input type="text" id="ip" name="ip" class="form-control" value="<?php echo $dadosContratos['ip']; ?>">
              </div>
              <div class="col-sm">
                <label>MAC:</label>
                <input type="text" id="mac" name="mac" class="form-control" value="<?php echo $dadosContratos['mac']; ?>">
              </div>
              <div class="col-sm">
                <label>Login Simultâneo:</label>
                <input type="number" id="login_simultaneo" name="login_simultaneo" maxlength="3" class="form-control" value="<?php echo $dadosContratos['login_simultaneo']; ?>" required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm">
                <label>POP:</label>
                <select class="form-control" id="tb_pops_id" name="tb_pops_id" required>
                  <?php foreach($dadosPops as $pops): ?>
                    <option value="<?php echo $pops['id']; ?>" <?php echo ($pops['id'] ==  $dadosContratos['tb_pops_id'] ? 'selected' : '');?>> <?php  echo $pops['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Senha Autenticação:</label>
                <input type="text" id="senha_autenticacao" name="senha_autenticacao" class="form-control" value="<?php echo $dadosContratos['senha_autenticacao']; ?>" required>
              </div>
              <div class="col-sm">
                <label>Senha Central:</label>
                <input type="text" id="senha_central" name="senha_central" class="form-control" value="<?php echo $dadosContratos['senha_central']; ?>" required>
              </div>
            </div>

          </div>
        </div>

        <br>

        <div class="card">
          <div class="card-header">
            Dados Financeiro
          </div>
          <div class="card-body">



            <div class="row">
              <div class="col-sm">
                <label>Conta:</label>
                <select class="form-control" id="tb_contas_id" name="tb_contas_id" required>
                  <?php foreach($dadosContas as $contas): ?>
                    <option value="<?php echo $contas['id']; ?>" <?php echo ($contas['id'] ==  $dadosContratos['tb_contas_id'] ? 'selected' : '');?>> <?php  echo $contas['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Vencimento:</label>
                <select class="form-control" id="tb_vencimentos_id" name="tb_vencimentos_id" required>
                  <?php foreach($dadosVencimentos as $vencimentos): ?>
                    <option value="<?php echo $vencimentos['id']; ?>" <?php echo ($vencimentos['id'] ==  $dadosContratos['tb_vencimentos_id'] ? 'selected' : '');?>> <?php  echo $vencimentos['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Vendedor:</label>
                <select class="form-control" id="tb_vendedores_id" name="tb_vendedores_id" required>
                  <?php foreach($dadosVendedores as $vendedores): ?>
                    <option value="<?php echo $vendedores['id']; ?>" <?php echo ($vendedores['id'] ==  $dadosContratos['tb_vendedores_id'] ? 'selected' : '');?>> <?php  echo $vendedores['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Tipo de Contrato:</label>
                <select class="form-control" id="tipo_contrato" name="tipo_contrato" required>
                  <option value="COMODATO" <?=($dadosContratos['tipo_contrato'] == 'COMODATO')?'selected':''?> >COMODATO</option>
                  <option value="PROPRIO" <?=($dadosContratos['tipo_contrato'] == 'PROPRIO')?'selected':''?> >PRÓPRIO</option>
                </select>
              </div>
              <div class="col-sm">
                <label>Data Cadastro:</label>
                <input type="text" id="data_cadastro" value="<?php echo date('d/m/Y', strtotime($dadosContratos['data_cadastro'])) ?>" readonly class="form-control">
              </div>
              <div class="col-sm">
                <label>Status:</label>
                <input type="text" id="status" readonly class="form-control" value="<?php echo $dadosContratos['status'] ?>">
              </div>
            </div>

          </div>
        </div>

        <br>

        <div class="card">
          <div class="card-header">
            Endereco de Cobrança
          </div>
          <div class="card-body">

            <div class="row">

              <div class="col-sm">
                <label>CEP Cobrança:</label>
                <div class="input-group sm-2">

                  <input type="text" id="cep_cobranca" name="cep_cobranca" value="<?php echo $dadosContratos['cep_cobranca']; ?>" class="form-control" required>

                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cep_cobranca" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>
              </div>

              <div class="col-sm">
                <label>Bairro Cobrança:</label>
                <input type="text" id="bairro_cobranca" name="bairro_cobranca" value="<?php echo $dadosContratos['bairro_cobranca']; ?>" class="form-control" required>
              </div>

              <div class="col-sm">
                <label>Cidade Cobrança:</label>
                <input type="text" id="cidade_cobranca" name="cidade_cobranca" value="<?php echo $dadosContratos['cidade_cobranca']; ?>" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Endereco Cobrança:</label>
                <input type="text" id="endereco_cobranca" name="endereco_cobranca" value="<?php echo $dadosContratos['endereco_cobranca']; ?>" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>UF Cobrança:</label>
                <input type="text" id="uf_cobranca" name="uf_cobranca" value="<?php echo $dadosContratos['uf_cobranca']; ?>" class="form-control" maxlength="2" required>
              </div>

              <div class="col-sm">
                <label>Numero Cobrança:</label>
                <input type="text" id="numero_cobranca" name="numero_cobranca" value="<?php echo $dadosContratos['numero_cobranca']; ?>" class="form-control">
              </div>

              <div class="col-sm">
                <label>Complemento Cobrança:</label>
                <input type="text" id="complemento_cobranca" name="complemento_cobranca" value="<?php echo $dadosContratos['complemento_cobranca']; ?>" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Ponto de Referencia Cobrança:</label>
                <div class="input-group sm-2">
                  <input type="text" id="ponto_referencia_cobranca" name="ponto_referencia_cobranca" value="<?php echo $dadosContratos['ponto_referencia_cobranca']; ?>" class="form-control">
                  <div class="input-group-prepend">
                    <button type="button" id="btn_endereco_instalacao" class="btn btn-warning"><i class="fas fa-arrow-circle-down"></i></button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <br>

        <div class="card">
          <div class="card-header">
            Endereco de Instalação
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-sm">
                <label>CEP Instalação:</label>
                <div class="input-group sm-2">
                  <input type="text" id="cep_instalacao" name="cep_instalacao" class="form-control" value="<?php echo $dadosContratos['cep_instalacao'] ?>" required>
                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cep_instalacao" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>



              </div>

              <div class="col-sm">
                <label>Bairro Instalação:</label>
                <input type="text" id="bairro_instalacao" name="bairro_instalacao" class="form-control" value="<?php echo $dadosContratos['bairro_instalacao'] ?>" required>
              </div>

              <div class="col-sm">
                <label>Cidade Instalação:</label>
                <input type="text" id="cidade_instalacao" name="cidade_instalacao" class="form-control" value="<?php echo $dadosContratos['cidade_instalacao']; ?>" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Endereco Instalação:</label>
                <input type="text" id="endereco_instalacao" name="endereco_instalacao" class="form-control" value="<?php echo $dadosContratos['endereco_instalacao'] ?>" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>UF Instalação:</label>
                <input type="text" id="uf_instalacao" name="uf_instalacao" class="form-control" maxlength="2" value="<?php echo $dadosContratos['uf_instalacao'] ?>" required>
              </div>

              <div class="col-sm">
                <label>Numero Instalação:</label>
                <input type="text" id="numero_instalacao" name="numero_instalacao" class="form-control" value="<?php echo $dadosContratos['numero_instalacao'] ?>">
              </div>

              <div class="col-sm">
                <label>Complemento Instalação:</label>
                <input type="text" id="complemento_instalacao" name="complemento_instalacao" class="form-control" value="<?php echo $dadosContratos['complemento_instalacao'] ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Ponto de Referencia Instalação:</label>
                <div class="input-group sm-2">
                  <input type="text" id="ponto_referencia_instalacao" name="ponto_referencia_instalacao" class="form-control" value="<?php echo $dadosContratos['ponto_referencia_instalacao']; ?>">
                  <div class="input-group-prepend">
                    <button type="button" id="btn_endereco_cobranca" class="btn btn-warning"><i class="fas fa-arrow-circle-up"></i></button>
                  </div>
                </div>

              </div>
            </div>


          </div>
        </div>

        <br>


        <button id="btnSalvar" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>

        <a class="btn btn-light" href="<?php echo BASE_URL."clientes/editar/".$dadosContratos['tb_clientes_id']."?tabs=contratos"; ?>"><i class="fas fa-backspace"></i> Voltar</a>



      </form>

    </div>
  </div>

</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/editcontratos.js"></script>
