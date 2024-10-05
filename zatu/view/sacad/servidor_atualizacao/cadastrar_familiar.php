<?php
$displayDadosCivis           = $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id'] <= 1 ? 'style="display: none;"' : '';
$displayConjugeNacional      = $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
$displayConjugeExtranjeiro   = $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
$displayAverbacao            = $rsServidorFamiliar['bsc_estado_civil_id'] != 5 ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="mdi mdi-human-male-female"></i></div><span>FAMILIAR</span></strong>
<section class="pt-0">
  <form id="form_servidor_familiar" class="" name="form_servidor_familiar" method="post" action="">
    <input type="hidden" id="familiar_servidor_atualizacao_id" class="servidor_atualizacao_id" name="id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="servidor_atualizacao_familiar_id_s" name="servidor_atualizacao_familiar_id_s" value="<?= $rsServidorAtualizacaoFamiliar['id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> DADOS CIVÍS</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_reg_civil'] == 0 && $rsServidorAtualizacaoProva['situacao_reg_civil'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_reg_civil'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_reg_civil'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_reg_civil'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_reg_civil'] ;?></span>
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
          <div class="col-md-6">
            <div class="form-group">
              <label for="est_civ_s">Estado Civil<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="conjuge" value="<?= $rsServidorFamiliar['bsc_estado_civil_id'];?>"><?= $rsServidorFamiliar['estado_civil_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="est_civ_s" name="est_civ_s" class="form-control select2" style="width: 100%;" placeholder="selecione o estado civil do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEstadosCivis as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacaoFamiliar['bsc_estado_civil_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
                <label for="conjuge_dt_casam_s">Data de casamento<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= data_volta($rsServidorFamiliar['conjuge_dt_casamento']); ?>"><?= data_volta($rsServidorFamiliar['conjuge_dt_casamento']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="conjuge_dt_casam_s" name="conjuge_dt_casam_s" placeholder="Data de casamento" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_casamento']); ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_nome_s">Nome do conjuge<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_nome'];?>"><?= $rsServidorFamiliar['conjuge_nome']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="conjuge_nome_s" name="conjuge_nome_s" placeholder="Nome do conjuge do servidor" value="<?= $rsServidorAtualizacaoFamiliar['conjuge_nome']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_cpf_s">CPF do conjuge<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_cpf'];?>"><?= $rsServidorFamiliar['conjuge_cpf']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control cpf_format" minlength="14" id="conjuge_cpf_s" name="conjuge_cpf_s" placeholder="CPF do conjuge do servidor" title="exemplo: 999.999.999-99" value="<?= $rsServidorAtualizacaoFamiliar['conjuge_cpf']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_dt_nasc_s">Data de nascimento do conjuge<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= data_volta($rsServidorFamiliar['conjuge_dt_nascimento']);?>"><?=  data_volta($rsServidorFamiliar['conjuge_dt_nascimento']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="conjuge_dt_nasc_s" name="conjuge_dt_nasc_s" placeholder="Data de nascimento do conjuge" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoFamiliar['conjuge_dt_nascimento']); ?>"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="conjuge_nacionalidade_s">Nacionalidade do conjuge:<span class="text-danger"></span> <span class="text-warning" grupo="select" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_bsc_pais_id'];?>"><?= $rsServidorFamiliar['conjuge_natural_nacionalidade']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <select id="conjuge_nacionalidade_s" name="conjuge_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do conjuge">
                    <option></option>
                    <?php
                    foreach ($rsPaises as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
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
                  <label for="conjuge_naturalidade_s">Naturalidade do conjuge<span class="text-danger"></span>: <span class="text-warning" grupo="select" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_bsc_municipio_id'];?>"><?= $rsServidorFamiliar['conjuge_natural_municipio_nome'].(isset($rsServidor['conjuge_natural_bsc_pais_id']) ? ' - ' : '').$rsServidorFamiliar['conjuge_natural_estado_sigla']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <select id="conjuge_naturalidade_s" name="conjuge_naturalidade_s" class="form-control select2_conjuge_naturalidade" style="width: 100%;" placeholder="selecione a naturalidade do conjuge" <?= isset($rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id']) ? ($rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_pais_id'] == 1 ? '' : 'disabled="true"') : 'disabled="true"' ;?>>
                      <option></option>
                      <?php
                      if (isset($rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id'])) {
                        ?>
                        <option value="<?= $rsServidorAtualizacaoFamiliar['conjuge_natural_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorAtualizacaoFamiliar['conjuge_natural_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['conjuge_natural_estado_sigla']; ?></option>
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
                  <label for="conjuge_nat_est_cidade_S">Naturalidade/Cidade do conjuge estrangeiro<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade'];?>"><?= $rsServidorFamiliar['conjuge_natural_estrangeiro_cidade']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="conjuge_nat_est_cidade_S" name="conjuge_nat_est_cidade_S" placeholder="Cidade natural do conjuge" value="<?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_cidade']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="conjuge_nat_est_estado_s">Naturalidade/Estado do conjuge estrangeiro<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado'];?>"><?= $rsServidorFamiliar['conjuge_natural_estrangeiro_estado']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="conjuge_nat_est_estado_s" name="conjuge_nat_est_estado_s" placeholder="Estado natural do conjuge" value="<?= $rsServidorAtualizacaoFamiliar['conjuge_natural_estrangeiro_estado']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-12">
              <div class="form-group">
                <label for="conjuge_local_trabalho_s">local de trabalho do conjuge<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="conjuge" value="<?= $rsServidorFamiliar['conjuge_local_trabalho'];?>"><?= $rsServidorFamiliar['conjuge_local_trabalho']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="conjuge_local_trabalho_s" name="conjuge_local_trabalho_s" placeholder="Local de trablaho do conjuge" value="<?= $rsServidorAtualizacaoFamiliar['conjuge_local_trabalho']; ?>"/>
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
                <label for="reg_civ_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="reg_civil" value="<?= $rsServidorFamiliar['reg_civil_numero'];?>"><?= $rsServidorFamiliar['reg_civil_numero']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_civ_num_s" name="reg_civ_num_s" placeholder="Número do registro civil" value="<?= $rsServidorAtualizacaoFamiliar['reg_civil_numero']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_dt_expedicao_s">Data de expedição<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="reg_civil" value="<?= data_volta($rsServidorFamiliar['reg_civil_dt_emissao']);?>"><?= data_volta($rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="reg_civ_dt_expedicao_s" name="reg_civ_dt_expedicao_s" placeholder="Data de expedicao do registro civil" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoFamiliar['reg_civil_dt_emissao']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_livro_s">Livro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="reg_civil" value="<?= $rsServidorFamiliar['reg_civil_livro'];?>"><?= $rsServidorFamiliar['reg_civil_livro']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_civ_livro_s" name="reg_civ_livro_s" placeholder="Livro do registro civil" value="<?= $rsServidorAtualizacaoFamiliar['reg_civil_livro']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_folha_s">Folha<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="reg_civil" value="<?= $rsServidorFamiliar['reg_civil_folha'];?>"><?= $rsServidorFamiliar['reg_civil_folha']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_civ_folha_s" name="reg_civ_folha_s" placeholder="Folha do livro do registro civil" value="<?= $rsServidorAtualizacaoFamiliar['reg_civil_folha']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_cartorio_s">Cartório<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="reg_civil" value="<?= $rsServidorFamiliar['reg_civil_cartorio'];?>"><?= $rsServidorFamiliar['reg_civil_cartorio']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_civ_cartorio_s" name="reg_civ_cartorio_s" placeholder="Cartório do registro civil" value="<?= $rsServidorAtualizacaoFamiliar['reg_civil_cartorio']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_civ_cidade_s">Cidade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="reg_civil" value="<?= $rsServidorFamiliar['reg_civil_bsc_municipio_id'];?>"><?= $rsServidorFamiliar['reg_civil_municipio_nome'].(isset($rsServidor['reg_civil_bsc_municipio_id']) ? ' - ' : '').$rsServidorFamiliar['reg_civil_estado_sigla']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <select id="reg_civ_cidade_s" name="reg_civ_cidade_s" class="form-control select2_reg_civ_cidadae" style="width: 100%;" placeholder="selecione a cidade do registro civil" required>
                    <option></option>
                    <?php
                    if (isset($rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidorAtualizacaoFamiliar['reg_civil_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorAtualizacaoFamiliar['reg_civil_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['reg_civil_estado_sigla']; ?></option>
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
          <h5 class="mb-0"><strong> AVERBAÇÃO</strong></h5>
          <?php 
          if ($rsServidorAtualizacaoProva['situacao_averbacao'] == 0 && $rsServidorAtualizacaoProva['situacao_averbacao'] != NULL) {
            ?>
            <h2 class="mb-0" style="color: red;"><strong> Informações recusadas pelo setor de RH</strong></h2>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group">
                  <span style="color: red;">MOTIVO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <span style="color: red;"><?= $rsServidorAtualizacaoProva['obs_averbacao'] ;?></span>
                </div>
              </div>
            </div>
            <?php
          }
          if ($rsServidorAtualizacaoProva['situacao_averbacao'] == 1) {
            ?>
            <h2 class="mb-0" style="color: green;"><strong> Informações aceitas pelo setor de RH</strong></h2>
            <?php
            if ($rsServidorAtualizacaoProva['obs_averbacao'] != '') {
              ?>
              <div class="row mt-3">
                <div class="col-md-2">
                  <div class="form-group">
                    <span>OBSERVAÇÃO: </span>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <span><?= $rsServidorAtualizacaoProva['obs_averbacao'] ;?></span>
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
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_tipo_s">Tipo<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="averbacao" value="<?= $rsServidorFamiliar['reg_civil_numero'];?>"><?= $rsServidorFamiliar['averbacao_tipo']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="averbacao_tipo_s" name="averbacao_tipo_s" placeholder="Tipo de averbação" value="<?= $rsServidorAtualizacaoFamiliar['averbacao_tipo']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="averbacao" value="<?= $rsServidorFamiliar['averbacao_numero'];?>"><?= $rsServidorFamiliar['averbacao_numero']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="averbacao_num_s" name="averbacao_num_s" placeholder="Número da averbação" value="<?= $rsServidorAtualizacaoFamiliar['averbacao_numero']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_dt_expedicao_s">Data de expedição<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="averbacao" value="<?= data_volta($rsServidorFamiliar['averbacao_dt_emissao']);?>"><?= data_volta($rsServidorFamiliar['averbacao_dt_emissao']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="averbacao_dt_expedicao_s" name="averbacao_dt_expedicao_s" placeholder="Data de expedicao da averbação" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoFamiliar['averbacao_dt_emissao']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_cartorio_s">Cartório<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="averbacao" value="<?= $rsServidorFamiliar['averbacao_cartorio'];?>"><?= $rsServidorFamiliar['averbacao_cartorio']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="averbacao_cartorio_s" name="averbacao_cartorio_s" placeholder="Cartório da averbacao" value="<?= $rsServidorAtualizacaoFamiliar['averbacao_cartorio']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="averbacao_cidade_s">Cidade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="averbacao" value="<?= $rsServidorFamiliar['averbacao_bsc_municipio_id'];?>"><?= $rsServidorFamiliar['averbacao_municipio_nome'].(isset($rsServidor['averbacao_bsc_municipio_id']) ? ' - ' : '').$rsServidorFamiliar['averbacao_estado_sigla']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <select id="averbacao_cidade_s" name="averbacao_cidade_s" class="form-control select2_averbacao_cidade" style="width: 100%;" placeholder="selecione a cidade da averbacao" required>
                    <option></option>
                    <?php
                    if (isset($rsServidorAtualizacaoFamiliar['averbacao_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidorFamiliar['averbacao_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorAtualizacaoFamiliar['averbacao_municipio_nome'].' - '.$rsServidorAtualizacaoFamiliar['averbacao_estado_sigla']; ?></option>
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