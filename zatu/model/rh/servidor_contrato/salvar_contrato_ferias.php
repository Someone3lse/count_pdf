<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['ferias_id_sc'];
$contratoId           = strip_tags(@$_POST['id']);
$dtAquisitivoInicio   = $_POST['dt_aquisitivo_inicio_sc'];
$dtAquisitivoFim      = $_POST['dt_aquisitivo_fim_sc'];
$dtGozoInicio         = $_POST['dt_gozo_inicio_sc'];
$dtGozoFim            = $_POST['dt_gozo_fim_sc'];
$obs                  = $_POST['obs_sc'];
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
$ids = array();
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($contratoId) && $contratoId != "" && $contratoId != 0 ) {
    $stmt = $db->prepare('
      SELECT id 
      FROM rh_servidor_contrato_ferias 
      WHERE rh_servidor_contrato_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $contratoId);
    $stmt->execute();
    $rsContratoOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsContratoOld as $kContratoOld => $vContratoOld) {
      if (!in_array($vContratoOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_contrato_ferias 
          WHERE id = ?');
        $stmt->bindValue(1, $vContratoOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_contrato_ferias 
            SET
            rh_servidor_contrato_id = ?, 
            aquisitivo_dt_inicio = ?, 
            aquisitivo_dt_fim = ?, 
            gozo_dt_inicio = ?, 
            gozo_dt_fim = ?, 
            obs = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $contratoId);
          $stmt->bindValue(2, formata_data(strip_tags($dtAquisitivoInicio[$kId])));
          $stmt->bindValue(3, formata_data(strip_tags($dtAquisitivoFim[$kId])));
          $stmt->bindValue(4, formata_data(strip_tags($dtGozoInicio[$kId])));
          $stmt->bindValue(5, formata_data(strip_tags($dtGozoFim[$kId])));
          $stmt->bindValue(6, strip_tags($obs[$kId]));
          $stmt->bindValue(7, $status);
          $stmt->bindValue(8, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(9, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($dtAquisitivoInicio[$kId] != '' && $dtAquisitivoFim[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_contrato_ferias 
              (rh_servidor_contrato_id, 
              aquisitivo_dt_inicio, 
              aquisitivo_dt_fim, 
              gozo_dt_inicio, 
              gozo_dt_fim, 
              obs, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, ?, NOW(), ?);');
          $stmt->bindValue(1, $contratoId);
          $stmt->bindValue(2, formata_data(strip_tags($dtAquisitivoInicio[$kId])));
          $stmt->bindValue(3, formata_data(strip_tags($dtAquisitivoFim[$kId])));
          $stmt->bindValue(4, formata_data(strip_tags($dtGozoInicio[$kId])));
          $stmt->bindValue(5, formata_data(strip_tags($dtGozoFim[$kId])));
          $stmt->bindValue(6, strip_tags($obs[$kId]));
          $stmt->bindValue(7, $status);
          $stmt->bindValue(8, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
            $stmt->execute();
            $feriasIdNew = $db->lastInsertId();
            array_push($ids, $feriasIdNew);
          }
          array_push($ids, 0);
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de férias do contrato do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'contratoId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do contrato para vincular os dados de férias do contrato do servidor!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de férias do contrato do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>