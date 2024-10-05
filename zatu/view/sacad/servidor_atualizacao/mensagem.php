<?php 
if (!(isset($_POST['id']))){
  echo '<script>window.location.href = "menu";</script>';
}
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  s.id, 
  s.nome, 
  s.nome_social, 
  s.cpf, 
  s.dt_nascimento, 
  s.sexo, 
  s.natural_bsc_pais_id, 
  p.nacionalidade AS nacionalidade_nome, 
  s.natural_bsc_municipio_id, 
  m.nome AS natural_municipio_nome, 
  e.sigla AS natural_estado_sigla, 
  s.natural_estrangeiro_dt_ingresso, 
  s.natural_estrangeiro_cidade, 
  s.natural_estrangeiro_estado, 
  s.natural_estrangeiro_condicao_trabalho, 
  s.pai_nome, 
  s.pai_natural_bsc_pais_id, 
  pp.nacionalidade AS pai_nacionalidade_nome, 
  s.pai_profissao, 
  s.mae_nome, 
  s.mae_natural_bsc_pais_id, 
  ppp.nacionalidade AS mae_nacionalidade_nome, 
  s.mae_profissao, 
  s.matricula, 
  s.rh_servidor_tipo_id, 
  stipo.nome AS serv_tipo_nome, 
  s.eo_cargo_id, 
  c.nome AS cargo_nome, 
  s.eo_empregador_id, 
  emp.nome_razao_social AS empregador_razao_social, 
  emp.nome_fantasia AS empregador_fantasia, 
  s.eo_setor_unidade_organizacional_id, 
  suo.bsc_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  suo.eo_setor_id, 
  st.nome AS setor_nome, 
  s.rh_situacao_trabalho_id, 
  sitt.nome AS sit_trab_nome, 
  s.situacao_trabalho_decreto, 
  s.situacao_trabalho_doe, 
  s.situacao_trabalho_dt_inicio, 
  s.situacao_trabalho_dt_fim, 
  s.situacao_trabalho_obs, 
  s.matricula_2, 
  s.rh_servidor_tipo_id_2, 
  stipo2.nome AS serv_tipo_nome_2, 
  s.eo_cargo_id_2, 
  c2.nome AS cargo_nome_2, 
  s.eo_empregador_id_2, 
  emp2.nome_razao_social AS empregador_razao_social_2, 
  emp2.nome_fantasia AS empregador_fantasia_2, 
  s.eo_setor_unidade_organizacional_id_2, 
  suo2.bsc_unidade_organizacional_id AS bsc_unidade_organizacional_id_2, 
  suo2.eo_setor_id AS eo_setor_id_2, 
  suo2.bsc_unidade_organizacional_id AS bsc_unidade_organizacional_id_2, 
  uo2.nome AS uo_nome_2, 
  suo2.eo_setor_id AS eo_setor_id_2, 
  st2.nome AS setor_nome_2, 
  s.rh_situacao_trabalho_id_2, 
  sitt2.nome AS sit_trab_nome_2, 
  s.situacao_trabalho_decreto_2, 
  s.situacao_trabalho_doe_2, 
  s.situacao_trabalho_dt_inicio_2, 
  s.situacao_trabalho_dt_fim_2, 
  s.situacao_trabalho_obs_2, 
  s.foto, 
  s.sangue_tipo, 
  s.raca, 
  s.covid_vacina_nome, 
  s.covid_vacina_dose, 
  s.covid_vacina_lote, 
  s.covid_vacina_data, 
  s.covid_vacina_endereco, 
  s.enfermidade_portador, 
  s.enfermidade_codigo_internacional, 
  e.id AS estado_id 
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN rh_servidor AS s ON s.id = sa.rh_servidor_id 
  LEFT JOIN bsc_municipio AS m ON m.id = s.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_pais AS p ON p.id = s.natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS pp ON pp.id = s.pai_natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS ppp ON ppp.id = s.mae_natural_bsc_pais_id 
  LEFT JOIN eo_empregador AS emp ON emp.id = s.eo_empregador_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt ON sitt.id = s.rh_situacao_trabalho_id 
  LEFT JOIN eo_empregador AS emp2 ON emp2.id = s.eo_empregador_id_2 
  LEFT JOIN eo_setor_unidade_organizacional AS suo2 ON suo2.id = s.eo_setor_unidade_organizacional_id_2 
  LEFT JOIN bsc_unidade_organizacional AS uo2 ON uo2.id = suo2.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st2 ON st2.id = suo2.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt2 ON sitt2.id = s.rh_situacao_trabalho_id_2 
  LEFT JOIN rh_servidor_tipo AS stipo ON stipo.id = s.rh_servidor_tipo_id 
  LEFT JOIN rh_servidor_tipo AS stipo2 ON stipo2.id = s.rh_servidor_tipo_id_2 
  LEFT JOIN eo_cargo AS c ON c.id = s.eo_cargo_id 
  LEFT JOiN eo_cargo AS c2 ON c2.id = s.eo_cargo_id_2 
  WHERE sa.id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidor = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  s.id, 
  s.nome, 
  s.nome_social, 
  s.cpf, 
  s.dt_nascimento, 
  s.sexo, 
  s.natural_bsc_pais_id, 
  p.nacionalidade AS nacionalidade_nome, 
  s.natural_bsc_municipio_id, 
  m.nome AS natural_municipio_nome, 
  e.sigla AS natural_estado_sigla, 
  s.natural_estrangeiro_dt_ingresso, 
  s.natural_estrangeiro_cidade, 
  s.natural_estrangeiro_estado, 
  s.natural_estrangeiro_condicao_trabalho, 
  s.pai_nome, 
  s.pai_natural_bsc_pais_id, 
  pp.nacionalidade AS pai_nacionalidade_nome, 
  s.pai_profissao, 
  s.mae_nome, 
  s.mae_natural_bsc_pais_id, 
  ppp.nacionalidade AS mae_nacionalidade_nome, 
  s.mae_profissao, 
  s.matricula, 
  s.atestacao_matricula, 
  s.rh_servidor_tipo_id, 
  stipo.nome AS serv_tipo_nome, 
  s.eo_cargo_id, 
  c.nome AS cargo_nome, 
  s.eo_empregador_id, 
  emp.nome_razao_social AS empregador_razao_social, 
  emp.nome_fantasia AS empregador_fantasia, 
  s.eo_setor_unidade_organizacional_id, 
  suo.bsc_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  suo.eo_setor_id, 
  st.nome AS setor_nome, 
  s.rh_situacao_trabalho_id, 
  sitt.nome AS sit_trab_nome, 
  s.situacao_trabalho_decreto, 
  s.situacao_trabalho_doe, 
  s.situacao_trabalho_dt_inicio, 
  s.situacao_trabalho_dt_fim, 
  s.situacao_trabalho_obs, 
  s.matricula_2, 
  s.atestacao_matricula_2, 
  s.rh_servidor_tipo_id_2, 
  stipo2.nome AS serv_tipo_nome_2, 
  s.eo_cargo_id_2, 
  c2.nome AS cargo_nome_2, 
  s.eo_empregador_id_2, 
  emp2.nome_razao_social AS empregador_razao_social_2, 
  emp2.nome_fantasia AS empregador_fantasia_2, 
  s.eo_setor_unidade_organizacional_id_2, 
  suo2.bsc_unidade_organizacional_id AS bsc_unidade_organizacional_id_2, 
  suo2.eo_setor_id AS eo_setor_id_2, 
  suo2.bsc_unidade_organizacional_id AS bsc_unidade_organizacional_id_2, 
  uo2.nome AS uo_nome_2, 
  suo2.eo_setor_id AS eo_setor_id_2, 
  st2.nome AS setor_nome_2, 
  s.rh_situacao_trabalho_id_2, 
  sitt2.nome AS sit_trab_nome_2, 
  s.situacao_trabalho_decreto_2, 
  s.situacao_trabalho_doe_2, 
  s.situacao_trabalho_dt_inicio_2, 
  s.situacao_trabalho_dt_fim_2, 
  s.situacao_trabalho_obs_2, 
  s.foto, 
  s.sangue_tipo, 
  s.raca, 
  s.covid_vacina_nome, 
  s.covid_vacina_dose, 
  s.covid_vacina_lote, 
  s.covid_vacina_data, 
  s.covid_vacina_endereco, 
  s.enfermidade_portador, 
  s.enfermidade_codigo_internacional, 
  e.id AS estado_id, 
  s.rh_servidor_id, 
  s.tipo_atualizacao, 
  s.autenticacao 
  FROM sacad_servidor_atualizacao AS s 
  LEFT JOIN bsc_municipio AS m ON m.id = s.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_pais AS p ON p.id = s.natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS pp ON pp.id = s.pai_natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS ppp ON ppp.id = s.mae_natural_bsc_pais_id 
  LEFT JOIN eo_empregador AS emp ON emp.id = s.eo_empregador_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt ON sitt.id = s.rh_situacao_trabalho_id 
  LEFT JOIN eo_empregador AS emp2 ON emp2.id = s.eo_empregador_id_2 
  LEFT JOIN eo_setor_unidade_organizacional AS suo2 ON suo2.id = s.eo_setor_unidade_organizacional_id_2 
  LEFT JOIN bsc_unidade_organizacional AS uo2 ON uo2.id = suo2.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st2 ON st2.id = suo2.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt2 ON sitt2.id = s.rh_situacao_trabalho_id_2 
  LEFT JOIN rh_servidor_tipo AS stipo ON stipo.id = s.rh_servidor_tipo_id 
  LEFT JOIN rh_servidor_tipo AS stipo2 ON stipo2.id = s.rh_servidor_tipo_id_2 
  LEFT JOIN eo_cargo AS c ON c.id = s.eo_cargo_id 
  LEFT JOiN eo_cargo AS c2 ON c2.id = s.eo_cargo_id_2 
  WHERE 
  s.rh_servidor_id = ? AND 
  s.dt_cadastro IN ( 
    SELECT 
    MAX(sa.dt_cadastro) dt_cadastro
    FROM sacad_servidor_atualizacao AS sa 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
    LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
    WHERE 
    sa.rh_servidor_id = ? 
    )
  ;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->bindValue(2, $rsServidor['id']);
