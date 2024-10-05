//Date dd/mm/yyyy
$('.date_format').mask('00/00/0000');
//CPF 999.999.999-99
$('.cpf_format').mask('000.000.000-00');
//Telefone (68)3222-2222
//PESQUISANDO SERVIDOR
$('button#btn_pesquisar').click(function(){
  if ($('input#login_servidor').val() != '' && $('input#senha_servidor').val() != '') {
    window.onbeforeunload = null;
    $('button#btn_pesquisar').prop('disable', true);
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/servidor/get_servidor",
      type: "POST",
      data: $('#form_servidor_pesquisa').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSend,
      error: onError
    });
  } else {
    swal.fire('Atenção', 'Todos os campos devem ser preenchidos, corretamente!', 'warning');
  }
  return false;
});
function onSuccessSend(obj) {
  $('button#btn_pesquisar').prop('disable', false);
  if (obj.msg == 'edit') {
    postToURL(PORTAL_URL + 'cadastrar', {id: obj.id});
  } else if (obj.msg == 'msg') {
    postToURL(PORTAL_URL + 'cadastrar', {id: obj.id, atualizacaoId: obj.atualizacaoId});
  } else if (obj.msg == 'view') {
    postToURL(PORTAL_URL + 'cadastrar', {id: obj.id, atualizacaoId: obj.atualizacaoId});
  } else if (obj.msg == 'falha') {
    swal.fire('Erro', 'Não foi encontrado o servidor com os dados informados!', 'error');
  }
  return false;
}
// ERRO AO ENVIAR AJAX
function onError(obj) {
  if (obj.responseText == "logout") {
    swal.fire({title: 'Limite de tempo, sem ação, ultrapassado', text: "Você passou mais de 30 minutos sem ação no sistema e por isso deverá efetuar login novamente.", icon: 'error', confirmButtonText: 'Ok'})
    .then((result) => {
      postToURL(PORTAL_URL + (obj.responseText));
    });
  } else {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, informe esse erro ao suporte.", 'error');
    console.log('onError: ' + JSON.stringify(obj));
  }
  return false;
}
