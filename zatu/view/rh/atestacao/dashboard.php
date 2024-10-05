<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
if(!sizeof($rsPermiteAtestar) > 0) {
  echo "
  <script 'text/javascript'>
  alert('O seu usuário não tem permissão para acessar esta página!')
  window.location = '" . PORTAL_URL . "dashboard';
  </script>
  ";
}
$db = Conexao::getInstance();
$fAtualizacaoTipo   = !isset($_POST['atualizacao_tipo']) ? NULL : ($_POST['atualizacao_tipo'] == '0' ? NULL : $_POST['atualizacao_tipo']);
$fServidorNome      = !isset($_POST['servidor']) ? NULL : $_POST['servidor'];
$fUO                = !isset($_POST['uo']) ? NULL : (in_array('0', $_POST['uo']) ? NULL : $_POST['uo']);
$fSetor             = !isset($_POST['setor']) ? NULL : (in_array('0', $_POST['setor']) ? NULL : $_POST['setor']);
$fDtInicio          = !isset($_POST['dt_inicio']) ? NULL : $_POST['dt_inicio'];
$fDtFim             = !isset($_POST['dt_fim']) ? NULL : $_POST['dt_fim'];
$stmt = $db->prepare("
  SELECT 
  s.id, 
  s.nome, 
  s.cpf, 
  s.matricula, 
  s.rh_servidor_tipo_id, 
  stipo.nome AS serv_tipo_nome, 
  s.eo_cargo_id, 
  c.nome AS cargo_nome, 
  sa.eo_setor_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  st.nome AS setor_nome, 
  sa.rh_situacao_trabalho_id, 
  sitt.nome AS sit_trab_nome, 
  sa.atestacao_matricula, 
  s.matricula_2, 
  s.rh_servidor_tipo_id_2, 
  stipo2.nome AS serv_tipo_nome_2, 
  s.eo_cargo_id_2, 
  c2.nome AS cargo_nome_2, 
  sa.eo_setor_unidade_organizacional_id_2, 
  uo2.nome AS uo_nome_2, 
  st2.nome AS setor_nome_2, 
  sa.rh_situacao_trabalho_id_2, 
  sitt2.nome AS sit_trab_nome_2, 
  sa.atestacao_matricula_2, 
  sa.status, 
  sa.dt_cadastro, 
  sa.dt_envio, 
  sa.id AS atualizacao_id, 
  sa.tipo_atualizacao ,
  suosa.eo_setor_id AS sa_setor_id, 
  st.nome AS sa_setor_nome, 
  sas.sacad_situacao_servidor_atualizacao_id, 
  sas.seg_usuario_id_atestador 
  FROM rh_servidor AS s 
  LEFT JOIN sacad_servidor_atualizacao AS sa ON sa.rh_servidor_id = s.id 
  LEFT JOIN eo_setor_unidade_organizacional AS suosa ON suosa.id = sa.eo_setor_unidade_organizacional_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = suosa.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st ON st.id = suosa.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt ON sitt.id = sa.rh_situacao_trabalho_id 
  LEFT JOIN eo_setor_unidade_organizacional AS suosa2 ON suosa2.id = sa.eo_setor_unidade_organizacional_id_2 
  LEFT JOIN bsc_unidade_organizacional AS uo2 ON uo2.id = suosa2.bsc_unidade_organizacional_id 
  LEFT JOIN eo_setor AS st2 ON st2.id = suosa2.eo_setor_id 
  LEFT JOIN rh_situacao_trabalho AS sitt2 ON sitt2.id = sa.rh_situacao_trabalho_id_2 
  LEFT JOIN sacad_servidor_atualizacao_situacao AS sas ON sas.sacad_servidor_atualizacao_id = sa.id 
  LEFT JOIN seg_usuario AS u ON u.id = sas.seg_usuario_id_atestador 
  LEFT JOIN rh_servidor_tipo AS stipo ON stipo.id = sa.rh_servidor_tipo_id 
  LEFT JOIN rh_servidor_tipo AS stipo2 ON stipo2.id = sa.rh_servidor_tipo_id_2 
  LEFT JOIN eo_cargo AS c ON c.id = sa.eo_cargo_id 
  LEFT JOiN eo_cargo AS c2 ON c2.id = sa.eo_cargo_id_2 
  WHERE 
  sas.id IN (
    SELECT MAX(id) AS id 
    FROM sacad_servidor_atualizacao_situacao AS auxsas 
    WHERE auxsas.sacad_servidor_atualizacao_id = sa.id AND auxsas.sacad_situacao_servidor_atualizacao_id IN (2, 13)) "
  . ($fAtualizacaoTipo  == NULL ? "" : "AND sa.tipo_atualizacao = ".$fAtualizacaoTipo." ")
  . ($fServidorNome     == "" ? "" : "AND UPPER(s.nome) LIKE '%".strtoupper($fServidorNome)."%' ")
  . ($fUO               == NULL ? "" : "AND (suosa.bsc_unidade_organizacional_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fUO)))." OR suosa2.bsc_unidade_organizacional_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fUO))).") ")
  . ($fSetor            == NULL ? "" : "AND (suosa.eo_setor_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fSetor)))." OR suosa2.eo_setor_id IN ".str_replace('[', '(', str_replace(']', ')', json_encode($fSetor))).") ")
  . ($fDtInicio         == "" ? "" : "AND sa.dt_envio >= '".formata_data($fDtInicio)."' ")
  . ($fDtFim            == "" ? "" : "AND sa.dt_envio <= '".formata_data($fDtFim)." 23:59:00' ")
  . "ORDER BY s.nome ASC");
