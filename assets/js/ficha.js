////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//QUANDO CARREAGA O DOCUMENTO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CHAMA FUNCAO GERAR LOGIN
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#cep').on('focusout', function() {
  var nome = $('#nome').val();
  var nome = nome.replace(/[.]+/g, '');

  $.ajax({
    type: 'GET',
    url: BASE_URL + 'assets/ws/geralogin.php?nome=' + nome,
    success: function(nomelogin) {
      $("#login").val(nomelogin);
    }
  })
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DEIXAR COM READONLY MESMO SENDO REQUERIDO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(".readonly").on('keydown paste', function(e) {
  e.preventDefault();
});
