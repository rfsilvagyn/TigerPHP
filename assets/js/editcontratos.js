$(document).ready(function() {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARAS NA ABERTURA DA PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#ip').inputmask("ip");
  $('#mac').inputmask("mac");
  $('#cep_cobranca').inputmask('99999-999');
  $('#uf_cobranca').inputmask('AA');
  $('#cep_instalacao').inputmask('99999-999');
  $('#uf_instalacao').inputmask('AA');
  $('#login').focus();

})

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//REPETE O ENDERECO DE COBRANCA NO ENDERECO DE INSTALACAO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btn_endereco_instalacao').on('click', function() {
  $('#cep_instalacao').val($('#cep_cobranca').val());
  $('#bairro_instalacao').val($('#bairro_cobranca').val());
  $('#cidade_instalacao').val($('#cidade_cobranca').val());
  $('#endereco_instalacao').val($('#endereco_cobranca').val());
  $('#uf_instalacao').val($('#uf_cobranca').val());
  $('#numero_instalacao').val($('#numero_cobranca').val());
  $('#complemento_instalacao').val($('#complemento_cobranca').val());
  $('#ponto_referencia_instalacao').val($('#ponto_referencia_cobranca').val());
})

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//REPETE O ENDERECO DE INSTALACAO NO ENDERECO DE COBRANCA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btn_endereco_cobranca').on('click', function() {
  $('#cep_cobranca').val($('#cep_instalacao').val());
  $('#bairro_cobranca').val($('#bairro_instalacao').val());
  $('#cidade_cobranca').val($('#cidade_instalacao').val());
  $('#endereco_cobranca').val($('#endereco_instalacao').val());
  $('#uf_cobranca').val($('#uf_instalacao').val());
  $('#numero_cobranca').val($('#numero_instalacao').val());
  $('#complemento_cobranca').val($('#complemento_instalacao').val());
  $('#ponto_referencia_cobranca').val($('#ponto_referencia_instalacao').val());
})

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CONSULTA CEP ENDERECO DE COBRANCA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#btn_consulta_cep_cobranca").on('click', function(){
  var cep_cobranca = $('#cep_cobranca').val();

  $('#bairro_cobranca').val('');
  $('#cidade_cobranca').val('');
  $('#endereco_cobranca').val('');
  $('#uf_cobranca').val('');
  $('#numero_cobranca').val('');
  $('#complemento_cobranca').val('');
  $('#ponto_referencia_cobranca').val('');

  $.ajax({
    url:'http://api.postmon.com.br/v1/cep/'+cep_cobranca,
    type:'GET',
    dataType:'json',
    success:function(json){
      if (typeof json.logradouro != 'undefined') {
        $('#bairro_cobranca').val(json.bairro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#cidade_cobranca').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#endereco_cobranca').val(json.logradouro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#uf_cobranca').val(json.estado);
        $('#numero_cobranca').focus();
      } else if (typeof json.logradouro == 'undefined'){
        $('#cidade_cobranca').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#uf_cobranca').val(json.estado);
        $('#bairro_cobranca').focus();
      }
    }
  })
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CONSULTA CEP ENDERECO DE INSTALACAO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#btn_consulta_cep_instalacao").on('click', function(){
  var cep_instalacao = $('#cep_instalacao').val();

  $('#bairro_instalacao').val('');
  $('#cidade_instalacao').val('');
  $('#endereco_instalacao').val('');
  $('#uf_instalacao').val('');
  $('#numero_instalacao').val('');
  $('#complemento_instalacao').val('');
  $('#ponto_referencia_instalacao').val('');

  $.ajax({
    url:'http://api.postmon.com.br/v1/cep/'+cep_instalacao,
    type:'GET',
    dataType:'json',
    success:function(json){
      if (typeof json.logradouro != 'undefined') {
        $('#bairro_instalacao').val(json.bairro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#cidade_instalacao').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#endereco_instalacao').val(json.logradouro.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#uf_instalacao').val(json.estado);
        $('#numero_instalacao').focus();
      } else if (typeof json.logradouro == 'undefined'){
        $('#cidade_instalacao').val(json.cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""));
        $('#uf_instalacao').val(json.estado);
        $('#bairro_instalacao').focus();
      }
    }
  })
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CHAMA FUNCAO EXISTE LOGIN - ADICIONAR REGISTRO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function comparaLogin(id){
  var loginAtual = $('#login').val();

  $.ajax({
    url: BASE_URL+"contratos/comparaLogin/"+id,
    type: 'POST',
    data: id,
    dataType: 'json',
    success: function(loginAnteior) {

      if (loginAnteior != loginAtual) {

        $.ajax({
          url: BASE_URL+"contratos/existeLogin/"+loginAtual,
          type: 'POST',
          data: loginAtual,
          dataType: 'json',
          success: function(data) {

            if (data == true) {
              swal({
                title: "Login já existe!",
                icon: 'error',
                closeOnConfirm: false
              })
              .then( () => {
                setTimeout(function(){ $('#senha_autenticacao').focus(); }, 500);
                $('#login').css('border', '1px solid red');
                $('#login').css('color', 'red');
                $('#btnSalvar').prop('disabled', true);
              })
            } else {
              $('#login').css('border', '1px solid #ced4da');
              $('#login').css('color', 'black');
              $('#btnSalvar').prop('disabled', false);
            }
          }
        });


      }
    }
  });
};
