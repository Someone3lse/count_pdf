<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(s.id), 0) AS qtd  
  FROM rh_servidor AS s 
  WHERE s.status = 1;");
$stmt->execute();
$rsQtdServidores = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(s.id), 0) AS qtd 
  FROM rh_servidor AS s 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
  WHERE sa.id IS NULL;");
$stmt->execute();
$rsQtdServidoresSemAtualizacao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(s.id), 0) AS qtd 
  FROM rh_servidor AS s 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
  WHERE (YEAR(sa.dt_envio) < YEAR(NOW()) OR sa.id IS NULL);");
$stmt->execute();
$rsQtdServidoresPendente = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  WHERE YEAR(sa.dt_cadastro) = YEAR(NOW());");
$stmt->execute();
$rsQtdServidorAtualizacoes = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 1 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesDigitando = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 2 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesAguardandoAtestacao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 13 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesCorrigidasAguardandoAtestacao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 5 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );;");
$stmt->execute();
$rsQtdServidorAtualizacoesAguardandoAnaliseRH = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 6 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesEmAnalise = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 12 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesCorrigidaAguardandoAnalise = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 8 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesAguardandoCorrecao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 11 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesEmCorrecao = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  COALESCE(COUNT(DISTINCT(sa.id)), 0) AS qtd  
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  WHERE sas.sacad_situacao_servidor_atualizacao_id = 10 
  AND sas.id IN ( 
    SELECT 
    MAX(sasaux.id) AS id
    FROM sacad_servidor_atualizacao AS saaux 
    LEFT JOIN sacad_servidor_atualizacao_situacao AS sasaux ON sasaux.sacad_servidor_atualizacao_id = saaux.id 
    WHERE saaux.id = sa.id
  );");
$stmt->execute();
$rsQtdServidorAtualizacoesFinalizadas = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  s.id, 
  s.nome, 
  s.cpf, 
  s.matricula, 
  sa.status, 
  sa.dt_cadastro, 
  sa.id AS atualizacao_id, 
  sa.tipo_atualizacao 
  FROM rh_servidor AS s 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
  LEFT JOIN eo_setor_unidade_organizacional AS suosa ON suosa.id = sa.eo_setor_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suosa.eo_setor_id 
  ORDER BY s.nome ASC;");
