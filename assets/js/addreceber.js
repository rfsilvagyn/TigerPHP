$(document).ready(function() {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO DATATABLE LISTAGEM DE TITULOS EM ABERTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#tabelaFinanceiro-desativado').DataTable({
    "paging": false,
    "ordering": false,
    "info": false,
    "bFilter": false,
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
  //CONFIGURACAO BIBLIOTECA NUMERAL
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  numeral.register('locale', 'pt-br', {
    delimiters: {
      thousands: '.',
      decimal: ','
    },
    abbreviations: {
      thousand: 'k',
      million: 'm',
      billion: 'b',
      trillion: 't'
    },
    currency: {
      symbol: 'R$'
    }
  });
  numeral.locale('pt-br');
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE TEM ALGUM CONTRATO SELECIONADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  if ($('#idContrato').val() != null) {
    $('#btnAdicionarParcelas').prop('disabled', false);
  } else {
    $('#btnAdicionarParcelas').prop('disabled', true);
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA QUAL TIPO DO CONTRATO NOVO OU JA FATURA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($('#cliente_novo').val() == 'S') {
    $('#lb_primeira').prop('hidden', false);
    $('#primeira').prop('hidden', false);

    $('#lb_ultima_fatura').prop('hidden', true);
    $('#ultima_fatura').prop('hidden', true);
  } else {
    $('#lb_primeira').prop('hidden', true);
    $('#primeira').prop('hidden', true);

    $('#lb_ultima_fatura').prop('hidden', false);
    $('#ultima_fatura').prop('hidden', false);
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE O PRIMEIRO VENCIMENTO NAO SERA MENOR QUE A DATA DE ATIVACAO CASO SEJA SELECIONA O PROXIMO VENCIMENTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  let primeiroVencimento = moment($('#vencimento').val()+'/'+$('#primeira').val() , "DD/MM/YYYY", 'pt');
  let dataAtivacao = moment($('#data_ativacao').val() , "DD/MM/YYYY", 'pt');

  if (primeiroVencimento < dataAtivacao) {
    $("#primeira").val($("#primeira option").eq(1).val());
  }

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

  var clienteNovo = $('#cliente_novo').val();
  var dataUltimaFatura = $('#ultima_fatura').val();

  var quantidadeParcelas = $('#parcelas').val();
  var valor = $('#valor').val().replace('.', ',');

  var valor = numeral(valor);
  var valor = valor.format('0,0.00');

  //VERIFICA SE E O PRIMEIRO FATURAMENTO DO CLIENTE
  if (clienteNovo == 'S') { //SENDO O PRIMEIRO FATURAMENTO
    //MOSTRA A DIV PARCELAS


    $('#divParcelas').show();

    //CALCULA A DIFERENCA DE DIAS ENTRE A DATA DE ATIVACAO E PRIMEIRO VENCIMENTO
    var primeiraData = moment($('#data_ativacao').val() , "DD/MM/YYYY", 'pt');
    var segundaData = moment($('#vencimento').val()+'/'+$('#primeira').val() , "DD/MM/YYYY", 'pt');
    var duracao = moment.duration(segundaData.diff(primeiraData));
    var diferencaDias = duracao.asDays();

    //CALCULA O VALOR POR DIA
    var valorDia = $('#valor').val().replace(',', '.')/30;

    //CALCULA O VALOR DA PRIMEIRA PARCELA
    var valorPrimeiraParcela = valorDia*diferencaDias;
    valorPrimeiraParcela = numeral(valorPrimeiraParcela);
    valorPrimeiraParcela = valorPrimeiraParcela.format('0,0.00');

    //GERA PRIMEIRA PARCELA NA TELA
    var dataAtivacao = $('#data_ativacao').val();
    var dataPrimeira = $('#vencimento').val()+'/'+$('#primeira').val();
    var tr =
    '<tr>'+
    '<td><input class="vencimento" type="text" name="parcelas[vencimento][]" value="'+dataPrimeira+'"</td>'+
    '<td><input class="valor" type="text" name="parcelas[valor][]" value="'+valorPrimeiraParcela+'"</td>'+
    '<td><input type="text" size="50px" name="parcelas[referencia][]" value="REFERENCIA: DE '+dataAtivacao+' ATE '+dataPrimeira+'"</td>'+
    '<td><a class="btn btn-danger btn-sm" href="javascript:;" onclick="excluir(this)"><i class="fas fa-trash-alt"></i> Excluir</a></td>'+
    '</tr>';
    $('#tabelaParcelas').append(tr);

    //GERA AS DEMAIS PARCELAS NA TELA
    for (parcelaInicial = 1; parcelaInicial < quantidadeParcelas; parcelaInicial++) {
      var dataVencimento = moment(dataPrimeira , "DD/MM/YYYY", 'pt').add(1, 'M').calendar();
      var tr =
      '<tr>'+
      '<td><input class="vencimento" type="text" name="parcelas[vencimento][]" value="'+dataVencimento+'"</td>'+
      '<td><input class="valor" type="text" name="parcelas[valor][]" value="'+valor+'"</td>'+
      '<td><input type="text" size="50px" name="parcelas[referencia][]" value="REFERENCIA: DE '+dataPrimeira+' ATE '+dataVencimento+'"</td>'+
      '<td><a class="btn btn-danger btn-sm" href="javascript:;" onclick="excluir(this)"><i class="fas fa-trash-alt"></i> Excluir</a></td>'+
      '</tr>';
      $('#tabelaParcelas').append(tr);
      dataPrimeira = dataVencimento;
    }
    //DESATIVA O BOTAO GERAR
    $("#btnGerar").prop("disabled", true);
    //ATIVA BOTAO SALVAR E LIMPAR
    $("#btnSalvar").prop("disabled", false);
    $("#btnLimpar").prop("disabled", false);

  } else { //CASO NAO SEJA O PRIMEIRO FATURAMENTO
    //MOSTRA A DIV PARCELAS
    $("#divParcelas").show();

    //GERA AS DEMAIS PARCELAS NA TELA
    for (parcelaInicial = 0; parcelaInicial < quantidadeParcelas; parcelaInicial++) {
      var dataVencimento = moment(dataUltimaFatura , "DD/MM/YYYY", 'pt').add(1, 'M').calendar();
      var tr =
      '<tr>'+
      '<td><input class="vencimento" type="text" name="parcelas[vencimento][]" value="'+dataVencimento+'"</td>'+
      '<td><input class="valor" type="text" name="parcelas[valor][]" value="'+valor+'"</td>'+
      '<td><input type="text" size="50px" name="parcelas[referencia][]" value="REFERENCIA: DE '+dataUltimaFatura+' ATE '+dataVencimento+'"</td>'+
      '<td><a class="btn btn-danger btn-sm" href="javascript:;" onclick="excluir(this)"><i class="fas fa-trash-alt"></i> Excluir</a></td>'+
      '</tr>';
      $('#tabelaParcelas').append(tr);
      dataUltimaFatura = dataVencimento;
    }
    //DESATIVA O BOTAO GERAR
    $("#btnGerar").prop("disabled", true);
    //ATIVA BOTAO SALVAR E LIMPAR
    $("#btnSalvar").prop("disabled", false);
    $("#btnLimpar").prop("disabled", false);
    //ADICIONA MASCARA NOS TITULOS GERADOS
    $('.vencimento').inputmask('dd/mm/yyyy');
    $(".valor").inputmask('decimal', {
      'alias': 'numeric',
      'digits': 2,
      'radixPoint': ",",
      'digitsOptional': false
    });
  }
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EXCLUI LINHA DA TABELA
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function excluir(obj){
  $(obj).closest('tr').remove();
};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCAO DE TESTE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function abreAddReceber(){

  var idContrato = $('#idContrato').val();
  //var idCliente = $('#idCliente').val();
  window.location=(BASE_URL+'receber/adicionar/'+idContrato);
  //window.location=(BASE_URL+'receber/adicionar/?cliente='+idCliente+'&contrato='+idContrato);

};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
