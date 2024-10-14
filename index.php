<?php
ob_start();
session_start();
// URL AMIGAVEL E CONEXAO BY CONFIG 
include_once "conf/Url.php";
include_once "conf/config.php";
// INSTANCIA DO BANCO DE DADOS QUE SERVE PARA TODAS AS CONEXÕES COM BANCO EM TODAS AS PÁGINAS
$db = Conexao::getInstance();
// FUNCOES
include_once "conf/session.php";
include_once "assets/utils/funcoes.php";
// include_once ('assets/utils/permissoes.php');
// INSTANCIA A CONEXAO
$mvc = Url::getURL(0);
$modulo = Url::getURL(1);
$pastamodulo = Url::getURL(2);
$arquivomodulo = Url::getURL(3);
$parametromodulo = Url::getURL(4);
if($mvc == 'logout.php' || $mvc == 'logout') {
  $mvc = "logout";
  sessionOn();
  include_once $mvc . ".php";
  exit();
} else if ($mvc == 'index.php' || $mvc == 'index' || $mvc == '' || $mvc == null || $mvc == 'login.php' || $mvc == 'login') {
  $mvc = "login";
  sessionOn();
  include_once $mvc . ".php";
  exit();
} else {
  // VERIFICA SE O USUÁRIO ESTÁ LOGADO PELA SESSION
  /*if (isset($_SESSION['perfil'])){
    if ($_SESSION['perfil'] == 'servidor') {
      busca_servidor_session();
    } else {
      busca_usuario_session();
      if ($mvc == 'view') {
        permissaoPagina($paginasId[''.$modulo.'/'.$pastamodulo.'/'.$arquivomodulo.'']);
      }
    }
  }*/
  if(file_exists($mvc . ".php")) {
    sessionOn();
    include_once $mvc . ".php";
    exit();
  }
  if($pastamodulo == 'index.php' || $pastamodulo == 'index' || $pastamodulo == '' || $pastamodulo == null) {
    if(file_exists($pastamodulo . '/' . "index.php")) {
      sessionOn();
      include_once $pastamodulo . '/' . "index.php";
      exit();
    } else {
      sessionOn();
      include_once "404.php";
      exit();
    }
  } else {
    if($arquivomodulo == '' || $arquivomodulo == null) {
      if(file_exists($mvc . '/' . $modulo . '/' . $pastamodulo . '/' . "index.php")) {
        sessionOn();
        include_once $mvc . '/' . $modulo . '/' . $pastamodulo . '/' . "index.php";
        exit();
      } else {
        sessionOn();
        include_once "404.php";
        exit();
      }
    } else {
      if(file_exists($mvc . '/' . $modulo . '/' . $pastamodulo . '/' . $arquivomodulo . ".php")) {
        sessionOn();
        include $mvc . '/' . $modulo . '/' . $pastamodulo . '/' . $arquivomodulo . ".php";
        exit();
        // }else{
        // include "404.php";
        // sessionOn();
        // exit();
      }
    }
  }
}
?>  