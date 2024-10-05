<strong><div id="step-#index#" class="icones"><i class="fal fa-plane-departure"></i></div><span>FÉRIAS DO CONTRATO</span></strong>
<section class="pt-0">
  <form id="form_servidor_contrato_ferias" class="" name="form_servidor_contrato_ferias" method="post" action="">
    <input type="hidden" id="servidor_contrato_ferias_id" class="servidor_contrato_ferias_id" name="id" value="<?= $id; ?>">
    <?php
    $countFerias = 0;
    if (sizeof($rsServidorContratoFerias) > 0) {
      foreach ($rsServidorContratoFerias as $kFerias => $vFerias) {
        $countFerias ++;
        ?>
        <div id="box_ferias" class="box_ferias box box-outline-info">
          <input type="hidden" id="ferias_id_sc_<?= $countFerias ;?>" name="ferias_id_sc[]" value="<?= $vFerias['id'] ;?>">
          <div class="box-header">
            <strong>FÉRIAS - <span><?= $countFerias; ?></span></strong>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt_aquisitivo_inicio_sc">Início do período aquisitivo de férias<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_aquisitivo_inicio_sc_<?= $countFerias; ?>" name="dt_aquisitivo_inicio_sc[]" placeholder="Data início do período aquisitivo de férias do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vFerias['aquisitivo_dt_inicio']); ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt_aquisitivo_fim_sc">Fim do período aquisitivo de férias<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_aquisitivo_fim_sc_<?= $countFerias; ?>" name="dt_aquisitivo_fim_sc[]" placeholder="Data fim do período aquisitivo de férias do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vFerias['aquisitivo_dt_fim']); ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt_gozo_inicio_sc">Data de início do gozo de férias<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_gozo_inicio_sc_<?= $countFerias; ?>" name="dt_gozo_inicio_sc[]" placeholder="Data início do gozo de férias do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vFerias['gozo_dt_inicio']); ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt_gozo_fim_sc">Data de fim do gozo de férias<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dt_gozo_fim_sc_<?= $countFerias; ?>" name="dt_gozo_fim_sc[]" placeholder="Data fim do gozo de férias do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vFerias['gozo_dt_fim']); ?>"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="obs_sc">Observação<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <textarea class="form-control" minlength="3" id="obs_sc_<?= $countFerias; ?>" name="obs_sc[]" placeholder="Observação sobre as férias do servidor"><?= $vFerias['obs']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center">
            <button type="button" id="btn_del_ferias_<?= $countFerias; ?>" class="btn_del_ferias btn btn-rounded btn-danger mr-1" onclick="contratoFeriasFormDel($(this))">
              <i class="ti-trash"></i> Remover Férias
            </button>
            <button type="button" id="btn_add_ferias_<?= $countFerias; ?>" class="btn_add_ferias btn btn-rounded btn-success" onclick="contratoFeriasFormAdd($(this))">
              <i class="ti-plus"></i> Nova Férias
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_ferias" class="box_ferias box box-outline-info">
        <input type="hidden" id="ferias_id_sc_1" name="ferias_id_sc[]" value="">
        <div class="box-header">
          <strong>FÉRIAS - <span>1</span></strong>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="dt_aquisitivo_inicio_sc">início da aquisição de férias<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_aquisitivo_inicio_sc_1" name="dt_aquisitivo_inicio_sc[]" placeholder="Data início do período aquisitivo de férias do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="dt_aquisitivo_fim_sc">fim do período aquisitivo de férias<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_aquisitivo_fim_sc_1" name="dt_aquisitivo_fim_sc[]" placeholder="Data fim do período aquisitivo de férias do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="dt_gozo_inicio_sc">Data início do gozo de férias<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_gozo_inicio_sc_1" name="dt_gozo_inicio_sc[]" placeholder="Data início do gozo de férias do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="dt_gozo_fim_sc">Data fim do gozo de férias<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dt_gozo_fim_sc_1" name="dt_gozo_fim_sc[]" placeholder="Data fim do gozo de férias do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-12">
              <div class="form-group">
                <label for="obs_sc">Observação<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" minlength="3" id="obs_sc_1" name="obs_sc[]" placeholder="Observação sobre as férias do servidor"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center">
          <button type="button" id="btn_del_ferias_1" class="btn_del_ferias btn btn-rounded btn-danger mr-1" onclick="contratoFeriasFormDel($(this))">
            <i class="ti-trash"></i> Remover Férias
          </button>
          <button type="button" id="btn_add_ferias_1" class="btn_add_ferias btn btn-rounded btn-success" onclick="contratoFeriasFormAdd($(this))">
            <i class="ti-plus"></i> Nova Férias
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>