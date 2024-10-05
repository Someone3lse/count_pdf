<?php
session_start();

// INCLUDE CONEXÃO
include_once "conf/config.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title><?=TITULO_SISTEMA?></title>

<!-- BEGIN META -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="your,keywords">
<meta name="description" content="Short explanation about this website">
<!-- END META -->

<!-- BEGIN STYLESHEETS -->
<link
	href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900'
	rel='stylesheet' type='text/css' />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/bootstrap.css?1422792965" />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/materialadmin.css?1425466319" />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/font-awesome.min.css?1422529194" />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/material-design-iconic-font.min.css?1421434286" />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/libs/rickshaw/rickshaw.css?1422792967" />
<link type="text/css" rel="stylesheet"
	href="<?=ASSETS?>css/theme-1/libs/morris/morris.core.css?1420463396" />

</head>
<body class="menubar-hoverable header-fixed ">

	<div id="content">
		<!-- BEGIN 404 MESSAGE -->
		<section>
			<div class="section-body contain-lg">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h1>
							<img src="<?=PORTAL_URL.'imagens/ass-page-error.svg'?>"
								width="500" height="120">
						</h1>
						<h1>
							<span class="text-xxxl text-light">500 <i
								class="fa fa-exclamation-circle text-danger"></i></span>
						</h1>
						<h2 class="text-light">Oops! Something went wrong</h2>
					</div>
					<!--end .col -->
				</div>
				<!--end .row -->
			</div>
			<!--end .section-body -->
		</section>
		<!-- END 404 MESSAGE -->
	</div>

</body>
</html>