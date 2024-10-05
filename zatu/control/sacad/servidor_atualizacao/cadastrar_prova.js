//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function salvarServidorProva(step){
  window.onbeforeunload = null;
  // var files = $('#form_servidor_prova').find('input[type="file"]'); 
  var form = document.getElementById('form_servidor_prova');
  const formData = new FormData(form);
  $.ajax(PORTAL_URL + "model/sacad/servidor_atualizacao/salvar_prova", {
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    async: false,
    // enctype: 'multipart/form-data',
    success: onSuccessSendProva,
    error: onError,
    complete: onCompleteSendProva
  });
  return false;
}
function onSuccessSendProva(obj) {
  if (obj.msg == 'success') {
    $('input#servidor_atualizacao_prova_id_s').val(obj.detalhe.gerais.id);
    // swal.fire('Sucesso', obj.retorno, 'success');
    // postToURL(PORTAL_URL + 'view/sacad/servidor/cadastrar');
  } else if (obj.msg == 'error') {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}

function onCompleteSendProva(obj, status) {
  console.log(JSON.stringify(obj));
  if (status == 'success' && obj.msg != 'error') {
    swal.fire({title: 'Sucesso', text: obj.retorno, icon: 'success', confirmButtonText: 'Ok'})
        .then((result) => {
          salvarAtualizacaoAutenticacao();
        });
  } else {
    swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
    console.log('Error: ' + obj.retorno);
  }
  return false;
}

// File type validation
// $("#file").change(function() {
//     var file = this.files[0];
//     var fileType = file.type;
//     var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
//     if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
//         alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
//         $("#file").val('');
//         return false;
//     }
// });
function requisitaProva(){
  var exige = {
    pessoal: false,
    // naturalidade: false,
    // empregador: false, 
    sit_trabalho: false, 
    // empregador2: false, 
    sit_trabalho2: false, 
    covid_vacina: false, 
    enfermidade: false,
    end: false,
    rg: false,
    pis: false,
    ctps: false,
    eleitor: false,
    reg_militar: false,
    reg_prof: false,
    cnh: false,
    rne: false,
    // fgts: false,
    instrucao: false,
    conjuge: false,
    reg_civil: false,
    averbacao: false,
    dependente: false,
    bancario: false,
    vinculo: false
  };
  $('div#div_servidor span[grupo="input_text"]').each(function(k, elemOld){
    if (String($(elemOld).attr('value')).toUpperCase() != String($(elemOld).parents('div.form-group').find('input[type="text"]').val()).toUpperCase()){
      exige[''+$(elemOld).attr('subgrupo')] = true;
    }
  });
  $('div#div_servidor span[grupo="input_number"]').each(function(k, elemOld){
    if (String($(elemOld).attr('value')).toUpperCase() != String($(elemOld).parents('div.form-group').find('input[type="number"]').val()).toUpperCase()){
      exige[''+$(elemOld).attr('subgrupo')] = true;
    }
  });
  $('div#div_servidor span[grupo="radio"]').each(function(k, elemOld){
    if (String($(elemOld).attr('value')).toUpperCase() != String($(elemOld).parents('div.form-group').find('input[type="radio"]:checked').val()).toUpperCase()){
      exige[''+$(elemOld).attr('subgrupo')] = true;
    }
  });
  $('div#div_servidor span[grupo="select"]').each(function(k, elemOld){
    if (String($(elemOld).attr('value')).toUpperCase() != String($(elemOld).parents('div.form-group').find('select').val()).toUpperCase()){
      exige[''+$(elemOld).attr('subgrupo')] = true;
    }
  });
  if ($('input#need_prova_sit_trab').val() <= 1) {
    exige['sit_trabalho'] = false;
  }
  if ($('input#matricula_2_s').val() == '' || $('input#matricula_2_s').val() == 0 || $('input#need_prova_sit_trab_2').val() <= 1) {
    exige['sit_trabalho_2'] = false;
  }
  if (exige['instrucao']) {
    $('form#form_servidor_instrucao').find('div.box_instrucao').each(function(k, v){
      var exigeProva = false;
      $(v).find('span[grupo="input_text"]').each(function(kOld, vElemOld){
        if (String($(vElemOld).attr('value')).toUpperCase() != String($(vElemOld).parents('div.form-group').find('input[type="text"]').val()).toUpperCase()){
          exigeProva = true;
        }
      });
      if (exigeProva){
        $('input#prova_instrucao_'+k).parents('div.row').attr('style', '');
      } else {
        $('input#prova_instrucao_'+k).parents('div.row').attr('style', 'display: none;');
      }
    });
  }
  if (exige['dependente']) {
    $('form#form_servidor_dependente').find('div.box_dependente').each(function(k, v){
      var exigeProva = false;
      $(v).find('span[grupo="input_text"]').each(function(kOld, vElemOld){
        if (String($(vElemOld).attr('value')).toUpperCase() != String($(vElemOld).parents('div.form-group').find('input[type="text"]').val()).toUpperCase()){
          exigeProva = true;
        }
      });
      if (exigeProva){
        $('input#prova_dependente_'+k).parents('div.row').attr('style', '');
      } else {
        $('input#prova_dependente_'+k).parents('div.row').attr('style', 'display: none;');
      }
    });
  }
  if (exige['vinculo']) {
    $('form#form_servidor_vinculo').find('div.box_vinculo').each(function(k, v){
      var exigeProva = false;
      $(v).find('span[grupo="input_text"]').each(function(kOld, vElemOld){
        if (String($(vElemOld).attr('value')).toUpperCase() != String($(vElemOld).parents('div.form-group').find('input[type="text"]').val()).toUpperCase()){
          exigeProva = true;
        }
      });
      if (exigeProva){
        $('input#prova_vinculo_'+k).parents('div.row').attr('style', '');
      } else {
        $('input#prova_vinculo_'+k).parents('div.row').attr('style', 'display: none;');
      }
    });
  }
  $.each(exige, function(k, v) {
    if(v){
      $('input[name="prova_'+k+'[]"').parents('div.row').attr('style', '');
    } else {
      $('input[name="prova_'+k+'[]"').parents('div.row').attr('style', 'display: none;');
    }
  });
  return false;
}
function validaProva (){
  var valido = true;
  $('form#form_servidor_prova').find('span.erro_exige').remove();
  $('form#form_servidor_prova').find('div.row').each(function(k, v){
    if ($(v).attr('style') == '') {
      if ($(v).find('input[type="file"]').get(0).files.length == 0 && $(v).find('a').text() == '') {
        $(v).find('input').parents('div.input-group').after('<span class="erro_exige text-danger">É necessario selecionar um comprovante para envio e conferência!</span>');
        valido = false;
      }
    }
  });
  return valido;
}