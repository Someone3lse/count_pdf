<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT st.id AS id, 
  st.nome AS nome, 
  st.status AS status, 
  sc.rh_servidor_tipo_id AS sc_id_servidor_tipo 
  FROM rh_servidor_tipo AS st 
  LEFT JOIN rh_servidor_contrato AS sc ON st.id = sc.rh_servidor_tipo_id 
  GROUP BY st.id 
  ORDER BY st.nome ASC");
$stmt->execute();
$rsServidorTipo = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Tipo de Servidor</li>
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
              <span id="titulo_form"> NOVO TIPO DE SERVIDOR</span>
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>
        <div class="box-body">
          <form class="" id="form_servidor_tipo" name="form_servidor_tipo" method="post" action="">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome_st">Nome<span class="text-danger">*</span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="nome_st" name="nome_st" placeholder="Nome do Tipo de Servidor" value="" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <br>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" class="filled-in chk-col-primary" id="status_st" name="status_st" checked="true">
                    <label for="status_st">Ativo</label>
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
        <!-- /.box -->    
      </div>
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fab fa-black-tie mr-10"></i></div>
              <span id="titulo_form"> LISTA DE TIPOS DE SERVIDOR</span>
              <input type="hidden" id="titulo_relatorio" value="Relatório de tipos de servidores cadastrados no sistema">
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
                  <th>Nome</th>
                  <th>Status</th>
                  <th class="no-print" width="160px !important"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($rsServidorTipo as $kObj => $vObj) {
                  $excluirDisable = !is_null($vObj['sc_id_servidor_tipo']) ? 'negado="true" data-toggle="tooltip" title="Este registro não pode ser exlcuido pois está vinculado a um contrato de servidor!" onclick="return null;"' : '';
                  ?>
                  <tr>
                    <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                    <td id="td_count"><?= $kObj+1; ?></td>
                    <td id="td_nome"><?= $vObj['nome']; ?></td>
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
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_tipo/dashboard.js"></script>