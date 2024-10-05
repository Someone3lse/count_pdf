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
  $stmt = $db->prepare('SELECT st.id, sc.id 
                        FROM rh_servidor_tipo AS st 
                        LEFT JOIN rh_servidor_contrato AS sc ON st.id = sc.rh_servidor_tipo_id
                        WHERE sc.rh_servidor_tipo_id = ?;');
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
      $stmt = $db->prepare('DELETE FROM rh_servidor_tipo WHERE id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Tipo de Servidor excluida com sucesso.';
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
  $msg['retorno'] = "Erro ao tentar excluir o Tipo de Servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>