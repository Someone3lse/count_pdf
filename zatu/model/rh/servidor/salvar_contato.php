<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['servidor_contato_id_s']);
$servidorId           = strip_tags(@$_POST['id']);
$endCep               = strip_tags(@$_POST['end_cep_s']);
$endLogradouro        = strip_tags(@$_POST['end_log_s']);
$endNumero            = strip_tags(@$_POST['end_num_s']);
$endComplemento       = strip_tags(@$_POST['end_comp_s']);
$endBairro            = strip_tags(@$_POST['end_bairro_s']);
$endMunicipioId       = strip_tags(@$_POST['end_municipio_s']);
$telResidencial       = strip_tags(@$_POST['tel_res_s']);
$telCelular           = strip_tags(@$_POST['tel_cel_s']);
$telRecado            = strip_tags(@$_POST['tel_recado_s']);
$relRecadoNome        = strip_tags(@$_POST['tel_recado_nome_s']);
$telRecadoParentGrau  = strip_tags(@$_POST['tel_recado_parent_grau_s']);
$emailInst            = strip_tags(@$_POST['email_inst_s']);
$emailPessoal         = strip_tags(@$_POST['email_pessoal_s']);
$emailAlternativo     = strip_tags(@$_POST['email_alternativo_s']);
$contatoEmergNome     = strip_tags(@$_POST['cont_emerg_nome_s']);
$contatoEmergEnd      = strip_tags(@$_POST['cont_emerg_end_s']);
$contatoEmergTel      = strip_tags(@$_POST['cont_emerg_tel__s']);
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($servidorId) && $servidorId != "" && $servidorId != 0 ) {
    if (is_numeric($id) && $id != "" && $id != 0 ) {
      $stmt = $db->prepare('
        UPDATE rh_servidor_contato 
        SET
        rh_servidor_id = ?, 
        end_cep = ?, 
        end_logradouro = ?, 
        end_numero = ?, 
        end_complemento = ?, 
        end_bairro = ?, 
        end_bsc_municipio_id = ?, 
        tel_residencial = ?, 
        tel_celular = ?, 
        tel_recado = ?, 
        tel_recado_nome = ?, 
        tel_recado_bsc_parentesco_grau_id = ?, 
        email_institucional = ?, 
        email_pessoal = ?, 
        email_alternativo = ?, 
        contato_emergencia_nome = ?, 
        contato_emergencia_end = ?, 
        contato_emergencia_tel = ?, 
        status = ?, 
        dt_cadastro = NOW(), 
        seg_usuario_id = ?
        WHERE id = ?;');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $endCep);
      $stmt->bindValue(3, $endLogradouro);
      $stmt->bindValue(4, $endNumero);
      $stmt->bindValue(5, $endComplemento);
      $stmt->bindValue(6, $endBairro);
      $stmt->bindValue(7, $endMunicipioId != '' ? $endMunicipioId : NULL);
      $stmt->bindValue(8, $telResidencial);
      $stmt->bindValue(9, $telCelular);
      $stmt->bindValue(10, $telRecado);
      $stmt->bindValue(11, $relRecadoNome);
      $stmt->bindValue(12, $telRecadoParentGrau != '' ? $telRecadoParentGrau : NULL);
      $stmt->bindValue(13, $emailInst);
      $stmt->bindValue(14, $emailPessoal);
      $stmt->bindValue(15, $emailAlternativo);
      $stmt->bindValue(16, $contatoEmergNome);
      $stmt->bindValue(17, $contatoEmergEnd);
      $stmt->bindValue(18, $contatoEmergTel);
      $stmt->bindValue(19, $status);
      $stmt->bindValue(20, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->bindValue(21, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de contato do servidor atualizados com sucesso.';
      echo json_encode($msg);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO rh_servidor_contato 
        (rh_servidor_id, 
        end_cep, 
        end_logradouro, 
        end_numero, 
        end_complemento, 
        end_bairro, 
        end_bsc_municipio_id, 
        tel_residencial, 
        tel_celular, 
        tel_recado, 
        tel_recado_nome, 
        tel_recado_bsc_parentesco_grau_id, 
        email_institucional, 
        email_pessoal, 
        email_alternativo, 
        contato_emergencia_nome, 
        contato_emergencia_end, 
        contato_emergencia_tel, 
        status, 
        dt_cadastro, 
        seg_usuario_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $endCep);
      $stmt->bindValue(3, $endLogradouro);
      $stmt->bindValue(4, $endNumero);
      $stmt->bindValue(5, $endComplemento);
      $stmt->bindValue(6, $endBairro);
      $stmt->bindValue(7, $endMunicipioId != '' ? $endMunicipioId : NULL);
      $stmt->bindValue(8, $telResidencial);
      $stmt->bindValue(9, $telCelular);
      $stmt->bindValue(10, $telRecado);
      $stmt->bindValue(11, $relRecadoNome);
      $stmt->bindValue(12, $telRecadoParentGrau != '' ? $telRecadoParentGrau : NULL);
      $stmt->bindValue(13, $emailInst);
      $stmt->bindValue(14, $emailPessoal);
      $stmt->bindValue(15, $emailAlternativo);
      $stmt->bindValue(16, $contatoEmergNome);
      $stmt->bindValue(17, $contatoEmergEnd);
      $stmt->bindValue(18, $contatoEmergTel);
      $stmt->bindValue(19, $status);
      $stmt->bindValue(20, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->execute();
      $contatoIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $contatoIdNew;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de contato do servidor cadastrados com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de contato!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar salvar os dados de contato do servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>