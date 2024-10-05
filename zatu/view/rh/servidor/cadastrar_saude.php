<strong><div id="step-#index#" class="icones"><i class="fal fa-heartbeat"></i></div><span>ENFERMIDADES</span></strong>
<section class="pt-0">
  <form id="form_servidor_saude" class="" name="form_servidor_saude" method="post" action="">
    <input type="hidden" id="saude_servidor_id" name="id" class="servidor_id" value="<?= $id; ?>">
    <?php
    $countSaudes = 0;
    if (sizeof($rsServidorSaudes) > 0) {
      foreach ($rsServidorSaudes as $kSaude => $vSaude) {
        $countSaudes ++;
        ?>
        <div id="box_saude" class="box_saude box box-outline-info">
          <input type="hidden" id="saude_id_s_<?= $countSaudes ;?>" name="saude_id_s[]" value="<?= $vSaude['id'] ;?>">
          <div class="box-header">
            <strong>ENFERMIDADE - <span><?= $countSaudes; ?></span></strong>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="saude_dt_ocorrido_s">Data do ocorridos<span class="text-danger" validator></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="saude_dt_ocorrido_s_<?= $countSaudes; ?>" name="saude_dt_ocorrido_s[]" placeholder="Data do ocorrido com o servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vSaude['dt_ocorrido']); ?>" allempty/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-10">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="saude_descricao_s">Descrição<span class="text-danger" validator></span>: </label>
                  <div class="input-group mb-3 controls">
                    <textarea class="form-control" rows="10" minlength="3" id="saude_descricao_s_<?= $countSaudes; ?>" name="saude_descricao_s[]" placeholder="Descrição da ocorrência com o servidor" allempty><?= $vSaude['descricao']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="saude_dt_inicio_s">Data do início<span class="text-danger" validator></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="saude_dt_inicio_s_<?= $countSaudes; ?>" name="saude_dt_inicio_s[]" placeholder="Data do inicio do ocorrido com o servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vSaude['dt_inicio']); ?>" allempty/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="saude_dt_fim_s">Data do fim<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="saude_dt_fim_s_<?= $countSaudes; ?>" name="saude_dt_fim_s[]" placeholder="Data do fim ocorrido com o servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vSaude['dt_fim']); ?>"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center mb-15">
            <button type="button" id="btn_del_saude_<?= $countSaudes; ?>" class="btn_del_saude btn btn-rounded btn-danger mr-1" onclick="saudeFormDel($(this))">
              <i class="ti-trash"></i> Remover Enfermidade
            </button>
            <button type="button" id="btn_add_saude_<?= $countSaudes; ?>" class="btn_add_saude btn btn-rounded btn-success" onclick="saudeFormAdd($(this))">
              <i class="ti-plus"></i> Nova Enfermidade
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_saude" class="box_saude box box-outline-info">
        <input type="hidden" id="saude_id_s" name="saude_id_s[]" value="0">
        <div class="box-header">
          <strong>ENFERMIDADE - <span>1</span></strong>
        </div>
        <div class="box-body">
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="saude_dt_ocorrido_s">Data do ocorrido<span class="text-danger" validator></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="saude_dt_ocorrido_s" name="saude_dt_ocorrido_s[]" placeholder="Data do ocorrido com o servidor" title="exemplo: 31/12/2000" value="" allempty/>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-10">
            <div class="col-md-12">
              <div class="form-group">
                <label for="saude_descricao_s">Descrição<span class="text-danger" validator></span>: </label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" minlength="3" rows="10" id="saude_descricao_s" name="saude_descricao_s[]" placeholder="Descrição da ocorrência com o servidor" allempty></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="saude_dt_inicio_s">Data do início<span class="text-danger" validator></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="saude_dt_inicio_s" name="saude_dt_inicio_s[]" placeholder="Data do inicio do ocorrido com o servidor" title="exemplo: 31/12/2000" value="" allempty/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="saude_dt_fim_s">Data do fim<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="saude_dt_fim_s" name="saude_dt_fim_s[]" placeholder="Data do fim ocorrido com o servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center mb-15">
          <button type="button" id="btn_del_saude_1" class="btn_del_saude btn btn-rounded btn-danger mr-1" onclick="saudeFormDel($(this))">
            <i class="ti-trash"></i> Remover Enfermidade
          </button>
          <button type="button" id="btn_add_saude_1" class="btn_add_saude btn btn-rounded btn-success" onclick="saudeFormAdd($(this))">
            <i class="ti-plus"></i> Nova Enfermidade
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>