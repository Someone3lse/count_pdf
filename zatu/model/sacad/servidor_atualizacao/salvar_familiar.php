<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['servidor_atualizacao_familiar_id_s']);
$atualizacaoId           = strip_tags(@$_POST['id']);
$estadoCivilId        = strip_tags(@$_POST['est_civ_s']);
$conjDtCasam          = strip_tags(@$_POST['conjuge_dt_casam_s']);
$conjNome             = strip_tags(@$_POST['conjuge_nome_s']);
$conjCpf              = strip_tags(@$_POST['conjuge_cpf_s']);
$conjDtNAsc           = strip_tags(@$_POST['conjuge_dt_nasc_s']);
$conjNacionalidade    = strip_tags(@$_POST['conjuge_nacionalidade_s']);
$conjNaturalidade     = strip_tags(@$_POST['conjuge_naturalidade_s']);
$conjEstCidade        = strip_tags(@$_POST['conjuge_nat_est_cidade_S']);
$conjEstEstado        = strip_tags(@$_POST['conjuge_nat_est_estado_s']);
$conjLocTrabalho      = strip_tags(@$_POST['conjuge_local_trabalho_s']);
$regCivilNumero       = strip_tags(@$_POST['reg_civ_num_s']);
$regCivilLivro        = strip_tags(@$_POST['reg_civ_livro_s']);
$regCivilFolha        = strip_tags(@$_POST['reg_civ_folha_s']);
$regCivilCartorio     = strip_tags(@$_POST['reg_civ_cartorio_s']);
$regCivilDtEmissao    = strip_tags(@$_POST['reg_civ_dt_expedicao_s']);
$regCivilMunicipioId  = strip_tags(@$_POST['reg_civ_cidade_s']);
$averbTipo            = strip_tags(@$_POST['averbacao_tipo_s']);
$averbNumero          = strip_tags(@$_POST['averbacao_num_s']);
$averbDtEmissao       = strip_tags(@$_POST['averbacao_dt_expedicao_s']);
$averbCartorio        = strip_tags(@$_POST['averbacao_cartorio_s']);
$averbMunicipioId     = strip_tags(@$_POST['averbacao_cidade_s']);
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
$situacao = 1;
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($atualizacaoId) && $atualizacaoId != "" && $atualizacaoId != 0 ) {
    $stmt = $db->prepare("
      SELECT 
      sas.id, 
      sas.sacad_situacao_servidor_atualizacao_id 
      FROM sacad_servidor_atualizacao_situacao AS sas 
      WHERE sas.sacad_servidor_atualizacao_id = ? 
      ORDER BY sas.id DESC
      LIMIT 1;");
    $stmt->bindValue(1, $atualizacaoId);
    $stmt->execute();
    $rsServidorSituacao = $stmt->fetch(PDO::FETCH_ASSOC);
    if (in_array($rsServidorSituacao['sacad_situacao_servidor_atualizacao_id'], [1, 2])) {
      $situacao = 1;
    } else if (in_array($rsServidorSituacao['sacad_situacao_servidor_atualizacao_id'], [5, 8, 11])) {
      $situacao = 11;
    }
    $stmt = $db->prepare('
      INSERT INTO sacad_servidor_atualizacao_situacao
      (
        obs, 
        status, 
        dt_cadastro, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id, 
        seg_usuario_id) 
      VALUES
      (?, ?, NOW(), ?, ?, ?)');
    $stmt->bindValue(1, '');
    $stmt->bindValue(2, 1);
    $stmt->bindValue(3, $atualizacaoId);
    $stmt->bindValue(4, $situacao);
    $stmt->bindValue(5, NULL);
    $stmt->execute();
    if (is_numeric($id) && $id != "" && $id != 0 ) {
      $stmt = $db->prepare('
        UPDATE sacad_servidor_atualizacao_familiar 
        SET
        sacad_servidor_atualizacao_id = ?, 
        bsc_estado_civil_id = ?, 
        conjuge_dt_casamento = ?, 
        conjuge_nome = ?, 
        conjuge_cpf = ?, 
        conjuge_dt_nascimento = ?, 
        conjuge_natural_bsc_pais_id = ?, 
        conjuge_natural_bsc_municipio_id = ?, 
        conjuge_natural_estrangeiro_cidade = ?, 
        conjuge_natural_estrangeiro_estado = ?, 
        conjuge_local_trabalho = ?, 
        reg_civil_numero = ?, 
        reg_civil_livro = ?, 
        reg_civil_folha = ?, 
        reg_civil_cartorio = ?, 
        reg_civil_dt_emissao = ?, 
        reg_civil_bsc_municipio_id = ?, 
        averbacao_tipo = ?, 
        averbacao_numero = ?, 
        averbacao_dt_emissao = ?, 
        averbacao_cartorio = ?, 
        averbacao_bsc_municipio_id = ?, 
        status = ?, 
        dt_cadastro = NOW()
        WHERE id = ?;');
      $stmt->bindValue(1, $atualizacaoId);
      $stmt->bindValue(2, $estadoCivilId != '' ? $estadoCivilId : NULL);
      $stmt->bindValue(3, formata_data($conjDtCasam));
      $stmt->bindValue(4, $conjNome);
      $stmt->bindValue(5, $conjCpf);
      $stmt->bindValue(6, formata_data($conjDtNAsc));
      $stmt->bindValue(7, $conjNacionalidade != '' ? $conjNacionalidade : NULL);
      $stmt->bindValue(8, $conjNaturalidade != '' ? $conjNaturalidade : NULL);
      $stmt->bindValue(9, $conjEstCidade);
      $stmt->bindValue(10, $conjEstEstado);
      $stmt->bindValue(11, $conjLocTrabalho);
      $stmt->bindValue(12, $regCivilNumero);
      $stmt->bindValue(13, $regCivilLivro);
      $stmt->bindValue(14, $regCivilFolha);
      $stmt->bindValue(15, $regCivilCartorio);
      $stmt->bindValue(16, formata_data($regCivilDtEmissao));
      $stmt->bindValue(17, $regCivilMunicipioId != '' ? $regCivilMunicipioId : NULL);
      $stmt->bindValue(18, $averbTipo);
      $stmt->bindValue(19, $averbNumero);
      $stmt->bindValue(20, formata_data($averbDtEmissao));
      $stmt->bindValue(21, $averbCartorio);
      $stmt->bindValue(22, $averbMunicipioId != '' ? $averbMunicipioId : NULL);
      $stmt->bindValue(23, $status);
      $stmt->bindValue(24, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de familia do servidor atualizados com sucesso.';
      echo json_encode($msg);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO sacad_servidor_atualizacao_familiar 
        (sacad_servidor_atualizacao_id, 
          bsc_estado_civil_id, 
          conjuge_dt_casamento, 
          conjuge_nome, 
          conjuge_cpf, 
          conjuge_dt_nascimento, 
          conjuge_natural_bsc_pais_id, 
          conjuge_natural_bsc_municipio_id, 
          conjuge_natural_estrangeiro_cidade, 
          conjuge_natural_estrangeiro_estado, 
          conjuge_local_trabalho, 
          reg_civil_numero, 
          reg_civil_livro, 
          reg_civil_folha, 
          reg_civil_cartorio, 
          reg_civil_dt_emissao, 
          reg_civil_bsc_municipio_id, 
          averbacao_tipo, 
          averbacao_numero, 
          averbacao_dt_emissao, 
          averbacao_cartorio, 
          averbacao_bsc_municipio_id, 
          status, 
          dt_cadastro) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
      $stmt->bindValue(1, $atualizacaoId);
      $stmt->bindValue(2, $estadoCivilId != '' ? $estadoCivilId : NULL);
      $stmt->bindValue(3, formata_data($conjDtCasam));
      $stmt->bindValue(4, $conjNome);
      $stmt->bindValue(5, $conjCpf);
      $stmt->bindValue(6, formata_data($conjDtNAsc));
      $stmt->bindValue(7, $conjNacionalidade != '' ? $conjNacionalidade : NULL);
      $stmt->bindValue(8, $conjNaturalidade != '' ? $conjNaturalidade : NULL);
      $stmt->bindValue(9, $conjEstCidade);
      $stmt->bindValue(10, $conjEstEstado);
      $stmt->bindValue(11, $conjLocTrabalho);
      $stmt->bindValue(12, $regCivilNumero);
      $stmt->bindValue(13, $regCivilLivro);
      $stmt->bindValue(14, $regCivilFolha);
      $stmt->bindValue(15, $regCivilCartorio);
      $stmt->bindValue(16, formata_data($regCivilDtEmissao));
      $stmt->bindValue(17, $regCivilMunicipioId != '' ? $regCivilMunicipioId : NULL);
      $stmt->bindValue(18, $averbTipo);
      $stmt->bindValue(19, $averbNumero);
      $stmt->bindValue(20, formata_data($averbDtEmissao));
      $stmt->bindValue(21, $averbCartorio);
      $stmt->bindValue(22, $averbMunicipioId != '' ? $averbMunicipioId : NULL);
      $stmt->bindValue(23, $status);
      $stmt->execute();
      $familiarIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $familiarIdNew;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de familia do servidor cadastrados com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de familia!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar salvar os dados de familia do servidor: +". $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>