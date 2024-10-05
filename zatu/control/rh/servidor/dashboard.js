//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO

$(document).ready(function () {

});

function btnVisualizar(elem){
  var id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor/visualizar', {id: id});
};

function btnEditar(elem){
  var id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar', {id: id});
};