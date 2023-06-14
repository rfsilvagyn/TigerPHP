$(document).ready(function() {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $(".valor").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    //'prefix': 'R$ ',
    'placeholder': ''
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE OPCAO BURST ESTA ATIVO OU NAO NA ABERTURA DA PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  var burst = $('#burst').val();
  if (burst == 'SIM') {
    $('#burst_download').attr('disabled', false)
    $('#burst_upload').attr('disabled', false)
  } else {
    $('#burst_download').attr('disabled', true)
    $('#burst_upload').attr('disabled', true)
  }

});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VERIFICA SE OPCAO BURST ESTA ATIVO CASO ESTEJA ATIVO HABILITAR OS CAMPOS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#burst').on('change', function(){
  var burst = $('#burst').val();

  if (burst == 'SIM') {
    $('#burst_download').attr('disabled', false)
    $('#burst_upload').attr('disabled', false)
    $('#burst_download').focus();
  } else {
    $('#burst_download').attr('disabled', true)
    $('#burst_upload').attr('disabled', true)
    $('#prioridade').focus();
  }


})
