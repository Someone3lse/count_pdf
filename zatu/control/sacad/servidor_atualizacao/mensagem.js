$(function () {
  "use strict";   
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
  $('a#a_nova_atualizacao').click(function(){
    var id = $('input#id').val();
    postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {id: id});
  });
});