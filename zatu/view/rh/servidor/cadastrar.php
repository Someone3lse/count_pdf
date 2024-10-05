<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
if ($id != 0) {
  $enableAllSteps = true;
}
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
  s.natural_bsc_municipio_id, 
  m.nome AS natural_municipio_nome, 
  e.sigla AS natural_estado_sigla, 
  s.natural_estrangeiro_dt_ingresso, 
  s.natural_estrangeiro_cidade, 
  s.natural_estrangeiro_estado, 
  s.natural_estrangeiro_condicao_trabalho, 
  s.pai_nome, 
  s.pai_natural_bsc_pais_id, 
  s.pai_profissao, 
  s.mae_nome, 
  s.mae_natural_bsc_pais_id, 
  s.mae_profissao, 
  s.matricula, 
  s.rh_servidor_tipo_id, 
  stipo.nome AS serv_tipo_nome, 
  s.eo_cargo_id, 
  c.nome AS cargo_nome, 
  s.eo_empregador_id, 
  s.eo_setor_unidade_organizacional_id, 
  suo.bsc_unidade_organizacional_id, 
  suo.eo_setor_id, 
  s.rh_situacao_trabalho_id, 
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
  s.eo_setor_unidade_organizacional_id_2, 
  suo2.bsc_unidade_organizacional_id AS bsc_unidade_organizacional_id_2, 
  suo2.eo_setor_id AS eo_setor_id_2, 
  s.rh_situacao_trabalho_id_2, 
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
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suo2 ON suo2.id = s.eo_setor_unidade_organizacional_id_2 
  LEFT JOIN rh_servidor_tipo AS stipo ON stipo.id = s.rh_servidor_tipo_id 
  LEFT JOIN rh_servidor_tipo AS stipo2 ON stipo2.id = s.rh_servidor_tipo_id_2 
  LEFT JOIN eo_cargo AS c ON c.id = s.eo_cargo_id 
  LEFT JOiN eo_cargo AS c2 ON c2.id = s.eo_cargo_id_2 
  WHERE s.id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidor = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidor)) {
  $rsServidor['id'] = 0;
  $rsServidor['nome'] = '';
  $rsServidor['nome_social'] = '';
  $rsServidor['cpf'] = '';
  $rsServidor['dt_nascimento'] = '';
  $rsServidor['sexo'] = '';
  $rsServidor['natural_bsc_pais_id'] = '';
  $rsServidor['natural_bsc_municipio_id'] = '';
  $rsServidor['natural_municipio_nome'] = '';
  $rsServidor['natural_estado_sigla'] = '';
  $rsServidor['natural_estrangeiro_dt_ingresso'] = '';
  $rsServidor['natural_estrangeiro_cidade'] = '';
  $rsServidor['natural_estrangeiro_estado'] = '';
  $rsServidor['natural_estrangeiro_condicao_trabalho'] = '';
  $rsServidor['pai_nome'] = '';
  $rsServidor['pai_natural_bsc_pais_id'] = '';
  $rsServidor['pai_profissao'] = '';
  $rsServidor['mae_nome'] = '';
  $rsServidor['mae_natural_bsc_pais_id'] = '';
  $rsServidor['mae_profissao'] = '';
  $rsServidor['matricula'] = '';
  $rsServidor['rh_servidor_tipo_id'] = '';
  $rsServidor['serv_tipo_nome'] = '';
  $rsServidor['eo_cargo_id'] = '';
  $rsServidor['cargo_nome'] = '';
  $rsServidor['eo_empregador_id'] = '';
  $rsServidor['eo_setor_unidade_organizacional_id'] = '';
  $rsServidor['bsc_unidade_organizacional_id'] = '';
  $rsServidor['eo_setor_id'] = '';
  $rsServidor['rh_situacao_trabalho_id'] = '';
  $rsServidor['situacao_trabalho_decreto'] = '';
  $rsServidor['situacao_trabalho_doe'] = '';
  $rsServidor['situacao_trabalho_dt_inicio'] = '';
  $rsServidor['situacao_trabalho_dt_fim'] = '';
  $rsServidor['situacao_trabalho_obs'] = '';
  $rsServidor['matricula_2'] = '';
  $rsServidor['rh_servidor_tipo_id_2'] = '';
  $rsServidor['serv_tipo_nome_2'] = '';
  $rsServidor['eo_cargo_id_2'] = '';
  $rsServidor['cargo_nome_2'] = '';
  $rsServidor['eo_empregador_id_2'] = '';
  $rsServidor['eo_setor_unidade_organizacional_id_2'] = '';
  $rsServidor['bsc_unidade_organizacional_id_2'] = '';
  $rsServidor['eo_setor_id_2'] = '';
  $rsServidor['rh_situacao_trabalho_id_2'] = '';
  $rsServidor['situacao_trabalho_decreto_2'] = '';
  $rsServidor['situacao_trabalho_doe_2'] = '';
  $rsServidor['situacao_trabalho_dt_inicio_2'] = '';
  $rsServidor['situacao_trabalho_dt_fim_2'] = '';
  $rsServidor['situacao_trabalho_obs_2'] = '';
  $rsServidor['foto'] = '';
  $rsServidor['sangue_tipo'] = '';
  $rsServidor['raca'] = '';
  $rsServidor['covid_vacina_nome'] = '';
  $rsServidor['covid_vacina_dose'] = '';
  $rsServidor['covid_vacina_lote'] = '';
  $rsServidor['covid_vacina_data'] = '';
  $rsServidor['covid_vacina_endereco'] = '';
  $rsServidor['enfermidade_portador'] = '';
  $rsServidor['enfermidade_codigo_internacional'] = '';
  $rsServidor['estado_id'] = '';
}
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
  e.sigla AS end_estado_sigla, 
  sc.tel_residencial, 
  sc.tel_celular, 
  sc.tel_recado, 
  sc.tel_recado_nome, 
  sc.tel_recado_bsc_parentesco_grau_id, 
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
  $rsServidorContato['end_estado_sigla'] = '';
  $rsServidorContato['tel_residencial'] = '';
  $rsServidorContato['tel_celular'] = '';
  $rsServidorContato['tel_recado'] = '';
  $rsServidorContato['tel_recado_nome'] = '';
  $rsServidorContato['tel_recado_bsc_parentesco_grau_id'] = '';
  $rsServidorContato['email_institucional'] = '';
  $rsServidorContato['email_pessoal'] = '';
  $rsServidorContato['email_alternativo'] = '';
  $rsServidorContato['contato_emergencia_nome'] = '';
  $rsServidorContato['contato_emergencia_end'] = '';
  $rsServidorContato['contato_emergencia_tel'] = '';
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
  sd.fgts_numero, 
  sd.fgts_opcao, 
  sd.fgts_conta_vinculada_banco, 
  sd.fgts_dt_retificacao, 
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
  $rsServidorDocumento['fgts_numero'] = '';
  $rsServidorDocumento['fgts_opcao'] = '';
  $rsServidorDocumento['fgts_conta_vinculada_banco'] = '';
  $rsServidorDocumento['fgts_dt_retificacao'] = '';
  $rsServidorDocumento['estrangeiro_casado_brasileiro'] = '';
  $rsServidorDocumento['estrangeiro_filho_brasileiro'] = '';
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
  ORDER BY si.bsc_escolaridade_id ASC, si.conclusao_ano ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorInstrucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sf.id, 
  sf.rh_servidor_id, 
  sf.bsc_estado_civil_id, 
  sf.conjuge_dt_casamento, 
  sf.conjuge_nome, 
  sf.conjuge_cpf, 
  sf.conjuge_dt_nascimento, 
  sf.conjuge_natural_bsc_pais_id, 
  sf.conjuge_natural_bsc_municipio_id, 
  m.nome AS conjuge_natural_municipio_nome, 
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
  ee.sigla AS reg_civil_estado_sigla, 
  sf.averbacao_tipo, 
  sf.averbacao_numero, 
  sf.averbacao_dt_emissao, 
  sf.averbacao_cartorio, 
  sf.averbacao_bsc_municipio_id, 
  mmm.nome AS averbacao_municipio_nome, 
  eee.sigla AS averbacao_estado_sigla 
  FROM rh_servidor_familiar AS sf  
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
  $rsServidorFamiliar['conjuge_dt_casamento'] = '';
  $rsServidorFamiliar['conjuge_nome'] = '';
  $rsServidorFamiliar['conjuge_cpf'] = '';
  $rsServidorFamiliar['conjuge_dt_nascimento'] = '';
  $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] = '';
  $rsServidorFamiliar['conjuge_natural_bsc_municipio_id'] = '';
  $rsServidorFamiliar['conjuge_natural_municipio_nome'] = '';
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
  $rsServidorFamiliar['reg_civil_estado_sigla'] = '';
  $rsServidorFamiliar['averbacao_tipo'] = '';
  $rsServidorFamiliar['averbacao_numero'] = '';
  $rsServidorFamiliar['averbacao_dt_emissao'] = '';
  $rsServidorFamiliar['averbacao_cartorio'] = '';
  $rsServidorFamiliar['averbacao_bsc_municipio_id'] = '';
  $rsServidorFamiliar['averbacao_municipio_nome'] = '';
  $rsServidorFamiliar['averbacao_estado_sigla'] = '';
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
  m.nome AS benef_municipio_nome, 
  e.id AS benef_estado_id, 
  e.nome AS benef_estado_nome, 
  e.sigla AS benef_estado_sigla, 
  sd.benef_bsc_banco_conta_tipo_id, 
  bct.nome AS benef_banco_conta_tipo_nome, 
  sd.benef_bsc_banco_id, 
  b.nome AS benef_banco_nome, 
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
  mm.nome AS benef_repres_municipio_nome, 
  ee.id AS benef_repres_estado_id, 
  ee.nome AS benef_repres_estado_nome, 
  ee.sigla AS benef_repres_estado_sigla, 
  sd.benef_repres_tel_residencial, 
  sd.benef_repres_tel_celular, 
  sd.status 
  FROM rh_servidor_dependente AS sd 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sd.bsc_parentesco_grau_id 
  LEFT JOIN bsc_municipio AS m ON m.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mm ON mm.id = sd.benef_repres_bsc_municipio_id 
  LEFT JOIN bsc_estado AS ee ON ee.id = mm.bsc_estado_id 
  LEFT JOIN bsc_banco_conta_tipo AS bct ON bct.id = sd.benef_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS b ON b.id = sd.benef_bsc_banco_id 
  WHERE sd.rh_servidor_id = ? 
  ORDER BY sd.nome ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sb.id, 
  sb.rh_servidor_id, 
  sb.bancario_bsc_banco_conta_tipo_id, 
  sb.bancario_bsc_banco_id, 
  sb.bancario_agencia, 
  sb.bancario_conta, 
  sb.bancario_op, 
  sb.status 
  FROM rh_servidor_bancario AS sb
  WHERE sb.rh_servidor_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorBancario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsServidorBancario)) {
  $rsServidorBancario['id'] = 0;
  $rsServidorBancario['rh_servidor_id'] = '';
  $rsServidorBancario['bancario_bsc_banco_conta_tipo_id'] = '';
  $rsServidorBancario['bancario_bsc_banco_id'] = '';
  $rsServidorBancario['bancario_agencia'] = '';
  $rsServidorBancario['bancario_conta'] = '';
  $rsServidorBancario['bancario_op'] = '';
  $rsServidorBancario['status'] = '';
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
  ORDER BY sv.local ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorVinculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  so.id, 
  so.dt_ocorrido, 
  so.descricao, 
  so.status 
  FROM rh_servidor_obs AS so 
  WHERE so.rh_servidor_id = ? 
  ORDER BY so.dt_ocorrido DESC, so.descricao ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorObss = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  ss.id, 
  ss.dt_ocorrido, 
  ss.descricao, 
  ss.dt_inicio, 
  ss.dt_fim, 
  ss.status 
  FROM rh_servidor_saude AS ss
  WHERE ss.rh_servidor_id = ?
  ORDER BY ss.dt_ocorrido DESC, ss.descricao ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorSaudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  nacionalidade, 
  masculino, 
  feminino 
  FROM bsc_pais 
  ORDER BY id ASC;");
$stmt->execute();
$rsPaises = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  sigla 
  FROM bsc_estado 
  ORDER BY nome ASC;");
$stmt->execute();
$rsEstados = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($id != 0) {
  $stmt = $db->prepare("
    SELECT 
    id, 
    nome 
    FROM bsc_municipio 
    WHERE bsc_estado_id = ? 
    ORDER BY nome ASC;");
  $stmt->bindValue(1, $rsServidorContato['end_estado_id']);
  $stmt->execute();
  $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($id != 0) {
  $stmt = $db->prepare("
    SELECT 
    id, 
    nome 
    FROM bsc_municipio 
    WHERE bsc_estado_id = ? 
    ORDER BY nome ASC;");
  $stmt->bindValue(1, $rsServidorContato['end_estado_id']);
  $stmt->execute();
  $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (sizeof($rsServidorDependentes) > 0) {
    foreach ($rsServidorDependentes as $kObj => $vObj) {
      $stmt = $db->prepare("
        SELECT 
        id, 
        nome 
        FROM bsc_municipio 
        WHERE bsc_estado_id = ? 
        ORDER BY nome ASC;");
      $stmt->bindValue(1, $vObj['benef_estado_id']);
      $stmt->execute();
      $rsServidorDependentes[$kObj]['benefMunicipios'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $db->prepare("
        SELECT 
        id, 
        nome 
        FROM bsc_municipio 
        WHERE bsc_estado_id = ? 
        ORDER BY nome ASC;");
      $stmt->bindValue(1, $vObj['benef_repres_estado_id']);
      $stmt->execute();
      $rsServidorDependentes[$kObj]['benefRepresMunicipios'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}
$stmt = $db->prepare("
  SELECT 
  id, 
  nome_razao_social, 
  nome_fantasia, 
  cnpj, 
  ie, 
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
  status 
  FROM eo_empregador 
  ORDER BY nome_razao_social ASC;");
$stmt->execute();
$rsEmpregadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  st.id AS id, 
  st.nome AS nome, 
  st.status AS status 
  FROM rh_servidor_tipo AS st 
  ORDER BY st.nome ASC;");
$stmt->execute();
$rsServidorTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  c.id AS id, 
  c.nome AS nome, 
  c.status AS status 
  FROM eo_cargo AS c 
  ORDER BY c.nome ASC;");
$stmt->execute();
$rsCargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  uo.id AS id, 
  uo.nome AS nome, 
  uo.status AS status 
  FROM bsc_unidade_organizacional AS uo 
  ORDER BY uo.nome ASC;");
$stmt->execute();
$rsUOs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT suo.id, s.numero, s.nome 
  FROM eo_setor_unidade_organizacional AS suo
  LEFT JOIN eo_setor AS s ON s.id = suo.eo_setor_id
  WHERE suo.bsc_unidade_organizacional_id = ? 
  GROUP BY suo.id 
  ORDER BY s.nome ASC;");
$stmt->bindValue(1, $rsServidor['bsc_unidade_organizacional_id']);
$stmt->execute();
$rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  exige_registro, 
  status, 
  dt_cadastro 
  FROM bsc_estado_civil
  ORDER BY nome ASC;");
$stmt->execute();
$rsEstadosCivis = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  status, 
  dt_cadastro 
  FROM rh_situacao_trabalho
  ORDER BY id ASC;");
$stmt->execute();
$rsSituacoesTrabalho = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id,
  nome, 
  grau, 
  status, 
  dt_cadastro 
  FROM bsc_parentesco_grau 
  WHERE status = 1 
  ORDER BY id ASC;");
$stmt->execute();
$rsParentescosGraus = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_banco_conta_tipo 
  ORDER BY nome ASC;");
$stmt->execute();
$rsBancoContaTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_escolaridade 
  ORDER BY id ASC;");
$stmt->execute();
$rsEscolaridades = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  codigo, 
  nome, 
  ispb, 
  status 
  FROM bsc_banco 
  WHERE status = 1 
  ORDER BY codigo ASC;");
$stmt->execute();
$rsBancos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?= PORTAL_URL; ?>view/rh/servidor/dashboard">Servidores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Servidor</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <input type="hidden" id="enableAllSteps" name="enableAllSteps" value="<?= $enableAllSteps ;?>">
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
              <span id="titulo_form"> <?= $id == 0 ? ' CADASTRO DO' : ' EDIÇÃO DO CADASTRO DO'; ?> SERVIDOR</span>
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>

        <div class="box-body wizard-content">
          <div id="div_servidor" class="tab-wizard vertical wizard-circle">
            <?php
            include_once ('view/rh/servidor/cadastrar_pessoal.php');
            include_once ('view/rh/servidor/cadastrar_contato.php');
            include_once ('view/rh/servidor/cadastrar_documento.php');
            include_once ('view/rh/servidor/cadastrar_instrucao.php');
            include_once ('view/rh/servidor/cadastrar_familiar.php');
            include_once ('view/rh/servidor/cadastrar_dependente.php');
            include_once ('view/rh/servidor/cadastrar_bancario.php');
            include_once ('view/rh/servidor/cadastrar_vinculo.php');
            include_once ('view/rh/servidor/cadastrar_contrato.php');
            include_once ('view/rh/servidor/cadastrar_obs.php');
            include_once ('view/rh/servidor/cadastrar_saude.php');
            ?>
          </div>
          <!-- </form> -->
          <div class="box-footer text-center">
            <button type="button" id="btn_voltar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-back-left"></i> Voltar</button>
            <button type="button" id="btn_cancelar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-eraser"></i> Cancelar</button>
            <button type="button" id="btn_anterior"  class="btn btn-rounded btn-info mr-1"    ><i class="ti-arrow-left"></i> Salvar e Retroceder</button>
            <button type="button" id="btn_proximo"   class="btn btn-rounded btn-info mr-1"    >Salvar e Avançar <i class="ti-arrow-right"></i></button>
            <button type="button" id="btn_finalizar" class="btn btn-rounded btn-success mr-1" >Salvar e Finalizar <i class="ti-check"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_pessoal.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_contato.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_documento.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_instrucao.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_familiar.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_dependente.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_bancario.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_vinculo.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_obs.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar_saude.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/cadastrar.js"></script>
<script type="text/javascript" src="<?= JS_FOLDER;  ?>validator_rmrosas.js"></script>