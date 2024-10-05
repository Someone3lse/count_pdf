<strong><div id="step-#index#" class="icones"><i class="fal fa-graduation-cap"></i></div><span>ESCOLARIDADE</span></strong>
<section class="pt-0">
  <form id="form_servidor_instrucao" class="" name="form_servidor_instrucao" method="post" action="">
    <input type="hidden" id="instrucao_servidor_id" name="id" class="servidor_id" value="<?= $id; ?>">
    <?php
    $countIntrucoes = 0;
    if (sizeof($rsServidorInstrucoes) > 0) {
      foreach ($rsServidorInstrucoes as $kObjInstrucao => $vObjInstrucao) {
        $countIntrucoes ++;
        ?>
        <div id="box_instrucao" class="box_instrucao box box box-outline-primary">
          <input type="hidden" id="instrucao_id_s_<?= $countIntrucoes ;?>" name="instrucao_id_s[]" value="<?= $vObjInstrucao['id'] ;?>">
          <div class="box-header">
            <strong>NÍVEL ESCOLAR - <span><?= $countIntrucoes; ?></span></span></strong>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_escolaridade_s">Escolaridade<span class="text-danger">*</span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="instrucao_escolaridade_s_<?= $countIntrucoes ;?>" name="instrucao_escolaridade_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione a escolaridade do servidor" required>
                      <option></option>
                      <?php
                      foreach ($rsEscolaridades as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjInstrucao['bsc_escolaridade_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_formacao_s">Formação<span class="text-danger">*</span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="instrucao_formacao_s_<?= $countIntrucoes ;?>" name="instrucao_formacao_s[]" placeholder="Formação do servidor" value="<?= $vObjInstrucao['formacao']; ?>" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_concl_ano_s">Ano de conclusão<span class="text-danger">*</span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="number" class="form-control" minlength="4" maxlength="4" id="instrucao_concl_ano_s_<?= $countIntrucoes ;?>" name="instrucao_concl_ano_s[]" placeholder="Ano de conclusão do servidor" value="<?= $vObjInstrucao['conclusao_ano']; ?>" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_cursando_s">Cursando<span class="text-danger">*</span>? </label>
                  <div class="form-group ichack-input mt-10">
                    <label>
                      <input type="radio" id="instrucao_cursando_sim_s_<?= $countIntrucoes ;?>" name="instrucao_cursando_s_<?= $countIntrucoes ;?>" class="radio_sim square-purple" <?= $vObjInstrucao['cursando'] == '1' ? 'checked="checked"' : ''; ?> value="1" required> Sim
                    </label>
                    <label>
                      <input type="radio" id="instrucao_cursando_nao_s_<?= $countIntrucoes ;?>" name="instrucao_cursando_s_<?= $countIntrucoes ;?>" class="radio_nao square-purple" <?= $vObjInstrucao['cursando'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Não
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center mb-15">
            <button type="button" id="btn_del_instrucao_<?= $countIntrucoes ;?>" class="btn_del_instrucao btn btn-rounded btn-danger mr-1" onclick="instrucaoFormDel($(this))">
              <i class="ti-trash"></i> Remover Instrução
            </button>
            <button type="button" id="btn_add_instrucao_<?= $countIntrucoes ;?>" class="btn_add_instrucao btn btn-rounded btn-success" onclick="instrucaoFormAdd($(this))">
              <i class="ti-plus"></i> Nova Instrução
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_instrucao" class="box_instrucao box box box-outline-primary">
        <input type="hidden" id="instrucao_id_s" name="instrucao_id_s[]" value="0">
        <div class="box-header">
          <strong>NÍVEL ESCOLAR - <span>1</span></strong>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_escolaridade_s">Escolaridade<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="instrucao_escolaridade_s" name="instrucao_escolaridade_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione a escolaridade do servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsEscolaridades as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>"><?= $vObj['nome']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_formacao_s">Formação<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="instrucao_formacao_s" name="instrucao_formacao_s[]" placeholder="Formação do servidor" value="" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-20">
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_concl_ano_s">Ano de conclusão<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="number" class="form-control" minlength="4" maxlength="4" id="instrucao_concl_ano_s" name="instrucao_concl_ano_s[]" placeholder="Ano de conclusão do servidor" value="" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_cursando_s">Cursando<span class="text-danger">*</span>? </label>
                <div class="form-group ichack-input mt-10">
                  <label>
                    <input type="radio" id="instrucao_cursando_sim_s_1" name="instrucao_cursando_s_1" class="radio_sim square-purple" value="1" required> Sim
                  </label>
                  <label>
                    <input type="radio" id="instrucao_cursando_nao_s_1" name="instrucao_cursando_s_1" class="radio_nao square-purple" value="0"> Não
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center mb-15">
          <button type="button" id="btn_del_instrucao_1" class="btn_del_instrucao btn btn-rounded btn-danger mr-1" onclick="instrucaoFormDel($(this))">
            <i class="ti-trash"></i> Remover Instrução
          </button>
          <button type="button" id="btn_add_instrucao_1" class="btn_add_instrucao btn btn-rounded btn-success" onclick="instrucaoFormAdd($(this))">
            <i class="ti-plus"></i> Nova Instrução
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>