window.onload = function () {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#cpf').inputmask('999.999.999-99');
  $('#cnpj').inputmask('99.999.999/9999-99');
  $('#data_nascimento').inputmask('dd/mm/yyyy');
  $('#cep').inputmask('99999-999');
  $('#uf').inputmask('AA');
  $('#tel_fixo').inputmask('(99)9999-9999');
  $('#tel_celular').inputmask('(99)99999-9999');

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ALTERA CAMPOS DO FORMULARIO QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  var tipoCliente = $('#tipo_fornecedor').val();

  if (tipoCliente == 'PF') { //CASO SEJA PESSOA FISICA
    $('#cnpj').attr('required', false);
    $('#cpf').attr('required', true);
    $('#rg').attr('required', true);
    $('#data_nascimento').attr('required', true);


    $('#label_cpf').attr('hidden', false);
    $('#cpf').attr('hidden', false);
    $('#btn_consulta_cpf').attr('hidden', false);

    $('#label_data_nascimento').attr('hidden', false);
    $('#data_nascimento').attr('hidden', false);

    $('#label_rg').attr('hidden', false);
    $('#rg').attr('hidden', false);

    $('#label_rg_emissor').attr('hidden', false);
    $('#rg_emissor').attr('hidden', false);

    $('#label_pai').attr('hidden', false);
    $('#pai').attr('hidden', false);

    $('#label_mae').attr('hidden', false);
    $('#mae').attr('hidden', false);

    $('#label_nacionalidade').attr('hidden', false);
    $('#nacionalidade').attr('hidden', false);

    $('#label_naturalidade').attr('hidden', false);
    $('#naturalidade').attr('hidden', false);

    $('#label_estado_civil').attr('hidden', false);
    $('#estado_civil').attr('hidden', false);

    $('#label_sexo').attr('hidden', false);
    $('#sexo').attr('hidden', false);

    $('#label_profissao').attr('hidden', false);
    $('#profissao').attr('hidden', false);

    $('#label_cnpj').attr('hidden', true);
    $('#cnpj').attr('hidden', true);
    $('#btn_consulta_cnpj').attr('hidden', true);

    $('#label_fantasia').attr('hidden', true);
    $('#fantasia').attr('hidden', true);

    $('#label_inscricao_estadual').attr('hidden', true);
    $('#inscricao_estadual').attr('hidden', true);

    $('#label_inscricao_municipal').attr('hidden', true);
    $('#inscricao_municipal').attr('hidden', true);

  } else { //CASO SEJA PESSOA JURIDICA
    $('#cnpj').attr('required', true);
    $('#cpf').attr('required', false);
    $('#rg').attr('required', false);
    $('#data_nascimento').attr('required', false);

    $('#label_cpf').attr('hidden', true);
    $('#cpf').attr('hidden', true);
    $('#btn_consulta_cpf').attr('hidden', true);

    $('#label_data_nascimento').attr('hidden', true);
    $('#data_nascimento').attr('hidden', true);

    $('#label_rg').attr('hidden', true);
    $('#rg').attr('hidden', true);

    $('#label_rg_emissor').attr('hidden', true);
    $('#rg_emissor').attr('hidden', true);

    $('#label_pai').attr('hidden', true);
    $('#pai').attr('hidden', true);

    $('#label_mae').attr('hidden', true);
    $('#mae').attr('hidden', true);

    $('#label_nacionalidade').attr('hidden', true);
    $('#nacionalidade').attr('hidden', true);

    $('#label_naturalidade').attr('hidden', true);
    $('#naturalidade').attr('hidden', true);

    $('#label_estado_civil').attr('hidden', true);
    $('#estado_civil').attr('hidden', true);

    $('#label_sexo').attr('hidden', true);
    $('#sexo').attr('hidden', true);

    $('#label_profissao').attr('hidden', true);
    $('#profissao').attr('hidden', true);

    $('#label_cnpj').attr('hidden', false);
    $('#cnpj').attr('hidden', false);
    $('#btn_consulta_cnpj').attr('hidden', false);

    $('#label_fantasia').attr('hidden', false);
    $('#fantasia').attr('hidden', false);

    $('#label_inscricao_estadual').attr('hidden', false);
    $('#inscricao_estadual').attr('hidden', false);

    $('#label_inscricao_municipal').attr('hidden', false);
    $('#inscricao_municipal').attr('hidden', false);
  }

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ALTERACAO DO FORMULARIO PARA PESSOA FISICA/JURIDICA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#tipo_fornecedor").on('change', function(){
  var tipoCliente = $('#tipo_fornecedor').val();

  if (tipoCliente == 'PF') { //CASO SEJA PESSOA FISICA
    $('#cnpj').attr('required', false);
    $('#cpf').attr('required', true);
    $('#rg').attr('required', true);
    $('#data_nascimento').attr('required', true);

    $('#label_cpf').attr('hidden', false);
    $('#cpf').attr('hidden', false);
    $('#btn_consulta_cpf').attr('hidden', false);

    $('#label_data_nascimento').attr('hidden', false);
    $('#data_nascimento').attr('hidden', false);

    $('#label_rg').attr('hidden', false);
    $('#rg').attr('hidden', false);

    $('#label_rg_emissor').attr('hidden', false);
    $('#rg_emissor').attr('hidden', false);

    $('#label_pai').attr('hidden', false);
    $('#pai').attr('hidden', false);

    $('#label_mae').attr('hidden', false);
    $('#mae').attr('hidden', false);

    $('#label_nacionalidade').attr('hidden', false);
    $('#nacionalidade').attr('hidden', false);

    $('#label_naturalidade').attr('hidden', false);
    $('#naturalidade').attr('hidden', false);

    $('#label_estado_civil').attr('hidden', false);
    $('#estado_civil').attr('hidden', false);

    $('#label_sexo').attr('hidden', false);
    $('#sexo').attr('hidden', false);

    $('#label_profissao').attr('hidden', false);
    $('#profissao').attr('hidden', false);

    $('#label_cnpj').attr('hidden', true);
    $('#cnpj').attr('hidden', true);
    $('#btn_consulta_cnpj').attr('hidden', true);
    $('#cnpj').val('');

    $('#label_fantasia').attr('hidden', true);
    $('#fantasia').attr('hidden', true);

    $('#label_inscricao_estadual').attr('hidden', true);
    $('#inscricao_estadual').attr('hidden', true);

    $('#label_inscricao_municipal').attr('hidden', true);
    $('#inscricao_municipal').attr('hidden', true);

    $('#cpf').focus();

  } else { //CASO SEJA PESSOA JURIDICA
    $('#cnpj').attr('required', true);
    $('#cpf').attr('required', false);
    $('#rg').attr('required', false);
    $('#data_nascimento').attr('required', false);

    $('#label_cpf').attr('hidden', true);
    $('#cpf').attr('hidden', true);
    $('#btn_consulta_cpf').attr('hidden', true);
    $('#cpf').val('');

    $('#label_data_nascimento').attr('hidden', true);
    $('#data_nascimento').attr('hidden', true);

    $('#label_rg').attr('hidden', true);
    $('#rg').attr('hidden', true);

    $('#label_rg_emissor').attr('hidden', true);
    $('#rg_emissor').attr('hidden', true);

    $('#label_pai').attr('hidden', true);
    $('#pai').attr('hidden', true);

    $('#label_mae').attr('hidden', true);
    $('#mae').attr('hidden', true);

    $('#label_nacionalidade').attr('hidden', true);
    $('#nacionalidade').attr('hidden', true);

    $('#label_naturalidade').attr('hidden', true);
    $('#naturalidade').attr('hidden', true);

    $('#label_estado_civil').attr('hidden', true);
    $('#estado_civil').attr('hidden', true);

    $('#label_sexo').attr('hidden', true);
    $('#sexo').attr('hidden', true);

    $('#label_profissao').attr('hidden', true);
    $('#profissao').attr('hidden', true);

    $('#label_cnpj').attr('hidden', false);
    $('#cnpj').attr('hidden', false);
    $('#btn_consulta_cnpj').attr('hidden', false);

    $('#label_fantasia').attr('hidden', false);
    $('#fantasia').attr('hidden', false);

    $('#label_inscricao_estadual').attr('hidden', false);
    $('#inscricao_estadual').attr('hidden', false);

    $('#label_inscricao_municipal').attr('hidden', false);
    $('#inscricao_municipal').attr('hidden', false);

    $('#cnpj').focus();
  }
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PREENCHE CAMPOS CONSULTA CEP
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#btn_consulta_cep").on('click', function(){
  var cep = $('#cep').val();
  if (cep != '') {
    $.ajax({
      url:'http://api.postmon.com.br/v1/cep/'+cep,
      type:'GET',
      dataType:'json',
      success:function(json){
        if (typeof json.logradouro != 'undefined') {
          $('#bairro').val(json.bairro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
          $('#cidade').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
          $('#endereco').val(json.logradouro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
          $('#uf').val(json.estado);
          $('#numero').focus();
        } else if (typeof json.logradouro == 'undefined'){
          $('#bairro').val('');
          $('#endereco').val('');
          $('#cidade').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
          $('#uf').val(json.estado);
          $('#bairro').focus();
        }
      }
    })
  }
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PREENCHE CAMPOS CONSULTA CNPJ
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#btn_consulta_cnpj").on('click', function(){
  var cnpj = $('#cnpj').val();
  var cnpj = cnpj.replace(/\D/g, '');

  $.ajax({
    url: BASE_URL+'assets/ws/cnpj.php?cnpj='+cnpj,
    type:'GET',
    dataType:'json',
    success:function(json){
      if (json.status != "ERROR") {
        $("#nome").val(json.nome);
        $("#fantasia").val(json.fantasia);
        $("#tel_fixo").val(json.telefone);
        $("#endereco").val(json.logradouro);
        $("#complemento").val(json.complemento);
        $("#bairro").val(json.bairro);
        $("#cidade").val(json.municipio);
        $("#uf").val(json.uf);
        $("#cep").val(json.cep);
        $("#numero").val(json.numero);
        $('#inscricao_estadual').focus();
      }else {
        $('#nome').focus();
      }
    }
  })
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PREENCHE CAMPOS CONSULTA CPF
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#btn_consulta_cpf").on('click', function(){

  var cpf = $('#cpf').val();
  var cpf = cpf.replace(/\D/g, '');
  var data_nascimento = $('#data_nascimento').val();

  $("#nome").val('BUSCANDO DADOS')
  $("#nome").prop('readonly', true);

  $.ajax({
    url: BASE_URL+'assets/ws/cpf.php?cpf='+cpf+'&data='+data_nascimento,
    type:'GET',
    dataType:'json',
    success:function(json){
      if (json.return != "NOK") {
        $("#nome").val(json.result.nome_da_pf);
        $('#rg').focus();
      }else {
        $("#nome").val('')
        $("#nome").prop('readonly', false);
        $('#nome').focus();
        console.log(json.message);
      }
    }
  })

});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCAO VALIDAR CPF
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validaCPF(strCPF) {
  var Soma;
  var Resto;
  Soma = 0;
  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
  return true;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VALIDAR CPF APOS SAIR DO CAMPO CPF
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#cpf').on('focusout', function(){

  if ($('#cpf').val() != '') {

    var strCPF = $('#cpf').val();
    var strCPF = strCPF.replace(/\D/g, '');

    if (validaCPF(strCPF) == false) {
      swal({
        title: "CPF informado inválido!",
        icon: 'error',
        closeOnConfirm: false
      })
      .then( () => {
        setTimeout(function(){ $('#data_nascimento').focus(); }, 500);
      })
    }
  }


})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VALIDAR DATA DE NASCIMENTO MAIOR DE 18 ANOS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#data_nascimento').on('focusout', function(){

  var dataAtual = moment(new Date(), "DD/MM/YYYY", 'pt');
  var dataNascimento = moment($('#data_nascimento').val(), "DD/MM/YYYY", 'pt');

  var diferenca = moment.duration(dataAtual.diff(dataNascimento));
  var idadeAtual = diferenca.asYears();

  if (idadeAtual < 18) {
    swal({
      title: "Idade inferior a 18 anos!",
      icon: 'error',
      closeOnConfirm: false
    })
    .then( () => {
      $('#btnSalvar').prop('disabled', true);
      setTimeout(function(){ $('#data_nascimento').focus(); }, 500);
    })
  } else {
    //$('#btnSalvar').prop('disabled', false);
  }

})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
