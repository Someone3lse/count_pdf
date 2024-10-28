<?php 
//time duration session
function sessionOn(){
  //VERIFICAÇÃO DE SESSION COM TIMEOUT PARA EXPIRAR
  // 30 minutos em segundos
  $inactive_session = 1800;
  $db = Conexao::getInstance();
  $stmt = $db->prepare("
  SELECT 
  s.timeout 
  FROM session AS s;");
  $stmt->execute();
  $rsSession = $stmt->fetch(PDO::FETCH_ASSOC);
  $timeout = $rsSession ? $rsSession['timeout'] : 0;
  $session_life = time() - $timeout ;
  if( $session_life > $inactive_session ){
    if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
      echo json_encode(array("msg" => "logout"));
      exit();
    } 
  } else {
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
    } catch (PDOException $e) {
      $db->rollback();
      $retorno["msg"] = "error";
      $retorno["retorno"] = "Erro ao tentar enviar os arquivos: " . $e->getMessage();
      echo json_encode($retorno);
      exit();
    }

  }
}
?>