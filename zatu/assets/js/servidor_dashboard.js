$(function () {
  "use strict";   
  //Initialize ToolTip Elements
  $('[data-toggle="tooltip"]').tooltip();
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })

  var qtdCols = $('#tableDashboard > thead > tr > th').length;
  var colsExport = '0';
  for (var i = 1; i < qtdCols - 1; i++) {
    colsExport += ', '+i;
  }
  var titleTable = ($('#titulo_pagina').text() + ' - Listagem');

  var tableDashboard = $('table#tableDashboard').DataTable( {
    dom: '<B><"mt-3"lf>rtip',
    //geral
    paging        : true,
    pagingType    : "simple_numbers",
    lengthChange  : true,
    searching     : true,
    ordering      : true,
    info          : true,
    autoWidth     : true,
    //butoes
    buttons: [
    { extend: 'copy',  text: 'COPIAR',   messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
    { extend: 'csv',   text: 'CVS',      messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
    { extend: 'excel', text: 'EXCEL',    messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
    { extend: 'pdf',   text: 'PDF',      messageTop: titleTable, messageBottom: '', exportOptions: {columns: [ colsExport ]}},
    { extend: 'print', text: 'Imprimir', messageTop: ('<h3>'+titleTable+'</h3>'), messageBottom: '', exportOptions: {columns: [ colsExport ]}}
    ],
    //exibir
    lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
    //pesquisa
    "columnDefs": [
    { searchable: false, targets: 0 },
    { orderable:  false, targets: qtdCols-1 }
    ],
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
      }
    }
  });
  $("a#a_recadastro").click(function(){
    if ($(this).attr("negado") != "true") {
      postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 2});
    }
    return false;
  });
  $("a#a_atualizacao").click(function(){
    if ($(this).attr("negado") != "true") {
      postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 1});
    }
    return false;
  });
  $("a#a_filtro_situacao").click(function(){
    var pesquisa = $(this).attr('value');
    tableDashboard.search(pesquisa).draw();
    $(this).parents('li').find('button#btn_filter_menu_dashboard').text('Filtrar por: '+$(this).text());
    return false;
  });
  $("a#a_redefinir_senha").click(function(){
    var login = $(this).attr('value');
    postToURL(PORTAL_URL + 'servidor_redefinir_senha', {login: login});
    return false;
  });
});
function btnContinuarProcesso(){
  postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar');
}
function btnVisualizar(id){
  postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/visualizar', {id: id});
};
function btnVerProtocolo(id){
  postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/mensagem', {id: id}, 'POST', '_blanck');
}
