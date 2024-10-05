<?php
$db           = Conexao::getInstance();
$login        = strip_tags(@$_POST['login_servidor']);
$senha        = strip_tags(@$_POST['senha_servidor']);
$msg          = array();
try {
  $msg['id'] = 0;
  $stmt = $db->prepare('
    SELECT s.id, s.dt_nascimento, 
    MONTH(s.dt_nascimento) AS nasc_mes, 
    YEAR(s.dt_nascimento) AS nasc_ano  
    FROM rh_servidor AS s 
    WHERE 
    s.cpf LIKE ? AND
    s.senha_nome = ?;');
  $stmt->bindValue(1, $login);
  $stmt->bindValue(2, $senha);
  $stmt->execute();
  $rsServidor = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($rsServidor['id'] != '') {
    $msg['id'] = $rsServidor['id'];
    $msg['msg'] = 'edit';
    $stmt = $db->prepare('
      SELECT 
      sa.id, 
      sa.sacad_situacao_servidor_atualizacao_id, 
      ssa.nome AS situacao_nome, 
      MONTH(sa.dt_cadastro) AS cadastro_mes, 
      YEAR(sa.dt_cadastro) AS cadastro_ano
      FROM sacad_servidor_atualizacao AS sa 
      LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sa.sacad_situacao_servidor_atualizacao_id 
      WHERE 
      sa.rh_servidor_id = ? AND
      sa.dt_cadastro IN ( SELECT MAX(sa_aux.dt_cadastro) FROM sacad_servidor_atualizacao AS sa_aux WHERE sa_aux.rh_servidor_id = ? AND sa_aux.status = 1) AND 
      sa.status = 1;');
    $stmt->bindValue(1, $rsServidor['id']);
    $stmt->bindValue(2, $rsServidor['id']);
    $stmt->execute();
    $rsServidorAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
    $msg['atualizacaoId'] = isset($rsServidorAtualizacao['id']) ? $rsServidorAtualizacao['id'] : 0;
    if (!isset($rsServidorAtualizacao['id'])) {
      $msg['msg'] = 'edit';
      $msg['retorno'] = 'Aguardando preenchimento total';
    } else if ($rsServidorAtualizacao['cadastro_mes'] == $rsServidor['nasc_mes'] && ($rsServidorAtualizacao['sacad_situacao_servidor_atualizacao_id'] != 6 && $rsServidorAtualizacao['sacad_situacao_servidor_atualizacao_id'] != 3 )) {
      $msg['msg'] = 'edit';
      $msg['retorno'] = $rsServidorAtualizacao['situacao_nome'];
    } else if ($rsServidorAtualizacao['sacad_situacao_servidor_atualizacao_id'] == 3) {
      $msg['msg'] = 'msg';
      $msg['retorno'] = $rsServidorAtualizacao['situacao_nome'];
    } else if ($rsServidorAtualizacao['sacad_situacao_servidor_atualizacao_id'] == 6){
      $msg['msg'] = 'view';
      $msg['retorno'] = $rsServidorAtualizacao['situacao_nome'];
    }
  } else {
    $msg['msg'] = 'falha';
  }
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar buscar o Servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>