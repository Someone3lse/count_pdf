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
          var zatu_id = $('input#zatu_id').val();
          var urlanterior = $('input#url_anterior').val();
          obj = JSON.parse(obj);
          if (obj.id == zatu_id) {
            if (urlanterior != '') {
              var urlPartes = urlanterior.split('/');
              urlNova = urlanterior.replace(urlPartes[(urlPartes.length - 1)], 'dashboard');
              window.location = urlNova;
              return false;
            }
          }
          if (obj.msg == 'redefinir_senha') {
            postToURL(PORTAL_URL + 'redefinir_senha', { login: obj.login });
          } else if (obj.msg == 'success') {
            location.href = 'dashboard';
          } else if (obj.msg == 'error') {
            $('div#div_senha').after('<label id="erro_senha" class="error danger">' + obj.retorno + '</label>');
          }
        }, error: function (obj) {
          $.prompt(obj);
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
    $('div#div_login').after('<label class="error danger">O campo usuário é obrigatório.</label>');
    valido = false;
  }
  if (senha == "") {
    $('div#div_senha').after('<label class="error danger">O campo senha é obrigatório.</label>');
    valido = false;
  }
  return valido;
}

// "use strict";
// const input = document.querySelector("input");
// const button = document.querySelector("#togglePass");
// button.addEventListener('click', togglePass);

// function togglePass() {
//   if (input.type == "password") {
//     input.type = "text";
//     $("#togglePass i").addClass("fa-eye");
//     $("#togglePass i").removeClass("fa-eye-slash");
//   } else {
//     input.type = "password";
//     $("#togglePass i").removeClass("fa-eye");
//     $("#togglePass i").addClass("fa-eye-slash");
//   }
// }
function showSenha() {
  $('#togglePass').attr('onclick', 'hideSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#senha').attr("type", 'text');
}
function hideSenha() {
  $('#togglePass').attr('onclick', 'showSenha();').find("i").attr('class', 'fas fa-eye');
  $('#senha').attr("type", 'password');
}
