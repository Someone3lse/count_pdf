<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db                 = Conexao::getInstance();
$fUsuarioNome       = !isset($_POST['usuario']) ? NULL : $_POST['usuario'];
$stmt = $db->prepare("
  SELECT 
  u.id, 
  u.nome, 
  u.dt_nascimento, 
  u.sexo, 
  u.login, 
  u.cpf, 
  u.foto, 
  u.end_cep, 
  u.end_logradouro, 
  u.end_numero, 
  u.end_complemento, 
  u.end_bairro, 
  u.bsc_municipio_id AS municipio_id, 
  u.tel_fixo, 
  u.tel_celular, 
  u.email_pessoal, 
  u.email_institucional,  
  u.nivel_acesso, 
  u.status, 
  u.online, 
  u.dt_cadastro, 
  m.bsc_estado_id AS estado_id
  FROM seg_usuario AS u 
  LEFT JOIN bsc_municipio AS m ON m.id = u.bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
  WHERE 1 = 1 "
  . ($fUsuarioNome         == "" ? "" : "AND UPPER(u.nome) LIKE '%".strtoupper($fUsuarioNome)."%' ")
  . "ORDER BY u.nome ASC;");
$stmt->execute();
$rsUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rsUsuario as $kObj => $vObj) {
  $stmt = $db->prepare("
    SELECT 
    ua.id, 
    ua.permissao_seg_usuario_id, 
    ua.seg_acao_id, 
    ua.status 
    FROM seg_usuario_acao AS ua 
    WHERE ua.permissao_seg_usuario_id = ? 
    ORDER BY ua.seg_acao_id ASC;");
  $stmt->bindValue(1, $vObj['id']);
  $stmt->execute();
  $rsUsuarioAcoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$stmt = $db->prepare("
  SELECT 
  id, 
  nome, 
  status  
  FROM seg_acao
  ORDER BY id ASC;");
$stmt->execute();
$rsAcoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
                  <label for="usuario">USUÁRIO<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nome do Usuário" value="<?= $fUsuarioNome ;?>"/>
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
              <h4 id="titulo_pagina" class="box-title font-size-16"><strong>USUÁRIO</strong></h4>
              <input type="hidden" id="titulo_relatorio" value="Relatório de usuários cadastrados no sistema">
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
                  <th>Login</th>
                  <th>CPF</th>
                  <th>Nascimento</th>
                  <th>Contatos</th>
                  <th>E-mails</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsUsuario as $kObj => $vObj) {
                  $contatos = $vObj['tel_fixo'] != '' && $vObj['tel_celular'] != '' ? $vObj['tel_fixo'].'<br/>'.$vObj['tel_celular'] : ($vObj['tel_fixo'] != '' ? $vObj['tel_fixo'] : $vObj['tel_celular']);
                  $emails = $vObj['email_institucional'] != '' && $vObj['email_pessoal'] != '' ? $vObj['email_institucional'].'<br/>'.$vObj['email_pessoal'] : ($vObj['email_institucional'] != '' ? $vObj['email_institucional'] : $vObj['email_pessoal']);
                  $btnAtivar = $vObj['status'] == 1 ? 'style="display: none;"' : 'style="display: all;"';
                  $btnInativar = $vObj['status'] == 0 ? 'style="display: none;"' : 'style="display: all;"';
                  ?>
                  <tr>
                    <td><?= $kObj+1; ?></td>
                    <td><?= $vObj['nome']; ?></td>
                    <td><?= $vObj['login']; ?></td>
                    <td><?= $vObj['cpf']; ?></td>
                    <td><?= data_volta($vObj['dt_nascimento']); ?></td>
                    <td><?= $contatos; ?></td>
                    <td><?= $emails; ?></td>
                    <td id="td_status" value="<?= $vObj['status'];?>"><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/relatorio/seg/usuario.js"></script>