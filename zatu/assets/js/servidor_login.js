$(document).ready(function() {
  //CPF 999.999.999-99
  $('.cpf_format').mask('000.000.000-00');
  $('#form_servidor_login').submit(function() {
    var login_valido = login_validator();
    if (login_valido) {
      $.ajax({ 
        type : "POST", 
        url : 'servidor_autenticar', 
        data : $('#form_servidor_login').serialize(), 
        cache : false, 
        success : function(obj) {
          var zatu_id = $('input#servidor_zatu_id').val();
          var urlanterior = $('input#url_anterior').val();
          obj = JSON.parse(obj);
          if (obj.id == zatu_id) {
            if (urlanterior != '') {
              var urlPartes = urlanterior.split('/');
              urlNova = urlanterior.replace(urlPartes[(urlPartes.length-1)], 'servidor_dashboard');
              window.location = urlNova;
              return false;
            }
          }
          if(obj.msg == 'servidor_redefinir_senha') {
            postToURL(PORTAL_URL + 'servidor_redefinir_senha', {login: obj.login});
          } else if (obj.msg == 'success') {
            location.href='servidor_dashboard';
          } else if (obj.msg == 'error') {
            $('div#div_senha').after('<label class="error danger">' + obj.retorno + '</label>');
          }
        }, error : function(obj) {
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
  var login = $("input#servidor_login").val();
  var senha = $("input#servidor_senha").val();
  // LIMPA MENSAGENS DE ERRO
  $('label.error').remove();
  // VERIFICANDO SE OS CAMPOS LOGIN E SENHA FORAM INFORMADOS
  if (login == "") {
    $('div#div_login').after('<label class="error danger">O campo cpf é obrigatório.</label>');
    valido = false;
  }
  if (senha == "") {
    $('div#div_senha').after('<label class="error danger">O campo senha é obrigatório.</label>');
    valido = false;
  }
  return valido;
}
function showSenha() {
  $('#togglePass').attr('onclick', 'hideSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#servidor_senha').attr("type", 'text');
}
function hideSenha() {
  $('#togglePass').attr('onclick', 'showSenha();').find("i").attr('class', 'fas fa-eye');
  $('#servidor_senha').attr("type", 'password');
}