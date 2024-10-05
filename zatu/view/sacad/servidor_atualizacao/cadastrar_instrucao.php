<strong><div id="step-#index#" class="icones"><i class="fal fa-graduation-cap"></i></div><span>ESCOLARIDADE</span></strong>
<section class="pt-0">
  <form id="form_servidor_instrucao" class="" name="form_servidor_instrucao" method="post" action="">
    <input type="hidden" id="instrucao_servidor_atualizacao_id" name="id" class="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <?php
    $countIntrucoes = 0;
    if (sizeof($rsServidorAtualizacaoInstrucoes) > 0) {
      foreach ($rsServidorAtualizacaoInstrucoes as $kObjInstrucao => $vObjInstrucao) {
        $countIntrucoes ++;
        ?>
        <div id="box_instrucao" class="box_instrucao box box-outline-primary">
          <input type="hidden" id="instrucao_id_s_<?= $countIntrucoes ;?>" name="instrucao_id_s[]" value="<?= $vObjInstrucao['id'] ;?>">
          <input type="hidden" id="instrucao_id_old_s_<?= $countIntrucoes ;?>" name="instrucao_id_old_s[]" value="<?= $vObjInstrucao['sacad_servidor_instrucao_id_old'] ;?>">
          <div class="box-header">
            <h5 class="mb-0"><strong>NÍVEL ESCOLAR - <span><?= $countIntrucoes; ?></span></span></strong></h5>
            <?php 
            if ($vObjInstrucao['id'] > 0 && $vObjInstrucao['situacao_instrucao'] == 0 && $vObjInstrucao['situacao_instrucao'] != NULL) {
              ?>
              <div class="alert alert-warning mt-10 mb-0 pl-5">Informações recusadas pelo setor de RH</div>
              <div class="row mt-2">
                <div class="col-md-2">
                  <div class="form-group alert alert-warning mb-0 pl-5">
                    <span>MOTIVO: </span>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group alert alert-warning mb-0 pl-5">
                    <span><?= $vObjInstrucao['obs_instrucao'] ;?></span>
                  </div>
                </div>
              </div>
              <?php
            }
            if ($vObjInstrucao['situacao_instrucao'] == 1) {
              ?>
              <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
              <?php
              if ($vObjInstrucao['obs_instrucao'] != '') {
                ?>
                <div class="row mt-2">
                  <div class="col-md-2">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span>OBSERVAÇÃO: </span>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span><?= $vObjInstrucao['obs_instrucao'] ;?></span>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_escolaridade_s">Escolaridade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="instrucao" value="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['bsc_escolaridade_id']; ?>"><?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['escolaridade_nome']; ?></span></label>
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
                  <label for="instrucao_formacao_s">Formação<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="instrucao" value="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['formacao']; ?>"><?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['formacao']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="instrucao_formacao_s_<?= $countIntrucoes ;?>" name="instrucao_formacao_s[]" placeholder="Formação do servidor" value="<?= $vObjInstrucao['formacao']; ?>" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_concl_ano_s">Ano de conclusão<span class="text-danger">*</span>: <span class="text-warning" grupo="input_number" subgrupo="instrucao" value="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['conclusao_ano']; ?>"><?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['conclusao_ano']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="number" class="form-control" minlength="4" maxlength="4" id="instrucao_concl_ano_s_<?= $countIntrucoes ;?>" name="instrucao_concl_ano_s[]" placeholder="Ano de conclusão do servidor" value="<?= $vObjInstrucao['conclusao_ano']; ?>" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="instrucao_cursando_s">Cursando<span class="text-danger">*</span>? <span class="text-warning" grupo="radio" subgrupo="instrucao" value="<?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['cursando'] ;?>"><?= $rsServidorInstrucoes[array_search($vObjInstrucao['sacad_servidor_instrucao_id_old'], array_column($rsServidorInstrucoes, 'id'))]['cursando'] == '1' ? 'Sim' : 'Não'; ?></span></label>
                  <div class="form-group ichack-input mt-10">
                    <label>
                      <input type="radio" id="instrucao_cursando_sim_s_<?= $countIntrucoes ;?>" name="instrucao_cursando_s_<?= $countIntrucoes ;?>" class="radio_sim square-purple" <?= $vObjInstrucao['cursando'] == '1' ? 'checked="checked"' : ''; ?> value="1" required> Sim
                    </label>
                    <label>
                      <input type="radio" id="instrucao_cursando_nao_s_<?= $countIntrucoes ;?>" name="instrucao_cursando_s_<?= $countIntrucoes ;?>" class="radio_nao square-purple" <?= $vObjInstrucao['cursando'] == '0' && $vObjInstrucao['id'] != 0 ? 'checked="checked"' : ''; ?> value="0"> Não
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
      <div id="box_instrucao" class="box_instrucao box box-outline-primary">
        <input type="hidden" id="instrucao_id_s" name="instrucao_id_s[]" value="0">
        <input type="hidden" id="instrucao_id_old_s" name="instrucao_id_old_s[]" value="0">
        <div class="box-header">
          <h5 class="mb-0"><strong>NÍVEL ESCOLAR - <span>1</span></strong></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_escolaridade_s">Escolaridade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="instrucao" value=""></span></label>
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
                <label for="instrucao_formacao_s">Formação<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="instrucao" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="instrucao_formacao_s" name="instrucao_formacao_s[]" placeholder="Formação do servidor" value="" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_concl_ano_s">Ano de conclusão<span class="text-danger">*</span>: <span class="text-warning" grupo="input_number" subgrupo="instrucao" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="number" class="form-control" minlength="4" maxlength="4" id="instrucao_concl_ano_s" name="instrucao_concl_ano_s[]" placeholder="Ano de conclusão do servidor" value="" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="instrucao_cursando_s">Cursando<span class="text-danger">*</span>? <span class="text-warning" grupo="radio" subgrupo="instrucao" value=""></span></label>
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