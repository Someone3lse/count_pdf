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