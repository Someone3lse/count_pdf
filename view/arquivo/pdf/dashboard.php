      <?php
      include_once ('template/topo.php');
      include_once ('template/header.php');
      ?>
      <div class="container">
        <div class="">
          <div class="">
            <h1>CONTADOR DE PÁGINAS DE ARQUIVOS PDF</h1>
          </div>
        </div>
        <!-- Main content -->
        <section class="">
          <h3>Cadastro de novos arquivos PDF para contagem de páginas</h3>
          <div class="box-body">
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
          <br>
          <div class="box box-solid bg-facebook">
            <div class="box-header bg-primary">
              <h4 class="box-title font-weight-bold">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="icon bg-primary rounded-circle font-size-30"><i class="fal fa-home-lg mr-10"></i></div>
                  <span id="titulo_form"> LISTA DE UNIDADES ORGANIZACIONAIS / SECRETARIAS</span>
                  <input type="hidden" id="titulo_relatorio" value="Relatório de secretarias cadastradas no sistema">
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
                      <th>Número</th>
                      <th>Nome</th>
                      <th>Tipo Secretaria</th>
                      <th>Status</th>
                      <th class="no-print" width="160px !important"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($rsUOs as $kObj => $vObj) {
                      $excluirDisable = !is_null($vObj['sc_id_uo'])  ? 'negado="true" data-toggle="tooltip" title="Este registro não pode ser exlcuido pois está vinculado a um contrato de servidor!" onclick="return null;"' : '';
                      ?>
                      <tr>
                        <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                        <td id="td_count"><?= $kObj+1; ?></td>
                        <td id="td_numero"><?= $vObj['numero']; ?></td>
                        <td id="td_nome"><?= $vObj['nome']; ?></td>
                        <td id="td_tipo_uo" value="<?= $vObj['bsc_unidade_organizacional_tipo_id'];?>"><?= $vObj['nome_tipo']; ?></td>
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
      <?php
      include_once ('template/footer.php');
      include_once ('template/rodape.php');
      ?>
      <script type="text/javascript" src="<?= PORTAL_URL; ?>control/arquivo/pdf/dashboard.js"></script>