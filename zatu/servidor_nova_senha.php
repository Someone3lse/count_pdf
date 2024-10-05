<?php
// VERIFICAÇÕES DE SESSÕES
if(isset($_SESSION['servidor_zatu_id'])) {
  ?>
  <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>servidor_dashboard';</script>
  <?php
  exit();
}
// RANDONIZADOR DE IMAGENS DO BACKGROUND
$dir_name = "assets/images/fotos/";
$handle = opendir($dir_name);
$i = 0;
while($file = readdir($handle)) {
  if($file != "." && $file != ".." && $file != ".DS_Store") {
    $photos[$i] = "$dir_name/$file";
    $i ++;
  }
}
closedir($handle);
$img = $photos[array_rand($photos)];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- METAS BEGIN -->
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON_SISTEMA; ?>">
  <title>:: ZATU | Login ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link href="<?= PLUGINS_FOLDER; ?>bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= PLUGINS_FOLDER; ?>fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet">
  <!-- CSS PLUGINS END -->
  <!-- CSS CUSTON BEGIN -->
  <link href="<?= CSS_FOLDER; ?>login.css" rel="stylesheet">
  <!-- CSS CUSTON END -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('#cadastro_form').submit(function () {
        var cadastro_valido = cadastro_validator();
        if (cadastro_valido) {
          $.ajax({
            type: "POST",
            url: 'nova_senha_efetivar.php',
            data: $('#cadastro_form').serialize(),
            cache: false,
            success: function (obj) {
              obj = JSON.parse(obj);
              if (obj.msg == 'success') {
                msg_imprompt("Senha alterada com sucesso!", "login.php");
              } else if (obj.msg == 'error') {
                $('div#div_senha').after('<label id="erro_senha" class="error">' + obj.retorno + '</label>');
              }
            },
            error: function (obj) {
              $.prompt(obj.retorno);
            }
          });
          return false;
        } else {
          return false;
        }
      });
    });
    //VALIDATOR DO CADASTRO
    function cadastro_validator() {
      var valido = true;
      var confirmasenha = $("#confirmasenha").val();
      var senha = $("#senha").val();
      //LIMPA MENSAGENS DE ERRO
      $('label#erro_confirmasenha').remove();
      $('label#erro_senha').remove();
      //VERIFICANDO SE OS CAMPOS LOGIN E SENHA FORAM INFORMADOS
      if (senha == "") {
        $('div#div_senha').after('<label id="erro_senha" class="error">O campo senha é obrigatório.</label>');
        valido = false;
      }
      if (confirmasenha == "") {
        $('div#div_confirmasenha').after('<label id="erro_confirmasenha" class="error">O campo confirmar senha é obrigatório.</label>');
        valido = false;
      }
      if (senha != "" && confirmasenha != "" && senha != confirmasenha) {
        $('div#div_senha').after('<label id="erro_senha" class="error">A senha e confirmação de senha não coincidem.</label>');
        $('div#div_confirmasenha').after('<label id="erro_confirmasenha" class="error">A senha e confirmação de senha não coincidem.</label>');
        valido = false;
      }
      return valido;
    }
  </script>
