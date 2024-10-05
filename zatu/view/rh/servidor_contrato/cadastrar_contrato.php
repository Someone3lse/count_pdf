<strong><div id="step-#index#" class="icones"><i class="fal fa-file-contract"></i></div><span>CONTRATO</span></strong>
<section class="pt-0 pr-0">
  <form id="form_servidor_contrato" class="" name="form_servidor_contrato" method="post" action="">
    <input type="hidden" id="servidor_contrato_id" class="servidor_contrato_id" name="id" value="<?= $id; ?>">
    <div class="box box-outline-info">
      <div class="box-header">
        <h5 class="mb-0 text-info"><strong> CONTRATO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="servidor_sc">Servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="servidor_sc" name="servidor_sc" class="form-control select2_servidor" style="width: 100%;" placeholder="selecione o servidor">
                  <option></option>
                  <?php
                  if (isset($rsServidorContrato['rh_servidor_id'])) {
                    ?>
                    <option value="<?= $rsServidorContrato['rh_servidor_id']; ?>" selected="selected"><?= $rsServidorContrato['servidor_nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="servidor_tipo_sc">Tipo de vinculo do servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="servidor_tipo_sc" name="servidor_tipo_sc" class="form-control select2" style="width: 100%;" placeholder="selecione tipo de vinculo do servidor">
                  <option></option>
                  <?php
                  foreach ($rsServidorTipos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContrato['rh_servidor_tipo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="uo_sc">Unidade organizacional<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="uo_sc" name="uo_sc" class="form-control select2" style="width: 100%;" placeholder="Unidade organizacional">
                  <option></option>
                  <?php
                  foreach ($rsUnidadesOrganizacionais as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContrato['bsc_unidade_organizacional_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="numero_sc">Matrícula<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="numero_sc" name="numero_sc" placeholder="Número do Contrato" value="<?= $rsServidorContrato['contrato_numero']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="setor_sc">Setor definido no contrato<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="setor_sc" name="setor_sc" placeholder="Setor do servidor" value="<?= $rsServidorContrato['setor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cargo_sc">Cargo<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="cargo_sc" name="cargo_sc" class="form-control select2" style="width: 100%;" placeholder="Cargo do servidor no contrato">
                  <option></option>
                  <?php
                  foreach ($rsCargos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContrato['eo_cargo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="municipio_sc">Município<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="municipio_sc" name="municipio_sc" class="form-control select2" style="width: 100%;" placeholder="Município do contrato">
                  <option></option>
                  <?php
                  foreach ($rsMunicipios as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContrato['bsc_municipio_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="dt_publicacao_sc">Data de publicação<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="dt_publicacao_sc" name="dt_publicacao_sc" placeholder="Data de publicação do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorContrato['dt_publicacao']); ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dt_inicio_sc">Data de início do contrato<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="dt_inicio_sc" name="dt_inicio_sc" placeholder="Data de início do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorContrato['contrato_dt_inicio']); ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dt_fim_sc">Data de fim do contrato<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="dt_fim_sc" name="dt_fim_sc" placeholder="Data de fim do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorContrato['contrato_dt_fim']); ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="fim_indefinido_sc">Contrato sem fim definido<span class="text-danger"></span>? </label>
              <div class="form-group ichack-input mt-10">
                <label>
                  <input type="radio" id="fim_indefinido_sc_sim" name="fim_indefinido_sc" class="square-purple" <?= $rsServidorContrato['contrato_fim_indefinido'] == '1' ? 'checked="checked"' : ''; ?> value="1"> Sim
                </label>
                <label>
                  <input type="radio" id="fim_indefinido_sc_nao" name="fim_indefinido_sc" class="square-purple" <?= $rsServidorContrato['contrato_fim_indefinido'] != '1' ? 'checked="checked"' : ''; ?> value="0"> Não
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="situacao_sc">Situação do contrato<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="situacao_sc" name="situacao_sc" class="form-control select2" style="width: 100%;" placeholder="situação do contrato do servidor">
                  <option></option>
                  <option value="Ativo" <?= $rsServidorContrato['situacao'] == 'Ativo' ? 'selected="selected"' : '' ;?>>Ativo</option>
                  <option value="Inativo" <?= $rsServidorContrato['situacao'] == 'Inativo' ? 'selected="selected"' : '' ;?>>Inativo</option>
                  <option value="Suspenso" <?= $rsServidorContrato['situacao'] == 'Suspenso' ? 'selected="selected"' : '' ;?>>Suspenso</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="desligamento_dt_sc">Data de desligamento do servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="desligamento_dt_sc" name="desligamento_dt_sc" placeholder="Data de desligamento do contrato do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorContrato['desligamento_dt']); ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="desligamento_tipo_sc">Tipo de deligamento do servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="desligamento_tipo_sc" name="desligamento_tipo_sc" class="form-control select2" style="width: 100%;" placeholder="Tipo de desligamento do servidor">
                  <option></option>
                  <option value="Isoneração" <?= $rsServidorContrato['desligamento_tipo'] == 'Isoneração' ? 'selected="selected"' : '' ;?>>Isoneração</option>
                  <option value="Solicitado" <?= $rsServidorContrato['desligamento_tipo'] == 'Solicitado' ? 'selected="selected"' : '' ;?>>Solicitado</option>
                  <option value="Justa causa" <?= $rsServidorContrato['desligamento_tipo'] == 'Justa causa' ? 'selected="selected"' : '' ;?>>Justa causa</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>