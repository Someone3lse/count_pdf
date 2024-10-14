$(document).ready(function () {
  $('#form_login').submit(function () {
    var login_valido = login_validator();
    if (login_valido) {
      $.ajax({
        type: "POST",
        url: 'autenticar',
        data: $('#form_login').serialize(),
        cache: false,
        success: function (obj) {
          obj = JSON.parse(obj);
          if (obj.msg == 'success') {
            location.href = 'view/arquivo/pdf/dashboard';
          } else if (obj.msg == 'error') {
            $('div#div_senha').after('<label id="erro_senha" class="error fs-5 p-1 mb-3 text-primary-emphasis text-danger-emphasis bg-danger border border-danger-subtle rounded-3">' + obj.retorno + '</label>');
          }
        }, error: function (obj) {
          onError(obj);
        }
      });
      return false;
    } else {
      return false;
    }
  });
});
// VALIDATOR DO LOGIN
function login_validator() {
  var valido = true;
  var login = $("input#login").val();
  var senha = $("input#senha").val();
  // LIMPA MENSAGENS DE ERRO
  $('label.error').remove();
  // VERIFICANDO SE OS CAMPOS LOGIN E SENHA FORAM INFORMADOS
  if (login == "") {
    $('div#div_login').after('<label class="error p-1 mb-3 text-primary-emphasis bg-danger border border-danger-subtle rounded-3">O campo usuário é obrigatório.</label>');
    valido = false;
  }
  if (senha == "") {
    $('div#div_senha').after('<label class="error p-1 mb-3 text-primary-emphasis bg-danger border border-danger-subtle rounded-3">O campo senha é obrigatório.</label>');
    valido = false;
  }
  return valido;
}
function showSenha() {
  $('#togglePass').attr('onclick', 'hideSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#senha').attr("type", 'text');
}
function hideSenha() {
  $('#togglePass').attr('onclick', 'showSenha();').find("i").attr('class', 'fas fa-eye');
  $('#senha').attr("type", 'password');
}
// ERRO AO ENVIAR AJAX
function onError(obj) {
  console.log(obj);
  // if (obj.responseText == "logout") {
  //   swal.fire({title: 'Limite de tempo, sem ação, ultrapassado', text: "Você passou mais de 30 minutos sem ação no sistema e por isso deverá efetuar login novamente.", icon: 'error', confirmButtonText: 'Ok'})
  //   .then((result) => {
  //     postToURL(PORTAL_URL + (obj.responseText));
  //   });
  // } else {
    // swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, informe esse erro ao suporte.", 'error');
    console.log('onError: ' + JSON.stringify(obj));
  // }
  return false;
}