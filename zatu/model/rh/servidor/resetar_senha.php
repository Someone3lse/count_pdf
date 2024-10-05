<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  if ($id != "" && $id != 0) {
    $stmt = $db->prepare('
      SELECT id, nome, status 
      FROM seg_servidor 
      WHERE id = ? AND status = ?;');
    $stmt->bindValue(1, $id);
    $stmt->bindValue(2, 1); //1 = Ativo
    $stmt->execute();
    $rsPesquisa = $stmt->fetch(PDO::FETCH_ASSOC);
    $senhaNome = strtolower(removeAcentos($rsPesquisa['nome']));
    $subSenhaNome = explode(' ',$senhaNome);
    $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
    $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
    $stmt = $db->prepare('
      UPDATE seg_servidor  
      SET
      senha = ?, 
      dt_cadastro = NOW() 
      WHERE id = ?;');
    $stmt->bindValue(1, SHA1($senhaNome));
    $stmt->bindValue(2, $rsPesquisa['id']);
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Senha do(a) servidor(a) reiniciada com sucesso. A senha reiniciada é composta pelo primeiro nome do(a) servidor(a) mais "." mais o último sobrenome do(a) servidor(a), tudo em minúsculo.';
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
  $msg['retorno'] = "Erro ao tentar resetar a senha de acesso do(a) servidor(a): " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>