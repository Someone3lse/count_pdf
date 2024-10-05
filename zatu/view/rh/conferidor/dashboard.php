<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  u.id AS id, 
  u.nome, 
  u.cpf, 
  u.dt_nascimento, 
  u.status AS status 
  FROM seg_usuario AS u 
  ORDER BY u.nome ASC;");
$stmt->execute();
$rsUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  a.status, 
  a.seg_usuario_id_conferidor, 
  ua.nome AS conferidor_nome, 
  ua.cpf AS conferidor_cpf, 
  ua.dt_nascimento AS conferidor_dt_nasc
  FROM rh_conferidor AS a 
  LEFT JOIN seg_usuario AS ua oN ua.id = a.seg_usuario_id_conferidor 
  GROUP BY 
  a.status, 
  a.seg_usuario_id_conferidor 
  ORDER BY ua.nome ASC;");
$stmt->execute();
$rsConferidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsConferidores as $kObj => $vObj) {
  $rsConferidores[$kObj]['sas'] = NULL;
  $stmt = $db->prepare('
    SELECT sas.id 
    FROM sacad_servidor_atualizacao_situacao AS sas 
    WHERE sas.seg_usuario_id_conferidor = ? 
    LIMIT 1;');
  $stmt->bindValue(1, $vObj['seg_usuario_id_conferidor']);
  $stmt->execute();
  $rsPesquisa = $stmt->fetch(PDO::FETCH_ASSOC);
  $pesquisaId = $rsPesquisa['id'];
  $rsConferidores[$kObj]['sas'] = $pesquisaId;
  $rsConferidores[$kObj]['uos'] = array();
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
  $rsConferidores[$kObj]['uos'] = $rsUOs;
  foreach ($rsConferidores[$kObj]['uos'] as $kUOs => $vUOs) {
    $rsConferidores[$kObj]['uos'][$kUOs]['setores'] = array();
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
    $rsConferidores[$kObj]['uos'][$kUOs]['setores'] = $rsSetores;
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Validador de Dados</li>
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
              <span id="titulo_form"> NOVO VALIDADOR DE DADOS</span>
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>
        <div class="box-body">
          <form class="" id="form_conferidor" name="form_conferidor" method="post" action="">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="usuario">Usuário<span class="text-danger">*</span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="usuario" class="form-control select2" style="width: 100%;" name="usuario" placeholder="selecione um usuário" required>
                      <option></option>
                      <?php
                      foreach ($rsUsuarios as $kObj => $vObj) {
                        $vOdjInativo = $vObj['status'] == 0 ? 'disabled="disabled"' : '';
                        $vObjInativoDetail = $vObj['status'] == 0 ? '(INATIVO) - ' : '';
                        $hasInativo = 0;
                        ?>
                        <option <?= $vOdjInativo; ?> value="<?= $vObj['id']; ?>"><?= ($vObjInativoDetail.$vObj['nome']. ' - ' . $vObj['cpf']. ' - ' . obterDataBRTimestamp($vObj['dt_nascimento'])); ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="usuario">Setores<span class="text-danger">*</span>: </label>
                </div>
              </div>
            </div>
            <div id="div_setores">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Selecione, primeiro, um usuário!</label>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="usuario">Status do chefe imediato<span class="text-danger"></span>: </label>
                  <br>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" class="filled-in chk-col-primary" id="status_a" name="status_a" checked="true">
                    <label for="status_a">Ativo</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" id="btn_cancelar" class="btn btn-rounded btn-danger mr-1">
                <i class="ti-trash"></i> Cancelar
              </button>
              <button type="submit" class="btn btn-rounded btn-success">
                <i class="ti-save-alt"></i><span id="btn_submit"> Cadastrar</span>
              </button>
            </div>
            <input type="hidden" id="id" name="id" value="">
          </form>
        </div>
      </div>
      <!-- INICIO FILTRO -->
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
                  <label for="validador">VALIDADOR DE DADOS<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="1" id="validador" name="validador" placeholder="Nome do validador" value=""/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="setores">SETORES<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="tipo_processo" name="setores" class="form-control select2_servidor" style="width: 100%;" placeholder="selecione o processo">
                      <option></option>
                      <?php
                      if (isset($rsServidorContrato['rh_servidor_id'])) {
                        ?>
                        <option value="<?= $rsServidorContrato['rh_servidor_id']; ?>" selected="selected"><?= $rsServidorContrato['servidor_nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status">STATUS:<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="status" name="status" class="form-control select2_servidor" style="width: 100%;" placeholder="selecione o status">
                      <option></option>
                      <?php
                      if (isset($rsServidorContrato['rh_servidor_id'])) {
                        ?>
                        <option value="<?= $rsServidorContrato['rh_servidor_id']; ?>" selected="selected"><?= $rsServidorContrato['servidor_nome']; ?></option>
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
              <div class="icon rounded-circle font-size-30"><i class="fal fa-home-lg mr-10"></i></div>
              <span id="titulo_form"> LISTA DE VALIDADORES DE DADOS</span>
              <input type="hidden" id="titulo_relatorio" value="Relatório de servidores responsáveis por análise documental do setor/secretaria">
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>
        <div class="box-body">
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="table_modelo_01" class="table table-hover">
              <thead class="bg-inverse">
                <tr>
                  <th>#</th>
                  <th>Validador de dados</th>
                  <th>Setores</th>
                  <th>Status</th>
                  <th class="no-print" width="160px !important"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsConferidores as $kObj => $vObj) {
                  $excluirDisable = !is_null($vObj['sas'])  ? 'negado="true" data-toggle="tooltip" title="Este registro não pode ser exlcuido pois está vinculado a um contrato de servidor!" onclick="return null;"' : '';
                  ?>
                  <tr>
                    <input type="hidden" id="td_id" value="<?= $vObj['seg_usuario_id_conferidor']; ?>">
                    <td id="td_count"><?= $kObj+1; ?></td>
                    <td id="td_nome">Nome: <?= $vObj['conferidor_nome']; ?><br>CPF: <?= $vObj['conferidor_cpf']; ?><br>Data Nasc.: <?= obterDataBRTimestamp($vObj['conferidor_dt_nasc']); ?></td>
                    <td id="td_setores">
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
                    <td id="td_status" value="<?= $vObj['status'];?>"><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                    <td>
                      <button type="button" id="btn_editar_registro" class="btn_editar_registro waves-effect waves-light btn btn-warning btn-rounded" onclick="btnEditar(this);">
                        <i class="fa fa-edit"></i> Editar
                      </button>
                      <button type="button" id="btn_excluir_registro" class="btn_excluir_registro waves-effect waves-light btn btn-danger btn-rounded" <?= $excluirDisable; ?> onclick="btnExcluir(this);">
                        <i class="fa fa-trash"></i> Excluir
                      </button>
                    </td>
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
    <!-- /.content -->
  </div>
</div>
<!-- Modal End -->
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/conferidor/dashboard.js"></script>