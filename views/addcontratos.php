<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/addcontratos.css"/>

<div class="container">

  <div class="card">
    <h6 class="card-header">Adicionar Contrato | <?php echo $dadosClientes['nome']; ?> </h6>
    <div class="card-body">

      <form id="cliente" class="" method="post">

        <input hidden type="text" id="tb_clientes_id" name="tb_clientes_id" value="<?php echo $tb_clientes_id ?>" class="form-control">
        <input hidden type="text" id="nome_cliente" value="<?php echo $dadosClientes['nome']; ?>" class="form-control">

        <div class="card">
          <div class="card-header">
            Dados Acesso
          </div>
          <div class="card-body">


            <div class="row">
              <div class="col-sm">
                <label>Login:</label>
                <input onblur="existeLogin(login.value);" type="text" id="login" name="login" class="form-control" required>
              </div>
              <div class="col-sm">
                <label>NAS:</label>
                <select class="form-control" id="tb_nas_id" name="tb_nas_id" required>
                  <?php foreach($dadosNas as $nas): ?>
                    <option value="<?php echo $nas['id']; ?>"><?php echo $nas['nome']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Plano de Acesso:</label>
                <select class="form-control" id="tb_planos_id" name="tb_planos_id" onchange="obterSenhas(tb_planos_id.value);" required>
                  <option value=""></option>
                  <?php foreach($dadosPlanos as $planos): ?>
                    <option value="<?php echo $planos['id']; ?>"><?php echo $planos['nome']; ?> - R$ <?php echo $planos['valor']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Autenticação:</label>
                <select class="form-control" id="tipo_autenticacao" name="tipo_autenticacao" required>
                  <option value="PPPOE">PPPOE</option>
                  <option value="DHCP">DHCP</option>
                </select>
              </div>
              <div class="col-sm">
                <label>MAC Automático:</label>
                <select class="form-control" id="auto_mac" name="auto_mac" required>
                  <option value="ATIVADO">ATIVADO</option>
                  <option value="DESATIVADO">DESATIVADO</option>
                </select>
              </div>
              <div class="col-sm">
                <label>IP Fixo:</label>
                <input type="text" id="ip" name="ip" class="form-control">
              </div>
              <div class="col-sm">
                <label>MAC:</label>
                <input type="text" id="mac" name="mac" class="form-control">
              </div>
              <div class="col-sm">
                <label>Login Simultâneo:</label>
                <input type="number" id="login_simultaneo" name="login_simultaneo" value="1" maxlength="3" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>POP:</label>
                <select class="form-control" id="tb_pops_id" name="tb_pops_id" required>
                  <?php foreach($dadosPops as $pops): ?>
                    <option value="<?php echo $pops['id']; ?>"><?php echo $pops['nome']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Senha Autenticação:</label>
                <input type="text" id="senha_autenticacao" name="senha_autenticacao" class="form-control" required>
              </div>
              <div class="col-sm">
                <label>Senha Central:</label>
                <input type="text" id="senha_central" name="senha_central" class="form-control" required>
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
                    <option value="<?php echo $contas['id']; ?>"><?php echo $contas['nome']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Vencimento:</label>
                <select class="form-control" id="tb_vencimentos_id" name="tb_vencimentos_id" required>
                  <?php foreach($dadosVencimentos as $vencimentos): ?>
                    <option value="<?php echo $vencimentos['id']; ?>"><?php echo $vencimentos['nome']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm">
                <label>Vendedor:</label>
                <select class="form-control" id="tb_vendedores_id" name="tb_vendedores_id" required>
                  <?php foreach($dadosVendedores as $vendedores): ?>
                    <option value="<?php echo $vendedores['id']; ?>"><?php echo $vendedores['nome']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Tipo de Contrato:</label>
                <select class="form-control" id="tipo_contrato" name="tipo_contrato" required>
                  <option value="COMODATO">COMODATO</option>
                  <option value="PROPRIO">PRÓPRIO</option>
                </select>
              </div>
              <div class="col-sm">
                <label>Data Cadastro:</label>
                <input type="text" id="data_cadastro" value="<?php echo date('d/m/Y'); ?>" readonly class="form-control">
              </div>
              <div class="col-sm">
                <label>Status:</label>
                <input type="text" id="status" placeholder="INATIVO" readonly class="form-control">
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

                  <input type="text" id="cep_cobranca" name="cep_cobranca" value="<?php echo $dadosClientes['cep']; ?>" class="form-control" required>

                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cep_cobranca" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>
              </div>

              <div class="col-sm">
                <label>Bairro Cobrança:</label>
                <input type="text" id="bairro_cobranca" name="bairro_cobranca" value="<?php echo $dadosClientes['bairro']; ?>" class="form-control" required>
              </div>

              <div class="col-sm">
                <label>Cidade Cobrança:</label>
                <input type="text" id="cidade_cobranca" name="cidade_cobranca" value="<?php echo $dadosClientes['cidade']; ?>" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Endereco Cobrança:</label>
                <input type="text" id="endereco_cobranca" name="endereco_cobranca" value="<?php echo $dadosClientes['endereco']; ?>" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>UF Cobrança:</label>
                <input type="text" id="uf_cobranca" name="uf_cobranca" value="<?php echo $dadosClientes['uf']; ?>" class="form-control uf" maxlength="2" required>
              </div>

              <div class="col-sm">
                <label>Numero Cobrança:</label>
                <input type="text" id="numero_cobranca" name="numero_cobranca" value="<?php echo $dadosClientes['numero']; ?>" class="form-control">
              </div>

              <div class="col-sm">
                <label>Complemento Cobrança:</label>
                <input type="text" id="complemento_cobranca" name="complemento_cobranca" value="<?php echo $dadosClientes['complemento']; ?>" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Ponto de Referencia Cobrança:</label>
                <div class="input-group sm-2">
                  <input type="text" id="ponto_referencia_cobranca" name="ponto_referencia_cobranca" value="<?php echo $dadosClientes['ponto_referencia']; ?>" class="form-control">
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
                  <input type="text" id="cep_instalacao" name="cep_instalacao" class="form-control" required>
                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cep_instalacao" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>



              </div>

              <div class="col-sm">
                <label>Bairro Instalação:</label>
                <input type="text" id="bairro_instalacao" name="bairro_instalacao" class="form-control" required>
              </div>

              <div class="col-sm">
                <label>Cidade Instalação:</label>
                <input type="text" id="cidade_instalacao" name="cidade_instalacao" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Endereco Instalação:</label>
                <input type="text" id="endereco_instalacao" name="endereco_instalacao" class="form-control" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>UF Instalação:</label>
                <input type="text" id="uf_instalacao" name="uf_instalacao" class="form-control uf" maxlength="2" required>
              </div>

              <div class="col-sm">
                <label>Numero Instalação:</label>
                <input type="text" id="numero_instalacao" name="numero_instalacao" class="form-control">
              </div>

              <div class="col-sm">
                <label>Complemento Instalação:</label>
                <input type="text" id="complemento_instalacao" name="complemento_instalacao" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Ponto de Referencia Instalação:</label>
                <div class="input-group sm-2">
                  <input type="text" id="ponto_referencia_instalacao" name="ponto_referencia_instalacao" class="form-control">
                  <div class="input-group-prepend">
                    <button type="button" id="btn_endereco_cobranca" class="btn btn-warning"><i class="fas fa-arrow-circle-up"></i></button>
                  </div>
                </div>

              </div>
            </div>


          </div>
        </div>

        <br>

        <button id="btnSalvar" type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/editar/".$dadosClientes['id']."?tabs=contratos"; ?>"><i class="fas fa-backspace"></i> Voltar</a>



      </form>

    </div>
  </div>

</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addcontratos.js"></script>
