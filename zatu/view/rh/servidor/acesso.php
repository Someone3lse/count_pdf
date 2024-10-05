<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db = Conexao::getInstance();
$stmt = $db->prepare("SELECT 
  s.id, 
  s.nome, 
  s.cpf, 
  s.dt_nascimento, 
  s.sexo, 
  s.mae_nome, 
  s.matricula, 
  s.matricula_2, 
  s.tel_celular, 
  s.email, 
  s.status, 
  s.dt_cadastro, 
  s.seg_usuario_id 
  FROM seg_servidor AS s 
  ORDER BY s.nome ASC;");
$stmt->execute();
$rsServidor = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="box box-solid bg-info">
      <div class="box-header">
        <h4 class="box-title font-weight-bold">
          <div class="d-flex align-items-center justify-content-between">
            <div class="icon rounded-circle font-size-30"><i class="fal fa-id-badge mr-10"></i></div>
            <h4 id="titulo_pagina" class="box-title font-size-16"><strong>SERVIDORES - ACESSO AO SISTEMA</strong></h4>
            <input type="hidden" id="titulo_relatorio" value="Relatório de servidores cadastrados no sistema">
          </div>
        </h4>
        <a href="<?= PORTAL_URL; ?>view/rh/servidor/cadastrar" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none mt-3">NOVO SERVIDOR</a>
      </div>

      <div class="box-body">
        <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
        <div class="table-responsive">
          <table id="tableDashboard" class="table table-hover">
            <thead class="bg-inverse">
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Nome da mãe</th>
                <th>Matricula</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Status</th>
                <th class="no-print" width="160px !important"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rsServidor as $kObj => $vObj) {
                ?>
                <tr>
                  <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                  <td><?= $kObj+1; ?></td>
                  <td id="td_nome"><?= $vObj['nome']; ?></td>
                  <td><?= $vObj['mae_nome']; ?></td>
                  <td><?= $vObj['matricula'] . ($vObj['matricula_2'] != '' ? ('<br>'.$vObj['matricula_2']): ''); ?></td>
                  <td><?= $vObj['cpf']; ?></td>
                  <td><?= $vObj['email']; ?></td>
                  <td><?= data_volta($vObj['dt_nascimento']); ?></td>
                  <td id="td_status" value="<?= $vObj['status'];?>"><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                  <td>
                    <?php
                    if ($vObj['status'] == 1) {
                      ?>
                      <button type="button" id="btn_resetar_senha" class="btn_resetar_registro waves-effect waves-light btn btn-danger btn-rounded" onclick="btnResetar(this);">
                        <i class="fa fa-file-text"></i> Resetar Senha
                      </button>
                      <?php
                    }
                    ?>
                    <button type="button" id="btn_editar_email" class="btn_editar_registro waves-effect waves-light btn btn-warning btn-rounded" onclick="btnEditar(this);">
                      <i class="fa fa-edit"></i> Alterar e-mail
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
    <!-- /.content -->
  </div>
</div>
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor/acesso.js"></script>