<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db                 = Conexao::getInstance();
$fServidorNome      = !isset($_POST['servidor']) ? NULL : $_POST['servidor'];
$fUO                = !isset($_POST['uo']) ? NULL : (in_array('0', $_POST['uo']) ? NULL : $_POST['uo']);
$fSetor             = !isset($_POST['setor']) ? NULL : (in_array('0', $_POST['setor']) ? NULL : $_POST['setor']);
$stmt = $db->prepare("
  SELECT             
  ua.nome AS atestador_nome, 
  ua.cpf AS atestador_cpf, 
  ua.dt_nascimento AS atestador_dt_nasc, 
  a.status, 
  a.seg_usuario_id_conferidor 
  FROM rh_conferidor AS a 
  LEFT JOIN seg_usuario AS ua oN ua.id = a.seg_usuario_id_conferidor 
  LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suo.eo_setor_id 
  WHERE 1 = 1 "
  . ($fServidorNome     == "" ? "" : "AND UPPER(ua.nome) LIKE '%".strtoupper($fServidorNome)."%' ")
  . ($fUO               == NULL ? "" : "AND suo.bsc_unidade_organizacional_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fUO)))." ")
  . ($fSetor            == NULL ? "" : "AND suo.eo_setor_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fSetor)))." ")
  . "GROUP BY 
  a.status, 
  a.seg_usuario_id_conferidor 
  ORDER BY ua.nome ASC;");
$stmt->execute();
$rsAtestadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsAtestadores as $kObj => $vObj) {
  $rsAtestadores[$kObj]['uos'] = array();
  $stmt = $db->prepare("
    SELECT 
    uo.id, 
    uo.nome AS uo_nome 
    FROM rh_conferidor AS a 
    LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
    LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suo.bsc_unidade_organizacional_id 
    WHERE a.seg_usuario_id_conferidor = ? 
    GROUP BY uo.id 
    ORDER BY uo.nome ASC;");
  $stmt->bindValue(1, $vObj['seg_usuario_id_conferidor']);
  $stmt->execute();
  $rsUOs = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $rsAtestadores[$kObj]['uos'] = $rsUOs;
  foreach ($rsAtestadores[$kObj]['uos'] as $kUOs => $vUOs) {
    $rsAtestadores[$kObj]['uos'][$kUOs]['setores'] = array();
    $stmt = $db->prepare("
      SELECT 
      s.id, 
      s.nome AS setor_nome 
      FROM rh_conferidor AS a 
      LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
      LEFT JOIN eo_setor AS s ON s.id = suo.eo_setor_id 
      WHERE a.seg_usuario_id_conferidor = ? AND suo.bsc_unidade_organizacional_id = ? 
      ORDER BY s.nome ASC;");
    $stmt->bindValue(1, $vObj['seg_usuario_id_conferidor']);
    $stmt->bindValue(2, $vUOs['id']);
    $stmt->execute();
    $rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rsAtestadores[$kObj]['uos'][$kUOs]['setores'] = $rsSetores;
  }
}
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
  SELECT 
  s.id, 
  s.numero, 
  s.nome 
  FROM eo_setor_unidade_organizacional AS suo
  LEFT JOIN eo_setor AS s ON s.id = suo.eo_setor_id
  GROUP BY s.id 
  ORDER BY s.nome ASC;");
$stmt->execute();
$rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Validadores do RH</li>
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
              <div class="col-md-12">
                <div class="form-group">
                  <label for="servidor">VALIDADOR<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" id="servidor" name="servidor" placeholder="Nome do Validador" value="<?= $fServidorNome ;?>"/>
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
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>VALIDADORES DO RH</strong></h4>
              <input type="hidden" id="titulo_relatorio" value="Relatório de servidores responsáveis por análise documental do setor/secretaria">
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
                  <th>Validador</th>
                  <th>Setores</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsAtestadores as $kObj => $vObj) {
                  ?>
                  <tr>
                    <td><?= $kObj+1; ?></td>
                    <td>Nome: <?= $vObj['atestador_nome']; ?><br>CPF: <?= $vObj['atestador_cpf']; ?><br>Data Nasc.: <?= obterDataBRTimestamp($vObj['atestador_dt_nasc']); ?></td>
                    <td>
                      <?php 
                      foreach ($vObj['uos'] as $kUOs => $vUOs) {
                        echo '<b>' . $vUOs['uo_nome'] . ': </b><br>'; 
                        foreach ($vUOs['setores'] as $kSetor => $vSetor) {
                          if (!(sizeof($vUOs['setores']) - 1) == $kSetor) {
                            echo ' ' . $vSetor['setor_nome'] . ';'; 
                          } else {
                            echo ' ' . $vSetor['setor_nome'] . '.<br>';
                          }
                        }
                      }
                      ?>
                    </td>
                    <td><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/relatorio/rh/validador.js"></script>