<?php
$db           = Conexao::getInstance();
$ids          = strip_tags(@$_POST['ids']);
$msg          = array();

try {
  $db->beginTransaction();
  if ($ids != "" && $ids != 0) {
    $stmt = $db->prepare('
      UPDATE arquivo  
      SET status = 2
      WHERE id IN ('.$ids.');');
    $stmt->execute();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Arquivo(s) excluído(s) com sucesso.';
    echo json_encode($msg);
    exit();
  } else {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi recebido o(s) identificador(es) do(s) arquivo(s) para sua exclusão.';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar excluir o(s) arquivo(s): " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>