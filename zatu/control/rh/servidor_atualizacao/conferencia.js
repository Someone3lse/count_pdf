//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function(e) {
  if ($('#nome_s').val() == '' && $('#dt_nasc_s').val() == '' && $('#cpf_s').val() == '') {
    window.onbeforeunload = null;
  } else {
    return true;
  }
};
$(document).ready(function() {
  //Flat red color scheme for iCheck
  $('.ichack-input input[type="radio"].square-purple').iCheck({
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
  });
  $('button#btn_cancelar').click(function() {
    Swal.fire({
      title: 'Tens certeza que deseja cancelar a conferência da atualizacção cadastral do servidor?',
      text: "",
      icon: 'question',
      showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, iniciar!',
      cancelButtonText: 'Não, obrigado!'
    }).then((result) => {
      if (result.isConfirmed) {
        postToURL(PORTAL_URL + 'view/rh/servidor_atualizacao/dashboard');
      } else {
        return false;
      }
    })
  });
  $('button.btn_salvar').click(function(){
    $('input#conferencia_situacao').val(2);
    salvarConferencia();
  });
  $('button#btn_finalizar').click(function(){
    $('input#conferencia_situacao').val(1);
    verificaSituacao();
    salvarConferencia();
  });
  $('div.div_agrupador').each(function(k, elem){
    if ($(elem).find('strong').html() != ' LOCAL DE TRABALHO 1' && $(elem).find('strong').html() != ' LOCAL DE TRABALHO 2'){
      let textoPadrao = '';
      textoPadrao += '<div class="div_link alert alert-warning mt-5 mb-0">';
      textoPadrao += '<span>O comprovante enviado, pelo servidor, excedeu o limite de tamanho e necessita ser reenviado!</span>';
      textoPadrao += '</div>';
      let qtdModificacoes = $(elem).find('span.text-danger').length;
      let qtdLink = $(elem).find('div.div_link').length;
      if(qtdModificacoes > 0 && qtdLink <= 0){
        $(elem).find('div.div_prova').append(textoPadrao);
      }
    }
  });
});
//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarConferencia(){
  window.onbeforeunload = null;
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/servidor_atualizacao/salvar_conferencia",
    type: "POST",
    data: $('form#form_conferencia').serialize(),
    enctype: 'multipart/form-data',
    success: onSuccessSendConferencia,
    error: onError
  });
  return false;
}
function onSuccessSendConferencia(obj) {
  if (obj.msg == 'success') {
    swal.fire('Sucesso', obj.retorno, 'success');
    postToURL(PORTAL_URL + 'view/rh/servidor_atualizacao/dashboard');
  } else if (obj.msg == 'continuous') {
    Swal.fire({
      title: obj.retorno + ' Você deseja continuar conferindo estes registros?',
      text: "",
      icon: 'question',
      showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, iniciar!',
      cancelButtonText: 'Não, obrigado!'
    }).then((result) => {
      if (!result.isConfirmed) {
        postToURL(PORTAL_URL + 'view/rh/servidor_atualizacao/dashboard');
      } else {
        return false;
      }
    })
  } else if (obj.msg == 'recall') {
    swal.fire('Erro', obj.retorno, 'error');
    postToURL(PORTAL_URL + 'view/rh/servidor_atualizacao/dashboard');
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
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
function verificaSituacao(){
  $('input[type="radio"]:checked').each(function(k, v){
    if($(v).val() == 0){
      $('input#conferencia_situacao').val(0);
      return false;
    }
  });
  return false;
}