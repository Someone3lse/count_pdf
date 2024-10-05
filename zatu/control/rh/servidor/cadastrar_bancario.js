//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorBancario(){
  window.onbeforeunload = null;
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/servidor/salvar_bancario",
    type: "POST",
    data: $('#form_servidor_bancario').serialize(),
    enctype: 'multipart/form-data',
    success: onSuccessSendBancario,
    error: onError
  });
  return true;
}
function onSuccessSendBancario(obj) {
  if (obj.msg == 'success') {
    $('input#servidor_bancario_id_s').val(obj.id);
    swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
    return false;
  } else if (obj.msg == 'error') {
    if (obj.tipo == 'servidorId') {
      swal.fire('Erro', obj.retorno, 'error');
    } else {
      swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
      console.log('Error: ' + obj.retorno);
    }
    return false;
  }
}