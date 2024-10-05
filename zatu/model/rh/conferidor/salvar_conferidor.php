<?php
$db               = Conexao::getInstance();
$id               = strip_tags(@$_POST['id']);
$usuarioId        = strip_tags(@$_POST['usuario']);
$setoresUO        = @$_POST['suo_id'];
$status           = strip_tags(@$_POST['status_a']) == "on" ? 1 : 0;
$error            = false;
$msg              = array();
$mensagem         = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT * 
    FROM rh_conferidor 
    WHERE seg_usuario_id_conferidor = ? 
    ORDER BY id');
  $stmt->bindValue(1, $id);
  $stmt->execute();
  $rsConferidorOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rsConferidorOld as $kOld => $vOld) {
    if (!in_array($vOld['eo_setor_unidade_organizacional_id'], $setoresUO)) {
      $stmt = $db->prepare('
        DELETE  
        FROM rh_conferidor  
        WHERE id = ?;');
      $stmt->bindValue(1, $vOld['id']);
      $stmt->execute();
      array_splice($rsConferidorOld, $vOld['id'], 1);
    }
  }
  foreach ($setoresUO as $k => $v) {
    if (in_array($v, array_column($rsConferidorOld, 'eo_setor_unidade_organizacional_id'))) {
      $stmt = $db->prepare('
        UPDATE rh_conferidor 
        SET 
          status = ?, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ? 
          WHERE seg_usuario_id_conferidor = ? AND eo_setor_unidade_organizacional_id = ?;');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $usuarioId);
      $stmt->bindValue(4, strip_tags($v));
      $stmt->execute();
    } else {
      $stmt = $db->prepare('
        INSERT INTO rh_conferidor 
        ( 
          status, 
          dt_cadastro, 
          seg_usuario_id, 
          seg_usuario_id_conferidor, 
          eo_setor_unidade_organizacional_id) 
        VALUES (?, NOW(), ?, ?, ?);');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $usuarioId);
      $stmt->bindValue(4, strip_tags($v));
      $stmt->execute();
    }
  }
  $db->commit();
  $msg['id'] = $id;
  $msg['msg'] = 'success';
  $msg['retorno'] = 'Validador de dados registrado com sucesso.';
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar registrar o validador de dados: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>