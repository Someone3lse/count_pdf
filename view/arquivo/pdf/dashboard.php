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
        <div class="d-inline-block align-items-center">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="bi bi-window-plus"></i></li>
              <li class="breadcrumb-item active" aria-current="page">Cadastro de novos arquivos PDF para contagem de páginas</li>
            </ol>
          </nav>
        </div>
      </div>
      <br>
      <div class="">
        <div class="">
          <form class="" id="frm_arquivo" name="frm_arquivo" method="post" action="">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Selecione os arquivos PDF para contar suas páginas:</label>
                    <input type="file" class="form-control" id="arquivos" name="arquivos[]" placeholder="Adicione os arquivos PDF para contar suas páginas." accept="application/pdf" multiple required>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" id="btn_cancelar" class="btn btn-rounded btn-danger mr-1">
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
          <h6 class="box-subtitle ml-2">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
          <div class="table-responsive">
            <table id="tb_arquivos" class="display table table-striped" style="width:100%">
              <thead class="">
                <tr>
                  <th>#</th>
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
                    <td id="td_count"><?= $kObj+1; ?></td>
                    <td id="td_nome"><?= $vObj['nome']; ?></td>
                    <td id="td_tamanho" value="<?= $vObj['tamanho'];?>"><?= fdec( $vObj['tamanho'] <= 1048576 ? ($vObj['tamanho']/1024) : ($vObj['tamanho']/1024/1024) ); ?> <?= $vObj['tamanho'] <= 1048576 ? "KB" : "MB" ;?></td>
                    <td id="td_qtd_pag" value="<?= $vObj['qtd_pag'];?>"><?= $vObj['qtd_pag']; ?></td>
                    <td id="td_dt_cad" value="<?= $vObj['dt_cadastro'];?>"><?= obterDataHoraBRTimestamp($vObj['dt_cadastro']); ?></td>
                    <td id="td_status" value="<?= $vObj['status'];?>"><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                    <td>
                      <button type="button" id="btn_excluir_registro" class="btn_excluir_registro waves-effect waves-light btn btn-danger btn-rounded" onclick="btnExcluir(this)">
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