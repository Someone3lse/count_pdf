//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
window.onbeforeunload = function(e) {
  // if ($('#nome_s').val() == '' && $('#dt_nasc_s').val() == '' && $('#cpf_s').val() == '') {
  //   window.onbeforeunload = null;
  // } else {
  //   return true;
  // }
};
$(document).ready(function() {
  var msgInputRequired = '<span class="error_validator required">O preenchimento deste campo é obrigatório!<br/></span>';
  var msgInputMinLength = '<span class="error_validator minlength">Digite no mínimo ## caracteres!<br/></span>';
  var msgSelect = '<span class="error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
  var msgRadio = '<span class="error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
  $('input[type="text"][required], input[type="number"][required], input[type="email"][required], textarea[required]').keyup(function(){
    var valLength = $(this).val().length;
    $(this).parents('div.form-group').find('span.required').remove();
    if (valLength == 0) {
      $(this).parents('div.form-group').append(msgInputRequired);
    }
  });
  $('input[minlength]').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var textLength = $(this).val().length;
    $(this).parents('div.form-group').find('span.minlength').remove();
    if (textLength > 0 && textLength < valMinLength) {
      $(this).parents('div.form-group').append(msgInputMinLength.replace('##', valMinLength));
    }
  });
  $('select[required]').change(function(){
    var val = $(this).val();
    $(this).parents('div.form-group').find('span.required').remove();
    if (val == 0 || val == '') {
      $(this).parents('div.form-group').append(msgSelect);
    }
  });
  $('input[type="radio"]').on('ifChecked', function(event){
    $(this).parents('div.form-group').find('span.required').remove();
  });
  $('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').keyup(function(){
    var valLength = $(this).val().length;
    var body = $(this).parents('div.row').parent();
    if (valLength > 0) {
      $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
      $(body).find('select[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
      $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
    } else {
      listenValidatorRMRosas(body);
    }
  });
  $('select[allempty]').change(function(){
    var val = $(this).val();
    var body = $(this).parents('div.row').parent();
    if (val == 0 || val == '') {
      $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
      $(body).find('select[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
      $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
    } else {
      listenValidatorRMRosas(body);
    }
  });
  $('input[type="radio"][allempty]').on('ifChecked', function(event){
    var body = $(this).parents('div.row').parent();
    $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
    $(body).find('select[allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
    $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.form-group').find('span.text-danger[validator]').text('*');
  });
});
function listenValidatorRMRosas(elem){
  var notEmpty = false;
  $(elem).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').each(function(){
    var valLength = $(this).val().length;
    if (valLength > 0) {
      notEmpty = true;
    }
  });
  $(elem).find('select[allempty]').each(function(){
    var val = $(this).val();
    if (val != 0 || val != '') {
      notEmpty = true;
    }
  });
  if (!notEmpty) {
    $(elem).find('[allempty]').removeAttr('required').parents('div.form-group').find('span.text-danger').text('');
    $(elem).find('span.error_validator').remove();
  }
}
function cleanValidatorRMRosas(elem){
  $(elem).find('[allempty]').removeAttr('required').parents('div.form-group').find('span.text-danger').text('');
  $(elem).find('span.error_validator').remove();
}
function formValidatorRMRosas(form){
  valido = true;
  var msgInputRequired = '<span class="error_validator required">O preenchimento deste campo é obrigatório!<br/></span>';
  var msgInputMinLength = '<span class="error_validator minlength">Digite no mínimo ## caracteres!<br/></span>';
  var msgSelect = '<span class="error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
  var msgRadio = '<span class="error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
  $(form).find('span.required').remove();
  $(form).find('span.minlength').remove();
  $(form).find('input[type="text"][required], input[type="number"][required], input[type="email"][required], textarea[allempty]').each(function(){
    if ($(this).is(':visible')) {
      var valLength = $(this).val().length;
      if (valLength == 0) {
        $(this).parents('div.form-group').append(msgInputRequired);
      }
    }
  });
  $(form).find('input[minlength]').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var textLength = $(this).val().length;
      if (textLength > 0 && textLength < valMinLength) {
        $(this).parents('div.form-group').append(msgInputMinLength.replace('##', valMinLength));
      }
    }
  });
  $(form).find('select[required]').each(function(){
    if ($(this).is(':visible')) {
      var val = $(this).val();
      if (val == 0 || val == '') {
        $(this).parents('div.form-group').append(msgSelect);
      }
    }
  });
  $(form).find('input[type="radio"][required]').each(function(){
    if ($(this).is(':visible')) {
      var val = $('input[name="'+$(this).attr('name')+'"]').is(':checked');
      if (!val) {
        $(this).parents('div.form-group').last().append(msgRadio);

      }
    }
  });
  if ($(form).find('span.error_validator').length > 0) {
    valido = false;
    swal.fire({title: 'Atenção', text: "Todos os campos devem ser preenchidos corretamente!", icon: 'warning', confirmButtonText: 'Ok'})
    .then((result) => {
      var offsetTop = $('span.error_validator').parents('.form-group').find('label').offset().top - 20;
      $('html').animate({
        scrollTop: offsetTop
      }, 500);
    });
    // swal.fire('Atenção', "Todos os campos devem ser preenchidos corretamente!", 'warning');
  }
  return valido;
}