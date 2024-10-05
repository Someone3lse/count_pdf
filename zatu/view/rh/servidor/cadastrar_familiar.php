<?php
$displayDadosCivis           = $rsServidorFamiliar['bsc_estado_civil_id'] <= 1 ? 'style="display: none;"' : '';
$displayConjugeNacional      = $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
$displayConjugeExtranjeiro   = $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
$displayAverbacao            = $rsServidorFamiliar['bsc_estado_civil_id'] != 5 ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="mdi mdi-human-male-female"></i></div><span>FAMILIAR</span></strong>
<section class="pt-0">
  <form id="form_servidor_familiar" class="" name="form_servidor_familiar" method="post" action="">
    <input type="hidden" id="familiar_servidor_id" name="id" class="servidor_id" value="<?= $id; ?>">
    <input type="hidden" id="servidor_familiar_id_s" name="servidor_familiar_id_s" value="<?= $rsServidorFamiliar['id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> DADOS CIVÍS</strong></h5>
      </div>
      <div class="box-body">
        <div class="row mt-10">
          <div class="col-md-6">
            <div class="form-group">
              <label for="est_civ_s">Estado Civil<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="est_civ_s" name="est_civ_s" class="form-control select2" style="width: 100%;" placeholder="selecione o estado civil do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEstadosCivis as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorFamiliar['bsc_estado_civil_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div id="div_dados_civis" <?= $displayDadosCivis ;?>>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_dt_casam_s">Data de casamento<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="conjuge_dt_casam_s" name="conjuge_dt_casam_s" placeholder="Data de casamento" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorFamiliar['conjuge_dt_casamento']); ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_nome_s">Nome do conjuge<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="conjuge_nome_s" name="conjuge_nome_s" placeholder="Nome do conjuge do servidor" value="<?= $rsServidorFamiliar['conjuge_nome']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_cpf_s">CPF do conjuge<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control cpf_format" minlength="14" id="conjuge_cpf_s" name="conjuge_cpf_s" placeholder="CPF do conjuge do servidor" title="exemplo: 999.999.999-99" value="<?= $rsServidorFamiliar['conjuge_cpf']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_dt_nasc_s">Data de nascimento do conjuge<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="conjuge_dt_nasc_s" name="conjuge_dt_nasc_s" placeholder="Data de nascimento do conjuge" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorFamiliar['conjuge_dt_nascimento']); ?>"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_nacionalidade_s">Nacionalidade do conjuge<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="conjuge_nacionalidade_s" name="conjuge_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do conjuge">
                    <option></option>
                    <?php
                    foreach ($rsPaises as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorFamiliar['conjuge_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div id="div_conjuge_nacional" <?= $displayConjugeNacional ;?>>
                <div class="form-group">
                  <label for="conjuge_naturalidade_s">Naturalidade do conjuge<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <select id="conjuge_naturalidade_s" name="conjuge_naturalidade_s" class="form-control select2_conjuge_naturalidade" style="width: 100%;" placeholder="selecione a naturalidade do conjuge" <?= isset($rsServidorFamiliar['conjuge_natural_bsc_pais_id']) ? ($rsServidorFamiliar['conjuge_natural_bsc_pais_id'] == 1 ? '' : 'disabled="true"') : 'disabled="true"' ;?>>
                      <option></option>
                      <?php
                      if (isset($rsServidorFamiliar['conjuge_natural_bsc_municipio_id'])) {
                        ?>
                        <option value="<?= $rsServidorFamiliar['conjuge_natural_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorFamiliar['conjuge_natural_municipio_nome'].' - '.$rsServidorFamiliar['conjuge_natural_estado_sigla']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="div_conjuge_extranjero" <?= $displayConjugeExtranjeiro ;?>>
            <div class="row mt-10">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="conjuge_nat_est_cidade_s">Cidade do conjuge estrangeiro<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="conjuge_nat_est_cidade_s" name="conjuge_nat_est_cidade_s" placeholder="Cidade natural do conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="conjuge_nat_est_estado_s">Estado do conjuge estrangeiro<span class="text-danger"></span>: </label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="conjuge_nat_est_estado_s" name="conjuge_nat_est_estado_s" placeholder="Estado natural do conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-12">
              <div class="form-group">
                <label for="conjuge_local_trabalho_s">local de trabalho do conjuge<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="conjuge_local_trabalho_s" name="conjuge_local_trabalho_s" placeholder="Local de trablaho do conjuge" value="<?= $rsServidorFamiliar['conjuge_local_trabalho']; ?>"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="div_reg_civil">
        <div class="box-header">
          <h5 class="mb-0"><strong> REGISTRO CIVIL</strong></h5>
        </div>
        <div class="box-body">
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_num_s">Número de Registro<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_civ_num_s" name="reg_civ_num_s" placeholder="Número do registro civil" value="<?= $rsServidorFamiliar['reg_civil_numero']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_dt_expedicao_s">Data de expedição<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="reg_civ_dt_expedicao_s" name="reg_civ_dt_expedicao_s" placeholder="Data de expedicao do registro civil" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorFamiliar['reg_civil_dt_emissao']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_livro_s">Livro<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_civ_livro_s" name="reg_civ_livro_s" placeholder="Livro do registro civil" value="<?= $rsServidorFamiliar['reg_civil_livro']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_folha_s">Folha<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_civ_folha_s" name="reg_civ_folha_s" placeholder="Folha do livro do registro civil" value="<?= $rsServidorFamiliar['reg_civil_folha']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_cartorio_s">Cartório<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_civ_cartorio_s" name="reg_civ_cartorio_s" placeholder="Cartório do registro civil" value="<?= $rsServidorFamiliar['reg_civil_cartorio']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_cidade_s">Cidade<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="reg_civ_cidade_s" name="reg_civ_cidade_s" class="form-control select2_reg_civ_cidadae" style="width: 100%;" placeholder="selecione a cidade do registro civil" required>
                    <option></option>
                    <?php
                    if (isset($rsServidorFamiliar['reg_civil_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidorFamiliar['reg_civil_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorFamiliar['reg_civil_estado_sigla']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="div_averbacao" <?= $displayAverbacao ;?>>
      <div class="box box-outline-primary">
        <div class="box-header">
          <strong>AVERBAÇÃO</strong>
        </div>
        <div class="box-body">
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_tipo_s">Tipo<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="averbacao_tipo_s" name="averbacao_tipo_s" placeholder="Tipo de averbação" value="<?= $rsServidorFamiliar['averbacao_tipo']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_num_s">Averbação - Número<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="averbacao_num_s" name="averbacao_num_s" placeholder="Número da averbação" value="<?= $rsServidorFamiliar['averbacao_numero']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_dt_expedicao_s">Averbação - Data de expedição<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="averbacao_dt_expedicao_s" name="averbacao_dt_expedicao_s" placeholder="Data de expedicao da averbação" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorFamiliar['averbacao_dt_emissao']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="averbacao_cartorio_s">Averbação - Cartório<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="averbacao_cartorio_s" name="averbacao_cartorio_s" placeholder="Cartório da averbacao" value="<?= $rsServidorFamiliar['averbacao_cartorio']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="averbacao_cidade_s">Averbação - Cidade<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="averbacao_cidade_s" name="averbacao_cidade_s" class="form-control select2_averbacao_cidade" style="width: 100%;" placeholder="selecione a cidade da averbacao" required>
                    <option></option>
                    <?php
                    if (isset($rsServidorFamiliar['averbacao_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidorFamiliar['averbacao_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorFamiliar['averbacao_municipio_nome'].' - '.$rsServidorFamiliar['averbacao_estado_sigla']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>