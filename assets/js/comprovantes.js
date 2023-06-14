$(document).ready(function(){

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO DATATABLE LISTAGEM DE COMPROVANTES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#comprovantes').DataTable({
    "ordering": true,
    stateSave: true,
    "order": [[ 3, "asc" ]],
    "scrollX": true,
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
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
