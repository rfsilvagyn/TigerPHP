<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SETA COR DO GRID DE CHAMADOS ACORDO COM STATUS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function corStatusChamados($status){
  $label = array(
    'ABERTO' => 'table-secondary',
    'FINALIZADO' => 'table-success',
    'INICIADO' => 'table-primary'
  );
  return $label[$status];
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SETA COR DO GRID DE TTULOS DE ACORDO COM STATUS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function corStatusTitulos($status){
  $label = array(
    'ABERTO' => 'table-secondary',
    'VENCIDO' => 'table-danger',
    'PARCIAL' => 'table-primary',
    'PAGO' => 'table-success'
  );
  return $label[$status];
}
?>

<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/addclientes.css"/>

<div class="container-fluid">

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="tabDados" data-toggle="tab" href="#navDados" role="tab" aria-controls="navDados" aria-selected="true">Dados</a>
      <a class="nav-item nav-link" id="tabContratos" data-toggle="tab" href="#navContratos" role="tab" aria-controls="navContratos" aria-selected="false">Contratos</a>
      <a class="nav-item nav-link" id="tabFinanceiro" data-toggle="tab" href="#navFinanceiro" role="tab" aria-controls="navFinanceiro" aria-selected="false">Financeiro</a>
      <a class="nav-item nav-link" id="tabChamados" data-toggle="tab" href="#navChamados" role="tab" aria-controls="navChamados" aria-selected="false">Chamados</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">

    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INICIO TAB DADOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="tab-pane fade show active" id="navDados" role="tabpanel" aria-labelledby="tabDados">

      <div class="card">
        <h6 class="card-header">
          <input hidden type="text" id="idCliente" value="<?php echo $dadosClientes['id']; ?>">
          Contratos: Ativos: 0 | Ativos Vel. Red.: 0 | Inativos: 0 | Suspensos: 0 | Cancelados: 0
        </h6>

        <div class="card-body">

          <form id="cliente" method="post">

            <div class="row">
              <div class="col-sm">
                <label>Tipo de Cliente:</label>
                <select class="form-control" id="tipo_cliente" name="tipo" required>

                  <option value="PF" <?=($dadosClientes['tipo'] == 'PF')?'selected':''?> >PESSOA FISICA</option>
                  <option value="PJ" <?=($dadosClientes['tipo'] == 'PJ')?'selected':''?> >PESSOA JURIDICA</option>

                </select>
              </div>

              <div class="col-sm">
                <label id="label_cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="" class="form-control" value="<?php echo $dadosClientes['cpf'];?>">
                <label hidden id="label_cnpj">CNPJ:</label>
                <div class="input-group sm-2">
                  <input hidden type="text" id="cnpj" name="cnpj" placeholder="" class="form-control" value="<?php echo $dadosClientes['cnpj'];?>">
                  <div class="input-group-prepend">
                    <button hidden type="button" id="btn_consulta_cnpj" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>
              </div>

              <div class="col-sm">
                <label id="label_data_nascimento">Data de Nascimento:</label>
                <div class="input-group sm-2">
                  <input type="text" id="data_nascimento" name="data_nascimento" required class="form-control" value="<?php echo date('d/m/Y', strtotime($dadosClientes['data_nascimento']));?>">
                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cpf" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>
                <label hidden id="label_fantasia">Fantasia:</label>
                <input hidden type="text" id="fantasia" name="fantasia" class="form-control" value="<?php echo $dadosClientes['fantasia'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Nome:</label>
                <input type="text" id="nome" name="nome" required class="form-control" value="<?php echo $dadosClientes['nome'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label id="label_rg">RG:</label>
                <input type="text" id="rg" name="rg" required class="form-control" value="<?php echo $dadosClientes['rg'];?>">
              </div>

              <div class="col-sm">
                <label id="label_rg_emissor">RG Emissor:</label>
                <input type="text" id="rg_emissor" name="rg_emissor" class="form-control" value="<?php echo $dadosClientes['rg_emissor'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label id="label_pai">Nome do Pai:</label>
                <input type="text" id="pai" name="pai" class="form-control" value="<?php echo $dadosClientes['pai'];?>">

                <label hidden id="label_inscricao_estadual">Inscricao Estadual:</label>
                <input hidden type="text" id="inscricao_estadual" name="inscricao_estadual" class="form-control" value="<?php echo $dadosClientes['inscricao_estadual'];?>">
              </div>

              <div class="col-sm">
                <label id="label_mae">Nome da Mae:</label>
                <input type="text" id="mae" name="mae" class="form-control" value="<?php echo $dadosClientes['mae'];?>">

                <label hidden id="label_inscricao_municipal">Inscricao Municipal:</label>
                <input hidden type="text" id="inscricao_municipal" name="inscricao_municipal" class="form-control" value="<?php echo $dadosClientes['inscricao_municipal'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label id="label_nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" value="<?php echo $dadosClientes['nacionalidade'];?>">
              </div>

              <div class="col-sm">
                <label id="label_naturalidade">Naturalidade:</label>
                <input type="text" id="naturalidade" name="naturalidade" class="form-control" value="<?php echo $dadosClientes['naturalidade'];?>">
              </div>

              <div class="col-sm">
                <label id="label_estado_civil">Estado Civil:</label>
                <select class="form-control" id="estado_civil" name="estado_civil">

                  <option value="SOLTEIRO" <?=($dadosClientes['estado_civil'] == 'SOLTEIRO')?'selected':''?> >SOLTEIRO</option>
                  <option value="CASADO" <?=($dadosClientes['estado_civil'] == 'CASADO')?'selected':''?> >CASADO</option>
                  <option value="DIVORCIADO" <?=($dadosClientes['estado_civil'] == 'DIVORCIADO')? 'selected':''?> >DIVORCIADO</option>
                  <option value="VIUVO" <?=($dadosClientes['estado_civil'] == 'VIUVO')?'selected':''?> >VIUVO</option>

                </select>
              </div>
            </div>


            <div class="row">
              <div class="col-sm">
                <label id="label_sexo">Sexo:</label>
                <select class="form-control" id="sexo" name="sexo">

                  <option value="MASCULINO" <?=($dadosClientes['sexo'] == 'MASCULINO')?'selected':''?> >MASCULINO</option>
                  <option value="FEMININO" <?=($dadosClientes['sexo'] == 'FEMININO')?'selected':''?> >FEMININO</option>

                </select>
              </div>

              <div class="col-sm">
                <label id="label_profissao">Profissao:</label>
                <input type="text" id="profissao" name="profissao" class="form-control" value="<?php echo $dadosClientes['profissao'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>CEP:</label>
                <div class="input-group sm-2">
                  <input type="text" id="cep" name="cep" required class="form-control" value="<?php echo $dadosClientes['cep'];?>">
                  <div class="input-group-prepend">
                    <button type="button" id="btn_consulta_cep" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
                  </div>
                </div>
              </div>


              <div class="col-sm">
                <label>Bairro:</label>
                <input type="text" id="bairro" name="bairro" required class="form-control" value="<?php echo $dadosClientes['bairro'];?>">
              </div>

              <div class="col-sm">
                <label>Cidade:</label>
                <input type="text" id="cidade" name="cidade" required class="form-control" value="<?php echo $dadosClientes['cidade'];?>">
              </div>
            </div>


            <div class="row">
              <div class="col-sm">
                <label>Endereco:</label>
                <input type="text" id="endereco" name="endereco" required class="form-control" value="<?php echo $dadosClientes['endereco'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>UF:</label>
                <input type="text" id="uf" name="uf" required class="form-control" maxlength="2" value="<?php echo $dadosClientes['uf'];?>">
              </div>

              <div class="col-sm">
                <label>Numero:</label>
                <input type="text" id="numero" name="numero" class="form-control" value="<?php echo $dadosClientes['numero'];?>">
              </div>

              <div class="col-sm">
                <label>Complemento:</label>
                <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo $dadosClientes['complemento'];?>">
              </div>
            </div>

            <div class="row">
              <div class="col-sm">
                <label>Ponto de Referencia:</label>
                <input type="text" id="ponto_referencia" name="ponto_referencia" class="form-control" value="<?php echo $dadosClientes['ponto_referencia'];?>">
              </div>

              <div class="col-sm">
                <label>Latitude:</label>
                <input type="text" id="latitude" name="latitude" class="form-control" value="<?php echo $dadosClientes['latitude'];?>">
              </div>

              <div class="col-sm">
                <label>Longitude:</label>
                <input type="text" id="longitude" name="longitude" class="form-control" value="<?php echo $dadosClientes['longitude'];?>">
              </div>

              <div class="col-sm">
                <label>Como Soube da Empresa:</label>
                <select class="form-control" id="soube_empresa" name="soube_empresa">

                  <option value="FACEBOOK" <?=($dadosClientes['soube_empresa'] == 'FACEBOOK')?'selected':''?> >FACEBOOK</option>
                  <option value="INSTAGRAM" <?=($dadosClientes['soube_empresa'] == 'INSTAGRAM')?'selected':''?> >INSTAGRAM</option>
                  <option value="PANFLETO" <?=($dadosClientes['soube_empresa'] == 'PANFLETO')?'selected':''?> >PANFLETO</option>
                  <option value="RADIO" <?=($dadosClientes['soube_empresa'] == 'RADIO')?'selected':''?> >RADIO</option>
                  <option value="VOLANTE" <?=($dadosClientes['soube_empresa'] == 'VOLANTE')?'selected':''?> >VOLANTE</option>

                </select>
              </div>
            </div>

            <hr>

            <a id="addcontatos" class="btn btn-outline-warning" href="<?php echo BASE_URL;?>contatos/adicionar/<?php echo $dadosClientes['id'];?>"><i class="fas fa-address-card"></i> Adicionar Contato</a><br><br>

            <table id="table_telefones" class="table table-striped table-bordered">
              <tr>
                <th>Tipo</th>
                <th>Contato</th>
                <th>Ações</th>
              </tr>
              <?php foreach ($dadosContatos as $contatos): ?>
                <tr>
                  <td><?php echo $contatos['tipo'];?></td>
                  <td><?php echo $contatos['contato'];?></td>
                  <td>
                    <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>contatos/editar/<?php echo $contatos['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>contatos/deletar/<?php echo $contatos['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>

            <br>

            <button type="submit" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            <a class="btn btn-secondary" href="<?php echo BASE_URL."clientes/"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

          </form>

        </div>
      </div>

    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INICIO TAB DADOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INICIO TAB CONTRATOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="tab-pane fade" id="navContratos" role="tabpanel" aria-labelledby="tabContratos">
      <div class="card">
        <h6 class="card-header">

          <div class="form-row">
            <div class="col-9">
              <?php echo $dadosClientes['nome'];?> <br>
            </div>

            <div class="col-3">
              <a id="addcontratos" class="btn btn-outline-warning" style="float: right" href="<?php echo BASE_URL;?>contratos/adicionar/<?php echo $dadosClientes['id'];?>"><i class="fas fa-file-contract"></i> Adicionar Contrato</a><br><br>
            </div>
          </div>

        </h6>

        <table id="tabelaContratos" class="table table-bordered tbcontratos" style="width:100%">
          <thead>
            <tr>
              <th>N. Contrato</th>
              <th>Data Cadastro</th>
              <th>Descriçāo</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dadosContratos as $contratos): ?>
              <tr>
                <td><?php echo $contratos['id']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($contratos['data_cadastro'])); ?></td>
                <td>
                  Plano: <?php echo $contratos['plano']; ?> <br>
                  Vencimento: <?php echo $contratos['vencimento']; ?> <br>
                  Login: <?php echo $contratos['login']; ?> <br>
                  Tipo: <?php echo $contratos['tipo_contrato']; ?> <br>
                  MAC: <?php echo $contratos['mac']; ?> <br>
                </td>
                <td><?php echo $contratos['status']; ?></td>
                <td>
                  <?php if ($contratos['status'] == 'INATIVO'): ?>
                    <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>contratos/ativar/<?php echo $contratos['id']; ?>"><i class="fas fa-arrow-alt-circle-up"></i> Ativar</a>
                  <?php endif; ?>
                  <?php if ($contratos['status'] == 'ATIVO'): ?>
                    <a class="btn btn-warning btn-sm" href="<?php echo BASE_URL;?>contratos/desativar/<?php echo $contratos['id']; ?>"><i class="fas fa-arrow-alt-circle-down"></i> Desativar</a>
                  <?php endif; ?>
                  <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>contratos/editar/<?php echo $contratos['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                  <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>contratos/deletar/<?php echo $contratos['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FIM TAB CONTRATOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INICIO TAB FINANCEIRO
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="tab-pane fade" id="navFinanceiro" role="tabpanel" aria-labelledby="tabFinanceiro">

      <div class="card">
        <h6 class="card-header">

          <div class="form-row">

            <div class="col-7">
              <?php echo $dadosClientes['nome'];?> <br>
            </div>

            <div class="col-3">
              <button disabled id="btnAdicionarParcelas" type="button" class="btn btn-outline-warning" onclick="abreAddReceber()" href="javascript:;" style="float: right"><i class="fas fa-file-invoice-dollar"></i> Adicionar Financeiro</button>
            </div>
            <div class="col-2">
              <select class="form-control" id="idContrato">
                <?php foreach($dadosContratosAtivos as $contratosAtivos): ?>
                  <option value="<?php echo $contratosAtivos['id']; ?>"><?php echo $contratosAtivos['login']; ?> - <?php echo $contratosAtivos['id']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </h6>


        <nav>
          <div class="nav nav-tabs" id="tabTitulos" role="tablist">
            <a class="nav-item nav-link active" id="tabTitulosAberto" data-toggle="tab" href="#navTitulosAberto" role="tab" aria-controls="navTitulosAberto" aria-selected="true">Abertos</a>
            <a class="nav-item nav-link" id="tabTitulosPagos" data-toggle="tab" href="#navTitulosPagos" role="tab" aria-controls="navTitulosPagos" aria-selected="false">Pagos</a>
            <a class="nav-item nav-link" id="tabTitulosCancelados" data-toggle="tab" href="#navTitulosCancelados" role="tab" aria-controls="navTitulosCancelados" aria-selected="false">Cancelados</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="navTitulosAberto" role="tabpanel" aria-labelledby="navTitulosAberto">

            <table id="tabelaFinanceiro" class="table table-bordered">
              <thead>
                <tr>
                  <th style="text-align: center;" width="1"> <input type="checkbox" id="marcaTodos"> </th>
                  <th>N. Con</th>
                  <th>N. Doc</th>
                  <th>Emissão</th>
                  <th>Vencimento</th>
                  <th>Valor</th>
                  <th>V. Atualizado</th>
                  <th>D. Atraso</th>
                  <th>Conta</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dadosReceber as $receber): ?>
                  <tr class="<?php echo corStatusTitulos($receber['status']);?>">
                    <td style="text-align: center;">
                      <input type="checkbox" class="marcaTitulo" value="<?php echo $receber['id']; ?>">
                    </td>
                    <td><?php echo $receber['tb_contratos_id']; ?></td>
                    <td><?php echo $receber['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_emissao'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_vencimento'])); ?></td>
                    <td><?php echo number_format($receber['valor'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($receber['valor_total'], 2, ',', '.');?></td>
                    <td><?php echo $receber['dias_atraso']; ?></td>
                    <td><?php echo $receber['nome_conta']; ?></td>
                    <td>
                      <?php if ($receber['remessa'] == ''): ?>
                        <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>receber/editar/<?php echo $receber['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                      <?php endif ?>
                      <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL;?>receber/baixar/<?php echo $receber['id']; ?>"><i class="fas fa-cash-register"></i> Baixar</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <div class="col-sm-12">

              <br>
              <button class="btn btn-warning btn-sm" type="button" id="btnImprimirCarne"><i class="fas fa-print"></i> Carnê</button>
              <button class="btn btn-danger btn-sm" type="button" id="btnCancelar"><i class="fas fa-trash-alt"></i> Cancelar</button>


              <form target="_blank" action="<?php echo BASE_URL ?>receber/carne" method="post" id="dados">
                <input hidden type="text" id="ids" name="ids">
              </form>

              <form target="_self" action="<?php echo BASE_URL ?>receber/cancelar" method="post" id="dadosCancelar">
                <input hidden type="text" id="idsCancelar" name="ids">
              </form>

              <hr>
            </div>

          </div>
          <div class="tab-pane fade" id="navTitulosPagos" role="tabpanel" aria-labelledby="navTitulosPagos">


            <table id="tbTitulosPagos" class="table table-bordered">
              <thead>
                <tr>
                  <th>N. Con</th>
                  <th>N. Doc</th>
                  <th>Emissão</th>
                  <th>Vencimento</th>
                  <th>Pagamento</th>
                  <th>Valor</th>
                  <th>Valor Pago</th>
                  <th>Desconto</th>
                  <th>Conta</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dadosReceberPagos as $receber): ?>
                  <tr>
                    <td><?php echo $receber['tb_contratos_id']; ?></td>
                    <td><?php echo $receber['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_emissao'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_vencimento'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_pagamento'])); ?></td>
                    <td><?php echo number_format($receber['valor'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($receber['valor_pago'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($receber['valor_desconto'], 2, ',', '.'); ?></td>
                    <td><?php echo $receber['nome_conta']; ?></td>
                    <td>
                      <?php if ($receber['status'] == 'PAGO'): ?>
                        <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>receber/estornar/<?php echo $receber['id']; ?>"><i class="fas fa-history"></i> Estornar</a>
                        <a class="btn btn-warning btn-sm" href="<?php echo BASE_URL;?>receber/recibo/<?php echo $receber['id']; ?>"><i class="fas fa-receipt"></i> Recibo</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>



          </div>
          <div class="tab-pane fade" id="navTitulosCancelados" role="tabpanel" aria-labelledby="navTitulosCancelados">

            <table id="tbTitulosCancelados" class="table table-bordered">
              <thead>
                <tr>
                  <th>N. Con</th>
                  <th>N. Doc</th>
                  <th>Emissão</th>
                  <th>Vencimento</th>
                  <th>Cancelamento</th>
                  <th>Valor</th>
                  <th>Conta</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dadosReceberCancelados as $receber): ?>
                  <tr>
                    <td><?php echo $receber['tb_contratos_id']; ?></td>
                    <td><?php echo $receber['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_emissao'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_vencimento'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($receber['data_cancelamento'])); ?></td>
                    <td><?php echo number_format($receber['valor'], 2, ',', '.'); ?></td>
                    <td><?php echo $receber['nome_conta']; ?></td>
                    <td>
                      <?php if ($receber['status'] == 'CANCELADO'): ?>
                        <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>receber/descancelar/<?php echo $receber['id']; ?>"><i class="fas fa-pen-square"></i> Descancelar</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FIM TAB FINANCEIRO
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INICIO TAB CHAMADOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="tab-pane fade" id="navChamados" role="tabpanel" aria-labelledby="tabChamados">
      <div class="card">
        <h6 class="card-header">

          <div class="form-row">
            <div class="col-9">
              <?php echo $dadosClientes['nome'];?> <br>
            </div>

            <div class="col-3">
              <a id="addchamados" class="btn btn-outline-warning" style="float: right" href="<?php echo BASE_URL;?>chamados/adicionar/<?php echo $dadosClientes['id'];?>"><i class="fas fa-clipboard-check"></i> Adicionar Chamado</a><br><br>
            </div>
          </div>

        </h6>

        <table id="tabelaChamados" class="table table-bordered tbcontratos" style="width:100%">
          <thead>
            <tr>
              <th>Ch</th>
              <th>Co</th>
              <th>Categoria</th>
              <th>Descrição</th>
              <th>Abertura</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
              <th>Executor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dadosChamados as $chamados): ?>
              <tr class="<?php echo corStatusChamados($chamados['status']);?>">
                <td><?php echo $chamados['id'] ?></td>
                <td><?php echo $chamados['tb_contratos_id'] ?></td>
                <td><?php echo $chamados['categoria'] ?></td>
                <td><?php echo $chamados['descricao'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($chamados['data_abertura'])) ?></td>
                <td><?php if ($chamados['data_checkin'] != '') { echo date('d/m/Y', strtotime($chamados['data_checkin'])); } ?></td>
                <td><?php if ($chamados['data_checkout'] != '') { echo date('d/m/Y', strtotime($chamados['data_checkout'])); } ?></td>
                <td><?php echo $chamados['status'] ?></td>
                <td><?php echo $chamados['usuario'] ?></td>
                <td>
                  <a class="btn btn-success btn-sm" href="<?php echo BASE_URL;?>chamados/editar/<?php echo $chamados['id']; ?>"><i class="fas fa-pen-square"></i> Editar</a>
                  <a class="btn btn-warning btn-sm" href="<?php echo BASE_URL;?>chamados/imprimir/<?php echo $chamados['id']; ?>"><i class="fas fa-print"></i> Imprimir</a>

                  <?php if ($chamados['status'] == 'ABERTO' OR $chamados['status'] == 'INICIADO'): ?>
                    <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL;?>chamados/deletar/<?php echo $chamados['id']; ?>"onclick="return confirm('Deseja Excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                  <?php endif; ?>

                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FIM TAB CHAMADOS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  </div>
</div>

<?php
if(!empty($_GET['tabs'])){
  switch ($_GET['tabs']) {
    case 'dados':
    echo "<script>$('#tabDados').tab('show')</script>";
    break;

    case 'contratos':
    echo "<script>$('#tabContratos').tab('show')</script>";
    break;

    case 'financeiro':
    echo "<script>$('#tabFinanceiro').tab('show')</script>";
    break;

    case 'chamados':
    echo "<script>$('#tabChamados').tab('show')</script>";
    break;

    default:
    echo "<script>$('#tabDados').tab('show')</script>";
    break;
  }
}
?>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addclientes.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addreceber.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/geracarne.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/cancontasreceber.js"></script>
