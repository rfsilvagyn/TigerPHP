$(function(){

  $("#nome").on('focusout', function(){
    $.ajax({
      type: 'GET',
      url: 'geraLogin.php?nome='+$("#nome").val(),
      success: function(nomelogin){
        $("#cliente #login").val(nomelogin);
      }
    });
  });
});
