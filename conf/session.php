<?php 
//time duration session
function sessionOn(){
  //VERIFICAÇÃO DE SESSION COM TIMEOUT PARA EXPIRAR
  // 30 minutos em segundos
  $inactive_session = 1800;
  $urlanterior = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  if( isset($_SESSION['id']) ){
    $_SESSION['timeout'] = $_SESSION['timeout'] != null || $_SESSION['timeout'] != '' ? $_SESSION['timeout'] : 0;
    $session_life = time() - $_SESSION['timeout'] ;
    if( $session_life > $inactive_session ){
      if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
        echo "logout";
        exit();
      } else {
          ?>
        <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>logout';</script>
        <?php
      }
    } else {
      $_SESSION['timeout'] = time();
    }
  }
}//end function
function busca_usuario_session() {
  global $db;
  @session_start();
  if(isset($_SESSION['id'])) {
    verifica_existe_sessao(); // INSERI NA SESSÃO A DATA E HORA DA ÚLTIMA AÇÃO DO USUÁRIO
  } else if(Url::getURL(0) != 'login' && Url::getURL(0) != 'login.php' && Url::getURL(0) != 'autenticar') {
    ?>
    <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>logout';</script>
    <?php
    exit();
  }
}
function verifica_existe_sessao() {
  @session_start();
  if(Url::getURL(4) != 'css' && Url::getURL(3) != 'media' && Url::getURL(4) != 'js') {
    $usuario = $rs->fetch(PDO::FETCH_ASSOC);
    if(isset($_SESSION['id'])) {
      atualiza_sessao();
    } else {
      cria_sessao();
    }
  }
}
function cria_sessao() {
  @session_start();
  $_SESSION['id'] = 1;
}
function atualiza_sessao() {
  @session_start();
  $_SESSION['id'] = 1;
}
?>