<?php
$db           = Conexao::getInstance();
$id           = strip_tags(@$_POST['id']);
$obs          = strip_tags(@$_POST['obs']);
$contrato     = strip_tags(@$_POST['contrato']);
$error        = false;
$msg          = array();
$mensagem     = "";
try {
  $db->beginTransaction();
  if ($id != "" && $id != 0 && $obs != '') {
    if ($contrato == 1) {
      $stmt = $db->prepare('
        UPDATE sacad_servidor_atualizacao 
        SET
        atestacao_matricula = ?, 
        dt_cadastro = NOW()  
        WHERE id = ? ;');
      $stmt->bindValue(1, 2);
      $stmt->bindValue(2, $id);
      $stmt->execute();
    }
    if ($contrato == 2) {
      $stmt = $db->prepare('
        UPDATE sacad_servidor_atualizacao 
        SET
        atestacao_matricula_2 = ?, 
        dt_cadastro = NOW()  
        WHERE id = ? ;');
      $stmt->bindValue(1, 2);
      $stmt->bindValue(2, $id);
      $stmt->execute();
    }
    $stmt = $db->prepare('
      SELECT 
      matricula, 
      matricula_2, 
      atestacao_matricula, 
      atestacao_matricula_2 
      FROM sacad_servidor_atualizacao 
      WHERE id = ? ;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $rsServidorAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
    if (($rsServidorAtualizacao['atestacao_matricula'] != NULL && $rsServidorAtualizacao['matricula_2'] == NULL) || ($rsServidorAtualizacao['atestacao_matricula'] != NULL && $rsServidorAtualizacao['atestacao_matricula_2'] != NULL)) {
      if ($contrato == 1) {
        $stmt = $db->prepare('
          INSERT sacad_servidor_atualizacao_situacao  
          (obs, 
            status, 
            dt_cadastro, 
            seg_usuario_id_atestador, 
            sacad_servidor_atualizacao_id, 
            matricula, 
            sacad_situacao_servidor_atualizacao_id) 
          VALUES (?, ?, NOW(), ?, ?, ?, ? );');
        $stmt->bindValue(1, $obs);
        $stmt->bindValue(2, 1);
        $stmt->bindValue(3, $_SESSION['zatu_id']);
        $stmt->bindValue(4, $id);
        $stmt->bindValue(5, 1);
        $stmt->bindValue(6, 3);
        $stmt->execute();
      } else if ($contrato == 2) {
        $stmt = $db->prepare('
          INSERT sacad_servidor_atualizacao_situacao  
          (obs, 
            status, 
            dt_cadastro, 
            seg_usuario_id_atestador, 
            sacad_servidor_atualizacao_id, 
            matricula_2, 
            sacad_situacao_servidor_atualizacao_id) 
          VALUES (?, ?, NOW(), ?, ?, ?, ? );');
        $stmt->bindValue(1, $obs);
        $stmt->bindValue(2, 1);
        $stmt->bindValue(3, $_SESSION['zatu_id']);
        $stmt->bindValue(4, $id);
        $stmt->bindValue(5, 1);
        $stmt->bindValue(6, 3);
        $stmt->execute();
      }
      $stmt = $db->prepare('
        INSERT sacad_servidor_atualizacao_situacao 
        (status, 
          dt_cadastro, 
          seg_usuario_id_atestador, 
          sacad_servidor_atualizacao_id, 
          sacad_situacao_servidor_atualizacao_id) 
        VALUES (?, NOW(), ?, ?, ? );');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $id);
      $stmt->bindValue(4, 5);
      $stmt->execute();
    }
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Atestação recusada com sucesso.';
    $msg['texto'] = 'Situação: Ativo <br/>Detalhe: Atestação recusada pelo chefe imediato';
    echo json_encode($msg);
    exit();
  } else {
    if ($obs == '') {
      $msg['retorno'] = 'A justificativa é obrigatória.';
    } else {
      $msg['retorno'] = 'Erro ao tentar recusar atestação do servidor.';
    }
    $db->rollback();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'error';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar recusar atestação do servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>