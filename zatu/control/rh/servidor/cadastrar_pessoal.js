//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorPessoal(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_pessoal'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_pessoal",
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
    $('input.servidor_id').val(obj.id);
    swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
    return false;
  } else if (obj.msg == 'error') {
    if (obj.tipo == 'cpf') {
      swal.fire('Erro', obj.retorno, 'error');
    } else {
      swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
      console.log('Error: ' + obj.retorno);
    }
    return false;
  }
}
function naturalEstrangeiroControle(elem){
  if ($(elem).val() == 1) {
    $('select.select2_naturalidade').prop('disabled', false);
    $('input#nat_est_dt_ingresso_s').val('').prop('disabled', true);
    $('input#nat_est_cidade_s').val('').prop('disabled', true);
    $('input#nat_est_estado_s').val('').prop('disabled', true);
    $('input#nat_est_cond_trabalho_s').val('').prop('disabled', true);
  } else {
    $('select.select2_naturalidade').val(null).trigger('change').prop('disabled', true);
    $('input#nat_est_dt_ingresso_s').prop('disabled', false);
    $('input#nat_est_cidade_s').prop('disabled', false);
    $('input#nat_est_estado_s').prop('disabled', false);
    $('input#nat_est_cond_trabalho_s').prop('disabled', false);
  }
}
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
