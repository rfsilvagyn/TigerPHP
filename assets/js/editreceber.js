$(document).ready(function() {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#data_vencimento').inputmask('dd/mm/yyyy');
  $("#valor").inputmask('decimal', {
    'alias': 'numeric',
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false
  });





})
