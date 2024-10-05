//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarContratoAlteracao(){
  window.onbeforeunload = null;
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/servidor_contrato/salvar_contrato_alteracao",
    type: "POST",
    data: $('#form_servidor_contrato_alteracao').serialize(),
    enctype: 'multipart/form-data',
    success: onSuccessSendContratoAlteracao,
    error: onError
  });
  return false;
}
function onSuccessSendContratoAlteracao(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_contrato_alteracao').find('input[name="alteracao_id_sc[]"]').each(function (kInput, vInput){
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
function contratoAlteracaoFormDel(vObj){
  if ($('form#form_servidor_contrato_alteracao').find('div.box_alteracao').length > 1){
    $(vObj).parents('div.box_alteracao').remove();
  } else {
    $('form#form_servidor_contrato_alteracao').find('.btn_add_alteracao').click();
    $(vObj).parents('div.box_alteracao').remove();
  }
  contratoAlteracaoFormOrdenar();
  return false;
}
function contratoAlteracaoFormAdd(vObj){
  // PREPARA FORM DE ALTERAÇÃO PARA SER CLONADO
  var div = $(vObj).parents('div.box_alteracao');
  $(div).find('select.select2').select2('destroy');
  // CLONA FORM DE ALTERAÇÃO
  $(div).after($(div).clone());
  createSelect2Model($(div).find('select.select2'));
  var divNew = $(div).next();
  contratoAlteracaoFormClean($(divNew));
  contratoAlteracaoFormOrdenar();
  return false;
}
function contratoAlteracaoFormClean(obj){
  $(obj).find('input').val('');
  $(obj).find('input[name="alteracao_id_sc[]"]').val('0');
  $(obj).find('textarea').val('');
  $(obj).find('select.select2').val('');
  createSelect2Model($(obj).find('select.select2'));
  elementosFormatar();
}
function contratoAlteracaoFormOrdenar(){
  $('form#form_servidor_contrato_alteracao').find('div.box_alteracao').each(function (kDiv, vDiv){
    $(vDiv).find('strong span').text(kDiv+1);
    $(vDiv).find('input[name="alteracao_id_sc[]"]').attr('id', 'alteracao_id_sc_'+(kDiv+1));
    $(vDiv).find('input[name="salario_sc[]"]').attr('id', 'salario_sc_'+(kDiv+1));
    $(vDiv).find('select[name="periodicidade_sc[]"]').attr('id', 'periodicidade_sc_'+(kDiv+1));
    $(vDiv).find('input[name="funcao_sc[]"]').attr('id', 'funcao_sc_'+(kDiv+1));
    $(vDiv).find('textarea[name="descricao_sc[]"]').attr('id', 'descricao_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_vigorar_sc[]"]').attr('id', 'dt_vigorar_sc_'+(kDiv+1));
    $(vDiv).find('input[name="dt_publicacao_sc[]"]').attr('id', 'dt_publicacao_sc_'+(kDiv+1));
    $(vDiv).find('input[name="hora_entrada_sc[]"]').attr('id', 'hora_entrada_sc_'+(kDiv+1));
    $(vDiv).find('input[name="hora_saida_sc[]"]').attr('id', 'hora_saida_sc_'+(kDiv+1));
    $(vDiv).find('input[name="hora_intervalo_entrada_sc[]"]').attr('id', 'hora_intervalo_entrada_sc_'+(kDiv+1));
    $(vDiv).find('input[name="hora_intervalo_saida_sc[]"]').attr('id', 'hora_intervalo_saida_sc_'+(kDiv+1));
    $(vDiv).find('.btn_del_alteracao').attr('id', 'btn_del_alteracao_'+(kDiv+1));
    $(vDiv).find('.btn_add_alteracao').attr('id', 'btn_add_alteracao_'+(kDiv+1));
  });
}