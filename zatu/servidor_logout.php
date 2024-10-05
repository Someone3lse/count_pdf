<?php
// URL AMIGAVEL E CONEXAO BY CONFIG 
if(isset($_SESSION['servidor_zatu_id'])) {
  $sessao = $_SESSION['servidor_zatu_id'];
} else {
  $sessao = 0;
}
$urlanterior = isset($_POST['urlanterior']) ? $_POST['urlanterior'] : '';
$sessionId = session_id();
$db = Conexao::getInstance();
$sair = $db->prepare("UPDATE seg_servidor_sessao 
  SET dt_logout = NOW() 
  WHERE seg_servidor_id = ?");
$sair->bindValue(1, $sessao);
$sair->execute();
$atualizar = $db->prepare("UPDATE seg_servidor 
 SET online = 0 
 WHERE id = ?");
$atualizar->bindValue(1, $sessao);
$atualizar->execute();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?= TITULO_SISTEMA ?></title>
  <!-- METAS BEGIN -->
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="192x192" href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <title>:: <?= TITULO_SISTEMA ?> ::</title>
  <!-- FAVICON END -->
</head>
<body>
  <form id="form_servidor_logout" name="form_servidor_logout" method="post" action="<?= PORTAL_URL ;?>">
    <input type="hidden" id="servidor_zatu_id" name="servidor_zatu_id" value="<?= $sessao ;?>">
    <input type="hidden" id="urlanterior" name="urlanterior" value="<?= $urlanterior ;?>">
  </form>
</body>
</html>
<script type="text/javascript">document.getElementById("form_servidor_logout").submit();</script>