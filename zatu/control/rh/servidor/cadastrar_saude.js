//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorSaude(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_saude'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_saude",
      type: "POST",
      data: $('#form_servidor_saude').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendSaude,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendSaude(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_saude').find('input[name="saude_id_s[]"]').each(function (kInput, vInput){
      $(vInput).val(obj.ids[kInput]);
    });
    swal.fire('Sucesso', obj.retorno, 'success');
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
function saudeFormDel(vObj){
  if ($('form#form_servidor_saude').find('div.box_saude').length > 1){
    $(vObj).parents('div.box_saude').remove();
  } else {
    $('form#form_servidor_saude').find('.btn_add_saude').click();
    $(vObj).parents('div.box_saude').remove();
  }
  saudeFormOrdenar();
  return false;
}
function saudeFormAdd(vObj){
  // PREPARA FORM DE SAUDE PARA SER CLONADO
  var div = $(vObj).parents('div.box_saude');
  // CLONA FORM DE SAUDE
  $(div).after($(div).clone());
  var divNew = $(div).next();
  saudeFormClean($(divNew));
  saudeFormOrdenar();
  cleanValidatorRMRosas(divNew);
  return false;
}
function saudeFormClean(obj){
  $(obj).find('input[name="saude_id_s[]"]').val('0');
  $(obj).find('input[name="saude_dt_ocorrido_s[]"]').val('');
  $(obj).find('textarea[name="saude_descricao_s[]"]').val('');
  $(obj).find('input[name="saude_dt_inicio_s[]"]').val('');
  $(obj).find('input[name="saude_dt_fim_s[]"]').val('');
  elementosFormatar();
}
function saudeFormOrdenar(){
  $('form#form_servidor_saude').find('div.box_saude').each(function (kDiv, vDiv){
    $(vDiv).find('strong span').text(kDiv+1);
    $(vDiv).find('input[name="saude_id_s[]"]').attr('id', 'saude_id_s_'+(kDiv+1));
    $(vDiv).find('input[name="saude_dt_ocorrido_s[]"]').attr('id', 'saude_dt_ocorrido_s_'+(kDiv+1));
    $(vDiv).find('textarea[name="saude_descricao_s[]"]').attr('id', 'saude_descricao_s_'+(kDiv+1));
    $(vDiv).find('input[name="saude_dt_inicio_s[]"]').attr('id', 'saude_dt_inicio_s_'+(kDiv+1));
    $(vDiv).find('input[name="saude_dt_fim_s[]"]').attr('id', 'saude_dt_fim_s_'+(kDiv+1));
    $(vDiv).find('.btn_del_saude').attr('id', 'btn_del_saude_'+(kDiv+1));
    $(vDiv).find('.btn_add_saude').attr('id', 'btn_add_saude_'+(kDiv+1));
  });
}