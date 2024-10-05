<?php
include_once ('template/servidor_topo.php');
include_once ('template/servidor_header.php');
include_once ('template/servidor_sidebar.php');
$enableAllSteps     = false;
$startIndexSteps    = 0;
$tipoAtualizacao  = isset($_POST['tipo']) ? $_POST['tipo'] : 2;
$id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['servidor_zatu_id'];
if (isset($_POST['startIndexSteps'])){
  $startIndexSteps  = $_POST['startIndexSteps'];
}
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  MAX(sa.id) AS id 
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN rh_servidor AS s ON s.id = sa.rh_servidor_id 
  WHERE 
  s.seg_servidor_id = ? 
  ");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsAtualizacaoUltima = $stmt->fetch(PDO::FETCH_ASSOC);
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
  WHERE s.seg_servidor_id = ?;");
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
  e.id AS estado_id, 
  s.rh_servidor_id, 
  s.tipo_atualizacao
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
  s.id IN ( 
    SELECT 
    MAX(sa.id) AS id
    FROM sacad_servidor_atualizacao AS sa 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
    LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
    WHERE 
    sa.rh_servidor_id = ? 
    AND (
      sa.status = 0 OR
      sas.sacad_situacao_servidor_atualizacao_id IN (1, 2, 5, 8, 10)
      )
    )
  ;");
