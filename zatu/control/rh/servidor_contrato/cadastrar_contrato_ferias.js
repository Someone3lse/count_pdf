//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarContratoFerias(){
  window.onbeforeunload = null;
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/servidor_contrato/salvar_contrato_ferias",
    type: "POST",
    data: $('#form_servidor_contrato_ferias').serialize(),
    enctype: 'multipart/form-data',
    success: onSuccessSendContratoFerias,
    error: onError
  });
  return false;
}
function onSuccessSendContratoFerias(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_contrato_ferias').find('input[name="ferias_id_sc[]"]').each(function (kInput, vInput){
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
function contratoFeriasFormDel(vObj){
  if ($('form#form_servidor_contrato_ferias').find('div.box_ferias').length > 1){
    $(vObj).parents('div.box_ferias').remove();
  } else {
    $('form#form_servidor_contrato_ferias').find('.btn_add_ferias').click();
    $(vObj).parents('div.box_ferias').remove();
  }
  contratoFeriasFormOrdenar();
  return false;
}
function contratoFeriasFormAdd(vObj){
  // PREPARA FORM DE ALTERAÇÃO PARA SER CLONADO
  var div = $(vObj).parents('div.box_ferias');
  // CLONA FORM DE ALTERAÇÃO
  $(div).after($(div).clone());
  var divNew = $(div).next();
  contratoFeriasFormClean($(divNew));
  contratoFeriasFormOrdenar();
  return false;
}
function contratoFeriasFormClean(obj){
  $(obj).find('input').val('');
  $(obj).find('input[name="ferias_id_sc[]"]').val('0');
  $(obj).find('textarea').val('');
  elementosFormatar();
}
function contratoFeriasFormOrdenar(){
  $('form#form_servidor_contrato_ferias').find('div.box_ferias').each(function (kDiv, vDiv){
    $(vDiv).find('strong span').text(kDiv+1);
    $(vDiv).find('input[name="ferias_id_sc[]"]').attr('id', 'ferias_id_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_aquisitivo_inicio_sc[]"]').attr('id', 'dt_aquisitivo_inicio_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_aquisitivo_fim_sc[]"]').attr('id', 'dt_aquisitivo_fim_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_gozo_inicio_sc[]"]').attr('id', 'dt_gozo_inicio_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_gozo_inicio_sc[]"]').attr('id', 'dt_gozo_inicio_sc_'+(kDiv+1));
    $(vDiv).find('textarea[name="obs_sc[]"]').attr('id', 'obs_sc_'+(kDiv+1));
    $(vDiv).find('.btn_del_ferias').attr('id', 'btn_del_ferias_'+(kDiv+1));
    $(vDiv).find('.btn_add_ferias').attr('id', 'btn_add_ferias_'+(kDiv+1));
  });
}