<?php
$db = Conexao::getInstance();
try {
  $db->beginTransaction();
  $stmt = $db->prepare("
    UPDATE session  
    SET timeout = 0;");
  $stmt->execute();
  $db->commit();
} catch (PDOException $e) {
  $db->rollback();
  $retorno["msg"] = "error";
  $retorno["retorno"] = "Erro ao tentar enviar os arquivos: " . $e->getMessage();
  echo json_encode($retorno);
  exit();
}
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
<link rel="icon" type="image/png" sizes="16x16" href="<?= IMG_FOLDER; ?>cooperfrig_favicon.png">
<title>:: <?= TITULO_SISTEMA ?> ::</title>
<!-- FAVICON END -->
</head>
<body>
  <form id="form_logout" name="form_logout" method="post" action="<?= PORTAL_URL ;?>login">
  </form>
  </body>
</html>
<script type="text/javascript">document.getElementById("form_logout").submit();</script>