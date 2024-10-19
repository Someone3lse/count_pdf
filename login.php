<?php
// VERIFICAÇÕES DE SESSÕES
if(isset($_SESSION['id'])) {
  ?>
  <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>view/arquivo/pdf/dashboard';</script>
  <?php
  exit();
}
$zatu_id      = isset($_POST['id']) ? $_POST['id'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- METAS BEGIN -->
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON_SISTEMA; ?>">
  <title>:: CONTADOR DE PDF ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link rel="stylesheet" href="<?= PLUGINS_FOLDER; ?>bootstrap-5.3.3/css/bootstrap.css">
  <link rel="stylesheet" href="<?= ICONS_FOLDER ?>bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= PLUGINS_FOLDER; ?>DataTables/datatables.min.csss">
  <!-- Style-->  
  <link rel="stylesheet" href="<?= PORTAL_URL ?>assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= PORTAL_URL ?>assets/fonts/fonts.css">
  <!-- CSS PLUGINS END -->
  <!-- CSS CUSTON BEGIN -->
  <!-- <link href="<?= CSS_FOLDER; ?>sidebar.css" rel="stylesheet" type="text/css" /> -->
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
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= PORTAL_URL ?>assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition light-skin sidebar-mini theme-primary" id="">
  <div class="wrapper">
    <header class="main-header rh">
      <div class="d-flex align-items-center logo-box justify-content-between">
        <!-- <a href="#" class="waves-effect waves-light nav-link rounded d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
          <i class="ti-menu"></i> -->
        <!-- </a>   -->
        <!-- Logo -->
        <!-- <a href="<?= PORTAL_URL; ?>dashboard" class="logo"> -->
          <!-- logo-->
          <!-- <div class="logo-lg">
            <span class="light-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
            <span class="dark-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
          </div>
        </a>   -->
      </div>
    </header>
    <div class="container">
      <!-- Main content -->
      <section class="">
        <br>
        <div class="box-body container-full">
          <div class="content-header">
            <div class="d-inline-block align-items-center">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><i class="bi bi-window-plus"></i></li>
                  <li class="breadcrumb-item active" aria-current="page">Cadastro de novos arquivos PDF para contagem de páginas</li>
                </ol>
              </nav>
            </div>
          </div>
          <br>
          <div class="">
            <div class="">
              <form id="form_login" name="form_login" method="post" action="#">
                <div class="text-center mb-5">
                  <h5>Informe seu usuário e senha de acesso!</h5>
                </div>
                <div id="div_login" class="form-group">
                  <small id="usuariol_help" class="form-text text-muted text-left">Não compartilhe seu login.</small>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Usuário" value="" required/>
                  </div>
                </div>
                <div id="div_senha" class="form-group">
                  <small id="senhal_help" class="form-text text-muted text-left">Não compartilhe sua senha.</small>
                  <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" value="" required/>
                    <span class="input-group-text" id="togglePass" onclick="showSenha()"><i class="fas fa-eye"></i></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 text-center">
                    <button type="reset" class="btn btn-info btn-login mt-10"><strong>Cancelar</strong></button>
                  </div>
                  <div class="col-6 text-center">
                    <button type="submit" class="btn btn-success btn-login mt-10"><strong>Iniciar</strong></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
      </section>
    </div>
    <footer class="main-footer">
      <div class="pull-right d-none d-sm-inline-block">
        <!-- <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Purchase Now</a>
          </li>
        </ul> -->
      </div>
      &copy;<a href="#"><strong>Wessix.</strong></a> Todos os direitos reservados.
    </footer>
  </div>
<!-- JAVASCRIPT PLUGINS BEGIN -->
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>bootstrap-5.3.3/js/bootstrap.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-3.7.1/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-livequery/jquery.livequery.min.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>twitter-bootstrap5.3.0/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>DataTables/datatables.min.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>dataTables.bootstrap5/dataTables.bootstrap5.js"></script>
<!-- JAVASCRIPT PLUGINS END-->
<!-- JAVASCRIPT UTILS BEGIN -->
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>projeto.utils.js"></script>
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>utils.js"></script>
<!-- JAVASCRIPT UTILS END -->
<!-- JAVASCRIPT CUSTON BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>login.js"></script>
<!-- JAVASCRIPT CUSTON END -->
</body>
</html>
