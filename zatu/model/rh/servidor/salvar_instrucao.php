<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['instrucao_id_s'];
$servidorId           = strip_tags(@$_POST['id']);
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
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($servidorId) && $servidorId != "" && $servidorId != 0 ) {
    $stmt = $db->prepare('
      SELECT id 
      FROM rh_servidor_instrucao 
      WHERE rh_servidor_id = ? 
      ORDER BY id;');
    $stmt->bindValue(1, $servidorId);
    $stmt->execute();
    $rsInstrucoesOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsInstrucoesOld as $kInstucaoOld => $vInstrucaoOld) {
      if (!in_array($vInstrucaoOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_instrucao 
          WHERE id = ?');
        $stmt->bindValue(1, $vInstrucaoOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_instrucao 
            SET
            rh_servidor_id = ?, 
            bsc_escolaridade_id = ?, 
            formacao = ?, 
            conclusao_ano = ?, 
            cursando = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $servidorId);
          $stmt->bindValue(2, $escolaridadeId[$kId] != '' ? strip_tags($escolaridadeId[$kId]) : NULL);
          $stmt->bindValue(3, strip_tags($formacao[$kId]));
          $stmt->bindValue(4, strip_tags($conclusaoAno[$kId]));
          $stmt->bindValue(5, strip_tags(@$_POST['instrucao_cursando_s_'.($kId+1)]));
          $stmt->bindValue(6, $status);
          $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(8, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($escolaridadeId[$kId] != '' && $formacao[$kId] != '' && $conclusaoAno[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_instrucao 
              (rh_servidor_id, 
              bsc_escolaridade_id, 
              formacao, 
              conclusao_ano, 
              cursando, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, NOW(), ?)');
            $stmt->bindValue(1, $servidorId);
            $stmt->bindValue(2, $escolaridadeId[$kId] != '' ? strip_tags($escolaridadeId[$kId]) : NULL);
            $stmt->bindValue(3, strip_tags($formacao[$kId]));
            $stmt->bindValue(4, strip_tags($conclusaoAno[$kId]));
            $stmt->bindValue(5, strip_tags(@$_POST['instrucao_cursando_s_'.($kId+1)]));
            $stmt->bindValue(6, $status);
            $stmt->bindValue(7, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
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