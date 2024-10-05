//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarContrato(){
  window.onbeforeunload = null;
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/servidor_contrato/salvar_contrato",
    type: "POST",
    data: $('#form_servidor_contrato').serialize(),
    enctype: 'multipart/form-data',
    success: onSuccessSendContrato,
    error: onError
  });
  return false;
}
function onSuccessSendContrato(obj) {
  if (obj.msg == 'success') {
    $('input.servidor_contrato_id').val(obj.id);
    swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
    return false;
  } else if (obj.msg == 'error') {
    if (obj.tipo == 'nome') {
      var msg = obj.retorno.contratoNumero;
      swal.fire('Erro', msg, 'error');;
    } else {
      swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
      console.log('Error: ' + obj.retorno);
    }
    return false;
  }
}
