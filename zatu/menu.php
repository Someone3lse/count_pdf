<?php
// RANDONIZADOR DE IMAGENS DO BACKGROUND
$dir_name = "assets/images/fotos/";
$handle = opendir($dir_name);
$i = 0;
while($file = readdir($handle)) {
	if($file != "." && $file != ".." && $file != ".DS_Store") {
		$photos[$i] = "$file";
		$i ++;
	}
}
closedir($handle);
$img = IMG_FOLDER."fotos/".$photos[array_rand($photos)];
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
  <title>:: ZATU | SISTEMA INTEGRADO DE GESTÃO ADMINISTRATIVA ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>vendors_css.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>menu.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>atualizacao.css">
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
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= PORTAL_URL ?>assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= PORTAL_URL ?>assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition theme-primary">
    <header>
        <span></span>
        <div class="container">
            <div class="row mt-1">
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="logo-prefeitura">
                        <img src="<?= PORTAL_URL ?>assets/images/logo-prefeitura-white.svg" class="logo-login" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="logo-zatu">
                        <img src="<?= PORTAL_URL ?>assets/images/zatu-logo-white.svg" class="logo-login" alt="">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="bem_vindo">
        <div class="down">
            <span class="text">Conheça mais</span>
        </div>
        <div class="container">
            <h1>BEM-VINDO AO PORTAL DE ATUALIZAÇÃO CADASTRAL <span>PREFEITURA DE TARAUACÁ</span></h1>
            <div class="acesso">
                <a href="<?= PORTAL_URL ?>servidor_login" class="servidor">PORTAL DO SERVIDOR <i class="fas fa-arrow-right"></i></a>
                <a href="<?= PORTAL_URL ?>login" class="rh">PORTAL DO RH <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <section class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>SOBRE ATUALIZAÇÃO CADASTRAL</h5>
                        </div>
                        <div class="card-body">
                            <p>O Recadastramento e a Atualização Cadastral Anual são obrigatórios a todos os servidores municipais efetivos, comissionados, empregados públicos e contratados em caráter temporário.
                                A obrigação quanto ao Recadastramento e à Atualização Cadastral Anual se aplica aos servidores independente da condição em que se encontrem nas respectivas datas de realização do Recadastramento ou Atualização Cadastral Anual, se em efetivo exercício, licenciados ou afastados.
                            </p>
                            <p>A <strong>Atualização Cadastral Anual</strong> e o <strong>Processo de Alteração de Dados Cadastrais</strong> a qualquer dia do ano de forma virtual, é um procedimento implementado pela Prefeitura de Tarauacá, através da Secretaria Municipal de Administração, para manter uma base de dados continuamente atualizada, moderna, integrada, confiável e eficiente, que possa ser facilmente acessada.</p>
                            <p>A Atualização Cadastral Anual será realizada no mês do aniversário do servidor a partir de 2023. De acordo com o Decreto nº 27, de 08 de Março de 2022, estão obrigados a realizar o Recadastramento e a Atualização cadastral todos os servidores efetivos, cargos comissionados, contratados por tempo determinado, inclusive os que se encontrem cedidos, permutados, afastados, licenciados de modo virtual.</p>
                            <p>O objetivo é manter uma base de dados atualizada e de fácil acesso, capaz de atender aos objetivos estratégicos da Secretaria Municipal de Administração através do Setor de Recursos Humanos.</p>
                            <p>Para isso, o servidor deve:</p>
                            <ul>
                                <li>acessar o ambiente de Atualização Cadastral, no Sistema Integrado de Gestão Administrativa - ZATU;</li>
                                <li>informar seus dados cadastrais;</li>
                                <li>anexar à documentação necessária.</li>
                            </ul>
                            <p>Os dados são enviados para análise e validação do Setor de Recursos Humanos da Secretaria Municipal de Administração.</p>
                            <p>Em caso de necessidade de correção, o trâmite (devolutiva e envio de documentos) é efetuado no mesmo ambiente virtual.</p>
                            <p>O servidor que não realizar a Atualização Cadastral Anual no mês do seu aniversário, terá sua remuneração suspensa até a efetiva regularização da pendência, com ressarcimento realizado conjuntamente com a remuneração do mês subsequente ao da efetiva regularização, de acordo com o disposto no Decreto nº 27, de 08 de Março de 2022.</p>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>REGULAMENTAÇÃO</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Acesse a Regulamentação de Implementação da Atualização Cadastral Anual e o Processo de Alteração de Dados Cadastrais online, através do Decreto abaixo:</strong></p> 
                            <ul>
                                <li><a href="<?= PORTAL_URL ;?>decreto.pdf" target="blanck"><strong>DECRETO Nº 027, DE 08 DE MARÇO DE 2022</strong></a> "Dispõe sobre as normas e os procedimentos para realização do recadastramento e atualização cadastral anual dos servidores públicos no âmbito do Poder Executivo Municipal e dá outras providências".</li>
                                <li><a href="<?= PORTAL_URL ;?>manual.pdf" target="blanck"><strong>MANUAL DE USO DO SISTEMA.</strong></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card card-contato">
                        <div class="card-header">
                            <h5 id="titulo_pagina">CONTATOS</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tableDashboard" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="200px">SECRETARIA</th>
                                            <th><i class="fal fa-map-marker-alt"></i> ENDEREÇO</th>
                                            <th><i class="fal fa-mobile"></i> CONTATO</th>
                                            <th><i class="fal fa-clock"></i> HORÁRIO</th>
                                            <th width="200px"><i class="fal fa-envelope"></i> E-MAIL'S</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Secretaria Municipal de Administração​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99236-5447</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:admptk2017@gmail.com">admptk2017@gmail.com</a>
                                                <a href="mailto:administracao@tarauaca.ac.gov.br">administracao@tarauaca.ac.gov.br</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Finanças​​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99938-1090</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:financas@tarauaca.ac.gov.br">financas@tarauaca.ac.gov.br</a>
                                                <a href="mailto:financastarauaca@gmail.com">financastarauaca@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Procuradoria Geral do Município​​​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99909-5808</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:juridico@tarauaca.ac.gov.br">juridico@tarauaca.ac.gov.br</a>
                                                <a href="mailto:pgmtarauaca@gmail.com">pgmtarauaca@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Meio Ambiente​​​​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99953-8730</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:meioambiente@tarauaca.ac.gov.br">meioambiente@tarauaca.ac.gov.br</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Saúde​​​​​​​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99991-1106</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:saude@tarauaca.ac.gov.br">saude@tarauaca.ac.gov.br</a>
                                                <a href="mailto:semsa.dados@gmail.com">semsa.dados@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Cultura, Desporto e Turismo​​​​​​​​​​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99239-0624</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:culturaeturismo@tarauaca.ac.gov.br">culturaeturismo@tarauaca.ac.gov.br</a>
                                                <a href="mailto:seculttk@gmail.com">seculttk@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Promoção Social</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99996-7334</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:social@tarauaca.ac.gov.br">social@tarauaca.ac.gov.br</a>
                                                <a href="mailto:assistenciasocialtk@gmail.com">assistenciasocialtk@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Obras​ e Serviços Urbanos</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99947-2471</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:obras@tarauaca.ac.gov.br">obras@tarauaca.ac.gov.br</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Agricultura</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) em manutenção</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:agricultura@tarauaca.ac.gov.br">agricultura@tarauaca.ac.gov.br</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Secretaria Municipal de Planejamento</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99208-8709</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:planejamento@tarauaca.ac.gov.br">planejamento@tarauaca.ac.gov.br</a>
                                                <a href="mailto:porcelcaroline@gmail.com">porcelcaroline@gmail.com</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Diretoria de Controle Interno​​</th>
                                            <td>Av. Cel. Juvêncio de Menezes, nº 267 <br> CEP 69980-000, Centro, Tarauacá, AC</td>
                                            <td>(68) 99228-9827</td>
                                            <td>Segunda à Sexta <br> 7h às 17h</td>
                                            <td>
                                                <a href="mailto:controladoria@tarauaca.ac.gov.br">controladoria@tarauaca.ac.gov.br</a>
                                                <a href="mailto:cgmtk.ac@gmail.com">cgmtk.ac@gmail.com</a>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>


                            <!-- <div class="row">
                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Administração​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99236-5447</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:admptk2017@gmail.com">admptk2017@gmail.com</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:administracao@tarauaca.ac.gov.br">administracao@tarauaca.ac.gov.br</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Finanças​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99938-1090</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:financas@tarauaca.ac.gov.br">financas@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:financastarauaca@gmail.com">financastarauaca@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Procuradoria Geral do Município​​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99909-5808</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:juridico@tarauaca.ac.gov.br">juridico@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:pgmtarauaca@gmail.com">pgmtarauaca@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Meio Ambiente​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99953-8730</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:meioambiente@tarauaca.ac.gov.br">meioambiente@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Saúde​​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99991-1106</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:saude@tarauaca.ac.gov.br">saude@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:semsa.dados@gmail.com">semsa.dados@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Cultura, Desporto e Turismo​​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99239-0624</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:culturaeturismo@tarauaca.ac.gov.br">culturaeturismo@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:seculttk@gmail.com">seculttk@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Promoção Social​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99996-7334</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:social@tarauaca.ac.gov.br">social@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:assistenciasocialtk@gmail.com">assistenciasocialtk@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Obras​ e Serviços Urbanos</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99947-2471</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:saude@tarauaca.ac.gov.br">saude@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:semsa.dados@gmail.com">semsa.dados@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Agricultura​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) em manutenção</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:agricultura@tarauaca.ac.gov.br">agricultura@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Secretaria Municipal de Planejamento​​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) 99208-8709</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:planejamento@tarauaca.ac.gov.br">planejamento@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:porcelcaroline@gmail.com">porcelcaroline@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="element">
                                        <span>Diretoria de Controle Interno​​</span>
                                        <hr>
                                        <ul>
                                            <li><i class="fal fa-map-marker-alt"></i> Av. Cel. Juvêncio de Menezes, nº 267 - CEP 69980-000, Centro, Tarauacá, AC</li>
                                            <li><i class="fal fa-mobile"></i> (68) (68) 99228-9827</li>
                                            <li><i class="fal fa-clock"></i> Horário: segunda a sexta, das 7h às 17h</li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:controladoria@tarauaca.ac.gov.br">controladoria@tarauaca.ac.gov.br</a></li>
                                            <li><i class="fal fa-envelope"></i> <a href="mailto:cgmtk.ac@gmail.com">cgmtk.ac@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- <section>
    <div class=" menu-pagina">
            <div class="container">
                <nav class="nav nav-pills nav-justified">
                    <a class="nav-item nav-link active" id="apresentacao-tab" data-toggle="tab" href="#apresentacao" role="tab" aria-controls="apresentacao" aria-selected="true">APRESENTAÇÃO</a>
                    <a class="nav-item nav-link" id="documentacao-tab" data-toggle="tab" href="#documentacao" role="tab" aria-controls="documentacao" aria-selected="true">REGULAMENTAÇÃO</a>
                    <a class="nav-item nav-link" id="duvidas-frequentes-tab" data-toggle="tab" href="#duvidas-frequentes" role="tab" aria-controls="duvidas-frequentes" aria-selected="true">DÚVIDAS FREQUENTES</a>
                    <a class="nav-item nav-link" id="contato-tab" data-toggle="tab" href="#contato" role="tab" aria-controls="contato" aria-selected="true">CONTATO</a>
                    <a class="nav-item nav-link" id="contato-tab" data-toggle="tab" href="#acesso-sistema" role="tab" aria-controls="acesso-sistema" aria-selected="true">ACESSO AO SISTEMA</a>
                    <a href="<?= PORTAL_URL ?>servidor_login" class="acesso-formulario"><i class="fal fa-external-link"></i> ACESSE O SISTEMA</a>
                </nav>
            </div>
            <nav role="navigation">
                <div id="menuToggle">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <ul id="menu">
                        <a class="nav-item nav-link active" id="apresentacao-tab" data-toggle="tab" href="#apresentacao" role="tab" aria-controls="apresentacao" aria-selected="true"><li>APRESENTAÇÃO</li></a>
                        <a class="nav-item nav-link" id="documentacao-tab" data-toggle="tab" href="#documentacao" role="tab" aria-controls="documentacao" aria-selected="true"><li>REGULAMENTAÇÃO</li></a>
                        <a class="nav-item nav-link" id="duvidas-frequentes-tab" data-toggle="tab" href="#duvidas-frequentes" role="tab" aria-controls="duvidas-frequentes" aria-selected="true"><li>DÚVIDAS FREQUENTES</li></a>
                        <a class="nav-item nav-link" id="contato-tab" data-toggle="tab" href="#contato" role="tab" aria-controls="contato" aria-selected="true"><li>CONTATO</li></a>
                        <a class="nav-item nav-link" id="contato-tab" data-toggle="tab" href="#acesso-sistema" role="tab" aria-controls="acesso-sistema" aria-selected="true"><li>ACESSO AO SISTEMA</li></a>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="tab-content tab-pagina">
                <div class="tab-pane fade show active" id="apresentacao" role="tabpanel" aria-labelledby="apresentacao-tab">
                    <p>A <strong>Atualização Cadastral Anual</strong> e o <strong>Processo de Alteração de Dados Cadastrais</strong> a qualquer dia do ano de forma virtual, é um procedimento implementado pela Prefeitura de Tarauacá, através da Secretaria Municipal de Administração, para manter uma base de dados continuamente atualizada, moderna, integrada, confiável e eficiente, que possa ser facilmente acessada.</p>

                    <p>A Atualização Cadastral Anual será realizada no mês do aniversário do servidor. A partir de 2021, estão obrigados a realizarem todos os servidores efetivos, cargos comissionados, contratados por tempo determinado, em atividade, inclusive os que se encontrem cedidos, permutados, afastados, licenciados, fora do Estado ou do País, no âmbito da Administração Pública Municipal do Poder Executivo do Município de Tarauacá, devem realizar a sua Atualização Cadastral Anual, de modo virtual.</p>

                    <p>O objetivo é manter uma base de dados atualizada e de fácil acesso, capaz de atender aos objetivos estratégicos da Secretaria Municipal de Administração através do Setor de Recursos Humanos.</p>

                    <p>Para isso, o servidor deve:</p>

                    <ul>
                        <li>acessar o ambiente de Atualização Cadastral, no Sistema Integrado de Gestão Administrativa - ZATU;</li>
                        <li>informar seus dados cadastrais;</li>
                        <li>anexar a documentação necessária.</li>
                    </ul>

                    <p>Os dados são enviados para análise do chefe imediato e validação do Setor de Recursos Humanos da Secretaria Municipal de Administração.</p>
                    <p>Em caso de necessidade de correção, o trâmite (devolutiva e envio de documentos) é efetuado no mesmo ambiente virtual.</p>

                    <p>O servidor que não realizar a Atualização Cadastral Anual no mês do seu aniversário, terá bloqueado seus vencimentos ou salários, de acordo com o disposto no Decreto nº ****, de *** de Novembro de 2021.</p>
                </div>
                <div class="tab-pane fade" id="documentacao" role="tabpanel" aria-labelledby="documentacao-tab">
                   <p><strong>Acesse a Regulamentação de Implementação da Atualização Cadastral Anual e o Processo de Alteração de Dados Cadastrais online, através do Decreto abaixo:</strong></p> 
                    <ul>
                        <li>Decreto Nº xxxx, de xxx de Novembro de 2021</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="duvidas-frequentes" role="tabpanel" aria-labelledby="duvidas-frequentes-tab">
                    <p><strong>1. Afinal, o que é a Atualização Cadastral?</strong></p> 
                    <p>A Atualização Cadastral é um procedimento implementado pela Secretaria Municipal de Administração para manter uma base de dados continuamente atualizada, moderna, integrada, confiável e eficiente, que tem a finalidade de atualizar os dados cadastrais e validar o quadro de pessoal.</p> 
                    <p><strong>2. Por que efetuar a Atualização Cadastral?</strong></p>
                    <p>A recadastramento tem como objetivos principais a atualização de dados cadastrais, com a finalidade de garantir a preservação da integridade dos dados constantes no sistema RH, a validação do quadro de pessoal, com a finalidade de garantir a adequada e eficiente gestão de Recursos Humanos.</p>
                    <p><strong>3. Quando devo realizar minha atualização cadastral em 2021?</strong></p>
                    <p>Todos os servidores deverão realizar a atualização cadastral até 31 de dezembro de 2021.</p>
                    <p><strong>4. Quando devo realizar minha atualização cadastral a partir de 2022?</strong></p>
                    <p>Todos os servidores deverão realizar a atualização cadastral no mês de seu aniversário.</p>
                    <p><strong>5. Quem deve realizar a Atualização Cadastral?</strong></p>
                    <p>Todos os servidores efetivos, cargos comissionados, contratados por tempo determinado, em atividade, inclusive os que se encontrem cedidos, permutados, afastados, licenciados, fora do Estado ou do País, pertencentes ao quadro da Prefeitura de Tarauacá devem realizar a atualização cadastral anual de forma virtual.</p>
                    <p><strong>6. O que acontece se eu não realização a Atualização Cadastrar?</strong></p>
                    <p>Os servidores sem justificativa deixarem de realizar a atualização cadastral, serão intimados a fazê-la no prazo de 10 dias, contados da data da ciência da intimação. Expirado o prazo previsto no Decreto, o servidor que não tiver procedido ao recadastramento terá o pagamento suspenso.</p>
                    <p>O pagamento será restabelecido quando da regularização da Atualização Cadastral na forma determinada por Decreto, observados os prazos para processamento da folha de pagamento.</p>
                    <p>Os servidores que não cumprirem as determinações previstas neste Decreto, bem como os que prestarem declarações falsas ou omitirem dados relevantes, poderão ser responsabilizados penal e administrativamente, conforme a legislação vigente.</p>
                    <p><strong>7. A atualização cadastral anual é obrigatória aos servidores cedidos, permutados, afastados ou licenciados?</strong></p>
                    <p>Sim. A atualização cadastral anual é obrigatória também para esses casos.</p>
                    <p><strong>8.  Estou licenciado, cedido, afastado, fora do estado ou país, como faço?</strong></p>
                    <p>Os servidores que se encontrem cedidos, permutados, afastados, licenciados, fora do Estado ou do País, deverão realizar a atualização cadastral anual no mês de seu aniversário de forma virtual.</p>
                    <p><strong>9. Como será a atualização cadastral em caso de servidores cedidos, permutados, afastados ou licenciados?</strong></p>
                    <p>Entre cedências dentro da Administração Municipal, o servidor será atestado pela chefia imediata da Secretaria de destino.</p>
                    <p>No caso de servidores cedido ou permutado para órgão externo (outro Poder ou outra Esfera), o setor de RH será o responsável pela atestação do servidor, mediante controle interno e a partir de correspondência do órgão cessionário para validação das informações.</p>
                    <p>No caso de servidores afastados ou licenciados o setor de RH será o responsável pela atestação do servidor, mediante controle interno para validação das informações.</p>
                    <p><strong>10. Como será o recadastramento em caso de servidor impedido de realizar o recadastramento?</strong></p>
                    <p>A área de recursos irá identificar o motivo do impedimento e, se for o caso, proceder a atestação, mas desde que a frequência ou licença/afastamento esteja devidamente lançada no RH.</p>
                    <p><strong>11. Como será o recadastramento em caso de servidor com dois Vínculos?</strong></p>
                    <p>O recadastramento será realizado uma única vez pelo servidor, porém o ateste será enviado para cada chefe imediato.</p>
                    <p><strong>12. Estou em tratamento de saúde, impossibilitado de comparecer na data estipulada, que faço?</strong></p>
                    <p>O servidor deverá apresentar laudo médico comprobatório perante o setor responsável ao qual esteja vinculado, devendo providenciar, em caráter excepcional, a atualização cadastral anual no retorno às atividades.</p>
                    <p><strong>13. Quais os horários para fazer a atualização cadastral online?</strong></p>
                    <p>Em qualquer horário, pela internet.</p>
                    <p><strong>14. Não possuo internet, como posso realizar minha atualização?</strong></p>
                    <p>Preferencialmente deverá se dirigir ao setor ao qual esteja vinculado.</p>
                    <p><strong>15. Os estagiários devem fazer atualização cadastral?</strong></p>
                    <p>Não.</p>
                    <p><strong>16. Os prestadores de serviço (terceirizados) devem fazer atualização cadastral?</strong></p>
                    <p>Não.</p>
                    <p><strong>17. Meus dados que já constam no Sistema estão bloqueados (não consigo alterar), estão incorretos o que devo fazer?</strong></p>
                    <p>Abaixo possui um campo destinado à alteração que achar necessária, deverá ser preenchida com a correção desejada e anexada no final da atualização o documento comprobatório, para avaliação do Setor de Recursos Humanos.</p>
                    <p><strong>18. Tenho que comprovar todas as atualizações realizadas no Formulário Online?</strong></p>
                    <p>Sim. Para a conclusão e validação da Atualização Cadastral Anual do Servidor é necessário que o servidor encaminhe no final da atualização cadastra todos os documentos atualizados no Formulário Eletrônico. </p>
                    <p><strong>19. Qual é o órgão responsável pela atualização cadastral?</strong></p>
                    <p>A Secretaria Municipal de Administração.</p>
                </div>
                <div class="tab-pane fade" id="contato" role="tabpanel" aria-labelledby="contato-tab">
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Administração​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99236-5447</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:admptk2017@gmail.com">admptk2017@gmail.com</a> </p>
                            <p><a href="mailto:administracao@tarauaca.ac.gov.br">administracao@tarauaca.ac.gov.br</a> </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Finanças​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99938-1090</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:financas@tarauaca.ac.gov.br">financas@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:financastarauaca@gmail.com">financastarauaca@gmail.com</a> </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Procuradoria Geral do Município​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99909-5808</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:juridico@tarauaca.ac.gov.br">juridico@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:pgmtarauaca@gmail.com">pgmtarauaca@gmail.com</a> </p>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Meio Ambiente​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99953-8730</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:meioambiente@tarauaca.ac.gov.br">meioambiente@tarauaca.ac.gov.br</a> </p>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Saúde​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99991-1106</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:saude@tarauaca.ac.gov.br">saude@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:semsa.dados@gmail.com">semsa.dados@gmail.com</a> </p>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Cultura, Desporto e Turismo
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99239-0624</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:culturaeturismo@tarauaca.ac.gov.br">culturaeturismo@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:seculttk@gmail.com">seculttk@gmail.com</a> </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Promoção Social​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99996-7334</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:social@tarauaca.ac.gov.br">social@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:assistenciasocialtk@gmail.com">assistenciasocialtk@gmail.com</a> </p>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Obras​ e Serviços Urbanos
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99947-2471</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:obras@tarauaca.ac.gov.br">obras@tarauaca.ac.gov.br</a> </p>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Agricultura​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) em manutenção</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:agricultura@tarauaca.ac.gov.br">agricultura@tarauaca.ac.gov.br</a> </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Secretaria Municipal de Planejamento​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99208-8709</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:planejamento@tarauaca.ac.gov.br">planejamento@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:porcelcaroline@gmail.com">porcelcaroline@gmail.com</a> </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Diretoria de Controle Interno​​
                        </div>
                        <div class="card-body">
                            <p>Av. Cel. Juvêncio de Menezes, nº 267</p>
                            <p>CEP 69980-000, Centro, Tarauacá, AC</p>
                            <p>Telefone/PABX: (68) 99228-9827</p>
                            <p>Horário: segunda a sexta, das 7h às 17h</p>
                            <p>Fechado das 12h às 14h</p>
                            <p><a href="mailto:controladoria@tarauaca.ac.gov.br">controladoria@tarauaca.ac.gov.br</a> </p>
                            <p><a href="mailto:cgmtk.ac@gmail.com">cgmtk.ac@gmail.com</a> </p>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="acesso-sistema" role="tabpanel" aria-labelledby="acesso-tab">
                    <div class="links">
                        <a href="<?= PORTAL_URL ?>login">
                            <i class="fal fa-user-lock"></i><br>
                            Sistema Interno
                        </a>
                        <a href="<?= PORTAL_URL ?>servidor_login">
                            <i class="fal fa-clipboard-user"></i><br>
                            Portal do Servidor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <br>

    <footer>
        <div class="dados-prefeitura">
            <img src="<?= PORTAL_URL ?>assets/images/logo-prefeitura-white.svg" alt="">
            <div class="info">
                <p>CNPJ: 34.693.564/0001-79</p>
                <p>Av. Cel. Juvêncio de Menezes, Nº 395</p>
                <p>CEP: 69970-000, Centro, Tarauacá, AC</p>
                <p>Contato: (68)3462-1344</p>
                <p>E-mail: <a href="mailto:casacivil.tarauaca@gmail.com">casacivil.tarauaca@gmail.com</a></p>
            </div>
        </div>
        <div class="dados-wessis">
            <div class="info-dev">
                Desenvolvido por:
            </div>
            <img src="<?= PORTAL_URL ?>assets/images/logowessitrans.png" alt="">
        </div>
    </footer>
