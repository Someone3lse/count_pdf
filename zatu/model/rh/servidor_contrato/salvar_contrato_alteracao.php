<?php
$db                   = Conexao::getInstance();
$id                   = $_POST['alteracao_id_sc'];
$contratoId           = strip_tags(@$_POST['id']);
$salario              = $_POST['salario_sc'];
$periodicidade        = $_POST['periodicidade_sc'];
$funcao               = $_POST['funcao_sc'];
$descricao            = $_POST['descricao_sc'];
$dtVigorar            = $_POST['dt_vigorar_sc'];
$dtPublicacao         = $_POST['dt_publicacao_sc'];
$hrEntrada            = $_POST['hora_entrada_sc'];
$hrSaida              = $_POST['hora_saida_sc'];
$hrIntervaloEntrada   = $_POST['hora_intervalo_entrada_sc'];
$hrIntervaloSaida     = $_POST['hora_intervalo_saida_sc'];
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
      FROM rh_servidor_contrato_alteracao 
      WHERE rh_servidor_contrato_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $contratoId);
    $stmt->execute();
    $rsAlteracoesOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsAlteracoesOld as $kAlteracaoOld => $vAlteracaoOld) {
      if (!in_array($vAlteracaoOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_contrato_alteracao 
          WHERE id = ?');
        $stmt->bindValue(1, $vAlteracaoOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_contrato_alteracao 
            SET
            rh_servidor_contrato_id = ?, 
            salario = ?, 
            periodicidade = ?, 
            funcao_nome = ?, 
            funcao_descricao = ?, 
            dt_vigorar = ?, 
            dt_publicacao = ?, 
            hora_entrada = ?, 
            hora_inervalo_entrada = ?, 
            hora_intervalo_saida = ?, 
            hora_saida = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $contratoId);
          $stmt->bindValue(2, converteValorMonetario(strip_tags($salario[$kId])));
          $stmt->bindValue(3, strip_tags($periodicidade[$kId]));
          $stmt->bindValue(4, strip_tags($funcao[$kId]));
          $stmt->bindValue(5, strip_tags($descricao[$kId]));
          $stmt->bindValue(6, formata_data(strip_tags($dtVigorar[$kId])));
          $stmt->bindValue(7, formata_data(strip_tags($dtPublicacao[$kId])));
          $stmt->bindValue(8, strip_tags($hrEntrada[$kId]));
          $stmt->bindValue(9, strip_tags($hrSaida[$kId]));
          $stmt->bindValue(10, strip_tags($hrIntervaloEntrada[$kId]));
          $stmt->bindValue(11, strip_tags($hrIntervaloSaida[$kId]));
          $stmt->bindValue(12, $status);
          $stmt->bindValue(13, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
          $stmt->bindValue(14, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($salario[$kId] != '' && $dtVigorar[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_contrato_alteracao 
              (rh_servidor_contrato_id, 
              salario, 
              periodicidade, 
              funcao_nome, 
              funcao_descricao, 
              dt_vigorar, 
              dt_publicacao, 
              hora_entrada, 
              hora_inervalo_entrada, 
              hora_intervalo_saida, 
              hora_saida, 
              status, 
              dt_cadastro, 
              seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?);');
            $stmt->bindValue(1, $contratoId);
            $stmt->bindValue(2, converteValorMonetario(strip_tags($salario[$kId])));
            $stmt->bindValue(3, strip_tags($periodicidade[$kId]));
            $stmt->bindValue(4, strip_tags($funcao[$kId]));
            $stmt->bindValue(5, strip_tags($descricao[$kId]));
            $stmt->bindValue(6, formata_data(strip_tags($dtVigorar[$kId])));
            $stmt->bindValue(7, formata_data(strip_tags($dtPublicacao[$kId])));
            $stmt->bindValue(8, strip_tags($hrEntrada[$kId]));
            $stmt->bindValue(9, strip_tags($hrSaida[$kId]));
            $stmt->bindValue(10, strip_tags($hrIntervaloEntrada[$kId]));
            $stmt->bindValue(11, strip_tags($hrIntervaloSaida[$kId]));
            $stmt->bindValue(12, $status);
            $stmt->bindValue(13, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
            $stmt->execute();
            $alteracaoIdNew = $db->lastInsertId();
            array_push($ids, $alteracaoIdNew);
          }
          array_push($ids, 0);
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de alterações do contrato do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'contratoId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do contrato para vincular os dados de alterações do contrato do servidor!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de alterações do contrato do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>