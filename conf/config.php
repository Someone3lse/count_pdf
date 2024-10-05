<?php
header("Cache-Control: max-age=300, must-revalidate"); // CORRIGINDO O HISTORY.BACK
                                                       // DEFINIR TIMEZONE PADRÃO
date_default_timezone_set("America/Rio_Branco");
// OCULTAR OS WARNING DO PHP
// error_reporting(E_ALL ^ E_WARNING);
// ini_set("display_errors", 0 );
// DEFININDO OS DADOS DE ACESSO AO BANCO DE DADOS
define("DB", 'mysql');
define("DB_HOST", "localhost");
define("DB_NAME", "contador_pdf");
define("DB_USER", "root");
define("DB_PASS", "root");
// CONFIGURACOES PADRAO DO SISTEMA
define("PORTAL_URL", 'http://localhost/count_pdf/');
define("TITULO_SISTEMA", 'Sistema de Gestão Municipal - ZATU');
define("FAVICON_SISTEMA", 'http://localhost/count_pdf/assets/images/count_pdf_favicon.png');
define("LOGO_DASHBOARD", 'http://localhost/count_pdf/assets/images/count_pdf_logo.png');
define("ASSETS_FOLDER", 'http://localhost/count_pdf/assets/');
define("CSS_FOLDER", 'http://localhost/count_pdf/assets/css/');
define("FONTS_FOLDER", 'http://localhost/count_pdf/assets/fontes/');
define("IMG_FOLDER", 'http://localhost/count_pdf/assets/images/');
define("ICONS_FOLDER", 'http://localhost/count_pdf/assets/icons/');
define("JS_FOLDER", 'http://localhost/count_pdf/assets/js/');
define("PLUGINS_FOLDER", 'http://localhost/count_pdf/assets/plugins/');
define("AVATAR_FOLDER", 'http://localhost/count_pdf/assets/avatar/');
define("PORTAL_URL_SERVIDOR", 'C:/xampp/htdocs/count_pdf/');
define("UTILS_FOLDER", 'http://localhost/count_pdf/assets/utils/');
// CONFIGURACAO DE ENVIO DE E-MAIL
define('EMAIL_NOME', 'count_pdf');
define('EMAIL_ENDERECO', 'suporte@count_pdf.com.br');
define('EMAIL_TITULO', nl2br('CONTADOR DE PDF'));
define('EMAIL_DESENVOLVIMENTO', nl2br('CONTADOR DE PDF'));
define('URL_ENDERECO', 'http://localhost');
// ADICIONAR CLASSE DE CONEXÃO
include_once ("Conexao.class.php");
?>