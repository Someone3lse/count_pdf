//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarAtualizacaoAutenticacao(){
  window.onbeforeunload = null;
  var atualizacaoId = $('#form_servidor_pessoal input.servidor_atualizacao_id').val();
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/sacad/servidor_atualizacao/salvar_autenticacao",
    type: "POST",
    data: {id: atualizacaoId},
    enctype: 'multipart/form-data',
    success: onSuccessSendAutenticacao,
    error: onError
  });
  return false;
}
function onSuccessSendAutenticacao(obj) {
  if (obj.msg == 'success') {
    swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/mensagem', {id: obj.id, autenticacao: obj.autenticacao}, 'POST', '_blanck');
    postToURL(PORTAL_URL + 'servidor_dashboard', {id: obj.id, autenticacao: obj.autenticacao});
  } else if (obj.msg == 'error') {
    swal.fire('Erro', obj.retorno, 'error');
    return false;
  }
}
