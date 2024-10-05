<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['instrucao_id_s'];
$idOld                = $_POST['instrucao_id_old_s'];
$atualizacaoId        = strip_tags(@$_POST['id']);
$escolaridadeId       = $_POST['instrucao_escolaridade_s'];
$formacao             = $_POST['instrucao_formacao_s'];
$conclusaoAno         = $_POST['instrucao_concl_ano_s'];
// $Cursando             = $_POST['instrucao_cursando_s'];
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
$ids = array();
$situacao = 1;
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($atualizacaoId) && $atualizacaoId != "" && $atualizacaoId != 0 ) {
    $stmt = $db->prepare("
      SELECT 
      sas.id, 
      sas.sacad_situacao_servidor_atualizacao_id 
      FROM sacad_servidor_atualizacao_situacao AS sas 
      WHERE sas.sacad_servidor_atualizacao_id = ? 
      ORDER BY sas.id DESC
      LIMIT 1;");
    $stmt->bindValue(1, $atualizacaoId);
    $stmt->execute();
    $rsServidorSituacao = $stmt->fetch(PDO::FETCH_ASSOC);
    if (in_array($rsServidorSituacao['sacad_situacao_servidor_atualizacao_id'], [1, 2])) {
      $situacao = 1;
    } else if (in_array($rsServidorSituacao['sacad_situacao_servidor_atualizacao_id'], [5, 8, 11])) {
      $situacao = 11;
    }
    $stmt = $db->prepare('
      INSERT INTO sacad_servidor_atualizacao_situacao
      (
        obs, 
        status, 
        dt_cadastro, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id, 
        seg_usuario_id) 
      VALUES
      (?, ?, NOW(), ?, ?, ?)');
    $stmt->bindValue(1, '');
    $stmt->bindValue(2, 1);
    $stmt->bindValue(3, $atualizacaoId);
    $stmt->bindValue(4, $situacao);
    $stmt->bindValue(5, NULL);
    $stmt->execute();
    $stmt = $db->prepare('
      SELECT id 
      FROM sacad_servidor_atualizacao_instrucao 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id;');
    $stmt->bindValue(1, $atualizacaoId);
    $stmt->execute();
    $rsInstrucoesOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsInstrucoesOld as $kInstucaoOld => $vInstrucaoOld) {
      if (!in_array($vInstrucaoOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM sacad_servidor_atualizacao_instrucao 
          WHERE id = ?');
        $stmt->bindValue(1, $vInstrucaoOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE sacad_servidor_atualizacao_instrucao 
            SET
            sacad_servidor_atualizacao_id = ?, 
            sacad_servidor_instrucao_id_old = ?, 
            bsc_escolaridade_id = ?, 
            formacao = ?, 
            conclusao_ano = ?, 
            cursando = ?, 
            status = ?, 
            dt_cadastro = NOW() 
            WHERE id = ?;');
          $stmt->bindValue(1, $atualizacaoId);
          $stmt->bindValue(2, strip_tags($idOld[$kId]));
          $stmt->bindValue(3, $escolaridadeId[$kId] != '' ? strip_tags($escolaridadeId[$kId]) : NULL);
          $stmt->bindValue(4, strip_tags($formacao[$kId]));
          $stmt->bindValue(5, strip_tags($conclusaoAno[$kId]));
          $stmt->bindValue(6, strip_tags(@$_POST['instrucao_cursando_s_'.($kId+1)]));
          $stmt->bindValue(7, $status);
          $stmt->bindValue(8, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($escolaridadeId[$kId] != '' && $formacao[$kId] != '' && $conclusaoAno[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO sacad_servidor_atualizacao_instrucao 
              (sacad_servidor_atualizacao_id, 
              sacad_servidor_instrucao_id_old, 
              bsc_escolaridade_id, 
              formacao, 
              conclusao_ano, 
              cursando, 
              status, 
              dt_cadastro) 
              VALUES
              (?, ?, ?, ?, ?, ?, ?, NOW())');
            $stmt->bindValue(1, $atualizacaoId);
            $stmt->bindValue(2, strip_tags($idOld[$kId]));
            $stmt->bindValue(3, $escolaridadeId[$kId] != '' ? strip_tags($escolaridadeId[$kId]) : NULL);
            $stmt->bindValue(4, strip_tags($formacao[$kId]));
            $stmt->bindValue(5, strip_tags($conclusaoAno[$kId]));
            $stmt->bindValue(6, strip_tags(@$_POST['instrucao_cursando_s_'.($kId+1)]));
            $stmt->bindValue(7, $status);
            $stmt->execute();
            $instrucaoIdNew = $db->lastInsertId();
            array_push($ids, $instrucaoIdNew);
          }
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de instruções do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de instruções!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de instruções do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>