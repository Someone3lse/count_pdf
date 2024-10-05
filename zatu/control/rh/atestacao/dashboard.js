//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
$(document).ready(function () {
  $('.select2').select2({
    language: {
      inputTooShort: function(args) {
        // args.minimum is the minimum required length
        // args.input is the user-typed text
        return "Por favor, digite 3 ou mais caracteres";
      },
      errorLoading: function() {
        return "Erro ao carregar resultados";
      },
      loadingMore: function() {
        return "Carregando mais resultados";
      },
      noResults: function() {
        return "Nenhum resultado encontrado";
      },
      searching: function() {
        return "Carregando...";
      },
      maximumSelected: function(args) {
        // args.maximum is the maximum number of items the user may select
        return "Error loading results";
      }
    },
    placeholder: 'Selecione uma opção'
  });
  //Date dd/mm/yyyy
  $('.date_format').mask('00/00/0000');
  $('button#btn_limpar').click(function(){
    $('input[type="text"]').val('');
    $('select').val(null).trigger('change');
  });
  $('div#modal_atestacao').on('hide.bs.modal', function(){
    $('label.error').remove();
    $('textarea#justificativa_a').val('');
    $('button.btn_principal, div#div_justificativa').hide();
  });
  $('button#btn_cancelar').click(function(){
    $('label.error').remove();
    $('textarea#justificativa_a').val('');
    $('button.btn_principal, div#div_justificativa').hide();
    $('div#modal_atestacao').modal('hide');
  });
  $('button#btn_fechar').click(function(){
    $('div#modal_verificacao').modal('hide');
  });
  $('select[multiple]').on('select2:select', function (e) {
    var valSelect = $(this).val();
    var lastValSelected = e.params.data.id;
    if (valSelect.length > 1) {
      if (lastValSelected == '0') {
        $(this).val(0).trigger('change');
      } else {
        valSelect = valSelect.splice((valSelect.indexOf('0')+1));
        valSelect = JSON.stringify(valSelect);
        $(this).val(JSON.parse(valSelect)).trigger('change');
      }
    }
  });
});

function btnVerificarRegistro(elem){
  $('input#btn_id').val($(elem).parents('tr').find('input#td_id').val()).attr('contrato', $(elem).parents('tr').find('input#td_contrato').val());
  $('div#div_contrato').find('p').html($(elem).parents('tr').find('input#td_contrato').val());
  $('div#div_matricula').find('p').html($(elem).parents('tr').find('input#td_matricula').val());
  $('div#div_nome').find('p').html($(elem).parents('tr').find('input#td_nome').val());
  $('div#div_situacao').find('p').html($(elem).parents('tr').find('input#td_situacao').val());
  $('div#div_uo').find('p').html($(elem).parents('tr').find('input#td_uo').val());
  $('div#div_setor').find('p').html($(elem).parents('tr').find('input#td_setor').val());
  $('div#div_serv_tipo').find('p').html($(elem).parents('tr').find('input#td_serv_tipo').val());
  $('div#div_cargo').find('p').html($(elem).parents('tr').find('input#td_cargo').val());
}

function btnAtestacaoRegistro(elem, tipo){
  $('input#btn_id').val($(elem).parents('tr').find('input#td_id').val()).attr('contrato', $(elem).parents('tr').find('input#td_contrato').val());
  $('div#div_contrato').find('p').html($(elem).parents('tr').find('input#td_contrato').val());
  $('div#div_matricula').find('p').html($(elem).parents('tr').find('input#td_matricula').val());
  $('div#div_nome').find('p').html($(elem).parents('tr').find('input#td_nome').val());
  $('div#div_situacao').find('p').html($(elem).parents('tr').find('input#td_situacao').val());
  $('div#div_uo').find('p').html($(elem).parents('tr').find('input#td_uo').val());
  $('div#div_setor').find('p').html($(elem).parents('tr').find('input#td_setor').val());
  $('div#div_serv_tipo').find('p').html($(elem).parents('tr').find('input#td_serv_tipo').val());
  $('div#div_cargo').find('p').html($(elem).parents('tr').find('input#td_cargo').val());
  if (tipo == 'atesta') {
    $('button#btn_atestar').show();
  } else {
    $('button#btn_recusar, div#div_justificativa').show();
  }
}

function btnAtestar(elem){
  var id = $('input#btn_id').val();
  var contrato = $('input#btn_id').attr('contrato');
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/atestacao/atestar_servidor",
    type: "POST",
    data: {id: id, contrato: contrato},
    enctype: 'multipart/form-data',
    success: function(data){
      onSuccessSendAtestar(data);
    },
    error: onError
  });
  return false;
}

function btnRecusar(elem){
  $('label.error').remove();
  var obs = $('textarea#justificativa_a').val();
  if (obs.length >= 5) {
    var id = $('input#btn_id').val();
    var contrato = $('input#btn_id').attr('contrato');
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/atestacao/recusar_atestar_servidor",
      type: "POST",
      data: {id: id, obs: obs, contrato: contrato},
      enctype: 'multipart/form-data',
      success: function(data){
        onSuccessSendAtestar(data);
      },
      error: onError
    });
  } else {
    $('div#div_justificativa').after('<div><label class="error danger">A justificativa é obrigatória e deve conter um mínimo de 5 caracteres.</label></div>');
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

// SUCCESS AO ENIVAR AJAX
function onSuccessSendAtestar(obj, op) {
  if (obj.msg == 'success') {
    $('div#modal_atestacao').modal('hide');
    swal.fire('Sucesso', obj.retorno, 'success');
    postToURL(PORTAL_URL + "view/rh/atestacao/dashboard");
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}