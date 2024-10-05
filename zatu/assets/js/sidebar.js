$(document).ready(function() {
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar').toggleClass('active');
  });
  $("a#menu_a_recadastro").click(function(){
    postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 2});
    return false;
  });
  $("a#menu_a_atualizacao").click(function(){
    postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/cadastrar', {tipo: 1});
    return false;
  });
});