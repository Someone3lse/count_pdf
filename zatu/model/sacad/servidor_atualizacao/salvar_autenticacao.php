<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['id']);
$status               = 1;
$atestacaoMatricula   = NULL;
$atestacaoMatricula2  = NULL;
$error                = false;
$msg                  = array();
$mensagem             = "";
$situacao             = 2;
$dateNow              = new DateTime();
$autenticacao         = uniqid(rand(), true).$dateNow->format('YmdHis');
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != "" && $id != 0 ) {
    $stmt = $db->prepare('
      SELECT  
      sas.status, 
      sas.sacad_servidor_atualizacao_id, 
      sas.sacad_situacao_servidor_atualizacao_id, 
      sa.autenticacao, 
      sa.eo_setor_unidade_organizacional_id, 
      sa.eo_setor_unidade_organizacional_id_2, 
      sa.rh_situacao_trabalho_id, 
      sa.rh_situacao_trabalho_id_2, 
      sa.atestacao_matricula, 
      sa.atestacao_matricula_2 
      FROM sacad_servidor_atualizacao_situacao AS sas 
      LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.id = sas.sacad_servidor_atualizacao_id
      WHERE sas.sacad_servidor_atualizacao_id = ? 
      ORDER BY sas.id DESC 
      LIMIT 1;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $rsServidorAtualizacaoSituacao = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (in_array($rsServidorAtualizacaoSituacao['sacad_situacao_servidor_atualizacao_id'], [1, 2])) {
      $situacao = 2;
    } else if (in_array($rsServidorAtualizacaoSituacao['sacad_situacao_servidor_atualizacao_id'], [5, 8, 11, 12, 13])) {
      $situacao = 12;
      if ($rsServidorAtualizacaoSituacao['atestacao_matricula'] == NULL && $rsServidorAtualizacaoSituacao['rh_situacao_trabalho_id'] == 1) {
        $situacao = 13;
      }
      if ($rsServidorAtualizacaoSituacao['atestacao_matricula_2'] == NULL && $rsServidorAtualizacaoSituacao['atestacao_matricula_2'] == 1) {
        $situacao = 13;
      }
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao 
      SET
      dt_envio = NOW(), 
      status = ?, 
      autenticacao = ?  
      WHERE id = ?  ;');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $autenticacao);
    $stmt->bindValue(3, $id);
    $stmt->execute();
    $stmt = $db->prepare('
      INSERT INTO sacad_servidor_atualizacao_situacao
      (obs, 
        status, 
        dt_cadastro, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id, 
        seg_usuario_id) 
      VALUES
      (?, ?, NOW(), ?, ?, ?)');
    $stmt->bindValue(1, '');
    $stmt->bindValue(2, 1);
    $stmt->bindValue(3, $id);
    $stmt->bindValue(4, $situacao);
    $stmt->bindValue(5, NULL);
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['autenticacao'] = $autenticacao;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Atualização finalizada e código de autenticação gerado com sucesso.';
    echo json_encode($msg);
    exit();
  } else {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = "Não foi encontrato um servidor para vincular a autenticação!";
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar gerar o codigo de autenticação de atualização servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>