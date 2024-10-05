<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['id']);
$servidorId           = strip_tags(@$_POST['servidor_id']);
$nome                 = strip_tags(@$_POST['nome_s']);
$nomeSocial           = strip_tags(@$_POST['nome_social_s']);
// $cpf                  = strip_tags(@$_POST['cpf_s']);
// $dtNasc               = strip_tags(@$_POST['dt_nasc_s']);
$sexo                 = strip_tags(@$_POST['sexo_s']);
$sangueTipo           = strip_tags(@$_POST['sangue_tipo_s']);
$nacionalidade        = strip_tags(@$_POST['nacionalidade_s']);
$naturalidade         = strip_tags(@$_POST['naturalidade_s']);
$estDtIngresso        = strip_tags(@$_POST['nat_est_dt_ingresso_s']);
$estCidade            = strip_tags(@$_POST['nat_est_cidade_S']);
$estEstado            = strip_tags(@$_POST['nat_est_estado_s']);
$estCondTrabalho      = strip_tags(@$_POST['nat_est_cond_trabalho_s']);
$paiNome              = strip_tags(@$_POST['pai_nome_s']);
$paiNacionalidade     = strip_tags(@$_POST['pai_nacionalidade_s']);
$paiProfissao         = strip_tags(@$_POST['pai_profissao_s']);
$maeNome              = strip_tags(@$_POST['mae_nome_s']);
$maeNacionalidade     = strip_tags(@$_POST['mae_nacionalidade_s']);
$maeProfissao         = strip_tags(@$_POST['mae_profissao_s']);
$raca                 = strip_tags(@$_POST['raca_s']);
$matricula            = strip_tags(@$_POST['matricula_s']);
$servTipoId           = strip_tags(@$_POST['servidor_tipo_s']);
$cargoId              = strip_tags(@$_POST['cargo_s']);
$empregador           = strip_tags(@$_POST['empregador_s']);
$setorId              = strip_tags(@$_POST['setor_atual_s']);
$sitTrabId            = strip_tags(@$_POST['sit_trab_s']);
$sitTrabDecreto       = strip_tags(@$_POST['sit_decreto_s']);
$sitTrabDoe           = strip_tags(@$_POST['sit_doe_s']);
$sitTrabDtInicio      = strip_tags(@$_POST['sit_dt_inicio_s']);
$sitTrabDtFim         = strip_tags(@$_POST['sit_dt_fim_s']);
$sitTrabObs           = strip_tags(@$_POST['sit_obs_s']);
$matricula2           = $_POST['matricula_2_s'] == "" ? NULL : strip_tags(@$_POST['matricula_2_s']);
$servTipoId2          = strip_tags(@$_POST['servidor_tipo_2_s']);
$cargoId2             = strip_tags(@$_POST['cargo_2_s']);
$empregador2          = strip_tags(@$_POST['empregador_2_s']);
$setorId2             = strip_tags(@$_POST['setor_atual_2_s']);
$sitTrabId2           = strip_tags(@$_POST['sit_trab_2_s']);
$sitTrabDecreto2      = strip_tags(@$_POST['sit_decreto_2_s']);
$sitTrabDoe2          = strip_tags(@$_POST['sit_doe_2_s']);
$sitTrabDtInicio2     = strip_tags(@$_POST['sit_dt_inicio_2_s']);
$sitTrabDtFim2        = strip_tags(@$_POST['sit_dt_fim_2_s']);
$sitTrabObs2          = strip_tags(@$_POST['sit_obs_2_s']);
$covidVacinaNome      = strip_tags(@$_POST['covid_vacina_nome_s']);
$covidVacinaDose      = strip_tags(@$_POST['covid_vacina_dose_s']);
$covidVacinaLote      = strip_tags(@$_POST['covid_vacina_lote_s']);
$covidVacinaData      = strip_tags(@$_POST['covid_vacina_data_s']);
$covidVacinaEnd       = strip_tags(@$_POST['covid_vacina_end_s']);
$enfermidadePortada   = strip_tags(@$_POST['enf_portador_s']);
$enfermidadeCodInt    = strip_tags(@$_POST['enf_cod_internacional_s']);
$tipoAtualizacao      = strip_tags(@$_POST['tipo_atualizacao']);
$situacao             = strip_tags(@$_POST['situacao_servidor_atualizacao_id']);
$atestacaoMatricula   = NULL;
$atestacaoMatricula2  = NULL;
$status               = 0;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
try {
  if (empty($id)) {
    $stmt = $db->prepare("
      SELECT 
      s.id, 
      MONTH(NOW()) AS mes_hoje, 
      YEAR(NOW()) AS ano_hoje 
      FROM seg_servidor s 
      WHERE s.id = ?;");
    $stmt->bindValue(1, $_SESSION['servidor_zatu_id']);
    $stmt->execute();
    $rsSegServidor = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $db->prepare("
      SELECT 
      sa.id, 
      MONTH(s.dt_nascimento) AS nasc_mes, 
      sa.tipo_atualizacao 
      FROM sacad_servidor_atualizacao AS sa 
      LEFT JOIN rh_servidor AS s ON s.id = sa.rh_servidor_id 
      WHERE s.seg_servidor_id = ?
      ORDER BY sa.id DESC;");
    $stmt->bindValue(1, $_SESSION['servidor_zatu_id']);
    $stmt->execute();
    $rsServidorAtualizacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsServidorAtualizacoes as $kObj => $vObj) {
      $stmt = $db->prepare("
        SELECT 
        sas.id, 
        MONTH(sas.dt_cadastro) AS mes, 
        YEAR(sas.dt_cadastro) AS ano, 
        sas.sacad_servidor_atualizacao_id, 
        sas.sacad_situacao_servidor_atualizacao_id 
        FROM sacad_servidor_atualizacao_situacao AS sas 
        LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
        WHERE sas.sacad_servidor_atualizacao_id = ? 
        ORDER BY sas.id ASC;");
      $stmt->bindValue(1, $vObj['id']);
      $stmt->execute();
      $rsServidorSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $rsServidorAtualizacoes[$kObj]['situacoes'] = $rsServidorSituacoes;
      $rsServidorAtualizacoes[$kObj]['situacaoServidorPrimeiro'] = sizeof($rsServidorSituacoes) > 0 ? $rsServidorSituacoes[0] : NULL;
      $rsServidorAtualizacoes[$kObj]['situacaoServidorUltima'] = end($rsServidorSituacoes);
    }
    if (sizeof($rsServidorAtualizacoes) > 0 && end($rsServidorAtualizacoes)['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] != 10) {
      $id               = end($rsServidorAtualizacoes)['id'];
      $tipoAtualizacao  = end($rsServidorAtualizacoes)['tipo_atualizacao'];
    }
  }
  $db->beginTransaction();
  if (is_numeric($id) && !(empty($id))) {
    $stmt = $db->prepare("
      SELECT 
      sas.id, 
      sas.sacad_situacao_servidor_atualizacao_id,
      sa.eo_setor_unidade_organizacional_id, 
      sa.eo_setor_unidade_organizacional_id_2, 
      sa.rh_situacao_trabalho_id, 
      sa.rh_situacao_trabalho_id_2, 
      sa.atestacao_matricula, 
      sa.atestacao_matricula_2 
      FROM sacad_servidor_atualizacao_situacao AS sas 
      LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.id = sas.sacad_servidor_atualizacao_id 
      WHERE sas.sacad_servidor_atualizacao_id = ? 
      ORDER BY sas.id DESC
      LIMIT 1;");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $rsServidorAtualizacaoSituacao = $stmt->fetch(PDO::FETCH_ASSOC);
    if (in_array($rsServidorAtualizacaoSituacao['sacad_situacao_servidor_atualizacao_id'], [1, 2])) {
      $situacao = 1;
    } else if (in_array($rsServidorAtualizacaoSituacao['sacad_situacao_servidor_atualizacao_id'], [5, 8, 11, 12, 13])) {
      $situacao = 11;
    }
    if ($sitTrabId == 1) {
      $atestacaoMatricula = NULL;
    }
    if ($sitTrabId2 == 1) {
      $atestacaoMatricula2 = NULL;
    }
    if ($setorId != $rsServidorAtualizacaoSituacao['eo_setor_unidade_organizacional_id']) {
      $atestacaoMatricula = NULL;
    } else if ($rsServidorAtualizacaoSituacao['rh_situacao_trabalho_id'] != 1 && $sitTrabId == 1) {
      $atestacaoMatricula = NULL;
    } else {
      $atestacaoMatricula = $rsServidorAtualizacaoSituacao['atestacao_matricula'];
    }
    if ($setorId2 != $rsServidorAtualizacaoSituacao['eo_setor_unidade_organizacional_id_2']) {
      $atestacaoMatricula2 = NULL;
    } else if ($rsServidorAtualizacaoSituacao['rh_situacao_trabalho_id_2'] != 1 && $sitTrabId2 == 1) {
      $atestacaoMatricula2 = NULL;
    } else {
      $atestacaoMatricula2 = $rsServidorAtualizacaoSituacao['atestacao_matricula_2'];
    }
    if ($sitTrabId != 1) {
      $atestacaoMatricula = 1;
    }
    if ($sitTrabId2 != 1) {
      $atestacaoMatricula2 = 1;
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao 
      SET
      nome = ?, 
      nome_social = ?, 
      cpf = ?, 
      dt_nascimento = ?, 
      sexo = ?, 
      matricula = ?, 
      matricula_2 = ?, 
      natural_bsc_pais_id = ?, 
      natural_bsc_municipio_id = ?, 
      natural_estrangeiro_dt_ingresso = ?, 
      natural_estrangeiro_cidade = ?, 
      natural_estrangeiro_estado = ?, 
      natural_estrangeiro_condicao_trabalho = ?, 
      pai_nome = ?, 
      pai_natural_bsc_pais_id = ?, 
      pai_profissao = ?, 
      mae_nome = ?, 
      mae_natural_bsc_pais_id = ?, 
      mae_profissao = ?, 
      eo_empregador_id = ?, 
      eo_setor_unidade_organizacional_id = ?, 
      rh_situacao_trabalho_id = ?, 
      situacao_trabalho_decreto = ?, 
      situacao_trabalho_doe = ?, 
      situacao_trabalho_dt_inicio = ?, 
      situacao_trabalho_dt_fim = ?, 
      situacao_trabalho_obs = ?, 
      eo_empregador_id_2 = ?, 
      eo_setor_unidade_organizacional_id_2 = ?, 
      rh_situacao_trabalho_id_2 = ?, 
      situacao_trabalho_decreto_2 = ?, 
      situacao_trabalho_doe_2 = ?, 
      situacao_trabalho_dt_inicio_2 = ?, 
      situacao_trabalho_dt_fim_2 = ?, 
      situacao_trabalho_obs_2 = ?, 
      foto = ?, 
      sangue_tipo = ?, 
      raca = ?, 
      covid_vacina_nome = ?, 
      covid_vacina_dose = ?, 
      covid_vacina_lote = ?, 
      covid_vacina_data = ?, 
      covid_vacina_endereco = ?, 
      enfermidade_portador = ?, 
      enfermidade_codigo_internacional = ?, 
      rh_servidor_tipo_id = ?, 
      eo_cargo_id = ?, 
      rh_servidor_tipo_id_2 = ?, 
      eo_cargo_id_2 = ?, 
      atestacao_matricula = ? , 
      atestacao_matricula_2 = ? , 
      status = ?, 
      dt_cadastro = NOW()  
      WHERE id = ? ;');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $nomeSocial);
    $stmt->bindValue(3, NULL);
    $stmt->bindValue(4, NULL);
    $stmt->bindValue(5, $sexo);
    $stmt->bindValue(6, $matricula);
    $stmt->bindValue(7, $matricula2);
    $stmt->bindValue(8, $nacionalidade != '' ? $nacionalidade : NULL);
    $stmt->bindValue(9, $naturalidade != '' ? $naturalidade : NULL);
    $stmt->bindValue(10, formata_data($estDtIngresso));
    $stmt->bindValue(11, $estCidade);
    $stmt->bindValue(12, $estEstado);
    $stmt->bindValue(13, $estCondTrabalho);
    $stmt->bindValue(14, $paiNome);
    $stmt->bindValue(15, $paiNacionalidade != '' ? $paiNacionalidade : NULL);
    $stmt->bindValue(16, $paiProfissao);
    $stmt->bindValue(17, $maeNome);
    $stmt->bindValue(18, $maeNacionalidade != '' ? $maeNacionalidade : NULL);
    $stmt->bindValue(19, $maeProfissao);
    $stmt->bindValue(20, $empregador != '' ? $empregador : NULL);
    $stmt->bindValue(21, $setorId != '' ? $setorId : NULL);
    $stmt->bindValue(22, $sitTrabId != '' ? $sitTrabId : NULL);
    $stmt->bindValue(23, $sitTrabDecreto);
    $stmt->bindValue(24, $sitTrabDoe);
    $stmt->bindValue(25, formata_data($sitTrabDtInicio));
    $stmt->bindValue(26, formata_data($sitTrabDtFim));
    $stmt->bindValue(27, $sitTrabObs);
    $stmt->bindValue(28, $empregador2 != '' ? $empregador2 : NULL);
    $stmt->bindValue(29, $setorId2 != '' ? $setorId2 : NULL);
    $stmt->bindValue(30, $sitTrabId2 != '' ? $sitTrabId2 : NULL);
    $stmt->bindValue(31, $sitTrabDecreto2);
    $stmt->bindValue(32, $sitTrabDoe2);
    $stmt->bindValue(33, formata_data($sitTrabDtInicio2));
    $stmt->bindValue(34, formata_data($sitTrabDtFim2));
    $stmt->bindValue(35, $sitTrabObs2);
    $stmt->bindValue(36, NULL);
    $stmt->bindValue(37, $sangueTipo);
    $stmt->bindValue(38, $raca);
    $stmt->bindValue(39, $covidVacinaNome);
    $stmt->bindValue(40, $covidVacinaDose);
    $stmt->bindValue(41, $covidVacinaLote);
    $stmt->bindValue(42, formata_data($covidVacinaData));
    $stmt->bindValue(43, $covidVacinaEnd);
    $stmt->bindValue(44, $enfermidadePortada);
    $stmt->bindValue(45, $enfermidadeCodInt);
    $stmt->bindValue(46, $servTipoId != '' ? $servTipoId : NULL);
    $stmt->bindValue(47, $cargoId != '' ? $cargoId : NULL);
    $stmt->bindValue(48, $servTipoId2 != '' ? $servTipoId2 : NULL);
    $stmt->bindValue(49, $cargoId2 != '' ? $cargoId2 : NULL);
    $stmt->bindValue(50, $atestacaoMatricula);
    $stmt->bindValue(51, $atestacaoMatricula2);
    $stmt->bindValue(52, $status);
    $stmt->bindValue(53, $id);
    $stmt->execute();
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
    $stmt->bindValue(3, $id);
    $stmt->bindValue(4, $situacao);
    $stmt->bindValue(5, NULL);
    $stmt->execute();
    $db->commit();
      //MENSAGEM DE SUCESSO
    $msg['id'] = $id;
    $msg['situacaoId'] = $situacao;
    $msg['tipoAtualizacao'] = $tipoAtualizacao;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Dados pessoais do servidor atualizados com sucesso.';
    echo json_encode($msg);
    exit();
  } else {

    $stmt = $db->prepare('INSERT INTO sacad_servidor_atualizacao 
      (nome, 
        nome_social, 
        cpf, 
        dt_nascimento, 
        sexo, 
        matricula, 
        matricula_2, 
        natural_bsc_pais_id, 
        natural_bsc_municipio_id, 
        natural_estrangeiro_dt_ingresso, 
        natural_estrangeiro_cidade, 
        natural_estrangeiro_estado, 
        natural_estrangeiro_condicao_trabalho, 
        pai_nome, 
        pai_natural_bsc_pais_id, 
        pai_profissao, 
        mae_nome, 
        mae_natural_bsc_pais_id, 
        mae_profissao, 
        eo_empregador_id, 
        eo_setor_unidade_organizacional_id, 
        rh_situacao_trabalho_id, 
        situacao_trabalho_decreto, 
        situacao_trabalho_doe, 
        situacao_trabalho_dt_inicio, 
        situacao_trabalho_dt_fim, 
        situacao_trabalho_obs, 
        eo_empregador_id_2, 
        eo_setor_unidade_organizacional_id_2, 
        rh_situacao_trabalho_id_2, 
        situacao_trabalho_decreto_2, 
        situacao_trabalho_doe_2, 
        situacao_trabalho_dt_inicio_2, 
        situacao_trabalho_dt_fim_2, 
        situacao_trabalho_obs_2, 
        foto, 
        sangue_tipo, 
        raca, 
        covid_vacina_nome, 
        covid_vacina_dose, 
        covid_vacina_lote, 
        covid_vacina_data, 
        covid_vacina_endereco, 
        enfermidade_portador, 
        enfermidade_codigo_internacional, 
        rh_servidor_tipo_id, 
        eo_cargo_id, 
        rh_servidor_tipo_id_2, 
        eo_cargo_id_2, 
        atestacao_matricula, 
        atestacao_matricula_2, 
        status, 
        dt_cadastro, 
        rh_servidor_id, 
        tipo_atualizacao) 
      VALUES
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $nomeSocial);
    $stmt->bindValue(3, NULL);
    $stmt->bindValue(4, NULL);
    $stmt->bindValue(5, $sexo);
    $stmt->bindValue(6, $matricula);
    $stmt->bindValue(7, $matricula2);
    $stmt->bindValue(8, $nacionalidade != '' ? $nacionalidade : NULL);
    $stmt->bindValue(9, $naturalidade != '' ? $naturalidade : NULL);
    $stmt->bindValue(10, formata_data($estDtIngresso));
    $stmt->bindValue(11, $estCidade);
    $stmt->bindValue(12, $estEstado);
    $stmt->bindValue(13, $estCondTrabalho);
    $stmt->bindValue(14, $paiNome);
    $stmt->bindValue(15, $paiNacionalidade != '' ? $paiNacionalidade : NULL);
    $stmt->bindValue(16, $paiProfissao);
    $stmt->bindValue(17, $maeNome);
    $stmt->bindValue(18, $maeNacionalidade != '' ? $maeNacionalidade : NULL);
    $stmt->bindValue(19, $maeProfissao);
    $stmt->bindValue(20, $empregador != '' ? $empregador : NULL);
    $stmt->bindValue(21, $setorId != '' ? $setorId : NULL);
    $stmt->bindValue(22, $sitTrabId != '' ? $sitTrabId : NULL);
    $stmt->bindValue(23, $sitTrabDecreto);
    $stmt->bindValue(24, $sitTrabDoe);
    $stmt->bindValue(25, formata_data($sitTrabDtInicio));
    $stmt->bindValue(26, formata_data($sitTrabDtFim));
    $stmt->bindValue(27, $sitTrabObs);
    $stmt->bindValue(28, $empregador2 != '' ? $empregador2 : NULL);
    $stmt->bindValue(29, $setorId2 != '' ? $setorId2 : NULL);
    $stmt->bindValue(30, $sitTrabId2 != '' ? $sitTrabId2 : NULL);
    $stmt->bindValue(31, $sitTrabDecreto2);
    $stmt->bindValue(32, $sitTrabDoe2);
    $stmt->bindValue(33, formata_data($sitTrabDtInicio2));
    $stmt->bindValue(34, formata_data($sitTrabDtFim2));
    $stmt->bindValue(35, $sitTrabObs2);
    $stmt->bindValue(36, NULL);
    $stmt->bindValue(37, $sangueTipo);
    $stmt->bindValue(38, $raca);
    $stmt->bindValue(39, $covidVacinaNome);
    $stmt->bindValue(40, $covidVacinaDose);
    $stmt->bindValue(41, $covidVacinaLote);
    $stmt->bindValue(42, formata_data($covidVacinaData));
    $stmt->bindValue(43, $covidVacinaEnd);
    $stmt->bindValue(44, $enfermidadePortada);
    $stmt->bindValue(45, $enfermidadeCodInt);
    $stmt->bindValue(46, $servTipoId != '' ? $servTipoId : NULL);
    $stmt->bindValue(47, $cargoId != '' ? $cargoId : NULL);
    $stmt->bindValue(48, $servTipoId2 != '' ? $servTipoId2 : NULL);
    $stmt->bindValue(49, $cargoId2 != '' ? $cargoId2 : NULL);
    $stmt->bindValue(50, $atestacaoMatricula);
    $stmt->bindValue(51, $atestacaoMatricula2);
    $stmt->bindValue(52, $status);
    $stmt->bindValue(53, $servidorId);
    $stmt->bindValue(54, $tipoAtualizacao);
    $stmt->execute();
    $atualizacaoIdNew = $db->lastInsertId();
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
    $stmt->bindValue(3, $atualizacaoIdNew);
    $stmt->bindValue(4, 1);
    $stmt->bindValue(5, NULL);
    $stmt->execute();
    $db->commit();
      //MENSAGEM DE SUCESSO
    $msg['id'] = $atualizacaoIdNew;
    $msg['situacaoId'] = 1;
    $msg['tipoAtualizacao'] = $tipoAtualizacao;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Dados pessoais do servidor cadastrados com sucesso.';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar salvar os dados pessoais do servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>