$stmt->execute();
$rsServidoresAtestacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsServidoresAtestacao as $kObj => $vObj) {
  $stmt = $db->prepare("
    SELECT 
    sas.id, 
    sas.obs, 
    sas.matricula, 
    sas.matricula_2, 
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
  $rsServidorSituacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (sizeof($rsServidorSituacao) <= 0) {
    $rsServidoresAtestacao[$kObj]['situacaoServidorPrimeiro']['dt_cadastro'] = '';
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima']['id'] = 1;
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima']['nome'] = 'Aguardando preenchimento total';
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima']['etapa'] = '';
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima']['usuario_nome'] = '';
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima']['dt_cadastro'] = '';
  } else {
    $rsServidoresAtestacao[$kObj]['situacoes'] = $rsServidorSituacao;
    $rsServidoresAtestacao[$kObj]['situacaoServidorPrimeiro'] = sizeof($rsServidorSituacao) > 0 ? $rsServidorSituacao[0] : NULL;
    $rsServidoresAtestacao[$kObj]['situacaoServidorUltima'] = end($rsServidorSituacao);
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
            <li class="breadcrumb-item active" aria-current="page">Servidores</li>
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
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-group">
                    <label for="atualizacao_tipo">PROCESSO<span class="text-danger"></span>: </label>
                    <div class="input-group mb-3 controls">
                      <select id="atualizacao_tipo" name="atualizacao_tipo" class="form-control select2" placeholder="selecione o processo">
                        <option value="0">TODOS</option>
                        <option value="2" <?= $fAtualizacaoTipo == 2 ? 'selected="selected"' : '' ;?>>RECADASTRAMENTO ANUAL</option>
                        <option value="1" <?= $fAtualizacaoTipo == 1 ? 'selected="selected"' : '' ;?>>ALTERAÇÃO DE DADOS</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="servidor">SERVIDOR<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" id="servidor" name="servidor" placeholder="Nome do Servidor" value="<?= $fServidorNome ;?>"/>
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dt_inicio">DATA INICIAL DE CRIAÇÃO: <span class="text-danger"></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_inicio" name="dt_inicio" placeholder="Data início de criação" title="exemplo: 31/12/2022" value="<?= $fDtInicio ;?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dt_fim">DATA FINAL DE CRIAÇÃO: <span class="text-danger"></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_fim" name="dt_fim" placeholder="Data fim de criação" title="exemplo: 31/12/2022" value="<?= $fDtFim ;?>"/>
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
              <span id="titulo_form"> SERVIDORES AGUARDANDO ATESTAÇÃO DE VÍNCULO</span>
              <input type="hidden" id="titulo_relatorio" value="Relatório de servidores que estão aguardando atestação de vinculo pelo chefe imediato">
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>

        <div class="box-body">
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="tableDashboard" class="table table-hover">
              <thead class="bg-inverse">
                <tr>
                  <th>#</th>
                  <th>SERVIDOR</th>
                  <th>SITUAÇÃO</th>
                  <th>SETOR</th>
                  <th>DATA</th>
                  <th class="no-print" width="160px !important"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $countMatriculas = 0;
                foreach ($rsServidoresAtestacao as $kObj => $vObj) {
                  if (in_array($vObj['sacad_situacao_servidor_atualizacao_id'], [2, 13]) && (in_array($vObj['eo_setor_unidade_organizacional_id'], array_column($rsSetoresChefeImediato, 'suo_id')) && $vObj['atestacao_matricula'] == NULL)){
                    $countMatriculas++;
                    ?>
                    <tr>
                      <input type="hidden" id="td_id" value="<?= $vObj['atualizacao_id']; ?>">
                      <input type="hidden" id="td_contrato" value="1">
                      <input type="hidden" id="td_matricula" value="<?= $vObj['matricula']; ?>">
                      <input type="hidden" id="td_nome" value="<?= $vObj['nome']; ?>">
                      <input type="hidden" id="td_situacao" value="<?= $vObj['sit_trab_nome']; ?>">
                      <input type="hidden" id="td_uo" value="<?= $vObj['uo_nome']; ?>">
                      <input type="hidden" id="td_setor" value="<?= $vObj['setor_nome']; ?>">
                      <input type="hidden" id="td_serv_tipo" value="<?= $vObj['serv_tipo_nome']; ?>">
                      <input type="hidden" id="td_cargo" value="<?= $vObj['cargo_nome']; ?>">
                      <input type="hidden" id="td_status" value="<?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?>">
                      <!-- <input type="hidden" id="td_situacao" value="<?= $vObj['situacaoServidorUltima']['situacao_atestacao_nome']; ?>"> -->
                      <td><?= $countMatriculas; ?></td>
                      <td>
                        <strong>NOME:</strong> <br />
                        <i><?= $vObj['nome']; ?></i><br/>
                        <strong>Matrícula:</strong><br/>
                        <i><?= $vObj['matricula']; ?></i>
                      </td>
                      <td id="td_feedback_status">Situação: <?= $vObj['sit_trab_nome']; ?><br/>Detalhe: <?= $vObj['situacaoServidorUltima']['nome']; ?></td>
                      <td><b><?= $vObj['uo_nome']; ?></b>: <?= $vObj['setor_nome']; ?></td>
                      <td>Criação: <?= obterDataHoraBRTimestamp($vObj['situacaoServidorPrimeiro']['dt_cadastro']); ?><br/>Alteração: <?= obterDataHoraBRTimestamp($vObj['situacaoServidorUltima']['dt_cadastro']); ?></td>
                      <td>
                        <?php 
                        if ($vObj['status'] == 1) {
                          ?>
                          <button type="button" id="btn_atestar_registro" class="waves-effect waves-light btn btn-success btn-rounded"  data-toggle="modal" data-target="#modal_atestacao" onclick="btnAtestacaoRegistro($(this), 'atesta');">
                            <i class="fa fa-file-text"></i> Atestar
                          </button>
                          <button type="button" id="btn_recusar_registro" class="waves-effect waves-light btn btn-danger btn-rounded"  data-toggle="modal" data-target="#modal_atestacao" onclick="btnAtestacaoRegistro($(this), 'recusa');">
                            <i class="fa fa-file-text"></i> Recussar
                          </button>
                          <?php 
                        }
                        ?>
                        <button type="button" id="btn_atestar_registro" class="waves-effect waves-light btn btn-info btn-rounded"  data-toggle="modal" data-target="#modal_verificacao" onclick="btnVerificarRegistro($(this));">
                          <i class="fa fa-file-text"></i> Verificar
                        </button>
                        <!-- <button type="button" id="btn_editar_registro" class="btn_editar_registro waves-effect waves-light btn btn-warning btn-rounded" onclick="btnEditar(this);">
                          <i class="fa fa-edit"></i> Editar
                        </button> -->
                      </td>
                    </tr>
                    <?php
                  }
                  if (in_array($vObj['sacad_situacao_servidor_atualizacao_id'], [2, 13]) && (in_array($vObj['eo_setor_unidade_organizacional_id_2'], array_column($rsSetoresChefeImediato, 'suo_id')) && $vObj['matricula_2'] != NULL && $vObj['atestacao_matricula_2'] == NULL)){

                    $countMatriculas++;
                    ?>
                    <tr>
                      <input type="hidden" id="td_id" value="<?= $vObj['atualizacao_id']; ?>">
                      <input type="hidden" id="td_contrato" value="2">
                      <input type="hidden" id="td_matricula" value="<?= $vObj['matricula_2']; ?>">
                      <input type="hidden" id="td_nome" value="<?= $vObj['nome']; ?>">
                      <input type="hidden" id="td_situacao" value="<?= $vObj['sit_trab_nome_2']; ?>">
                      <input type="hidden" id="td_uo" value="<?= $vObj['uo_nome_2']; ?>">
                      <input type="hidden" id="td_setor" value="<?= $vObj['setor_nome_2']; ?>">
                      <input type="hidden" id="td_serv_tipo" value="<?= $vObj['serv_tipo_nome_2']; ?>">
                      <input type="hidden" id="td_cargo" value="<?= $vObj['cargo_nome_2']; ?>">
                      <input type="hidden" id="td_status" value="<?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?>">
                      <!-- <input type="hidden" id="td_situacao" value="<?= $vObj['situacaoServidorUltima']['situacao_atestacao_nome']; ?>"> -->
                      <td><?= $countMatriculas; ?></td>
                      <td>
                        <strong>NOME:</strong> <br />
                        <i><?= $vObj['nome']; ?></i><br/>
                        <strong>Matrícula:</strong><br/>
                        <i><?= $vObj['matricula_2']; ?></i>
                      </td>
                      <td id="td_feedback_status">Situação: <?= $vObj['sit_trab_nome_2']; ?><br/>Detalhe: <?= $vObj['situacaoServidorUltima']['nome']; ?></td>
                      <td><b><?= $vObj['uo_nome_2']; ?></b>: <?= $vObj['setor_nome_2']; ?></td>
                      <td>Criação: <?= obterDataHoraBRTimestamp($vObj['situacaoServidorPrimeiro']['dt_cadastro']); ?><br/>Alteração: <?= obterDataHoraBRTimestamp($vObj['situacaoServidorUltima']['dt_cadastro']); ?></td>
                      <td>
                        <?php 
                        if ($vObj['status'] == 1) {
                          ?>
                          <button type="button" id="btn_atestar_registro" class="waves-effect waves-light btn btn-success btn-rounded"  data-toggle="modal" data-target="#modal_atestacao" onclick="btnAtestacaoRegistro($(this), 'atesta');">
                            <i class="fa fa-file-text"></i> Atestar
                          </button>
                          <button type="button" id="btn_recusar_registro" class="waves-effect waves-light btn btn-danger btn-rounded"  data-toggle="modal" data-target="#modal_atestacao" onclick="btnAtestacaoRegistro($(this), 'recusa');">
                            <i class="fa fa-file-text"></i> Recussar
                          </button>
                          <?php 
                        }
                        ?>
                        <button type="button" id="btn_atestar_registro" class="waves-effect waves-light btn btn-info btn-rounded"  data-toggle="modal" data-target="#modal_verificacao" onclick="btnVerificarRegistro($(this));">
                          <i class="fa fa-file-text"></i> Verificar
                        </button>
                        <!-- <button type="button" id="btn_editar_registro" class="btn_editar_registro waves-effect waves-light btn btn-warning btn-rounded" onclick="btnEditar(this);">
                          <i class="fa fa-edit"></i> Editar
                        </button> -->
                      </td>
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
<!-- Modal -->
<div class="modal fade" id="modal_atestacao" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ATESTAÇÃO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="text-center confirmacao">Você confirma que o servidor abaixo trabalha neste setor?</strong>
        <div class="usuario-atestacao" style="display: block;">
          <div class="row">
            <div id="div_contrato" class="col-md-2">
              <span>Contrato</span><br>
              <p></p>
            </div>
            <div id="div_matricula" class="col-md-2">
              <span>Matrícula</span><br>
              <p></p>
            </div>
            <div id="div_nome" class="col-md-8">
              <span>Servidor</span><br>
              <p></p>
            </div>
          </div>
          <br>
          <div class="row">
            <div id="div_uo" class="col-md-6">
              <span>Órgão/Secretaria</span><br>
              <p></p>
            </div>
            <div id="div_setor" class="col-md-6">
              <span>Setor</span><br>
              <p></p>
            </div>
          </div>
          <br/>
          <div class="row">
            <div id="div_serv_tipo" class="col-md-4">
              <span>Tipo de Contrato</span><br>
              <p></p>
            </div>
            <div id="div_cargo" class="col-md-4">
              <span>Cargo</span><br>
              <p></p>
            </div>
            <div id="div_situacao" class="col-md-4">
              <span>Situação</span><br>
              <p></p>
            </div>
          </div>
        </div>
        
        <div id="div_justificativa" class="justificativa" style="display: none;">
          <div class="row">
            <div class="col-md-12">
              <textarea name="justificativa_a" id="justificativa_a" class="form-control" placeholder="Justifique" cols="30" rows="5" minlength="5" required></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <input type="hidden" id="btn_id" contrato="" value="">
        <button type="button" id="btn_atestar" class="btn_principal btn btn-success" style="display: none;" onclick="btnAtestar($(this));"><i class="fal fa-check"></i> Confirmar Vínculo</button>
        <button type="button" id="btn_recusar" class="btn_principal btn btn-success" style="display: none;" onclick="btnRecusar($(this));">Justificar Recusa de Vínculo</button>
        <button type="button" id="btn_cancelar" class="btn_secundario btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<!-- Modal -->
<div class="modal fade" id="modal_verificacao" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">VERIFICAÇÃO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="text-center confirmacao">Estes são os dados informados pelo Servidor no Recadastramento/Atualização Cadastral.</strong>
        <div class="usuario-atestacao" style="display: block;">
          <div class="row">
            <div id="div_contrato" class="col-md-2">
              <span>Contrato</span><br>
              <p></p>
            </div>
            <div id="div_matricula" class="col-md-2">
              <span>Matrícula</span><br>
              <p></p>
            </div>
            <div id="div_nome" class="col-md-8">
              <span>Servidor</span><br>
              <p></p>
            </div>
          </div>
          <br>
          <div class="row">
            <div id="div_uo" class="col-md-6">
              <span>Órgão/Secretaria</span><br>
              <p></p>
            </div>
            <div id="div_setor" class="col-md-6">
              <span>Setor</span><br>
              <p></p>
            </div>
          </div>
          <br/>
          <div class="row">
            <div id="div_serv_tipo" class="col-md-4">
              <span>Tipo de Contrato</span><br>
              <p></p>
            </div>
            <div id="div_cargo" class="col-md-4">
              <span>Cargo</span><br>
              <p></p>
            </div>
            <div id="div_situacao" class="col-md-4">
              <span>Situação</span><br>
              <p></p>
            </div>
          </div>
        </div>
        
        <div id="div_justificativa" class="justificativa" style="display: none;">
          <div class="row">
            <div class="col-md-12">
              <textarea name="justificativa_a" id="justificativa_a" class="form-control" placeholder="Justifique" cols="30" rows="5" minlength="5" required></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" id="btn_fechar" class="btn_secundario btn btn-info">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/atestacao/dashboard.js"></script>