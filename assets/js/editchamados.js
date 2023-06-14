$(document).ready( function () {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUADO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#data_abertura').inputmask('dd/mm/yyyy');
  $('#hora_abertura').inputmask('99:99');

  $('#data_checkin').inputmask('dd/mm/yyyy');
  $('#hora_checkin').inputmask('99:99');

  $('#data_checkout').inputmask('dd/mm/yyyy');
  $('#hora_checkout').inputmask('99:99');

  $('#data_agendamento').inputmask('dd/mm/yyyy');
  $('#hora_agendamento').inputmask('99:99');

  $("#valor_total").inputmask('decimal', {
    'alias': 'numeric',
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false
  });
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUADO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  var status = $('#status').val();

  if (status == 'ABERTO') {
    $('#btnCheckout').addClass('disabled')

  } else if (status == 'INICIADO') {
    $('#btnCheckin').addClass('disabled')
    $('#btnCheckout').removeClass('disabled')

  } else {
    $('#btnCheckin').addClass('disabled')
    $('#btnCheckout').addClass('disabled')
    $('#btnSalvar').attr('disabled', true)
    $('.form-control').attr('readonly', true)
  }





});
