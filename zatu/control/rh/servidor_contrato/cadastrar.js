//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function(e) {
  if ($('select#servidor_sc').val() == '' && $('#numero_sc').val() == '' && $('#dt_publicacao_sc').val() == '') {
    window.onbeforeunload = null;
  } else {
    return true;
  }
};
$(document).ready(function() {
  $(".tab-wizard").steps({
    /* Appearance */
    headerTag: "strong",
    bodyTag: "section",
    contentContainerTag: "div",
    actionContainerTag: "div",
    stepsContainerTag: "div",
    cssClass: "wizard wizard_bira",
    stepsOrientation: $.fn.steps.stepsOrientation.vertical,
    /* Templates */
    titleTemplate: '<strong>#title#</strong>',
    // titleTemplate: '<strong><span id="step-#index#" class="step">#index#</span> #title#</strong>',
    loadingTemplate: '<span class="spinner"></span> #text#',
    /* Behaviour */
    autoFocus: true,
    enableAllSteps: true,
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
  $('#btn_cancelar').click(function(){
    window.onbeforeunload = null;
    var servidorId = $('form .servidor_contrato_id').val();
    if (servidorId == 0){
      Swal.fire({
        title: 'Desejas cadastrar um novo contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
        }
      })
    } else {
      Swal.fire({
        title: 'Desejas reiniciar a edição do contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, reiniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
        }
      })
    }
  });
  $('#btn_anterior').click(function(){
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      salvarContrato();
    } else if (currentIndex == 1) {
      salvarContratoAlteracao();
    } else if (currentIndex == 2) {
      salvarContratoFerias();
    }
    $('.tab-wizard').steps('previous');
  });
  $('#btn_proximo').click(function(){
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      salvarContrato();
    } else if (currentIndex == 1) {
      salvarContratoAlteracao();
    } else if (currentIndex == 2) {
      salvarContratoFerias();
      Swal.fire({
        title: 'Desejas cadastrar um novo contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
        }
      })
    }
    $('.tab-wizard').steps('next');
  });
  $('#btn_finalizar').click(function(){
    window.onbeforeunload = null;
    var currentIndex = $('.tab-wizard').steps('getCurrentIndex');
    if (currentIndex == 0) {
      salvarContrato();
      Swal.fire({
        title: 'Desejas cadastrar um novo contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
        }
      })
    } else if (currentIndex == 1) {
      salvarContratoAlteracao();
      Swal.fire({
        title: 'Desejas cadastrar um novo contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
        }
      })
    } else if (currentIndex == 2) {
      salvarContratoFerias();
      Swal.fire({
        title: 'Desejas cadastrar um novo contrato?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, iniciar!',
        cancelButtonText: 'Não, obrigado!'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/cadastrar');
        } else {
          postToURL(PORTAL_URL + 'view/rh/servidor_contrato/dashboard');
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
  $(".select2_servidor").select2({
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
      url: PORTAL_URL + "model/rh/servidor/get_servidores",
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

  $('.date_format').mask('00/00/0000');
  $('.hora_format').mask('00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.preco_format').mask("###.###.###.##0,00", {reverse: true});
  $('.cep_format').mask('00000-000');
  //Flat red color scheme for iCheck
  $('.ichack-input input[type="radio"].square-purple').iCheck({
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
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
function createICkeckModel(obj){
  //Flat red color scheme for iCheck
  $(obj).iCheck({
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
  });
}
function elementosFormatar(){
  $('.date_format').mask('00/00/0000');
  $('.hora_format').mask('00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.preco_format').mask("###.###.###.##0,00", {reverse: true});
}
