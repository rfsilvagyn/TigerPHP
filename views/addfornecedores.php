<div class="container">

  <div class="card">
    <h5 class="card-header">Adicionar Fornecedor</h5>
    <?php if (isset($erro) && !empty($erro)): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <?php echo $erro; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <div class="card-body">

      <form method="post">

        <div class="row">
          <div class="col-sm">
            <label>Tipo de Fornecedor:</label>
            <select class="form-control" id="tipo_fornecedor" name="tipo" required>
              <option value="PJ">PESSOA JURIDICA</option>
              <option value="PF">PESSOA FISICA</option>
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
            <input type="text" id="nome" name="nome" placeholder="" class="form-control" required>
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
            <input type="text" id="cidade" name="cidade" placeholder="" class="form-control" required>
          </div>
        </div>


        <div class="row">
          <div class="col-sm">
            <label>Endereco:</label>
            <input type="text" id="endereco" name="endereco" placeholder="" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label>UF:</label>
            <input type="text" id="uf" name="uf" placeholder="" class="form-control" maxlength="2" required>
          </div>

          <div class="col-sm">
            <label>Numero:</label>
            <input type="text" id="numero" name="numero" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label>Complemento:</label>
            <input type="text" id="complemento" name="complemento" placeholder="" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <label>Ponto de Referencia:</label>
            <input type="text" id="ponto_referencia" name="ponto_referencia" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label>Telefone Fixo:</label>
            <input type="text" id="tel_fixo" name="tel_fixo" placeholder="" class="form-control">
          </div>

          <div class="col-sm">
            <label>Telefone Celular:</label>
            <input type="text" id="tel_celular" name="tel_celular" placeholder="" class="form-control">
          </div>

        </div>

        <hr>

        <button id="btnSalvar" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
        <a class="btn btn-secondary" href="<?php echo BASE_URL."fornecedores"; ?>"><i class="fas fa-backspace"></i> Voltar</a>

      </form>

    </div>
  </div>

</div>


<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/addfornecedores.js"></script>
