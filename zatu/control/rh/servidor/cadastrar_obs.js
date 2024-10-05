//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorObs(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_obs'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_obs",
      type: "POST",
      data: $('#form_servidor_obs').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendObs,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendObs(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_obs').find('input[name="obs_id_s[]"]').each(function (kInput, vInput){
      $(vInput).val(obj.ids[kInput]);
    });
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
function obsFormDel(vObj){
  if ($('form#form_servidor_obs').find('div.box_obs').length > 1){
    $(vObj).parents('div.box_obs').remove();
  } else {
    $('form#form_servidor_obs').find('.btn_add_obs').click();
    $(vObj).parents('div.box_obs').remove();
  }
  obsFormOrdenar();
  return false;
}
function obsFormAdd(vObj){
  // PREPARA FORM DE OBS PARA SER CLONADO
  var div = $(vObj).parents('div.box_obs');
  // CLONA FORM DE OBS
  $(div).after($(div).clone());
  var divNew = $(div).next();
  obsFormClean($(divNew));
  obsFormOrdenar();
  cleanValidatorRMRosas(divNew);
  return false;
}
function obsFormClean(obj){
  $(obj).find('input[name="obs_id_s[]"]').val('0');
  $(obj).find('input[name="obs_dt_ocorrido_s[]"]').val('');
  $(obj).find('textarea[name="obs_descricao_s[]"]').val('');
  elementosFormatar();
}
function obsFormOrdenar(){
  $('form#form_servidor_obs').find('div.box_obs').each(function (kDiv, vDiv){
    $(vDiv).find('strong span').text(kDiv+1);
    $(vDiv).find('input[name="obs_id_s[]"]').attr('id', 'obs_id_s_'+(kDiv+1));
    $(vDiv).find('input[name="obs_dt_ocorrido_s[]"]').attr('id', 'obs_dt_ocorrido_s_'+(kDiv+1));
    $(vDiv).find('textarea[name="obs_descricao_s[]"]').attr('id', 'obs_descricao_s_'+(kDiv+1));
    $(vDiv).find('.btn_del_obs').attr('id', 'btn_del_obs_'+(kDiv+1));
    $(vDiv).find('.btn_add_obs').attr('id', 'btn_add_obs_'+(kDiv+1));
  });
}