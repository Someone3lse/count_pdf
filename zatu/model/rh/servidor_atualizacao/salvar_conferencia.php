<?php
$db                   = Conexao::getInstance();
$servId               = strip_tags(@$_POST['servidor_id']);
$servAtualiId         = strip_tags(@$_POST['servidor_atualizacao_id']);
$servAtualiProvaId    = strip_tags(@$_POST['servidor_atualizacao_prova_id']);
$conferenciaSituacao  = strip_tags(@$_POST['conferencia_situacao']);
$situacaoPessoal      = strip_tags(@$_POST['situacao_pessoal']);
$obsPessoal           = strip_tags(@$_POST['obs_pessoal']);
$situacaoNatural      = strip_tags(@$_POST['situacao_naturalidade']);
$obsNatural           = strip_tags(@$_POST['obs_naturalidade']);
$situacaoSitTrab      = strip_tags(@$_POST['situacao_situacao_trabalho']);
$obsSitTrab           = strip_tags(@$_POST['obs_situacao_trabalho']);
$situacaoSitTrab2     = strip_tags(@$_POST['situacao_situacao_trabalho_2']);
$obsSitTrab2          = strip_tags(@$_POST['obs_situacao_trabalho_2']);
$situacaoVacinaCovid  = strip_tags(@$_POST['situacao_covid_vacina']);
$obsVacinaCovid       = strip_tags(@$_POST['obs_covid_vacina']);
$situacaoEnfermidade  = strip_tags(@$_POST['situacao_enfermidade']);
$obsEnfermidade       = strip_tags(@$_POST['obs_enfermidade']);
$situacaoEnd          = strip_tags(@$_POST['situacao_end']);
$obsEnd               = strip_tags(@$_POST['obs_end']);
$situacaoRg           = strip_tags(@$_POST['situacao_rg']);
$obsRg                = strip_tags(@$_POST['obs_rg']);
$situacaoPis          = strip_tags(@$_POST['situacao_pis']);
$obsPis               = strip_tags(@$_POST['obs_pis']);
$situacaoCtps         = strip_tags(@$_POST['situacao_ctps']);
$obsCtps              = strip_tags(@$_POST['obs_ctps']);
$situacaoEleitor      = strip_tags(@$_POST['situacao_eleitor']);
$obsEleitor           = strip_tags(@$_POST['obs_eleitor']);
$situacaoRegMilitar   = strip_tags(@$_POST['situacao_reg_militar']);
$obsRegMilitar        = strip_tags(@$_POST['obs_reg_militar']);
$situacaoRegProf      = strip_tags(@$_POST['situacao_reg_prof']);
$obsRegProf           = strip_tags(@$_POST['obs_reg_prof']);
$situacaoCnh          = strip_tags(@$_POST['situacao_cnh']);
$obsCnh               = strip_tags(@$_POST['obs_cnh']);
$situacaoRne          = strip_tags(@$_POST['situacao_rne']);
$obsRne               = strip_tags(@$_POST['obs_rne']);
$situacaoFgts         = NULL;
$obsFgts              = NULL;
// $situacaoFgts         = strip_tags(@$_POST['situacao_fgts']);
// $obsFgts              = strip_tags(@$_POST['obs_fgts']);
$situacaoRegCivil     = strip_tags(@$_POST['situacao_reg_civil']);
$obsRegCivil          = strip_tags(@$_POST['obs_reg_civil']);
$situacaoAverbacao    = strip_tags(@$_POST['situacao_averbacao']);
$obsAverbacao         = strip_tags(@$_POST['obs_averbacao']);
// $situacaoBancario     = strip_tags(@$_POST['situacao_bancario']);
// $obsBancario          = strip_tags(@$_POST['obs_bancario']);
$situacaoBancario     = 1;
$obsBancario          = '';
$status               = 1;
// $status               = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error = false;
$msg = array();
$mensagem = "";
try {
  $db->beginTransaction();
  if (is_numeric($servAtualiProvaId) && $servAtualiProvaId != "" && $servAtualiProvaId != 0 ) {
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao_prova 
      SET
      situacao_pessoal = ?, 
      obs_pessoal = ?, 
      situacao_naturalidade = ?, 
      obs_naturalidade = ?, 
      situacao_situacao_trabalho = ?, 
      obs_situacao_trabalho = ?, 
      situacao_situacao_trabalho_2 = ?, 
      obs_situacao_trabalho_2 = ?, 
      situacao_covid_vacina = ?, 
      obs_covid_vacina = ?, 
      situacao_enfermidade = ?, 
      obs_enfermidade = ?, 
      situacao_end = ?, 
      obs_end = ?, 
      situacao_rg = ?, 
      obs_rg = ?, 
      situacao_pis = ?, 
      obs_pis = ?, 
      situacao_ctps = ?, 
      obs_ctps = ?, 
      situacao_eleitor = ?, 
      obs_eleitor = ?, 
      situacao_reg_militar = ?, 
      obs_reg_militar = ?, 
      situacao_reg_prof = ?, 
      obs_reg_prof = ?, 
      situacao_cnh = ?, 
      obs_cnh = ?, 
      situacao_rne = ?, 
      obs_rne = ?, 
      situacao_fgts = ?, 
      obs_fgts = ?, 
      situacao_reg_civil = ?, 
      obs_reg_civil = ?, 
      situacao_averbacao = ?, 
      obs_averbacao = ?, 
      situacao_bancario = ?, 
      obs_bancario = ?, 
      status = ?, 
      dt_cadastro = NOW(), 
      seg_usuario_id = ? 
      WHERE id = ? ;');
    $stmt->bindValue(1, $situacaoPessoal);
    $stmt->bindValue(2, $obsPessoal);
    $stmt->bindValue(3, $situacaoNatural);
    $stmt->bindValue(4, $obsNatural);
    $stmt->bindValue(5, $situacaoSitTrab);
    $stmt->bindValue(6, $obsSitTrab);
    $stmt->bindValue(7, $situacaoSitTrab2);
    $stmt->bindValue(8, $obsSitTrab2);
    $stmt->bindValue(9, $situacaoVacinaCovid);
    $stmt->bindValue(10, $obsVacinaCovid);
    $stmt->bindValue(11, $situacaoEnfermidade);
    $stmt->bindValue(12, $obsEnfermidade);
    $stmt->bindValue(13, $situacaoEnd);
    $stmt->bindValue(14, $obsEnd);
    $stmt->bindValue(15, $situacaoRg);
    $stmt->bindValue(16, $obsRg);
    $stmt->bindValue(17, $situacaoPis);
    $stmt->bindValue(18, $obsPis);
    $stmt->bindValue(19, $situacaoCtps);
    $stmt->bindValue(20, $obsCtps);
    $stmt->bindValue(21, $situacaoEleitor);
    $stmt->bindValue(22, $obsEleitor);
    $stmt->bindValue(23, $situacaoRegMilitar);
    $stmt->bindValue(24, $obsRegMilitar);
    $stmt->bindValue(25, $situacaoRegProf);
    $stmt->bindValue(26, $obsRegProf);
    $stmt->bindValue(27, $situacaoCnh);
    $stmt->bindValue(28, $obsCnh);
    $stmt->bindValue(29, $situacaoRne);
    $stmt->bindValue(30, $obsRne);
    $stmt->bindValue(31, $situacaoFgts);
    $stmt->bindValue(32, $obsFgts);
    $stmt->bindValue(33, $situacaoRegCivil);
    $stmt->bindValue(34, $obsRegCivil);
    $stmt->bindValue(35, $situacaoAverbacao);
    $stmt->bindValue(36, $obsAverbacao);
    $stmt->bindValue(37, $situacaoBancario);
    $stmt->bindValue(38, $obsBancario);
    $stmt->bindValue(39, $status);
    $stmt->bindValue(40, $_SESSION['zatu_id']);
    $stmt->bindValue(41, $servAtualiProvaId);
    $stmt->execute();
    $stmt = $db->prepare("
      SELECT 
      id 
      FROM sacad_servidor_atualizacao_instrucao 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;");
    $stmt->bindValue(1, $servAtualiId);
    $stmt->execute();
    $rsServidorAtualizacaoInstrucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($rsServidorAtualizacaoInstrucoes) && sizeof($rsServidorAtualizacaoInstrucoes) > 0) {
      foreach ($rsServidorAtualizacaoInstrucoes as $kObj => $vObj) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_instrucao 
          SET
          situacao_instrucao = ?, 
          obs_instrucao = ?, 
          status = ?, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ?  
          WHERE id = ? ;');
        $stmt->bindValue(1, strip_tags(@$_POST['situacao_instrucao_'.($kObj + 1)]));
        $stmt->bindValue(2, strip_tags(@$_POST['obs_instrucao_'.($kObj + 1)]));
        $stmt->bindValue(3, $status);
        $stmt->bindValue(4, $_SESSION['zatu_id']);
        $stmt->bindValue(5, $vObj['id']);
        $stmt->execute();
      }
    }

    $stmt = $db->prepare("
      SELECT 
      id 
      FROM sacad_servidor_atualizacao_dependente 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;");
    $stmt->bindValue(1, $servAtualiId);
    $stmt->execute();
    $rsServidorAtualizacaoDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($rsServidorAtualizacaoDependentes) && sizeof($rsServidorAtualizacaoDependentes) > 0) {
      foreach ($rsServidorAtualizacaoDependentes as $kObj => $vObj) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_dependente 
          SET
          situacao_dependente = ?, 
          obs_dependente = ?, 
          status = ?, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ? 
          WHERE id = ? ;');
        $stmt->bindValue(1, strip_tags(@$_POST['situacao_dependente_'.($kObj + 1)]));
        $stmt->bindValue(2, strip_tags(@$_POST['obs_dependente_'.($kObj + 1)]));
        $stmt->bindValue(3, $status);
        $stmt->bindValue(4, $_SESSION['zatu_id']);
        $stmt->bindValue(5, $vObj['id']);
        $stmt->execute();
      }
    }

    $stmt = $db->prepare("
      SELECT 
      id 
      FROM sacad_servidor_atualizacao_vinculo 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;");
    $stmt->bindValue(1, $servAtualiId);
    $stmt->execute();
    $rsServidorAtualizacaoVinculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($rsServidorAtualizacaoVinculos) && sizeof($rsServidorAtualizacaoVinculos) > 0) {
      foreach ($rsServidorAtualizacaoVinculos as $kObj => $vObj) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_vinculo 
          SET
          situacao_vinculo = ?, 
          obs_vinculo = ?, 
          status = ?, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ? 
          WHERE id = ? ;');
        $stmt->bindValue(1, strip_tags(@$_POST['situacao_vinculo_'.($kObj + 1)]));
        $stmt->bindValue(2, strip_tags(@$_POST['obs_vinculo_'.($kObj + 1)]));
        $stmt->bindValue(3, $status);
        $stmt->bindValue(4, $_SESSION['zatu_id']);
        $stmt->bindValue(5, $vObj['id']);
        $stmt->execute();
      }
    }

    $stmt = $db->prepare('
      INSERT sacad_servidor_atualizacao_situacao 
      (status, 
        dt_cadastro, 
        seg_usuario_id, 
        sacad_servidor_atualizacao_id, 
        sacad_situacao_servidor_atualizacao_id) 
      VALUES (?, NOW(), ?, ?, ? );');
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $_SESSION['zatu_id']);
    $stmt->bindValue(3, $servAtualiId);
    $stmt->bindValue(4, 6);
    $stmt->execute();

    if ($conferenciaSituacao == 1) {
      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao  
        WHERE id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt = $db->prepare('
        UPDATE rh_servidor 
        SET
        nome = ?, 
        nome_social = ?, 
        sexo = ?, 
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
        matricula = ?, 
        eo_empregador_id = ?, 
        eo_setor_unidade_organizacional_id = ?, 
        rh_situacao_trabalho_id = ?, 
        situacao_trabalho_decreto = ?, 
        situacao_trabalho_doe = ?, 
        situacao_trabalho_dt_inicio = ?, 
        situacao_trabalho_dt_fim = ?, 
        situacao_trabalho_obs = ?, 
        matricula_2 = ?, 
        eo_empregador_id_2 = ?, 
        eo_setor_unidade_organizacional_id_2 = ?, 
        rh_situacao_trabalho_id_2 = ?, 
        situacao_trabalho_decreto_2 = ?, 
        situacao_trabalho_doe_2 = ?, 
        situacao_trabalho_dt_inicio_2 = ?, 
        situacao_trabalho_dt_fim_2 = ?, 
        situacao_trabalho_obs_2 = ?, 
        sangue_tipo = ?, 
        raca = ?, 
        enfermidade_portador = ?, 
        enfermidade_codigo_internacional = ?, 
        status = ?, 
        dt_cadastro = NOW(), 
        seg_usuario_id = ?
        WHERE id = ? ;');
      $stmt->bindValue(1, $rsServidorAtualizacao['nome']);
      $stmt->bindValue(2, $rsServidorAtualizacao['nome_social']);
      $stmt->bindValue(3, $rsServidorAtualizacao['sexo']);
      $stmt->bindValue(4, $rsServidorAtualizacao['natural_bsc_pais_id']);
      $stmt->bindValue(5, $rsServidorAtualizacao['natural_bsc_municipio_id']);
      $stmt->bindValue(6, $rsServidorAtualizacao['natural_estrangeiro_dt_ingresso']);
      $stmt->bindValue(7, $rsServidorAtualizacao['natural_estrangeiro_cidade']);
      $stmt->bindValue(8, $rsServidorAtualizacao['natural_estrangeiro_estado']);
      $stmt->bindValue(9, $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho']);
      $stmt->bindValue(10, $rsServidorAtualizacao['pai_nome']);
      $stmt->bindValue(11, $rsServidorAtualizacao['pai_natural_bsc_pais_id']);
      $stmt->bindValue(12, $rsServidorAtualizacao['pai_profissao']);
      $stmt->bindValue(13, $rsServidorAtualizacao['mae_nome']);
      $stmt->bindValue(14, $rsServidorAtualizacao['mae_natural_bsc_pais_id']);
      $stmt->bindValue(15, $rsServidorAtualizacao['mae_profissao']);
      $stmt->bindValue(16, $rsServidorAtualizacao['matricula']);
      $stmt->bindValue(17, $rsServidorAtualizacao['eo_empregador_id']);
      $stmt->bindValue(18, $rsServidorAtualizacao['eo_setor_unidade_organizacional_id']);
      $stmt->bindValue(19, $rsServidorAtualizacao['rh_situacao_trabalho_id']);
      $stmt->bindValue(20, $rsServidorAtualizacao['situacao_trabalho_decreto']);
      $stmt->bindValue(21, $rsServidorAtualizacao['situacao_trabalho_doe']);
      $stmt->bindValue(22, $rsServidorAtualizacao['situacao_trabalho_dt_inicio']);
      $stmt->bindValue(23, $rsServidorAtualizacao['situacao_trabalho_dt_fim']);
      $stmt->bindValue(24, $rsServidorAtualizacao['situacao_trabalho_obs']);
      $stmt->bindValue(25, $rsServidorAtualizacao['matricula_2']);
      $stmt->bindValue(26, $rsServidorAtualizacao['eo_empregador_id_2']);
      $stmt->bindValue(27, $rsServidorAtualizacao['eo_setor_unidade_organizacional_id_2']);
      $stmt->bindValue(28, $rsServidorAtualizacao['rh_situacao_trabalho_id_2']);
      $stmt->bindValue(29, $rsServidorAtualizacao['situacao_trabalho_decreto_2']);
      $stmt->bindValue(30, $rsServidorAtualizacao['situacao_trabalho_doe_2']);
      $stmt->bindValue(31, $rsServidorAtualizacao['situacao_trabalho_dt_inicio_2']);
      $stmt->bindValue(32, $rsServidorAtualizacao['situacao_trabalho_dt_fim_2']);
      $stmt->bindValue(33, $rsServidorAtualizacao['situacao_trabalho_obs_2']);
      $stmt->bindValue(34, $rsServidorAtualizacao['sangue_tipo']);
      $stmt->bindValue(35, $rsServidorAtualizacao['raca']);
      $stmt->bindValue(36, $rsServidorAtualizacao['enfermidade_portador']);
      $stmt->bindValue(37, $rsServidorAtualizacao['enfermidade_codigo_internacional']);
      $stmt->bindValue(38, $status);
      $stmt->bindValue(39, $_SESSION['zatu_id']);
      $stmt->bindValue(40, $servId);
      $stmt->execute(); 

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_contato   
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoContato = $stmt->fetch(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoContato)) {
        $stmt = $db->prepare("
          SELECT 
          * 
          FROM rh_servidor_contato   
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        $rsServidorContato = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($rsServidorContato)) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_contato 
            SET
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
          $stmt->bindValue(1, $rsServidorAtualizacaoContato['end_cep']);
          $stmt->bindValue(2, $rsServidorAtualizacaoContato['end_logradouro']);
          $stmt->bindValue(3, $rsServidorAtualizacaoContato['end_numero']);
          $stmt->bindValue(4, $rsServidorAtualizacaoContato['end_complemento']);
          $stmt->bindValue(5, $rsServidorAtualizacaoContato['end_bairro']);
          $stmt->bindValue(6, $rsServidorAtualizacaoContato['end_bsc_municipio_id']);
          $stmt->bindValue(7, $rsServidorAtualizacaoContato['tel_residencial']);
          $stmt->bindValue(8, $rsServidorAtualizacaoContato['tel_celular']);
          $stmt->bindValue(9, $rsServidorAtualizacaoContato['tel_recado']);
          $stmt->bindValue(10, $rsServidorAtualizacaoContato['tel_recado_nome']);
          $stmt->bindValue(11, $rsServidorAtualizacaoContato['tel_recado_bsc_parentesco_grau_id']);
          $stmt->bindValue(12, $rsServidorAtualizacaoContato['email_institucional']);
          $stmt->bindValue(13, $rsServidorAtualizacaoContato['email_pessoal']);
          $stmt->bindValue(14, $rsServidorAtualizacaoContato['email_alternativo']);
          $stmt->bindValue(15, $rsServidorAtualizacaoContato['contato_emergencia_nome']);
          $stmt->bindValue(16, $rsServidorAtualizacaoContato['contato_emergencia_end']);
          $stmt->bindValue(17, $rsServidorAtualizacaoContato['contato_emergencia_tel']);
          $stmt->bindValue(18, $status);
          $stmt->bindValue(19, $_SESSION['zatu_id']);
          $stmt->bindValue(20, $rsServidorContato['id']);
          $stmt->execute();
        } else {
          $stmt = $db->prepare('INSERT INTO rh_servidor_contato 
            (end_cep, 
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
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $rsServidorAtualizacaoContato['end_cep']);
          $stmt->bindValue(2, $rsServidorAtualizacaoContato['end_logradouro']);
          $stmt->bindValue(3, $rsServidorAtualizacaoContato['end_numero']);
          $stmt->bindValue(4, $rsServidorAtualizacaoContato['end_complemento']);
          $stmt->bindValue(5, $rsServidorAtualizacaoContato['end_bairro']);
          $stmt->bindValue(6, $rsServidorAtualizacaoContato['end_bsc_municipio_id']);
          $stmt->bindValue(7, $rsServidorAtualizacaoContato['tel_residencial']);
          $stmt->bindValue(8, $rsServidorAtualizacaoContato['tel_celular']);
          $stmt->bindValue(9, $rsServidorAtualizacaoContato['tel_recado']);
          $stmt->bindValue(10, $rsServidorAtualizacaoContato['tel_recado_nome']);
          $stmt->bindValue(11, $rsServidorAtualizacaoContato['tel_recado_bsc_parentesco_grau_id']);
          $stmt->bindValue(12, $rsServidorAtualizacaoContato['email_institucional']);
          $stmt->bindValue(13, $rsServidorAtualizacaoContato['email_pessoal']);
          $stmt->bindValue(14, $rsServidorAtualizacaoContato['email_alternativo']);
          $stmt->bindValue(15, $rsServidorAtualizacaoContato['contato_emergencia_nome']);
          $stmt->bindValue(16, $rsServidorAtualizacaoContato['contato_emergencia_end']);
          $stmt->bindValue(17, $rsServidorAtualizacaoContato['contato_emergencia_tel']);
          $stmt->bindValue(18, $status);
          $stmt->bindValue(19, $servId);
          $stmt->bindValue(20, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_documento   
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoDocumento = $stmt->fetch(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoDocumento)) {
        $stmt = $db->prepare("
          SELECT 
          * 
          FROM rh_servidor_documento   
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        $rsServidorDocumento = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($rsServidorDocumento)) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_documento 
            SET
            rg_numero = ?, 
            rg_dt_emissao = ?, 
            rg_orgao_expedidor = ?, 
            pis_numero = ?, 
            pis_dt_cadastro = ?, 
            pis_domicilio_bancario = ?, 
            pis_banco_numero = ?, 
            pis_agencia = ?, 
            pis_agencia_end = ?, 
            eleitor_numero = ?, 
            eleitor_zona = ?, 
            eleitor_secao = ?, 
            eleitor_bsc_municipio_id = ?, 
            eleitor_insc_orgao_classe = ?, 
            ctps_numero = ?, 
            ctps_serie = ?, 
            ctps_dt_emissao = ?, 
            ctps_orgao_expedidor = ?, 
            ctps_primeiro_emprego_ano = ?, 
            cnh_numero = ?, 
            cnh_categoria = ?, 
            cnh_dt_emissao = ?, 
            cnh_orgao_expedidor = ?, 
            cnh_dt_validade = ?, 
            cnh_dt_primeira_habilitacao = ?, 
            reg_militar_numero = ?, 
            reg_militar_categoria = ?, 
            reg_militar_emissao_ano = ?, 
            reg_militar_orgao_expedidor = ?, 
            reg_militar_especie = ?, 
            reg_prof_numero = ?, 
            reg_prof_dt_emissao = ?, 
            reg_prof_orgao_expedidor = ?, 
            reg_prof_dt_validade = ?, 
            rne_numero = ?, 
            rne_dt_emissao = ?, 
            rne_orgao_expedidor = ?, 
            fgts_numero = ?, 
            fgts_opcao = ?, 
            fgts_conta_vinculada_banco = ?, 
            fgts_dt_retificacao = ?, 
            estrangeiro_casado_brasileiro = ?, 
            estrangeiro_filho_brasileiro = ?, 
            status = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $rsServidorAtualizacaoDocumento['rg_numero']);
          $stmt->bindValue(2, $rsServidorAtualizacaoDocumento['rg_dt_emissao']);
          $stmt->bindValue(3, $rsServidorAtualizacaoDocumento['rg_orgao_expedidor']);
          $stmt->bindValue(4, $rsServidorAtualizacaoDocumento['pis_numero']);
          $stmt->bindValue(5, $rsServidorAtualizacaoDocumento['pis_dt_cadastro']);
          $stmt->bindValue(6, $rsServidorAtualizacaoDocumento['pis_domicilio_bancario']);
          $stmt->bindValue(7, $rsServidorAtualizacaoDocumento['pis_banco_numero']);
          $stmt->bindValue(8, $rsServidorAtualizacaoDocumento['pis_agencia']);
          $stmt->bindValue(9, $rsServidorAtualizacaoDocumento['pis_agencia_end']);
          $stmt->bindValue(10, $rsServidorAtualizacaoDocumento['eleitor_numero']);
          $stmt->bindValue(11, $rsServidorAtualizacaoDocumento['eleitor_zona']);
          $stmt->bindValue(12, $rsServidorAtualizacaoDocumento['eleitor_secao']);
          $stmt->bindValue(13, $rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id']);
          $stmt->bindValue(14, $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe']);
          $stmt->bindValue(15, $rsServidorAtualizacaoDocumento['ctps_numero']);
          $stmt->bindValue(16, $rsServidorAtualizacaoDocumento['ctps_serie']);
          $stmt->bindValue(17, $rsServidorAtualizacaoDocumento['ctps_dt_emissao']);
          $stmt->bindValue(18, $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor']);
          $stmt->bindValue(19, $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano']);
          $stmt->bindValue(20, $rsServidorAtualizacaoDocumento['cnh_numero']);
          $stmt->bindValue(21, $rsServidorAtualizacaoDocumento['cnh_categoria']);
          $stmt->bindValue(22, $rsServidorAtualizacaoDocumento['cnh_dt_emissao']);
          $stmt->bindValue(23, $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor']);
          $stmt->bindValue(24, $rsServidorAtualizacaoDocumento['cnh_dt_validade']);
          $stmt->bindValue(25, $rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']);
          $stmt->bindValue(26, $rsServidorAtualizacaoDocumento['reg_militar_numero']);
          $stmt->bindValue(27, $rsServidorAtualizacaoDocumento['reg_militar_categoria']);
          $stmt->bindValue(28, $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano']);
          $stmt->bindValue(29, $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor']);
          $stmt->bindValue(30, $rsServidorAtualizacaoDocumento['reg_militar_especie']);
          $stmt->bindValue(31, $rsServidorAtualizacaoDocumento['reg_prof_numero']);
          $stmt->bindValue(32, $rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']);
          $stmt->bindValue(33, $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor']);
          $stmt->bindValue(34, $rsServidorAtualizacaoDocumento['reg_prof_dt_validade']);
          $stmt->bindValue(35, $rsServidorAtualizacaoDocumento['rne_numero']);
          $stmt->bindValue(36, $rsServidorAtualizacaoDocumento['rne_dt_emissao']);
          $stmt->bindValue(37, $rsServidorAtualizacaoDocumento['rne_orgao_expedidor']);
          $stmt->bindValue(38, $rsServidorAtualizacaoDocumento['fgts_numero']);
          $stmt->bindValue(39, $rsServidorAtualizacaoDocumento['fgts_opcao']);
          $stmt->bindValue(40, $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco']);
          $stmt->bindValue(41, $rsServidorAtualizacaoDocumento['fgts_dt_retificacao']);
          $stmt->bindValue(42, $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro']);
          $stmt->bindValue(43, $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro']);
          $stmt->bindValue(44, $status);
          $stmt->bindValue(45, $_SESSION['zatu_id']);
          $stmt->bindValue(46, $rsServidorDocumento['id']);
          $stmt->execute();
        } else {
          $stmt = $db->prepare('INSERT INTO rh_servidor_documento 
            (rg_numero, 
              rg_dt_emissao, 
              rg_orgao_expedidor, 
              pis_numero, 
              pis_dt_cadastro, 
              pis_domicilio_bancario, 
              pis_banco_numero, 
              pis_agencia, 
              pis_agencia_end, 
              eleitor_numero, 
              eleitor_zona, 
              eleitor_secao, 
              eleitor_bsc_municipio_id, 
              eleitor_insc_orgao_classe, 
              ctps_numero, 
              ctps_serie, 
              ctps_dt_emissao, 
              ctps_orgao_expedidor, 
              ctps_primeiro_emprego_ano, 
              cnh_numero, 
              cnh_categoria, 
              cnh_dt_emissao, 
              cnh_orgao_expedidor, 
              cnh_dt_validade, 
              cnh_dt_primeira_habilitacao, 
              reg_militar_numero, 
              reg_militar_categoria, 
              reg_militar_emissao_ano, 
              reg_militar_orgao_expedidor, 
              reg_militar_especie, 
              reg_prof_numero, 
              reg_prof_dt_emissao, 
              reg_prof_orgao_expedidor, 
              reg_prof_dt_validade, 
              rne_numero, 
              rne_dt_emissao, 
              rne_orgao_expedidor, 
              fgts_numero, 
              fgts_opcao, 
              fgts_conta_vinculada_banco, 
              fgts_dt_retificacao, 
              estrangeiro_casado_brasileiro, 
              estrangeiro_filho_brasileiro , 
              status, 
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $rsServidorAtualizacaoDocumento['rg_numero']);
          $stmt->bindValue(2, $rsServidorAtualizacaoDocumento['rg_dt_emissao']);
          $stmt->bindValue(3, $rsServidorAtualizacaoDocumento['rg_orgao_expedidor']);
          $stmt->bindValue(4, $rsServidorAtualizacaoDocumento['pis_numero']);
          $stmt->bindValue(5, $rsServidorAtualizacaoDocumento['pis_dt_cadastro']);
          $stmt->bindValue(6, $rsServidorAtualizacaoDocumento['pis_domicilio_bancario']);
          $stmt->bindValue(7, $rsServidorAtualizacaoDocumento['pis_banco_numero']);
          $stmt->bindValue(8, $rsServidorAtualizacaoDocumento['pis_agencia']);
          $stmt->bindValue(9, $rsServidorAtualizacaoDocumento['pis_agencia_end']);
          $stmt->bindValue(10, $rsServidorAtualizacaoDocumento['eleitor_numero']);
          $stmt->bindValue(11, $rsServidorAtualizacaoDocumento['eleitor_zona']);
          $stmt->bindValue(12, $rsServidorAtualizacaoDocumento['eleitor_secao']);
          $stmt->bindValue(13, $rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id']);
          $stmt->bindValue(14, $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe']);
          $stmt->bindValue(15, $rsServidorAtualizacaoDocumento['ctps_numero']);
          $stmt->bindValue(16, $rsServidorAtualizacaoDocumento['ctps_serie']);
          $stmt->bindValue(17, $rsServidorAtualizacaoDocumento['ctps_dt_emissao']);
          $stmt->bindValue(18, $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor']);
          $stmt->bindValue(19, $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano']);
          $stmt->bindValue(20, $rsServidorAtualizacaoDocumento['cnh_numero']);
          $stmt->bindValue(21, $rsServidorAtualizacaoDocumento['cnh_categoria']);
          $stmt->bindValue(22, $rsServidorAtualizacaoDocumento['cnh_dt_emissao']);
          $stmt->bindValue(23, $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor']);
          $stmt->bindValue(24, $rsServidorAtualizacaoDocumento['cnh_dt_validade']);
          $stmt->bindValue(25, $rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']);
          $stmt->bindValue(26, $rsServidorAtualizacaoDocumento['reg_militar_numero']);
          $stmt->bindValue(27, $rsServidorAtualizacaoDocumento['reg_militar_categoria']);
          $stmt->bindValue(28, $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano']);
          $stmt->bindValue(29, $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor']);
          $stmt->bindValue(30, $rsServidorAtualizacaoDocumento['reg_militar_especie']);
          $stmt->bindValue(31, $rsServidorAtualizacaoDocumento['reg_prof_numero']);
          $stmt->bindValue(32, $rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']);
          $stmt->bindValue(33, $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor']);
          $stmt->bindValue(34, $rsServidorAtualizacaoDocumento['reg_prof_dt_validade']);
          $stmt->bindValue(35, $rsServidorAtualizacaoDocumento['rne_numero']);
          $stmt->bindValue(36, $rsServidorAtualizacaoDocumento['rne_dt_emissao']);
          $stmt->bindValue(37, $rsServidorAtualizacaoDocumento['rne_orgao_expedidor']);
          $stmt->bindValue(38, $rsServidorAtualizacaoDocumento['fgts_numero']);
          $stmt->bindValue(39, $rsServidorAtualizacaoDocumento['fgts_opcao']);
          $stmt->bindValue(40, $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco']);
          $stmt->bindValue(41, $rsServidorAtualizacaoDocumento['fgts_dt_retificacao']);
          $stmt->bindValue(42, $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro']);
          $stmt->bindValue(43, $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro']);
          $stmt->bindValue(44, $status);
          $stmt->bindValue(45, $servId);
          $stmt->bindValue(46, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_familiar   
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoFamiliar = $stmt->fetch(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoFamiliar)) {
        $stmt = $db->prepare("
          SELECT 
          * 
          FROM rh_servidor_familiar  
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        $rsServidorFamiliar = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($rsServidorFamiliar)) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_familiar 
            SET
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
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id']);
          $stmt->bindValue(2, $rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']);
          $stmt->bindValue(3, $rsServidorAtualizacaoFamiliar['conjuge_nome']);
          $stmt->bindValue(4, $rsServidorAtualizacaoFamiliar['conjuge_cpf']);
          $stmt->bindValue(5, $rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']);
          $stmt->bindValue(6, $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id']);
          $stmt->bindValue(7, $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id']);
          $stmt->bindValue(8, $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade']);
          $stmt->bindValue(9, $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado']);
          $stmt->bindValue(10, $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho']);
          $stmt->bindValue(11, $rsServidorAtualizacaoFamiliar['reg_civil_numero']);
          $stmt->bindValue(12, $rsServidorAtualizacaoFamiliar['reg_civil_livro']);
          $stmt->bindValue(13, $rsServidorAtualizacaoFamiliar['reg_civil_folha']);
          $stmt->bindValue(14, $rsServidorAtualizacaoFamiliar['reg_civil_cartorio']);
          $stmt->bindValue(15, $rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']);
          $stmt->bindValue(16, $rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id']);
          $stmt->bindValue(17, $rsServidorAtualizacaoFamiliar['averbacao_tipo']);
          $stmt->bindValue(18, $rsServidorAtualizacaoFamiliar['averbacao_numero']);
          $stmt->bindValue(19, $rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']);
          $stmt->bindValue(20, $rsServidorAtualizacaoFamiliar['averbacao_cartorio']);
          $stmt->bindValue(21, $rsServidorAtualizacaoFamiliar['averbacao_bsc_municipio_id']);
          $stmt->bindValue(22, $status);
          $stmt->bindValue(23, $_SESSION['zatu_id']);
          $stmt->bindValue(24, $rsServidorFamiliar['id']);
          $stmt->execute();
        } else {
          $stmt = $db->prepare('INSERT INTO rh_servidor_familiar 
            (bsc_estado_civil_id, 
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
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id']);
          $stmt->bindValue(2, $rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']);
          $stmt->bindValue(3, $rsServidorAtualizacaoFamiliar['conjuge_nome']);
          $stmt->bindValue(4, $rsServidorAtualizacaoFamiliar['conjuge_cpf']);
          $stmt->bindValue(5, $rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']);
          $stmt->bindValue(6, $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id']);
          $stmt->bindValue(7, $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id']);
          $stmt->bindValue(8, $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade']);
          $stmt->bindValue(9, $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado']);
          $stmt->bindValue(10, $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho']);
          $stmt->bindValue(11, $rsServidorAtualizacaoFamiliar['reg_civil_numero']);
          $stmt->bindValue(12, $rsServidorAtualizacaoFamiliar['reg_civil_livro']);
          $stmt->bindValue(13, $rsServidorAtualizacaoFamiliar['reg_civil_folha']);
          $stmt->bindValue(14, $rsServidorAtualizacaoFamiliar['reg_civil_cartorio']);
          $stmt->bindValue(15, $rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']);
          $stmt->bindValue(16, $rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id']);
          $stmt->bindValue(17, $rsServidorAtualizacaoFamiliar['averbacao_tipo']);
          $stmt->bindValue(18, $rsServidorAtualizacaoFamiliar['averbacao_numero']);
          $stmt->bindValue(19, $rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']);
          $stmt->bindValue(20, $rsServidorAtualizacaoFamiliar['averbacao_cartorio']);
          $stmt->bindValue(21, $rsServidorAtualizacaoFamiliar['averbacao_bsc_municipio_id']);
          $stmt->bindValue(22, $status);
          $stmt->bindValue(23, $servId);
          $stmt->bindValue(24, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_bancario   
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoBancario = $stmt->fetch(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoBancario)) {
        $stmt = $db->prepare("
          SELECT 
          * 
          FROM rh_servidor_bancario  
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        $rsServidorBancario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($rsServidorBancario)) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_bancario 
            SET 
            bancario_bsc_banco_conta_tipo_id = ?, 
            bancario_bsc_banco_id = ?, 
            bancario_agencia = ?, 
            bancario_conta = ?, 
            bancario_op = ?, 
            status = ?,
            dt_cadastro = NOW(), 
            seg_usuario_id = ?
            WHERE id = ?;');
          $stmt->bindValue(1, $rsServidorAtualizacaoBancario['bancario_bsc_banco_conta_tipo_id']);
          $stmt->bindValue(2, $rsServidorAtualizacaoBancario['bancario_bsc_banco_id']);
          $stmt->bindValue(3, $rsServidorAtualizacaoBancario['bancario_agencia']);
          $stmt->bindValue(4, $rsServidorAtualizacaoBancario['bancario_conta']);
          $stmt->bindValue(5, $rsServidorAtualizacaoBancario['bancario_op']);
          $stmt->bindValue(6, $status);
          $stmt->bindValue(7, $_SESSION['zatu_id']);
          $stmt->bindValue(8, $rsServidorBancario['id']);
          $stmt->execute();
        } else {
          $stmt = $db->prepare('INSERT INTO rh_servidor_bancario 
            (bancario_bsc_banco_conta_tipo_id, 
              bancario_bsc_banco_id, 
              bancario_agencia, 
              bancario_conta, 
              bancario_op, 
              status,
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, NOW(), ?);');
          $stmt->bindValue(1, $rsServidorAtualizacaoBancario['bancario_bsc_banco_conta_tipo_id']);
          $stmt->bindValue(2, $rsServidorAtualizacaoBancario['bancario_bsc_banco_id']);
          $stmt->bindValue(3, $rsServidorAtualizacaoBancario['bancario_agencia']);
          $stmt->bindValue(4, $rsServidorAtualizacaoBancario['bancario_conta']);
          $stmt->bindValue(5, $rsServidorAtualizacaoBancario['bancario_op']);
          $stmt->bindValue(6, $status);
          $stmt->bindValue(7, $servId);
          $stmt->bindValue(8, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_instrucao  
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoInstrucoess = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoInstrucoess)) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_instrucao 
          SET
          sacad_servidor_instrucao_id_old = NULL, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ?  
          WHERE sacad_servidor_atualizacao_id = ? ;');
        $stmt->bindValue(1, $_SESSION['zatu_id']);
        $stmt->bindValue(2, $servAtualiId);
        $stmt->execute();
        $stmt = $db->prepare("
          DELETE  
          FROM rh_servidor_instrucao  
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        foreach ($rsServidorAtualizacaoInstrucoess as $kObj => $vObj) {
          $stmt = $db->prepare('INSERT INTO rh_servidor_instrucao 
            (bsc_escolaridade_id, 
              formacao, 
              conclusao_ano, 
              cursando, 
              status, 
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $vObj['bsc_escolaridade_id']);
          $stmt->bindValue(2, $vObj['formacao']);
          $stmt->bindValue(3, $vObj['conclusao_ano']);
          $stmt->bindValue(4, $vObj['cursando']);
          $stmt->bindValue(5, $status);
          $stmt->bindValue(6, $servId);
          $stmt->bindValue(7, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_dependente  
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoDependentes)) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_dependente 
          SET
          sacad_servidor_dependente_id_old = NULL, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ?  
          WHERE sacad_servidor_atualizacao_id = ? ;');
        $stmt->bindValue(1, $_SESSION['zatu_id']);
        $stmt->bindValue(2, $servAtualiId);
        $stmt->execute();
        $stmt = $db->prepare("
          DELETE  
          FROM rh_servidor_dependente  
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        foreach ($rsServidorAtualizacaoDependentes as $kObj => $vObj) {
          $stmt = $db->prepare('INSERT INTO rh_servidor_dependente 
            (codigo, 
              nome, 
              cpf, 
              bsc_parentesco_grau_id, 
              parentesco_grau_outro, 
              dt_nascimento, 
              dt_casamento, 
              benef_autos_numero, 
              benef_rg_numero, 
              benef_rg_dt_emissao, 
              benef_rg_orgao_expedidor, 
              benef_tel_residencial, 
              benef_tel_celular, 
              benef_end_cep, 
              benef_end_logradouro, 
              benef_end_numero, 
              benef_end_complemento, 
              benef_end_bairro, 
              benef_bsc_municipio_id, 
              benef_bsc_banco_conta_tipo_id, 
              benef_bsc_banco_id, 
              benef_bancario_agencia, 
              benef_bancario_conta, 
              benef_bancario_op, 
              benef_repres_nome, 
              benef_repres_cpf, 
              benef_repres_rg_numero, 
              benef_repres_rg_dt_emissao, 
              benef_repres_rg_orgao_expedidor, 
              benef_repres_end_cep, 
              benef_repres_end_logradouro, 
              benef_repres_end_numero, 
              benef_repres_end_complemento, 
              benef_repres_end_bairro, 
              benef_repres_bsc_municipio_id, 
              benef_repres_tel_residencial, 
              benef_repres_tel_celular, 
              status, 
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $vObj['codigo']);
          $stmt->bindValue(2, $vObj['nome']);
          $stmt->bindValue(3, $vObj['cpf']);
          $stmt->bindValue(4, $vObj['bsc_parentesco_grau_id']);
          $stmt->bindValue(5, $vObj['parentesco_grau_outro']);
          $stmt->bindValue(6, $vObj['dt_nascimento']);
          $stmt->bindValue(7, $vObj['dt_casamento']);
          $stmt->bindValue(8, $vObj['benef_autos_numero']);
          $stmt->bindValue(9, $vObj['benef_rg_numero']);
          $stmt->bindValue(10, $vObj['benef_rg_dt_emissao']);
          $stmt->bindValue(11, $vObj['benef_rg_orgao_expedidor']);
          $stmt->bindValue(12, $vObj['benef_tel_residencial']);
          $stmt->bindValue(13, $vObj['benef_tel_celular']);
          $stmt->bindValue(14, $vObj['benef_end_cep']);
          $stmt->bindValue(15, $vObj['benef_end_logradouro']);
          $stmt->bindValue(16, $vObj['benef_end_numero']);
          $stmt->bindValue(17, $vObj['benef_end_complemento']);
          $stmt->bindValue(18, $vObj['benef_end_bairro']);
          $stmt->bindValue(19, $vObj['benef_bsc_municipio_id']);
          $stmt->bindValue(20, $vObj['benef_bsc_banco_conta_tipo_id']);
          $stmt->bindValue(21, $vObj['benef_bsc_banco_id']);
          $stmt->bindValue(22, $vObj['benef_bancario_agencia']);
          $stmt->bindValue(23, $vObj['benef_bancario_conta']);
          $stmt->bindValue(24, $vObj['benef_bancario_op']);
          $stmt->bindValue(25, $vObj['benef_repres_nome']);
          $stmt->bindValue(26, $vObj['benef_repres_cpf']);
          $stmt->bindValue(27, $vObj['benef_repres_rg_numero']);
          $stmt->bindValue(28, $vObj['benef_repres_rg_dt_emissao']);
          $stmt->bindValue(29, $vObj['benef_repres_rg_orgao_expedidor']);
          $stmt->bindValue(30, $vObj['benef_repres_end_cep']);
          $stmt->bindValue(31, $vObj['benef_repres_end_logradouro']);
          $stmt->bindValue(32, $vObj['benef_repres_end_numero']);
          $stmt->bindValue(33, $vObj['benef_repres_end_complemento']);
          $stmt->bindValue(34, $vObj['benef_repres_end_bairro']);
          $stmt->bindValue(35, $vObj['benef_repres_bsc_municipio_id']);
          $stmt->bindValue(36, $vObj['benef_repres_tel_residencial']);
          $stmt->bindValue(37, $vObj['benef_repres_tel_celular']);
          $stmt->bindValue(38, $status);
          $stmt->bindValue(39, $servId);
          $stmt->bindValue(40, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }

      $stmt = $db->prepare("
        SELECT 
        * 
        FROM sacad_servidor_atualizacao_vinculo  
        WHERE sacad_servidor_atualizacao_id = ?;");
      $stmt->bindValue(1, $servAtualiId);
      $stmt->execute();
      $rsServidorAtualizacaoVinculoss = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (is_array($rsServidorAtualizacaoVinculoss)) {
        $stmt = $db->prepare('
          UPDATE sacad_servidor_atualizacao_vinculo 
          SET
          sacad_servidor_vinculo_id_old = NULL, 
          dt_cadastro = NOW(), 
          seg_usuario_id = ?  
          WHERE sacad_servidor_atualizacao_id = ? ;');
        $stmt->bindValue(1, $_SESSION['zatu_id']);
        $stmt->bindValue(2, $servAtualiId);
        $stmt->execute();
        $stmt = $db->prepare("
          DELETE  
          FROM rh_servidor_vinculo  
          WHERE rh_servidor_id = ?;");
        $stmt->bindValue(1, $servId);
        $stmt->execute();
        foreach ($rsServidorAtualizacaoVinculoss as $kObj => $vObj) {
          $stmt = $db->prepare('INSERT INTO rh_servidor_vinculo 
            (local, 
              esfera, 
              cargo, 
              carga_horaria, 
              status, 
              rh_servidor_id, 
              dt_cadastro, 
              seg_usuario_id) 
            VALUES
            (?, ?, ?, ?, ?, ?, NOW(), ?)');
          $stmt->bindValue(1, $vObj['local']);
          $stmt->bindValue(2, $vObj['esfera']);
          $stmt->bindValue(3, $vObj['cargo']);
          $stmt->bindValue(4, $vObj['carga_horaria']);
          $stmt->bindValue(5, $status);
          $stmt->bindValue(6, $servId);
          $stmt->bindValue(7, $_SESSION['zatu_id']);
          $stmt->execute();
        }
      }
      $stmt = $db->prepare('
        INSERT sacad_servidor_atualizacao_situacao 
        (status, 
          dt_cadastro, 
          seg_usuario_id, 
          sacad_servidor_atualizacao_id, 
          sacad_situacao_servidor_atualizacao_id) 
        VALUES (?, NOW(), ?, ?, ? );');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $servAtualiId);
      $stmt->bindValue(4, 9);
      $stmt->execute();
      $stmt = $db->prepare('
        INSERT sacad_servidor_atualizacao_situacao 
        (status, 
          dt_cadastro, 
          seg_usuario_id, 
          sacad_servidor_atualizacao_id, 
          sacad_situacao_servidor_atualizacao_id) 
        VALUES (?, NOW(), ?, ?, ? );');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $servAtualiId);
      $stmt->bindValue(4, 10);
      $stmt->execute();
    } else if ($conferenciaSituacao == 0) {
      $stmt = $db->prepare('
        INSERT sacad_servidor_atualizacao_situacao 
        (status, 
          dt_cadastro, 
          seg_usuario_id, 
          sacad_servidor_atualizacao_id, 
          sacad_situacao_servidor_atualizacao_id) 
        VALUES (?, NOW(), ?, ?, ? );');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $servAtualiId);
      $stmt->bindValue(4, 7);
      $stmt->execute();
      $stmt = $db->prepare('
        INSERT sacad_servidor_atualizacao_situacao 
        (status, 
          dt_cadastro, 
          seg_usuario_id, 
          sacad_servidor_atualizacao_id, 
          sacad_situacao_servidor_atualizacao_id) 
        VALUES (?, NOW(), ?, ?, ? );');
      $stmt->bindValue(1, 1);
      $stmt->bindValue(2, $_SESSION['zatu_id']);
      $stmt->bindValue(3, $servAtualiId);
      $stmt->bindValue(4, 8);
      $stmt->execute();
    }

    $db->commit();
      //MENSAGEM DE SUCESSO
    $msg['msg'] = $conferenciaSituacao == 1 ? 'success' : ($conferenciaSituacao == 2 ? 'continuous' : 'recall');
    $msg['retorno'] = 'Dados, da conferência, salvos com sucesso.';
    echo json_encode($msg);
    exit();
  } else {

    $db->rollback();
      //MENSAGEM DE SUCESSO
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrato registro do servidor.';
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