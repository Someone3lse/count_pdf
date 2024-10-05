<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['vinculo_id_s'];
$servidorId           = strip_tags(@$_POST['id']);
$local                = $_POST['vinculo_local_s'];
$esfera               = $_POST['vinculo_esfera_s'];
$cargo                = $_POST['vinculo_cargo_s'];
$cargaHoraria         = $_POST['vinculo_carga_horaria_s'];
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
      FROM rh_servidor_vinculo 
      WHERE rh_servidor_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $servidorId);
    $stmt->execute();
    $rsVinculosOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsVinculosOld as $kVinculoOld => $vVinculoOld) {
      if (!in_array($vVinculoOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_vinculo 
          WHERE id = ?');
        $stmt->bindValue(1, $vVinculoOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_vinculo 
            SET
            rh_servidor_id = ?, 
            local = ?, 
            esfera = ?, 
            cargo = ?, 
            carga_horaria = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $servidorId);
          $stmt->bindValue(2, strip_tags($local[$kId]));
          $stmt->bindValue(3, strip_tags($esfera[$kId]));
          $stmt->bindValue(4, strip_tags($cargo[$kId]));
          $stmt->bindValue(5, strip_tags($cargaHoraria[$kId]));
          $stmt->bindValue(6, $status);
          $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(8, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($local[$kId] != '' && $cargo[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_vinculo 
              (rh_servidor_id, 
              local, 
              esfera, 
              cargo, 
              carga_horaria, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, NOW(), ?)');
            $stmt->bindValue(1, $servidorId);
            $stmt->bindValue(2, strip_tags($local[$kId]));
            $stmt->bindValue(3, strip_tags($esfera[$kId]));
            $stmt->bindValue(4, strip_tags($cargo[$kId]));
            $stmt->bindValue(5, strip_tags($cargaHoraria[$kId]));
            $stmt->bindValue(6, $status);
            $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
            $stmt->execute();
            $vinculoIdNew = $db->lastInsertId();
            array_push($ids, $vinculoIdNew);
          }
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de vinculos do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de vinculos!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de vinculos do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>