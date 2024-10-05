<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  sc.id, 
  sc.rh_servidor_id, 
  s.nome AS servidor_nome, 
  sc.rh_servidor_tipo_id, 
  sc.contrato_numero, 
  sc.contrato_dt_inicio, 
  sc.contrato_dt_fim, 
  sc.contrato_fim_indefinido, 
  sc.situacao, 
  sc.bsc_unidade_organizacional_id, 
  uo.nome AS uo_nome, 
  sc.setor, 
  sc.bsc_municipio_id, 
  sc.desligamento_dt, 
  sc.desligamento_tipo, 
  sc.status 
  FROM rh_servidor_contrato AS sc 
  LEFT JOIN rh_servidor AS s ON s.id = sc.rh_servidor_id 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uo.id = sc.bsc_unidade_organizacional_id 
  ORDER BY s.nome ASC, sc.contrato_dt_inicio ASC;");
$stmt->execute();
$rsServidorContrato = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Contratos de servidores</li>
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
              <div class="icon rounded-circle font-size-30"><i class="fab fa-black-tie mr-10"></i></div>
              <span id="titulo_form"> LISTA DE CONTRATOS DE SERVIDORES</span>
              <input type="hidden" id="titulo_relatorio" value="Relatório de contratos de servidores cadastrados no sistema">
            </div>
          </h4>
          <a href="cadastrar" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO CONTRATO DE SERVIDOR</a>
        </div>
        <div class="box-body">
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="table_modelo_01" class="table table-hover">
              <thead class="bg-inverse">
                <tr>
                  <th>#</th>
                  <th>Nome do servidor</th>
                  <th>Matrícula</th>
                  <th>Unidade organizacional</th>
                  <th>Data de início</th>
                  <th>Situação</th>
                  <th class="no-print" width="160px !important"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsServidorContrato as $kObj => $vObj) {
                  ?>
                  <tr>
                    <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                    <td><?= $kObj+1; ?></td>
                    <td><?= $vObj['servidor_nome']; ?></td>
                    <td><?= $vObj['contrato_numero']; ?></td>
                    <td><?= $vObj['uo_nome']; ?></td>
                    <td><?= data_volta($vObj['contrato_dt_inicio']); ?></td>
                    <td><?= $vObj['situacao']; ?></td>
                    <td>
                      <button type="button" id="btn_visualizar_registro" class="btn_visualizar_registro waves-effect waves-light btn btn-info btn-rounded" onclick="btnVisualizar(this);">
                        <i class="fa fa-file-text"></i> Ver
                      </button>
                      <button type="button" id="btn_editar_registro" class="btn_editar_registro waves-effect waves-light btn btn-warning btn-rounded"  onclick="btnEditar(this);">
                        <i class="fa fa-edit"></i> Editar
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
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_contrato/dashboard.js"></script>