//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorDependente(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_dependente'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/salvar_dependente",
      type: "POST",
      data: $('#form_servidor_dependente').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendDependente,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendDependente(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_dependente').find('input[name="dependente_id_s[]"]').each(function (kInput, vInput){
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
function dependenteFormDel(vObj){
  if ($('form#form_servidor_dependente').find('div.box_dependente').length > 1){
    $(vObj).parents('div.box_dependente').remove();
  } else {
    $('form#form_servidor_dependente').find('.btn_add_dependente').click();
    $(vObj).parents('div.box_dependente').remove();
  }
  depentendeFormOrdenar();
  return false;
}
function dependenteFormAdd(vObj){
  var div = $(vObj).parents('div.box_dependente');
  $(div).find('select.select2').select2('destroy');
  $('form#form_servidor_dependente').find('.ichack-input input[type="radio"].square-purple').iCheck('destroy');
  var clone = $(div).clone();
  $(clone).find('input.dependente_benef_s').attr('name', 'dependente_benef_s_0');
  $(clone).find('input.dependente_benef_repres_s').attr('name', 'dependente_benef_repres_s_0');
  $(div).after(clone);
  var divNew = $(div).next();
  dependenteFormClean($(divNew));
  depentendeFormOrdenar();
  createSelect2Model($(div).find('select.select2'));
  createICkeckModel();
  $(div).find('input.dependente_benef_s').parent().find('ins').attr('onclick', 'benefClickIns(this);');
  $(divNew).find('input.dependente_benef_s').iCheck('uncheck').parent().find('ins').attr('onclick', 'benefClickIns(this);');
  $(div).find('input.dependente_benef_repres_s').parent().find('ins').attr('onclick', 'represClickIns(this);');
  $(divNew).find('input.dependente_benef_repres_s').iCheck('uncheck').parent().find('ins').attr('onclick', 'represClickIns(this);');
  cleanValidatorRMRosas(divNew);
  return false;
}
function dependenteFormClean(obj){
  $(obj).find('input[name="dependente_id_s[]"]').val('0');
  $(obj).find('select.select2').val('');
  createSelect2Model($(obj).find('select.select2'));
  $(obj).find('input[name="dependente_codigo_s[]"]').val('');
  $(obj).find('input[name="dependente_nome_s[]"]').val('');
  $(obj).find('input[name="dependente_parent_grau_outro_s[]"]').val('');
  $(obj).find('input[name="dependente_cpf_s[]"]').val('');
  $(obj).find('input[name="dependente_dt_nasc_s[]"]').val('');
  $(obj).find('input[name="dependente_dt_casamento_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_autos_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_rg_numero_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_rg_dt_emissao_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_rg_orgao_expedidor_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_tel_res_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_tel_cel_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_end_log_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_end_num_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_end_comp_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_end_bairro_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_end_cep_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_bancario_agencia_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_bancario_conta_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_bancario_op_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_nome_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_cpf_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_rg_numero_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_rg_dt_emissao_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_rg_orgao_expedidor_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_tel_res_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_tel_cel_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_end_log_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_end_num_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_end_comp_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_end_bairro_s[]"]').val('');
  $(obj).find('input[name="dependente_benef_repres_end_cep_s[]"]').val('');
  $(obj).find('input.radio_benef_n').iCheck('check');
  $(obj).find('input.radio_repres_n').iCheck('check');
  $(obj).find('div#div_benef_dados').attr('style', 'display: none;');
  $(obj).find('div#div_repres_dados').attr('style', 'display: none;');
  elementosFormatar();
}
function depentendeFormOrdenar(){
  var countDiv = $('form#form_servidor_dependente').find('div.box_dependente').length;
  $($('form#form_servidor_dependente').find('div.box_dependente').get().reverse()).each(function (kDiv, vDiv){
    var contador = countDiv - kDiv;
    $(vDiv).find('strong span').text(contador);
    $(vDiv).find('input[name="dependente_id_s[]"]').attr('id', 'dependente_id_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_codigo_s[]"]').attr('id', 'dependente_codigo_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_nome_s[]"]').attr('id', 'dependente_nome_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_parent_grau_outro_s[]"]').attr('id', 'dependente_parent_grau_outro_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_cpf_s[]"]').attr('id', 'dependente_cpf_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_dt_nasc_s[]"]').attr('id', 'dependente_dt_nasc_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_dt_casamento_s[]"]').attr('id', 'dependente_dt_casamento_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_autos_s[]"]').attr('id', 'dependente_benef_autos_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_rg_numero_s[]"]').attr('id', 'dependente_benef_rg_numero_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_rg_dt_emissao_s[]"]').attr('id', 'dependente_benef_rg_dt_emissao_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_rg_orgao_expedidor_s[]"]').attr('id', 'dependente_benef_rg_orgao_expedidor_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_tel_res_s[]"]').attr('id', 'dependente_benef_tel_res_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_tel_cel_s[]"]').attr('id', 'dependente_benef_tel_cel_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_end_log_s[]"]').attr('id', 'dependente_benef_end_log_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_end_num_s[]"]').attr('id', 'dependente_benef_end_num_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_end_comp_s[]"]').attr('id', 'dependente_benef_end_comp_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_end_bairro_s[]"]').attr('id', 'dependente_benef_end_bairro_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_end_cep_s[]"]').attr('id', 'dependente_benef_end_cep_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_bancario_agencia_s[]"]').attr('id', 'dependente_benef_bancario_agencia_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_bancario_conta_s[]"]').attr('id', 'dependente_benef_bancario_conta_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_bancario_op_s[]"]').attr('id', 'dependente_benef_bancario_op_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_nome_s[]"]').attr('id', 'dependente_benef_repres_nome_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_cpf_s[]"]').attr('id', 'dependente_benef_repres_cpf_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_rg_numero_s[]"]').attr('id', 'dependente_benef_repres_rg_numero_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_rg_dt_emissao_s[]"]').attr('id', 'dependente_benef_repres_rg_dt_emissao_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_rg_orgao_expedidor_s[]"]').attr('id', 'dependente_benef_repres_rg_orgao_expedidor_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_tel_res_s[]"]').attr('id', 'dependente_benef_repres_tel_res_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_tel_cel_s[]"]').attr('id', 'dependente_benef_repres_tel_cel_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_end_log_s[]"]').attr('id', 'dependente_benef_repres_end_log_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_end_num_s[]"]').attr('id', 'dependente_benef_repres_end_num_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_end_comp_s[]"]').attr('id', 'dependente_benef_repres_end_comp_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_end_bairro_s[]"]').attr('id', 'dependente_benef_repres_end_bairro_s'+(kDiv+1));
    $(vDiv).find('input[name="dependente_benef_repres_end_cep_s[]"]').attr('id', 'dependente_benef_repres_end_cep_s'+(kDiv+1));
    $(vDiv).find('input.radio_benef_s').attr('id', 'dependente_benef_s_S_'+contador).attr('name', 'dependente_benef_s_'+contador);
    $(vDiv).find('input.radio_benef_n').attr('id', 'dependente_benef_s_N_'+contador).attr('name', 'dependente_benef_s_'+contador);
    $(vDiv).find('input.radio_repres_n').attr('id', 'dependente_benef_repres_s_N_'+contador).attr('name', 'dependente_benef_repres_s_'+contador);
    $(vDiv).find('input.radio_repres_s').attr('id', 'dependente_benef_repres_s_S_'+contador).attr('name', 'dependente_benef_repres_s_'+contador);
    $(vDiv).find('.btn_del_dependente').attr('id', 'btn_del_dependente'+(kDiv+1));
    $(vDiv).find('.btn_add_dependente').attr('id', 'btn_add_dependente'+(kDiv+1));
  });
}