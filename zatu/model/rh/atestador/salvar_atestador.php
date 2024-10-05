<?php
$db               = Conexao::getInstance();
$id               = strip_tags(@$_POST['id']);
$usuarioId        = strip_tags(@$_POST['usuario']);
$dtInicio         = strip_tags(@$_POST['dt_inicio']);
$dtFim            = strip_tags(@$_POST['dt_fim']);
$setoresUO        = @$_POST['suo_id'];
$status           = strip_tags(@$_POST['status_a']) == "on" ? 1 : 0;
$error            = false;
$msg              = array();
$mensagem         = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT * 
    FROM rh_atestador 
    WHERE seg_usuario_id_atestador = ? 
    ORDER BY id');
  $stmt->bindValue(1, $id);
  $stmt->execute();
  $rsAtestadorOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rsAtestadorOld as $kOld => $vOld) {
    if (!in_array($vOld['eo_setor_unidade_organizacional_id'], $setoresUO)) {
      $stmt = $db->prepare('
        DELETE  
        FROM rh_atestador  
        WHERE id = ?;');
      $stmt->bindValue(1, $vOld['id']);
      $stmt->execute();
      array_splice($rsAtestadorOld, $vOld['id'], 1);
    }
  }
  foreach ($setoresUO as $k => $v) {
    if (in_array($v, array_column($rsAtestadorOld, 'eo_setor_unidade_organizacional_id'))) {
      $stmt = $db->prepare('
        UPDATE rh_atestador 
        SET 
          dt_inicio = ?, 
          dt_fim = ?, 
          status = ?, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ? 
          WHERE seg_usuario_id_atestador = ? AND eo_setor_unidade_organizacional_id = ?;');
      $stmt->bindValue(1, formata_data($dtInicio));
      $stmt->bindValue(2, formata_data($dtFim));
      $stmt->bindValue(3, 1);
      $stmt->bindValue(4, $_SESSION['zatu_id']);
      $stmt->bindValue(5, $usuarioId);
      $stmt->bindValue(6, strip_tags($v));
      $stmt->execute();
    } else {
      $stmt = $db->prepare('
        INSERT INTO rh_atestador 
        ( 
          dt_inicio, 
          dt_fim, 
          status, 
          dt_cadastro, 
          seg_usuario_id, 
          seg_usuario_id_atestador, 
          eo_setor_unidade_organizacional_id) 
        VALUES (?, ?, ?, NOW(), ?, ?, ?);');
      $stmt->bindValue(1, formata_data($dtInicio));
      $stmt->bindValue(2, formata_data($dtFim));
      $stmt->bindValue(3, 1);
      $stmt->bindValue(4, $_SESSION['zatu_id']);
      $stmt->bindValue(5, $usuarioId);
      $stmt->bindValue(6, strip_tags($v));
      $stmt->execute();
    }
  }
  $db->commit();
  $msg['id'] = $id;
  $msg['msg'] = 'success';
  $msg['retorno'] = 'Chefe imediato registrado com sucesso.';
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar registrar o chefe imediato: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>