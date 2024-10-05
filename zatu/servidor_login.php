<?php
// VERIFICAÇÕES DE SESSÕES
$_SESSION['perfil'] = 'servidor';
if(isset($_SESSION['servidor_zatu_id'])) {
  ?>
  <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>servidor_dashboard';</script>
  <?php
  exit();
}
$servidor_zatu_id      = isset($_POST['zatu_servidor_id']) ? $_POST['zatu_servidor_id'] : '';
$urlanterior  = isset($_POST['urlanterior']) ? $_POST['urlanterior'] : '';
// RANDONIZADOR DE IMAGENS DO BACKGROUND
// $dir_name     = "assets/images/fotos/";
// $handle       = opendir($dir_name);
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
  <title>:: ZATU | Login servidor ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>vendors_css.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>style.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>login.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>skin_color.css">
  <!-- Style-->  
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fonts/fonts.css">
  <!-- CSS PLUGINS BEGIN -->
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
  <link rel="icon" type="image/png" sizes="192x192" href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= PORTAL_URL ?>assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
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
    <!-- <a href="<?= PORTAL_URL ?>" class="back-login"><i class="fal fa-arrow-circle-left"></i> VOLTAR</a> -->
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
                  <br><h2 class="servidor">Portal do Servidor</h2><br>
                </div>
                <form id="form_servidor_login" name="form_servidor_login" method="post" action="#">
                  <div class="text-center mb-5">
                    <h5>Informe seu cpf e senha de acesso!</h5>
                  </div>
                  <input type="hidden" id="servidor_zatu_id" name="servidor_zatu_id" value="<?= $servidor_zatu_id ;?>">
                  <input type="hidden" id="url_anterior" name="url_anterior" value="<?= $urlanterior ;?>">
                  <div id="div_login" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent cpf_format" id="servidor_login" name="servidor_login" placeholder="CPF" value=""/>
                    </div>
                    <small id="usuariol_help" class="form-text text-muted text-left">Não compartilhe seu login.</small>
                  </div>
                  <div id="div_senha" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-lock-alt"></i></span>
                      </div>
                      <input type="password" class="form-control pl-15 bg-transparent" id="servidor_senha" name="servidor_senha" placeholder="Senha" value=""/>
                      <button class="btn" id="togglePass" onclick="showSenha()" type="button"><i class="fas fa-eye"></i></button>
                    </div>
                    <small id="senhal_help" class="form-text text-muted text-left">Não compartilhe sua senha.</small>
                  </div>
                  <div class="row">
                    <div class="col-6 text-center">
                      <button type="reset" class="btn btn-info btn-login mt-10" onclick="window.location = '<?= PORTAL_URL ;?>';"><strong>Voltar</strong></button>
                    </div>
                    <div class="col-6 text-center">
                      <button type="submit" class="btn btn-success btn-login mt-10"><strong>Iniciar</strong></button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <button type="reset" class="btn mt-10 btn-registro" onclick="window.location = '<?= PORTAL_URL ;?>servidor_novo';">
                        <i class="fal fa-user-lock"></i> Primeiro acesso?<br/><b>Registre-se aqui</b>!</a>
                      </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="fog-pwd text-center">
                        <a href="<?= PORTAL_URL ?>servidor_esqueceu_senha" class="hover-warning"><br><i class="fal fa-key"></i>  Não consegue acessar? <strong>Clique aqui!</strong></a><br>
                      </div>
                    </div>
                  </div>
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
  <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-mask-1.14/jquery.mask.js"></script>
  <!-- JAVASCRIPT UTILS BEGIN -->
  <script type="text/javascript" src="<?= UTILS_FOLDER; ?>projeto.utils.js"></script>
  <script type="text/javascript" src="<?= UTILS_FOLDER; ?>utils.js"></script>
  <!-- JAVASCRIPT UTILS END -->
  <!-- JAVASCRIPT CUSTON BEGIN -->
  <script type="text/javascript" src="<?= JS_FOLDER; ?>servidor_login.js"></script>
  <!-- JAVASCRIPT CUSTON END -->
</body>
</html>
