////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CONFIGURACAO DATATABLE LISTAGEM DE LANCAMENTOS CONTAS A PAGAR
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready( function () {
  $('#lancamentospagar').DataTable({
    "paging": false,
    "ordering": false,
    "info": false,
    "bFilter": true,
    "language": {
      "lengthMenu": "Mostrar _MENU_ Registros por página",
      "zeroRecords": "Nenhum registro encontrado",
      "info": "Página _PAGE_ de _PAGES_",
      "infoEmpty": "Nenhum registro disponível",
      "infoFiltered": "(Filtrado do total de _MAX_ registros)",
      "sSearch": "Pesquisar:",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });

  $('#data').inputmask('dd/mm/yyyy');
  $(".valor").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    'placeholder': ''
  });


  $('#valor').focus();

});



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VALIDA SE VALOR PAGO NAO E MAIOR QUE O SALDO E ENVIA FORMULARIO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function subFormBaixa() {
  var valor = parseFloat($("#valor").val().replace(/\./g,'').replace(',', '.'));
  var saldo = parseFloat($("#saldo").val().replace(/\./g,'').replace(',', '.'));

  if ( valor > saldo ) {
    swal({
      title: "Valor do pagamento não pode ser maior que o saldo do título.",
      icon: 'error',
      closeModal: false
    })
    .then( () => {
      setTimeout(function(){ $('#valor').focus(); }, 100);
    })
  } else if ( valor == '' || valor == '0,00') {
    swal({
      title: "Valor do pagamento não pode ser zero.",
      icon: 'warning',
      closeModal: false,
      timer: 2000
    })
    .then( () => {
      setTimeout(function(){ $('#valor').focus(); }, 100);
    })
  } else {
    $('#formBaixa').submit();
  }

};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
