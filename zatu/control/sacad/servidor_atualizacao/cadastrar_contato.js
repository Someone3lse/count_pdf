//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorContato(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_contato'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/sacad/servidor_atualizacao/salvar_contato",
      type: "POST",
      data: $('#form_servidor_contato').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendContato,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendContato(obj) {
  if (obj.msg == 'success') {
    $('input#servidor_atualizacao_contato_id_s').val(obj.id);
    swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/sacad/servidor/cadastrar');
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
// RECARREGA SELECT2 COM MUNICIPIOS
function onSuccessSendGetMunicipiosContato(obj) {
  if (obj.msg == 'success') {
    $('select#end_municipio_s').val(null).trigger('change');
    $('select#end_municipio_s').html(obj.retorno);
    $('select#end_municipio_s').select2({
      placeholder: 'Selecione uma opção'
    });
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}