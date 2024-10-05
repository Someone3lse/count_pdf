//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorInstrucao(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_instrucao'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_instrucao",
      type: "POST",
      data: $('#form_servidor_instrucao').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendInstrucao,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendInstrucao(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_instrucao').find('input[name="instrucao_id_s[]"]').each(function (kInput, vInput){
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
function instrucaoFormDel(vObj){
  if ($('form#form_servidor_instrucao').find('div.box_instrucao').length > 1){
    $(vObj).parents('div.box_instrucao').remove();
  } else {
    $('form#form_servidor_instrucao').find('.btn_add_instrucao').click();
    $(vObj).parents('div.box_instrucao').remove();
  }
  instrucaoFormOrdenar();
  return false;
}
function instrucaoFormAdd(vObj){
  var div = $(vObj).parents('div.box_instrucao');
  $(div).find('select.select2').select2('destroy');
  $('form#form_servidor_instrucao').find('.ichack-input input[type="radio"].square-purple').iCheck('destroy');
  var clone = $(div).clone();
  $(clone).find('input[type="radio"]').attr('name', 'instrucao_cursando_s_0');
  $(div).after(clone);
  var divNew = $(div).next();
  instrucaoFormClean($(divNew));
  instrucaoFormOrdenar();
  createSelect2Model($(div).find('select.select2'));
  createICkeckModel();
  $(divNew).find('input[type="radio"]').iCheck('uncheck');
  cleanValidatorRMRosas(divNew);
  return false;
}
function instrucaoFormClean(obj){
  $(obj).find('input[name="instrucao_id_s[]"]').val('0');
  $(obj).find('select.select2').val('');
  // GERA SELECT2 NO FORM CLONE
  createSelect2Model($(obj).find('select.select2'));
  $(obj).find('input[name="instrucao_formacao_s[]"]').val('');
  $(obj).find('input[name="instrucao_concl_ano_s[]"]').val('');
  $(obj).find('input[type="radio"][value="0"]').click();
}
function instrucaoFormOrdenar(){
  var countDiv = $('form#form_servidor_instrucao').find('div.box_instrucao').length;
  $($('form#form_servidor_instrucao').find('div.box_instrucao').get().reverse()).each(function (kDiv, vDiv){
    var contador = countDiv - kDiv;
    $(vDiv).find('strong span').textcontador;
    $(vDiv).find('input[name="instrucao_id_s[]"]').attr('id', 'instrucao_id_s_'+contador);
    $(vDiv).find('input[name="instrucao_escolaridade_s[]"]').attr('id', 'instrucao_escolaridade_s_'+contador);
    $(vDiv).find('input[name="instrucao_formacao_s[]"]').attr('id', 'instrucao_formacao_s_'+contador);
    $(vDiv).find('input[name="instrucao_concl_ano_s[]"]').attr('id', 'instrucao_concl_ano_s_'+contador);
    $(vDiv).find('input.radio_sim').attr('id', 'instrucao_cursando_sim_s_'+contador).attr('name', 'instrucao_cursando_s_'+contador);
    $(vDiv).find('input.radio_nao').attr('id', 'instrucao_cursando_nao_s_'+contador).attr('name', 'instrucao_cursando_s_'+contador);
    $(vDiv).find('.btn_del_instrucao').attr('id', 'btn_del_instrucao_'+contador);
    $(vDiv).find('.btn_add_instrucao').attr('id', 'btn_add_instrucao_'+contador);
  });
}