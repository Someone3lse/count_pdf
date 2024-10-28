<?php
$msg = array();
//PEGAR DADOS DE LOGIN
$login = strip_tags($_POST['login']);
$senha = strip_tags($_POST['senha']);
if ($login == "92276628200") {
  if ($senha == "Tarauaca27@"){
    //CRIAR O TIMEOUT DA SESSÃO PARA EXPIRAR
    $db = Conexao::getInstance();
    $stmt = $db->prepare("
    SELECT 
    s.timeout 
    FROM session AS s;");
    $stmt->execute();
    $rsSession = $stmt->fetch(PDO::FETCH_ASSOC);
    try {
      $db->beginTransaction();
      if (!$rsSession) {
        $stmt = $db->prepare("
          INSERT INTO session 
          (timeout) 
          VALUES
          (".time().");");
        $stmt->execute();
      } else {
        $stmt = $db->prepare("
          UPDATE session  
          SET timeout = ".time()."
          WHERE 1 = 1;");
        $stmt->execute();
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = 1;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Login efetuado com sucesso.';
      echo json_encode($msg);
    } catch (PDOException $e) {
      $db->rollback();
      $retorno["msg"] = "error";
      $retorno["retorno"] = "Erro ao tentar enviar os arquivos: " . $e->getMessage();
      echo json_encode($retorno);
      exit();
    }
  } else {
    $msg['msg'] = 'error';
    $msg['retorno'] = 'O usuário ou a senha inseridos estão incorretos.';
    echo json_encode($msg);
    exit();
  }
} else {
  $msg['msg'] = 'error';
  $msg['retorno'] = 'O usuário ou a senha inseridos estão incorretos.';
  echo json_encode($msg);
  exit();
}
?>