</body>
</html>
<!-- JAVASCRIPT PLUGINS BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>vendors.min.js"></script>
<script type="text/javascript" src="<?= ICONS_FOLDER; ?>feather-icons/feather.min.js"></script> 
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/PACE/pace.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/progressbar.js-master/dist/progressbar.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/jquery-steps-master/build/jquery.steps.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/select2/dist/js/select2.full.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/datatable/datatables.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/formatter/jquery.formatter.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-mask-1.14/jquery.mask.js"></script>
<!-- <script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script> -->
<!-- <script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/sweetalert/sweetalert.min.js"></script> -->
<!-- <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>livequery-1.3.6/livequery.min.js"></script> -->
<!-- JAVASCRIPT PLUGINS END-->
<!-- JAVASCRIPT UTILS BEGIN -->
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>projeto.utils.js"></script>
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>utils.js"></script>
<!-- JAVASCRIPT UTILS END -->
<!-- JAVASCRIPT CUSTON BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>template.js"></script>
<script type="text/javascript" src="<?= JS_FOLDER; ?>demo.js"></script>
<!-- JAVASCRIPT CUSTON END -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>data_table.js"></script>
<script type="text/javascript" src="<?= JS_FOLDER; ?>dashboard.js"></script>
<!-- JAVASCRIPT CUSTON BEGIN -->
<script>
    $(function(){
        $('ul#menu a').click(function(i){
            $('ul#menu a').removeClass('active');
            $(this).addClass('active');
            $('div.tab-pagina div.tab-pane').each(function(index) {
                $(this).toggleClass('active show');
            });
        });
    });
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>