$stmt->execute();
$rsServidorAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sas.id, 
  sas.obs, 
  ssa.nome AS situacao_atualizacao_nome, 
  ssa.etapa AS situacao_etapa, 
  sas.status, 
  sas.dt_cadastro, 
  sas.seg_usuario_id, 
  u.nome AS usuario_nome, 
  sas.sacad_servidor_atualizacao_id, 
  sas.sacad_situacao_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_situacao AS sas 
  LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
  LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
  WHERE sas.sacad_servidor_atualizacao_id = ? 
  ORDER BY sas.id ASC;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorSituacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacao)) {
  $rsServidorAtualizacao = $rsServidor;
  $rsServidorAtualizacao['id'] = 0;
  $rsServidorAtualizacao['situacaoServidorUltima']['id'] = 1;
  $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] = 'Aguardando preenchimento total';
} else {
  $rsServidorAtualizacao['situacoes'] = $rsServidorSituacao;
  $rsServidorAtualizacao['situacaoServidorPrimeiro'] = $rsServidorSituacao[0];
  $rsServidorAtualizacao['situacaoServidorUltima'] = end($rsServidorSituacao);
}
if ($rsServidorAtualizacao['id'] != 0){
  $enableAllSteps = true;
}
$stmt = $db->prepare("
  SELECT 
  sas.id, 
  sas.obs, 
  sas.seg_usuario_id, 
  u.nome AS usuario_nome, 
  sas.sacad_servidor_atualizacao_id, 
  sas.sacad_situacao_servidor_atualizacao_id,
  sa.atestacao_matricula, 
  sa.eo_setor_unidade_organizacional_id 
  FROM sacad_servidor_atualizacao_situacao AS sas 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.id = sas.sacad_servidor_atualizacao_id 
  LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
  LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
  LEFT JOIN rh_atestador AS a ON a.seg_usuario_id_atestador = u.id
  WHERE 
  sas.sacad_servidor_atualizacao_id = ? 
  AND sacad_situacao_servidor_atualizacao_id = 3 
  AND sa.atestacao_matricula = 2
  AND sas.matricula = 1
  ORDER BY sas.id DESC 
  LIMIT 1;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtestacaoMatricula = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sas.id, 
  sas.obs, 
  sas.seg_usuario_id, 
  u.nome AS usuario_nome, 
  sas.sacad_servidor_atualizacao_id, 
  sas.sacad_situacao_servidor_atualizacao_id,
  sa.atestacao_matricula_2, 
  sa.eo_setor_unidade_organizacional_id_2 
  FROM sacad_servidor_atualizacao_situacao AS sas 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.id = sas.sacad_servidor_atualizacao_id 
  LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
  LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
  LEFT JOIN rh_atestador AS a ON a.seg_usuario_id_atestador = u.id
  WHERE 
  sas.sacad_servidor_atualizacao_id = ? 
  AND sacad_situacao_servidor_atualizacao_id = 3 
  AND sa.atestacao_matricula_2 = 2
  AND sas.matricula_2 = 1
  ORDER BY sas.id DESC 
  LIMIT 1;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtestacaoMatricula2 = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sc.id, 
  sc.rh_servidor_id, 
  sc.end_cep, 
  sc.end_logradouro, 
  sc.end_numero, 
  sc.end_complemento, 
  sc.end_bairro, 
  e.id AS end_estado_id, 
  sc.end_bsc_municipio_id, 
  m.nome AS end_municipio_nome, 
  e.nome AS end_estado_nome, 
  e.sigla AS end_estado_sigla, 
  sc.tel_residencial, 
  sc.tel_celular, 
  sc.tel_recado, 
  sc.tel_recado_nome, 
  sc.tel_recado_bsc_parentesco_grau_id, 
  pg.nome AS tel_recado_parentesco_grau_nome, 
  sc.email_institucional, 
  sc.email_pessoal, 
  sc.email_alternativo, 
  sc.contato_emergencia_nome, 
  sc.contato_emergencia_end, 
  sc.contato_emergencia_tel 
  FROM rh_servidor_contato AS sc 
  LEFT JOIN bsc_municipio AS m ON m.id = sc.end_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sc.tel_recado_bsc_parentesco_grau_id 
  WHERE sc.rh_servidor_id = ?;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorContato = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorContato)) {
  $rsServidorContato['id'] = 0;
  $rsServidorContato['rh_servidor_id'] = '';
  $rsServidorContato['end_cep'] = '';
  $rsServidorContato['end_logradouro'] = '';
  $rsServidorContato['end_numero'] = '';
  $rsServidorContato['end_complemento'] = '';
  $rsServidorContato['end_bairro'] = '';
  $rsServidorContato['end_estado_id'] = '';
  $rsServidorContato['end_bsc_municipio_id'] = '';
  $rsServidorContato['end_municipio_nome'] = '';
  $rsServidorContato['end_estado_nome'] = '';
  $rsServidorContato['end_estado_sigla'] = '';
  $rsServidorContato['tel_residencial'] = '';
  $rsServidorContato['tel_celular'] = '';
  $rsServidorContato['tel_recado'] = '';
  $rsServidorContato['tel_recado_nome'] = '';
  $rsServidorContato['tel_recado_bsc_parentesco_grau_id'] = '';
  $rsServidorContato['tel_recado_parentesco_grau_nome'] = '';
  $rsServidorContato['email_institucional'] = '';
  $rsServidorContato['email_pessoal'] = '';
  $rsServidorContato['email_alternativo'] = '';
  $rsServidorContato['contato_emergencia_nome'] = '';
  $rsServidorContato['contato_emergencia_end'] = '';
  $rsServidorContato['contato_emergencia_tel'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sc.id, 
  sc.end_cep, 
  sc.end_logradouro, 
  sc.end_numero, 
  sc.end_complemento, 
  sc.end_bairro, 
  e.id AS end_estado_id, 
  sc.end_bsc_municipio_id, 
  m.nome AS end_municipio_nome, 
  e.nome AS end_estado_nome, 
  e.sigla AS end_estado_sigla, 
  sc.tel_residencial, 
  sc.tel_celular, 
  sc.tel_recado, 
  sc.tel_recado_nome, 
  sc.tel_recado_bsc_parentesco_grau_id, 
  pg.nome AS tel_recado_parentesco_grau_nome, 
  sc.email_institucional, 
  sc.email_pessoal, 
  sc.email_alternativo, 
  sc.contato_emergencia_nome, 
  sc.contato_emergencia_end, 
  sc.contato_emergencia_tel, 
  sc.sacad_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_contato AS sc 
  LEFT JOIN bsc_municipio AS m ON m.id = sc.end_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sc.tel_recado_bsc_parentesco_grau_id 
  WHERE sc.sacad_servidor_atualizacao_id = ?;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoContato = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacaoContato)) {
  $rsServidorAtualizacaoContato = $rsServidorContato;
  $rsServidorAtualizacaoContato['id'] = 0;
  $rsServidorAtualizacaoContato['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
}
$stmt = $db->prepare("
  SELECT 
  sd.id, 
  sd.rh_servidor_id, 
  sd.rg_numero, 
  sd.rg_dt_emissao, 
  sd.rg_orgao_expedidor, 
  sd.pis_numero, 
  sd.pis_dt_cadastro, 
  sd.pis_domicilio_bancario, 
  sd.pis_banco_numero, 
  sd.pis_agencia, 
  sd.pis_agencia_end, 
  sd.eleitor_numero, 
  sd.eleitor_zona, 
  sd.eleitor_secao, 
  m.nome AS eleitor_municipio_nome, 
  e.nome AS eleitor_estado_nome, 
  e.sigla AS eleitor_estado_sigla, 
  sd.eleitor_bsc_municipio_id, 
  sd.eleitor_insc_orgao_classe, 
  sd.ctps_numero, 
  sd.ctps_serie, 
  sd.ctps_dt_emissao, 
  sd.ctps_orgao_expedidor, 
  sd.ctps_primeiro_emprego_ano, 
  sd.cnh_numero, 
  sd.cnh_categoria, 
  sd.cnh_dt_emissao, 
  sd.cnh_orgao_expedidor, 
  sd.cnh_dt_validade, 
  sd.cnh_dt_primeira_habilitacao, 
  sd.reg_militar_numero, 
  sd.reg_militar_categoria, 
  sd.reg_militar_emissao_ano, 
  sd.reg_militar_orgao_expedidor, 
  sd.reg_militar_especie, 
  sd.reg_prof_numero, 
  sd.reg_prof_dt_emissao, 
  sd.reg_prof_orgao_expedidor, 
  sd.reg_prof_dt_validade, 
  sd.rne_numero, 
  sd.rne_dt_emissao, 
  sd.rne_orgao_expedidor, 
  -- sd.fgts_numero, 
  -- sd.fgts_opcao, 
  -- sd.fgts_conta_vinculada_banco, 
  -- sd.fgts_dt_retificacao, 
  sd.estrangeiro_casado_brasileiro, 
  sd.estrangeiro_filho_brasileiro 
  FROM rh_servidor_documento AS sd 
  LEFT JOIN bsc_municipio AS m ON m.id = sd.eleitor_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE sd.rh_servidor_id = ?;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorDocumento = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorDocumento)) {
  $rsServidorDocumento['id'] = 0;
  $rsServidorDocumento['rh_servidor_id'] = '';
  $rsServidorDocumento['rg_numero'] = '';
  $rsServidorDocumento['rg_dt_emissao'] = '';
  $rsServidorDocumento['rg_orgao_expedidor'] = '';
  $rsServidorDocumento['pis_numero'] = '';
  $rsServidorDocumento['pis_dt_cadastro'] = '';
  $rsServidorDocumento['pis_domicilio_bancario'] = '';
  $rsServidorDocumento['pis_banco_numero'] = '';
  $rsServidorDocumento['pis_agencia'] = '';
  $rsServidorDocumento['pis_agencia_end'] = '';
  $rsServidorDocumento['eleitor_numero'] = '';
  $rsServidorDocumento['eleitor_zona'] = '';
  $rsServidorDocumento['eleitor_secao'] = '';
  $rsServidorDocumento['eleitor_municipio_nome'] = '';
  $rsServidorDocumento['eleitor_estado_nome'] = '';
  $rsServidorDocumento['eleitor_estado_sigla'] = '';
  $rsServidorDocumento['eleitor_bsc_municipio_id'] = '';
  $rsServidorDocumento['eleitor_insc_orgao_classe'] = '';
  $rsServidorDocumento['ctps_numero'] = '';
  $rsServidorDocumento['ctps_serie'] = '';
  $rsServidorDocumento['ctps_dt_emissao'] = '';
  $rsServidorDocumento['ctps_orgao_expedidor'] = '';
  $rsServidorDocumento['ctps_primeiro_emprego_ano'] = '';
  $rsServidorDocumento['cnh_numero'] = '';
  $rsServidorDocumento['cnh_categoria'] = '';
  $rsServidorDocumento['cnh_dt_emissao'] = '';
  $rsServidorDocumento['cnh_orgao_expedidor'] = '';
  $rsServidorDocumento['cnh_dt_validade'] = '';
  $rsServidorDocumento['cnh_dt_primeira_habilitacao'] = '';
  $rsServidorDocumento['reg_militar_numero'] = '';
  $rsServidorDocumento['reg_militar_categoria'] = '';
  $rsServidorDocumento['reg_militar_emissao_ano'] = '';
  $rsServidorDocumento['reg_militar_orgao_expedidor'] = '';
  $rsServidorDocumento['reg_militar_especie'] = '';
  $rsServidorDocumento['reg_prof_numero'] = '';
  $rsServidorDocumento['reg_prof_dt_emissao'] = '';
  $rsServidorDocumento['reg_prof_orgao_expedidor'] = '';
  $rsServidorDocumento['reg_prof_dt_validade'] = '';
  $rsServidorDocumento['rne_numero'] = '';
  $rsServidorDocumento['rne_dt_emissao'] = '';
  $rsServidorDocumento['rne_orgao_expedidor'] = '';
  // $rsServidorDocumento['fgts_numero'] = '';
  // $rsServidorDocumento['fgts_opcao'] = '';
  // $rsServidorDocumento['fgts_conta_vinculada_banco'] = '';
  // $rsServidorDocumento['fgts_dt_retificacao'] = '';
  $rsServidorDocumento['estrangeiro_casado_brasileiro'] = '';
  $rsServidorDocumento['estrangeiro_filho_brasileiro'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sd.id, 
  sd.rg_numero, 
  sd.rg_dt_emissao, 
  sd.rg_orgao_expedidor, 
  sd.pis_numero, 
  sd.pis_dt_cadastro, 
  sd.pis_domicilio_bancario, 
  sd.pis_banco_numero, 
  sd.pis_agencia, 
  sd.pis_agencia_end, 
  sd.eleitor_numero, 
  sd.eleitor_zona, 
  sd.eleitor_secao, 
  m.nome AS eleitor_municipio_nome, 
  e.nome AS eleitor_estado_nome, 
  e.sigla AS eleitor_estado_sigla, 
  sd.eleitor_bsc_municipio_id, 
  sd.eleitor_insc_orgao_classe, 
  sd.ctps_numero, 
  sd.ctps_serie, 
  sd.ctps_dt_emissao, 
  sd.ctps_orgao_expedidor, 
  sd.ctps_primeiro_emprego_ano, 
  sd.cnh_numero, 
  sd.cnh_categoria, 
  sd.cnh_dt_emissao, 
  sd.cnh_orgao_expedidor, 
  sd.cnh_dt_validade, 
  sd.cnh_dt_primeira_habilitacao, 
  sd.reg_militar_numero, 
  sd.reg_militar_categoria, 
  sd.reg_militar_emissao_ano, 
  sd.reg_militar_orgao_expedidor, 
  sd.reg_militar_especie, 
  sd.reg_prof_numero, 
  sd.reg_prof_dt_emissao, 
  sd.reg_prof_orgao_expedidor, 
  sd.reg_prof_dt_validade, 
  sd.rne_numero, 
  sd.rne_dt_emissao, 
  sd.rne_orgao_expedidor, 
  -- sd.fgts_numero, 
  -- sd.fgts_opcao, 
  -- sd.fgts_conta_vinculada_banco, 
  -- sd.fgts_dt_retificacao, 
  sd.estrangeiro_casado_brasileiro, 
  sd.estrangeiro_filho_brasileiro, 
  sd.sacad_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_documento AS sd 
  LEFT JOIN bsc_municipio AS m ON m.id = sd.eleitor_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE sd.sacad_servidor_atualizacao_id = ?;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoDocumento = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacaoDocumento)) {
  $rsServidorAtualizacaoDocumento = $rsServidorDocumento;
  $rsServidorAtualizacaoDocumento['id'] = 0;
  $rsServidorAtualizacaoDocumento['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
}
$stmt = $db->prepare("
  SELECT 
  si.id, 
  si.rh_servidor_id, 
  si.bsc_escolaridade_id, 
  e.nome AS escolaridade_nome, 
  si.formacao, 
  si.conclusao_ano, 
  si.cursando, 
  si.status 
  FROM rh_servidor_instrucao AS si
  LEFT JOIN bsc_escolaridade AS e ON e.id = si.bsc_escolaridade_id 
  WHERE si.rh_servidor_id = ? 
  ORDER BY si.id ASC;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorInstrucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  si.id, 
  si.bsc_escolaridade_id, 
  e.nome AS escolaridade_nome, 
  si.formacao, 
  si.conclusao_ano, 
  si.cursando, 
  si.status, 
  si.sacad_servidor_atualizacao_id, 
  si.sacad_servidor_instrucao_id_old, 
  si.prova_instrucao, 
  si.situacao_instrucao, 
  si.obs_instrucao 
  FROM sacad_servidor_atualizacao_instrucao AS si
  LEFT JOIN bsc_escolaridade AS e ON e.id = si.bsc_escolaridade_id 
  WHERE si.sacad_servidor_atualizacao_id = ? 
  ORDER BY si.id ASC;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoInstrucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (sizeof($rsServidorInstrucoes) < 1 || sizeof($rsServidorAtualizacaoInstrucoes) > 0) {
  array_push($rsServidorInstrucoes, 
    [
      'id' => 0,
      'rh_servidor_id' => 0,
      'bsc_escolaridade_id' => '',
      'escolaridade_nome' => '',
      'formacao' => '',
      'conclusao_ano' => 0,
      'cursando' => 0,
      'prova_instrucao' => '',
      'situacao_instrucao' => '',
      'obs_instrucao' => '',
      'status' => 1
    ]
  );
}
if (sizeof($rsServidorAtualizacaoInstrucoes) < 1) {
  $rsServidorAtualizacaoInstrucoes = $rsServidorInstrucoes;
  foreach ($rsServidorAtualizacaoInstrucoes as $kObj => $vObj) {
    $rsServidorAtualizacaoInstrucoes[$kObj]['id'] = 0;
    $rsServidorAtualizacaoInstrucoes[$kObj]['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
    $rsServidorAtualizacaoInstrucoes[$kObj]['sacad_servidor_instrucao_id_old'] = $vObj['id'];
  }
}
$stmt = $db->prepare("
  SELECT 
  sf.id, 
  sf.rh_servidor_id, 
  sf.bsc_estado_civil_id, 
  ec.nome AS estado_civil_nome, 
  sf.conjuge_dt_casamento, 
  sf.conjuge_nome, 
  sf.conjuge_cpf, 
  sf.conjuge_dt_nascimento, 
  sf.conjuge_natural_bsc_pais_id, 
  p.nacionalidade AS conjuge_natural_nacionalidade, 
  sf.conjuge_natural_bsc_municipio_id, 
  m.nome AS conjuge_natural_municipio_nome, 
  e.nome AS conjuge_natural_estado_nome, 
  e.sigla AS conjuge_natural_estado_sigla, 
  sf.conjuge_natural_estrangeiro_cidade, 
  sf.conjuge_natural_estrangeiro_estado, 
  sf.conjuge_local_trabalho, 
  sf.reg_civil_numero, 
  sf.reg_civil_livro, 
  sf.reg_civil_folha, 
  sf.reg_civil_cartorio, 
  sf.reg_civil_dt_emissao, 
  sf.reg_civil_bsc_municipio_id, 
  mm.nome AS reg_civil_municipio_nome,
  ee.nome AS reg_civil_estado_nome,  
  ee.sigla AS reg_civil_estado_sigla, 
  sf.averbacao_tipo, 
  sf.averbacao_numero, 
  sf.averbacao_dt_emissao, 
  sf.averbacao_cartorio, 
  sf.averbacao_bsc_municipio_id, 
  mmm.nome AS averbacao_municipio_nome, 
  eee.nome AS averbacao_estado_nome, 
  eee.sigla AS averbacao_estado_sigla 
  FROM rh_servidor_familiar AS sf 
  LEFT JOIN bsc_estado_civil as ec ON ec.id = sf.bsc_estado_civil_id 
  LEFT JOIN bsc_municipio AS m ON m.id = sf.conjuge_natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mm ON mm.id = sf.reg_civil_bsc_municipio_id 
  LEFT JOIN bsc_estado AS ee ON ee.id = mm.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mmm ON mmm.id = sf.averbacao_bsc_municipio_id 
  LEFT JOIN bsc_estado AS eee ON eee.id = mmm.bsc_estado_id 
  LEFT JOIN bsc_pais AS p ON p.id = sf.conjuge_natural_bsc_pais_id 
  WHERE sf.rh_servidor_id = ?;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorFamiliar = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorFamiliar)) {
  $rsServidorFamiliar['id'] = 0;
  $rsServidorFamiliar['rh_servidor_id'] = '';
  $rsServidorFamiliar['bsc_estado_civil_id'] = '';
  $rsServidorFamiliar['estado_civil_nome'] = '';
  $rsServidorFamiliar['conjuge_dt_casamento'] = '';
  $rsServidorFamiliar['conjuge_nome'] = '';
  $rsServidorFamiliar['conjuge_cpf'] = '';
  $rsServidorFamiliar['conjuge_dt_nascimento'] = '';
  $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] = '';
  $rsServidorFamiliar['conjuge_natural_nacionalidade'] = '';
  $rsServidorFamiliar['conjuge_natural_bsc_municipio_id'] = '';
  $rsServidorFamiliar['conjuge_natural_municipio_nome'] = '';
  $rsServidorFamiliar['conjuge_natural_estado_nome'] = '';
  $rsServidorFamiliar['conjuge_natural_estado_sigla'] = '';
  $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'] = '';
  $rsServidorFamiliar['conjuge_natural_estrangeiro_estado'] = '';
  $rsServidorFamiliar['conjuge_local_trabalho'] = '';
  $rsServidorFamiliar['reg_civil_numero'] = '';
  $rsServidorFamiliar['reg_civil_livro'] = '';
  $rsServidorFamiliar['reg_civil_folha'] = '';
  $rsServidorFamiliar['reg_civil_cartorio'] = '';
  $rsServidorFamiliar['reg_civil_dt_emissao'] = '';
  $rsServidorFamiliar['reg_civil_bsc_municipio_id'] = '';
  $rsServidorFamiliar['reg_civil_municipio_nome'] = '';
  $rsServidorFamiliar['reg_civil_estado_nome'] = '';
  $rsServidorFamiliar['reg_civil_estado_sigla'] = '';
  $rsServidorFamiliar['averbacao_tipo'] = '';
  $rsServidorFamiliar['averbacao_numero'] = '';
  $rsServidorFamiliar['averbacao_dt_emissao'] = '';
  $rsServidorFamiliar['averbacao_cartorio'] = '';
  $rsServidorFamiliar['averbacao_bsc_municipio_id'] = '';
  $rsServidorFamiliar['averbacao_municipio_nome'] = '';
  $rsServidorFamiliar['averbacao_estado_sigla'] = '';
  $rsServidorFamiliar['averbacao_estado_sigla'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sf.id, 
  sf.bsc_estado_civil_id, 
  ec.nome AS estado_civil_nome, 
  sf.conjuge_dt_casamento, 
  sf.conjuge_nome, 
  sf.conjuge_cpf, 
  sf.conjuge_dt_nascimento, 
  sf.conjuge_natural_bsc_pais_id, 
  p.nacionalidade AS conjuge_natural_nacionalidade, 
  sf.conjuge_natural_bsc_municipio_id, 
  m.nome AS conjuge_natural_municipio_nome, 
  e.nome AS conjuge_natural_estado_nome, 
  e.sigla AS conjuge_natural_estado_sigla, 
  sf.conjuge_natural_estrangeiro_cidade, 
  sf.conjuge_natural_estrangeiro_estado, 
  sf.conjuge_local_trabalho, 
  sf.reg_civil_numero, 
  sf.reg_civil_livro, 
  sf.reg_civil_folha, 
  sf.reg_civil_cartorio, 
  sf.reg_civil_dt_emissao, 
  sf.reg_civil_bsc_municipio_id, 
  mm.nome AS reg_civil_municipio_nome, 
  ee.nome AS reg_civil_estado_nome,  
  ee.sigla AS reg_civil_estado_sigla, 
  sf.averbacao_tipo, 
  sf.averbacao_numero, 
  sf.averbacao_dt_emissao, 
  sf.averbacao_cartorio, 
  sf.averbacao_bsc_municipio_id, 
  mmm.nome AS averbacao_municipio_nome, 
  eee.nome AS averbacao_estado_nome, 
  eee.sigla AS averbacao_estado_sigla, 
  sf.sacad_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_familiar AS sf 
  LEFT JOIN bsc_estado_civil as ec ON ec.id = sf.bsc_estado_civil_id 
  LEFT JOIN bsc_municipio AS m ON m.id = sf.conjuge_natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mm ON mm.id = sf.reg_civil_bsc_municipio_id 
  LEFT JOIN bsc_estado AS ee ON ee.id = mm.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mmm ON mmm.id = sf.averbacao_bsc_municipio_id 
  LEFT JOIN bsc_estado AS eee ON eee.id = mmm.bsc_estado_id 
  LEFT JOIN bsc_pais AS p ON p.id = sf.conjuge_natural_bsc_pais_id 
  WHERE sf.sacad_servidor_atualizacao_id = ?;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoFamiliar = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacaoFamiliar)) {
  $rsServidorAtualizacaoFamiliar = $rsServidorFamiliar;
  $rsServidorAtualizacaoFamiliar['id'] = 0;
  $rsServidorAtualizacaoFamiliar['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
}
$stmt = $db->prepare("
  SELECT 
  sd.id, 
  sd.rh_servidor_id, 
  sd.codigo, 
  sd.nome, 
  sd.cpf, 
  sd.bsc_parentesco_grau_id, 
  pg.nome AS parentesco_grau_nome, 
  sd.parentesco_grau_outro, 
  sd.dt_nascimento, 
  sd.dt_casamento, 
  sd.benef_autos_numero, 
  sd.benef_rg_numero, 
  sd.benef_rg_dt_emissao, 
  sd.benef_rg_orgao_expedidor, 
  sd.benef_tel_residencial, 
  sd.benef_tel_celular, 
  sd.benef_end_cep, 
  sd.benef_end_logradouro, 
  sd.benef_end_numero, 
  sd.benef_end_complemento, 
  sd.benef_end_bairro, 
  sd.benef_bsc_municipio_id,
  benefe.nome AS benef_estado_nome, 
  benefm.nome AS benef_municipio_nome, 
  sd.benef_bsc_banco_conta_tipo_id, 
  benefbct.nome AS benef_banco_conta_tipo_nome, 
  sd.benef_bsc_banco_id, 
  benefb.nome AS benef_banco_nome, 
  sd.benef_bancario_agencia, 
  sd.benef_bancario_conta, 
  sd.benef_bancario_op, 
  sd.benef_repres_nome, 
  sd.benef_repres_cpf, 
  sd.benef_repres_rg_numero, 
  sd.benef_repres_rg_dt_emissao, 
  sd.benef_repres_rg_orgao_expedidor, 
  sd.benef_repres_end_cep, 
  sd.benef_repres_end_logradouro, 
  sd.benef_repres_end_numero, 
  sd.benef_repres_end_complemento, 
  sd.benef_repres_end_bairro, 
  sd.benef_repres_bsc_municipio_id, 
  represe.nome AS benef_repres_estado_nome, 
  represm.nome AS benef_repres_municipio_nome, 
  sd.benef_repres_tel_residencial, 
  sd.benef_repres_tel_celular, 
  sd.status 
  FROM rh_servidor_dependente AS sd 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sd.bsc_parentesco_grau_id 
  LEFT JOIN bsc_municipio AS benefm ON benefm.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS benefe ON benefe.id = benefm.bsc_estado_id 
  LEFT JOIN bsc_banco_conta_tipo AS benefbct ON benefbct.id = sd.benef_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS benefb ON benefb.id = sd.benef_bsc_banco_id 
  LEFT JOIN bsc_municipio AS represm ON represm.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS represe ON represe.id = represm.bsc_estado_id 
  WHERE sd.rh_servidor_id = ? 
  ORDER BY sd.id ASC;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sd.id, 
  sd.codigo, 
  sd.nome, 
  sd.cpf, 
  sd.bsc_parentesco_grau_id, 
  pg.nome AS parentesco_grau_nome, 
  sd.parentesco_grau_outro, 
  sd.dt_nascimento, 
  sd.dt_casamento, 
  sd.benef_autos_numero, 
  sd.benef_rg_numero, 
  sd.benef_rg_dt_emissao, 
  sd.benef_rg_orgao_expedidor, 
  sd.benef_tel_residencial, 
  sd.benef_tel_celular, 
  sd.benef_end_cep, 
  sd.benef_end_logradouro, 
  sd.benef_end_numero, 
  sd.benef_end_complemento, 
  sd.benef_end_bairro, 
  sd.benef_bsc_municipio_id,
  benefe.nome AS benef_estado_nome, 
  benefm.nome AS benef_municipio_nome, 
  sd.benef_bsc_banco_conta_tipo_id, 
  benefbct.nome AS benef_banco_conta_tipo_nome, 
  sd.benef_bsc_banco_id, 
  benefb.nome AS benef_banco_nome, 
  sd.benef_bancario_agencia, 
  sd.benef_bancario_conta, 
  sd.benef_bancario_op, 
  sd.benef_repres_nome, 
  sd.benef_repres_cpf, 
  sd.benef_repres_rg_numero, 
  sd.benef_repres_rg_dt_emissao, 
  sd.benef_repres_rg_orgao_expedidor, 
  sd.benef_repres_end_cep, 
  sd.benef_repres_end_logradouro, 
  sd.benef_repres_end_numero, 
  sd.benef_repres_end_complemento, 
  sd.benef_repres_end_bairro, 
  sd.benef_repres_bsc_municipio_id, 
  represe.nome AS benef_repres_estado_nome, 
  represm.nome AS benef_repres_municipio_nome, 
  sd.benef_repres_tel_residencial, 
  sd.benef_repres_tel_celular, 
  sd.status, 
  sd.sacad_servidor_atualizacao_id, 
  sd.sacad_servidor_dependente_id_old, 
  sd.prova_dependente, 
  sd.situacao_dependente, 
  sd.obs_dependente 
  FROM sacad_servidor_atualizacao_dependente AS sd 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sd.bsc_parentesco_grau_id 
  LEFT JOIN bsc_municipio AS benefm ON benefm.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS benefe ON benefe.id = benefm.bsc_estado_id 
  LEFT JOIN bsc_banco_conta_tipo AS benefbct ON benefbct.id = sd.benef_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS benefb ON benefb.id = sd.benef_bsc_banco_id 
  LEFT JOIN bsc_municipio AS represm ON represm.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS represe ON represe.id = represm.bsc_estado_id 
  WHERE sd.sacad_servidor_atualizacao_id = ? 
  ORDER BY sd.id ASC;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (sizeof($rsServidorDependentes) < 1 || sizeof($rsServidorAtualizacaoDependentes) > 0) {
  array_push($rsServidorDependentes, 
    [
      'id' => 0,
      'rh_servidor_id' => 0,
      'codigo' => '',
      'nome' => '',
      'cpf' => '',
      'bsc_parentesco_grau_id' => 0,
      'parentesco_grau_nome' => '',
      'parentesco_grau_outro' => '',
      'dt_nascimento' => '',
      'dt_casamento' => '',
      'benef_autos_numero' => '',
      'benef_rg_numero' => '',
      'benef_rg_dt_emissao' => '',
      'benef_rg_orgao_expedidor' => '',
      'benef_tel_residencial' => '',
      'benef_tel_celular' => '',
      'benef_end_cep' => '',
      'benef_end_logradouro' => '', 
      'benef_end_numero' => '',
      'benef_end_complemento' => '',
      'benef_end_bairro' => '',
      'benef_bsc_municipio_id' => 0,
      'benef_estado_nome' => '',
      'benef_municipio_nome' => '',
      'benef_bsc_banco_conta_tipo_id' => 0,
      'benef_banco_conta_tipo_nome' => '',
      'benef_bsc_banco_id' => 0,
      'benef_banco_nome' => '',
      'benef_bancario_agencia' => '',
      'benef_bancario_conta' => '',
      'benef_bancario_op' => '',
      'benef_repres_nome' => '',
      'benef_repres_cpf' => '',
      'benef_repres_rg_numero' => '',
      'benef_repres_rg_dt_emissao' => '',
      'benef_repres_rg_orgao_expedidor' => '',
      'benef_repres_end_cep' => '',
      'benef_repres_end_logradouro' => '',
      'benef_repres_end_numero' => '',
      'benef_repres_end_complemento' => '',
      'benef_repres_end_bairro' => '',
      'benef_repres_bsc_municipio_id' => 0,
      'benef_repres_estado_nome' => '',
      'benef_repres_municipio_nome' => '',
      'benef_repres_tel_residencial' => '',
      'benef_repres_tel_celular' => '',
      'prova_dependente' => '',
      'situacao_dependente' => '',
      'obs_dependente' => '',
      'status' => 1
    ]
  );
}
if (sizeof($rsServidorAtualizacaoDependentes) < 1) {
  $rsServidorAtualizacaoDependentes = $rsServidorDependentes;
  foreach ($rsServidorAtualizacaoDependentes as $kObj => $vObj) {
    $rsServidorAtualizacaoDependentes[$kObj]['id'] = 0;
    $rsServidorAtualizacaoDependentes[$kObj]['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
    $rsServidorAtualizacaoDependentes[$kObj]['sacad_servidor_dependente_id_old'] = $vObj['id'];
  }
}
$stmt = $db->prepare("
  SELECT 
  sb.id, 
  sb.rh_servidor_id, 
  sb.bancario_bsc_banco_conta_tipo_id, 
  bct.nome AS conta_tipo_nome, 
  sb.bancario_bsc_banco_id, 
  b.codigo AS banco_codigo, 
  b.nome AS banco_nome, 
  sb.bancario_agencia, 
  sb.bancario_conta, 
  sb.bancario_op, 
  sb.status 
  FROM rh_servidor_bancario AS sb 
  LEFT JOIN bsc_banco_conta_tipo AS bct ON bct.id = sb.bancario_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS b ON b.id = sb.bancario_bsc_banco_id 
  WHERE sb.rh_servidor_id = ?;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorBancario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorBancario)) {
  $rsServidorBancario['id'] = 0;
  $rsServidorBancario['rh_servidor_id'] = '';
  $rsServidorBancario['bancario_bsc_banco_conta_tipo_id'] = '';
  $rsServidorBancario['conta_tipo_nome'] = '';
  $rsServidorBancario['bancario_bsc_banco_id'] = '';
  $rsServidorBancario['banco_codigo'] = '';
  $rsServidorBancario['banco_nome'] = '';
  $rsServidorBancario['bancario_agencia'] = '';
  $rsServidorBancario['bancario_conta'] = '';
  $rsServidorBancario['bancario_op'] = '';
  $rsServidorBancario['status'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sb.id, 
  sb.bancario_bsc_banco_conta_tipo_id, 
  bct.nome AS conta_tipo_nome, 
  sb.bancario_bsc_banco_id, 
  b.codigo AS banco_codigo, 
  b.nome AS banco_nome, 
  sb.bancario_agencia, 
  sb.bancario_conta, 
  sb.bancario_op, 
  sb.status, 
  sb.sacad_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_bancario AS sb 
  LEFT JOIN bsc_banco_conta_tipo AS bct ON bct.id = sb.bancario_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS b ON b.id = sb.bancario_bsc_banco_id 
  WHERE sb.sacad_servidor_atualizacao_id = ?;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoBancario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacaoBancario)) {
  $rsServidorAtualizacaoBancario = $rsServidorBancario;
  $rsServidorAtualizacaoBancario['id'] = 0;
  $rsServidorAtualizacaoBancario['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
}
$stmt = $db->prepare("
  SELECT 
  sv.id, 
  sv.rh_servidor_id, 
  sv.local, 
  sv.esfera, 
  sv.cargo, 
  sv.carga_horaria, 
  sv.status 
  FROM rh_servidor_vinculo AS sv 
  WHERE sv.rh_servidor_id = ? 
  ORDER BY sv.id ASC;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->execute();
$rsServidorVinculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sv.id, 
  sv.local, 
  sv.esfera, 
  sv.cargo, 
  sv.carga_horaria, 
  sv.status, 
  sv.sacad_servidor_atualizacao_id, 
  sv.sacad_servidor_vinculo_id_old, 
  sv.prova_vinculo, 
  sv.situacao_vinculo, 
  sv.obs_vinculo 
  FROM sacad_servidor_atualizacao_vinculo AS sv 
  WHERE sv.sacad_servidor_atualizacao_id = ? 
  ORDER BY sv.id ASC;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoVinculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (sizeof($rsServidorVinculos) < 1 || sizeof($rsServidorAtualizacaoVinculos) > 0) {
  array_push($rsServidorVinculos, 
    [
      'id' => 0,
      'rh_servidor_id' => 0,
      'local' => '',
      'esfera' => '',
      'cargo' => '',
      'carga_horaria' => '',
      'prova_vinculo' => '',
      'situacao_vinculo' => '',
      'obs_vinculo' => '',
      'status' => 1
    ]
  );
}
if (sizeof($rsServidorAtualizacaoVinculos) < 1) {
  $rsServidorAtualizacaoVinculos = $rsServidorVinculos;
  foreach ($rsServidorAtualizacaoVinculos as $kObj => $vObj) {
    $rsServidorAtualizacaoVinculos[$kObj]['id'] = 0;
    $rsServidorAtualizacaoVinculos[$kObj]['sacad_servidor_atualizacao_id'] = $rsServidorAtualizacao['id'];
    $rsServidorAtualizacaoVinculos[$kObj]['sacad_servidor_vinculo_id_old'] = $vObj['id'];
  }
}
$stmt = $db->prepare("
  SELECT 
  sap.id, 
  sap.prova_pessoal, 
  sap.situacao_pessoal, 
  sap.obs_pessoal, 
  sap.prova_naturalidade, 
  sap.situacao_naturalidade, 
  sap.obs_naturalidade, 
  sap.prova_empregador, 
  sap.situacao_empregador, 
  sap.obs_empregador, 
  sap.prova_situacao_trabalho, 
  sap.situacao_situacao_trabalho, 
  sap.obs_situacao_trabalho, 
  sap.prova_empregador_2, 
  sap.situacao_empregador_2, 
  sap.obs_empregador_2, 
  sap.prova_situacao_trabalho_2, 
  sap.situacao_situacao_trabalho_2, 
  sap.obs_situacao_trabalho_2, 
  sap.prova_covid_vacina, 
  sap.situacao_covid_vacina, 
  sap.obs_covid_vacina, 
  sap.prova_enfermidade, 
  sap.situacao_enfermidade, 
  sap.obs_enfermidade, 
  sap.prova_end, 
  sap.situacao_end, 
  sap.obs_end, 
  sap.prova_rg, 
  sap.situacao_rg, 
  sap.obs_rg, 
  sap.prova_pis, 
  sap.situacao_pis, 
  sap.obs_pis, 
  sap.prova_ctps, 
  sap.situacao_ctps, 
  sap.obs_ctps, 
  sap.prova_eleitor, 
  sap.situacao_eleitor, 
  sap.obs_eleitor, 
  sap.prova_reg_militar, 
  sap.situacao_reg_militar, 
  sap.obs_reg_militar, 
  sap.prova_reg_prof, 
  sap.situacao_reg_prof, 
  sap.obs_reg_prof, 
  sap.prova_cnh, 
  sap.situacao_cnh, 
  sap.obs_cnh, 
  sap.prova_rne, 
  sap.situacao_rne, 
  sap.obs_rne, 
  -- sap.prova_fgts, 
  -- sap.situacao_fgts, 
  -- sap.obs_fgts, 
  sap.prova_reg_civil, 
  sap.situacao_reg_civil, 
  sap.obs_reg_civil, 
  sap.prova_averbacao, 
  sap.situacao_averbacao, 
  sap.obs_averbacao, 
  sap.prova_bancario, 
  sap.situacao_bancario, 
  sap.obs_bancario, 
  sap.status, 
  sap.sacad_servidor_atualizacao_id 
  FROM sacad_servidor_atualizacao_prova AS sap
  WHERE sap.sacad_servidor_atualizacao_id = ?;");
$stmt->bindValue(1, $rsServidorAtualizacao['id']);
$stmt->execute();
$rsServidorAtualizacaoProva = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorAtualizacaoProva)) {
  $rsServidorAtualizacaoProva['id'] = NULL;
  $rsServidorAtualizacaoProva['prova_pessoal'] = '';
  $rsServidorAtualizacaoProva['situacao_pessoal'] = NULL;
  $rsServidorAtualizacaoProva['obs_pessoal'] = '';
  $rsServidorAtualizacaoProva['prova_naturalidade'] = '';
  $rsServidorAtualizacaoProva['situacao_naturalidade'] = NULL;
  $rsServidorAtualizacaoProva['obs_naturalidade'] = '';
  $rsServidorAtualizacaoProva['prova_empregador'] = '';
  $rsServidorAtualizacaoProva['situacao_empregador'] = NULL;
  $rsServidorAtualizacaoProva['obs_empregador'] = '';
  $rsServidorAtualizacaoProva['prova_situacao_trabalho'] = '';
  $rsServidorAtualizacaoProva['situacao_situacao_trabalho'] = NULL;
  $rsServidorAtualizacaoProva['obs_situacao_trabalho'] = '';
  $rsServidorAtualizacaoProva['prova_empregador_2'] = '';
  $rsServidorAtualizacaoProva['situacao_empregador_2'] = NULL;
  $rsServidorAtualizacaoProva['obs_empregador_2'] = '';
  $rsServidorAtualizacaoProva['prova_situacao_trabalho_2'] = '';
  $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] = NULL;
  $rsServidorAtualizacaoProva['obs_situacao_trabalho_2'] = '';
  $rsServidorAtualizacaoProva['prova_covid_vacina'] = '';
  $rsServidorAtualizacaoProva['situacao_covid_vacina'] = NULL;
  $rsServidorAtualizacaoProva['obs_covid_vacina'] = '';
  $rsServidorAtualizacaoProva['prova_enfermidade'] = '';
  $rsServidorAtualizacaoProva['situacao_enfermidade'] = NULL;
  $rsServidorAtualizacaoProva['obs_enfermidade'] = '';
  $rsServidorAtualizacaoProva['prova_end'] = '';
  $rsServidorAtualizacaoProva['situacao_end'] = NULL;
  $rsServidorAtualizacaoProva['obs_end'] = '';
  $rsServidorAtualizacaoProva['prova_rg'] = '';
  $rsServidorAtualizacaoProva['situacao_rg'] = NULL;
  $rsServidorAtualizacaoProva['obs_rg'] = '';
  $rsServidorAtualizacaoProva['prova_pis'] = '';
  $rsServidorAtualizacaoProva['situacao_pis'] = NULL;
  $rsServidorAtualizacaoProva['obs_pis'] = '';
  $rsServidorAtualizacaoProva['prova_ctps'] = '';
  $rsServidorAtualizacaoProva['situacao_ctps'] = NULL;
  $rsServidorAtualizacaoProva['obs_ctps'] = '';
  $rsServidorAtualizacaoProva['prova_eleitor'] = '';
  $rsServidorAtualizacaoProva['situacao_eleitor'] = NULL;
  $rsServidorAtualizacaoProva['obs_eleitor'] = '';
  $rsServidorAtualizacaoProva['prova_reg_militar'] = '';
  $rsServidorAtualizacaoProva['situacao_reg_militar'] = NULL;
  $rsServidorAtualizacaoProva['obs_reg_militar'] = '';
  $rsServidorAtualizacaoProva['prova_reg_prof'] = '';
  $rsServidorAtualizacaoProva['situacao_reg_prof'] = NULL;
  $rsServidorAtualizacaoProva['obs_reg_prof'] = '';
  $rsServidorAtualizacaoProva['prova_cnh'] = '';
  $rsServidorAtualizacaoProva['situacao_cnh'] = NULL;
  $rsServidorAtualizacaoProva['obs_cnh'] = '';
  $rsServidorAtualizacaoProva['prova_rne'] = '';
  $rsServidorAtualizacaoProva['situacao_rne'] = NULL;
  $rsServidorAtualizacaoProva['obs_rne'] = '';
  // $rsServidorAtualizacaoProva['prova_fgts'] = '';
  // $rsServidorAtualizacaoProva['situacao_fgts'] = NULL;
  // $rsServidorAtualizacaoProva['obs_fgts'] = '';
  $rsServidorAtualizacaoProva['prova_reg_civil'] = '';
  $rsServidorAtualizacaoProva['situacao_reg_civil'] = NULL;
  $rsServidorAtualizacaoProva['obs_reg_civil'] = '';
  $rsServidorAtualizacaoProva['prova_averbacao'] = '';
  $rsServidorAtualizacaoProva['situacao_averbacao'] = NULL;
  $rsServidorAtualizacaoProva['obs_averbacao'] = '';
  $rsServidorAtualizacaoProva['prova_bancario'] = '';
  $rsServidorAtualizacaoProva['situacao_bancario'] = NULL;
  $rsServidorAtualizacaoProva['obs_bancario'] = '';
  $rsServidorAtualizacaoProva['status'] = 0;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- METAS BEGIN -->
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON_SISTEMA; ?>">
  <title>:: ZATU | PROTOCOLO ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <!-- <link rel="stylesheet" href="<?= CSS_FOLDER; ?>vendors_css.css"> -->
  <!-- <link rel="stylesheet" href="<?= CSS_FOLDER; ?>style.css"> -->
  <!-- <link rel="stylesheet" href="<?= CSS_FOLDER; ?>skin_color.css"> -->
  <!-- Style-->  
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fonts/fonts.css">
  <!-- CSS PLUGINS BEGIN -->
  <!-- CSS CUSTON BEGIN -->
  <!-- CSS CUSTON END -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= PORTAL_URL ?>assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= PORTAL_URL ?>assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <style type="text/css">
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Calibri, Helvetica, sans-serif;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #c1c1c1;
      height:120px;
    }
    header .img{
      width: 240px;
    }
    header .img img{
      width: 100%;
    }
    header .data{
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }
    header .data span{
      font-size:12px;
      font-weight:bold;
    }

    .content{
      padding: 20px;
      min-height: calc(100vh - 200px);
    }
    .content .user-info{
      display: flex;
      justify-content: flex-start;
      align-items: center;
    }
    .content .user-info span{
      padding: 0 20px 0 0;
      text-transform: uppercase;
    }
    .content .user-info span strong{
      text-transform: capitalize;
      font-size: 12px;
    }
    .content .list-info {
      display: flex;
      font-size: 12px;
    }
    .content .list-info ul{
      width:50%;
      min-width: 300px;
      list-style: none;
      padding: 0;
      margin: 20px 0;
      display: flex;
      flex-direction: column;

    }
    .content .list-info ul li span{
      text-transform: uppercase;
    }
    .content .list-info ul li span strong{
      text-transform: capitalize;
    }
    .content table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    .content table thead{
      border-bottom: 1px solid #c1c1c1;
    }
    .content table th {
      text-align:left;
      padding: 10px 5px;
      text-transform: uppercase;
      font-size: 12px;
    }
    .content table tbody{
      border-bottom: 1px solid #c1c1c1;
    }
    .content table td {
      text-align: left;
      padding: 10px 5px;
      font-size: 12px;
    }
    .content table tbody tr{
      border-bottom: 1px solid #f1f1f1;
    }
    .content table tbody tr:last-child{
      border-bottom: none;
    }
    .content table tbody tr:nth-child(even){
      background-color: #f1f1f1;
    }
    .content .authenticator{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
    }
    .content .authenticator p{
      font-weight: bold;
      font-size: 14px;
    }
    footer {
      border-top: 1px solid #c1c1c1;
      height:50px;
      display: flex;
      justify-content:center;
      align-items: center;
      flex-direction: column;
    }
    footer .logo img {
      width:90px;
    }
    footer .text {
      font-weight:bold;
      font-size:12px;
    }
  </style>
</head>
<body class="hold-transition theme-primary">
	<header>
    <div class="img">
      <img src="<?= ASSETS_FOLDER ;?>/images/logo-prefeitura.svg" alt="">
    </div>
    <div class="data">
      <span>COMPROVANTE DE ATUALIZAÇÃO CADASTRAL ONLINE 2022</span>
      <span>Data/Hora da Alteração: <?= obterDataHoraBRTimestamp($rsServidorAtualizacao['situacaoServidorUltima']['dt_cadastro']) ;?></span>
    </div>
  </header>
  <?php
  $feedback = '';
  if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 2) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E ESTÁ AGUARDANDO ATESTAÇÃO DE VÍNCULO PELO CHEFE IMEDIATO!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 3) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E TEVE A ATESTAÇÃO DE VINCULO RECUSADA PELO CHEFE IMEDIATO!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 4) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E TEVE A ATESTAÇÃO DE VINCULO ACEITA PELO CHEFE IMEDIATO!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 5) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E ESTÁ AGUARDANDO ANALISE PELO RH!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 6) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E ESTÁ EM ANÁLISE PELO RH!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 7) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ENVIADA E FOI RECUSADA PELO RH!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 8) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO ESTÁ AGUARDANDO AS SUAS CORREÇÕES!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 9) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ANALISADA E ACEITA PELO RH!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 10) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI ANALISADA, ACEITA E FINALIZADA!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 11) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI RECUSADA E ESTÁ SENDO CORRIGIDA POR VOCÊ!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 12) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI CORRIGIDA POR VOCÊ E ESTÁ AGUARDANDO ANÁLISE PELO RH!';
  } else if ($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 13) {
    $feedback = 'A ATUALIZAÇÃO DO SEU CADASTRO FOI CORRIGIDA POR VOCÊ E ESTÁ AGUARDANDO ATESTAÇÃO DE VÍNCULO PELO CHEFE IMEDIATO!';
  }
  ?>
  <div class="content">
    <div class="user-info">
      <span><strong>CPF:</strong> <?= $rsServidor['cpf'] ;?></span>
      <span><strong>Servidor:</strong> <?= $rsServidor['nome'] ;?></span>
    </div>
    <div class="user-info">
      <span><strong>Situação:</strong> <?= $feedback ;?></span>
    </div>
    <div class="list-info">
      <ul>
        <li><strong>Matrícula:</strong> <?= $rsServidorAtualizacao['matricula'] ;?></li>
        <li><strong>Situação:</strong> <?= $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] ;?></li>
        <li><strong>Secretaria:</strong> <?= $rsServidorAtualizacao['uo_nome'] ;?></li>
        <li><strong>Setor:</strong> <?= $rsServidorAtualizacao['setor_nome'] ;?></li>
        <li><strong>Município:</strong> Tarauacá-AC</li>
      </ul>
      <?php 
      if ($rsServidorAtualizacao['matricula_2'] != '') {
        ?>
        <ul>
          <li><strong>Matrícula:</strong> <?= $rsServidorAtualizacao['matricula_2'] ;?></li>
          <li><strong>Situação:</strong> <?= $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] ;?></li>
          <li><strong>Secretaria:</strong> <?= $rsServidorAtualizacao['uo_nome_2'] ;?></li>
          <li><strong>Setor:</strong> <?= $rsServidorAtualizacao['setor_nome_2'] ;?></li>
          <li><strong>Município:</strong> Tarauacá-AC</li>
        </ul>
        <?php
      }
      ?>
    </div>
    <p>Caro(a) servidor(a), você deverá aguardar a validação de suas informações pela chefia imediata e após pelo Setor de Recursos Humano da 
      Secretaria Municipal de Administração, caso a atualização resulte em divergência de informações, deverão ser sanadas no prazo de 02 Dias úteis 
    para conclusão da atualização cadastral anual, após sanadas, aparecerá em sua área de usuário o status FINALIZADO.</p>
    <input type="hidden" id="id" name="id" value="<?= $rsServidor['id'];?>">
    <table class="">
      <thead>
        <tr>
          <th width="40%">CAMPOS MODIFICADOS</th>
          <th>CONTEÚDO INFORMADO</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rsServidor['nome'] != $rsServidorAtualizacao['nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PESSOAL - Nome</td>
            <td><?= $rsServidorAtualizacao['nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['nome_social'] != $rsServidorAtualizacao['nome_social']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PESSOAL - Nome social</td>
            <td><?= $rsServidorAtualizacao['nome_social'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['sexo'] != $rsServidorAtualizacao['sexo']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PESSOAL - Sexo</td>
            <td><?= $rsServidorAtualizacao['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></td>
          </tr>
          <?php
        }
        if($rsServidor['sangue_tipo'] != $rsServidorAtualizacao['sangue_tipo']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PESSOAL - Tipo sanguíneo</td>
            <td><?= $rsServidorAtualizacao['sangue_tipo'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['raca'] != $rsServidorAtualizacao['raca']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PESSOAL - Raça</td>
            <td><?= $rsServidorAtualizacao['raca'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_bsc_pais_id'] != $rsServidorAtualizacao['natural_bsc_pais_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> NACIONALIDADE</td>
            <td><?= $rsServidorAtualizacao['nacionalidade_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_bsc_municipio_id'] != $rsServidorAtualizacao['natural_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> NATURALIDADE</td>
            <td><?= $rsServidorAtualizacao['natural_municipio_nome'].' - '.$rsServidorAtualizacao['natural_estado_sigla']; ?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_estrangeiro_dt_ingresso'] != $rsServidorAtualizacao['natural_estrangeiro_dt_ingresso']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ESTRANGEIRO - Data de ingresso no Brasil</td>
            <td><?= data_volta($rsServidorAtualizacao['natural_estrangeiro_dt_ingresso']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_estrangeiro_cidade'] != $rsServidorAtualizacao['natural_estrangeiro_cidade']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ESTRANGEIRO - NATURALIDADE - Cidade</td>
            <td><?= $rsServidorAtualizacao['natural_estrangeiro_cidade'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_estrangeiro_estado'] != $rsServidorAtualizacao['natural_estrangeiro_estado']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ESTRANGEIRO - NATURALIDADE - Estado</td>
            <td><?= $rsServidorAtualizacao['natural_estrangeiro_estado'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['natural_estrangeiro_condicao_trabalho'] != $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ESTRANGEIRO - Condição de trablaho</td>
            <td><?= $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['pai_nome'] != $rsServidorAtualizacao['pai_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Nome do pai</td>
            <td><?= $rsServidorAtualizacao['pai_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['pai_natural_bsc_pais_id'] != $rsServidorAtualizacao['pai_natural_bsc_pais_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Nacionalidade do pai</td>
            <td><?= $rsServidorAtualizacao['pai_nacionalidade_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['pai_profissao'] != $rsServidorAtualizacao['pai_profissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Profissão do pai</td>
            <td><?= $rsServidorAtualizacao['pai_profissao'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['mae_nome'] != $rsServidorAtualizacao['mae_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Nome da mãe</td>
            <td><?= $rsServidorAtualizacao['mae_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['mae_natural_bsc_pais_id'] != $rsServidorAtualizacao['mae_natural_bsc_pais_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Nacionalidade da mãe</td>
            <td><?= $rsServidorAtualizacao['mae_nacionalidade_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['mae_profissao'] != $rsServidorAtualizacao['mae_profissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> PAIS - Profissão da mãe</td>
            <td><?= $rsServidorAtualizacao['mae_profissao'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['eo_empregador_id'] != $rsServidorAtualizacao['eo_empregador_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1</td>
            <td><?= $rsServidorAtualizacao['empregador_razao_social']. ($rsServidorAtualizacao['empregador_fantasia'] != '' ? (' - '.$rsServidorAtualizacao['empregador_fantasia']) : '') ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['bsc_unidade_organizacional_id'] != $rsServidorAtualizacao['bsc_unidade_organizacional_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Órgão atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['uo_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['eo_setor_id'] != $rsServidorAtualizacao['eo_setor_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Setor atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['setor_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['rh_situacao_trabalho_id'] != $rsServidorAtualizacao['rh_situacao_trabalho_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Situação atual do trabalho</td>
            <td><?= $rsServidorAtualizacao['sit_trab_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_decreto'] != $rsServidorAtualizacao['situacao_trabalho_decreto']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Decreto</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_decreto'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_doe'] != $rsServidorAtualizacao['situacao_trabalho_doe']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - DOE (Diário Oficial do Estado)</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_doe'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_dt_inicio'] != $rsServidorAtualizacao['situacao_trabalho_dt_inicio']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Data início da situação atual de trabalho</td>
            <td><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_dt_fim'] != $rsServidorAtualizacao['situacao_trabalho_dt_fim']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Data fim da situação atual de trabalho</td>
            <td><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_obs'] != $rsServidorAtualizacao['situacao_trabalho_obs']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 1 - Observação sobre a Situação atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_obs'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['eo_empregador_id_2'] != $rsServidorAtualizacao['eo_empregador_id_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2</td>
            <td><?= $rsServidorAtualizacao['empregador_razao_social_2']. ($rsServidorAtualizacao['empregador_fantasia_2'] != '' ? (' - '.$rsServidorAtualizacao['empregador_fantasia']) : '') ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['bsc_unidade_organizacional_id_2'] != $rsServidorAtualizacao['bsc_unidade_organizacional_id_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Órgão atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['uo_nome_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['eo_setor_id_2'] != $rsServidorAtualizacao['eo_setor_id_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Setor atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['setor_nome_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['rh_situacao_trabalho_id_2'] != $rsServidorAtualizacao['rh_situacao_trabalho_id_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Situação atual do trabalho</td>
            <td><?= $rsServidorAtualizacao['sit_trab_nome_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_decreto_2'] != $rsServidorAtualizacao['situacao_trabalho_decreto_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Decreto</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_decreto_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_doe_2'] != $rsServidorAtualizacao['situacao_trabalho_doe_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - DOE (Diário Oficial do Estado)</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_doe_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_dt_inicio_2'] != $rsServidorAtualizacao['situacao_trabalho_dt_inicio_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Data início da situação atual de trabalho</td>
            <td><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio_2']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_dt_fim_2'] != $rsServidorAtualizacao['situacao_trabalho_dt_fim_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Data fim da situação atual de trabalho</td>
            <td><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim_2']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['situacao_trabalho_obs_2'] != $rsServidorAtualizacao['situacao_trabalho_obs_2']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> LOCAL DE TRABALHO 2 - Observação sobre a Situação atual de trabalho</td>
            <td><?= $rsServidorAtualizacao['situacao_trabalho_obs_2'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['covid_vacina_nome'] != $rsServidorAtualizacao['covid_vacina_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> VACINA - COVID-19</td>
            <td><?= $rsServidorAtualizacao['covid_vacina_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['covid_vacina_dose'] != $rsServidorAtualizacao['covid_vacina_dose']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> VACINA - COVID-19 - Dose</td>
            <td><?= $rsServidorAtualizacao['covid_vacina_dose'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['covid_vacina_lote'] != $rsServidorAtualizacao['covid_vacina_lote']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> VACINA - COVID-19 - Lote</td>
            <td><?= $rsServidorAtualizacao['covid_vacina_lote'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['covid_vacina_data'] != $rsServidorAtualizacao['covid_vacina_data']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> VACINA - COVID-19 - Data</td>
            <td><?= data_volta($rsServidorAtualizacao['covid_vacina_data']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['covid_vacina_endereco'] != $rsServidorAtualizacao['covid_vacina_endereco']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> VACINA - COVID-19 - Endereço</td>
            <td><?= $rsServidorAtualizacao['covid_vacina_endereco'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['enfermidade_portador'] != $rsServidorAtualizacao['enfermidade_portador']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENFERMEDADE PORTADA</td>
            <td><?= $rsServidorAtualizacao['enfermidade_portador'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidor['enfermidade_codigo_internacional'] != $rsServidorAtualizacao['enfermidade_codigo_internacional']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENFERMEDADE - Cód. Internacional</td>
            <td><?= $rsServidorAtualizacao['enfermidade_codigo_internacional'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['tel_residencial'] != $rsServidorAtualizacaoContato['tel_residencial']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Telefone residencial</td>
            <td><?= $rsServidorAtualizacaoContato['tel_residencial'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['tel_celular'] != $rsServidorAtualizacaoContato['tel_celular']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Telefone celular</td>
            <td><?= $rsServidorAtualizacaoContato['tel_celular'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['tel_recado'] != $rsServidorAtualizacaoContato['tel_recado']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Número para recado</td>
            <td><?= $rsServidorAtualizacaoContato['tel_recado'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['tel_recado_nome'] != $rsServidorAtualizacaoContato['tel_recado_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Nome do contato para recado</td>
            <td><?= $rsServidorAtualizacaoContato['tel_recado_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['tel_recado_parentesco_grau_nome'] != $rsServidorAtualizacaoContato['tel_recado_parentesco_grau_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Grau de parentesco (recado)</td>
            <td><?= $rsServidorAtualizacaoContato['tel_recado_parentesco_grau_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['contato_emergencia_tel'] != $rsServidorAtualizacaoContato['contato_emergencia_tel']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Número emergencial</td>
            <td><?= $rsServidorAtualizacaoContato['contato_emergencia_tel'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['contato_emergencia_nome'] != $rsServidorAtualizacaoContato['contato_emergencia_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - Nome do contato emergencial</td>
            <td><?= $rsServidorAtualizacaoContato['contato_emergencia_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['email_institucional'] != $rsServidorAtualizacaoContato['email_institucional']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - E-mail institucional</td>
            <td><?= $rsServidorAtualizacaoContato['email_institucional'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['email_pessoal'] != $rsServidorAtualizacaoContato['email_pessoal']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - E-mail pessoal</td>
            <td><?= $rsServidorAtualizacaoContato['email_pessoal'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['email_alternativo'] != $rsServidorAtualizacaoContato['email_alternativo']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> CONTATO - E-mail alternativo</td>
            <td><?= $rsServidorAtualizacaoContato['email_alternativo'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_logradouro'] != $rsServidorAtualizacaoContato['end_logradouro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Logradouro</td>
            <td><?= $rsServidorAtualizacaoContato['end_logradouro'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_numero'] != $rsServidorAtualizacaoContato['end_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Número</td>
            <td><?= $rsServidorAtualizacaoContato['end_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_complemento'] != $rsServidorAtualizacaoContato['end_complemento']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Complemento</td>
            <td><?= $rsServidorAtualizacaoContato['end_complemento'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_bairro'] != $rsServidorAtualizacaoContato['end_bairro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Bairro</td>
            <td><?= $rsServidorAtualizacaoContato['end_bairro'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_cep'] != $rsServidorAtualizacaoContato['end_cep']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - CEP</td>
            <td><?= $rsServidorAtualizacaoContato['end_cep'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_estado_id'] != $rsServidorAtualizacaoContato['end_estado_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Estado</td>
            <td><?= $rsServidorAtualizacaoContato['end_estado_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorContato['end_bsc_municipio_id'] != $rsServidorAtualizacaoContato['end_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> ENDEREÇO - Cidade</td>
            <td><?= $rsServidorAtualizacaoContato['end_municipio_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rg_numero'] != $rsServidorAtualizacaoDocumento['rg_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RG - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['rg_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rg_dt_emissao'] != $rsServidorAtualizacaoDocumento['rg_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RG - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['rg_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rg_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['rg_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RG - Orgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['rg_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_numero'] != $rsServidorAtualizacaoDocumento['pis_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['pis_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_dt_cadastro'] != $rsServidorAtualizacaoDocumento['pis_dt_cadastro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Data de cadastro</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['pis_dt_cadastro']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_domicilio_bancario'] != $rsServidorAtualizacaoDocumento['pis_domicilio_bancario']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Domicilio bancário</td>
            <td><?= $rsServidorAtualizacaoDocumento['pis_domicilio_bancario'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_banco_numero'] != $rsServidorAtualizacaoDocumento['pis_banco_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Número do banco</td>
            <td><?= $rsServidorAtualizacaoDocumento['pis_banco_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_agencia'] != $rsServidorAtualizacaoDocumento['pis_agencia']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Agência</td>
            <td><?= $rsServidorAtualizacaoDocumento['pis_agencia'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['pis_agencia_end'] != $rsServidorAtualizacaoDocumento['pis_agencia_end']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - PIS - Endereço da agencia bancária</td>
            <td><?= $rsServidorAtualizacaoDocumento['pis_agencia_end'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['ctps_numero'] != $rsServidorAtualizacaoDocumento['ctps_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CTPS - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['ctps_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['ctps_serie'] != $rsServidorAtualizacaoDocumento['ctps_serie']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CTPS - Série</td>
            <td><?= $rsServidorAtualizacaoDocumento['ctps_serie'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['ctps_dt_emissao'] != $rsServidorAtualizacaoDocumento['ctps_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CTPS - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['ctps_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['ctps_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CTPS - Órgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['ctps_primeiro_emprego_ano'] != $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CTPS - Ano do primerio emprego</td>
            <td><?= $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['eleitor_numero'] != $rsServidorAtualizacaoDocumento['eleitor_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Título Eleitoral - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['eleitor_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['eleitor_zona'] != $rsServidorAtualizacaoDocumento['eleitor_zona']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Título Eleitoral - Zona</td>
            <td><?= $rsServidorAtualizacaoDocumento['eleitor_zona'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['eleitor_secao'] != $rsServidorAtualizacaoDocumento['eleitor_secao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Título Eleitoral - Seção</td>
            <td><?= $rsServidorAtualizacaoDocumento['eleitor_secao'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['eleitor_bsc_municipio_id'] != $rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Título Eleitoral - Município</td>
            <td><?= $rsServidorAtualizacaoDocumento['eleitor_municipio_nome'].' - '.$rsServidorAtualizacaoDocumento['eleitor_estado_sigla'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['eleitor_insc_orgao_classe'] != $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Título Eleitoral - Inscrição em órgão de classe</td>
            <td><?= $rsServidorAtualizacaoDocumento['rg_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_militar_numero'] != $rsServidorAtualizacaoDocumento['reg_militar_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Militar - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_militar_categoria'] != $rsServidorAtualizacaoDocumento['reg_militar_categoria']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Militar - Categoria</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_categoria'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_militar_emissao_ano'] != $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Militar - Ano de emissão</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_militar_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Militar - Órgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_militar_especie'] != $rsServidorAtualizacaoDocumento['reg_militar_especie']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Militar - Espécie</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_especie'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_prof_numero'] != $rsServidorAtualizacaoDocumento['reg_prof_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Profissional - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_prof_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_prof_dt_emissao'] != $rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Profissional - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_prof_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Profissional - Órgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_prof_dt_validade'] != $rsServidorAtualizacaoDocumento['reg_prof_dt_validade']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Registro Profissional - Data de validade</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_validade']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_numero'] != $rsServidorAtualizacaoDocumento['cnh_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['cnh_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['reg_prof_dt_validade'] != $rsServidorAtualizacaoDocumento['reg_prof_dt_validade']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['reg_militar_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_categoria'] != $rsServidorAtualizacaoDocumento['cnh_categoria']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Categoria</td>
            <td><?= $rsServidorAtualizacaoDocumento['cnh_categoria'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_dt_emissao'] != $rsServidorAtualizacaoDocumento['cnh_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Órgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_dt_validade'] != $rsServidorAtualizacaoDocumento['cnh_dt_validade']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Data de validade</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_validade']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['cnh_dt_primeira_habilitacao'] != $rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - CNH - Data da primeira habilitação</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rne_numero'] != $rsServidorAtualizacaoDocumento['rne_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RNE - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['rne_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rne_dt_emissao'] != $rsServidorAtualizacaoDocumento['rne_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RNE - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoDocumento['rne_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['rne_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['rne_orgao_expedidor']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - RNE - Órgão expedidor</td>
            <td><?= $rsServidorAtualizacaoDocumento['rne_orgao_expedidor'] ;?></td>
          </tr>
          <?php
        }
        // if($rsServidorDocumento['fgts_numero'] != $rsServidorAtualizacaoDocumento['fgts_numero']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - FGTS - Número</td>
            <td><?= $rsServidorAtualizacaoDocumento['fgts_numero'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorDocumento['fgts_opcao'] != $rsServidorAtualizacaoDocumento['fgts_opcao']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - FGTS - Opção</td>
            <td><?= $rsServidorAtualizacaoDocumento['fgts_opcao'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorDocumento['fgts_conta_vinculada_banco'] != $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - FGTS - Conta bancária vinculada</td>
            <td><?= $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorDocumento['fgts_dt_retificacao'] != $rsServidorAtualizacaoDocumento['fgts_dt_retificacao']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - FGTS - Retificação</td>
            <td><?= $rsServidorAtualizacaoDocumento['fgts_dt_retificacao'] ;?></td>
          </tr> -->
          <?php
        // }
        if($rsServidorDocumento['estrangeiro_casado_brasileiro'] != $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Casado com brasileiro(a)</td>
            <td><?= $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></td>
          </tr>
          <?php
        }
        if($rsServidorDocumento['estrangeiro_filho_brasileiro'] != $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> DOCUMENTO - Tem filho brasileiro(a)</td>
            <td><?= $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></td>
          </tr>
          <?php
        }
        $countIntrucoes = 0;
        if (sizeof($rsServidorAtualizacaoInstrucoes) > 0) {
          foreach ($rsServidorAtualizacaoInstrucoes as $kObjInstrucao => $vObjInstrucao) {
            $countIntrucoes ++;
            if($rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['escolaridade_nome'] != $vObjInstrucao['escolaridade_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> INSTRUÇÃO - <?= $countIntrucoes; ?> - Escolaridade</td>
                <td><?= $vObjInstrucao['escolaridade_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['formacao'] != $vObjInstrucao['formacao']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> INSTRUÇÃO - <?= $countIntrucoes; ?> - Formação</td>
                <td><?= $vObjInstrucao['formacao'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['conclusao_ano'] != $vObjInstrucao['conclusao_ano']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> INSTRUÇÃO - <?= $countIntrucoes; ?> - Ano de Conclusão</td>
                <td><?= $vObjInstrucao['conclusao_ano'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['cursando'] != $vObjInstrucao['cursando']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> INSTRUÇÃO - <?= $countIntrucoes; ?> - Cursando</td>
                <td><?= $vObjInstrucao['cursando'] ;?></td>
              </tr>
              <?php
            }
          }
        }
        if($rsServidorFamiliar['bsc_estado_civil_id'] != $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Estado civil</td>
            <td><?= $rsServidorAtualizacaoFamiliar['estado_civil_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_dt_casamento'] != $rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Data de casamento</td>
            <td><?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_nome'] != $rsServidorAtualizacaoFamiliar['conjuge_nome']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Nome do cônjuge</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_cpf'] != $rsServidorAtualizacaoFamiliar['conjuge_cpf']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - CPF do cônjuge</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_cpf'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_dt_nascimento'] != $rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Data de nascimento do cônjuge</td>
            <td><?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_natural_bsc_pais_id'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Nacionalidade do cônjuge</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_nacionalidade'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_natural_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Naturalidade do cônjuge</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_municipio_nome'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Naturalidade do cônjuge extrangeiro (cidade)</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_natural_estrangeiro_estado'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Naturalidade do cônjuge estrangeiro (estado)</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['conjuge_local_trabalho'] != $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Dados civis - Local de trabalho do cônjuge</td>
            <td><?= $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_numero'] != $rsServidorAtualizacaoFamiliar['reg_civil_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Número</td>
            <td><?= $rsServidorAtualizacaoFamiliar['reg_civil_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_livro'] != $rsServidorAtualizacaoFamiliar['reg_civil_livro']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Livro</td>
            <td><?= $rsServidorAtualizacaoFamiliar['reg_civil_livro'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_folha'] != $rsServidorAtualizacaoFamiliar['reg_civil_folha']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Folha</td>
            <td><?= $rsServidorAtualizacaoFamiliar['reg_civil_folha'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_cartorio'] != $rsServidorAtualizacaoFamiliar['reg_civil_cartorio']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Cartório</td>
            <td><?= $rsServidorAtualizacaoFamiliar['reg_civil_cartorio'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_dt_emissao'] != $rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['reg_civil_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Registro civil - Cidade</td>
            <td><?= $rsServidorAtualizacaoFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['reg_civil_estado_sigla'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['averbacao_tipo'] != $rsServidorAtualizacaoFamiliar['averbacao_tipo']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Averbação - Tipo</td>
            <td><?= $rsServidorAtualizacaoFamiliar['averbacao_tipo'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['averbacao_numero'] != $rsServidorAtualizacaoFamiliar['averbacao_numero']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Averbação - Número</td>
            <td><?= $rsServidorAtualizacaoFamiliar['averbacao_numero'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['averbacao_dt_emissao'] != $rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Averbação - Data de emissão</td>
            <td><?= data_volta($rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']) ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['averbacao_cartorio'] != $rsServidorAtualizacaoFamiliar['averbacao_cartorio']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Averbação - Cartório</td>
            <td><?= $rsServidorAtualizacaoFamiliar['averbacao_cartorio'] ;?></td>
          </tr>
          <?php
        }
        if($rsServidorFamiliar['averbacao_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['averbacao_bsc_municipio_id']) {
          ?>
          <tr>
            <td><i class="fal fa-check"></i> FAMÍLIA - Averbação - Número</td>
            <td><?= $rsServidorAtualizacaoFamiliar['averbacao_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['averbacao_estado_sigla'] ;?></td>
          </tr>
          <?php
        }
        $countDependentes = 0;
        if (sizeof($rsServidorAtualizacaoDependentes) > 0) {
          foreach ($rsServidorAtualizacaoDependentes as $kObjDependente => $vObjDependente) {
            $countDependentes ++;
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['codigo'] != $vObjDependente['codigo']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Código</td>
                <td><?= $vObjDependente['codigo'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['nome'] != $vObjDependente['nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Nome</td>
                <td><?= $vObjDependente['nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['bsc_parentesco_grau_id'] != $vObjDependente['bsc_parentesco_grau_id']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Grau de parentesco</td>
                <td><?= $vObjDependente['parentesco_grau_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_outro'] != $vObjDependente['parentesco_grau_outro']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Grau de parentesco (outro)</td>
                <td><?= $vObjDependente['parentesco_grau_outro'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_nascimento'] != $vObjDependente['dt_nascimento']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Data de nascimento</td>
                <td><?= data_volta($vObjDependente['dt_nascimento']) ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_casamento'] != $vObjDependente['dt_casamento']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - Data de casamento</td>
                <td><?= data_volta($vObjDependente['dt_casamento']) ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_autos_numero'] != $vObjDependente['benef_autos_numero']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - NÚMERO DOS AUTOS</td>
                <td><?= $vObjDependente['benef_autos_numero'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_numero'] != $vObjDependente['benef_rg_numero']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - NÚMERO</td>
                <td><?= $vObjDependente['benef_rg_numero'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_dt_emissao'] != $vObjDependente['benef_rg_dt_emissao']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - DATA DE EMISSÃO</td>
                <td><?= data_volta($vObjDependente['benef_rg_dt_emissao']) ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_orgao_expedidor'] != $vObjDependente['benef_rg_orgao_expedidor']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - ÓRGÃO EXPEDIDOR</td>
                <td><?= $vObjDependente['benef_rg_orgao_expedidor'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_residencial'] != $vObjDependente['benef_tel_residencial']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TELEFONE RESIDENCIAL</td>
                <td><?= $vObjDependente['benef_tel_residencial'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_celular'] != $vObjDependente['benef_tel_celular']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TELEFONE CELULAR</td>
                <td><?= $vObjDependente['benef_tel_celular'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_logradouro'] != $vObjDependente['benef_end_logradouro']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - LOGRADOURO</td>
                <td><?= $vObjDependente['benef_end_logradouro'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_numero'] != $vObjDependente['benef_end_numero']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - NÚMERO</td>
                <td><?= $vObjDependente['benef_end_numero'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_complemento'] != $vObjDependente['benef_end_complemento']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - COMPLEMENTO</td>
                <td><?= $vObjDependente['benef_end_complemento'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_bairro'] != $vObjDependente['benef_end_bairro']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - BAIRRO</td>
                <td><?= $vObjDependente['benef_end_bairro'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_cep'] != $vObjDependente['benef_end_cep']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - CEP</td>
                <td><?= $vObjDependente['benef_end_cep'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_estado_nome'] != $vObjDependente['benef_estado_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - ESTADO</td>
                <td><?= $vObjDependente['benef_estado_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_municipio_nome'] != $vObjDependente['benef_municipio_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - MUNICÍPIO</td>
                <td><?= $vObjDependente['benef_municipio_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_conta_tipo_nome'] != $vObjDependente['benef_banco_conta_tipo_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TIPO DE CONTA BANCÁRIA</td>
                <td><?= $vObjDependente['benef_banco_conta_tipo_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_nome'] != $vObjDependente['benef_banco_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - BANCO</td>
                <td><?= $vObjDependente['benef_banco_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_agencia'] != $vObjDependente['benef_bancario_agencia']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - AGÊNCIA</td>
                <td><?= $vObjDependente['benef_bancario_agencia'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_conta'] != $vObjDependente['benef_bancario_conta']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - CONTA</td>
                <td><?= $vObjDependente['benef_bancario_conta'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_op'] != $vObjDependente['benef_bancario_op']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - OPERAÇÃO/VARIAÇÃO</td>
                <td><?= $vObjDependente['benef_bancario_op'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_nome'] != $vObjDependente['benef_repres_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - NOME</td>
                <td><?= $vObjDependente['benef_repres_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_cpf'] != $vObjDependente['benef_repres_cpf']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - CPF</td>
                <td><?= $vObjDependente['benef_repres_cpf'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_numero'] != $vObjDependente['benef_repres_rg_numero']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - NÚMERO</td>
                <td><?= $vObjDependente['benef_repres_rg_numero'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_dt_emissao'] != $vObjDependente['benef_repres_rg_dt_emissao']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - DATA DE EMISSÃO</td>
                <td><?= data_volta($vObjDependente['benef_repres_rg_dt_emissao']) ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_orgao_expedidor'] != $vObjDependente['benef_repres_rg_orgao_expedidor']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - ÓRGÃO EXPEDIDOR</td>
                <td><?= $vObjDependente['benef_repres_rg_orgao_expedidor'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_residencial'] != $vObjDependente['benef_repres_tel_residencial']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - TELEFONE RESIDENCIAL</td>
                <td><?= $vObjDependente['benef_repres_tel_residencial'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_celular'] != $vObjDependente['benef_repres_tel_celular']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - TELEFONE CELULAR</td>
                <td><?= $vObjDependente['benef_repres_tel_celular'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_logradouro'] != $vObjDependente['benef_repres_end_logradouro']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - LOGRADOURO</td>
                <td><?= $vObjDependente['benef_repres_end_logradouro'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_numero'] != $vObjDependente['benef_repres_end_numero']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - NÚMERO</td>
                <td><?= $vObjDependente['benef_repres_end_numero'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_complemento'] != $vObjDependente['benef_repres_end_complemento']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - COMPLEMENTO</td>
                <td><?= $vObjDependente['benef_repres_end_complemento'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_bairro'] != $vObjDependente['benef_repres_end_bairro']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - BAIRRO</td>
                <td><?= $vObjDependente['benef_repres_end_bairro'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_cep'] != $vObjDependente['benef_repres_end_cep']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - CEP</td>
                <td><?= $vObjDependente['benef_repres_end_cep'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_estado_nome'] != $vObjDependente['benef_repres_estado_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - ESTADO</td>
                <td><?= $vObjDependente['benef_repres_estado_nome'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_municipio_nome'] != $vObjDependente['benef_repres_municipio_nome']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - MUNICÍPIO</td>
                <td><?= $vObjDependente['benef_repres_municipio_nome'] ;?></td>
              </tr>
              <?php
            }
          }
        }
        // if($rsServidorBancario['bancario_bsc_banco_id'] != $rsServidorAtualizacaoBancario['bancario_bsc_banco_id']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DADOS BANCÁRIOS - Tipo de conta</td>
            <td><?= $rsServidorAtualizacaoBancario['conta_tipo_nome'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorBancario['bancario_agencia'] != $rsServidorAtualizacaoBancario['bancario_agencia']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DADOS BANCÁRIOS - Agência</td>
            <td><?= $rsServidorAtualizacaoBancario['conta_tipo_nome'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorBancario['bancario_conta'] != $rsServidorAtualizacaoBancario['bancario_conta']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DADOS BANCÁRIOS - Conta</td>
            <td><?= $rsServidorAtualizacaoBancario['bancario_conta'] ;?></td>
          </tr> -->
          <?php
        // }
        // if($rsServidorBancario['bancario_op'] != $rsServidorAtualizacaoBancario['bancario_op']) {
          ?>
          <!-- <tr>
            <td><i class="fal fa-check"></i> DADOS BANCÁRIOS - Operação/Variação</td>
            <td><?= $rsServidorAtualizacaoBancario['bancario_op'] ;?></td>
          </tr> -->
          <?php
        // }
        $countVinculos = 0;
        if (sizeof($rsServidorAtualizacaoVinculos) > 0) {
          foreach ($rsServidorAtualizacaoVinculos as $kObjVinculo => $vObjVinculo) {
            $countVinculos ++;
            if($rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local'] != $vObjVinculo['local']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> Vínculo - <?= $countVinculos; ?> - Local</td>
                <td><?= $vObjVinculo['local'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['esfera'] != $vObjVinculo['esfera']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> Vínculo - <?= $countVinculos; ?> - Esfera</td>
                <td><?= $vObjVinculo['esfera'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['cargo'] != $vObjVinculo['cargo']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> Vínculo - <?= $countVinculos; ?> - Cargo</td>
                <td><?= $vObjVinculo['cargo'] ;?></td>
              </tr>
              <?php
            }
            if($rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['carga_horaria'] != $vObjVinculo['carga_horaria']) {
              ?>
              <tr>
                <td><i class="fal fa-check"></i> Vínculo - <?= $countVinculos; ?> - Carga horária</td>
                <td><?= $vObjVinculo['carga_horaria'] ;?></td>
              </tr>
              <?php
            }
          }
        }
        ?>
      </tbody>
    </table>
    <p><strong>IMPORTANTE : Sua atualização será concluída após a validação das informações pelo Setor de Recursos Humano da Secretaria 
    Municipal de Administração.</strong></p>
    <p><strong>Esse comprovante permanecerá em sua área de usuário para consulta a qualquer momento.</strong></p>
    
    <div class="authenticator">
      <p>Código de Autenticidade:</p>
      <span><?= $rsServidorAtualizacao['autenticacao'] ;?></span>
    </div>
  </div>
  <footer>
    <div class="logo">
      <img src="<?= ASSETS_FOLDER ;?>images/zatu-logo.svg" alt="">
    </div>
    <div class="text">
      <p>Copyright © Prefeitura Municipal de Tarauacá - Desenvolvido por Wessix Tecnologia e Inovação</p>
    </div>
  </footer>
</body>
</html>
<!-- JAVASCRIPT PLUGINS BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>vendors.min.js"></script>
<script type="text/javascript" src="<?= ICONS_FOLDER; ?>feather-icons/feather.min.js"></script> 
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/progressbar.js-master/dist/progressbar.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/formatter/jquery.formatter.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-mask-1.14/jquery.mask.js"></script>
<!-- <script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script> -->
<!-- <script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/sweetalert/sweetalert.min.js"></script> -->
<!-- <script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>livequery-1.3.6/livequery.min.js"></script> -->
<!-- JAVASCRIPT PLUGINS END-->
<!-- JAVASCRIPT UTILS BEGIN -->
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>projeto.utils.js"></script>
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>utils.js"></script>
<!-- JAVASCRIPT UTILS END -->
<!-- JAVASCRIPT CUSTON BEGIN -->
<!-- <script type="text/javascript" src="<?= JS_FOLDER; ?>template.js"></script> -->
<!-- <script type="text/javascript" src="<?= JS_FOLDER; ?>demo.js"></script> -->
<!-- <script type="text/javascript" src="<?= JS_FOLDER; ?>control/sacad/servidor_atualizacao/cadastrar.js"></script> -->
  <!-- JAVASCRIPT CUSTON END -->