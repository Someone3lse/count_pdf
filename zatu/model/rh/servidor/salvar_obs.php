<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['obs_id_s'];
$servidorId           = strip_tags(@$_POST['id']);
$dtOcorrido           = $_POST['obs_dt_ocorrido_s'];
$descricao            = $_POST['obs_descricao_s'];
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
      FROM rh_servidor_obs 
      WHERE rh_servidor_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $servidorId);
    $stmt->execute();
    $rsObsOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsObsOld as $kObsOld => $vObsOld) {
      if (!in_array($vObsOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_obs 
          WHERE id = ?');
        $stmt->bindValue(1, $vObsOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_obs 
            SET
            rh_servidor_id = ?, 
            dt_ocorrido = ?, 
            descricao = ?,  
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $servidorId);
          $stmt->bindValue(2, formata_data(strip_tags($dtOcorrido[$kId])));
          $stmt->bindValue(3, strip_tags($descricao[$kId]));
          $stmt->bindValue(4, $status);
          $stmt->bindValue(5, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(6, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($dtOcorrido[$kId] != '' && $descricao[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_obs 
              (rh_servidor_id, 
              dt_ocorrido, 
              descricao, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, NOW(), ?)');
            $stmt->bindValue(1, $servidorId);
            $stmt->bindValue(2, formata_data(strip_tags($dtOcorrido[$kId])));
            $stmt->bindValue(3, strip_tags($descricao[$kId]));
            $stmt->bindValue(4, $status);
            $stmt->bindValue(5, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
            $stmt->execute();
            $obsIdNew = $db->lastInsertId();
            array_push($ids, $obsIdNew);
          }
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de observação do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de observação!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de observação do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>