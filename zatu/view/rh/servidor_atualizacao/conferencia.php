<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
if(!sizeof($rsPermiteConferir) > 0) {
  echo "
  <script 'text/javascript'>
  alert('O seu usuário não tem permissão para acessar esta página!')
  window.location = '" . PORTAL_URL . "dashboard';
  </script>
  ";
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
  FROM rh_servidor AS s 
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
  WHERE s.id = ?;");
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
$stmt->bindValue(1, $id);
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
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?= PORTAL_URL; ?>view/rh/servidor_atualizacao/dashboard">Atualizações de servidores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Conferência</li>
          </ol>
        </nav>
      </div>
    </div>
    <section class="content">
      <form id="form_conferencia" class="" name="form_conferencia" method="post" action="">
        <input type="hidden" id="servidor_id" name="servidor_id" value="<?= $id ;?>">
        <input type="hidden" id="servidor_atualizacao_id" name="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id'] ;?>">
        <input type="hidden" id="servidor_atualizacao_prova_id" name="servidor_atualizacao_prova_id" value="<?= $rsServidorAtualizacaoProva['id'] ;?>">
        <input type="hidden" id="conferencia_situacao" name="conferencia_situacao" value="1">
        <div class="box">
          <div class="box-header bg-primary">
            <h4 class="box-title font-weight-bold">
              <div class="d-flex align-items-center justify-content-between">
                <div class="icon bg-primary rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
                <span id="titulo_form">CONFERÊNCIA DE ATUALIZAÇÃO CADASTRAL DE SERVIDOR</span>
              </div>
            </h4>
          </div>
          <div id="div_atualiza_servidor" class="box-body">

            <div class="row mt-40">
              <div class="col-md-12 text-center">
                <h4>Auteticação <br>
                  <strong><?= $rsServidorAtualizacao['autenticacao']; ?></strong>
                </h4>
              </div>
            </div>

            <hr>
            <h3>PESSOAIS</h3>

            <div class="div_agrupador box box-outline-primary">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> PESSOAL</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_rg'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rg']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>

              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>MATRÍCULA: </small>
                    <span><?= $rsServidor['matricula'] ;?><?= $rsServidor['matricula_2'] != '' ? (' / '.$rsServidor['matricula_2']) : '';?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CPF: </small>
                    <span><?= $rsServidor['cpf'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE NASCIMENTO: </small>
                    <span><?= data_volta($rsServidor['dt_nascimento']) ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-8">
                    <small>NOME: <?= $rsServidor['nome'] ;?></small>
                    <span class="<?= $rsServidor['nome'] != $rsServidorAtualizacao['nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['nome'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NOME SOCIAL: <?= $rsServidor['nome_social'] ;?></small>
                    <span class="<?= $rsServidor['nome_social'] != $rsServidorAtualizacao['nome_social'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['nome_social'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>SEXO: <?= $rsServidor['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></small>
                    <span class="<?= $rsServidor['sexo'] != $rsServidorAtualizacao['sexo'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></span>
                  </div>
                  <div class="col-md-4">
                    <small>TIPO SANGUÍNEO: <?= $rsServidor['sangue_tipo'] ;?></small>
                    <span class="<?= $rsServidor['sangue_tipo'] != $rsServidorAtualizacao['sangue_tipo'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['sangue_tipo'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>RAÇA: <?= $rsServidor['raca'] ;?></small>
                    <span class="<?= $rsServidor['raca'] != $rsServidorAtualizacao['raca'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['raca'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-header">
                <h5 class="mb-0"><strong> FILIAÇÃO</strong></h5>
              </div>
              <div class="box-body view">
                <div class="row mt-10">
                  <div class="col-md-8">
                    <small>NOME DO PAI: <?= $rsServidor['pai_nome'] ;?></small>
                    <span class="<?= $rsServidor['pai_nome'] != $rsServidorAtualizacao['pai_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['pai_nome'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NACIONALIDADE DO PAI: <?= $rsServidor['pai_nacionalidade_nome'] ;?></small>
                    <span class="<?= $rsServidor['pai_natural_bsc_pais_id'] != $rsServidorAtualizacao['pai_natural_bsc_pais_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['pai_nacionalidade_nome'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>PROFISSÃO DO PAI: <?= $rsServidor['pai_profissao'] ;?></small>
                    <span class="<?= $rsServidor['pai_profissao'] != $rsServidorAtualizacao['pai_profissao'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['pai_profissao'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-8">
                    <small>NOME DA MÃE: <?= $rsServidor['mae_nome'] ;?></small>
                    <span class="<?= $rsServidor['mae_nome'] != $rsServidorAtualizacao['mae_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['mae_nome'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NACIONALIDADE DA MÃE: <?= $rsServidor['mae_nacionalidade_nome'] ;?></small>
                    <span class="<?= $rsServidor['mae_natural_bsc_pais_id'] != $rsServidorAtualizacao['mae_natural_bsc_pais_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['mae_nacionalidade_nome'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>PROFISSÃO DA MÃE: <?= $rsServidor['mae_profissao'] ;?></small>
                    <span class="<?= $rsServidor['mae_profissao'] != $rsServidorAtualizacao['mae_profissao'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['mae_profissao'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_pessoal">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_pessoal_aceita" name="situacao_pessoal" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_pessoal'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_pessoal_recusa" name="situacao_pessoal" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_pessoal'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_pessoal">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_pessoal" name="obs_pessoal" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_pessoal']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> NACIONALIDADE</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_rg'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rg']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NACIONALIDADE: <?= $rsServidor['nacionalidade_nome'] ;?></small>
                    <span class="<?= $rsServidor['natural_bsc_pais_id'] != $rsServidorAtualizacao['natural_bsc_pais_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['nacionalidade_nome'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NATURALIDADE: <?= $rsServidor['natural_municipio_nome'].' - '.$rsServidor['natural_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidor['natural_bsc_municipio_id'] != $rsServidorAtualizacao['natural_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['natural_municipio_nome'].' - '.$rsServidorAtualizacao['natural_estado_sigla']; ?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE INGRESSO NO BRASIL: <?= data_volta($rsServidor['natural_estrangeiro_dt_ingresso']);; ?></small>
                    <span class="<?= $rsServidor['natural_estrangeiro_dt_ingresso'] != $rsServidorAtualizacao['natural_estrangeiro_dt_ingresso'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['natural_estrangeiro_dt_ingresso']); ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>NATURALIDADE/CIDADE: <?= $rsServidor['natural_estrangeiro_cidade'] ;?></small>
                    <span class="<?= $rsServidor['natural_estrangeiro_cidade'] != $rsServidorAtualizacao['natural_estrangeiro_cidade'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['natural_estrangeiro_cidade'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NATURALIDADE/ESTADO: <?= $rsServidor['natural_estrangeiro_estado'] ;?></small>
                    <span class="<?= $rsServidor['natural_estrangeiro_estado'] != $rsServidorAtualizacao['natural_estrangeiro_estado'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['natural_estrangeiro_estado'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CONDIÇÃO DE TRABALHO: <?= $rsServidor['natural_estrangeiro_condicao_trabalho'] ;?></small>
                    <span class="<?= $rsServidor['natural_estrangeiro_condicao_trabalho'] != $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-header">
                <h5 class="mb-0"><strong> VINCULO ESTRANGEIRO</strong></h5>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>CASADO COM BRASILEIRO(A)?: <?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></small>
                    <span class="<?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] != $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>TEM FILHO BRASILEIRO(A): <?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></small>
                    <span class="<?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] != $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_naturalidade">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_naturalidade_aceita" name="situacao_naturalidade" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_naturalidade'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_naturalidade_recusa" name="situacao_naturalidade" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_naturalidade'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_naturalidade">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_naturalidade" name="obs_naturalidade" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_naturalidade']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> LOCAL DE TRABALHO 1</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_situacao_trabalho'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_situacao_trabalho']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                if ($rsServidorAtestacaoMatricula['atestacao_matricula'] == 1) {
                  ?>
                  <div class="alert alert-success mt-10 mb-0 pl-5">Vínculo do servidor aceito pelo chefe imediato: <strong> <?= $rsServidorAtestacaoMatricula['usuario_nome'] ;?></strong></div>
                  <?php
                }
                if ($rsServidorAtestacaoMatricula['atestacao_matricula'] == 2) {
                  ?>
                  <div class="alert alert-warning mt-10 mb-0 pl-5">Vínculo do servidor recusado pelo chefe imediato: <strong> <?= $rsServidorAtestacaoMatricula['usuario_nome'] ;?></strong></div>
                  <div class="row mt-2">
                    <div class="col-md-2">
                      <div class="alert alert-warning mb-0 pl-5 form-group">
                        <span>MOTIVO: </span>
                      </div>
                    </div>
                    <div class="col-md-10">
                      <div class="alert alert-warning mb-0 pl-5 form-group">
                        <span><?= $rsServidorAtestacaoMatricula['obs'] ;?></span>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-3">
                    <small>MATRÍCULA: </small>
                    <span><?= $rsServidor['matricula']; ?></span>
                  </div>
                  <div class="col-md-9">
                    <small>EMPREGADOR: <?= $rsServidor['empregador_razao_social']. ($rsServidor['empregador_fantasia'] != '' ? (' - '.$rsServidor['empregador_fantasia']) : ''); ?></small>
                    <span class="<?= $rsServidor['eo_empregador_id'] != $rsServidorAtualizacao['eo_empregador_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['empregador_razao_social']. ($rsServidorAtualizacao['empregador_fantasia'] != '' ? (' - '.$rsServidorAtualizacao['empregador_fantasia']) : ''); ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>SECRETARIA E SETOR ATUAL DE LOTAÇÃO: <?= $rsServidor['uo_nome'] != NULL ? ('<b>'.$rsServidor['uo_nome'].':</b> '.$rsServidor['setor_nome']) : '';?></small>
                    <span class="<?= $rsServidor['eo_setor_id'] != $rsServidorAtualizacao['eo_setor_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['uo_nome'] != NULL ? ('<b>'.$rsServidorAtualizacao['uo_nome'].':</b> '.$rsServidorAtualizacao['setor_nome']) : ''; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>TIPO DE CONTRATO: <?= $rsServidor['serv_tipo_nome'] ;?></small>
                    <span class="<?= $rsServidor['rh_servidor_tipo_id'] != $rsServidorAtualizacao['rh_servidor_tipo_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['serv_tipo_nome'] ;?></span>
                  </div>
                  <div class="col-md-6">
                    <small>CARGO:  <?= $rsServidor['cargo_nome'] ;?></small>
                    <span class="<?= $rsServidor['eo_cargo_id'] != $rsServidorAtualizacao['eo_cargo_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['cargo_nome'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>SITUAÇÃO ATUAL DE TRABALHO: <?= $rsServidor['sit_trab_nome'];?></small>
                    <span class="<?= $rsServidor['rh_situacao_trabalho_id'] != $rsServidorAtualizacao['rh_situacao_trabalho_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['sit_trab_nome']; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>NÚMERO DO DECRETO/PORTARIA: <?= $rsServidor['situacao_trabalho_decreto']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto'] != $rsServidorAtualizacao['situacao_trabalho_decreto'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_decreto']; ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>NÚMERO DO DOE (Diário Oficial do Estado): <?= $rsServidor['situacao_trabalho_doe']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_doe'] != $rsServidorAtualizacao['situacao_trabalho_doe'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_doe']; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>DATA INÍCIO DA SITUAÇÃO ATUAL: <?= data_volta($rsServidor['situacao_trabalho_dt_inicio']); ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto'] != $rsServidorAtualizacao['situacao_trabalho_decreto'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio']); ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>DATA FIM DA SITUAÇÃO ATUAL: <?= data_volta($rsServidor['situacao_trabalho_dt_fim']); ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto'] != $rsServidorAtualizacao['situacao_trabalho_decreto'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim']); ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>OBSERVAÇÃO DA SITUAÇÃO ATUAL: <?= $rsServidor['situacao_trabalho_obs']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_obs'] != $rsServidorAtualizacao['situacao_trabalho_obs'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_obs']; ?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_situacao_trabalho">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_situacao_trabalho_aceita" name="situacao_situacao_trabalho" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_situacao_trabalho_recusa" name="situacao_situacao_trabalho" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_situacao_trabalho">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_situacao_trabalho" name="obs_situacao_trabalho" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> LOCAL DE TRABALHO 2</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_situacao_trabalho_2'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_situacao_trabalho_2']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                if ($rsServidorAtestacaoMatricula2['atestacao_matricula_2'] == 1) {
                  ?>
                  <div class="alert alert-success mt-10 mb-0 pl-5">Vínculo do servidor aceito pelo chefe imediato: <strong><?= $rsServidorAtestacaoMatricula2['usuario_nome'] ;?></strong></div>
                  <?php
                }
                if ($rsServidorAtestacaoMatricula2['atestacao_matricula_2'] == 2) {
                  ?>
                  <div class="alert alert-warning mt-10 mb-0 pl-5">Vínculo do servidor recusado pelo chefe imediato: <strong><?= $rsServidorAtestacaoMatricula2['usuario_nome'] ;?></strong></div>
                  <div class="row mt-2">
                    <div class="col-md-2">
                      <div class="form-group alert alert-warning mb-0 pl-5">
                        <span>MOTIVO: </span>
                      </div>
                    </div>
                    <div class="col-md-10">
                      <div class="form-group alert alert-warning mb-0 pl-5">
                        <span><?= $rsServidorAtestacaoMatricula2['obs'] ;?></span>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-3">
                    <small>MATRÍCULA: </small>
                    <span><?= $rsServidor['matricula_2']; ?></span>
                  </div>
                  <div class="col-md-9">
                    <small>EMPREGADOR: <?= $rsServidor['empregador_razao_social_2']. ($rsServidor['empregador_fantasia_2'] != '' ? (' - '.$rsServidor['empregador_fantasia_2']) : ''); ?></small>
                    <span class="<?= $rsServidor['eo_empregador_id_2'] != $rsServidorAtualizacao['eo_empregador_id_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['empregador_razao_social_2']. ($rsServidorAtualizacao['empregador_fantasia_2'] != '' ? (' - '.$rsServidorAtualizacao['empregador_fantasia_2']) : ''); ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>SECRETARIA E SETOR ATUAL DE LOTAÇÃO: <?= $rsServidor['uo_nome_2'] != NULL ? ('<b>'.$rsServidor['uo_nome_2'].':</b> '.$rsServidor['setor_nome_2']) : '';?></small>
                    <span class="<?= $rsServidor['eo_setor_id_2'] != $rsServidorAtualizacao['eo_setor_id_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['uo_nome_2'] != NULL ? ('<b>'.$rsServidorAtualizacao['uo_nome_2'].':</b> '.$rsServidorAtualizacao['setor_nome_2']) : ''; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>TIPO DE CONTRATO: <?= $rsServidor['serv_tipo_nome_2'] ;?></small>
                    <span class="<?= $rsServidor['rh_servidor_tipo_id_2'] != $rsServidorAtualizacao['rh_servidor_tipo_id_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['serv_tipo_nome_2'] ;?></span>
                  </div>
                  <div class="col-md-6">
                    <small>CARGO:  <?= $rsServidor['cargo_nome_2'] ;?></small>
                    <span class="<?= $rsServidor['eo_cargo_id_2'] != $rsServidorAtualizacao['eo_cargo_id_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['cargo_nome_2'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>SITUAÇÃO ATUAL DE TRABALHO: <?= $rsServidor['sit_trab_nome_2'];?></small>
                    <span class="<?= $rsServidor['rh_situacao_trabalho_id_2'] != $rsServidorAtualizacao['rh_situacao_trabalho_id_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['sit_trab_nome_2']; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>NÚMERO DO DECRETO/PORTARIA: <?= $rsServidor['situacao_trabalho_decreto_2']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto_2'] != $rsServidorAtualizacao['situacao_trabalho_decreto_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_decreto_2']; ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>NÚMERO DO DOE (Diário Oficial do Estado): <?= $rsServidor['situacao_trabalho_doe_2']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_doe_2'] != $rsServidorAtualizacao['situacao_trabalho_doe_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_doe_2']; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>DATA INÍCIO DA SITUAÇÃO ATUAL: <?= data_volta($rsServidor['situacao_trabalho_dt_inicio_2']); ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto_2'] != $rsServidorAtualizacao['situacao_trabalho_decreto_2'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio_2']); ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>DATA FIM DA SITUAÇÃO ATUAL: <?= data_volta($rsServidor['situacao_trabalho_dt_fim']); ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_decreto_2'] != $rsServidorAtualizacao['situacao_trabalho_decreto_2'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim_2']); ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>OBSERVAÇÃO DA SITUAÇÃO ATUAL: <?= $rsServidor['situacao_trabalho_obs_2']; ?></small>
                    <span class="<?= $rsServidor['situacao_trabalho_obs_2'] != $rsServidorAtualizacao['situacao_trabalho_obs_2'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['situacao_trabalho_obs_2']; ?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_situacao_trabalho_2">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_situacao_trabalho_aceita_2" name="situacao_situacao_trabalho_2" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_situacao_trabalho_recusa_2" name="situacao_situacao_trabalho_2" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_situacao_trabalho_2">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_situacao_trabalho_2" name="obs_situacao_trabalho_2" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho_2']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> VACINA - COVID-19</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_covid_vacina'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_covid_vacina']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-6">
                    <small>NOME: <?= $rsServidor['covid_vacina_nome']; ?></small>
                    <span class="<?= $rsServidor['covid_vacina_nome'] != $rsServidorAtualizacao['covid_vacina_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['covid_vacina_nome']; ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>DOSE: <?= $rsServidor['covid_vacina_dose'];?></small>
                    <span class="<?= $rsServidor['covid_vacina_dose'] != $rsServidorAtualizacao['covid_vacina_dose'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['covid_vacina_dose']; ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>LOTE: <?= $rsServidor['covid_vacina_lote'];?></small>
                    <span class="<?= $rsServidor['covid_vacina_lote'] != $rsServidorAtualizacao['covid_vacina_lote'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['covid_vacina_lote']; ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>DATA: <?= data_volta($rsServidor['covid_vacina_data']); ?></small>
                    <span class="<?= $rsServidor['covid_vacina_data'] != $rsServidorAtualizacao['covid_vacina_data'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacao['covid_vacina_data']); ?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>ENDEREÇO: <?= $rsServidor['covid_vacina_endereco']; ?></small>
                    <span class="<?= $rsServidor['covid_vacina_endereco'] != $rsServidorAtualizacao['covid_vacina_endereco'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['covid_vacina_endereco']; ?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_covid_vacina">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_covid_vacina_aceita" name="situacao_covid_vacina" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_covid_vacina_recusa" name="situacao_covid_vacina" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_covid_vacina">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_covid_vacina" name="obs_covid_vacina" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_covid_vacina']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> SAÚDE</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_enfermidade'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_enfermidade']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-8">
                    <small>ENFERMEDADE PORTADA: <?= $rsServidor['enfermidade_portador'] ;?></small>
                    <span class="<?= $rsServidor['enfermidade_portador'] != $rsServidorAtualizacao['enfermidade_portador'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['enfermidade_portador'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CÓD. INTER. DA ENFERMEDADE: <?= $rsServidor['enfermidade_codigo_internacional'] ;?></small>
                    <span class="<?= $rsServidor['enfermidade_codigo_internacional'] != $rsServidorAtualizacao['enfermidade_codigo_internacional'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacao['enfermidade_codigo_internacional'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_enfermidade">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_enfermidade_aceita" name="situacao_enfermidade" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_enfermidade'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_enfermidade_recusa" name="situacao_enfermidade" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_enfermidade'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_enfermidade">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_enfermidade" name="obs_enfermidade" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_enfermidade']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>
            <h3>CONTATOS</h3>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> ENDEREÇO</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_end'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_end']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-10">
                    <small>LOGRADOURO: <?= $rsServidorContato['end_logradouro'] ;?></small>
                    <span class="<?= $rsServidorContato['end_logradouro'] != $rsServidorAtualizacaoContato['end_logradouro'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_logradouro'] ;?></span>
                  </div>
                  <div class="col-md-2">
                    <small>NÚMERO: <?= $rsServidorContato['end_numero'] ;?></small>
                    <span class="<?= $rsServidorContato['end_numero'] != $rsServidorAtualizacaoContato['end_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_numero'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>COMPLEMENTO: <?= $rsServidorContato['end_complemento'] ;?></small>
                    <span class="<?= $rsServidorContato['end_complemento'] != $rsServidorAtualizacaoContato['end_complemento'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_complemento'] ;?></span>
                  </div>
                  <div class="col-md-6">
                    <small>BAIRRO: <?= $rsServidorContato['end_bairro'] ;?></small>
                    <span class="<?= $rsServidorContato['end_bairro'] != $rsServidorAtualizacaoContato['end_bairro'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_bairro'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>CEP: <?= $rsServidorContato['end_cep'] ;?></small>
                    <span class="<?= $rsServidorContato['end_cep'] != $rsServidorAtualizacaoContato['end_cep'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_cep'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ESTADO: <?= $rsServidorContato['end_estado_nome'].' - '.$rsServidorContato['end_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidorContato['end_estado_id'] != $rsServidorAtualizacaoContato['end_estado_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_estado_nome'].' - '.$rsServidorAtualizacaoContato['end_estado_sigla']; ?></span>
                  </div>
                  <div class="col-md-4">
                    <small>MUNICÍPIO: <?= $rsServidorContato['end_municipio_nome'] ;?></small>
                    <span class="<?= $rsServidorContato['end_bsc_municipio_id'] != $rsServidorAtualizacaoContato['end_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['end_municipio_nome'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-header">
                <h5 class="mb-0"><strong> CONTATO ELETRÔNICO</strong></h5>
              </div>
              <div class="box-body view">
                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>E-MAIL INSTITUCIONAL: <?= $rsServidorContato['email_institucional'] ;?></small>
                    <span class="<?= $rsServidorContato['email_institucional'] != $rsServidorAtualizacaoContato['email_institucional'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['email_institucional'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>E-MAIL PESSOAL: <?= $rsServidorContato['email_pessoal'] ;?></small>
                    <span class="<?= $rsServidorContato['email_pessoal'] != $rsServidorAtualizacaoContato['email_pessoal'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['email_pessoal'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>E-MAIL ALTERNATIVO: <?= $rsServidorContato['email_alternativo'] ;?></small>
                    <span class="<?= $rsServidorContato['email_alternativo'] != $rsServidorAtualizacaoContato['email_alternativo'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['email_alternativo'] ;?></span>
                  </div>
                </div>
              </div>  
              <div class="box-header">
                <h5 class="mb-0"><strong> NÚMEROS DE CONTATO</strong></h5>
              </div>
              <div class="box-body view">
                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>TELEFONE RESIDENCIAL: <?= $rsServidorContato['tel_residencial'] ;?></small>
                    <span class="<?= $rsServidor['tel_residencial'] != $rsServidorAtualizacao['tel_residencial'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['tel_residencial']; ?></span>
                  </div>
                  <div class="col-md-4">
                    <small>TELEFONE CELULAR: <?= $rsServidorContato['tel_celular'] ;?></small>
                    <span class="<?= $rsServidorContato['tel_celular'] != $rsServidorAtualizacaoContato['tel_celular'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['tel_celular']; ?></span>
                  </div>
                </div>
              </div>  
              <div class="box-header">
                <h5 class="mb-0"><strong> CONTATO PARA RECADO</strong></h5>
              </div>
              <div class="box-body view">
                <div class="row mt-10">
                  <div class="col-md-3">
                    <small>TELEFONE PARA RECADO: <?= $rsServidorContato['tel_recado'] ;?></small>
                    <span class="<?= $rsServidorContato['tel_recado'] != $rsServidorAtualizacaoContato['tel_recado'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['tel_recado']; ?></span>
                  </div>
                  <div class="col-md-6">
                    <small>NOME DO CONTATO DE RECADO PARA O SERVIDOR: <?= $rsServidorContato['tel_recado_nome'] ;?></small>
                    <span class="<?= $rsServidorContato['tel_recado_nome'] != $rsServidorAtualizacaoContato['tel_recado_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['tel_recado_nome']; ?></span>
                  </div>
                  <div class="col-md-3">
                    <small>GRAU DE PARENTESCO: <?= $rsServidorContato['tel_recado_parentesco_grau_nome'] ;?></small>
                    <span class="<?= $rsServidorContato['tel_recado_bsc_parentesco_grau_id'] != $rsServidorAtualizacaoContato['tel_recado_bsc_parentesco_grau_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['tel_recado_parentesco_grau_nome'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-3">
                    <small>CONTATO EMERGENCIAL: <?= $rsServidorContato['contato_emergencia_tel'] ;?></small>
                    <span class="<?= $rsServidorContato['contato_emergencia_tel'] != $rsServidorAtualizacaoContato['contato_emergencia_tel'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['contato_emergencia_tel'] ;?></span>
                  </div>
                  <div class="col-md-9">
                    <small>NOME DO CONTATO DE EMERGÊNCIA DO SERVIDOR: <?= $rsServidorContato['contato_emergencia_nome'] ;?></small>
                    <span class="<?= $rsServidorContato['contato_emergencia_nome'] != $rsServidorAtualizacaoContato['contato_emergencia_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['contato_emergencia_nome'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>ENDEREÇO COMPLETO: <?= $rsServidorContato['contato_emergencia_end'] ;?></small>
                    <span class="<?= $rsServidorContato['contato_emergencia_end'] != $rsServidorAtualizacaoContato['contato_emergencia_end'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoContato['contato_emergencia_end'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_end">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_end_aceita" name="situacao_end" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_end'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_end_recusa" name="situacao_end" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_end'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_end">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_end" name="obs_end" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_end']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>
            <h3>DOCUMENTOS</h3>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> REGISTRO GERAL (RG)</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_rg'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rg']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['rg_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['rg_numero'] != $rsServidorAtualizacaoDocumento['rg_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['rg_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE EMISSAO: <?= data_volta($rsServidorDocumento['rg_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['rg_dt_emissao'] != $rsServidorAtualizacaoDocumento['rg_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['rg_dt_emissao']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['rg_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['rg_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['rg_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['rg_orgao_expedidor'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_rg">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_rg_aceita" name="situacao_rg" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_rg'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_rg_recusa" name="situacao_rg" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_rg'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_rg">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_rg" name="obs_rg" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_rg']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> PIS/PASEP</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_pis'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_pis']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['pis_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_numero'] != $rsServidorAtualizacaoDocumento['pis_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['pis_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE CADASTRO: <?= data_volta($rsServidorDocumento['pis_dt_cadastro']) ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_dt_cadastro'] != $rsServidorAtualizacaoDocumento['pis_dt_cadastro'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['pis_dt_cadastro']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DOMICILIO BANCARIO: <?= $rsServidorDocumento['pis_domicilio_bancario'] ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_domicilio_bancario'] != $rsServidorAtualizacaoDocumento['pis_domicilio_bancario'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['pis_domicilio_bancario'] ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>NÚMERO DO BANCO: <?= $rsServidorDocumento['pis_banco_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_banco_numero'] != $rsServidorAtualizacaoDocumento['pis_banco_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['pis_banco_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>AGENCIA BANCÁRIA: <?= $rsServidorDocumento['pis_agencia'] ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_agencia'] != $rsServidorAtualizacaoDocumento['pis_agencia'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['pis_agencia'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ENDEREÇO DA AGENCIA: <?= $rsServidorDocumento['pis_agencia_end'] ;?></small>
                    <span class="<?= $rsServidorDocumento['pis_agencia_end'] != $rsServidorAtualizacaoDocumento['pis_agencia_end'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['pis_agencia_end'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_pis">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_pis_aceita" name="situacao_pis" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_pis'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_pis_recusa" name="situacao_pis" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_pis'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_pis">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_pis" name="obs_pis" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_pis']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> CARTEIRA DE TRABALHO E PREVICÊNCIA SOCIAL</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_ctps'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_ctps']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['ctps_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['ctps_numero'] != $rsServidorAtualizacaoDocumento['ctps_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['ctps_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>SÉRIE: <?= $rsServidorDocumento['ctps_serie'] ;?></small>
                    <span class="<?= $rsServidorDocumento['ctps_serie'] != $rsServidorAtualizacaoDocumento['ctps_serie'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['ctps_serie'] ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>DATA DE EMISSÃO: <?= data_volta($rsServidorDocumento['ctps_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['ctps_dt_emissao'] != $rsServidorAtualizacaoDocumento['ctps_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['ctps_dt_emissao']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['ctps_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['ctps_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ANO DO PRIMEIRO EMPREGO: <?= $rsServidorDocumento['ctps_primeiro_emprego_ano'] ;?></small>
                    <span class="<?= $rsServidorDocumento['ctps_primeiro_emprego_ano'] != $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_ctps">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_ctps_aceita" name="situacao_ctps" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_ctps'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_ctps_recusa" name="situacao_ctps" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_ctps'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_ctps">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_ctps" name="obs_ctps" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_ctps']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> TÍTULO DE ELEITOR</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_eleitor'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_eleitor']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['eleitor_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['eleitor_numero'] != $rsServidorAtualizacaoDocumento['eleitor_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['eleitor_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ZONA: <?= $rsServidorDocumento['eleitor_zona'] ;?></small>
                    <span class="<?= $rsServidorDocumento['eleitor_zona'] != $rsServidorAtualizacaoDocumento['eleitor_zona'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['eleitor_zona'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>SEÇÃO: <?= $rsServidorDocumento['eleitor_secao'] ;?></small>
                    <span class="<?= $rsServidorDocumento['eleitor_secao'] != $rsServidorAtualizacaoDocumento['eleitor_secao'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['eleitor_secao'] ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>CIDADE: <?= $rsServidorDocumento['eleitor_municipio_nome'].' - '.$rsServidorDocumento['eleitor_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidorDocumento['eleitor_bsc_municipio_id'] != $rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['eleitor_municipio_nome'].' - '.$rsServidorAtualizacaoDocumento['eleitor_estado_sigla']; ?></span>
                  </div>
                  <div class="col-md-4">
                    <small>INSCRIÇÃO EM ÓRGÃO DE CLASSE: <?= $rsServidorDocumento['eleitor_insc_orgao_classe'] ;?></small>
                    <span class="<?= $rsServidorDocumento['eleitor_insc_orgao_classe'] != $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_eleitor">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_eleitor_aceita" name="situacao_eleitor" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_eleitor'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_eleitor_recusa" name="situacao_eleitor" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_eleitor'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_eleitor">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_eleitor" name="obs_eleitor" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_eleitor']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> REGISTRO MILITAR</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_reg_militar'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_militar']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['reg_militar_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_militar_numero'] != $rsServidorAtualizacaoDocumento['reg_militar_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_militar_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CATEGORIA: <?= $rsServidorDocumento['reg_militar_categoria'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_militar_categoria'] != $rsServidorAtualizacaoDocumento['reg_militar_categoria'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_militar_categoria'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ANO DE EMISSÃO: <?= $rsServidorDocumento['reg_militar_emissao_ano'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_militar_emissao_ano'] != $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano'] ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['reg_militar_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_militar_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ESPÉCIE: <?= $rsServidorDocumento['reg_militar_especie'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_militar_especie'] != $rsServidorAtualizacaoDocumento['reg_militar_especie'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_militar_especie'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_reg_militar">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_reg_militar_aceita" name="situacao_reg_militar" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_militar'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_reg_militar_recusa" name="situacao_reg_militar" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_militar'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_reg_militar">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_reg_militar" name="obs_reg_militar" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_reg_militar']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong>REGISTRO PROFISSIONAL</strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_reg_prof'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_prof']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['reg_prof_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_prof_numero'] != $rsServidorAtualizacaoDocumento['reg_prof_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_prof_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE EMISSÃO: <?= data_volta($rsServidorDocumento['reg_prof_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_prof_dt_emissao'] != $rsServidorAtualizacaoDocumento['reg_prof_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['reg_prof_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_prof_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor'] ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>DATA DE VALIDADE: <?= data_volta($rsServidorDocumento['reg_prof_dt_validade']) ;?></small>
                    <span class="<?= $rsServidorDocumento['reg_prof_dt_validade'] != $rsServidorAtualizacaoDocumento['reg_prof_dt_validade'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_validade']) ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_reg_prof">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_reg_prof_aceita" name="situacao_reg_prof" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_prof'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_reg_prof_recusa" name="situacao_reg_prof" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_prof'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_reg_prof">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_reg_prof" name="obs_reg_prof" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_reg_prof']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> CARTEIRA NACIONAL DE HABILITAÇÃO </strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_cnh'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_cnh']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['cnh_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_numero'] != $rsServidorAtualizacaoDocumento['cnh_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['cnh_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CATEGORIA: <?= $rsServidorDocumento['cnh_categoria'] ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_categoria'] != $rsServidorAtualizacaoDocumento['cnh_categoria'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['cnh_categoria'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE EMISSÃO: <?= data_volta($rsServidorDocumento['cnh_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_dt_emissao'] != $rsServidorAtualizacaoDocumento['cnh_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_emissao']) ;?></span>
                  </div>
                </div>

                <div class="row mt-10">
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['cnh_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE VALIDADE: <?= data_volta($rsServidorDocumento['cnh_dt_validade']) ;?></small>]) ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_dt_validade'] != $rsServidorAtualizacaoDocumento['cnh_dt_validade'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_validade']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DA PRIMEIRA HABILITAÇÃO: <?= data_volta($rsServidorDocumento['cnh_dt_primeira_habilitacao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['cnh_dt_primeira_habilitacao'] != $rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']) ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_cnh">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_cnh_aceita" name="situacao_cnh" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_cnh'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_cnh_recusa" name="situacao_cnh" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_cnh'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_cnh">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_cnh" name="obs_cnh" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_cnh']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> REGISTRO NACIONAL DE ESTRANGEIRO </strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_rne'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rne']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorDocumento['rne_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['rne_numero'] != $rsServidorAtualizacaoDocumento['rne_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['rne_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE EMISSÃO: <?= data_volta($rsServidorDocumento['rne_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['rne_dt_emissao'] != $rsServidorAtualizacaoDocumento['rne_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['rne_dt_emissao']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>ÓRGÃO EXPEDIDOR: <?= $rsServidorDocumento['rne_orgao_expedidor'] ;?></small>
                    <span class="<?= $rsServidorDocumento['rne_orgao_expedidor'] != $rsServidorAtualizacaoDocumento['rne_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['rne_orgao_expedidor'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_rne">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_rne_aceita" name="situacao_rne" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_rne'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_rne_recusa" name="situacao_rne" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_rne'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_rne">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_rne" name="obs_rne" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_rne']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> FGTS </strong></h5>
                <div class="div_link alert alert-primary mt-5 mb-0">
                  <?php if ($rsServidorAtualizacaoProva['prova_fgts'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_fgts']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
                </div>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-3">
                    <small>NÚMERO: <?= $rsServidorDocumento['fgts_numero'] ;?></small>
                    <span class="<?= $rsServidorDocumento['fgts_numero'] != $rsServidorAtualizacaoDocumento['fgts_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['fgts_numero'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>OPÇÃO: <?= $rsServidorDocumento['fgts_opcao'] ;?></small>
                    <span class="<?= $rsServidorDocumento['fgts_opcao'] != $rsServidorAtualizacaoDocumento['fgts_opcao'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['fgts_opcao'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>CONTA BANCÁRIA VINCULADA: <?= $rsServidorDocumento['fgts_conta_vinculada_banco'] ;?></small>
                    <span class="<?= $rsServidorDocumento['fgts_conta_vinculada_banco'] != $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>CONTA BANCÁRIA VINCULADA: <?= data_volta($rsServidorDocumento['fgts_dt_retificacao']) ;?></small>
                    <span class="<?= $rsServidorDocumento['fgts_dt_retificacao'] != $rsServidorAtualizacaoDocumento['fgts_dt_retificacao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoDocumento['fgts_dt_retificacao']) ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_fgts">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_fgts_aceita" name="situacao_fgts" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_fgts'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_fgts_recusa" name="situacao_fgts" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_fgts'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_fgts">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_fgts" name="obs_fgts" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_fgts']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <hr>
            <h3>INSTRUÇÕES</h3>

            <?php
            $countIntrucoes = 0;
            if (sizeof($rsServidorAtualizacaoInstrucoes) > 0) {
              foreach ($rsServidorAtualizacaoInstrucoes as $kObjInstrucao => $vObjInstrucao) {
                $countIntrucoes ++;
                ?>

                <div class="div_agrupador box box-outline-primary mt-20">
                  <div class="div_prova box-header">
                    <h5 class="mb-0"><strong> INSTRUÇÃO - <?= $countIntrucoes; ?></strong></h5>
                    <?php if ($vObjInstrucao['prova_instrucao'] != '') {
                      $comprovantes = explode('#&#', $vObjInstrucao['prova_instrucao']);
                      foreach ($comprovantes as $kObj => $vObj) {
                        ?>
                        <div class="div_link alert alert-primary mt-5 mb-0">
                          <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="box-body view">
                    <div class="row">
                      <div class="col-md-4">
                        <small>ESCOLARIDADE: <?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['escolaridade_nome']; ?></small>
                        <span class="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['escolaridade_nome'] != $vObjInstrucao['escolaridade_nome'] ? 'text-danger' : '' ;?>"><?= $vObjInstrucao['escolaridade_nome'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>FORMAÇÃO: <?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['formacao'] ;?></small>
                        <span class="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['formacao'] != $vObjInstrucao['formacao'] ? 'text-danger' : '' ;?>"><?= $vObjInstrucao['formacao'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>ANO DE CONCLUSÃO: <?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['conclusao_ano'] ;?></small>
                        <span class="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['conclusao_ano'] != $vObjInstrucao['conclusao_ano'] ? 'text-danger' : '' ;?>"><?= $vObjInstrucao['conclusao_ano'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>CURSANDO?: <?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['cursando'] == '1' ? 'Sim' : 'Não' ;?></small>
                        <span class="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['cursando'] != $vObjInstrucao['cursando'] ? 'text-danger' : '' ;?>"><?= $vObjInstrucao['cursando'] == '1' ? 'Sim' : 'Não' ;?></span>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="situacao_instrucao">Conferência: </label>
                          <div class="form-group ichack-input mt-10">
                            <label>
                              <input type="radio" id="situacao_instrucao_aceita_<?= $countIntrucoes; ?>" name="situacao_instrucao_<?= $countIntrucoes; ?>" class="square-purple" <?= $vObjInstrucao['situacao_instrucao'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                            </label>
                            <label>
                              <input type="radio" id="situacao_instrucao_recusa_<?= $countIntrucoes; ?>" name="situacao_instrucao_<?= $countIntrucoes; ?>" class="square-purple" <?= $vObjInstrucao['situacao_instrucao'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="obs_instrucao">Observação: </label>
                          <div class="input-group mb-3 controls">
                            <textarea class="form-control" id="obs_instrucao_<?= $countIntrucoes; ?>" name="obs_instrucao_<?= $countIntrucoes; ?>" placeholder="Observações sobre a conferência"><?= $vObjInstrucao['obs_instrucao']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
              }
            }
            ?>

            <hr>
            <h3>FAMÍLIARES</h3>


            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> DADOS CIVIS </strong></h5>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>ESTADO CIVIL: <?= $rsServidorFamiliar['estado_civil_nome'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['bsc_estado_civil_id'] != $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['estado_civil_nome'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE CASAMENTO: <?= data_volta($rsServidorFamiliar['conjuge_dt_casamento']) ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_dt_casamento'] != $rsServidorAtualizacaoFamiliar['conjuge_dt_casamento'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']) ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-6">
                    <small>NOME DO CÔNJUGE: <?= $rsServidorFamiliar['conjuge_nome'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_nome'] != $rsServidorAtualizacaoFamiliar['conjuge_nome'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_nome'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>CPF DO CÔNJUGE: <?= $rsServidorFamiliar['conjuge_cpf'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_cpf'] != $rsServidorAtualizacaoFamiliar['conjuge_cpf'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_cpf'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>DATA DE NASCIMENTO DO CÔNJUGE: <?= data_volta($rsServidorFamiliar['conjuge_dt_nascimento']) ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_dt_nascimento'] != $rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']) ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-3">
                    <small>NACIONALIDADE DO CÔNJUGE: <?= $rsServidorFamiliar['conjuge_natural_nacionalidade'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_nacionalidade'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>NATURALIDADE DO CÔNJUGE: <?= $rsServidorFamiliar['conjuge_natural_municipio_nome'].' - '.$rsServidorFamiliar['conjuge_natural_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_natural_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['conjuge_natural_estado_sigla'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>CIDADE DO CÔNJUGE ESTRANGEIRO: <?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade'] ;?></span>
                  </div>
                  <div class="col-md-3">
                    <small>ESTADO DO CÔNJUGE ESTRANGEIRO: <?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado'] != $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>LOCAL DE TRABALHO DO CÔNJUGE: <?= $rsServidorFamiliar['conjuge_local_trabalho'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['conjuge_local_trabalho'] != $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-header">
                <h5 class="mb-0"><strong> REGISTRO CIVIL </strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_reg_civil'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_civil']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorFamiliar['reg_civil_numero'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_numero'] != $rsServidorAtualizacaoFamiliar['reg_civil_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['reg_civil_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>LIVRO: <?= $rsServidorFamiliar['reg_civil_livro'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_livro'] != $rsServidorAtualizacaoFamiliar['reg_civil_livro'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['reg_civil_livro'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>FOLHA: <?= $rsServidorFamiliar['reg_civil_folha'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_folha'] != $rsServidorAtualizacaoFamiliar['reg_civil_folha'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['reg_civil_folha'] ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-12">
                    <small>CARTÓRIO: <?= $rsServidorFamiliar['reg_civil_cartorio'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_cartorio'] != $rsServidorAtualizacaoFamiliar['reg_civil_cartorio'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['reg_civil_cartorio'] ;?></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <small>DATA DE EXPEDIÇÃO: <?= data_volta($rsServidorFamiliar['reg_civil_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_dt_emissao'] != $rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']) ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CIDADE: <?= $rsServidorFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorFamiliar['reg_civil_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['reg_civil_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['reg_civil_estado_sigla'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_reg_civil">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_reg_civil_aceita" name="situacao_reg_civil" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_civil'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_reg_civil_recusa" name="situacao_reg_civil" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_reg_civil'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_reg_civil">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_reg_civil" name="obs_reg_civil" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_reg_civil']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="div_agrupador box box-outline-primary mt-20">
              <div class="div_prova box-header">
                <h5 class="mb-0"><strong> AVERBAÇÃO </strong></h5>
                <?php if ($rsServidorAtualizacaoProva['prova_averbacao'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_averbacao']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <div class="div_link alert alert-primary mt-5 mb-0">
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
              <div class="box-body view">
                <div class="row">
                  <div class="col-md-4">
                    <small>TIPO: <?= $rsServidorFamiliar['averbacao_tipo'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['averbacao_tipo'] != $rsServidorAtualizacaoFamiliar['averbacao_tipo'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['averbacao_tipo'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>NÚMERO: <?= $rsServidorFamiliar['averbacao_numero'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['averbacao_numero'] != $rsServidorAtualizacaoFamiliar['averbacao_numero'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['averbacao_numero'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>DATA DE EXPEDIÇÃO: <?= data_volta($rsServidorFamiliar['averbacao_dt_emissao']) ;?></small>
                    <span class="<?= $rsServidorFamiliar['averbacao_dt_emissao'] != $rsServidorAtualizacaoFamiliar['averbacao_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']) ;?></span>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-8">
                    <small>CARTÓRIO: <?= $rsServidorFamiliar['averbacao_cartorio'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['averbacao_cartorio'] != $rsServidorAtualizacaoFamiliar['averbacao_cartorio'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['averbacao_cartorio'] ;?></span>
                  </div>
                  <div class="col-md-4">
                    <small>CIDADE: <?= $rsServidorFamiliar['averbacao_municipio_nome'].' - '.$rsServidorFamiliar['averbacao_estado_sigla'] ;?></small>
                    <span class="<?= $rsServidorFamiliar['averbacao_bsc_municipio_id'] != $rsServidorAtualizacaoFamiliar['averbacao_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $rsServidorAtualizacaoFamiliar['averbacao_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['averbacao_estado_sigla'] ;?></span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="situacao_averbacao">Conferência: </label>
                      <div class="form-group ichack-input mt-10">
                        <label>
                          <input type="radio" id="situacao_averbacao_aceita" name="situacao_averbacao" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_averbacao'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                        </label>
                        <label>
                          <input type="radio" id="situacao_averbacao_recusa" name="situacao_averbacao" class="square-purple" <?= $rsServidorAtualizacaoProva['situacao_averbacao'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="obs_averbacao">Observação: </label>
                      <div class="input-group mb-3 controls">
                        <textarea class="form-control" id="obs_averbacao" name="obs_averbacao" placeholder="Observações sobre a conferência"><?= $rsServidorAtualizacaoProva['obs_averbacao']; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>
            <h3>DEPENDENTES</h3>

            <?php
            $countDependentes = 0;
            if (sizeof($rsServidorAtualizacaoDependentes) > 0) {
              foreach ($rsServidorAtualizacaoDependentes as $kObjDependente => $vObjDependente) {
                $countDependentes ++;
                ?>
                <div class="div_agrupador box box-outline-primary mt-20">
                  <div class="div_prova box-header">
                    <h5 class="mb-0"><strong> DEPENDENTE - <?= $countDependentes; ?></strong></h5>
                    <?php if ($vObjDependente['prova_dependente'] != '') {
                      $comprovantes = explode('#&#', $vObjDependente['prova_dependente']);
                      foreach ($comprovantes as $kObj => $vObj) {
                        ?>
                        <div class="div_link alert alert-primary mt-5 mb-0">
                          <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="box-body view">
                    <div class="row">
                      <div class="col-md-4">
                        <small>CÓDIGO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['codigo'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['codigo'] != $vObjDependente['codigo'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['codigo'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-6">
                        <small>NOME: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['nome'] != $vObjDependente['nome'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['nome'] ;?></span>
                      </div>
                      <div class="col-md-3">
                        <small>GRAU PARENTESCO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['bsc_parentesco_grau_id'] != $vObjDependente['bsc_parentesco_grau_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['parentesco_grau_nome'] ;?></span>
                      </div>
                      <div class="col-md-3">
                        <small>OUTRO GRAU DE PARENTESCO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_outro'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_outro'] != $vObjDependente['parentesco_grau_outro'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['parentesco_grau_outro'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>CPF: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['cpf'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['cpf'] != $vObjDependente['cpf'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['cpf'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>DATA DE NASCIMENTO: <?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_nascimento']) ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_nascimento'] != $vObjDependente['dt_nascimento'] ? 'text-danger' : '' ;?>"><?= data_volta($vObjDependente['dt_nascimento']) ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>DATA DE CASAMENTO: <?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_casamento']) ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_casamento'] != $vObjDependente['dt_casamento'] ? 'text-danger' : '' ;?>"><?= data_volta($vObjDependente['dt_casamento']) ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-12">
                        <small>BENEFICIÁRIO DE PENSÃO - NÚMERO DOS AUTOS: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_autos_numero'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_autos_numero'] != $vObjDependente['benef_autos_numero'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_autos_numero'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - RG - NÚMERO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_numero'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_numero'] != $vObjDependente['benef_rg_numero'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_rg_numero'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - RG - DATA DE EMISSÃO: <?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_dt_emissao']) ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_dt_emissao'] != $vObjDependente['benef_rg_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($vObjDependente['benef_rg_dt_emissao']) ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - RG - ÓRGÃO EXPEDIDOR: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_orgao_expedidor'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_orgao_expedidor'] != $vObjDependente['benef_rg_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_rg_orgao_expedidor'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-6">
                        <small>BENEFICIÁRIO DE PENSÃO - TELEFONE RESIDENCIAL: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_residencial'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_residencial'] != $vObjDependente['benef_tel_residencial'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_tel_residencial'] ;?></span>
                      </div>
                      <div class="col-md-6">
                        <small>BENEFICIÁRIO DE PENSÃO - TELEFONE CELULAR: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_celular'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_celular'] != $vObjDependente['benef_tel_celular'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_tel_celular'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-9">
                        <small>BENEFICIÁRIO DE PENSÃO - LOGRADOURO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_logradouro'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_logradouro'] != $vObjDependente['benef_end_logradouro'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_end_logradouro'] ;?></span>
                      </div>
                      <div class="col-md-3">
                        <small>BENEFICIÁRIO DE PENSÃO - NÚMERO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_numero'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_numero'] != $vObjDependente['benef_end_numero'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_end_numero'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-7">
                        <small>BENEFICIÁRIO DE PENSÃO - COMPLEMENTO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_complemento'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_complemento'] != $vObjDependente['benef_end_complemento'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_end_complemento'] ;?></span>
                      </div>
                      <div class="col-md-5">
                        <small>BENEFICIÁRIO DE PENSÃO - BAIRRO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_bairro'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_bairro'] != $vObjDependente['benef_end_bairro'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_end_bairro'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - CEP: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_cep'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_cep'] != $vObjDependente['benef_end_cep'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_end_cep'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - ESTADO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_estado_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bsc_municipio_id'] != $vObjDependente['benef_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_estado_nome'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - MUNICÍPIO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_municipio_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bsc_municipio_id'] != $vObjDependente['benef_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_municipio_nome'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - TIPO DE CONTA BANCÁRIA: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_conta_tipo_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bsc_banco_conta_tipo_id'] != $vObjDependente['benef_bsc_banco_conta_tipo_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_banco_conta_tipo_nome'] ;?></span>
                      </div>
                      <div class="col-md-8">
                        <small>BENEFICIÁRIO DE PENSÃO - BANCO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bsc_banco_id'] != $vObjDependente['benef_bsc_banco_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_banco_nome'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - AGÊNCIA: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_agencia'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_agencia'] != $vObjDependente['benef_bancario_agencia'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_bancario_agencia'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - CONTA: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_conta'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_conta'] != $vObjDependente['benef_bancario_conta'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_bancario_conta'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>BENEFICIÁRIO DE PENSÃO - OPERAÇÃO/VARIAÇÃO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_op'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_op'] != $vObjDependente['benef_bancario_op'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_bancario_op'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-8">
                        <small>REPRESENTANTE - NOME: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_nome'] != $vObjDependente['benef_repres_nome'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_nome'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>REPRESENTANTE - CPF: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_cpf'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_cpf'] != $vObjDependente['benef_repres_cpf'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_cpf'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>REPRESENTANTE - RG - NÚMERO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_numero'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_numero'] != $vObjDependente['benef_repres_rg_numero'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_rg_numero'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>REPRESENTANTE - RG - DATA DE EMISSÃO: <?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_dt_emissao']) ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_dt_emissao'] != $vObjDependente['benef_repres_rg_dt_emissao'] ? 'text-danger' : '' ;?>"><?= data_volta($vObjDependente['benef_repres_rg_dt_emissao']) ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>REPRESENTANTE - RG - ÓRGÃO EXPEDIDOR: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_orgao_expedidor'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_orgao_expedidor'] != $vObjDependente['benef_repres_rg_orgao_expedidor'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_rg_orgao_expedidor'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-6">
                        <small>REPRESENTANTE - TELEFONE RESIDENCIAL: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_residencial'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_residencial'] != $vObjDependente['benef_repres_tel_residencial'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_tel_residencial'] ;?></span>
                      </div>
                      <div class="col-md-6">
                        <small>REPRESENTANTE - TELEFONE CELULAR: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_celular'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_celular'] != $vObjDependente['benef_repres_tel_celular'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_tel_celular'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-9">
                        <small>REPRESENTANTE - LOGRADOURO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_logradouro'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_logradouro'] != $vObjDependente['benef_repres_end_logradouro'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_end_logradouro'] ;?></span>
                      </div>
                      <div class="col-md-3">
                        <small>REPRESENTANTE - NÚMERO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_numero'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_numero'] != $vObjDependente['benef_repres_end_numero'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_end_numero'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-7">
                        <small>REPRESENTANTE - COMPLEMENTO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_complemento'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_complemento'] != $vObjDependente['benef_repres_end_complemento'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_end_complemento'] ;?></span>
                      </div>
                      <div class="col-md-5">
                        <small>REPRESENTANTE - BAIRRO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_bairro'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_bairro'] != $vObjDependente['benef_repres_end_bairro'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_end_bairro'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>REPRESENTANTE - CEP: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_cep'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_cep'] != $vObjDependente['benef_repres_end_cep'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_end_cep'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>REPRESENTANTE - ESTADO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_estado_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_bsc_municipio_id'] != $vObjDependente['benef_repres_estado_nome'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_estado_nome'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>REPRESENTANTE - MUNICÍPIO: <?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_municipio_nome'] ;?></small>
                        <span class="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_bsc_municipio_id'] != $vObjDependente['benef_repres_bsc_municipio_id'] ? 'text-danger' : '' ;?>"><?= $vObjDependente['benef_repres_municipio_nome'] ;?></span>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="situacao_dependente">Conferência: </label>
                          <div class="form-group ichack-input mt-10">
                            <label>
                              <input type="radio" id="situacao_dependente_aceita_<?= $countDependentes; ?>" name="situacao_dependente_<?= $countDependentes; ?>" class="square-purple" <?= $vObjDependente['situacao_dependente'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                            </label>
                            <label>
                              <input type="radio" id="situacao_dependente_recusa_<?= $countDependentes; ?>" name="situacao_dependente_<?= $countDependentes; ?>" class="square-purple" <?= $vObjDependente['situacao_dependente'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="obs_dependente">Observação: </label>
                          <div class="input-group mb-3 controls">
                            <textarea class="form-control" id="obs_dependente<?= $countDependentes; ?>" name="obs_dependente_<?= $countDependentes; ?>" placeholder="Observações sobre a conferência"><?= $vObjDependente['obs_dependente']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
              }
            }
            ?>

            <hr>
            <h3>VÍNCULOS</h3>

            <?php
            $countVinculos = 0;
            if (sizeof($rsServidorAtualizacaoVinculos) > 0) {
              foreach ($rsServidorAtualizacaoVinculos as $kObjVinculo => $vObjVinculo) {
                $countVinculos ++;
                ?>

                <div class="div_agrupador box box-outline-primary mt-20">
                  <div class="div_prova box-header">
                    <h5 class="mb-0"><strong> VÍNCULO - <?= $countVinculos; ?></strong></h5>
                    <?php if ($vObjVinculo['prova_vinculo'] != '') {
                      $comprovantes = explode('#&#', $vObjVinculo['prova_vinculo']);
                      foreach ($comprovantes as $kObj => $vObj) {
                        ?>
                        <div class="div_link alert alert-primary mt-5 mb-0">
                          <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="box-body view">
                    <div class="row">
                      <div class="col-md-12">
                        <small>LOCAL: <?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local'] ;?></small>
                        <span class="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local'] != $vObjVinculo['local'] ? 'text-danger' : '' ;?>"><?= $vObjVinculo['local'] ;?></span>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <small>ESFERA: <?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['esfera'] ;?></small>
                        <span class="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['esfera'] != $vObjVinculo['esfera'] ? 'text-danger' : '' ;?>"><?= $vObjVinculo['esfera'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>CARGO: <?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['cargo'] ;?></small>
                        <span class="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['cargo'] != $vObjVinculo['cargo'] ? 'text-danger' : '' ;?>"><?= $vObjVinculo['cargo'] ;?></span>
                      </div>
                      <div class="col-md-4">
                        <small>CARGA HORÁRIA: <?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['carga_horaria'] ;?></small>
                        <span class="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['carga_horaria'] != $vObjVinculo['carga_horaria'] ? 'text-danger' : '' ;?>"><?= $vObjVinculo['carga_horaria'] ;?></span>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="situacao_vinculo">Conferência: </label>
                          <div class="form-group ichack-input mt-10">
                            <label>
                              <input type="radio" id="situacao_vinculo_aceita_<?= $countVinculos; ?>" name="situacao_vinculo_<?= $countVinculos; ?>" class="square-purple" <?= $vObjVinculo['situacao_vinculo'] != '0' ? 'checked="checked"' : ''; ?> value="1"> Aceita
                            </label>
                            <label>
                              <input type="radio" id="situacao_vinculo_recusa_<?= $countVinculos; ?>" name="situacao_vinculo_<?= $countVinculos; ?>" class="square-purple" <?= $vObjVinculo['situacao_vinculo'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Recusada
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="obs_vinculo">Observação: </label>
                          <div class="input-group mb-3 controls">
                            <textarea class="form-control" id="obs_vinculo<?= $countVinculos; ?>" name="obs_vinculo_<?= $countVinculos; ?>" placeholder="Observações sobre a conferência"><?= $vObjVinculo['obs_vinculo']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>
            <div class="box-footer text-center mt-20">
              <button type="button" id="btn_cancelar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-eraser"></i> CANCELAR CONFERÊNCIA</button>
              <button type="button" id="btn_salvar"  class="btn_salvar btn btn-rounded btn-warning mr-1"  ><i class="ti-save-alt"></i> SALVAR E CONTINUAR CONFERÊNCIA</button>
              <button type="button" id="btn_finalizar" class="btn btn-rounded btn-success mr-1" >SALVAR E FINALIZAR CONFERÊNCIA <i class="ti-check"></i></button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_atualizacao/conferencia.js"></script>