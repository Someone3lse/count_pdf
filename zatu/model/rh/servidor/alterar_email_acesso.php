<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$email = strip_tags(@$_POST['email']);
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  if ($id != "" && $id != 0) {
    $stmt = $db->prepare('
      SELECT id, nome, status, email 
      FROM seg_servidor 
      WHERE email = ?;');
    $stmt->bindValue(1, $email);
    $stmt->execute();
    $rsPesquisa = $stmt->fetch(PDO::FETCH_ASSOC);
    if (sizeof($rsPesquisa) > 0) {
      $msg['id'] = $id;
      $msg['msg'] = 'error';
      $msg['retorno'] = 'O e-mail informado já existe relacionado a um(a) servidor(a). Tente novamente informando um outro e-mail.';
      echo json_encode($msg);
      exit();
    }
    $stmt = $db->prepare('
      SELECT id, nome, status 
      FROM seg_servidor 
      WHERE id = ? AND status = ?;');
    $stmt->bindValue(1, $id);
    $stmt->bindValue(2, 1); //1 = Ativo
    $stmt->execute();
    $rsPesquisa = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $db->prepare('
      UPDATE seg_servidor  
      SET
      email = ?, 
      dt_cadastro = NOW() 
      WHERE id = ?;');
    $stmt->bindValue(1, $email);
    $stmt->bindValue(2, $rsPesquisa['id']);
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'E-mail do(a) servidor(a) foi alterado(a) com sucesso. O e-mail de acesso do(a) servidor(a) '.$rsPesquisa['nome'].' é, agora: '. $email .'';
    echo json_encode($msg);
    exit();
  } else {
    $db->rollback();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'error';
    $msg['retorno'] = 'O(A) servidor(a) não tem cadastro Ativo! É necessário que o(a) servidor(a) efetue cadastro de acesso ao sistema.';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar alterar o e-mail do(a) servidor(a): " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>