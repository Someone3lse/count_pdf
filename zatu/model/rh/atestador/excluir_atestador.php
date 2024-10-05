<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('SELECT sas.id  
    FROM sacad_servidor_atualizacao_situacao AS sas 
    WHERE sas.seg_usuario_id_atestador = ?;');
  $stmt->bindValue(1, $id);
  $stmt->execute();
  $rs = $stmt->fetch(PDO::FETCH_ASSOC);
  $id_pesquisa = $rs['id'];
  if (!is_null($id_pesquisa)) {
    $error = true;
    $mensagem .= "Este registro não pode ser exlcuido pois está vinculado a um contrato de servidor!";
    $msg['tipo'] = "nome";
  }
  if ($error == false) {
    if ($id != "" && $id != 0) {
      $stmt = $db->prepare('DELETE FROM rh_atestador WHERE seg_usuario_id_atestador = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Chefe imediato excluido com sucesso.';
      echo json_encode($msg);
      exit();
    } 
  } else {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = $mensagem;
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar excluir o Chefe imediato: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>