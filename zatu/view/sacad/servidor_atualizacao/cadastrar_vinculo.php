<strong><div id="step-#index#" class="icones"><i class="fal fa-handshake"></i></div><span>OUTROS VÍNCULOS</span></strong>
<section class="pt-0">
  <form id="form_servidor_vinculo" class="" name="form_servidor_vinculo" method="post" action="">
    <input type="hidden" id="vinculo_servidor_id" name="servidor_id" class="servidor_id" value="<?= $rsServidor['id']; ?>">
    <input type="hidden" id="vinculo_servidor_atualizacao_id" name="id" class="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <?php
    $countVinculos = 0;
    if (sizeof($rsServidorAtualizacaoVinculos) > 0) {
      foreach ($rsServidorAtualizacaoVinculos as $kObjVinculo => $vObjVinculo) {
        $countVinculos ++;
        ?>
        <div id="box_vinculo" class="box_vinculo box box-outline-primary">
          <input type="hidden" id="vinculo_id_s_<?= $countVinculos ;?>" name="vinculo_id_s[]" value="<?= $vObjVinculo['id'] ;?>">
          <input type="hidden" id="vinculo_id_old_s_<?= $countVinculos ;?>" name="vinculo_id_old_s[]" value="<?= $vObjVinculo['sacad_servidor_vinculo_id_old'] ;?>">
          <div class="box-header">
            <h5 class="mb-0"><strong>VÍNCULO A OUTRO ÓRGÃO/SECRETARIA - <span><?= $countVinculos; ?></span></strong></h5>
            <?php 
            if ($vObjVinculo['id'] > 0 && $vObjVinculo['situacao_vinculo'] == 0 && $vObjVinculo['situacao_vinculo'] != NULL) {
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
                    <span><?= $vObjVinculo['obs_vinculo'] ;?></span>
                  </div>
                </div>
              </div>
              <?php
            }
            if ($vObjVinculo['situacao_vinculo'] == 1) {
              ?>
              <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
              <?php
              if ($vObjVinculo['obs_vinculo'] != '') {
                ?>
                <div class="row mt-2">
                  <div class="col-md-2">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span>OBSERVAÇÃO: </span>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span><?= $vObjVinculo['obs_vinculo'] ;?></span>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>
          </div>
          <div class="box-body">
            <div class="row mt-10">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="vinculo_local_s">Local<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?>"><?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="vinculo_local_s_<?= $countVinculos; ?>" name="vinculo_local_s[]" placeholder="Local de vinculo do servidor" value="<?= $vObjVinculo['local']; ?>" allempty/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="vinculo_esfera_s">Esfera<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['esfera']; ?>"><?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['esfera']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="vinculo_esfera_s_<?= $countVinculos; ?>" name="vinculo_esfera_s[]" placeholder="Esfera de vinculo do servidor" value="<?= $vObjVinculo['esfera']; ?>" allempty/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="vinculo_cargo_s">Cargo<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['cargo']; ?>"><?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['cargo']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="vinculo_cargo_s_1<?= $countVinculos; ?>" name="vinculo_cargo_s[]" placeholder="Cargo de vinculo do servidor" value="<?= $vObjVinculo['cargo']; ?>" allempty/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="vinculo_carga_horaria_s">Carga horária<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['carga_horaria']; ?>"><?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['carga_horaria']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="1" id="vinculo_carga_horaria_s_<?= $countVinculos; ?>" name="vinculo_carga_horaria_s[]" placeholder="Carga horária de vinculo do servidor" value="<?= $vObjVinculo['carga_horaria']; ?>" allempty/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer text-center mb-15">
            <button type="button" id="btn_del_vinculo_<?= $countVinculos; ?>" class="btn_del_vinculo btn btn-rounded btn-danger mr-1" onclick="vinculoFormDel($(this))">
              <i class="ti-trash"></i> Remover Vínculo
            </button>
            <button type="button" id="btn_add_vinculo_<?= $countVinculos; ?>" class="btn_add_vinculo btn btn-rounded btn-success" onclick="vinculoFormAdd($(this))">
              <i class="ti-plus"></i> Novo Vínculo
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_vinculo" class="box_vinculo box box-outline-info">
        <input type="hidden" id="vinculo_id_s" name="vinculo_id_s[]" value="0">
        <input type="hidden" id="vinculo_id_old_s" name="vinculo_id_old_s[]" value="0">
        <div class="box-header">
          <h5 class="mb-0"><strong>VÍNCULO A OUTRO ÓRGÃO/SECRETARIA - <span>1</span></strong></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="vinculo_local_s">Local<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?>"></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="vinculo_local_s" name="vinculo_local_s[]_" placeholder="Local de vinculo do servidor" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="vinculo_esfera_s">Esfera<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?>"></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="vinculo_esfera_s" name="vinculo_esfera_s[]" placeholder="Esfera de vinculo do servidor" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="vinculo_cargo_s">Cargo<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?>"></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="vinculo_cargo_s" name="vinculo_cargo_s[]" placeholder="Cargo de vinculo do servidor" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="vinculo_carga_horaria_s">Carga horária<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="vinculo" value="<?= $rsServidorVinculos[array_search($vObjVinculo['sacad_servidor_vinculo_id_old'], array_column($rsServidorVinculos, 'id'))]['local']; ?>"></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="vinculo_carga_horaria_s" name="vinculo_carga_horaria_s[]" placeholder="Carga horária de vinculo do servidor" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center mb-15">
          <button type="button" id="btn_del_vinculo_1" class="btn_del_vinculo btn btn-rounded btn-danger mr-1" onclick="vinculoFormDel($(this))">
            <i class="ti-trash"></i> Remover Vínculo
          </button>
          <button type="button" id="btn_add_vinculo_1" class="btn_add_vinculo btn btn-rounded btn-success" onclick="vinculoFormAdd($(this))">
            <i class="ti-plus"></i> Novo Vínculo
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>