$stmt->execute();
$rsServidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsServidores as $kObj => $vObj) {
  $stmt = $db->prepare("
    SELECT 
    sas.id, 
    sas.obs, 
    ssa.nome, 
    ssa.etapa, 
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
  $stmt->bindValue(1, $vObj['atualizacao_id']);
  $stmt->execute();
  $rsServidorSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (sizeof($rsServidorSituacoes) <= 0) {
    $rsServidores[$kObj]['situacaoServidorPrimeiro']['dt_cadastro'] = '';
    $rsServidores[$kObj]['situacaoServidorUltima']['id'] = 1;
    $rsServidores[$kObj]['situacaoServidorUltima']['nome'] = 'Aguardando preenchimento total';
    $rsServidores[$kObj]['situacaoServidorUltima']['etapa'] = '';
    $rsServidores[$kObj]['situacaoServidorUltima']['usuario_nome'] = '';
    $rsServidores[$kObj]['situacaoServidorUltima']['dt_cadastro'] = '';
  } else {
    $rsServidores[$kObj]['situacoes'] = $rsServidorSituacoes;
    $rsServidores[$kObj]['situacaoServidorPrimeiro'] = sizeof($rsServidorSituacoes) > 0 ? $rsServidorSituacoes[0] : NULL;
    $rsServidores[$kObj]['situacaoServidorUltima'] = end($rsServidorSituacoes);
  }
}
$stmt = $db->prepare("
  SELECT 
  ssa.id, 
  ssa.nome 
  FROM sacad_situacao_servidor_atualizacao AS ssa 
  ORDER BY ssa.id;");
$stmt->execute();
$rsSituacaoesServidorAtualizacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="box box-outline-info mt-10" style="background-color: transparent;">
        <div class="box-header font-size-16">
          <strong>SERVIDORES</strong>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-xl-4 col-md-6 col-12">
              <div class="box bg-info">
                <div class="box-body" title="Servidores cadastrados no sistema">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="icon bg-info rounded-circle">
                      <i class="text-white mr-0 font-size-36 fal fa-ballot"></i>
                    </div>
                    <div>
                      <h3 class="text-white text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidores['qtd']) ? $rsQtdServidores['qtd'] : 0 ;?></h3>
                      <p class="text-white mb-0">TOTAL GERAL</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-12">
              <div class="box bg-dark">
                <div class="box-body" title="Servidores cadastrados no sistema que nunca atualizaram seus dados">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="icon bg-dark rounded-circle">
                      <i class="text-white mr-0 font-size-36 fal fa-sync"></i>
                    </div>
                    <div>
                      <h3 class="text-white text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidoresSemAtualizacao['qtd']) ? $rsQtdServidoresSemAtualizacao['qtd'] : 0 ;?></h3>
                      <p class="text-white mb-0">SEM ATUALIZAÇÃO</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-12">
              <div class="box bg-danger">
                <div class="box-body" title="Servidores cadastrados no sistema que estão atrasados com o recadastramento anual">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="icon bg-danger rounded-circle">
                      <i class="text-white mr-0 font-size-36 fal fa-ballot-check"></i>
                    </div>
                    <div>
                      <h3 class="text-white text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidoresPendente['qtd']) ? $rsQtdServidoresPendente['qtd'] : 0 ;?></h3>
                      <p class="text-white mb-0">PENDENTE DE ATUALIZAÇÃO</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <hr>
      <div>
        <div class="box box-outline-info mt-10" style="background-color: transparent;">
          <div class="box-header font-size-16">
            <strong>ATUALIZAÇÕES</strong>
          </div>
          <div class="box-body">
            <div class="row">

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box bg-primary">
                  <div class="box-body" title="Servidores cadastrados no sistema e que iniciaram recadastramento anual ou atualização de dados">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary rounded-circle">
                        <i class="text-white mr-0 font-size-40 fal fa-clipboard-user"></i>
                      </div>
                      <div>
                        <h3 class="text-white text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoes['qtd']) ? $rsQtdServidorAtualizacoes['qtd'] : 0 ;?></h3>
                        <p class="text-white mb-0">TOTAL GERAL (<?= date("Y"); ;?>)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-keyboard"></i>
                      </div>
                      <div>
                        <h3 class="text-info text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesDigitando['qtd']) ? $rsQtdServidorAtualizacoesDigitando['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">EM DIGITAÇÃO</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-history"></i>
                      </div>
                      <div>
                        <h3 class="text-warning text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesAguardandoAtestacao['qtd']) ? $rsQtdServidorAtualizacoesAguardandoAtestacao['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">AGUARDANDO ATESTAÇÃO</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-history"></i>
                      </div>
                      <div>
                        <h3 class="text-warning text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesCorrigidasAguardandoAtestacao['qtd']) ? $rsQtdServidorAtualizacoesCorrigidasAguardandoAtestacao['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">CORRIGIDO, AGUARDANDO ATESTAÇÃO</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-history"></i>
                      </div>
                      <div>
                        <h3 class="text-warning text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesAguardandoAnaliseRH['qtd']) ? $rsQtdServidorAtualizacoesAguardandoAnaliseRH['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">AGUARDANDO ANÁLISE PELO RH</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-user-times"></i>
                      </div>
                      <div>
                        <h3 class="text-danger text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesCorrigidaAguardandoAnalise['qtd']) ? $rsQtdServidorAtualizacoesCorrigidaAguardandoAnalise['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">CORRIGIDO, AGUARDANDO ANÁLISE PELO RH</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-user-clock"></i>
                      </div>
                      <div>
                        <h3 class="text-dark text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesEmAnalise['qtd']) ? $rsQtdServidorAtualizacoesEmAnalise['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">EM ANÁLISE PELO RH</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-user-times"></i>
                      </div>
                      <div>
                        <h3 class="text-danger text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesAguardandoCorrecao['qtd']) ? $rsQtdServidorAtualizacoesAguardandoCorrecao['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">AGUARDANDO CORREÇÃO PELO SERVIDOR</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-user-times"></i>
                      </div>
                      <div>
                        <h3 class="text-danger text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesEmCorrecao['qtd']) ? $rsQtdServidorAtualizacoesEmCorrecao['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">EM CORREÇÃO</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="box">
                  <div class="box-body">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="icon bg-primary-light rounded-circle">
                        <i class="text-dark mr-0 font-size-30 fal fa-user-check"></i>
                      </div>
                      <div>
                        <h3 class="text-success text-right mb-0 font-weight-500"><?= !is_null($rsQtdServidorAtualizacoesFinalizadas['qtd']) ? $rsQtdServidorAtualizacoesFinalizadas['qtd'] : 0 ;?></h3>
                        <p class="text-dark mb-0">FINALIZADAS</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
    </section>
  </div>
</div>
<!-- /.content-wrapper -->
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>