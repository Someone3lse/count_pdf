<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db                 = Conexao::getInstance();
$fServidorNome      = !isset($_POST['servidor']) ? NULL : $_POST['servidor'];
$fUO                = !isset($_POST['uo']) ? NULL : (in_array('0', $_POST['uo']) ? NULL : $_POST['uo']);
$fSetor             = !isset($_POST['setor']) ? NULL : (in_array('0', $_POST['setor']) ? NULL : $_POST['setor']);
$fServTipo          = !isset($_POST['servidor_tipo']) ? NULL : (in_array('0', $_POST['servidor_tipo']) ? NULL : $_POST['servidor_tipo']);
$stmt = $db->prepare(" 
  SELECT 
  s.id, 
  s.nome, 
  s.cpf, 
  s.dt_nascimento, 
  s.matricula, 
  s.rh_servidor_tipo_id, 
  stipo.nome AS serv_tipo_nome, 
  s.eo_cargo_id, 
  c.nome AS cargo_nome, 
  s.eo_setor_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  st.nome AS setor_nome, 
  s.rh_situacao_trabalho_id, 
  sitt.nome AS sit_trab_nome, 
  s.matricula_2, 
  s.rh_servidor_tipo_id_2, 
  stipo2.nome AS serv_tipo_nome_2, 
  s.eo_cargo_id_2, 
  c2.nome AS cargo_nome_2, 
  s.eo_setor_unidade_organizacional_id_2, 
  uo2.nome AS uo_nome_2, 
  st2.nome AS setor_nome_2, 
  s.rh_situacao_trabalho_id_2, 
  sitt2.nome AS sit_trab_nome_2, 
  s.status, 
  s.dt_cadastro, 
  suosa.eo_setor_id AS sa_setor_id, 
  st.nome AS sa_setor_nome 
  FROM rh_servidor AS s 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id
  LEFT JOIN eo_setor_unidade_organizacional AS suosa ON suosa.id = s.eo_setor_unidade_organizacional_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suosa.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suosa.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt ON sitt.id = s.rh_situacao_trabalho_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suosa2 ON suosa2.id = s.eo_setor_unidade_organizacional_id_2 
  LEFT JOIN bsc_unidade_organizacional AS uo2 ON uo2.id = suosa2.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st2 ON st2.id = suosa2.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt2 ON sitt2.id = s.rh_situacao_trabalho_id_2 
  LEFT JOIN rh_servidor_tipo AS stipo ON stipo.id = s.rh_servidor_tipo_id 
  LEFT JOIN rh_servidor_tipo AS stipo2 ON stipo2.id = s.rh_servidor_tipo_id_2 
  LEFT JOIN eo_cargo AS c ON c.id = s.eo_cargo_id 
  LEFT JOiN eo_cargo AS c2 ON c2.id = s.eo_cargo_id_2 
  WHERE 1 = 1 "
  . ($fServidorNome     == "" ? "" : "AND UPPER(s.nome) LIKE '%".strtoupper($fServidorNome)."%' ")
  . ($fUO               == NULL ? "" : "AND (suosa.bsc_unidade_organizacional_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fUO)))." OR suosa2.bsc_unidade_organizacional_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fUO))).") ")
  . ($fSetor            == NULL ? "" : "AND (suosa.eo_setor_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fSetor)))." OR suosa2.eo_setor_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fSetor))).") ")
  . ($fServTipo         == NULL ? "" : "AND (s.rh_servidor_tipo_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fServTipo)))." OR s.rh_servidor_tipo_id_2 IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fServTipo))).") ")
  . "AND sa.id IS NULL 
  ORDER BY s.nome ASC");
$stmt->execute();
$rsServidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  status 
  FROM bsc_unidade_organizacional 
  WHERE status = 1  
  ORDER BY nome ASC;");
$stmt->execute();
$rsUOs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  status 
  FROM eo_setor 
  WHERE status = 1 
  ORDER BY nome ASC;");
$stmt->execute();
$rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  st.id AS id, 
  st.nome AS nome, 
  st.status AS status 
  FROM rh_servidor_tipo AS st 
  ORDER BY st.nome ASC;");
$stmt->execute();
$rsServidorTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Servidor sem atualização</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-home-lg mr-10"></i></div>
              <span id="titulo_form"> FILTRO</span>
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>
        <div class="box-body">
          <form class="" id="pesquisa_atestacao" name="pesquisa_atestacao" method="post" action="">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="servidor">SERVIDOR<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" id="servidor" name="servidor" placeholder="Nome do Servidor" value="<?= $fServidorNome ;?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="servidor_tipo">TIPO DE CONTRATO<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select multiple="multiple" id="servidor_tipo" name="servidor_tipo[]" class="form-control select2" style="width: 100%;" placeholder="selecione os tipos de contrato dos processos">
                      <option value="0" <?= !isset($fServTipo) || in_array('0', $fServTipo) ? 'selected="selected"' : ''; ?>>TODOS</option>
                      <?php
                      foreach ($rsServidorTipos as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= isset($fServTipo) && in_array($vObj['id'], $fServTipo) ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="uo">SECRETARIA<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select multiple="multiple" id="uo" name="uo[]" class="form-control select2" style="width: 100%;" placeholder="selecione as secretarias dos processos">
                      <option value="0" <?= !isset($fUO) || in_array('0', $fUO) ? 'selected="selected"' : ''; ?>>TODOS</option>
                      <?php
                      foreach ($rsUOs as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= isset($fUO) && in_array($vObj['id'], $fUO) ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="setor">SETOR<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select multiple="multiple" id="setor" name="setor[]" class="form-control select2" style="width: 100%;" placeholder="selecione os setores dos processos">
                      <option value="0" <?= !isset($fSetor) || in_array('0', $fSetor) ? 'selected="selected"' : ''; ?>>TODOS</option>
                      <?php
                      foreach ($rsSetores as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= isset($fSetor) && in_array($vObj['id'], $fSetor) ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button id="btn_limpar" class="btn btn-rounded btn-warning mr-1">
                <i class="ti-eraser"></i> LIMPAR
              </button>
              <button class="btn btn-rounded btn-info">
                <i class="ti-search"></i><span id="btn_submit"> FILTRAR</span>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>SERVIDORES SEM ATUALIZAÇÃO</strong></h4>
              <input type="hidden" id="titulo_relatorio" value="Relatório de servidores que não iniciaram a atualização cadastral">
            </div>
          </h4>
        </div>
        <div class="box-body">
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="table_modelo_01" class="table table-hover">
              <thead class="bg-inverse">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Matricula</th>
                  <th>CPF</th>
                  <th>Nascimento</th>
                  <th>Secretaria</th>
                  <th>Setor</th>
                  <th>Cargo</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsServidores as $kObj => $vObj) {
                  ?>
                  <tr>
                    <td><?= $kObj+1; ?></td>
                    <td><?= $vObj['nome']; ?></td>
                    <td><?= $vObj['matricula'] . ($vObj['matricula_2'] != '' ? ('<br>'.$vObj['matricula_2']): ''); ?></td>
                    <td><?= $vObj['cpf']; ?></td>
                    <td><?= data_volta($vObj['dt_nascimento']); ?></td>
                    <td><?= $vObj['uo_nome']; ?></td>
                    <td><?= $vObj['setor_nome']; ?></td>
                    <td><?= $vObj['cargo_nome']; ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>