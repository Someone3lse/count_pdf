<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  sc.id, 
  sc.rh_servidor_id, 
  s.nome AS servidor_nome, 
  sc.rh_servidor_tipo_id, 
  st.nome AS servidor_tipo_nome, 
  sc.contrato_numero, 
  sc.dt_publicacao, 
  sc.contrato_dt_inicio, 
  sc.contrato_dt_fim, 
  sc.contrato_fim_indefinido, 
  sc.situacao, 
  sc.bsc_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  sc.setor, 
  sc.bsc_municipio_id, 
  m.nome AS municipio_nome, 
  e.sigla AS estado_sigla, 
  sc.desligamento_dt, 
  sc.desligamento_tipo, 
  sc.eo_cargo_id, 
  c.nome AS cargo_nome, 
  sc.status 
  FROM rh_servidor_contrato AS sc 
  LEFT JOIN rh_servidor AS s ON s.id = sc.rh_servidor_id 
  LEFT JOIN rh_servidor_tipo AS st ON st.id = sc.rh_servidor_tipo_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = sc.bsc_unidade_organizacional_id 
  LEFT JOIN eo_cargo AS c ON c.id = sc.eo_cargo_id 
  LEFT JOIN bsc_municipio AS m ON m.id = sc.bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE sc.id = ?");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContrato = $stmt->fetch(PDO::FETCH_ASSOC);
