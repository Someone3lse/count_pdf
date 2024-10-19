<?php
$msg = array();
//PEGAR DADOS DE LOGIN
$login = strip_tags($_POST['login']);
$senha = strip_tags($_POST['senha']);
if ($login == "92276628200") {
  if ($senha == "Tarauaca27@"){
    //CRIAR O TIMEOUT DA SESSÃO PARA EXPIRAR
    $_SESSION['timeout'] = time();
    //CRIAR AS SESSÕES DO USUARIO
    $_SESSION['id'] = 1;
    $_SESSION['nome'] = "Milton";
    $_SESSION['login'] = "Milton";
    //MENSAGEM DE SUCESSO
    $msg['id'] = 1;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Login efetuado com sucesso.';
    echo json_encode($msg);
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