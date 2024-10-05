<?php
include_once ('conf/config.php');
$db = Conexao::getInstance();
$msg = array();
try {
  $db->beginTransaction();
  //PEGAR DADOS DE LOGIN
  $login = strip_tags($_POST['servidor_login']);
  $senha = strip_tags(sha1($_POST['servidor_senha']));
  //SQL PARA VERIFICAÇÃO DE LOGIN EXISTENTE
  $rs = $db->prepare("SELECT s.id, s.nome, s.matricula, s.matricula_2, s.foto, s.email, s.senha, s.status
    FROM seg_servidor s 
    WHERE s.cpf = ?");
  $rs->bindParam(1, $login);
  $rs->execute();
  $num = $rs->rowCount();
  if($num > 0) {
    //PEGA OS DADOS DO USUARIO, CASO TENHA ACESSO
    $dadosUsuario = $rs->fetch(PDO::FETCH_ASSOC);
    //VERIFICA SE A SENHA INFORMADA É IGUAL DO USUARIO
    if($senha == $dadosUsuario['senha']) {
      if($dadosUsuario['status'] == 1 || $dadosUsuario['status'] == 0) {
        $id = $dadosUsuario['id'];
        //CRIAR O TIMEOUT DA SESSÃO PARA EXPIRAR
        $_SESSION['timeout'] = time();
        //CRIAR AS SESSÕES DO USUARIO
        $_SESSION['perfil'] = 'servidor';
        $_SESSION['servidor_zatu_id'] = $id;
        $_SESSION['servidor_nome'] = ($dadosUsuario['nome']);
        $_SESSION['servidor_email'] = $dadosUsuario['email'];
        $_SESSION['servidor_foto'] = $dadosUsuario['foto'];
        $_SESSION['servidor_cpf'] = $login;
        //STATUS ONLINE -> 1 - ONLINE e 2 - OFFLINE
        $_SESSION['servidor_online'] = 1;
        $_SESSION['foto_origin'] = $dadosUsuario['foto'];
        $fotoCut = $dadosUsuario['foto'];
        if ($fotoCut == "") {
          $_SESSION['servidor_foto_cut'] = "picture.jpg";
        } else {
          $extensoes = array("origin.jpeg", "origin.jpg", "origin.gif");
          $_SESSION['servidor_foto_cut'] = str_replace($extensoes, 'cut.png', $fotoCut);
        }
        //ATUALIZANDO O STATUS ONLINE DO USUARIO
        $rs = $db->prepare("UPDATE seg_servidor SET online = '1' WHERE id = ?");
        $rs->bindValue(1, $id);
        $rs->execute();
        //ATUALIZANDO DADOS DA SESSÃO DO USUÁRIO
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
          $browser_version = $matched[1];
          $browser = 'IE';
        } elseif(preg_match('|Opera/([0-9].[0-9]{1,2})|', $useragent, $matched)) {
          $browser_version = $matched[1];
          $browser = 'Opera';
        } elseif(preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
          $browser_version = $matched[1];
          $browser = 'Firefox';
        } elseif(preg_match('|Chrome/([0-9\.]+)|', $useragent, $matched)) {
          $browser_version = $matched[1];
          $browser = 'Chrome';
        } elseif(preg_match('|Safari/([0-9\.]+)|', $useragent, $matched)) {
          $browser_version = $matched[1];
          $browser = 'Safari';
        } else {
          $browser_version = 0;
          $browser = 'Desconhecido';
        }
        $separa = explode(";", $useragent);
        $so = $separa[1];
        $rs3 = $db->prepare("SELECT seg_servidor_id
          FROM seg_servidor_sessao
          WHERE seg_servidor_id = ?");
        $rs3->bindValue(1, $_SESSION['servidor_zatu_id']);
        $rs3->execute();
        $qtd = $rs3->rowCount();
        if($qtd > 0) {
          $rs4 = $db->prepare("UPDATE seg_servidor_sessao 
           SET host = ?, ip = ?, navegador = ?, so = ?, numero_sessao = ?, dt_login = NOW(), dt_atualizacao = NOW() 
           WHERE seg_servidor_id = ?");
          $rs4->bindValue(1, $_SERVER["SERVER_NAME"]);
          $rs4->bindValue(2, $_SERVER['REMOTE_ADDR']);
          $rs4->bindValue(3, $browser . " " . $browser_version);
          $rs4->bindValue(4, $so);
          $rs4->bindValue(5, session_id());
          $rs4->bindValue(6, $id);
          $rs4->execute();
        } else {
          $rs4 = $db->prepare("INSERT INTO seg_servidor_sessao
            (host, ip, navegador, so, numero_sessao, dt_login, dt_atualizacao, seg_servidor_id)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)");
          $rs4->bindValue(1, $_SERVER["SERVER_NAME"]);
          $rs4->bindValue(2, $_SERVER['REMOTE_ADDR']);
          $rs4->bindValue(3, $browser . " " . $browser_version);
          $rs4->bindValue(4, $so);
          $rs4->bindValue(5, session_id());
          $rs4->bindValue(6, $id);
          $rs4->execute();
        }
        //SALVANDO DADOS DE PERMISSÕES DO MODULO/OBJETO/AÇÃO
        //         $stmt = $db->prepare("SELECT m.id, LOWER(m.nome) AS nome
        //                                       FROM seg_modulo m
        //                                       LEFT JOIN seg_usuario_modulo AS um ON um.modulo_id = m.id
        //                                       WHERE um.usuario_id = ? AND um.status = 1");
        //         $stmt->bindValue(1, $id);
        //         $stmt->execute();
        //         $rsModulo = $stmt->fetchAll(PDO::FETCH_OBJ);
        //         foreach($rsModulo as $kModulo => $vModulo) {
        //           $_SESSION['permissao'][$vModulo->nome] = [];
        //           $stmt = $db->prepare("SELECT o.id, LOWER(o.nome) AS nome
        //                                         FROM seg_usuario_modulo_objeto_acao AS umoa 
        //                                         LEFT JOIN seg_modulo_objeto_acao AS moa ON moa.id = umoa.modulo_objeto_acao_id  
        //                                         LEFT JOIN seg_objeto AS o ON o.id = moa.objeto_id
        //                                         WHERE moa.modulo_id = ? AND umoa.usuario_id = ?");
        //           $stmt->bindValue(1, $vModulo->id);
        //           $stmt->bindValue(2, $id);
        //           $stmt->execute();
        //           $rsObjeto = $stmt->fetchAll(PDO::FETCH_OBJ);
        //           foreach($rsObjeto as $kObjeto => $vObjeto) {
        //             $_SESSION['permissao'][$vModulo->nome][$vObjeto->nome] = [];
        //             $stmt = $db->prepare("SELECT a.id, LOWER(a.nome) AS nome
        //                                           FROM seg_usuario_modulo_objeto_acao AS umoa 
        //                                           LEFT JOIN seg_modulo_objeto_acao AS moa ON moa.id = umoa.modulo_objeto_acao_id  
        //                                           LEFT JOIN seg_acao AS a ON a.id = moa.acao_id
        //                                           WHERE moa.modulo_id = ? AND moa.objeto_id = ? AND umoa.usuario_id = ?");
        //             $stmt->bindValue(1, $vModulo->id);
        //             $stmt->bindValue(2, $vObjeto->id);
        //             $stmt->bindValue(3, $id);
        //             $stmt->execute();
        //             $rsAcao = $stmt->fetchAll(PDO::FETCH_OBJ);
        //             foreach($rsAcao as $kAcao => $vAcao) {
        //               $_SESSION['permissao'][$vModulo->nome][$vObjeto->nome][$vAcao->nome] = [];
        //             }
        //           }
        //         }
        $db->commit();
        //MENSAGEM DE SUCESSO
        $msg['id'] = $id;
        $msg['msg'] = 'success';
        $msg['retorno'] = 'Login efetuado com sucesso.';
        echo json_encode($msg);
        exit();
      } else {
        $msg['msg'] = 'error';
        $msg['retorno'] = 'Você não tem permissão de acesso ao sistema.';
        echo json_encode($msg);
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
} catch(PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar efeturar o login. :" . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>