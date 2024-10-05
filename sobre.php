<?php
include_once('conf/config.php');
include_once('conf/Url.php');
include_once('utils/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>:: SIPLAGE | Sobre ::</title>

        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="<?= PLUGINS_FOLDER ?>boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- END CORE CSS FRAMEWORK -->

        <!-- BEGIN CSS TEMPLATE -->
        <link href="<?= CSS_FOLDER ?>login.css" rel="stylesheet" type="text/css"/>
        <!-- END CSS TEMPLATE -->

        <!-- CORES -->
        <link href="<?= CSS_FOLDER ?>cores.css" rel="stylesheet" />

        <!-- FONTES -->
        <link href="<?= FONTS_FOLDER ?>fontes.css" rel="stylesheet" />

        <!-- CSS DA NOTIFICAÇÃO EM IMPROMPT -->
        <link rel="stylesheet" media="all" type="text/css" href="<?= PLUGINS_FOLDER; ?>jQuery-Impromptu-master/dist/jquery-impromptu.css" />
    </head>
    <body class="esqueceu">
        <div class="topo topo-sobre">
            <div class="logo">Logo</div>
			<div class="barra-colorida">
		        <div class="cor1"></div>
		        <div class="cor2"></div>
		        <div class="cor3"></div>
		        <div class="cor4"></div>
		        <div class="cor5"></div>
	        </div>
        </div>
        
        <div class="corpo">

            <a href="login.php" title="Voltar" class="bt-voltar">Voltar</a>
            
			<!-- SOBRE O SISTEMA SIPLAGE -->
            <div class="sobre">
	           

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar non mi gravida sagittis. Nunc a finibus nisl, quis vestibulum nisi. Nullam fermentum vestibulum porttitor. Quisque ac pulvinar lectus. Morbi tristique turpis nec ultricies sagittis. Sed in aliquam ex. Pellentesque a nisi in tortor bibendum commodo. Nam quis orci rhoncus, ornare turpis ac, dictum nisl. Vestibulum viverra mauris vel diam volutpat finibus. In commodo euismod est ut tempus. In pellentesque nulla urna, id commodo risus maximus et. Vivamus efficitur arcu vitae augue pulvinar bibendum. Vestibulum porttitor quis quam sit amet bibendum. Nulla non auctor nisl, a mollis erat. Nullam nisl nulla, pretium in sodales a, auctor eu diam.</p>

				<p>Morbi auctor ullamcorper odio ac pharetra. Aenean ultricies ultrices tortor, semper rutrum elit euismod sed. Integer et rhoncus nunc. Suspendisse mollis, enim ac tempus feugiat, sem elit dictum magna, vel pulvinar magna tortor sit amet libero. Nulla tempus eget arcu ut fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In quis metus suscipit, eleifend elit sit amet, dignissim tellus. Fusce viverra velit in placerat rhoncus. Vestibulum mauris magna, elementum eu nisl nec, tincidunt accumsan risus. Quisque tempus euismod placerat. Donec commodo magna et molestie vulputate. Quisque eu tristique risus, non elementum dui.</p>

				<p>Nulla feugiat risus eget arcu venenatis, id luctus ex pharetra. Donec pharetra enim diam, quis eleifend ante blandit ac. Vivamus vitae sodales felis, eu gravida justo. Nullam cursus imperdiet nunc. Aliquam facilisis dolor vel maximus aliquet. Suspendisse eu pharetra magna. Integer risus dui, ultrices et turpis a, consectetur finibus nunc. Pellentesque luctus sem ligula, eu dapibus ex laoreet vitae.</p>

				<p>Morbi tellus massa, tristique sit amet lobortis vel, ultrices vitae felis. Aenean fringilla finibus egestas. Morbi tempus leo mauris, nec pretium diam mollis ut. Nullam suscipit hendrerit turpis, ac mattis velit tempus id. Ut volutpat velit ac sem scelerisque, quis posuere velit imperdiet. Sed commodo eget sem vel iaculis. Morbi volutpat tincidunt ipsum sit amet vestibulum. Proin vitae tellus porttitor, sagittis risus vitae, convallis velit. Cras et tellus hendrerit, consequat ex sit amet, fermentum purus.</p>

				<p>Nunc blandit feugiat orci nec euismod. Sed non tortor tincidunt, interdum metus sit amet, vestibulum tortor. Nam mollis sagittis velit, vel scelerisque dui commodo in. Suspendisse potenti. Praesent vel magna vitae justo vulputate semper interdum a enim. Fusce ornare laoreet porta. Cras ac mi vel odio aliquet condimentum vitae accumsan leo. Sed consectetur mollis congue. Proin varius ipsum lacus, eu volutpat neque dapibus nec. Etiam sed gravida ante. Aliquam tempor tincidunt aliquet. Fusce fermentum vel lorem vitae sollicitudin. Mauris non iaculis ante.</p>
				
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar non mi gravida sagittis. Nunc a finibus nisl, quis vestibulum nisi. Nullam fermentum vestibulum porttitor. Quisque ac pulvinar lectus. Morbi tristique turpis nec ultricies sagittis. Sed in aliquam ex. Pellentesque a nisi in tortor bibendum commodo. Nam quis orci rhoncus, ornare turpis ac, dictum nisl. Vestibulum viverra mauris vel diam volutpat finibus. In commodo euismod est ut tempus. In pellentesque nulla urna, id commodo risus maximus et. Vivamus efficitur arcu vitae augue pulvinar bibendum. Vestibulum porttitor quis quam sit amet bibendum. Nulla non auctor nisl, a mollis erat. Nullam nisl nulla, pretium in sodales a, auctor eu diam.</p>

				<p>Morbi auctor ullamcorper odio ac pharetra. Aenean ultricies ultrices tortor, semper rutrum elit euismod sed. Integer et rhoncus nunc. Suspendisse mollis, enim ac tempus feugiat, sem elit dictum magna, vel pulvinar magna tortor sit amet libero. Nulla tempus eget arcu ut fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In quis metus suscipit, eleifend elit sit amet, dignissim tellus. Fusce viverra velit in placerat rhoncus. Vestibulum mauris magna, elementum eu nisl nec, tincidunt accumsan risus. Quisque tempus euismod placerat. Donec commodo magna et molestie vulputate. Quisque eu tristique risus, non elementum dui.</p>

				<p>Nulla feugiat risus eget arcu venenatis, id luctus ex pharetra. Donec pharetra enim diam, quis eleifend ante blandit ac. Vivamus vitae sodales felis, eu gravida justo. Nullam cursus imperdiet nunc. Aliquam facilisis dolor vel maximus aliquet. Suspendisse eu pharetra magna. Integer risus dui, ultrices et turpis a, consectetur finibus nunc. Pellentesque luctus sem ligula, eu dapibus ex laoreet vitae.</p>

				<p>Morbi tellus massa, tristique sit amet lobortis vel, ultrices vitae felis. Aenean fringilla finibus egestas. Morbi tempus leo mauris, nec pretium diam mollis ut. Nullam suscipit hendrerit turpis, ac mattis velit tempus id. Ut volutpat velit ac sem scelerisque, quis posuere velit imperdiet. Sed commodo eget sem vel iaculis. Morbi volutpat tincidunt ipsum sit amet vestibulum. Proin vitae tellus porttitor, sagittis risus vitae, convallis velit. Cras et tellus hendrerit, consequat ex sit amet, fermentum purus.</p>

				<p>Nunc blandit feugiat orci nec euismod. Sed non tortor tincidunt, interdum metus sit amet, vestibulum tortor. Nam mollis sagittis velit, vel scelerisque dui commodo in. Suspendisse potenti. Praesent vel magna vitae justo vulputate semper interdum a enim. Fusce ornare laoreet porta. Cras ac mi vel odio aliquet condimentum vitae accumsan leo. Sed consectetur mollis congue. Proin varius ipsum lacus, eu volutpat neque dapibus nec. Etiam sed gravida ante. Aliquam tempor tincidunt aliquet. Fusce fermentum vel lorem vitae sollicitudin. Mauris non iaculis ante.</p>
	            
            </div>
			<!-- FIM SOBRE O SITEMA SIPLAGE -->

            <!-- RODAPÉ -->
            <footer class="rodape-login rd-sobre">
                <div>
                    <div class="nome-estado">Governo do Estado do Acre <br /> Secretaria de Estado de Planejamento - SEPLAN</div>
                    <div class="logo-estado"><span></span></div>
                    <div class="nome-sistema">SIPLAGE SEPLAN <br /> 2015 Todos os direitos reservados</div>
                </div>
            </footer>
            <!-- FIM RODAPÉ -->

        </div>
        <!-- FIM CORPO -->

    </body>
</html>

