<?php
if (empty($_SESSION['servidor_zatu_id'])) {
  header('Location', PORTAL_URL . 'servidor_logout');
  exit();
}
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  s.id, 
  s.nome, 
  s.cpf, 
  s.matricula, 
  s.foto, 
  s.eo_setor_unidade_organizacional_id, 
  st.id AS setor_id, 
  st.nome AS setor_nome, 
  uo.id AS uo_id, 
  uo.nome AS uo_nome, 
  MONTH(NOW()) AS mes_hoje, 
  YEAR(NOW()) AS ano_hoje 
  FROM seg_servidor s 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
  WHERE s.id = ?
  ORDER BY s.nome ASC;");
$stmt->bindValue(1, $_SESSION['servidor_zatu_id']);
$stmt->execute();
$rsSegServidor = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  sa.id, 
  sa.nome, 
  sa.matricula, 
  MONTH(s.dt_nascimento) AS nasc_mes, 
  sa.status, 
  sa.dt_cadastro, 
  sa.seg_usuario_id, 
  sa.rh_servidor_id, 
  sa.dt_envio, 
  sa.autenticacao, 
  sa.tipo_atualizacao, 
  st.nome AS setor_nome, 
  uo.nome AS uo_nome 
  FROM sacad_servidor_atualizacao AS sa 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = sa.eo_setor_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
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
    sas.obs, 
    ssa.nome AS situacao_atualizacao_nome, 
    ssa.etapa AS situacao_etapa, 
    sas.status, 
    sas.dt_cadastro, 
    MONTH(sas.dt_cadastro) AS mes, 
    YEAR(sas.dt_cadastro) AS ano, 
    sas.seg_usuario_id, 
    u.nome AS usuario_nome, 
    sas.sacad_servidor_atualizacao_id, 
    sas.sacad_situacao_servidor_atualizacao_id 
    FROM sacad_servidor_atualizacao_situacao AS sas 
    LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
    LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
    WHERE sas.sacad_servidor_atualizacao_id = ? 
    ORDER BY sas.id ASC;");
  $stmt->bindValue(1, $vObj['id']);
  $stmt->execute();
  $rsServidorSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $rsServidorAtualizacoes[$kObj]['situacoes'] = $rsServidorSituacoes;
  $rsServidorAtualizacoes[$kObj]['situacaoServidorPrimeiro'] = sizeof($rsServidorSituacoes) > 0 ? $rsServidorSituacoes[0] : NULL;
  $rsServidorAtualizacoes[$kObj]['situacaoServidorUltima'] = end($rsServidorSituacoes);
}
// $stmt = $db->prepare("
//   SELECT 
//   COUNT(sa.id) as servidor_atualizacao_aguardando_qtd  
//   FROM rh_servidor AS s 
//   RIGHT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
//   LEFT JOIN eo_setor AS eos ON eos.id = s.eo_setor_id 
//   LEFT JOIN seg_usuario_setor AS us ON us.eo_setor_id = eos.id 
//   LEFT JOIN seg_usuario AS u ON u.id = us.seg_usuario_id 
//   WHERE 
//   u.id = 1 AND
//   (sa.sacad_situacao_servidor_atualizacao_id = 2 OR 
//   sa.sacad_situacao_servidor_atualizacao_id = 5);");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->execute();
// $rsQtdServidorAtualizacoesAguardando = $stmt->fetch(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//   s.id, 
//   s.nome, 
//   s.eo_setor_id AS servidor_setor_id, 
//   eos.nome AS servidor_setor_nome, 
//   sa.id AS atualizacao_id, 
//   sa.eo_setor_id AS atualizacao_setor_id, 
//   eosa.nome AS atualizacao_setor_nome, 
//   sa.sacad_situacao_servidor_atualizacao_id AS situacao_id, 
//   ssa.nome AS situacao_nome, 
//   u.nome AS usuario_supervisor_nome, 
//   u.tel_celular AS usuario_supervisor_celular 
//   FROM rh_servidor AS s 
//   LEFT JOIN eo_setor AS eos ON eos.id = s.eo_setor_id 
//   LEFT JOIN seg_usuario_setor AS us ON us.eo_setor_id = eos.id 
//   LEFT JOIN seg_usuario AS u ON u.id = us.seg_usuario_id 
//   RIGHT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
//   LEFT JOIN eo_setor AS eosa ON eosa.id = sa.eo_setor_id 
//   LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sa.sacad_situacao_servidor_atualizacao_id 
//   LEFT JOIN rh_servidor_contrato AS sc ON sc.rh_servidor_id = s.id 
//   LEFT JOIN rh_servidor_contato AS sct ON sct.rh_servidor_id = s.id 
//   WHERE 
//   u.id = ? AND 
//   (sa.sacad_situacao_servidor_atualizacao_id = 2 OR 
//   sa.sacad_situacao_servidor_atualizacao_id = 5) 
//   ORDER BY s.nome ASC;");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->execute();
// $rsServidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Header -->
<header class="main-header servidor">
  <div class="d-flex align-items-center logo-box justify-content-between">
    <a href="#" class="waves-effect waves-light nav-link rounded d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
      <i class="ti-menu"></i>
    </a>  
    <!-- Logo -->
    <a href="<?= PORTAL_URL; ?>servidor_dashboard" class="logo">
      <!-- logo-->
      <div class="logo-lg">
        <span class="light-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
        <span class="dark-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
      </div>
    </a>  
  </div>  
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top pl-10">
    <span class="prefeitura">
      <!-- <img src="<?= PORTAL_URL ?>assets/images/brasao_tarauaca.png" alt=""> -->
      <h1>PREFEITURA DE<span> TARAUACÁ</span></h1>
    </span>
    <!-- Sidebar toggle button-->
    <div class="app-menu">
      <!-- <ul class="header-megamenu nav">
        <li class="btn-group nav-item d-md-none">
          <a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu" role="button">
            <i class="ti-menu"></i>
          </a>
        </li>
        <li class="btn-group nav-item d-none d-xl-inline-block">
          <a href="contact_app_chat.html" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
            <i class="ti-comments"></i>
          </a>
        </li>
        <li class="btn-group nav-item d-none d-xl-inline-block">
          <a href="mailbox.html" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
            <i class="ti-email"></i>
          </a>
        </li>
        <li class="btn-group nav-item d-none d-xl-inline-block">
          <a href="extra_taskboard.html" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
            <i class="ti-check-box"></i>
          </a>
        </li>
        <li class="btn-group nav-item d-none d-xl-inline-block">
          <a href="extra_calendar.html" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
            <i class="ti-calendar"></i>
          </a>
        </li>
      </ul>  -->
    </div>
    <div class="navbar-custom-menu r-side">
      <ul class="nav navbar-nav"> 
        <li class="btn-group nav-item d-lg-inline-flex d-none">
          <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded full-screen" title="Full Screen">
            <i class="ti-fullscreen"></i>
          </a>
        </li>   
        <!-- <li class="btn-group d-lg-inline-flex d-none">
          <div class="app-menu">
            <div class="search-bx mx-5">
              <form>
                <div class="input-group">
                  <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </li> -->
        <!-- Notifications -->
        <li class="dropdown notifications-menu">
          <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="Notificações">
            <i class="ti-bell"></i>
            <!-- <div class="value-notification"></div> -->
          </a>
          <ul class="dropdown-menu animated bounceIn">
            <li class="header">
              <div class="p-20">
                <div class="flexbox">
                  <div>
                    <h4 class="mb-0 mt-0">NOTIFICAÇÕES</h4>
                  </div>
                  <div>
                    <!-- <a href="#" class="text-danger">Limpar Todos</a> -->
                  </div>
                </div>
              </div>
            </li>
            <li>
              <ul class="menu sm-scrol">
                <li>
                  <!-- <a id="a_notificacao" value="" href="">
                    <i class="fa fa-user text-warning"></i>
                  </a> -->
                </li>
                <li>
                  <i class="ti-check-box text-success"></i> Nenhuma atualização esperando análise!
                </li>
              </ul>
            </li> 
          </ul>
        </li> 
        <!-- User Account-->
        <li class="dropdown user user-menu">
          <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
            <i class="fal fa-user"></i>
          </a>
          <ul class="dropdown-menu animated flipInX">
            <li class="user-body">
              <a class="dropdown-item" href="#"><i class="fal fa-user text-muted mr-2"></i> Perfil</a>
              <a class="dropdown-item" id="a_redefinir_senha" href="#" value="<?= $_SESSION['login'] ;?>"><i class="mdi mdi-key-change text-muted mr-2"></i> Redefinir senha</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= PORTAL_URL; ?>logout"><i class="far fa-power-off text-muted mr-2"></i> Sair</a>
            </li>
          </ul>
        </li> 
        <!-- Control Sidebar Toggle Button -->
        <!-- <li>
          <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
            <i class="ti-settings"></i>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>
  <span class="line-efect"></span>
</header>
<!-- /.Header