//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorPessoal(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_pessoal'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/sacad/servidor_atualizacao/salvar_pessoal",
      type: "POST",
      data: $('#form_servidor_pessoal').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendPessoal,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendPessoal(obj) {
  if (obj.msg == 'success') {
    $('input.servidor_atualizacao_id').val(obj.id);
    $('input.situacao_servidor_atualizacao_id').val(obj.situacaoId);
    $('input.tipo_atualizacao').val(obj.tipoAtualizacao);
    swal.fire('Sucesso', obj.retorno, 'success');
    return false;
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}
$('select#nacionalidade_s').change(function() {
  if ($(this).val() == 1) {
    $('select.select2_naturalidade').prop('disabled', false);
  } else {
    $('select.select2_naturalidade').prop('disabled', true);
  }
  return false;
});
// RECARREGA SELECT2 COM SETORES
function onSuccessSendGetSetoresPessoal(obj) {
  if (obj.msg == 'success') {
    $('select#setor_atual_s').val(null).trigger('change');
    $('select#setor_atual_s').html(obj.retorno);
    $('select#setor_atual_s').select2({
      placeholder: 'Selecione uma opção'
    });
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}
// RECARREGA SELECT2 COM SETORES
function onSuccessSendGetSetoresPessoal2(obj) {
  if (obj.msg == 'success') {
    $('select#setor_atual_2_s').val(null).trigger('change');
    $('select#setor_atual_2_s').html(obj.retorno);
    $('select#setor_atual_2_s').select2({
      placeholder: 'Selecione uma opção'
    });
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}