if (is_array($rsServidorContrato) && sizeof($rsServidorContrato) <= 0) {
  $rsServidor['id'] = 0;
  $rsServidor['rh_servidor_id'] = '';
  $rsServidor['servidor_nome'] = '';
  $rsServidor['rh_servidor_tipo_id'] = '';
  $rsServidor['contrato_numero'] = '';
  $rsServidor['contrato_dt_inicio'] = '';
  $rsServidor['contrato_dt_fim'] = '';
  $rsServidor['contrato_fim_indefinido'] = '';
  $rsServidor['situacao'] = '';
  $rsServidor['bsc_unidade_organizacional_id'] = '';
  $rsServidor['uo_nome'] = '';
  $rsServidor['setor'] = '';
  $rsServidor['bsc_municipio_id'] = '';
  $rsServidor['desligamento_dt'] = '';
  $rsServidor['desligamento_tipo'] = '';
  $rsServidor['status'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sca.id, 
  sca.rh_servidor_contrato_id, 
  sca.salario, 
  sca.periodicidade, 
  sca.funcao_nome, 
  sca.funcao_descricao, 
  sca.dt_vigorar, 
  sca.dt_publicacao, 
  sca.hora_entrada, 
  sca.hora_inervalo_entrada, 
  sca.hora_intervalo_saida, 
  sca.hora_saida, 
  sca.status 
  FROM rh_servidor_contrato_alteracao AS sca
  WHERE sca.rh_servidor_contrato_id = ? 
  ORDER BY sca.dt_vigorar ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContratoAlteracoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  scf.id, 
  scf.rh_servidor_contrato_id, 
  scf.aquisitivo_dt_inicio, 
  scf.aquisitivo_dt_fim, 
  scf.gozo_dt_inicio, 
  scf.gozo_dt_fim, 
  scf.obs, 
  scf.status 
  FROM rh_servidor_contrato_ferias AS scf
  WHERE scf.rh_servidor_contrato_id = ? 
  ORDER BY scf.aquisitivo_dt_inicio ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContratoFerias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?= PORTAL_URL; ?>view/rh/servidor_contrato/dashboard">Contratos de servidores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualização</li>
          </ol>
        </nav>
      </div>
    </div>
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>CONTRATO</strong></h4>
              <input type="hidden" id="titulo_relatorio" value="Relatório de dados do contrato do servidor cadastrados no sistema">
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
                  <th width="60%">CAMPO</th>
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
                  <td>CONTRATO - Servidor</td>
                  <td><?= $rsServidorContrato['servidor_nome'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Tipo de vínculo do servidor</td>
                  <td><?= $rsServidorContrato['servidor_tipo_nome'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Unidade organizacional do servidor</td>
                  <td><?= $rsServidorContrato['uo_nome'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Número</td>
                  <td><?= $rsServidorContrato['contrato_numero'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Setor</td>
                  <td><?= $rsServidorContrato['setor'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Cargo</td>
                  <td><?= $rsServidorContrato['cargo_nome'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Cidade</td>
                  <td><?= $rsServidorContrato['municipio_nome'] . ' - ' . $rsServidorContrato['estado_sigla'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Data de publicação</td>
                  <td><?= data_volta($rsServidorContrato['dt_publicacao']) ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Data de início do contrato</td>
                  <td><?= data_volta($rsServidorContrato['contrato_dt_inicio']) ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Data de fim do contrato</td>
                  <td><?= data_volta($rsServidorContrato['contrato_dt_fim']) ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Sem fim definido</td>
                  <td><?= $rsServidorContrato['contrato_fim_indefinido'] == '1' ? 'SIM' : 'NÃO'; ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Situação</td>
                  <td><?= $rsServidorContrato['situacao'] ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Data de desligamento do servidor</td>
                  <td><?= data_volta($rsServidorContrato['desligamento_dt']) ;?></td>
                  <td></td>
                </tr>
                <tr>
                  <td><?= ++$countRows ;?></td>
                  <td>CONTRATO - Tipo de deligamento do servidor</td>
                  <td><?= $rsServidorContrato['desligamento_tipo'] ;?></td>
                  <td></td>
                </tr>
                <?php 
                $countAlteracoes = 0;
                if (sizeof($rsServidorContratoAlteracoes) > 0) {
                  foreach ($rsServidorContratoAlteracoes as $kAlteracao => $vAlteracao) {
                    $countAlteracoes ++;
                    ?>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Salário</td>
                      <td><?= $vAlteracao['salario'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Periodicidade</td>
                      <td><?= $vAlteracao['periodicidade'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Função</td>
                      <td><?= $vAlteracao['funcao_nome'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Descrição da função</td>
                      <td><?= $vAlteracao['funcao_descricao'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Data a vigorar</td>
                      <td><?= data_volta($vAlteracao['dt_vigorar']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Data a publicação</td>
                      <td><?= data_volta($vAlteracao['dt_publicacao']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Hora de entrada</td>
                      <td><?= $vAlteracao['hora_entrada'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Hora de saída</td>
                      <td><?= $vAlteracao['hora_saida'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Hora de início do intervalo</td>
                      <td><?= $vAlteracao['hora_inervalo_entrada'] ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>ALTERAÇÃO DE CONTRATO - <?= $countAlteracoes; ?> - Hora de término do intervalo</td>
                      <td><?= $vAlteracao['hora_intervalo_saida'] ;?></td>
                      <td></td>
                    </tr>
                    <?php
                  }
                }
                $countFerias = 0;
                if (sizeof($rsServidorContratoFerias) > 0) {
                  foreach ($rsServidorContratoFerias as $kFerias => $vFerias) {
                    $countFerias ++;
                    ?>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>FÉRIAS - <?= $countFerias; ?> - Início do período aquisitivo de férias</td>
                      <td><?= data_volta($vFerias['aquisitivo_dt_inicio']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>FÉRIAS - <?= $countFerias; ?> - Fim do período aquisitivo de férias</td>
                      <td><?= data_volta($vFerias['aquisitivo_dt_fim']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>FÉRIAS - <?= $countFerias; ?> - Data de início do gozo de fériass</td>
                      <td><?= data_volta($vFerias['gozo_dt_inicio']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>FÉRIAS - <?= $countFerias; ?> - Data de fim do gozo de férias</td>
                      <td><?= data_volta($vFerias['gozo_dt_fim']) ;?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><?= ++$countRows ;?></td>
                      <td>FÉRIAS - <?= $countFerias; ?> - Observação</td>
                      <td><?= $vFerias['obs'] ;?></td>
                      <td></td>
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