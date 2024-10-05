<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['servidor_bancario_id_s']);
$servidorId           = strip_tags(@$_POST['id']);
$contaTipoId          = strip_tags(@$_POST['bancario_conta_tipo_s']);
$bancoId              = strip_tags(@$_POST['bancario_banco_s']);
$agencia              = strip_tags(@$_POST['bancario_agencia_s']);
$conta                = strip_tags(@$_POST['bancario_conta_s']);
$op                   = strip_tags(@$_POST['bancario_op_s']);
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($servidorId) && $servidorId != "" && $servidorId != 0 ) {
    if (is_numeric($id) && $id != "" && $id != 0 ) {
      $stmt = $db->prepare('
        UPDATE rh_servidor_bancario 
        SET
        rh_servidor_id = ?, 
        bancario_bsc_banco_conta_tipo_id = ?, 
        bancario_bsc_banco_id = ?, 
        bancario_agencia = ?, 
        bancario_conta = ?, 
        bancario_op = ?, 
        status = ?,
        dt_cadastro = NOW(), 
        seg_usuario_id = ?
        WHERE id = ?;');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $contaTipoId != '' ? $contaTipoId : NULL);
      $stmt->bindValue(3, $bancoId != '' ? $bancoId : NULL);
      $stmt->bindValue(4, $agencia);
      $stmt->bindValue(5, $conta);
      $stmt->bindValue(6, $op);
      $stmt->bindValue(7, $status);
      $stmt->bindValue(8, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->bindValue(9, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de familia do servidor atualizados com sucesso.';
      echo json_encode($msg);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO rh_servidor_bancario 
        (rh_servidor_id, 
        bancario_bsc_banco_conta_tipo_id, 
        bancario_bsc_banco_id, 
        bancario_agencia, 
        bancario_conta, 
        bancario_op, 
        status,
        dt_cadastro, 
        seg_usuario_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, NOW(), ?);');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $contaTipoId != '' ? $contaTipoId : NULL);
      $stmt->bindValue(3, $bancoId != '' ? $bancoId : NULL);
      $stmt->bindValue(4, $agencia);
      $stmt->bindValue(5, $conta);
      $stmt->bindValue(6, $op);
      $stmt->bindValue(7, $status);
      $stmt->bindValue(8, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->execute();
      $bancarioIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $bancarioIdNew;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados bancarios do servidor cadastrados com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados bancarios!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar salvar os dados bancarios do servidor: +" . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>