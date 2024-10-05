$(document).ready(function () {
  $('#form_nova_senha').submit(function () {
    var cadastro_valido = cadastro_validator();
    if (cadastro_valido) {
      $.ajax({
        type: "POST",
        url: PORTAL_URL+'nova_senha_efetivar',
        data: $('#form_nova_senha').serialize(),
        cache: false,
        success: function (obj) {
          obj = JSON.parse(obj);
          if (obj.msg == 'success') {
            $('div#alert_sucesso').show('slow');
            setTimeout("location.href='"+PORTAL_URL+"login'", 6000);
          } else if (obj.msg == 'error') {
            $('div#div_nova_senha').after('<label id="erro_senha" class="alert alert-danger">' + obj.retorno + '</label>');
          }
        },
        error: function (obj) {
          $.prompt(obj.retorno);
        }
      });
      return false;
    } else {
      return false;
    }
  });
});
//VALIDATOR DO CADASTRO
function cadastro_validator() {
  var valido = true;
  var confirmasenha = $("#nova_senha").val();
  var senha = $("#repete_nova_senha").val();
  //LIMPA MENSAGENS DE ERRO
  $('label#erro_senha').remove();
  $('label#erro_nova_senha').remove();
  $('label#erro_repete_nova_senha').remove();
  //VERIFICANDO SE OS CAMPOS LOGIN E SENHA FORAM INFORMADOS
  if (senha == "") {
    $('div#div_nova_senha').after('<label id="erro_nova_senha" class="alert alert-danger">O campo senha é obrigatório.</label>');
    valido = false;
  }
  if (confirmasenha == "") {
    $('div#div_repete_nova_senha').after('<label id="erro_repete_nova_senha" class="alert alert-danger">O campo confirmar senha é obrigatório.</label>');
    valido = false;
  }
  if (senha != "" && confirmasenha != "" && senha != confirmasenha) {
    $('div#div_nova_senha').after('<label id="erro_nova_senha" class="alert alert-danger">A senha e a confirmação de senha não coincidem.</label>');
    $('div#div_repete_nova_senha').after('<label id="erro_repete_nova_senha" class="alert alert-danger">A senha e a confirmação de senha não coincidem.</label>');
    valido = false;
  }
  return valido;
}
function showSenha() {
  $('#togglePass').attr('onclick', 'hideSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#nova_senha').attr("type", 'text');
}
function hideSenha() {
  $('#togglePass').attr('onclick', 'showSenha();').find("i").attr('class', 'fas fa-eye');
  $('#nova_senha').attr("type", 'password');
}
function showRepeteSenha() {
  $('#togglePassRepete').attr('onclick', 'hideRepeteSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#repete_nova_senha').attr("type", 'text');
}
function hideRepeteSenha() {
  $('#togglePassRepete').attr('onclick', 'showRepeteSenha();').find("i").attr('class', 'fas fa-eye');
  $('#repete_nova_senha').attr("type", 'password');
}