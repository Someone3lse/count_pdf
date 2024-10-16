<?php
include_once ('template/topo.php');
include_once ('template/header.php');

$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  a.id, 
  a.nome, 
  a.nome_fisico, 
  a.tamanho, 
  a.qtd_pag, 
  a.status, 
  a.dt_cadastro, 
  a.dt_exclusao 
  FROM arquivo AS a 
  ORDER BY a.nome ASC;");
$stmt->execute();
$rsArquivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
  <!-- Main content -->
  <section class="">
    <br>
    <div class="box-body container-full">
      <div class="content-header">
        <div class="d-inline-block align-items-center col-md-12">
          <nav>
            <div class="row">
              <div class="col-md-11">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><i class="bi bi-window-plus"></i></li>
                  <li class="breadcrumb-item active" aria-current="page">Cadastro de novos arquivos PDF para contagem de páginas</li>
                </ol>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= PORTAL_URL; ?>logout';">Logout</button>
              </div>
            </div>
          </nav>
        </div>
      </div>
      <br>
      <div class="">
        <div class="">
          <form class="" id="frm_arquivo" name="frm_arquivo" method="post" action="">
            <label for="upload_input" class="btn btn-primary mb-4"><i class="bi bi-file-earmark-arrow-up"></i> Selecione os arquivos PDF para contar suas páginas:</label>
            <input id="upload_input" type="file" name="upload[]" class="d-none mb-3" multiple="multiple" accept="application/pdf" onchange="window.breakIntoSeparateFiles(this, '#file-list', '#file-preview')"/>
            <template id="file-preview">
              <div class="file-preview mb-2">
                <span class="file-name"></span>
                <button class="btn btn-sm btn-danger ml-2" onclick="$(this).closest('.file-preview').remove(); buttonsController();">&times;</button>
                <input class="d-none arquivo" id="arquivo" multiple="multiple" type="file" name="arquivo[]">
              </div>
            </template>
            <div id="file-list" class="mb-4"></div>


            <!-- /.box-body -->
            <div class="box-footer text-center" id="div_buttons" style="display: none;">
              <button type="reset" id="btn_limpar" class="btn btn-rounded btn-warning mr-1">
                <i class="bi bi-eraser"></i> Limpar
              </button>
              <button type="submit" class="btn btn-rounded btn-success">
                <i class="bi bi-file-earmark-check"></i><span id="btn_submit"> Cadastrar</span>
              </button>
            </div>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>">
          </form>
        </div>
      </div>
    </div>
    <br>
  </section>
  <section>
    <div class="box-body container-full">
      <!-- Main content -->
      <div class="box box-solid bg-facebook">
        <div class="content-header">
          <div class="d-inline-block align-items-center">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-card-list"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Lista de Arquivos</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="box-body">
          <h6 class="box-subtitle ml-2">Visíveis. Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="tb_arquivos" class="table table-striped" style="width:100%">
              <thead class="">
                <tr>
                  <th></th>
                  <th>#</th>
                  <th>Id</th>
                  <th>Nome</th>
                  <th>Tamanho</th>
                  <th>Qtd Pag.</th>
                  <th>Dt Cad</th>
                  <th>Status</th>
                  <th class="no-print" width="160px !important"></th>
                </tr>
              </thead>
              <tbody class="table-striped">
                <?php
                foreach ($rsArquivos as $kObj => $vObj) {
                  ?>
                  <tr>
                    <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                    <td></td>
                    <td id="td_count"><?= $kObj+1; ?></td>
                    <td id="td_id"><?= $vObj['id']; ?></td>
                    <td id="td_nome"><?= $vObj['nome']; ?></td>
                    <td id="td_tamanho"><?= fdec( $vObj['tamanho'] < 1048576 ? ($vObj['tamanho']/1024) : ($vObj['tamanho']/1024/1024) ); ?> <?= $vObj['tamanho'] < 1048576 ? "KB" : "MB" ;?></td>
                    <td id="td_qtd_pag"><?= $vObj['qtd_pag']; ?></td>
                    <td id="td_dt_cad"><?= obterDataHoraBRTimestamp($vObj['dt_cadastro']); ?></td>
                    <td id="td_status"><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                    <td>
                      <button id="btn_abrir_registro" class="btn_abrir_registro waves-effect waves-light btn btn-info btn-rounded" title="VISUALIZAR / DOWNLOAD">
                        <a href="<?= PORTAL_URL . 'uploads/' . $vObj['nome_fisico'] ;?>" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-0-hover link-underline-primary" target="_blank">
                          <i class="bi bi-file-earmark-arrow-down"></i></a>
                      </button>
                      <?php
                      if ($vObj['status'] == 1) {
                      ?>
                        <button id="btn_excluir_registro" class="btn_excluir_registro waves-effect waves-light btn btn-danger btn-rounded" title="EXCLUIR / INATIVAR" onclick="btnExcluir(this)">
                          <i class="bi bi-trash-fill"></i>
                        </button>
                      <?php
                      } else {
                      ?>
                        <button id="btn_recuperar_registro" class="btn_recuperar_registro waves-effect waves-light btn btn-warning btn-rounded" title="RECUPERAR / ATIVAR" onclick="btnRecuperar(this)">
                          <i class="bi bi-arrow-clockwise"></i>
                        </button>
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
            <div id="div_btns_all" class="mx-auto p-2" style="width: 500px; display: none;">
              <button type="button" id="btn_recuperar_selecionados" class="waves-effect waves-light btn btn-warning btn-rounded" title="RECUPERAR / ATIVAR">
                <i class="bi bi-arrow-clockwise"> Recuperar selecionados</i>
              </button>
              <button type="button" id="btn_excluir_selecionados" class="waves-effect waves-light btn btn-danger btn-rounded" title="EXCLUIR / INATIVAR">
                <i class="bi bi-trash-fill"> Excluir selecionados</i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content -->
    </div>
  </section>
  <!-- /.content -->
</div>
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/arquivo/pdf/dashboard.js"></script>