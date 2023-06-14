$(document).ready(function() {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO BIBLIOTECA MOMENT
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  moment.locale('pt');

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO BIBLIOTECA SELECT2
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#tb_fornecedores_id').select2({
    theme: 'bootstrap4'
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ATIVAR SELECT2 PARA CAMPO FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#tb_fornecedores_id').select2('open');

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#data_lancamento').inputmask('dd/mm/yyyy');
  $('#data_vencimento').inputmask('dd/mm/yyyy');
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

  $('.quantidade').inputmask({
    alias: 'numeric',
    allowMinus: false,
    digits: 0,
    max: 100
  });

});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LIMPA A TABELA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btnLimpar').on('click', function(){
  $("#tabelaParcelas tr").remove();
  $("#divParcelas").hide();

  $("#btnGerar").prop("disabled", false);
  $("#btnSalvar").prop("disabled", true);
  $("#btnLimpar").prop("disabled", true);

});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GERAR PARCELAS
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btnGerar').on('click', function(){

  var documento = $('#documento').val();
  var referencia = $('#referencia').val();
  var dataLancamento = $('#data_lancamento').val();
  var quantidadeParcelas = $('#parcelas').val();
  var valor = $('#valor').val();


  if ( referencia == '' ) {
    swal({
      title: "Referência deve estar preenchido.",
      icon: 'warning',
      closeModal: false,
      timer: 2000
    })
    .then( () => {
      setTimeout(function(){ $('#referencia').focus(); }, 100);
    })
  } else if ( dataLancamento == '' ) {
    swal({
      title: "Data de Lançamento deve estar preenchido.",
      icon: 'warning',
      closeModal: false,
      timer: 2000
    })
    .then( () => {
      setTimeout(function(){ $('#data_lancamento').focus(); }, 100);
    })
  } else if ( quantidadeParcelas == '' ) {
    swal({
      title: "Parcelas deve estar preenchido.",
      icon: 'warning',
      closeModal: false,
      timer: 2000
    })
    .then( () => {
      setTimeout(function(){ $('#parcelas').focus(); }, 100);
    })
  } else if ( valor == '' || valor == '0,00') {
    swal({
      title: "Valor deve estar preenchido.",
      icon: 'warning',
      closeModal: false,
      timer: 2000
    })
    .then( () => {
      setTimeout(function(){ $('#valor').focus(); }, 100);
    })
  } else {

    $('#divParcelas').show();

    for (parcelaInicial = 1; parcelaInicial <= quantidadeParcelas; parcelaInicial++) {
      var dataVencimento = moment(dataLancamento, "DD/MM/YYYY").add(1, 'months').format('L');

      var tr =
      '<tr>'+
      '<td><input size="9" type="text" name="parcelas[documento][]" value="'+documento+'-'+parcelaInicial+'"</td>'+
      '<td><input size="10" class="vencimento" type="text" name="parcelas[vencimento][]" value="'+dataVencimento+'"</td>'+
      '<td><input size="9" class="valor" type="text" name="parcelas[valor][]" value="'+valor+'"</td>'+
      '<td><input type="text" size="50px" name="parcelas[referencia][]" value="'+referencia+'"</td>'+
      '<td><a class="btn btn-danger btn-sm" href="javascript:;" onclick="excluir(this)"><i class="fas fa-trash-alt"></i> Excluir</a></td>'+
      '</tr>';
      $('#tabelaParcelas').append(tr);
      dataLancamento = dataVencimento;

      $('.vencimento').inputmask('dd/mm/yyyy');
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
    }

    //DESATIVA O BOTAO GERAR
    $("#btnGerar").prop("disabled", true);
    //ATIVA BOTAO SALVAR E LIMPAR
    $("#btnSalvar").prop("disabled", false);
    $("#btnLimpar").prop("disabled", false);

  }











});
