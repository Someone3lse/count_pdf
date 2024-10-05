//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function(e) {
  if ($('#nome_s').val() == '' && $('#dt_nasc_s').val() == '' && $('#cpf_s').val() == '') {
    window.onbeforeunload = null;
  } else {
    return true;
  }
};
$(document).ready(function() {
  // var enableAllSteps = $('input#enableAllSteps').val()  == 1 ? true : false;
  var enableAllSteps = false;
  $(".tab-wizard").steps({
    /* Appearance */
    headerTag: "strong",
    bodyTag: "section",
    contentContainerTag: "div",
    actionContainerTag: "div",
    stepsContainerTag: "div",
    cssClass: "wizard wizard_bira",
    stepsOrientation: $.fn.steps.stepsOrientation.horizontal,
    /* Templates */
    titleTemplate: '<strong>#title#</strong>',
    // titleTemplate: '<strong><span id="step-#index#" class="step">#index#</span> #title#</strong>',
    loadingTemplate: '<span class="spinner"></span> #text#',
    /* Behaviour */
    autoFocus: true,
    enableAllSteps: enableAllSteps,
    enableKeyNavigation: true,
    enablePagination: false,
    suppressPaginationOnFocus: true,
    enableContentCache: true,
    enableCancelButton: false,
    enableFinishButton: false,
    preloadContent: false,
    showFinishButtonAlways: false,
    forceMoveForward: false,
    saveState: false,
    startIndex: 0,
    /* Transition Effects */
    transitionEffect: "slide",
    transitionEffectSpeed: 200,
    /* Events */
    // Antes de mudar etapa
    // onStepChanging: function (event, currentIndex, newIndex) { 
    //   return true;
    // },
    // Após mudar etapa
    // onStepChanged: function (event, currentIndex, priorIndex) { 
      // return true; 
    // }, 
    // Após clicar em cancelar
    // onCanceled: function (event) {
    // },
    // Antes de finalizar (return true ou false;);
    // onFinishing: function (event, currentIndex) {
      // return true;
    // }, 
    // Após finalizar;
    // onFinished: function (event, currentIndex) {
    // },
    /* Labels */
    labels: {
      cancel: 'Cancelar',
      current: "etapa atual:",
      pagination: "Paginação",
      previous: "Anterior",
      next: "Próximo",
      finish: "Cadastrar",
      loading: "Carregando..."
    },
    onFinished: function(event, currentIndex) {
      swal("Your Order Submitted!", "Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.");
    }
  });
  $('#btn_voltar').click(function(){
    window.history.back();
  });
  $('#btn_cancelar').click(function(){
    window.onbeforeunload = null;
    var servidorId = $('form.servidor_id').val();
    if (servidorId == 0){
      Swal.fire({
        title: 'Desejas cadastrar um novo servidor?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor/dashboard');
        }
      })
    } else {
      Swal.fire({
        title: 'Desejas reiniciar a edição do cadastro do servidor?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, reiniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar', {id: servidorId});
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor/dashboard');
        }
      })
    }
  });
  $('#btn_anterior').click(function(){
    var stepValido = false;
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      stepValido = salvarServidorPessoal();
    } else if (currentIndex == 1) {
      stepValido = salvarServidorContato();
    } else if (currentIndex == 2) {
      stepValido = salvarServidorDocumento();
    } else if (currentIndex == 3) {
      stepValido = salvarServidorInstrucao();
    } else if (currentIndex == 4) {
      stepValido = salvarServidorFamiliar();
    } else if (currentIndex == 5) {
      stepValido = salvarServidorDependente();
    } else if (currentIndex == 6) {
      stepValido = salvarServidorBancario();
    } else if (currentIndex == 7) {
      stepValido = salvarServidorVinculo();
    } else if (currentIndex == 8) {
      stepValido = salvarServidorObs();
    } else if (currentIndex == 9) {
      stepValido = salvarServidorSaude();
    }
    if (stepValido) {
      $('.tab-wizard').steps('previous');
    }
  });
  $('#btn_proximo').click(function(){
    var stepValido = false;
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      stepValido = salvarServidorPessoal();
    } else if (currentIndex == 1) {
      stepValido = salvarServidorContato();
    } else if (currentIndex == 2) {
      stepValido = salvarServidorDocumento();
    } else if (currentIndex == 3) {
      stepValido = salvarServidorInstrucao();
    } else if (currentIndex == 4) {
      stepValido = salvarServidorFamiliar();
    } else if (currentIndex == 5) {
      stepValido = salvarServidorDependente();
    } else if (currentIndex == 6) {
      stepValido = salvarServidorBancario();
    } else if (currentIndex == 7) {
      stepValido = salvarServidorVinculo();
    } else if (currentIndex == 8) {
      stepValido = salvarServidorObs();
    } else if (currentIndex == 9) {
      stepValido = salvarServidorSaude();
      if (stepValido) {
        Swal.fire({
          title: 'Desejas cadastrar um novo servidor?',
          text: "",
          icon: 'question',
          showCancelButton: true,
          // confirmButtonColor: '#3085d6',
          // cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, iniciar!',
          cancelButtonText: 'Não, obrigado!'
        }).then((result) => {
          if (result.isConfirmed) {
            postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
          } else {
            postToURL(PORTAL_URL + 'view/rh/servidor/dashboard');
          }
        })
      }
    }
    if (stepValido) {
      $('.tab-wizard').steps('next');
    }
  });
  $('#btn_finalizar').click(function(){
    window.onbeforeunload = null;
    var stepValido = false;
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      stepValido = salvarServidorPessoal();
    } else if (currentIndex == 1) {
      stepValido = salvarServidorContato();
    } else if (currentIndex == 2) {
      stepValido = salvarServidorDocumento();
    } else if (currentIndex == 3) {
      stepValido = salvarServidorInstrucao();
    } else if (currentIndex == 4) {
      stepValido = salvarServidorFamiliar();
    } else if (currentIndex == 5) {
      stepValido = salvarServidorDependente();
    } else if (currentIndex == 6) {
      stepValido = salvarServidorBancario();
    } else if (currentIndex == 7) {
      stepValido = salvarServidorVinculo();
    } else if (currentIndex == 8) {
      stepValido = salvarServidorObs();
    } else if (currentIndex == 9) {
      stepValido = salvarServidorSaude();
    }
    if (stepValido) {
      Swal.fire({
        title: 'Desejas cadastrar um novo servidor?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor/dashboard');
        }
      })
    }
  });
  // Validation do template
  // $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  // Fim Validation do template
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
  $(".select2_naturalidade, .select2_conjuge_naturalidade, .select2_eleitor_cidade, .select2_reg_civ_cidadae, .select2_averbacao_cidade").select2({
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
    ajax: {
      url: PORTAL_URL + "model/bsc/municipio/get_municipios_estados",
      dataType: 'json',
      type: "post",
      delay: 150,
      data: function(params) {
        return {
          nome: params.term // search term
        };
      },
      processResults: function(data, params) {
        return {
          results: data.itens
        };
      }
    },
    placeholder: 'Selecione uma opção',
    minimumInputLength: 3,
    cache: true
  });
  //Date dd/mm/yyyy
  $('.date_format').mask('00/00/0000');
  //CPF 999.999.999-99
  $('.cpf_format').mask('000.000.000-00');
  //Telefone (68)3222-2222
  $('.tel_format').mask('(00)0000-0000');
  //Celular (68)9.9999-9999
  $('.cel_format').mask('(00)9.0000-0000');
  //CEP 69.900-000
  $('.cep_format').mask('00.000-000');
  //Flat red color scheme for iCheck
  $('.ichack-input input[type="radio"].square-purple').iCheck({
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
  });
  $('input[name="sexo_s"]').on('ifChecked', function(event){
    var val = $(this).val();
    if (val == 'F') {
      $('input#reg_militar_numero_s').val('');
      $('input#reg_militar_categoria_s').val('');
      $('input#reg_militar_emissao_ano_s').val('');
      $('input#reg_militar_orgao_expedidor_s').val('');
      $('input#reg_militar_especie_s').val('');
      $('div#div_registro_militar').hide();
    } else {
      $('div#div_registro_militar').show();
    }
    return false;
  });
  $('select#nacionalidade_s').change(function() {
    naturalEstrangeiroControle($(this));
    return false;
  });
  $('select#conjuge_nacionalidade_s').change(function() {
    naturalConjugeEstrangeiroControle($(this));
    return false;
  });
  //Carregando Select Municipio
  $('select#end_estado_s').change(function(){
    var id = $(this).val();
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/bsc/municipio/get_municipios",
      type: "POST",
      data: {id: id},
      enctype: 'multipart/form-data',
      success: onSuccessSendGetMunicipiosContato,
      error: onError
    });
    return false;
  });
  //Carregando Select Setores
  $('select#uo_s').change(function(){
    var id = $(this).val();
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/eo/setor/get_setores",
      type: "POST",
      data: {id: id},
      enctype: 'multipart/form-data',
      success: onSuccessSendGetSetoresPessoal,
      error: onError
    });
    return false;
  });
  //Carregando Select Setores
  $('select#uo_2_s').change(function(){
    var id = $(this).val();
    projetouniversal.util.getjson({
      url: PORTAL_URL + "model/eo/setor/get_setores",
      type: "POST",
      data: {id: id},
      enctype: 'multipart/form-data',
      success: onSuccessSendGetSetoresPessoal2,
      error: onError
    });
    return false;
  });
  $('select#nacionalidade_s').change(function(){
    var val = $(this).val();
    if (val == 1 || val == '') {
      $('input#nat_est_cidade_S').val('');
      $('input#nat_est_estado_s').val('');
      $('input#nat_est_dt_ingresso_s').val('');
      $('input#nat_est_cond_trabalho_s').val('');
      $('div#div_naturalide_extrangeiro').slideUp();
      $('div#div_naturalide_nacional').slideDown();
    } else {
      $('select#naturalidade_s').val(null).trigger('change');
      $('div#div_naturalide_nacional').slideUp();
      $('div#div_naturalide_extrangeiro').slideDown();
    }
    return false;
  });

  $('select#sit_trab_s').change(function(){
    var val = $(this).val();
    if (val == 1 || val == '') {
      $('input#sit_decreto_s').val('');
      $('input#sit_doe_s').val('');
      $('input#sit_dt_inicio_s').val('');
      $('input#sit_dt_fim_s').val('');
      $('textarea#sit_obs_s').val('');
      $('div#div_sit_trab_1').slideUp();
    } else {
      $('div#div_sit_trab_1').slideDown();
    }
    return false;
  });
  $('input#matricula_2_s').keyup(function(){
    var val = $(this).val().length;
    if (val <= 0) {
      $('select#empregador_2_s').val(null).trigger('change');
      $('select#uo_2_s').val(null).trigger('change');
      $('select#setor_atual_2_s').val(null).trigger('change');
      $('select#servidor_tipo_2_s').val(null).trigger('change');
      $('select#cargo_2_s').val(null).trigger('change');
      $('select#sit_trab_2_s').val(null).trigger('change');
      $('div#div_matricula_2').slideUp();
    } else {
      $('div#div_matricula_2').slideDown();
    }
    return false;
  });
  $('select#sit_trab_2_s').change(function(){
    var val = $(this).val();
    if (val == 1 || val == '') {
      $('input#sit_decreto_2_s').val('');
      $('input#sit_doe_2_s').val('');
      $('input#sit_dt_inicio_2_s').val('');
      $('input#sit_dt_fim_2_s').val('');
      $('textarea#sit_obs_2_s').val('');
      $('div#div_sit_trab_2').slideUp();
    } else {
      $('div#div_sit_trab_2').slideDown();
    }
    return false;
  });
  $('input[name="estrang_casado_brasileiro_s"], input[name="estrang_filho_brasileiro_s"]').on('ifClicked', function(event){
    var initialChecked = $(this).is(':checked');
    if(initialChecked){
      $(this).iCheck('uncheck');
    }
  });
  $('select#est_civ_s').change(function(){
    var val = $(this).val();
    if (val == 1 || val == '') {
      $('textarea#reg_civ_cidade_s').val(null).trigger('change');
      $('textarea#conjuge_nacionalidade_s').val(null).trigger('change');
      $('textarea#conjuge_naturalidade_s').val(null).trigger('change');
      $('input#conjuge_dt_casam_s').val('');
      $('input#conjuge_nome_s').val('');
      $('input#conjuge_cpf_s').val('');
      $('input#conjuge_dt_nasc_s').val('');
      $('input#conjuge_nat_est_cidade_s').val('');
      $('input#conjuge_nat_est_estado_s').val('');
      $('input#conjuge_local_trabalho_s').val('');
      $('input#reg_civ_num_s').val('');
      $('input#reg_civ_dt_expedicao_s').val('');
      $('input#reg_civ_livro_s').val('');
      $('input#reg_civ_folha_s').val('');
      $('input#reg_civ_cartorio_s').val('');
      // $('div#div_reg_civil').slideUp();
      $('div#div_dados_civis').slideUp();
    } else {
      $('textarea#conjuge_nacionalidade_s').val(null).trigger('change');
      $('div#div_conjuge_nacional').slideUp();
      $('div#div_conjuge_extranjero').slideUp();
      $('div#div_dados_civis').slideDown();
      // $('div#div_reg_civil').slideDown();
    }
    if (val != 5) {
      $('textarea#averbacao_cidade_s').val(null).trigger('change');
      $('input#averbacao_tipo_s').val('');
      $('input#averbacao_num_s').val('');
      $('input#averbacao_dt_expedicao_s').val('');
      $('input#averbacao_cartorio_s').val('');
      $('div#div_averbacao').slideUp();
    } else {
      $('div#div_averbacao').slideDown();
    }
    return false;
  });
  $('select#conjuge_nacionalidade_s').change(function(){
    var val = $(this).val();
    if (val == 1 || val == '') {
      $('input#conjuge_nat_est_cidade_s').val('');
      $('input#conjuge_nat_est_estado_s').val('');
      $('div#div_conjuge_extranjero').slideUp();
      $('div#div_conjuge_nacional').slideDown();
    } else {
      $('select#conjuge_naturalidade_s').val(null).trigger('change');
      $('div#div_conjuge_nacional').slideUp();
      $('div#div_conjuge_extranjero').slideDown();
    }
    return false;
  });
  //Carregando div beneficiario
  $('input.dependente_benef_s').on('ifChecked', function(event){
    if ($(this).val() == 'S') {
      $(this).parents('div#div_benef').find('div#div_benef_dados').removeAttr('style');
    } else {
      $(this).parents('div#div_benef').find('div#div_benef_dados').attr('style', 'display: none;');
    }
    return false;
  });
  //Carregando div beneficiario
  $('input.dependente_benef_repres_s').on('ifChecked', function(event){
    if ($(this).val() == 'S') {
      $(this).parents('div#div_repres').find('div#div_repres_dados').removeAttr('style');
    } else {
      $(this).parents('div#div_repres').find('div#div_repres_dados').attr('style', 'display: none;');
    }
    return false;
  });
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
function benefCarregaMun(elem){
  var id = $(elem).val();
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/bsc/municipio/get_municipios",
    type: "POST",
    data: {id: id},
    enctype: 'multipart/form-data',
    success: function(obj){
      if (obj.msg == 'success') {
        $(elem).parents('div.row').find('select[name="dependente_benef_end_municipio_s[]"]').val(null).trigger('change');
        $(elem).parents('div.row').find('select[name="dependente_benef_end_municipio_s[]"]').html(obj.retorno);
        $(elem).parents('div.row').find('select[name="dependente_benef_end_municipio_s[]"]s').select2({
          placeholder: 'Selecione uma opção'
        });
      } else if (obj.msg == 'error') {
        swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
        console.log('Error: ' + obj.retorno);
      }
    },
    error: onError
  });
  return false;
}
function benefRepresCarregaMun(elem){
  var id = $(elem).val();
  projetouniversal.util.getjson({
    url: PORTAL_URL + "model/bsc/municipio/get_municipios",
    type: "POST",
    data: {id: id},
    enctype: 'multipart/form-data',
    success: function(obj){
      if (obj.msg == 'success') {
        $(elem).parents('div.row').find('select[name="dependente_benef_repres_end_municipio_s[]"]').val(null).trigger('change');
        $(elem).parents('div.row').find('select[name="dependente_benef_repres_end_municipio_s[]"]').html(obj.retorno);
        $(elem).parents('div.row').find('select[name="dependente_benef_repres_end_municipio_s[]"]').select2({
          placeholder: 'Selecione uma opção'
        });
      } else if (obj.msg == 'error') {
        swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
        console.log('Error: ' + obj.retorno);
      }
    },
    error: onError
  });
  return false;
}
function benefClick(elem){
  if ($(elem).find('input').val() == 'S') {
    $(elem).parents('div#div_benef').find('div#div_benef_dados').removeAttr('style');
  } else {
    $(elem).parents('div#div_benef').find('div#div_benef_dados').attr('style', 'display: none;');
  }
  return false;
}
function benefClickIns(elem){
  if ($(elem).parent().find('input').val() == 'S') {
    $(elem).parents('div#div_benef').find('div#div_benef_dados').removeAttr('style');
  } else {
    $(elem).parents('div#div_benef').find('div#div_benef_dados').attr('style', 'display: none;');
  }
  return false;
}
function represClick(elem){
  if ($(elem).find('input').val() == 'S') {
    $(elem).parents('div#div_repres').find('div#div_repres_dados').removeAttr('style');
  } else {
    $(elem).parents('div#div_repres').find('div#div_repres_dados').attr('style', 'display: none;');
  }
  return false;
}
function represClickIns(elem){
  if ($(elem).parent().find('input').val() == 'S') {
    $(elem).parents('div#div_repres').find('div#div_repres_dados').removeAttr('style');
  } else {
    $(elem).parents('div#div_repres').find('div#div_repres_dados').attr('style', 'display: none;');
  }
  return false;
}
function createSelect2Model(obj){
  $(obj).select2({
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
}
function createICkeckModel(){
  //Flat red color scheme for iCheck
  $('form#form_servidor_instrucao, form#form_servidor_dependente').find('.ichack-input input[type="radio"].square-purple').iCheck({
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
  });
}
function elementosFormatar(){
  //Date dd/mm/yyyy
  $('.date_format').mask('00/00/0000');
  //CPF 999.999.999-99
  $('.cpf_format').mask('000.000.000-00');
  //Telefone (68)3222-2222
  $('.tel_format').mask('(00)0000-0000');
  //Celular (68)9.9999-9999
  $('.cel_format').mask('(00)9.0000-0000');
  //CEP 69.900-000
  $('.cep_format').mask('00.000-000');
}