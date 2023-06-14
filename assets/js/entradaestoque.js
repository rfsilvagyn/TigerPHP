$(document).ready(function() {

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //AO PRESSIONAR ENTER NO CAMPO QUANTIDADE SETA O FOCO EM NUMERO DE SERIE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#quantidade').keypress(function (e) {
    if(e.which == 13) {
      $('#ns').focus();
    }
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //AO PRESSIONAR ENTER NO CAMPO NUMERO DE SERIE CLICA NO BOTAO ADDPRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#ns').keypress(function (e) {
    if(e.which == 13) {
      $("#addproduto").trigger('click');
    }
  });


  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIGURACAO MASCARA DOS CAMPOS QUANDO CARREGA A PAGINA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('.quantidade').inputmask({
    alias: 'numeric',
    allowMinus: false,
    digits: 0,
    max: 9999
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ATIVA CAMPO DE BUSCA NO PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#produto').select2({
    theme: 'bootstrap4',
    width: '550px',
    placeholder: "Selecione um Produto",
  });


  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SETA FOCO NO CAMPO QUANTIDADE APOS SELECIONAR UM PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#produto').on('select2:select', function (e) {
    $('#quantidade').focus();
  });

})

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADICAO DA LINHA DE PRODUTO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function adicionarProduto(obj){
  $('#addproduto').on('click', function(){

    var produto = $('#produto').val();
    var quantidade = $('#quantidade').val();
    var ns = $('#ns').val();
    var descricao = $('#produto option:selected').text();
    var unidade = $('#produto option:selected').attr('unidade');

    //VERIFICA SE A QUANTIDADE NAO ESTA ACIMA DE 1 E TEM NUMERO DE SERIE
    if ( quantidade > 1 && ns != '' ) {
      swal({
        title: "Produto com numero de serie deve ser lançado individualmente.",
        icon: 'error',
        closeModal: false
      })
      .then( () => {
        setTimeout(function(){
          $('#quantidade').focus();
        }, 100);
      })
    } else {
      //VERIFICA SE PRODUTO E QUANTIDADE ESTAO PREENCHIDOS
      if ( quantidade != '' && produto != '' ) {
        var tr =
        '<tr>'+
        '<td><input readonly style="background-color: transparent; border:0; width:20px" type="text" name="produtos[produto][]" value="'+produto+'"</td>'+
        '<td><input readonly style="background-color: transparent; border:0; width:300px" type="text" value="'+descricao+'"</td>'+
        '<td><input readonly style="background-color: transparent; border:0; width:50px" type="text" name="produtos[quantidade][]" value="'+quantidade+'"</td>'+
        '<td><input readonly style="background-color: transparent; border:0; width:50px" type="text" value="'+unidade+'"</td>'+
        '<td><input readonly style="background-color: transparent; border:0; width:120px" type="text" name="produtos[ns][]" value="'+ns+'"</td>'+
        '<td><a style="width:90px" class="btn btn-gradient-danger btn-sm" href="javascript:;" onclick="excluirProduto(this)"><i class="mdi mdi-delete"></i> Excluir</a></td>'+
        '</tr>';

        $('#table_produtos').append(tr);

        $("#produto").val('').trigger('change')
        $('#quantidade').val('');
        $('#ns').val('');
        $('#produto').select2('focus');

      } else {
        swal({
          title: "Selecione um Produto e Quantidade.",
          icon: 'error',
          closeModal: false
        })
        .then( () => {
          setTimeout(function(){
            if (produto == '') {
              $('#produto').select2('focus');
            } else {
              $('#quantidade').focus();
            }
          }, 100);
        })
      }
    }
  });
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EXCLUSAO DA LINHA DE CONTATO
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function excluirProduto(obj){
  console.log(obj);
  $(obj).closest('tr').remove();
};
