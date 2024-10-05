//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorVinculo(){
  window.onbeforeunload = null;
  var formValido = formValidatorRMRosas($('#form_servidor_vinculo'));
  if (formValido) {
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/sacad/servidor_atualizacao/salvar_vinculo",
      type: "POST",
      data: $('#form_servidor_vinculo').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSendVinculo,
      error: onError
    });
    return true;
  } else {
    return false;
  }
}
function onSuccessSendVinculo(obj) {
  if (obj.msg == 'success') {
    $('form#form_servidor_vinculo').find('input[name="vinculo_id_s[]"]').each(function (kInput, vInput){
      $(vInput).val(obj.ids[kInput]);
    });
    swal.fire({title: 'Sucesso', text: obj.retorno, icon: 'success', confirmButtonText: 'Ok'})
    .then((result) => {
      return true;
    });
    // swal.fire('Sucesso', obj.retorno, 'success');
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
function vinculoFormDel(vObj){
  if ($('form#form_servidor_vinculo').find('div.box_vinculo').length > 1){
    $(vObj).parents('div.box_vinculo').remove();
  } else {
    $('form#form_servidor_vinculo').find('.btn_add_vinculo').click();
    $(vObj).parents('div.box_vinculo').remove();
  }
  vinculoFormOrdenar();
  return false;
}
function vinculoFormAdd(vObj){
  // PREPARA FORM DE VINCULO PARA SER CLONADO
  var div = $(vObj).parents('div.box_vinculo');
  // CLONA FORM DE VINCULO
  $(div).after($(div).clone());
  var divNew = $(div).next();
  vinculoFormClean($(divNew));
  vinculoFormOrdenar();
  cleanValidatorRMRosas(divNew);
  return false;
}
function vinculoFormClean(obj){
  $(obj).find('label span.text-danger').text('');
  $(obj).find('input[name="vinculo_id_s[]"]').val('0');
  $(obj).find('input[name="vinculo_id_old_s[]"]').val('0');
  $(obj).find('input[name="vinculo_local_s[]"]').val('');
  $(obj).find('input[name="vinculo_esfera_s[]"]').val('');
  $(obj).find('input[name="vinculo_cargo_s[]"]').val('');
  $(obj).find('input[name="vinculo_carga_horaria_s[]"]').val('');
}
function vinculoFormOrdenar(){
  $('form#form_servidor_vinculo').find('div.box_vinculo').each(function (kDiv, vDiv){
    $(vDiv).find('strong span').text(kDiv+1);
    $(vDiv).find('input[name="vinculo_id_s[]"]').attr('id', 'vinculo_id_s'+(kDiv+1));
    $(vDiv).find('input[name="vinculo_id_old_s[]"]').attr('id', 'vinculo_id_old_s'+(kDiv+1));
    $(vDiv).find('input[name="vinculo_local_s[]"]').attr('id', 'vinculo_local_s'+(kDiv+1));
    $(vDiv).find('input[name="vinculo_esfera_s[]"]').attr('id', 'vinculo_esfera_s'+(kDiv+1));
    $(vDiv).find('input[name="vinculo_cargo_s[]"]').attr('id', 'vinculo_cargo_s'+(kDiv+1));
    $(vDiv).find('input[name="vinculo_carga_horaria_s[]"]').attr('id', 'vinculo_carga_horaria_s'+(kDiv+1));
    $(vDiv).find('.btn_del_vinculo').attr('id', 'btn_del_vinculo'+(kDiv+1));
    $(vDiv).find('.btn_add_vinculo').attr('id', 'btn_add_vinculo'+(kDiv+1));
  });
}