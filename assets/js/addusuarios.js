$(document).ready( function () {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUADO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#email').inputmask({
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]"
    , greedy: !1
    , onBeforePaste: function (n, a) {
      return (e = e.toLowerCase()).replace("mailto:", "")
    }
    , definitions: {
      "*": {
        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]"
        , cardinality: 1
        , casing: "lower"
      }
    }
  });


} );
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VERIFICA SE A SENHA ESTA IGUAL NOS 2 CAMPOS DE SENHA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#confirmasenha').on('focusout', function(){

  if ($('#senha').val() == $('#confirmasenha').val()) {
    $('#btnSalvar').prop('disabled', false);
  } else {
    swal({
      title: "Senhas diferentes!",
      icon: 'error',
      closeOnConfirm: false
    })
    .then( () => {
      $('#btnSalvar').prop('disabled', true);
      setTimeout(function(){ $('#senha').focus(); }, 500);
    })
  }
});
