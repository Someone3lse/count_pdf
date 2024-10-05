<?php
// ENVIO DE E-MAIL
require ('assets/plugins/phpmailer/class.smtp.php');
require ('assets/plugins/phpmailer/class.phpmailer.php');
// VERIFICAÇÕES DE SESSÕES
if(isset($_SESSION['servidor_zatu_id'])) {
  ?>
  <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>servidor_dashboard';</script>
  <?php
  exit();
}
// RANDONIZADOR DE IMAGENS DO BACKGROUND
// $dir_name = "assets/images/fotos/";
// $handle = opendir($dir_name);
// $i = 0;
// while($file = readdir($handle)) {
// 	if($file != "." && $file != ".." && $file != ".DS_Store") {
// 		$photos[$i] = "$file";
// 		$i ++;
// 	}
// }
// closedir($handle);
// $img = IMG_FOLDER."fotos/".$photos[array_rand($photos)];
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
  <title>:: ZATU | Esqueceu senha ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>vendors_css.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>style.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>login.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>skin_color.css">
  <!-- Style-->  
  <link rel="stylesheet" href="<?= PORTAL_URL ?>assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= PORTAL_URL ?>assets/fonts/fonts.css">
  <!-- CSS PLUGINS END -->
  <!-- CSS CUSTON BEGIN -->
  <!-- CSS CUSTON END -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= PORTAL_URL ?>assets/images/favicon/manifest.json">
  <meta name="msapplication-TileImage" content="<?= PORTAL_URL ?>assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition theme-primary bg-img login" style="background-image: url(http://localhost:80/zatu/assets/images/fundo_esquerdo.png) , url(http://localhost:80/zatu/assets/images/fundo_direito.png);">
  <header class="servidor">
    <div class="elementos">
      <span class="zatu"><img src="<?= PORTAL_URL ?>assets/images/zatu-logo.svg" alt=""></span>
    </div>
    <!-- <a href="#" class="pull-right btn-login"><i class="fal fa-user"></i> <br> LOGIN</a> -->
  </header>
  <div class="container h-p100 mt-60">
    <!-- <a href="<?= PORTAL_URL ?>servidor_login" class="back-login"><i class="fal fa-arrow-circle-left"></i> VOLTAR AO LOGIN</a> -->
    <div class="row align-items-center justify-content-md-center h-p100">
      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-4 col-md-6 col-12">						
            <div class="bg-white">
              <div class="p-20">
                <span class="prefeitura">
                  <img src="<?= PORTAL_URL ?>assets/images/logo-prefeitura.svg" alt="">
                </span>
                <div class="text-center mb-5">
                  <br><h3 class="servidor">Não consegue acessar o Sistema?</h3><br>
                </div>
                <div class="text-center mb-5">
                  Se você já possui cadastro em nosso portal e esqueceu sua senha, basta digitar seu e-mail e seguir as orientações enviadas para o seu e-mail.
                </div>
                <br/>
                <form id="form_esqueceu_senha" name="form_esqueceu_senha" method="post" action="#">
                  <div id="div_login" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                      </div>
                      <input type="email" class="form-control pl-15 bg-transparent" id="email" name="email" placeholder="Informe seu e-mail" value="" required />
                    </div>
                    <div id="alert_email_erro" class="alert alert-danger mt-10" role="alert" style="display: none;">>Não foi possível enviar o e-mail! Por favor mande-nos um email para admptk2017@gmail.com informando o assunto juntamente com suas informações pessoais: nome completo e telefones de contato.</div>
                    <div id="alert_email_errado" class="alert alert-danger mt-10" role="alert" style="display: none;">Email não encontrado! Por favor mande-nos um email para admptk2017@gmail.com informando o assunto juntamente com suas informações pessoais: nome completo e telefones de contato.</div>
                    <div id="alert_email_limpo" class="alert alert-danger mt-10" role="alert" style="display: none;">Você precisa informar o seu e-mail cadastrado ao seu usuário.</div>
                  </div>
                  <div class="row">
                    <div class="col-6 text-center">
                      <button type="reset" class="btn btn-info btn-login mt-10" onclick="window.location = '<?= PORTAL_URL ;?>servidor_login';"><strong>Voltar ao Login</strong></button>
                    </div>
                    <div class="col-6 text-center">
                      <button type="submit" id="Recuperar senha" class="btn btn-primary btn-login mt-10"><strong>Recuperar senha</strong></button>
                    </div>
                  </div>
                  <div id="alert_sucesso" class="alert alert-success mt-10" role="alert" style="display: none;">Você receberá um e-mail com instruções para alterar sua senha!</div>
                  <div class="text-center mt-10">
                    <i>Não lembra seu e-mail?</i> Entre em contato com o RH de sua Secretaria para recuperar seu acesso.
                  </div>
                  <input type="hidden" name="recuperar" value="1"/>
                </form>	
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="servidor-novo">
        &copy; Wessix. Todos os direitos reservados.
      </div>
    </div>
  </div>
  <!-- JAVASCRIPT PLUGINS BEGIN -->
  <script type="text/javascript" src="<?= JS_FOLDER; ?>vendors.min.js"></script>
  <script type="text/javascript" src="<?= ICONS_FOLDER; ?>feather-icons/feather.min.js"></script>
  <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>livequery-1.3.6/livequery.min.js"></script>
  <!-- JAVASCRIPT PLUGINS END-->
  <!-- JAVASCRIPT CUSTON BEGIN -->
  <!-- JAVASCRIPT CUSTON END -->
