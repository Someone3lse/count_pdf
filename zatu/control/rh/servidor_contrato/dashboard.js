//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO

$(document).ready(function () {

});

function btnVisualizar(elem){
  var id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor_contrato/visualizar', {id: id});
  return false;
};

function btnEditar(elem){
  var id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar', {id: id});
};