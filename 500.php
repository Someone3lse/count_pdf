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
  <link rel="manifest" href="<?= PORTAL_URL ?>manifest.json">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON_SISTEMA; ?>">
  <title>:: ArqContadorPDF ::</title>
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
  <div class="container bg-primary-subtle rounded">
    <header class="justify-content-center py-3 mb-4 border-bottom bg-gradient rounded" style="background-color: #f0d400;">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start p-2">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <img class="bi me-2" width="50" height="50" src="<?=IMG_FOLDER?>logo-header.svg"></img>
          <span class="fs-4"><b>ArqContadorPDF</b> - Contador de páginas pdf</span>
        </a>
      </div>
    </header>
    <section class="bg-light rounded p-3 mt-3">
      <br>
      <div class="box-body container-full">
        <div class="">
          <div class="">
            <form id="form_login" name="form_login" method="post" action="#">
              <div class="text-center mb-5">
                <h1>Página não encontrada!</h1>
							  <h3>Parece que esta página não existe</h3>
							  <div class="my-30"><a href="<?= PORTAL_URL; ?>view/arquivo/pdf/dashboard" class="btn btn-danger">Voltar para página principal</a></div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <br>
    </section>
    <footer class="container mt-5 mb-5 pb-3">
      <div class="box-body container-full text-center">
        &copy;<a href="#"><strong>Wessix.</strong></a> Todos os direitos reservados.
      </div>
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


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/error_500.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Jun 2020 20:15:37 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://www.multipurposethemes.com/admin/florence-admin-template/images/favicon.ico">

    <title>Florence Admin - 500 Error </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">	

</head>
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-5.jpg)" data-overlay="5">
	
	<section class="error-page h-p100">
		<div class="container h-p100">
		  <div class="row h-p100 align-items-center justify-content-center text-center">
			  <div class="col-lg-7 col-md-10 col-12">
				  <div class="rounded30 bg-white p-50 shadow-lg">
					  <img src="../images/auth-bg/500.jpg" class="max-w-200" alt="" />
					  <h1>Uh-Ah</h1>
					  <h3>Internal Server Error !</h3>
					  <div class="my-30"><a href="index.html" class="btn btn-info">Back to dashboard</a></div>
					  <h5 class="mb-15">-- OR --</h5>
					  <h4>Please try after some time</h4>			  			  
			      </div>							  			  
			  </div>				
		  </div>
		</div>
	</section>
	

	<!-- Vendor JS -->
	<script src="js/vendors.min.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>	


</body>

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/error_500.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Jun 2020 20:15:37 GMT -->
</html>
