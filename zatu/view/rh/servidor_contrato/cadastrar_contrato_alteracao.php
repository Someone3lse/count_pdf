<strong><div id="step-#index#" class="icones"><i class="fal fa-file-plus"></i></div><span>ALTERAÇÕES DO CONTRATO</span></strong>
<section class="pt-0">
  <form id="form_servidor_contrato_alteracao" class="" name="form_servidor_contrato_alteracao" method="post" action="">
    <input type="hidden" id="servidor_contrato_alteracao_id" class="servidor_contrato_alteracao_id" name="id" value="<?= $id; ?>">
    <?php
    $countAlteracoes = 0;
    if (sizeof($rsServidorContratoAlteracoes) > 0) {
      foreach ($rsServidorContratoAlteracoes as $kAlteracao => $vAlteracao) {
        $countAlteracoes ++;
        ?>
        <div id="box_alteracao" class="box_alteracao box box-outline-info">
          <input type="hidden" id="alteracao_id_sc_<?= $countAlteracoes ;?>" name="alteracao_id_sc[]" value="<?= $vAlteracao['id'] ;?>">
          <div class="box-header">
            <strong>ALTERAÇÃO - <span><?= $countAlteracoes; ?></span></strong>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="salario_sc">Salário<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control preco_format" minlength="3" id="salario_sc_<?= $countAlteracoes; ?>" name="salario_sc[]" placeholder="Salário no contrato do servidor" value="<?= $vAlteracao['salario']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="periodicidade_sc">Periodicidade<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="periodicidade_sc_<?= $countAlteracoes; ?>" name="periodicidade_sc[]" class="form-control select2" style="width: 100%;" placeholder="Periodicidade do salário">
                      <option></option>
                      <option value="Semanal" <?= $vAlteracao['periodicidade'] == 'Semanal' ? 'selected="selected"' : '' ;?>>Semanal</option>
                      <option value="Mensal" <?= $vAlteracao['periodicidade'] == 'Mensal' ? 'selected="selected"' : '' ;?>>Mensal</option>
                      <option value="Bimestral" <?= $vAlteracao['periodicidade'] == 'Bimestral' ? 'selected="selected"' : '' ;?>>Bimestral</option>
                      <option value="Trimestral" <?= $vAlteracao['periodicidade'] == 'Trimestral' ? 'selected="selected"' : '' ;?>>Trimestral</option>
                      <option value="Semestral" <?= $vAlteracao['periodicidade'] == 'Semestral' ? 'selected="selected"' : '' ;?>>Semestral</option>
                      <option value="Anual" <?= $vAlteracao['periodicidade'] == 'Anual' ? 'selected="selected"' : '' ;?>>Anual</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="funcao_sc">Função<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="funcao_sc_<?= $countAlteracoes; ?>" name="funcao_sc[]" placeholder="Função do servidor" value="<?= $vAlteracao['funcao_nome']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="descricao_sc">Descrição da função<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <textarea class="form-control" minlength="3" id="descricao_sc_<?= $countAlteracoes; ?>" name="descricao_sc[]" placeholder="Descrição da função do servidor"><?= $vAlteracao['funcao_descricao']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dt_vigorar_sc">Data a vigorar<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_vigorar_sc_<?= $countAlteracoes; ?>" name="dt_vigorar_sc[]" placeholder="Data a vigorar a alteração do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vAlteracao['dt_vigorar']); ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dt_publicacao_sc">Data de publicação<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_publicacao_sc_<?= $countAlteracoes; ?>" name="dt_publicacao_sc[]" placeholder="Data de publicação da alteração do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vAlteracao['dt_publicacao']); ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="hora_entrada_sc">Hora de entrada<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control hora_format" minlength="3" id="hora_entrada_sc_<?= $countAlteracoes; ?>" name="hora_entrada_sc[]" placeholder="Hora de entrada" value="<?= $vAlteracao['hora_entrada']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="hora_saida_sc">Hora de saída<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control hora_format" minlength="3" id="hora_saida_sc_<?= $countAlteracoes; ?>" name="hora_saida_sc[]" placeholder="Hora de saída" value="<?= $vAlteracao['hora_saida']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="hora_intervalo_entrada_sc">Hora de início do intervalo<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control hora_format" minlength="3" id="hora_intervalo_entrada_sc_<?= $countAlteracoes; ?>" name="hora_intervalo_entrada_sc[]" placeholder="Hora de início do intervalo" value="<?= $vAlteracao['hora_inervalo_entrada']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="hora_intervalo_saida_sc">Hora de término do intervalo<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control hora_format" minlength="3" id="hora_intervalo_saida_sc_<?= $countAlteracoes; ?>" name="hora_intervalo_saida_sc[]" placeholder="Hora de fim do intervalo" value="<?= $vAlteracao['hora_intervalo_saida']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center">
            <button type="button" id="btn_del_alteracao_<?= $countAlteracoes; ?>" class="btn_del_alteracao btn btn-rounded btn-danger mr-1" onclick="contratoAlteracaoFormDel($(this))">
              <i class="ti-trash"></i> Remover Alteração
            </button>
            <button type="button" id="btn_add_alteracao_<?= $countAlteracoes; ?>" class="btn_add_alteracao btn btn-rounded btn-success" onclick="contratoAlteracaoFormAdd($(this))">
              <i class="ti-plus"></i> Nova Alteração
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_alteracao" class="box_alteracao box box-outline-info">
        <input type="hidden" id="alteracao_id_sc_1" name="alteracao_id_sc[]" value="0">
        <div class="box-header">
          <strong>ALTERAÇÃO - <span>1</span></strong>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="salario_sc">Salário<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control preco_format" minlength="3" id="salario_sc_1" name="salario_sc[]" placeholder="Salário no contrato do servidor" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="periodicidade_sc">Periodicidade<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="periodicidade_sc_1" name="periodicidade_sc[]" class="form-control select2" style="width: 100%;" placeholder="Periodicidade do salário">
                    <option></option>
                    <option value="Semanal">Semanal</option>
                    <option value="Mensal">Mensal</option>
                    <option value="Bimestral">Bimestral</option>
                    <option value="Trimestral">Trimestral</option>
                    <option value="Semestral">Semestral</option>
                    <option value="Anual">Anual</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="funcao_sc">Função<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="funcao_sc_1" name="funcao_sc[]" placeholder="Função do servidor" value=""/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descricao_sc">Descrição da função<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" minlength="3" id="descricao_sc_1" name="descricao_sc[]" placeholder="Descrição da função do servidor"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dt_vigorar_sc">Data a vigorar<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_vigorar_sc_1" name="dt_vigorar_sc[]" placeholder="Data a vigorar a alteração do contrato do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="dt_publicacao_sc">Data a publicação<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_publicacao_sc_1" name="dt_publicacao_sc[]" placeholder="Data de publicação da alteração do contrato do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="hora_entrada_sc">Hora de entrada<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control hora_format" minlength="3" id="hora_entrada_sc_1" name="hora_entrada_sc[]" placeholder="Hora de entrada" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="hora_saida_sc">Hora de saída<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control hora_format" minlength="3" id="hora_saida_sc_1" name="hora_saida_sc[]" placeholder="Hora de saída" value=""/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-3">
              <div class="form-group">
                <label for="hora_intervalo_entrada_sc">Hora de início do intervalo<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control hora_format" minlength="3" id="hora_intervalo_entrada_sc_1" name="hora_intervalo_entrada_sc[]" placeholder="Hora de início do intervalo" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="hora_intervalo_saida_sc">Hora de término do intervalo<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control hora_format" minlength="3" id="hora_intervalo_saida_sc_1" name="hora_intervalo_saida_sc[]" placeholder="Hora de fim do intervalo" value=""/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center">
          <button type="button" id="btn_del_alteracao_1" class="btn_del_alteracao btn btn-rounded btn-danger mr-1" onclick="contratoAlteracaoFormDel($(this))">
            <i class="ti-trash"></i> Remover Alteração
          </button>
          <button type="button" id="btn_add_alteracao_1" class="btn_add_alteracao btn btn-rounded btn-success" onclick="contratoAlteracaoFormAdd($(this))">
            <i class="ti-plus"></i> Nova Alteração
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>