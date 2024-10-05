//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO

$(document).ready(function () {

});

function btnResetar(elem){
  Swal.fire({
    title: 'Tens certeza de que deseja resetar a senha deste servidor?',
    text: "Este processo não poderá ser desfeito!",
    icon: 'question',
    showCancelButton: true,
    // confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, resetar!',
    cancelButtonText: 'Cancelar!'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(elem).parents('tr').children('input#td_id').val();
      projetouniversal.util.getjson({
        url: PORTAL_URL + "model/rh/servidor/resetar_senha",
        type: "POST",
        data: {id: id},
        enctype: 'multipart/form-data',
        success: function(data){
          onSuccessResetaSenha(data)
        },
        error: onError
      });
    }
  })
};

function btnEditar(elem){
  var nome = $(elem).parents('tr').children('td#td_nome').text();
  var email = "";
  var email2 = "";
  Swal.fire({
    title: 'Informe o novo e-mail do(a) servidor(a) '+nome+':',
    input: 'email',
    inputAutoFocus: true,
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Continuar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    preConfirm: (input_email) => {
      email = input_email;
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Informe novamente o novo e-mail do(a) servidor(a) '+nome+':',
        input: 'email',
        inputAutoFocus: true,
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (input_email2) => { 
          email2 = input_email2;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          if (email == null || email == "" || email2 == null || email2 == "") {
            swal.fire('Atenção', 'Os endereços de e-mail não foram preenchidos corretamente.', 'warning');
          } else if (email != email2) {
            swal.fire('Atenção', 'Os endereços de e-mail informados não são iguais.', 'warning');
          } else {
            var id = $(elem).parents('tr').children('input#td_id').val();
            Swal.fire({
              title: 'Tens certeza de alterar o e-mail de acesso deste(a) servidor(a)?',
              text: "Este processo não poderá ser desfeito!",
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Sim, alterar!',
              cancelButtonText: 'Cancelar!'
            }).then((result) => {
              if (result.isConfirmed) {
                var id = $(elem).parents('tr').children('input#td_id').val();
                projetouniversal.util.getjson({
                  url: PORTAL_URL + "model/rh/servidor/alterar_email_acesso",
                  type: "POST",
                  data: {id: id, email: email},
                  enctype: 'multipart/form-data',
                  success: function(data){
                    onSuccessAlteraEmailAcesso(data)
                  },
                  error: onError
                });
              }
            })
          }
        }
      });
    }
  });
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
function onSuccessResetaSenha(obj) {
  if (obj.msg == 'success') {
    swal.fire('Sucesso', obj.retorno, 'success');
  } else if (obj.msg == 'error') {
    swal.fire('Erro', obj.retorno, 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}
// SUCCESS AO ENIVAR AJAX
function onSuccessAlteraEmailAcesso(obj) {
  if (obj.msg == 'success') {
    swal.fire('Sucesso', obj.retorno, 'success');
  } else if (obj.msg == 'error') {
    swal.fire('Erro', obj.retorno, 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}