$stmt->bindValue(1, $rsServidor['id']);
$stmt->bindValue(2, $rsServidor['id']);
$stmt->execute();
$rsServidorAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
if (is_array($rsServidorAtualizacao)){
  $tipoAtualizacao  = $rsServidorAtualizacao['tipo_atualizacao'];
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
  echo 'aaa'.end($rsServidorSituacao)['sacad_situacao_servidor_atualizacao_id'].'bbb';
  if (end($rsServidorSituacao)['sacad_situacao_servidor_atualizacao_id'] != 10) {
    $rsServidorAtualizacao['situacoes'] = $rsServidorSituacao;
    $rsServidorAtualizacao['situacaoServidorPrimeiro'] = $rsServidorSituacao[0];
    $rsServidorAtualizacao['situacaoServidorUltima'] = end($rsServidorSituacao);
  } else {
    $rsServidorAtualizacao = $rsServidor;
    $rsServidorAtualizacao['id'] = 0;
    $rsServidorAtualizacao['situacaoServidorUltima']['id'] = 1;
    $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] = 'Aguardando preenchimento total';
    $rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] = 0;
  }
} else {
  $rsServidorAtualizacao = $rsServidor;
  $rsServidorAtualizacao['id'] = 0;
  $rsServidorAtualizacao['situacaoServidorUltima']['id'] = 1;
  $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] = 'Aguardando preenchimento total';
  $rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] = 0;
}
if ($rsServidorAtualizacao['id'] != 0){
  $enableAllSteps = true;
}
if($rsAtualizacaoUltima['id'] != NULL){
  if($rsServidorAtualizacao['id'] != 0){
    if (!in_array($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'], [1, 2, 5, 8, 10, 11, 12, 13])) {
      ?>
      <script type="text/javascript">
        swal.fire('Atenção', 'Você não pode iniciar um novo precesso de recadastramento ou alteração de dados até finalizar um processo já existente!', 'warning');
        // alert("Você não pode iniciar um novo precesso de recadastramento ou alteração de dados até finalizar um processo já existente!");
        window.location.href = '<?=PORTAL_URL;?>servidor_dashboard';
      </script>
      <?php
    }
  }
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
  $rsServidorDocumento['ctps_primeiro_emprego_ano'] = NULL;
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
  sd.fgts_numero, 
  sd.fgts_opcao, 
  sd.fgts_conta_vinculada_banco, 
  sd.fgts_dt_retificacao, 
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
      'conclusao_ano' => NULL,
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
  sd.status, 
  sd.sacad_servidor_atualizacao_id, 
  sd.sacad_servidor_dependente_id_old, 
  sd.prova_dependente, 
  sd.situacao_dependente, 
  sd.obs_dependente 
  FROM sacad_servidor_atualizacao_dependente AS sd 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sd.bsc_parentesco_grau_id 
  LEFT JOIN bsc_municipio AS m ON m.id = sd.benef_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_municipio AS mm ON mm.id = sd.benef_repres_bsc_municipio_id 
  LEFT JOIN bsc_estado AS ee ON ee.id = mm.bsc_estado_id 
  LEFT JOIN bsc_banco_conta_tipo AS bct ON bct.id = sd.benef_bsc_banco_conta_tipo_id 
  LEFT JOIN bsc_banco AS b ON b.id = sd.benef_bsc_banco_id 
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
      'benef_municipio_nome' => '', 
      'benef_estado_id' => 0, 
      'benef_estado_nome' => '', 
      'benef_estado_sigla' => '', 
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
      'benef_repres_estado_id' => 0, 
      'benef_repres_municipio_nome' => '', 
      'benef_repres_estado_nome' => '', 
      'benef_repres_estado_sigla' => '', 
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
  sap.prova_fgts, 
  sap.situacao_fgts, 
  sap.obs_fgts, 
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
  $rsServidorAtualizacaoProva['prova_fgts'] = '';
  $rsServidorAtualizacaoProva['situacao_fgts'] = NULL;
  $rsServidorAtualizacaoProva['obs_fgts'] = '';
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
if ($rsServidorAtualizacao['id'] != 0) {
  $stmt = $db->prepare("
    SELECT 
    id, 
    nome 
    FROM bsc_municipio 
    WHERE bsc_estado_id = ? 
    ORDER BY nome ASC;");
  $stmt->bindValue(1, $rsServidorAtualizacaoContato['end_estado_id']);
  $stmt->execute();
  $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (sizeof($rsServidorAtualizacaoDependentes) > 0) {
    foreach ($rsServidorAtualizacaoDependentes as $kObj => $vObj) {
      $stmt = $db->prepare("
        SELECT 
        id, 
        nome 
        FROM bsc_municipio 
        WHERE bsc_estado_id = ? 
        ORDER BY nome ASC;");
      $stmt->bindValue(1, $vObj['benef_estado_id']);
      $stmt->execute();
      $rsServidorAtualizacaoDependentes[$kObj]['benefMunicipios'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $db->prepare("
        SELECT 
        id, 
        nome 
        FROM bsc_municipio 
        WHERE bsc_estado_id = ? 
        ORDER BY nome ASC;");
      $stmt->bindValue(1, $vObj['benef_repres_estado_id']);
      $stmt->execute();
      $rsServidorAtualizacaoDependentes[$kObj]['benefRepresMunicipios'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
$stmt->bindValue(1, $rsServidorAtualizacao['bsc_unidade_organizacional_id']);
$stmt->execute();
$rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT suo.id, s.numero, s.nome 
  FROM eo_setor_unidade_organizacional AS suo
  LEFT JOIN eo_setor AS s ON s.id = suo.eo_setor_id
  WHERE suo.bsc_unidade_organizacional_id = ? 
  GROUP BY suo.id 
  ORDER BY s.nome ASC;");
$stmt->bindValue(1, $rsServidorAtualizacao['bsc_unidade_organizacional_id_2']);
$stmt->execute();
$rsSetores2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<input type="hidden" id="enableAllSteps" name="enableAllSteps" value="<?= $enableAllSteps ;?>">
<input type="hidden" id="startIndexSteps" name="startIndexSteps" value="<?= $startIndexSteps ;?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <section class="content">
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
              <span id="titulo_form" <?= in_array($rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'], [8, 11]) ? 'style="color: yellow;"' : '' ;?>><?= $rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 8 ? 'CORREÇÃO DE ' : '' ;?>ATUALIZAÇÃO CADASTRAL DE SERVIDOR <?= $rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'] != '' ? '(Situação: '.$rsServidorAtualizacao['situacaoServidorUltima']['situacao_atualizacao_nome'].')' : '' ;?></span>
            </div>
          </h4>
        </div>
        <div id="div_atualiza_servidor" class="box-body wizard-content">
          <div id="div_servidor" class="tab-wizard vertical wizard-circle">
            <?php
            include_once ('view/sacad/servidor_atualizacao/cadastrar_pessoal.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_contato.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_documento.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_instrucao.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_familiar.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_dependente.php');
            // include_once ('view/sacad/servidor_atualizacao/cadastrar_bancario.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_vinculo.php');
            include_once ('view/sacad/servidor_atualizacao/cadastrar_prova.php');
            ?>
          </div>
          <!-- </form> -->
          <div class="box-footer text-center">
            <button type="button" id="btn_voltar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-back-left"></i> Voltar</button>
            <button type="button" id="btn_cancelar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-eraser"></i> Cancelar</button>
            <button type="button" id="btn_anterior"  class="btn btn-rounded btn-info mr-1"    ><i class="ti-arrow-left"></i> Salvar e Retroceder</button>
            <button type="button" id="btn_proximo"   class="btn btn-rounded btn-info mr-1"    >Salvar e Avançar <i class="ti-arrow-right"></i></button>
            <button type="button" id="btn_finalizar" class="btn btn-rounded btn-success mr-1" <?= $startIndexSteps == 7 ? 'style=""' : 'style="display: none;"' ;?>>Salvar e Finalizar <i class="ti-check"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?php
include_once ('template/servidor_footer.php');
include_once ('template/servidor_control_sidebar.php');
include_once ('template/servidor_rodape.php');
?>
<!-- JAVASCRIPT CUSTON BEGIN -->
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_pessoal.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_contato.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_documento.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_instrucao.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_familiar.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_dependente.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_bancario.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_vinculo.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_prova.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar_autenticacao.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sacad/servidor_atualizacao/cadastrar.js"></script>
<script type="text/javascript" src="<?= JS_FOLDER;  ?>validator_rmrosas.js"></script>