<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['saude_id_s'];
$servidorId           = strip_tags(@$_POST['id']);
$dtOcorrido           = $_POST['saude_dt_ocorrido_s'];
$descricao            = $_POST['saude_descricao_s'];
$dtInicio             = $_POST['saude_dt_inicio_s'];
$dtFim                = $_POST['saude_dt_fim_s'];
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
  if (is_numeric($servidorId) && $servidorId != "" && $servidorId != 0 ) {
    $stmt = $db->prepare('
      SELECT id 
      FROM rh_servidor_saude 
      WHERE rh_servidor_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $servidorId);
    $stmt->execute();
    $rsSaudeOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsSaudeOld as $kSaudeOld => $vSaudeOld) {
      if (!in_array($vSaudeOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_saude 
          WHERE id = ?');
        $stmt->bindValue(1, $vSaudeOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_saude 
            SET
            rh_servidor_id = ?, 
            dt_ocorrido = ?, 
            descricao = ?,  
            dt_inicio = ?, 
            dt_fim = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $servidorId);
          $stmt->bindValue(2, formata_data(strip_tags($dtOcorrido[$kId])));
          $stmt->bindValue(3, strip_tags($descricao[$kId]));
          $stmt->bindValue(4, formata_data(strip_tags($dtInicio[$kId])));
          $stmt->bindValue(5, formata_data(strip_tags($dtFim[$kId])));
          $stmt->bindValue(6, $status);
          $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(8, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($dtOcorrido[$kId] != '' && $descricao[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_saude 
              (rh_servidor_id, 
              dt_ocorrido, 
              descricao, 
              dt_inicio, 
              dt_fim, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, NOW(), ?);');
            $stmt->bindValue(1, $servidorId);
            $stmt->bindValue(2, formata_data(strip_tags($dtOcorrido[$kId])));
            $stmt->bindValue(3, strip_tags($descricao[$kId]));
            $stmt->bindValue(4, formata_data(strip_tags($dtInicio[$kId])));
            $stmt->bindValue(5, formata_data(strip_tags($dtFim[$kId])));
            $stmt->bindValue(6, $status);
            $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
            $stmt->execute();
            $saudeIdNew = $db->lastInsertId();
            array_push($ids, $saudeIdNew);
          }
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de enfermidade do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de enfermidade!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de enfermidade do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>