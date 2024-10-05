<?php
include_once('conf/config.php');
//VARIAVEL UNIVERSAL
$db = Conexao::getInstance();
$msg = array();
try {
  $db->beginTransaction();
  $login    = strip_tags($_POST['login']);
  $codigo   = strip_tags($_POST['codigo']);
  $email    = strip_tags($_POST['email']);
  $senha    = strip_tags($_POST['nova_senha']);
  if ($senha != 123456){
    $stmt = $db->prepare("SELECT ( dt_expiracao < NOW() ) AS menor FROM seg_servidor_recupera_senha WHERE email = ? AND codigo = ? AND dt_alteracao IS NULL");
    $stmt->bindValue(1, $email);
    $stmt->bindValue(2, $codigo);
    $stmt->execute();
    $rsRecuperaSenha = $stmt->fetch(PDO::FETCH_ASSOC);
    $rsCount = $stmt->rowCount();
    if ($rsRecuperaSenha['menor'] == 1) {
      $msg['msg'] = 'error';
      $msg['retorno'] = "Seu código expirou. Faça uma nova solicitação, <a href='servidor_esqueceu_senha.php'>aqui</a>";
      echo json_encode($msg);
      exit();
    } else {
      $senha = sha1($senha);
      if ($login != '') {
        $stmt = $db->prepare("UPDATE seg_servidor SET senha = ? WHERE login = ? ");
        $stmt->bindValue(1, $senha);
        $stmt->bindValue(2, $login);
        $stmt->execute();
      } else {
        $stmt = $db->prepare("UPDATE seg_servidor SET senha = ? WHERE email = ? ");
        $stmt->bindValue(1, $senha);
        $stmt->bindValue(2, $email);
        $stmt->execute();
        $stmt = $db->prepare("UPDATE seg_servidor_recupera_senha SET dt_alteracao = NOW() WHERE email = ? AND codigo = ?");
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $codigo);
        $stmt->execute();
      }
      $db->Commit();
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Senha alterada com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = 'A senha não pode ser 123456! Essa senha não é permitida no sistema!';
    echo json_encode($msg);
    exit();
  }
} catch(PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar redefinir a senha. :" . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>  