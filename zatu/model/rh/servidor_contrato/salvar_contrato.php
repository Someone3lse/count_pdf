<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['id']);
$servidorId           = strip_tags(@$_POST['servidor_sc']);
$servidorTipoId       = strip_tags(@$_POST['servidor_tipo_sc']);
$uoId                 = strip_tags(@$_POST['uo_sc']);
$numero               = strip_tags(@$_POST['numero_sc']);
$setor                = strip_tags(@$_POST['setor_sc']);
$cargoId              = strip_tags(@$_POST['cargo_sc']);
$municipioId          = strip_tags(@$_POST['municipio_sc']);
$dtPublicacao         = strip_tags(@$_POST['dt_publicacao_sc']);
$dtInicio             = strip_tags(@$_POST['dt_inicio_sc']);
$drFim                = strip_tags(@$_POST['dt_fim_sc']);
$fimIndefinido        = strip_tags(@$_POST['fim_indefinido_sc']);
$situacao             = strip_tags(@$_POST['situacao_sc']);
$dtDesligamento       = strip_tags(@$_POST['desligamento_dt_sc']);
$tipoDesligamento     = strip_tags(@$_POST['desligamento_tipo_sc']);
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
$ids = array();
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  $stmt = $db->prepare('SELECT id, contrato_numero
    FROM rh_servidor_contrato  
    WHERE contrato_numero LIKE ?;');
  $stmt->bindValue(1, $numero);
  $stmt->execute();
  $rsPesquisa = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!is_null($rsPesquisa['id']) && $rsPesquisa['id'] != $id) {
    $error = true;
    $mensagem = array();
    $msg['tipo'] = "nome";
    if ($rsPesquisa['nome'] == $numero) {
      $mensagem['nome'] = 'O numero do contrato informado já existe no sistema. ';
    }
  }
  if ($error == false) {
    if (is_numeric($id) && $id != "" && $id != 0 ) {
      $stmt = $db->prepare('
        UPDATE rh_servidor_contrato 
        SET
        rh_servidor_id = ?, 
        rh_servidor_tipo_id = ?, 
        bsc_unidade_organizacional_id = ?, 
        contrato_numero = ?, 
        setor = ?, 
        bsc_municipio_id = ?, 
        dt_publicacao = ?, 
        contrato_dt_inicio = ?, 
        contrato_dt_fim = ?, 
        contrato_fim_indefinido = ?, 
        situacao = ?, 
        desligamento_dt = ?, 
        desligamento_tipo = ?, 
        eo_cargo_id = ?, 
        status = ?, 
        dt_cadastro = NOW(), 
        seg_usuario_id = ?
        WHERE id = ? ;');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $servidorTipoId);
      $stmt->bindValue(3, $uoId);
      $stmt->bindValue(4, $numero);
      $stmt->bindValue(5, $setor);
      $stmt->bindValue(6, $municipioId);
      $stmt->bindValue(7, formata_data($dtPublicacao));
      $stmt->bindValue(8, formata_data($dtInicio));
      $stmt->bindValue(9, formata_data($drFim));
      $stmt->bindValue(10, $fimIndefinido);
      $stmt->bindValue(11, $situacao);
      $stmt->bindValue(12, formata_data($dtDesligamento));
      $stmt->bindValue(13, $tipoDesligamento);
      $stmt->bindValue(14, $cargoId);
      $stmt->bindValue(15, $status);
      $stmt->bindValue(16, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->bindValue(17, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de contrato do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO rh_servidor_contrato 
        (rh_servidor_id, 
        rh_servidor_tipo_id, 
        bsc_unidade_organizacional_id, 
        contrato_numero, 
        setor, 
        bsc_municipio_id, 
        dt_publicacao, 
        contrato_dt_inicio, 
        contrato_dt_fim, 
        contrato_fim_indefinido, 
        situacao, 
        desligamento_dt, 
        desligamento_tipo, 
        cargo_id, 
        status, 
        dt_cadastro, 
        seg_usuario_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $servidorTipoId);
      $stmt->bindValue(3, $uoId);
      $stmt->bindValue(4, $numero);
      $stmt->bindValue(5, $setor);
      $stmt->bindValue(6, $municipioId);
      $stmt->bindValue(7, formata_data($dtPublicacao));
      $stmt->bindValue(8, formata_data($dtInicio));
      $stmt->bindValue(9, formata_data($drFim));
      $stmt->bindValue(10, $fimIndefinido);
      $stmt->bindValue(11, $situacao);
      $stmt->bindValue(12, formata_data($dtDesligamento));
      $stmt->bindValue(13, $tipoDesligamento);
      $stmt->bindValue(14, $cargoId);
      $stmt->bindValue(15, $status);
      $stmt->bindValue(16, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->execute();
      $contratoId = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $contratoId;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de contrato do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'nome';
    $msg['msg'] = 'error';
    $msg['retorno'] = $mensagem;
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