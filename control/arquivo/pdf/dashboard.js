//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function (e) {
  if ($('#arquivo').val() == '') {
    window.onbeforeunload = null;
  } else {
    return true;
  }
};

(function (window, $) {
  function addFileToNewInput(file, newInput) {
    if (!newInput) { return }
    var dataTransfer = new DataTransfer()
    dataTransfer.items.add(file)
    newInput.files = dataTransfer.files
  }
  function addFileNameToPreview(file, preview) {
    if (!preview) { return }
    preview.innerText = file.name
  }
  function breakIntoSeparateFiles(input, targetSelector, templateSelector) {
    var $input = $(input)
    var templateHtml = $(templateSelector).html()
    if (!input.files) { return }
    for(var file of input.files) {
      var $newFile = $(templateHtml).appendTo(targetSelector)
      addFileToNewInput(file, $newFile.find("input")[0])
      addFileNameToPreview(file, $newFile.find(".file-name")[0])
    }
    $input.val([])
  }
  window.breakIntoSeparateFiles = breakIntoSeparateFiles
})(window, jQuery);

$(document).ready(function () {
  var qtdCols = $('#tb_arquivos > thead > tr > th').not('.no-print').length;
  var colsExport = '0';
  for (var i = 1; i < qtdCols; i++) {
    colsExport += ', '+i;
  }
  var titleTable = "CONTADOR DE ARQUIVOS PDF";
  // var user = $('input#zatu_nome').val();

  var tableDashboard = $('#tb_arquivos').DataTable( {
    // dom: '<B><"mt-3"lf>rtip',
    dom: '<B><"mt-3"lf>rtip',
    //geral
    select: true,
    // paging        : true,
    // pagingType    : "simple_numbers",
    // lengthChange  : true,
    // searching     : true,
    // ordering      : true,
    // info          : true,
    // autoWidth     : true,
    order: [[1, 'asc']],
    buttons: [
      { extend: 'colvis',   text: 'Visíveis', messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
      { extend: 'copy',     text: 'COPIAR',   messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
      { extend: 'csv',      text: 'CVS',      messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
      { extend: 'excel',    text: 'EXCEL',    messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
      { extend: 'pdfHtml5', text: 'PDF',      messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
      { extend: 'print',    text: 'Imprimir', messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}}
      // {  extend: 'print',
        // text: 'Imprimir',
        // messageTop: ('<h3>'+titleTable+'</h3>'),
        // messageBottom: '',
        // exportOptions: {columns: [ colsExport ]}, 
        // customize: function (win) {
          // alert(JSON.stringify(win.document.body));
          // impressao(win, titleTable, user);
          // alert(JSON.stringify(win.document.body));
        // }
      // }
      ],
    //exibir
    lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
    //pesquisa
    columnDefs: [
    	{ targets: 0,  				searchable: false, orderable: false, render: DataTable.render.select()},
      { targets: 1, 				searchable: false },
      { targets: 2, 				searchable: false, visible: false },
      { targets: qtdCols-1, orderable: false },
      { targets: qtdCols, 	searchable: false, orderable: false }
     ],
    select: {
        style: 'os'
    },
    language: {
      decimal             : ",",
      emptyTable          : "Não existem registros para exibir",
      info                : "Exibindo _START_ a _END_ de _TOTAL_ registros",
      infoEmpty           : "Exibindo 0 a 0 de 0 registros",
      infoFiltered        : "(filtrado de um total de _MAX_ registros)",
      infoPostFix         : "",
      thousands           : ",",
      lengthMenu          : "Exibir _MENU_ registros",
      loadingRecords      : "Carregando...",
      processing          : "Processando...",
      search              : "Pesquisar: ",
      searchPlaceholder   : "Digite sua pesquisa",
      zeroRecords         : "Nenhum registro encontrado",
      paginate: {
        first             : "Primeiro",
        last              : "Último",
        next              : "Proximo",
        previous          : "Anterior"
      },
      aria: {
        sortAscending     : ": classificar em ordem ascendente",
        sortDescending    : ": classificar em ordem descendente"
      },
      select: {
        rows: {
            _: '    %d linhas selecionadas',
            0: '    Click em uma linha para selecionar-la',
            1: '    1 linha selecionada'
          }
       }
    }
  });

  //SALVANDO DADOS DO FORMULÁRIO DE PROJETO
  $('#frm_arquivo').submit(function () {
    window.onbeforeunload = null;
    var inputFiles = $('#frm_arquivo').find('input[type="file"]');
    if(inputFiles.length > 1){
      var form = document.getElementById('frm_arquivo');
      const formData = new FormData(form);
      $.ajax(PORTAL_URL + "model/arquivo/pdf/salvar_pdf", {
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        async: false,
        // enctype: 'multipart/form-data',
        success: onSuccessSend,
        error: onError
        //complete: onCompleteSendProva
      });
      return false;
    } else {
      swal.fire('Erro', "Selecione um arquivo antes de clicar en cadastrar!", 'error');
      return false;
    }
  });

  function onSuccessSend(obj) {
    obj = JSON.parse(obj);
    if (obj.msg == "logout") {
    	postToURL(PORTAL_URL + 'logout');
    	return false;
    }
    if (obj.msg == 'success') {
      $('.file-preview').remove();
      Swal.fire({
      title: 'Sucesso',
      text: obj.retorno,
      icon: 'success',
      confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          postToURL(PORTAL_URL + 'view/arquivo/pdf/dashboard');
        }
      });
    } else if (obj.msg == 'error') {
      swal.fire('Erro', obj.retorno, 'error');
      console.log('Error: ' + obj.retorno);
      return false;
    }
  }

  $('#btn_limpar').click(function (){
    $('.file-preview').remove();
    buttonsController();
  });
  $('#frm_arquivo').find('input[type="file"]').change(function () {
    buttonsController();
  })

  $('#btn_excluir_selecionados').click(function () {
  	window.onbeforeunload = null;
	  Swal.fire({
	    title: 'Confirma a exclusão dos registros selecionados?',
	    text: "Este processo poderá ser desfeito!",
	    icon: 'question',
	    showCancelButton: true,
	  // confirmButtonColor: '#3085d6',
	  // cancelButtonColor: '#d33',
	    confirmButtonText: 'Sim, excluir!',
	    cancelButtonText: 'Cancelar!'
	  }).then((result) => {
	    if (result.isConfirmed) {
	    	var ids = '0';
	    	$.each(tableDashboard.rows('.selected').data(), function(k, obj){
	    		ids = ids + ',' + obj[2];
	    	});
	    	projetouniversal.util.getjson({
	        url: PORTAL_URL + "model/arquivo/pdf/excluir_pdf",
	        type: "POST",
	        data: {ids: ids},
	        enctype: 'multipart/form-data',
	        success: onSuccessSendJson,
	        error: onErrorJson
	      });
	    }
	  })
	  return false;
	});
	$('#btn_recuperar_selecionados').click(function () {
  	window.onbeforeunload = null;
	  Swal.fire({
	    title: 'Confirma a recuperação dos registros selecionados?',
	    text: "Este processo poderá ser desfeito!",
	    icon: 'question',
	    showCancelButton: true,
	  // confirmButtonColor: '#3085d6',
	  // cancelButtonColor: '#d33',
	    confirmButtonText: 'Sim, recuperar!',
	    cancelButtonText: 'Cancelar!'
	  }).then((result) => {
	    if (result.isConfirmed) {
	    	var ids = '0';
	    	$.each(tableDashboard.rows('.selected').data(), function(k, obj){
	    		ids = ids + ',' + obj[2];
	    	});
	    	projetouniversal.util.getjson({
	        url: PORTAL_URL + "model/arquivo/pdf/recuperar_pdf",
	        type: "POST",
	        data: {ids: ids},
	        enctype: 'multipart/form-data',
	        success: onSuccessSendJson,
	        error: onErrorJson
	      });
	    }
	  })
	  return false;
	});
	tableDashboard.on('select', function () {
  	if(tableDashboard.rows('.selected').data().length >= 2 ){
  		$("div#div_btns_all").slideDown();
  	}
	});
	tableDashboard.on('deselect', function () {
  	if(tableDashboard.rows('.selected').data().length < 2 ){
  		$("div#div_btns_all").slideUp();
  	}
	});
});
function buttonsController() {
  var inputFiles = $('#frm_arquivo').find('input[type="file"]');
    if(inputFiles.length > 1){
      $('#div_buttons').slideDown();
    } else {
      $('#div_buttons').slideUp();
    }
}

// ERRO AO ENVIAR AJAX
function onError(obj) {
  obj = JSON.parse(obj);
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

function btnExcluir(elem) {
  window.onbeforeunload = null;
  Swal.fire({
    title: 'Confirma a exclusão deste registro?',
    text: "Este processo poderá ser desfeito!",
    icon: 'question',
    showCancelButton: true,
  // confirmButtonColor: '#3085d6',
  // cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, excluir!',
    cancelButtonText: 'Cancelar!'
  }).then((result) => {
    if (result.isConfirmed) {
      var ids = $(elem).parents('tr').children('input#td_id').val();
      projetouniversal.util.getjson({
        url: PORTAL_URL + "model/arquivo/pdf/excluir_pdf",
        type: "POST",
        data: {ids: ids},
        enctype: 'multipart/form-data',
        success: onSuccessSendJson,
        error: onErrorJson
      });
    }
  })
  return false;
};

function btnRecuperar(elem) {
  window.onbeforeunload = null;
  Swal.fire({
    title: 'Confirma a recuperação deste registro?',
    text: "Este processo poderá ser desfeito!",
    icon: 'question',
    showCancelButton: true,
  // confirmButtonColor: '#3085d6',
  // cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, recuperar!',
    cancelButtonText: 'Cancelar!'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(elem).parents('tr').children('input#td_id').val();
      projetouniversal.util.getjson({
        url: PORTAL_URL + "model/arquivo/pdf/recuperar_pdf",
        type: "POST",
        data: {id: id},
        enctype: 'multipart/form-data',
        success: onSuccessSendJson,
        error: onErrorJson
      });
    }
  })
  return false;
};

function onSuccessSendJson(obj) {
  if (obj.msg == "logout") {
  	postToURL(PORTAL_URL + 'logout');
  	return false;
  }
  if (obj.msg == 'success') {
    Swal.fire({
	    title: 'Sucesso',
	    text: obj.retorno,
	    icon: 'success',
	    confirmButtonText: 'OK'
	    }).then((result) => {
	      if (result.isConfirmed) {
	        postToURL(PORTAL_URL + 'view/arquivo/pdf/dashboard');
	      }
	    });
  } else if (obj.msg == 'error') {
    swal.fire('Erro', obj.retorno, 'error');
    return false;
  }
}

function onErrorJson(obj) {
  if (obj.msg == "logout") {
  	postToURL(PORTAL_URL + 'logout');
  	return false;
  }
	console.log(obj);
  Swal.fire({
	  title: 'Erro',
	  text: obj.retorno,
	  icon: 'error',
	  confirmButtonText: 'OK'
	  }).then((result) => {
	    if (result.isConfirmed) {
	      return false;
	    }
 		});
  return false;
}