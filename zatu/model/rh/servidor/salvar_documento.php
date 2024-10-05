<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['servidor_documento_id_s']);
$servidorId           = strip_tags(@$_POST['id']);
$rgNumero             = strip_tags(@$_POST['rg_numero_s']);
$rgDtEmissao          = strip_tags(@$_POST['rg_dt_emissao_s']);
$rgOrgExpedidor       = strip_tags(@$_POST['rg_orgao_expedidor_s']);
$pisNumero            = strip_tags(@$_POST['pis_numero_s']);
$pisDtCadastro        = strip_tags(@$_POST['pis_dt_cadastro_s']);
$pisDomiBancario      = strip_tags(@$_POST['pis_dom_bancario_s']);
$pisBancoNumero       = strip_tags(@$_POST['pis_banco_numero_s']);
$pisAgencia           = strip_tags(@$_POST['pis_agencia_s']);
$pisAgenciaEnd        = strip_tags(@$_POST['pis_agencia_end_s']);
$eleitorNumero        = strip_tags(@$_POST['eleitor_numero_s']);
$eleitorZona          = strip_tags(@$_POST['eleitor_zona_s']);
$eleitorSecao         = strip_tags(@$_POST['eleitor_secao_s']);
$eleitorMunicipioId   = strip_tags(@$_POST['eleitor_cidade_s']);
$eleitorInscOrgClasse = strip_tags(@$_POST['eleitor_insc_orgao_classe_s']);
$ctpsNumero           = strip_tags(@$_POST['ctps_numero_s']);
$ctpsSerie            = strip_tags(@$_POST['ctps_seire_s']);
$ctpsDtEmissao        = strip_tags(@$_POST['ctps_dt_emissao_s']);
$ctpsOrgExpedidor     = strip_tags(@$_POST['ctps_orgao_expedidor_s']);
$ctpsPrimerEmpAno     = strip_tags(@$_POST['ctps_primeiro_emprego_ano_s']);
$cnhNumero            = strip_tags(@$_POST['cnh_numero_s']);
$cnhCategoria         = strip_tags(@$_POST['cnh_categoria_s']);
$cnhDtEmissao         = strip_tags(@$_POST['cnh_dt_emissao_s']);
$cnhOrgExpedidor      = strip_tags(@$_POST['cnh_orgao_expedidor_s']);
$cnhDtValidade        = strip_tags(@$_POST['cnh_dt_validade_s']);
$cnhDtPrimerHabilit   = strip_tags(@$_POST['cnh_primeira_habilitacao_s']);
$regMilNumero         = strip_tags(@$_POST['reg_militar_numero_s']);
$regMilCategoria      = strip_tags(@$_POST['reg_militar_categoria_s']);
$regMilEmissaoAno     = strip_tags(@$_POST['reg_militar_emissao_ano_s']);
$regMilOrgExpedidor   = strip_tags(@$_POST['reg_militar_orgao_expedidor_s']);
$regMilEspecie        = strip_tags(@$_POST['reg_militar_especie_s']);
$regProfNumero        = strip_tags(@$_POST['reg_profissional_numero_s']);
$regProfDtEmissao     = strip_tags(@$_POST['reg_prof_dt_emissao_s']);
$regProfOrgExpedidor  = strip_tags(@$_POST['reg_prof_orgao_expedidor_s']);
$regProfDtValidade    = strip_tags(@$_POST['reg_prof_dt_validade_s']);
$rneNumero            = strip_tags(@$_POST['rne_numero_s']);
$rneDtEmissao         = strip_tags(@$_POST['rne_dt_emissao_s']);
$rneOrgExpedidor      = strip_tags(@$_POST['rne_orgao_expedidor_s']);
// $fgtsNumero           = strip_tags(@$_POST['fgts_numero_s']);
// $fgtsOpcao            = strip_tags(@$_POST['fgts_opcao_s']);
// $fgtsContVincBanc     = strip_tags(@$_POST['fgts_conta_vinculada_banco_s']);
// $fgtsDtRetificacao    = strip_tags(@$_POST['fgts_dt_retificacao_s']);
$fgtsNumero           = NULL;
$fgtsOpcao            = NULL;
$fgtsContVincBanc     = NULL;
$fgtsDtRetificacao    = NULL;
$estCasadoBrasileiro  = strip_tags(@$_POST['estrang_casado_brasileiro_s']);
$estFilhoBrasileiro   = strip_tags(@$_POST['estrang_filho_brasileiro_s']);
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
        UPDATE rh_servidor_documento 
        SET
        rh_servidor_id = ?, 
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
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $rgNumero);
      $stmt->bindValue(3, formata_data($rgDtEmissao));
      $stmt->bindValue(4, $rgOrgExpedidor);
      $stmt->bindValue(5, $pisNumero);
      $stmt->bindValue(6, formata_data($pisDtCadastro));
      $stmt->bindValue(7, $pisDomiBancario);
      $stmt->bindValue(8, $pisBancoNumero);
      $stmt->bindValue(9, $pisAgencia);
      $stmt->bindValue(10, $pisAgenciaEnd);
      $stmt->bindValue(11, $eleitorNumero);
      $stmt->bindValue(12, $eleitorZona);
      $stmt->bindValue(13, $eleitorSecao);
      $stmt->bindValue(14, $eleitorMunicipioId != '' ? $eleitorMunicipioId : NULL);
      $stmt->bindValue(15, $eleitorInscOrgClasse);
      $stmt->bindValue(16, $ctpsNumero);
      $stmt->bindValue(17, $ctpsSerie);
      $stmt->bindValue(18, formata_data($ctpsDtEmissao));
      $stmt->bindValue(19, $ctpsOrgExpedidor);
      $stmt->bindValue(20, $ctpsPrimerEmpAno);
      $stmt->bindValue(21, $cnhNumero);
      $stmt->bindValue(22, $cnhCategoria);
      $stmt->bindValue(23, formata_data($cnhDtEmissao));
      $stmt->bindValue(24, $cnhOrgExpedidor);
      $stmt->bindValue(25, formata_data($cnhDtValidade));
      $stmt->bindValue(26, formata_data($cnhDtPrimerHabilit));
      $stmt->bindValue(27, $regMilNumero);
      $stmt->bindValue(28, $regMilCategoria);
      $stmt->bindValue(29, $regMilEmissaoAno);
      $stmt->bindValue(30, $regMilOrgExpedidor);
      $stmt->bindValue(31, $regMilEspecie);
      $stmt->bindValue(32, $regProfNumero);
      $stmt->bindValue(33, formata_data($regProfDtEmissao));
      $stmt->bindValue(34, $regProfOrgExpedidor);
      $stmt->bindValue(35, formata_data($regProfDtValidade));
      $stmt->bindValue(36, $rneNumero);
      $stmt->bindValue(37, formata_data($rneDtEmissao));
      $stmt->bindValue(38, $rneOrgExpedidor);
      $stmt->bindValue(39, $fgtsNumero);
      $stmt->bindValue(40, $fgtsOpcao);
      $stmt->bindValue(41, $fgtsContVincBanc);
      $stmt->bindValue(42, $fgtsDtRetificacao);
      // $stmt->bindValue(42, formata_data($fgtsDtRetificacao));
      $stmt->bindValue(43, $estCasadoBrasileiro);
      $stmt->bindValue(44, $estFilhoBrasileiro);
      $stmt->bindValue(45, $status);
      $stmt->bindValue(46, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->bindValue(47, $id);
      $stmt->execute();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $id;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de documento do servidor atualizados com sucesso.';
      echo json_encode($msg);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO rh_servidor_documento 
        (rh_servidor_id, 
        rg_numero, 
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
        dt_cadastro, 
        seg_usuario_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
      $stmt->bindValue(1, $servidorId);
      $stmt->bindValue(2, $rgNumero);
      $stmt->bindValue(3, formata_data($rgDtEmissao));
      $stmt->bindValue(4, $rgOrgExpedidor);
      $stmt->bindValue(5, $pisNumero);
      $stmt->bindValue(6, formata_data($pisDtCadastro));
      $stmt->bindValue(7, $pisDomiBancario);
      $stmt->bindValue(8, $pisBancoNumero);
      $stmt->bindValue(9, $pisAgencia);
      $stmt->bindValue(10, $pisAgenciaEnd);
      $stmt->bindValue(11, $eleitorNumero);
      $stmt->bindValue(12, $eleitorZona);
      $stmt->bindValue(13, $eleitorSecao);
      $stmt->bindValue(14, $eleitorMunicipioId != '' ? $eleitorMunicipioId : NULL);
      $stmt->bindValue(15, $eleitorInscOrgClasse);
      $stmt->bindValue(16, $ctpsNumero);
      $stmt->bindValue(17, $ctpsSerie);
      $stmt->bindValue(18, formata_data($ctpsDtEmissao));
      $stmt->bindValue(19, $ctpsOrgExpedidor);
      $stmt->bindValue(20, $ctpsPrimerEmpAno);
      $stmt->bindValue(21, $cnhNumero);
      $stmt->bindValue(22, $cnhCategoria);
      $stmt->bindValue(23, formata_data($cnhDtEmissao));
      $stmt->bindValue(24, $cnhOrgExpedidor);
      $stmt->bindValue(25, formata_data($cnhDtValidade));
      $stmt->bindValue(26, formata_data($cnhDtPrimerHabilit));
      $stmt->bindValue(27, $regMilNumero);
      $stmt->bindValue(28, $regMilCategoria);
      $stmt->bindValue(29, $regMilEmissaoAno);
      $stmt->bindValue(30, $regMilOrgExpedidor);
      $stmt->bindValue(31, $regMilEspecie);
      $stmt->bindValue(32, $regProfNumero);
      $stmt->bindValue(33, formata_data($regProfDtEmissao));
      $stmt->bindValue(34, $regProfOrgExpedidor);
      $stmt->bindValue(35, formata_data($regProfDtValidade));
      $stmt->bindValue(36, $rneNumero);
      $stmt->bindValue(37, formata_data($rneDtEmissao));
      $stmt->bindValue(38, $rneOrgExpedidor);
      $stmt->bindValue(39, $fgtsNumero);
      $stmt->bindValue(40, $fgtsOpcao);
      $stmt->bindValue(41, $fgtsContVincBanc);
      $stmt->bindValue(42, $fgtsDtRetificacao);
      // $stmt->bindValue(42, formata_data($fgtsDtRetificacao));
      $stmt->bindValue(43, $estCasadoBrasileiro);
      $stmt->bindValue(44, $estFilhoBrasileiro);
      $stmt->bindValue(45, $status);
      $stmt->bindValue(46, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
      $stmt->execute();
      $documentoIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['id'] = $documentoIdNew;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de documento do servidor cadastrados com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de documento!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar salvar os dados de documento do Servidor: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>