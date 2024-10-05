$(document).ready(function() {
  //CPF 999.999.999-99
  $('.cpf_format').mask('000.000.000-00');
  // Initialize Select2
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
  $('#form_servidor_novo').submit(function(e) {
    e.preventDefault();
    var servidor_valido = servidor_validator();
    if (servidor_valido) {
      $.ajax({ 
        type : "POST", 
        url : 'model/seg/servidor/salvar_servidor', 
        data : $('#form_servidor_novo').serialize(), 
        cache : false, 
        success : function(obj) {
          var servidor_zatu_id = $('input#servidor_zatu_id').val();
          var urlanterior = $('input#url_anterior').val();
          obj = JSON.parse(obj);
          if (obj.id == servidor_zatu_id) {
            if (urlanterior != '') {
              var urlPartes = urlanterior.split('/');
              urlNova = urlanterior.replace(urlPartes[(urlPartes.length-1)], 'dashboard');
              window.location = urlNova;
              return false;
            }
          }
          if (obj.msg == 'success') {
            swal.fire('Sucesso', 'Registro realizado com sucesso!', 'success');
            location.href='servidor_login';
          } else if (obj.msg == 'error') {
            if (obj.tipo == 'status') {
              swal.fire('Erro', obj.retorno.status, 'error');
              location.href='servidor_login';
            } else {
              if (obj.tipo == 'email') {
                $('div#div_email').after('<label class="error danger">' + obj.retorno.email + '</label>');
              } else if (obj.tipo == 'nome') {
                $.each(obj.retorno, function(k, v){
                  $('div#div_repetir_senha').after('<label class="error danger">' + v + '</label>');
                });
              } else if (obj.tipo == 'registro'){
                $('div#div_repetir_senha').after('<label class="error danger">' + obj.retorno + '</label>');
              } else {
                $('div#div_repetir_senha').after('<label class="error danger">' + obj.retorno + '</label>');
              }
            }
            return false;
          }
        }, error : function(obj) {
          $.prompt(obj);
        } 
      });
    } else {
      return false;
    }
  });
  $('input#senha').keyup(function(){
    var valLength = $(this).val().length;
    if (valLength > 0) {
      $('div.help-info').slideDown();
    } else {
      $('div.help-info').slideUp();
    }
  });
});
// VALIDATOR DO LOGIN
function servidor_validator() {
  var valido        = true;
  var nome          = $("input#nome").val();
  var nomeMae       = $("input#mae_mome").val();
  var cpf           = $("input#cpf").val();
  var matricula     = $("input#matricula").val();
  var uo            = $("select#uo").val();
  var setor         = $("select#setor").val();
  var email         = $("input#email").val();
  var repetirEmail  = $("input#repetir_email").val();
  var senha         = $("input#senha").val();
  var repetirSenha  = $("input#repetir_senha").val();
  // LIMPA MENSAGENS DE ERRO
  $('label.error').remove();
  // VERIFICANDO SE OS CAMPOS LOGIN E SENHA FORAM INFORMADOS
  if (nome == "") {
    $('div#div_nome').after('<label class="error danger">O campo nome é obrigatório.</label>');
    valido = false;
  }
  if (cpf == "") {
    $('div#div_cpf').after('<label class="error danger">O campo cpf é obrigatório.</label>');
    valido = false;
  }
  if (!validaCPF(cpf)) {
    $('div#div_cpf').after('<label class="error danger">O cpf não é válido.</label>');
    valido = false;
  }
  if (matricula == "") {
    $('div#div_matricula').after('<label class="error danger">O campo matricula é obrigatório.</label>');
    valido = false;
  }
  if (nomeMae == "") {
    $('div#div_mae_nome').after('<label class="error danger">O campo nome da mãe é obrigatório.</label>');
    valido = false;
  }
  if (email == "") {
    $('div#div_email').after('<label class="error danger">O campo e-mail é obrigatório.</label>');
    valido = false;
  }
  if (repetirEmail == "") {
    $('div#div_repetir_email').after('<label class="error danger">O campo repetir e-mail é obrigatório.</label>');
    valido = false;
  }
  if (repetirEmail != email) {
    $('div#div_repetir_email').after('<label class="error danger">O campo "repetir e-mail" deve ser igual ao campo "e-mail.</label>');
    valido = false;
  }
  if (senha == "") {
    $('div#div_senha').after('<label class="error danger">O campo senha é obrigatório.</label>');
    valido = false;
  }
  if (repetirSenha == "") {
    $('div#div_repetir_senha').after('<label class="error danger">O campo repetir senha é obrigatório.</label>');
    valido = false;
  }
  if (repetirSenha != senha) {
    $('div#div_repetir_senha').after('<label class="error danger">O campo "repetir senha" deve ser igual ao campo "senha".</label>');
    valido = false;
  }
  return valido;
}
// ERRO AO ENVIAR AJAX
function onError(obj) {
  swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, informe esse erro ao suporte.", 'error');
  console.log('onError: ' + JSON.stringify(obj));
  return false;
}
function showSenha() {
  $('#togglePass').attr('onclick', 'hideSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#senha').attr("type", 'text');
}
function hideSenha() {
  $('#togglePass').attr('onclick', 'showSenha();').find("i").attr('class', 'fas fa-eye');
  $('#senha').attr("type", 'password');
}
function showRepeteSenha() {
  $('#togglePassRepete').attr('onclick', 'hideRepeteSenha();').find("i").attr('class', 'fas fa-eye-slash');
  $('#repetir_senha').attr("type", 'text');
}
function hideRepeteSenha() {
  $('#togglePassRepete').attr('onclick', 'showRepeteSenha();').find("i").attr('class', 'fas fa-eye');
  $('#repetir_senha').attr("type", 'password');
}