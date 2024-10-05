<?php
include_once ('template/servidor_topo.php');
include_once ('template/servidor_header.php');
include_once ('template/servidor_sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Recadastramento e Alteração de dados</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div>
        <ul class="lista_processos row">
          <?php 
          if (
            sizeof($rsServidorAtualizacoes) <= 0 
            || 
            (
              sizeof($rsServidorAtualizacoes) > 0 
              && 
              end($rsServidorAtualizacoes)['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 10 
              && 
              (
                ($rsSegServidor['ano_hoje'] > end($rsServidorAtualizacoes)['situacaoServidorUltima']['ano'] 
                  ? ($rsSegServidor['ano_hoje'] - end($rsServidorAtualizacoes)['situacaoServidorUltima']['ano']) * 12 + $rsSegServidor['mes_hoje'] 
                  : $rsSegServidor['mes_hoje']
                ) - end($rsServidorAtualizacoes)['situacaoServidorUltima']['mes'] > 3
              )
              &&
              $rsSegServidor['mes_hoje'] == end($rsServidorAtualizacoes)['nasc_mes']
            )
          ) 
          {
            ?>
            <li class="col-md-5">
              <a href="#" id="a_recadastro" class="btn btn-info">
                <i class="fal fa-search"></i>
                RECADASTRAMENTO ANUAL
              </a>
            </li>
            <?php
          } else {
            ?>
            <li class="col-md-5" style="pointer-events:none; opacity:0.6;">
              <a href="#" id="a_recadastro" negado="true" class="btn btn-info" title="Neste momento você não pode iniciar um novo recadastramento anual">
                <i class="fal fa-search"></i>
                RECADASTRAMENTO ANUAL
              </a>
              <span>Neste momento você não pode iniciar um novo processo de recadastramento anual</span>
            </li>
            <?php
          }
          if (
            sizeof($rsServidorAtualizacoes) > 0 
            && 
            end($rsServidorAtualizacoes)['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 10 
            && 
            $rsSegServidor['mes_hoje'] != end($rsServidorAtualizacoes)['nasc_mes']
          ) {
            ?>
            <li class="col-md-5">
              <a href="#" id="a_atualizacao" class="btn btn-success">
                <i class="fal fa-plus"></i>
                CRIAR PROCESSO DE ALTERAÇÃO DE DADOS
              </a>
            </li>
            <?php
          } else {
            ?>
            <li class="col-md-5" style="pointer-events:none; opacity:0.6;">
              <a href="#" id="a_atualizacao" negado="true" class="btn btn-success" title="Neste momento você não pode iniciar um novo alteração de dados">
                <i class="fal fa-plus"></i>
                CRIAR PROCESSO DE ALTERAÇÃO DE DADOS
              </a>
              <span>Neste momento você não pode iniciar um novo processo de alteração de dados</span>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
      <hr>
      <div class="row mt-20">
        <div class="col-md-12">
          <div class="box box-outline-info">
            <div class="box-header">
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>LISTA DE PROCESSOS</strong></h4>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="tableDashboard" class="table table-hover" class="">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>PROCESSO</th>
                      <th>SERVIDOR</th>
                      <th>STATUS</th>
                      <th>DATA</th>
                      <th class="no-print">PROCESSO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($rsServidorAtualizacoes as $kObj => $vObj) {
                      ?>
                      <tr>
                        <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                        <td><?= $kObj+1; ?></td>
                        <td><span class="badge <?= $vObj['tipo_atualizacao'] == 2 ? 'badge-info' : 'badge-success' ;?>"><?= $vObj['tipo_atualizacao'] == 2 ? 'RECADASTRAMENTO' : 'ATUALIZAÇÃO DE DADOS'; ?></span></td>
                        <td>
                          <strong><?= $vObj['nome']; ?></strong><br/>
                          Matrícula: <br><strong><?= $rsSegServidor['matricula']; ?></strong>
                        </td>
                        <td>
                          <strong><?= $vObj['situacaoServidorUltima']['situacao_atualizacao_nome']; ?></strong><br/>
                          Etapa: <span class="badge badge-success"><?= $vObj['situacaoServidorUltima']['situacao_etapa']; ?></span><br/>
                          Responsavel: <br><strong><?= $vObj['situacaoServidorUltima']['usuario_nome']; ?></strong>
                        </td>
                        <td>
                          Criação: <strong><?= obterDataHoraBRTimestamp($vObj['situacaoServidorPrimeiro']['dt_cadastro']); ?></strong><br/>
                          Alteração: <strong><?= $vObj['situacaoServidorPrimeiro'] != $vObj['situacaoServidorUltima'] ? obterDataHoraBRTimestamp($vObj['situacaoServidorUltima']['dt_cadastro']) : ''; ?></strong>
                        </td>
                        <td>
                          <?php 
                          if (in_array($vObj['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'], [1, 2, 5])) {
                            ?>
                            <button class="waves-effect waves-light btn btn-warning btn-rounded" style="font-size: 12px; min-width: 130px; padding: 4px 2px;" onclick="btnContinuarProcesso();"><i class="fal fa-edit"></i> CONTINUAR PROCESSO</button>
                            <?php 
                          }
                          if (in_array($vObj['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'], [8, 11, 12, 13])) {
                            ?>
                            <button class="waves-effect waves-light btn btn-warning btn-rounded" style="font-size: 12px; min-width: 130px; padding: 4px 2px;" onclick="btnContinuarProcesso();"><i class="fal fa-edit"></i> CORRIGIR PROCESSO</button>
                            <?php 
                          }
                          ?>
                          <button class="waves-effect waves-light btn btn-info btn-rounded" style="font-size: 12px; min-width: 130px; padding: 4px 2px;" onclick="btnVisualizar(<?= $vObj['rh_servidor_id']; ?>);"><i class="fal fa-search"></i> VER PROCESSO</button>
                          <?php
                          if ($vObj['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] != 1) {
                            ?>
                            <button class="waves-effect waves-light btn btn-success btn-rounded" style="font-size: 12px; min-width: 130px; padding: 4px 2px;" onclick="btnVerProtocolo(<?= $vObj['id']; ?>);"><i class="fal fa-search"></i> VER PROTOCOLO</button>
                            <?php
                          }
                          ?>
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
        </div>
      </div>
      <hr>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?php
include_once ('template/servidor_footer.php');
include_once ('template/servidor_control_sidebar.php');
include_once ('template/servidor_rodape.php');
if (isset($_POST['autenticacao']) && isset($_POST['id'])) {
  ?>
  <script type="text/javascript">
    $(document).ready(function() {
      postToURL(PORTAL_URL + 'view/sacad/servidor_atualizacao/mensagem', {id: <?=$_POST['id']?>}, 'POST', '_blanck');
    });
  </script>
  <?php
}
?>