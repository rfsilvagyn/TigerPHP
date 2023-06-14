

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CONFIGURACAO DATATABLE LISTAGEM DE CONTRATOS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready( function () {
  $('#tbTitulosRemessa').DataTable({
    "bPaginate": false,
    "bInfo": false,
    "bFilter": false,
    "bLengthChange": false,
    //"iDisplayLength": 50,
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
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VERIFICA TITULOS SELECIONADOS E CHAMA GERACAO DA REMESSA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btnGerarRemessa').on('click', function(){
  var ids = [];
  var titulos = document.querySelectorAll('.marcaTitulo:checked');

  for(var i = 0; i < titulos.length; i++){
    ids.push(titulos[i].value);
  }

  $('#ids').val(ids);
  $( "#dados" ).submit();

})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MARCA / DESMARCA TODOS OS TITULOS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#marcaTodos').on('click', function(){
  $('.marcaTitulo').each(
    function() {
      if ($(this).prop("checked")) {
        $(this).prop("checked", false);
      } else {
        $(this).prop("checked", true);
      }
    })

  })