</body>
</html>
<?php
$msg = '';
if(isset($_POST['email']) && @$_POST['email'] != '') {
  $email = $_POST['email'];
  //PEGA OS DADOS DO USUÁRIO DE ACORDO COM O SEU E-MAIL
  $stmt = $db->prepare("SELECT id, nome 
    FROM seg_servidor 
    WHERE email = ? AND status = 1 ");
  $stmt->bindValue(1, $email);
  $stmt->execute();
  //PEGAR O TOTAL DE DADOS RETORNADOS
  $rsUser = $stmt->fetch(PDO::FETCH_ASSOC);
  $rsCount = sizeof($rsUser);
  $usuarioId = $rsUser['id'];
  $usuarioNome = $rsUser['nome'];
  if($rsCount == 0) {
    ?>
    <script>$('#alert_email_errado').show('slow');</script>";
    <?php
  } else {
    $assunto = (EMAIL_TITULO . " / Recuperação de senha");
    $codigo = microtime();
    $stmt = $db->prepare("INSERT INTO seg_servidor_recupera_senha (email, codigo, dt_solicitacao, dt_alteracao, dt_expiracao, seg_servidor_id)
      VALUES (?, ?, NOW(), NULL, DATE_ADD(NOW(), INTERVAL 2 DAY ), ?)");
    $stmt->bindValue(1, $email);
    $stmt->bindValue(2, $codigo);
    $stmt->bindValue(3, $usuarioId);
    $stmt->execute();
    $encode = base64_encode($email . "@@@" . $codigo);
    $msg = '<table cellpadding="0" cellspacing="0;" style="width: 100%; font-family: Arial, sans-serif; font-size: 12px;">
    <thead>
    <tr>
    <th style="background: rgba(85, 206, 221, 0.2); padding: 20px 10px; font-size: 20px; border-bottom: solid 2px #00BBD3;">
    <img src="' . IMG_FOLDER . 'logo-prefeitura.png" border="0" style="width: 150px; height: 70px;" />
    </th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td style="padding: 20px 50px;">
    Prefeitura de Tarauacá. <br><br> Envio de recuperação de senha para acesso ao Sistema ZATU. <br><br> Olá, '. $usuarioNome .'!<br><br> Você deve alterar sua senha no link: <a style="color: #00BBD3; text-transform: uppercase;" href="' . PORTAL_URL . 'servidor_redefinir_senha/' . $encode . '">clique aqui para alterar</a>
    </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
    <th style="background: rgba(0, 0, 0, 0.05); padding: 10px 0;">
    <img src="' . IMG_FOLDER . 'zatu-logo.png" border="0" style="width: 150px; height: 40px;" />
    </th>
    </tr>
    </tfoot>
    </table>';
    $envio = envia_email($email, $assunto, $msg, EMAIL_ENDERECO, TITULO_SISTEMA, $usuarioNome) or die("ERRO GRAVE AO TENTAR RECUPERAR A SENHA");
    if ($envio == 'sucesso') {
      ?>
      <script type="text/javascript">
        $('div#alert_sucesso').slideDown(); 
        setTimeout(function(){ window.location = "location.href='servidor_login'";}, 8000);
      </script>
      <?php
    } else {
      ?>
      <script type="text/javascript">
        window.onbeforeunload = null;
        $('#alert_email_errado').slideDown('slow');
        return false;
      </script>
      <?php
    }
  } //END IF
} else if(isset($_POST['recuperar'])) {
  ?>
  <script type="text/javascript">
    window.onbeforeunload = null;
    $('#alert_email_limpo').slideDown('slow');
  </script>
  <?php
}
?>
