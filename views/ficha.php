<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/addclientes.css"/>

<div class="container">

  <div class="card">
    <h5 class="card-header">Ficha de Venda</h5>
    <?php if (isset($_GET['resultado']) && !empty($_GET['resultado'])): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $_GET['resultado']?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body">

      <form id="cliente" class="" method="post">

        <div class="row">
          <div class="col-sm">
            <label>Tipo de Cliente:</label>
            <select class="form-control" id="tipo_cliente" name="tipo" required>
              <option value="PF">PESSOA FISICA</option>
              <option value="PJ">PESSOA JURIDICA</option>
            </select>
          </div>
          <div class="col-sm">

            <label id="label_cpf">CPF:</label>

            <div class="input-group sm-2">
              <input type="text" id="cpf" name="cpf" placeholder="" class="form-control">
            </div>

            <label hidden id="label_cnpj">CNPJ:</label>

            <div class="input-group sm-2">
              <input hidden type="text" id="cnpj" name="cnpj" placeholder="" class="form-control">

              <div class="input-group-prepend">
                <button hidden type="button" id="btn_consulta_cnpj" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
              </div>

            </div>

          </div>

          <div class="col-sm">

            <label id="label_data_nascimento">Data de Nascimento:</label>

            <div class="input-group sm-2">
              <input type="text" id="data_nascimento" name="data_nascimento" placeholder="" class="form-control">

              <div class="input-group-prepend">
                <button type="button" id="btn_consulta_cpf" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
              </div>

            </div>

            <label hidden id="label_fantasia">Fantasia:</label>
            <input hidden type="text" id="fantasia" name="fantasia" placeholder="" class="form-control">

          </div>

        </div>

        <div class="row">
          <div class="col-sm">
            <label>Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="" class="form-control readonly" required>
            <input hidden type="text" id="login" name="login" placeholder="" class="form-control" required readonly>
          </div>
        </div>

        <div class="row">


          <div class="col-sm">
            <label id="label_rg">RG:</label>
            <input type="text" id="rg" name="rg" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label id="label_rg_emissor">RG Emissor:</label>
            <input type="text" id="rg_emissor" name="rg_emissor" placeholder="" class="form-control">
          </div>
        </div>




        <div class="row">
          <div class="col-sm">
            <label id="label_pai">Nome do Pai:</label>
            <input type="text" id="pai" name="pai" placeholder="" class="form-control">

            <label hidden id="label_inscricao_estadual">Inscricao Estadual:</label>
            <input hidden type="text" id="inscricao_estadual" name="inscricao_estadual" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label id="label_mae">Nome da Mae:</label>
            <input type="text" id="mae" name="mae" placeholder="" class="form-control">

            <label hidden id="label_inscricao_municipal">Inscricao Municipal:</label>
            <input hidden type="text" id="inscricao_municipal" name="inscricao_municipal" placeholder="" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label id="label_nacionalidade">Nacionalidade:</label>
            <input type="text" id="nacionalidade" name="nacionalidade" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label id="label_naturalidade">Naturalidade:</label>
            <input type="text" id="naturalidade" name="naturalidade" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label id="label_estado_civil">Estado Civil:</label>
            <select class="form-control" id="estado_civil" name="estado_civil">
              <option value="SOLTEIRO">SOLTEIRO</option>
              <option value="CASADO">CASADO</option>
              <option value="DIVORCIADO">DIVORCIADO</option>
              <option value="VIUVO">VIUVO</option>
            </select>
          </div>
        </div>


        <div class="row">
          <div class="col-sm">
            <label id="label_sexo">Sexo:</label>
            <select class="form-control" id="sexo" name="sexo">
              <option value="MASCULINO">MASCULINO</option>
              <option value="FEMININO">FEMININO</option>
            </select>
          </div>

          <div class="col-sm">
            <label id="label_profissao">Profissao:</label>
            <input type="text" id="profissao" name="profissao" placeholder="" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label>CEP:</label>
            <div class="input-group sm-2">
              <input type="text" id="cep" name="cep" value="" class="form-control" required>
              <div class="input-group-prepend">
                <button type="button" id="btn_consulta_cep" class="btn btn-warning"><i class="fab fa-searchengin"></i></button>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <label>Bairro:</label>
            <input type="text" id="bairro" name="bairro" placeholder="" class="form-control" required>
          </div>

          <div class="col-sm">
            <label>Cidade:</label>
            <input type="text" id="cidade" name="cidade" placeholder="" class="form-control" required readonly>
          </div>
        </div>


        <div class="row">
          <div class="col-sm">
            <label>Endereco:</label>
            <input type="text" id="endereco" name="endereco" placeholder="RUA X QD. X LT. X CASA X" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label>UF:</label>
            <input type="text" id="uf" name="uf" placeholder="" class="form-control" maxlength="2" required readonly>
          </div>

          <div class="col-sm">
            <label>Numero:</label>
            <input type="text" id="numero" name="numero" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label>Ponto de Referencia:</label>
            <input type="text" id="ponto_referencia" name="ponto_referencia" placeholder="" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label>Valor Instalação:</label>
            <select class="form-control" id="valor_instalacao" name="valor_instalacao">
              <option value="0">R$ 0,00</option>
              <option value="75">R$ 75,00</option>
              <option value="150">R$ 150,00</option>
            </select>
          </div>

          <div class="col-sm">
            <label>Plano:</label>
            <select class="form-control" id="plano" name="plano">
              <option value="30MB">FIBRA 30MB - R$ 50,00</option>
              <option value="50MB">FIBRA 50MB - R$ 70,00</option>
              <option value="100MB">FIBRA 100MB - R$ 90,00</option>
              <option value="200MB">FIBRA 200MB - R$ 140,00</option>

              <option value="6MB">RADIO 6MB - R$ 59,90</option>
              <option value="8MB">RADIO 8MB - R$ 69,90</option>
              <option value="10MB">RADIO 10MB - R$ 79,90</option>
              <option value="12MB">RADIO 12MB - R$ 89,90</option>
            </select>
          </div>

          <div class="col-sm">
            <label>Vencimento:</label>
            <select class="form-control" id="vencimento" name="vencimento">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="15">20</option>
              <option value="15">25</option>
            </select>
          </div>

          <div class="col-sm">
            <label>Como Soube da Empresa:</label>
            <select class="form-control" id="soube_empresa" name="soube_empresa">
              <option value="FACEBOOK">FACEBOOK</option>
              <option value="INSTAGRAM">INSTAGRAM</option>
              <option value="PANFLETO">PANFLETO</option>
              <option value="RADIO">RADIO</option>
              <option value="VOLANTE">VOLANTE</option>
            </select>
          </div>
        </div>


        <hr>

        <div class="row" id="divcontatos">
          <div class="col-sm">

            <label>Tipo Contato:</label>
            <select class="form-control" id="tipocontato" name="">
              <option value="FIXO">FIXO</option>
              <option value="CELULAR">CELULAR</option>
              <option value="EMAIL">EMAIL</option>
            </select>
          </div>

          <div class="col-sm">
            <label>Contato:</label>
            <input type="text" id="contato" name="" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <br>
            <a id="addtelefone" class="btn btn-outline-warning" style="margin: 7px;"><i class="fas fa-address-card"></i> Adicionar Contato</a><br>
          </div>
        </div>

        <table id="table_telefones" class="table table-striped table-bordered">
          <tr>
            <th>Tipo</th>
            <th>Contato</th>
            <th>Ações</th>
          </tr>
        </table>
        <br>

        <button id="btnSalvar" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>

</div>


<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addclientes.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/ficha.js"></script>