</head>
<body class="" id="">
  <div class="row container-fluid text-center align-center align-items-center login-page" id="" style="background-image: url(<?=$img?>);">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 p-3 bg-light rounded" style="opacity: 0.85;">
      <!-- LOGO DO SISTEMA -->
      <div class="">Logo do Sistema</div>
      <div class="">
        <h4>
          <b>Sistema de Gestão Municipal - ZATU</b>
        </h4>
      </div>
      <form id="form_nova_senha" name="form_nova_senha" method="post" action="#">
        <?php
          //VARIAVEL UNIVERSAL
        $msg = '';
        if (Url::getURL(1)) {
          $codigo = Url::getURL(1);
          $decode = base64_decode($codigo);
          $separa = explode('@@@', $decode);
          $email = $separa[0];
          $codigo = $separa[1];
            //PEGAR OS DADOS DE REDEFINICÃO DA SENHA DE ACORDO O CODIGO INFORMADO
          $rs = $db->prepare("SELECT ( dt_expiracao < NOW() ) AS menor 
            FROM seg_servidor_recupera_senha 
            WHERE email = ? AND codigo = ? AND dt_alteracao IS NULL");
          $rs->bindValue(1, $email);
          $rs->bindValue(2, $codigo);
          $rs->execute();
          $rsRecuperaSenha = $rs->fetch(PDO::FETCH_ASSOC);
            //PEGAR O TOTAL DE DADOS RETORNADOS
          $rsCount = $sql->rowCount();
          if ($rsCount == 0) {
            ?>
            <nav class="">Esse link já foi utilizado para alteração de senha. Caso seja necessário a alteração novamente da senha <a href="esqueceu_senha.php">clique aqui</a></nav>
            <?php
          } else {
            if ($rsRecuperaSenha['menor'] == 1) {
              ?>
              <nav class=''>Seu código expirou. Caso seja necessário alterar a senha <br><a href="esqueceu_senha.php">clique aqui</a></nav>
              <?php
            } else {
              $rs = $db->prepare("SELECT id, nome FROM seg_servidor WHERE email = ?");
              $rs->bindValue(1, $email);
              $rs->execute();

              $rsUsuario = $rs->fetch(PDO::FETCH_ASSOC);
                //SETANDO O ID DO USUARIO
              $idusuario = $rsUsuario['id'];
              ?>
              <div class="campos form-group text-center align-center">
                <div class="row">
                  <div id="div_nova_senha" class="p-4 col-sm-12 form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <img src="<?= IMG_FOLDER; ?>login_senha.svg" border="0" />
                        </div>
                      </div>
                      <input type="password" class="form-control" id="nova_senha" name="nova_senha" placeholder="Nova Senha" value="" required />
                    </div>
                    <small id="senhal_help" class="form-text text-muted text-left">Nunca compartilhe sua senha com outros.</small>
                  </div>
                </div>
                <div class="row">
                  <div id="div_repete_nova_senha" class="p-4 col-sm-12 form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <img src="<?= IMG_FOLDER; ?>login_senha.svg" border="0" />
                        </div>
                      </div>
                      <input type="password" class="form-control" id="repete_nova_senha" name="repete_nova_senha" placeholder="Repita a Nova Senha" value="" required />
                    </div>
                    <small id="senhal_help" class="form-text text-muted text-left">Nunca compartilhe sua senha com outros.</small>
                  </div>
                </div>
                <div class="mx-auto row" style="width: 118px;">
                  <div class="p-4 col-lg-12 input-group">
                    <button id="Logar" class="btn btn-primary" type="submit">Salvar</button>
                  </div>
                </div>
              </div>
              <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>" />
              <input type="hidden" name="codigo" value="<?php echo $codigo; ?>" />
              <input type="hidden" name="email" value="<?php echo $email; ?>" />
              <?php
              }//END IF
            }//END IF
          }//END IF
          ?>
        </form>
        <!-- RODAPÉ -->
        <footer class="" id="">
          <div class="">© Copyright 2021 Acre Ideias S.A.</div>
        </footer>
        <!-- FIM RODAPÉ -->
      </div>
    </div>
    <!-- JAVASCRIPT PLUGINS BEGIN -->
    <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-mask-1.7.7/jquery.mask.min.js"></script>
    <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-validate-1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>livequery-1.3.6/livequery.min.js"></script>
    <!-- <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>popper-1.16.0/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <!-- JAVASCRIPT PLUGINS END-->
    <!-- JAVASCRIPT UTILS BEGIN -->
    <script type="text/javascript" src="<?= UTILS_FOLDER; ?>/utils.js"></script>
    <!-- JAVASCRIPT UTILS END -->
    <!-- JAVASCRIPT CUSTON BEGIN -->
    <script type="text/javascript" src="<?= JS_FOLDER; ?>/login.js"></script>
    <!-- JAVASCRIPT CUSTON END -->
  </body>
  </html>