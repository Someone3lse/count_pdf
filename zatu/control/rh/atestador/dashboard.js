//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function (e) {
  if ($('#usuario').val() == '') {
    window.onbeforeunload = null;
  } else {
    return true;
  }
};

$(document).ready(function () {
  //Initialize Select2 Elements
  $('.select2').select2({
    placeholder: 'Selecione uma opção'
  });
  //SALVANDO DADOS DO FORMULÁRIO DE PROJETO
  $('#form_atestador').submit(function () {
    window.onbeforeunload = null;
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/rh/atestador/salvar_atestador",
      type: "POST",
      data: $('#form_atestador').serialize(),
      enctype: 'multipart/form-data',
      success: onSuccessSend,
      error: onError
    });
    return false;
  });

  function onSuccessSend(obj) {
    if (obj.msg == 'success') {
      postToURL(PORTAL_URL + 'view/rh/atestador/dashboard', {mensagem: obj.retorno});
    } else if (obj.msg == 'error') {
      if (obj.tipo == 'nome') {
        swal.fire('Erro', obj.retorno, 'error');
      } else {
        swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
        console.log('Error: ' + obj.retorno);
      }
      return false;
    }
  }

  $("#btn_cancelar").click(function(){
    $('#id').val('');
    $('span#titulo_form').text(' NOVO ATESTADOR');
    $('span#btn_submit').text(' Cadastrar');
    $("select#usuario").val('').trigger('change');
    carregaSetores('');
  });

  //Initialize Select2 Elements
  $('.select2').select2({
    placeholder: 'Selecione uma opção'
  });

  $('select#usuario').change(function(){
    window.onbeforeunload = null;
    var id = $(this).val();
    carregaSetores(id);
    return false;
  });
  //Date dd/mm/yyyy
  $('.date_format').mask('00/00/0000');

});

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

function carregaSetores(id){
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/rh/atestador/get_setores_by_uo",
    type: "POST",
    data: {id: id},
    enctype: 'multipart/form-data',
    success: onSuccessSendSetoresByUO,
    error: onError
  });
  return false;
}

function onSuccessSendSetoresByUO(obj) {
  if (obj.msg == 'success') {
    $('div#div_setores').html(obj.retorno);
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
    return false;
  }
}

function onSuccessSendExcluir(obj) {
  if (obj.msg == 'success') {
    postToURL(PORTAL_URL + 'view/rh/atestador/dashboard', {mensagem: obj.retorno});
  } else if (obj.msg == 'error') {
    if (obj.tipo == 'nome') {
      swal.fire('Erro', obj.retorno, 'error');
    } else {
      swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
      console.log('Error: ' + obj.retorno);
    }
    return false;
  }
}

function btnExcluir(elem) {
  window.onbeforeunload = null;
  var negado = $(this).attr('negado');
  if ($(elem).attr('negado')) {
    swal.fire('Atenção', 'Este registro não pode ser exlcuido pois está vinculado a um recadastramento de servidor ou atualização de dados de um servidor!', 'warning');
  } else {
    Swal.fire({
      title: 'Tens certeza de excluir este registro?',
      text: "Este processo não poderá ser desfeito!",
      icon: 'question',
      showCancelButton: true,
    // confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar!'
    }).then((result) => {
      if (result.isConfirmed) {
        var id = $(elem).parents('tr').children('input#td_id').val();
        projetouniversal.util.getjson({
          url: PPORTAL_URL + "model/rh/atestador/excluir_atestador",
          type: "POST",
          data: {id: id},
          enctype: 'multipart/form-data',
          success: function(data){
            onSuccessSendExcluir(data)
          },
          error: onError
        });
      }
    })
  }
  return false;
};

function btnEditar(elem){
  editarRegistro(elem);
};

function editarRegistro(obj){
  $('span#titulo_form').text('EDIÇÃO DE CHEFE IMEDIATO');
  $('span#btn_submit').text(' Atualizar');
  var id = $(obj).parents('tr').children('input#td_id').val();
  $("input#id").val(id);
  $("select#usuario").val(id).trigger('change');
  carregaSetores(id);
  $('input#dt_inicio').val($(obj).parents('tr').children('input#td_dt_inicio').val());
  $('input#dt_fim').val($(obj).parents('tr').children('input#td_dt_fim').val());
  var status = $(obj).parents('tr').children('#td_status').attr('value') == 1 ? true : false;
  $("input#status_st").prop('checked', status);
  $('html, body').animate({scrollTop:86}, 'medium'); //slow, medium, fast
  return false;
}