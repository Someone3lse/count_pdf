<?php
$db = Conexao::getInstance();
$nome = strip_tags(@$_POST['nome']);
$msg = array();
$mensagem = "";
try {
  $msg['itens'] = array();
  // if ($id != '' && $id != null) {
  $stmt = $db->prepare('SELECT s.id, s.nome 
    FROM rh_servidor AS s 
    WHERE s.nome LIKE ?
    ORDER BY s.nome ASC;');
  $stmt->bindValue(1, ('%'.$nome.'%'));
  $stmt->execute();
  $rsServidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($rsServidores) > 0 ) {
    foreach ($rsServidores as $kObj => $vObj) {
      array_push($msg['itens'], array('id'=> $vObj['id'], 'text'=> $vObj['nome']));
    }
  } else {
    array_push($msg['itens'], array('id'=> 0, 'text'=> 'Nenhum Servidor encontrado para a busca efetuada'));
  }
  $msg['msg'] = 'success';
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar buscar os Servidores: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>