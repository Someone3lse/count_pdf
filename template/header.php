<?php
// if (empty($_SESSION['zatu_id'])) {
//   header('Location', PORTAL_URL . 'logout');
//   exit();
// }
// $db = Conexao::getInstance();
// $stmt = $db->prepare("
//   SELECT 
//   a.dt_inicio, 
//   a.dt_fim 
//   FROM rh_atestador AS a 
//   WHERE 
//   a.status = 1 
//   AND a.seg_usuario_id_atestador = ? 
//   AND a.dt_inicio <= ? 
//   AND a.dt_fim >= ? 
//   GROUP BY 
//   a.dt_inicio, 
//   a.dt_fim;");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->bindValue(2, Date('Y-m-d'));
// $stmt->bindValue(3, Date('Y-m-d'));
// $stmt->execute();
// $rsPermiteAtestar = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//   c.id  
//   FROM rh_conferidor AS c 
//   WHERE 
//   c.status = 1 
//   AND c.seg_usuario_id_conferidor = ? 
//   GROUP BY 
//   c.id;");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->execute();
// $rsPermiteConferir = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//   suo.id AS suo_id 
//   FROM rh_atestador AS a 
//   LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
//   WHERE a.seg_usuario_id_atestador = ? 
//   ORDER BY suo.id ASC;");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->execute();
// $rsSetoresChefeImediato = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//   suo.id AS suo_id 
//   FROM rh_conferidor AS a 
//   LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
//   WHERE a.seg_usuario_id_conferidor = ? 
//   ORDER BY suo.id ASC;");
// $stmt->bindValue(1, $_SESSION['zatu_id']);
// $stmt->execute();
// $rsSetoresConferidor = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//   s.id, 
//   s.nome, 
//   s.cpf, 
//   s.matricula, 
//   sa.eo_setor_unidade_organizacional_id, 
//   uo.nome AS uo_nome, 
//   st.nome AS setor_nome, 
//   sa.rh_situacao_trabalho_id, 
//   sitt.nome AS sit_trab_nome, 
//   sa.atestacao_matricula, 
//   s.matricula_2, 
//   sa.eo_setor_unidade_organizacional_id_2, 
//   uo2.nome AS uo_nome_2, 
//   st2.nome AS setor_nome_2, 
//   sa.rh_situacao_trabalho_id_2, 
//   sitt2.nome AS sit_trab_nome_2, 
//   sa.atestacao_matricula_2, 
//   sa.status, 
//   sa.dt_cadastro, 
//   sa.id AS atualizacao_id, 
//   sa.tipo_atualizacao ,
//   suosa.eo_setor_id AS sa_setor_id, 
//   st.nome AS sa_setor_nome, 
//   sas.sacad_situacao_servidor_atualizacao_id 
//   FROM rh_servidor AS s 
//   LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
//   LEFT JOIN eo_setor_unidade_organizacional AS suosa ON suosa.id = sa.eo_setor_unidade_organizacional_id 
//   LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suosa.bsc_unidade_organizacional_id 
//   LEFT JOIN eo_setor AS st ON st.id = suosa.eo_setor_id 
//   LEFT JOIN rh_situacao_trabalho AS sitt ON sitt.id = sa.rh_situacao_trabalho_id 
//   LEFT JOIN eo_setor_unidade_organizacional AS suosa2 ON suosa2.id = sa.eo_setor_unidade_organizacional_id_2 
//   LEFT JOIN bsc_unidade_organizacional AS uo2 ON uo2.id = suosa2.bsc_unidade_organizacional_id 
//   LEFT JOIN eo_setor AS st2 ON st2.id = suosa2.eo_setor_id 
//   LEFT JOIN rh_situacao_trabalho AS sitt2 ON sitt2.id = sa.rh_situacao_trabalho_id_2 
//   LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
//   LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
//   WHERE 
//   sas.id IN (
//     SELECT MAX(id) AS id 
//     FROM sacad_servidor_atualizacao_situacao AS auxsas 
//     WHERE auxsas.sacad_servidor_atualizacao_id = sa.id AND auxsas.sacad_situacao_servidor_atualizacao_id IN (2, 5, 12, 13)) 
//   ORDER BY s.nome ASC");
// $stmt->execute();
// $rsServidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $qtdServidorAguardandoAtestacao = 0;
// $qtdServidorAguardandoAnalise = 0;
// foreach ($rsServidores as $kObj => $vObj) {
//   $stmt = $db->prepare("
//     SELECT 
//     sas.id, 
//     sas.obs, 
//     ssa.nome, 
//     ssa.etapa, 
//     sas.status, 
//     sas.dt_cadastro, 
//     sas.seg_usuario_id, 
//     u.nome AS usuario_nome, 
//     sas.sacad_servidor_atualizacao_id, 
//     sas.sacad_situacao_servidor_atualizacao_id 
//     FROM sacad_servidor_atualizacao_situacao AS sas 
//     LEFT JOIN sacad_situacao_servidor_atualizacao AS ssa ON ssa.id = sas.sacad_situacao_servidor_atualizacao_id 
//     LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id 
//     WHERE sas.sacad_servidor_atualizacao_id = ? 
//     ORDER BY sas.id ASC;");
//   $stmt->bindValue(1, $vObj['atualizacao_id']);
//   $stmt->execute();
//   $rsServidorSituacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
//   if (sizeof($rsServidorSituacao) <= 0) {
//     $rsServidores[$kObj]['situacaoServidorPrimeiro']['dt_cadastro'] = '';
//     $rsServidores[$kObj]['situacaoServidorUltima']['id'] = 1;
//     $rsServidores[$kObj]['situacaoServidorUltima']['nome'] = 'Aguardando preenchimento total';
//     $rsServidores[$kObj]['situacaoServidorUltima']['etapa'] = '';
//     $rsServidores[$kObj]['situacaoServidorUltima']['usuario_nome'] = '';
//     $rsServidores[$kObj]['situacaoServidorUltima']['dt_cadastro'] = '';
//   } else {
//     $rsServidores[$kObj]['situacoes'] = $rsServidorSituacao;
//     $rsServidores[$kObj]['situacaoServidorPrimeiro'] = sizeof($rsServidorSituacao) > 0 ? $rsServidorSituacao[0] : NULL;
//     $rsServidores[$kObj]['situacaoServidorUltima'] = end($rsServidorSituacao);
//   }
//   if (in_array($vObj['sacad_situacao_servidor_atualizacao_id'], [2, 13]) && ((in_array($vObj['eo_setor_unidade_organizacional_id'], array_column($rsSetoresChefeImediato, 'suo_id')) && $vObj['atestacao_matricula'] == NULL)) || (in_array($vObj['eo_setor_unidade_organizacional_id_2'], array_column($rsSetoresChefeImediato, 'suo_id')) && $vObj['matricula_2'] != NULL && $vObj['atestacao_matricula_2'] == NULL)) {
//     $qtdServidorAguardandoAtestacao++;
//   } else if (in_array($vObj['sacad_situacao_servidor_atualizacao_id'], [5, 12]) && ((in_array($vObj['eo_setor_unidade_organizacional_id'], array_column($rsSetoresConferidor, 'suo_id')))) || (in_array($vObj['eo_setor_unidade_organizacional_id_2'], array_column($rsSetoresConferidor, 'suo_id')))) {
//     $qtdServidorAguardandoAnalise++;
//   }
// }
?>
<!-- Header -->
<header class="main-header rh">
  <div class="d-flex align-items-center logo-box justify-content-between">
    <!-- <a href="#" class="waves-effect waves-light nav-link rounded d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
      <i class="ti-menu"></i> -->
    <!-- </a>   -->
    <!-- Logo -->
    <!-- <a href="<?= PORTAL_URL; ?>dashboard" class="logo"> -->
      <!-- logo-->
      <!-- <div class="logo-lg">
        <span class="light-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
        <span class="dark-logo"><img src="<?= IMG_FOLDER; ?>zatu-logo-white.svg" style="height: 70px;" alt="logo"></span>
      </div>
    </a>   -->
  </div>
</header>