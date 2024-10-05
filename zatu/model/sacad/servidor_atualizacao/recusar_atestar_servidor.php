<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$obs = strip_tags(@$_POST['obs']);
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if ($id != "" && $id != 0 && $obs != '') {
    $stmt = $db->prepare('
      INSERT sacad_servidor_atualizacao_situacao  
      (obs, 
        status, 
        dt_cadastro, 
        seg_usuario_id_atestador, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id) 
      VALUES (?, ?, NOW(), ?, ?, ? );');
    $stmt->bindValue(1, $obs);
    $stmt->bindValue(2, 1);
    $stmt->bindValue(3, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
    $stmt->bindValue(4, $id);
    $stmt->bindValue(5, 3);
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Atestação recusada com sucesso.';
    $msg['texto'] = 'Situação: Ativo <br/>Detalhe: Atestação recusada pelo chefe imediato';
    echo json_encode($msg);
    exit();
  } else {
    if ($obs == '') {
      $msg['retorno'] = 'A justificativa é obrigatória.';
    } else {
      $msg['retorno'] = 'Erro ao tentar recusar atestação do servidor.';
    }
    $db->rollback();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'error';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar recusar atestação do servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>