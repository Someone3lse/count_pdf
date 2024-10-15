<?php
$db           = Conexao::getInstance();
$ids           = strip_tags(@$_POST['ids']);
$error        = false;
$msg          = array();

try {
  $db->beginTransaction();
  if ($ids != "" && $ids != 0) {
    $stmt = $db->prepare('
      UPDATE arquivo  
      SET status = 1
      WHERE id IN ('.$ids.');');
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Arquivo(s) recuperado(s) com sucesso.';
    echo json_encode($msg);
    exit();
  } else {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi recebido o(s) identificador(es) do(s) arquivo(s) para sua recuperação.';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar recuperar o(s) arquivo(s): " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>