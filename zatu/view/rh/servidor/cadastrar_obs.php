<strong><div id="step-#index#" class="icones"><i class="fal fa-book"></i></div><span>OBS/OCORRÊNCIAS</span></strong>
<section class="pt-0">
  <form id="form_servidor_obs" class="" name="form_servidor_obs" method="post" action="">
    <input type="hidden" id="obs_servidor_id" name="id" class="servidor_id" value="<?= $id; ?>">
    <?php
    $countObss = 0;
    if (sizeof($rsServidorObss) > 0) {
      foreach ($rsServidorObss as $kObs => $vObs) {
        $countObss ++;
        ?>
        <div id="box_obs" class="box_obs box box-outline-info">
          <input type="hidden" id="obs_id_s_<?= $countObss ;?>" name="obs_id_s[]" value="<?= $vObs['id'] ;?>">
          <div class="box-header">
            <strong>OBSERVAÇÃO - <span><?= $countObss; ?></span></strong>
          </div>
          <div class="box-body">
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="obs_dt_ocorrido_s">Data do ocorrido<span class="text-danger" validator></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="obs_dt_ocorrido_s_<?= $countObss; ?>" name="obs_dt_ocorrido_s[]" placeholder="Data do ocorrido com o servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vObs['dt_ocorrido']); ?>" allempty/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-10">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="obs_descricao_s">Descrição<span class="text-danger" validator></span>: </label>
                  <div class="input-group mb-3 controls">
                    <textarea class="form-control" minlength="3" rows="10" id="obs_descricao_s_<?= $countObss; ?>" name="obs_descricao_s[]" placeholder="Descrição da ocorrência com o servidor" allempty><?= $vObs['descricao']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center mb-15">
            <button type="button" id="btn_del_obs_<?= $countObss; ?>" class="btn_del_obs btn btn-rounded btn-danger mr-1" onclick="obsFormDel($(this))">
              <i class="ti-trash"></i> Remover Observação
            </button>
            <button type="button" id="btn_add_obs_<?= $countObss; ?>" class="btn_add_obs btn btn-rounded btn-success" onclick="obsFormAdd($(this))">
              <i class="ti-plus"></i> Nova Observação
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_obs" class="box_obs box box-outline-info">
        <input type="hidden" id="obs_id_s" name="obs_id_s[]" value="0">
        <div class="box-header">
          <strong>OBSERVAÇÃO - <span>1</span></strong>
        </div>
        <div class="box-body">
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="obs_dt_ocorrido_s">Data do ocorrido<span class="text-danger" validator></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="obs_dt_ocorrido_s" name="obs_dt_ocorrido_s[]" placeholder="Data do ocorrido com o servidor" title="exemplo: 31/12/2000" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="obs_descricao_s">Descrição<span class="text-danger" validator></span>: </label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" minlength="3" rows="10" id="obs_descricao_s" name="obs_descricao_s[]" placeholder="Descrição da ocorrência com o servidor" allempty></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center mb-15">
          <button type="button" id="btn_del_obs_1" class="btn_del_obs btn btn-rounded btn-danger mr-1" onclick="obsFormDel($(this))">>
            <i class="ti-trash"></i> Remover Observação
          </button>
          <button type="button" id="btn_add_obs_1" class="btn_add_obs btn btn-rounded btn-success" onclick="obsFormAdd($(this))">>
            <i class="ti-plus"></i> Nova Observação
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>