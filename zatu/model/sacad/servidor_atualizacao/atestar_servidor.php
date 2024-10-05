<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if ($id != "" && $id != 0) {
    $stmt = $db->prepare('
      INSERT sacad_servidor_atualizacao_situacao 
      (status, 
        dt_cadastro, 
        seg_usuario_id_atestador, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id) 
      VALUES (?, NOW(), ?, ?, ? );');
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
    $stmt->bindValue(3, $id);
    $stmt->bindValue(4, 4);
    $stmt->execute();
    $stmt = $db->prepare('
      INSERT sacad_servidor_atualizacao_situacao 
      (status, 
        dt_cadastro, 
        seg_usuario_id_atestador, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id) 
      VALUES (?, NOW(), ?, ?, ? );');
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
    $stmt->bindValue(3, $id);
    $stmt->bindValue(4, 5);
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Servidor atestado com sucesso.';
    $msg['texto'] = 'Situação: Ativo <br/>Detalhe: Atestação aceita pelo chefe imediato';
    echo json_encode($msg);
    exit();
  } else {
    $db->rollback();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Erro ao tentar atestar o servidor.';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar atestar o servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>