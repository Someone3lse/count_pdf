//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorFamiliar(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_familiar'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_familiar",
      type: "POST",
      data: $('#form_servidor_familiar').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendFamiliar,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendFamiliar(obj) {
  if (obj.msg == 'success') {
    $('input#servidor_familiar_id_s').val(obj.id);
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
function naturalConjugeEstrangeiroControle(elem){
  if ($(elem).val() == 1) {
    $('select.select2_conjuge_naturalidade').prop('disabled', false);
    $('input#conjuge_nat_est_cidade_s').val('').prop('disabled', true);
    $('input#conjuge_nat_est_estado_s').val('').prop('disabled', true);
  } else {
    $('select.select2_conjuge_naturalidade').val(null).trigger('change').prop('disabled', true);
    $('input#conjuge_nat_est_cidade_s').prop('disabled', false);
    $('input#conjuge_nat_est_estado_s').prop('disabled', false);
  }
}
