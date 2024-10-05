$(function () {
  "use strict";
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })

  $("a#a_recadastro").click(function(){
    if ($(this).attr("negado") != "true") {
      postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 2});
    }
    return false;
  });
  $("a#a_atualizacao").click(function(){
    if ($(this).attr("negado") != "true") {
      postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 1});
    }
    return false;
  });
});
function btnContinuarProcesso(){
  postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar');
}
function btnVerProtocolo(id){
  postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/mensagem', {id: id}, 'POST', '_blanck');
}
