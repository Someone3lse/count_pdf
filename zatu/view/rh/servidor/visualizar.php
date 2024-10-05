<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
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
  s.matricula, 
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
  s.eo_empregador_id, 
  emp.nome_razao_social AS empregador_razao_social, 
  emp.nome_fantasia AS empregador_fantasia, 
  s.foto, 
  s.sangue_tipo, 
  s.raca, 
  s.enfermidade_portador, 
  s.enfermidade_codigo_internacional, 
  s.eo_setor_unidade_organizacional_id, 
  suo.bsc_unidade_organizacional_id, 
  suo.eo_setor_id, 
  st.nome AS setor_nome, 
  e.id AS estado_id 
  FROM rh_servidor AS s 
  LEFT JOIN bsc_municipio AS m ON m.id = s.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_pais AS p ON p.id = s.natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS pp ON pp.id = s.pai_natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS ppp ON ppp.id = s.mae_natural_bsc_pais_id 
  LEFT JOIN eo_empregador AS emp ON emp.id = s.eo_empregador_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  WHERE s.id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidor = $stmt->fetch(PDO::FETCH_ASSOC);
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
  ORDER BY si.id ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorInstrucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  sd.status 
  FROM rh_servidor_dependente AS sd 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = sd.bsc_parentesco_grau_id 
  WHERE sd.rh_servidor_id = ? 
  ORDER BY sd.id ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorDependentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>SERVIDOR</strong></h4>
              <input type="hidden" id="titulo_relatorio" value="Relatório de dados do servidor cadastrados no sistema">
            </div>
          </h4>
        </div>

        <div class="box-body">
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="tableDashboard" class="table table-hover">
              <thead class="bg-inverse">
                <tr>
                  <th>#</th>
                  <th width="40%">CAMPO</th>
                  <th>CONTEÚDO</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $countRows = 0;
                ?>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Matrícula</td>
                  <td><?= $rsServidor['matricula'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - CPF</td>
                  <td><?= $rsServidor['cpf'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Nome</td>
                  <td><?= $rsServidor['nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Data de nascimento</td>
                  <td><?= data_volta($rsServidor['dt_nascimento']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Nome social</td>
                  <td><?= $rsServidor['nome_social'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Sexo</td>
                  <td><?= $rsServidor['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Tipo sanguíneo</td>
                  <td><?= $rsServidor['sangue_tipo'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PESSOAL - Raça</td>
                  <td><?= $rsServidor['raca'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>NACIONALIDADE</td>
                  <td><?= $rsServidor['nacionalidade_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>NATURALIDADE</td>
                  <td><?= $rsServidor['natural_municipio_nome'].' - '.$rsServidor['natural_estado_sigla']; ?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ESTRANGEIRO - Data de ingresso no Brasil</td>
                  <td><?= data_volta($rsServidor['natural_estrangeiro_dt_ingresso']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ESTRANGEIRO - NATURALIDADE - Cidade</td>
                  <td><?= $rsServidor['natural_estrangeiro_cidade'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ESTRANGEIRO - NATURALIDADE - Estado</td>
                  <td><?= $rsServidor['natural_estrangeiro_estado'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ESTRANGEIRO - Condição de trablaho</td>
                  <td><?= $rsServidor['natural_estrangeiro_condicao_trabalho'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PAIS - Nome do pai</td>
                  <td><?= $rsServidor['pai_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PAIS - Nacionalidade do pai</td>
                  <td><?= $rsServidor['pai_nacionalidade_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PAIS - Profissão do pai</td>
                  <td><?= $rsServidor['pai_profissao'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PAIS - Nome da mãe</td>
                  <td><?= $rsServidor['mae_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>PAIS - Nacionalidade da mãe</td>
                  <td><?= $rsServidor['mae_nacionalidade_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>EMPREGADOR - Profissão da mãe</td>
                  <td><?= $rsServidor['mae_profissao'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>EMPREGADOR</td>
                  <td><?= $rsServidor['empregador_razao_social']. ($rsServidor['empregador_fantasia'] != '' ? (' - '.$rsServidor['empregador_fantasia']) : '') ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>SETOR ATUAL DE TRABALHO</td>
                  <td><?= $rsServidor['setor_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENFERMEDADE PORTADA</td>
                  <td><?= $rsServidor['enfermidade_portador'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENFERMEDADE - Cód. Internacional</td>
                  <td><?= $rsServidor['enfermidade_codigo_internacional'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Telefone residencial</td>
                  <td><?= $rsServidorContato['tel_residencial'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Telefone celular</td>
                  <td><?= $rsServidorContato['tel_celular'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Número para recado</td>
                  <td><?= $rsServidorContato['tel_recado'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Nome do contato para recado</td>
                  <td><?= $rsServidorContato['tel_recado_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Grau de parentesco (recado)</td>
                  <td><?= $rsServidorContato['tel_recado_parentesco_grau_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Número emergencial</td>
                  <td><?= $rsServidorContato['contato_emergencia_tel'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - Nome do contato emergencial</td>
                  <td><?= $rsServidorContato['contato_emergencia_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - E-mail institucional</td>
                  <td><?= $rsServidorContato['email_institucional'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTATO - E-mail alternativo</td>
                  <td><?= $rsServidorContato['email_alternativo'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Logradouro</td>
                  <td><?= $rsServidorContato['end_logradouro'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Número</td>
                  <td><?= $rsServidorContato['end_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Complemento</td>
                  <td><?= $rsServidorContato['end_complemento'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Bairro</td>
                  <td><?= $rsServidorContato['end_bairro'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - CEP</td>
                  <td><?= $rsServidorContato['end_cep'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Estado</td>
                  <td><?= $rsServidorContato['end_estado_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>ENDEREÇO - Cidade</td>
                  <td><?= $rsServidorContato['end_municipio_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RG - Número</td>
                  <td><?= $rsServidorDocumento['rg_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RG - Data de emissão</td>
                  <td><?= data_volta($rsServidorDocumento['rg_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RG - Orgão expedidor</td>
                  <td><?= $rsServidorDocumento['rg_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Número</td>
                  <td><?= $rsServidorDocumento['pis_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Data de cadastro</td>
                  <td><?= data_volta($rsServidorDocumento['pis_dt_cadastro']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Domicilio bancário</td>
                  <td><?= $rsServidorDocumento['pis_domicilio_bancario'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Número do banco</td>
                  <td><?= $rsServidorDocumento['pis_banco_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Agência</td>
                  <td><?= $rsServidorDocumento['pis_agencia'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - PIS - Endereço da agencia bancária</td>
                  <td><?= $rsServidorDocumento['pis_agencia_end'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CTPS - Número</td>
                  <td><?= $rsServidorDocumento['ctps_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CTPS - Série</td>
                  <td><?= $rsServidorDocumento['ctps_serie'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CTPS - Data de emissão</td>
                  <td><?= data_volta($rsServidorDocumento['ctps_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CTPS - Órgão expedidor</td>
                  <td><?= $rsServidorDocumento['ctps_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CTPS - Ano do primerio emprego</td>
                  <td><?= $rsServidorDocumento['ctps_primeiro_emprego_ano'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Título Eleitoral - Número</td>
                  <td><?= $rsServidorDocumento['eleitor_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Título Eleitoral - Zona</td>
                  <td><?= $rsServidorDocumento['eleitor_zona'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Título Eleitoral - Seção</td>
                  <td><?= $rsServidorDocumento['eleitor_secao'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Título Eleitoral - Município</td>
                  <td><?= $rsServidorDocumento['eleitor_municipio_nome'].' - '.$rsServidorDocumento['eleitor_estado_sigla'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Título Eleitoral - Inscrição em órgão de classe</td>
                  <td><?= $rsServidorDocumento['rg_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Militar - Número</td>
                  <td><?= $rsServidorDocumento['reg_militar_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Militar - Categoria</td>
                  <td><?= $rsServidorDocumento['reg_militar_categoria'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Militar - Ano de emissão</td>
                  <td><?= $rsServidorDocumento['reg_militar_emissao_ano'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Militar - Órgão expedidor</td>
                  <td><?= $rsServidorDocumento['reg_militar_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Militar - Espécie</td>
                  <td><?= $rsServidorDocumento['reg_militar_especie'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Profissional - Número</td>
                  <td><?= $rsServidorDocumento['reg_prof_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Profissional - Data de emissão</td>
                  <td><?= data_volta($rsServidorDocumento['reg_prof_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Profissional - Órgão expedidor</td>
                  <td><?= $rsServidorDocumento['reg_prof_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Registro Profissional - Data de validade</td>
                  <td><?= data_volta($rsServidorDocumento['reg_prof_dt_validade']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Número</td>
                  <td><?= $rsServidorDocumento['cnh_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Número</td>
                  <td><?= $rsServidorDocumento['reg_militar_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Categoria</td>
                  <td><?= $rsServidorDocumento['cnh_categoria'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Data de emissão</td>
                  <td><?= data_volta($rsServidorDocumento['cnh_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Órgão expedidor</td>
                  <td><?= $rsServidorDocumento['cnh_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Data de validade</td>
                  <td><?= data_volta($rsServidorDocumento['cnh_dt_validade']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - CNH - Data da primeira habilitação</td>
                  <td><?= data_volta($rsServidorDocumento['cnh_dt_primeira_habilitacao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RNE - Número</td>
                  <td><?= $rsServidorDocumento['rne_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RNE - Data de emissão</td>
                  <td><?= data_volta($rsServidorDocumento['rne_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - RNE - Órgão expedidor</td>
                  <td><?= $rsServidorDocumento['rne_orgao_expedidor'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - FGTS - Número</td>
                  <td><?= $rsServidorDocumento['fgts_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - FGTS - Opção</td>
                  <td><?= $rsServidorDocumento['fgts_opcao'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - FGTS - Conta bancária vinculada</td>
                  <td><?= $rsServidorDocumento['fgts_conta_vinculada_banco'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - FGTS - Retificação</td>
                  <td><?= $rsServidorDocumento['fgts_dt_retificacao'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Casado com brasileiro(a)</td>
                  <td><?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DOCUMENTO - Tem filho brasileiro(a)</td>
                  <td><?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'Sim' : 'Não' ;?></td>
                </tr>
                <?php 
                $countIntrucoes = 0;
                if (sizeof($rsServidorInstrucoes) > 0) {
                  foreach ($rsServidorInstrucoes as $kObjInstrucao => $vObjInstrucao) {
                    $countIntrucoes ++;
                    ?>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>INSTRUÇÃO - <?= $countIntrucoes; ?> - Escolaridade</td>
                      <td><?= $vObjInstrucao['escolaridade_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>INSTRUÇÃO - <?= $countIntrucoes; ?> - Formação</td>
                      <td><?= $vObjInstrucao['formacao'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>INSTRUÇÃO - <?= $countIntrucoes; ?> - Ano de Conclusão</td>
                      <td><?= $vObjInstrucao['conclusao_ano'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>INSTRUÇÃO - <?= $countIntrucoes; ?> - Cursando</td>
                      <td><?= $vObjInstrucao['cursando'] ;?></td>
                    </tr>
                    <?php
                  }
                }
                ?>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Estado civil</td>
                  <td><?= $rsServidorFamiliar['estado_civil_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Data de casamento</td>
                  <td><?= data_volta($rsServidorFamiliar['conjuge_dt_casamento']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Nome do cônjuge</td>
                  <td><?= $rsServidorFamiliar['conjuge_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - CPF do cônjuge</td>
                  <td><?= $rsServidorFamiliar['conjuge_cpf'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Data de nascimento do cônjuge</td>
                  <td><?= data_volta($rsServidorFamiliar['conjuge_dt_nascimento']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Nacionalidade do cônjuge</td>
                  <td><?= $rsServidorFamiliar['conjuge_natural_nacionalidade'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Naturalidade do cônjuge</td>
                  <td><?= $rsServidorFamiliar['conjuge_natural_municipio_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Naturalidade do cônjuge estrangeiro (cidade)</td>
                  <td><?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Naturalidade do cônjuge estrangeiro (estado)</td>
                  <td><?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Dados civis - Local de trabalho do cônjuge</td>
                  <td><?= $rsServidorFamiliar['conjuge_local_trabalho'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Número</td>
                  <td><?= $rsServidorFamiliar['reg_civil_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Livro</td>
                  <td><?= $rsServidorFamiliar['reg_civil_livro'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Folha</td>
                  <td><?= $rsServidorFamiliar['reg_civil_folha'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Cartório</td>
                  <td><?= $rsServidorFamiliar['reg_civil_cartorio'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Data de emissão</td>
                  <td><?= data_volta($rsServidorFamiliar['reg_civil_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Registro civil - Cidade</td>
                  <td><?= $rsServidorFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorFamiliar['reg_civil_estado_sigla'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Averbação - Tipo</td>
                  <td><?= $rsServidorFamiliar['averbacao_tipo'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Averbação - Número</td>
                  <td><?= $rsServidorFamiliar['averbacao_numero'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Averbação - Data de emissão</td>
                  <td><?= data_volta($rsServidorFamiliar['averbacao_dt_emissao']) ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Averbação - Cartório</td>
                  <td><?= $rsServidorFamiliar['averbacao_cartorio'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>FAMÍLIA - Averbação - Número</td>
                  <td><?= $rsServidorFamiliar['averbacao_municipio_nome'].' - '.$rsServidorFamiliar['averbacao_estado_sigla'] ;?></td>
                </tr>
                <?php 
                $countDependentes = 0;
                if (sizeof($rsServidorDependentes) > 0) {
                  foreach ($rsServidorDependentes as $kObjDependente => $vObjDependente) {
                    $countDependentes ++;
                    ?>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Código</td>
                      <td><?= $vObjDependente['codigo'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Nome</td>
                      <td><?= $vObjDependente['nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Grau de parentesco</td>
                      <td><?= $vObjDependente['parentesco_grau_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Grau de parentesco (outro)</td>
                      <td><?= $vObjDependente['parentesco_grau_outro'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Data de nascimento</td>
                      <td><?= data_volta($vObjDependente['dt_nascimento']) ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - Data de casamento</td>
                      <td><?= data_volta($vObjDependente['dt_casamento']) ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - NÚMERO DOS AUTOS</td>
                      <td><?= $vObjDependente['benef_autos_numero'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - NÚMERO</td>
                      <td><?= $vObjDependente['benef_rg_numero'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - DATA DE EMISSÃO</td>
                      <td><?= data_volta($vObjDependente['benef_rg_dt_emissao']) ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - RG - ÓRGÃO EXPEDIDOR</td>
                      <td><?= $vObjDependente['benef_rg_orgao_expedidor'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TELEFONE RESIDENCIAL</td>
                      <td><?= $vObjDependente['benef_tel_residencial'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TELEFONE CELULAR</td>
                      <td><?= $vObjDependente['benef_tel_celular'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - LOGRADOURO</td>
                      <td><?= $vObjDependente['benef_end_logradouro'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - NÚMERO</td>
                      <td><?= $vObjDependente['benef_end_numero'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - COMPLEMENTO</td>
                      <td><?= $vObjDependente['benef_end_complemento'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - BAIRRO</td>
                      <td><?= $vObjDependente['benef_end_bairro'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - CEP</td>
                      <td><?= $vObjDependente['benef_end_cep'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - ESTADO</td>
                      <td><?= $vObjDependente['benef_estado_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - MUNICÍPIO</td>
                      <td><?= $vObjDependente['benef_municipio_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - TIPO DE CONTA BANCÁRIA</td>
                      <td><?= $vObjDependente['benef_banco_conta_tipo_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - BANCO</td>
                      <td><?= $vObjDependente['benef_banco_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - AGÊNCIA</td>
                      <td><?= $vObjDependente['benef_bancario_agencia'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - CONTA</td>
                      <td><?= $vObjDependente['benef_bancario_conta'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - BENEFICIÁRIO DE PENSÃO - OPERAÇÃO/VARIAÇÃO</td>
                      <td><?= $vObjDependente['benef_bancario_op'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - NOME</td>
                      <td><?= $vObjDependente['benef_repres_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - CPF</td>
                      <td><?= $vObjDependente['benef_repres_cpf'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - NÚMERO</td>
                      <td><?= $vObjDependente['benef_repres_rg_numero'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - DATA DE EMISSÃO</td>
                      <td><?= data_volta($vObjDependente['benef_repres_rg_dt_emissao']) ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - RG - ÓRGÃO EXPEDIDOR</td>
                      <td><?= $vObjDependente['benef_repres_rg_orgao_expedidor'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - TELEFONE RESIDENCIAL</td>
                      <td><?= $vObjDependente['benef_repres_tel_residencial'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - TELEFONE CELULAR</td>
                      <td><?= $vObjDependente['benef_repres_tel_celular'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - LOGRADOURO</td>
                      <td><?= $vObjDependente['benef_repres_end_logradouro'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - NÚMERO</td>
                      <td><?= $vObjDependente['benef_repres_end_numero'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - COMPLEMENTO</td>
                      <td><?= $vObjDependente['benef_repres_end_complemento'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - BAIRRO</td>
                      <td><?= $vObjDependente['benef_repres_end_bairro'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - CEP</td>
                      <td><?= $vObjDependente['benef_repres_end_cep'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - ESTADO</td>
                      <td><?= $vObjDependente['benef_repres_estado_nome'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>DEPENDENTE - <?= $countDependentes; ?> - REPRESENTANTE - MUNICÍPIO</td>
                      <td><?= $vObjDependente['benef_repres_municipio_nome'] ;?></td>
                    </tr>
                    <?php
                  }
                }
                ?>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DADOS BANCÁRIOS - Tipo de conta</td>
                  <td><?= $rsServidorBancario['conta_tipo_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DADOS BANCÁRIOS - Agência</td>
                  <td><?= $rsServidorBancario['conta_tipo_nome'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DADOS BANCÁRIOS - Conta</td>
                  <td><?= $rsServidorBancario['bancario_conta'] ;?></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>DADOS BANCÁRIOS - Operação/Variação</td>
                  <td><?= $rsServidorBancario['bancario_op'] ;?></td>
                </tr>
                <?php 
                $countVinculos = 0;
                if (sizeof($rsServidorVinculos) > 0) {
                  foreach ($rsServidorVinculos as $kObjVinculo => $vObjVinculo) {
                    $countVinculos ++;
                    ?>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>Vínculo - <?= $countVinculos; ?> - Local</td>
                      <td><?= $vObjVinculo['local'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>Vínculo - <?= $countVinculos; ?> - Esfera</td>
                      <td><?= $vObjVinculo['esfera'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>Vínculo - <?= $countVinculos; ?> - Cargo</td>
                      <td><?= $vObjVinculo['cargo'] ;?></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>Vínculo - <?= $countVinculos; ?> - Carga horária</td>
                      <td><?= $vObjVinculo['carga_horaria'] ;?></td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
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