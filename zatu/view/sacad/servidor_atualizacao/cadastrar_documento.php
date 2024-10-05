<?php
$displayRegMilitar        = $rsServidorAtualizacao['sexo'] == 'F' ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="fal fa-address-card"></i></div><span>DOCUMENTOS</span></strong>
<section class="pt-0">
  <form id="form_servidor_documento" class="" name="form_servidor_documento" method="post" action="">
    <input type="hidden" id="documento_servidor_atualizacao_id" class="servidor_atualizacao_id" name="id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="servidor_atualizacao_documento_id_s" name="servidor_atualizacao_documento_id_s" value="<?= $rsServidorAtualizacaoDocumento['id']; ?>">
    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO GERAL (RG)</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_rg'] == 0 && $rsServidorAtualizacaoProva['situacao_rg'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_rg'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_rg'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_rg'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_rg'] ;?></span>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_numero_s">RG - Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidorDocumento['rg_numero'];?>"><?= $rsServidorDocumento['rg_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rg_numero_s" name="rg_numero_s" placeholder="Número do RG do servidor" value="<?= $rsServidorAtualizacaoDocumento['rg_numero']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_dt_emissao_s">RG - Data de emissao<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= data_volta($rsServidorDocumento['rg_dt_emissao']);?>"><?= data_volta($rsServidorDocumento['rg_dt_emissao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="rg_dt_emissao_s" name="rg_dt_emissao_s" placeholder="Data de emissao do RG do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['rg_dt_emissao']); ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidorDocumento['rg_orgao_expedidor'];?>"><?= $rsServidorDocumento['rg_orgao_expedidor']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rg_orgao_expedidor_s" name="rg_orgao_expedidor_s" placeholder="Órgão expedidor do RG do servidor" value="<?= $rsServidorAtualizacaoDocumento['rg_orgao_expedidor']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> PIS/PASEP</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_pis'] == 0 && $rsServidorAtualizacaoProva['situacao_pis'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_pis'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_pis'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_pis'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_pis'] ;?></span>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_numero_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="pis" value="<?= $rsServidorDocumento['pis_numero'];?>"><?= $rsServidorDocumento['pis_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_numero_s" name="pis_numero_s" placeholder="Número do PIS do servidor" value="<?= $rsServidorAtualizacaoDocumento['pis_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_dt_cadastro_s">Data de cadastro: <span class="text-danger"><?= data_volta($rsServidorDocumento['pis_dt_cadastro']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="pis_dt_cadastro_s" name="pis_dt_cadastro_s" placeholder="Data de cadastro do PIS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['pis_dt_cadastro']); ?>" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_dom_bancario_s">Domicilio bancario: <span class="text-danger"><?= $rsServidorDocumento['pis_domicilio_bancario']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_dom_bancario_s" name="pis_dom_bancario_s" placeholder="Domicilio bancario do PIS do servidor" value="<?= $rsServidorAtualizacaoDocumento['pis_domicilio_bancario']; ?>"/>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_banco_numero_s">N. do banco: <span class="text-danger"><?= $rsServidorDocumento['pis_banco_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_banco_numero_s" name="pis_banco_numero_s" placeholder="Número do banco do PIS do servidor" value="<?= $rsServidorAtualizacaoDocumento['pis_banco_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_agencia_s">Agencia bancária: <span class="text-danger"><?= $rsServidorDocumento['pis_agencia']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_agencia_s" name="pis_agencia_s" placeholder="Agencia bancária do PIS do servidor" value="<?= $rsServidorAtualizacaoDocumento['pis_agencia']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_agencia_end_s">Endereço da agencia: <span class="text-danger"><?= $rsServidorDocumento['pis_agencia_end']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_agencia_end_s" name="pis_agencia_end_s" placeholder="Endereço da agencia bancária do PIS do servidor" value="<?= $rsServidorAtualizacaoDocumento['pis_agencia_end']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> CARTEIRA DE TRABALHO E PREVIDÊNCIA SOCIAL</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_ctps'] == 0 && $rsServidorAtualizacaoProva['situacao_ctps'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_ctps'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_ctps'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_ctps'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_ctps'] ;?></span>
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
              <label for="ctps_numero_s">Número<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="ctps" value="<?= $rsServidorDocumento['ctps_numero'];?>"><?= $rsServidorDocumento['ctps_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_numero_s" name="ctps_numero_s" placeholder="Número da CTPS do servidor" value="<?= $rsServidorAtualizacaoDocumento['ctps_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="ctps_seire_s">Série<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="ctps" value="<?= $rsServidorDocumento['ctps_serie'];?>"><?= $rsServidorDocumento['ctps_serie']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_seire_s" name="ctps_seire_s" placeholder="Série da CTPS do servidor" value="<?= $rsServidorAtualizacaoDocumento['ctps_serie']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_dt_emissao_s">Data de emissao<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="ctps" value="<?= data_volta($rsServidorDocumento['ctps_dt_emissao']);?>"><?= data_volta($rsServidorDocumento['ctps_dt_emissao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="ctps_dt_emissao_s" name="ctps_dt_emissao_s" placeholder="Data de emissao da CTPS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['ctps_dt_emissao']); ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_orgao_expedidor_s">Órgão expedidor<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="ctps" value="<?= $rsServidorDocumento['ctps_orgao_expedidor'];?>"><?= $rsServidorDocumento['ctps_orgao_expedidor']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_orgao_expedidor_s" name="ctps_orgao_expedidor_s" placeholder="Órgão expedidor da CTPS do servidor" value="<?= $rsServidorAtualizacaoDocumento['ctps_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_primeiro_emprego_ano_s">Ano do primeiro emprego<span class="text-danger"></span>: <span class="text-warning" grupo="input_number" subgrupo="ctps" value="<?= $rsServidorDocumento['ctps_primeiro_emprego_ano'];?>"><?= $rsServidorDocumento['ctps_primeiro_emprego_ano']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="4" maxlength="4" id="ctps_primeiro_emprego_ano_s" name="ctps_primeiro_emprego_ano_s" placeholder="Ano do primeiro emprego do servidor" value="<?= $rsServidorAtualizacaoDocumento['ctps_primeiro_emprego_ano']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong>TÍTULO DE ELEITOR</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_eleitor'] == 0 && $rsServidorAtualizacaoProva['situacao_eleitor'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_eleitor'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_eleitor'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_eleitor'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_eleitor'] ;?></span>
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
              <label for="eleitor_numero_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="eleitor" value="<?= $rsServidorDocumento['eleitor_numero'];?>"><?= $rsServidorDocumento['eleitor_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="eleitor_numero_s" name="eleitor_numero_s" placeholder="Número do Titulo de Eleitor do servidor" value="<?= $rsServidorAtualizacaoDocumento['eleitor_numero']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_zona_s">Zona<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="eleitor" value="<?= $rsServidorDocumento['eleitor_zona'];?>"><?= $rsServidorDocumento['eleitor_zona']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="eleitor_zona_s" name="eleitor_zona_s" placeholder="Zona do Titulo de Eleitor do servidor" value="<?= $rsServidorAtualizacaoDocumento['eleitor_zona']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_secao_s">Seção<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="eleitor" value="<?= $rsServidorDocumento['eleitor_secao'];?>"><?= $rsServidorDocumento['eleitor_secao']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="eleitor_secao_s" name="eleitor_secao_s" placeholder="Seção do Titulo de Eleitor do servidor" value="<?= $rsServidorAtualizacaoDocumento['eleitor_secao']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_cidade_s">Cidade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="eleitor" value="<?= $rsServidorDocumento['eleitor_bsc_municipio_id'];?>"><?= $rsServidorDocumento['eleitor_municipio_nome'].' - '.$rsServidorDocumento['eleitor_estado_sigla']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="eleitor_cidade_s" name="eleitor_cidade_s" class="form-control select2_eleitor_cidade" style="width: 100%;" placeholder="selecione a cidade do Tituto de Eleitor do servidor" required>
                  <?php
                  if (isset($rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id'])) {
                    ?>
                    <option value="<?= $rsServidorAtualizacaoDocumento['eleitor_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorAtualizacaoDocumento['eleitor_municipio_nome'].' - '.$rsServidorAtualizacaoDocumento['eleitor_estado_sigla']; ?></option>
                    <?php
                  } else {
                    ?>
                    <option></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_insc_orgao_classe_s">Inscrição em órgão de classe: <span class="text-warning" grupo="input_number" subgrupo="eleitor" value="<?= $rsServidorDocumento['eleitor_insc_orgao_classe'];?>"><?= $rsServidorDocumento['eleitor_insc_orgao_classe']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="1" id="eleitor_insc_orgao_classe_s" name="eleitor_insc_orgao_classe_s" placeholder="Inscrição em órgão de classe do servidor" value="<?= $rsServidorAtualizacaoDocumento['eleitor_insc_orgao_classe']; ?>"/>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <div id="div_registro_militar" <?= $displayRegMilitar ;?>>
      <div class="box box-outline-primary">
        <div class="box-header">
          <h5 class="mb-0"><strong>REGISTRO MILITAR (APENAS PARA HOMENS)</strong></h5>
          <?php 
          if ($rsServidorAtualizacaoProva['situacao_reg_militar'] == 0 && $rsServidorAtualizacaoProva['situacao_reg_militar'] != NULL) {
            ?>
            <div class="alert alert-warning mt-10 mb-0 pl-5"> Informações recusadas pelo setor de RH</div>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-warning mb-0 pl-5">
                  <span>MOTIVO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-warning mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_reg_militar'] ;?></span>
                </div>
              </div>
            </div>
            <?php
          }
          if ($rsServidorAtualizacaoProva['situacao_reg_militar'] == 1) {
            ?>
            <div class="alert alert-success mt-10 mb-0 pl-5"> Informações aceitas pelo setor de RH</div>
            <?php
            if ($rsServidorAtualizacaoProva['obs_reg_militar'] != '') {
              ?>
              <div class="row mt-2">
                <div class="col-md-2">
                  <div class="form-group alert alert-success mb-0 pl-5">
                    <span>OBSERVAÇÃO: </span>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group alert alert-success mb-0 pl-5">
                    <span><?= $rsServidorAtualizacaoProva['obs_reg_militar'] ;?></span>
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
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_numero_s">Número: <span class="text-warning" grupo="input_text" subgrupo="reg_mili" value="<?= $rsServidorDocumento['reg_militar_numero'];?>"><?= $rsServidorDocumento['reg_militar_numero']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_militar_numero_s" name="reg_militar_numero_s" placeholder="Número do Registro Militar do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_militar_numero']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_categoria_s">Categoria: <span class="text-warning" grupo="input_text" subgrupo="reg_mili" value="<?= $rsServidorDocumento['reg_militar_categoria'];?>"><?= $rsServidorDocumento['reg_militar_categoria']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_militar_categoria_s" name="reg_militar_categoria_s" placeholder="Categoria do Registro Militar do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_militar_categoria']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_emissao_ano_s">Ano de emissão: <span class="text-warning" grupo="input_number" subgrupo="reg_mili" value="<?= $rsServidorDocumento['reg_militar_emissao_ano'];?>"><?= $rsServidorDocumento['reg_militar_emissao_ano']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="number" class="form-control" minlength="4" maxlength="4" id="reg_militar_emissao_ano_s" name="reg_militar_emissao_ano_s" placeholder="Ano de emissão do Registro Militar do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_militar_emissao_ano']; ?>"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_militar_orgao_expedidor_s">Órgão expedidor: <span class="text-warning" grupo="input_text" subgrupo="reg_mili" value="<?= $rsServidorDocumento['reg_militar_orgao_expedidor'];?>"><?= $rsServidorDocumento['reg_militar_orgao_expedidor']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_militar_orgao_expedidor_s" name="reg_militar_orgao_expedidor_s" placeholder="Órgão expedidor do Registro Militar do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_militar_orgao_expedidor']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_militar_especie_s">Espécie: <span class="text-warning" grupo="input_text" subgrupo="reg_mili" value="<?= $rsServidorDocumento['reg_militar_especie'];?>"><?= $rsServidorDocumento['reg_militar_especie']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="reg_militar_especie_s" name="reg_militar_especie_s" placeholder="Espécie do Registro Militar do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_militar_especie']; ?>"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO PROFISSIONAL</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_reg_prof'] == 0 && $rsServidorAtualizacaoProva['situacao_reg_prof'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_reg_prof'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_reg_prof'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_reg_prof'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_reg_prof'] ;?></span>
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
              <label for="reg_profissional_numero_s">Número: <span class="text-warning" grupo="input_text" subgrupo="reg_prof" value="<?= $rsServidorDocumento['reg_prof_numero'];?>"><?= $rsServidorDocumento['reg_prof_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="reg_profissional_numero_s" name="reg_profissional_numero_s" placeholder="Número do Registro Profissional do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_prof_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_dt_emissao_s">Data de emissao: <span class="text-warning" grupo="input_text" subgrupo="reg_prof" value="<?= data_volta($rsServidorDocumento['reg_prof_dt_emissao']);?>"><?= data_volta($rsServidorDocumento['reg_prof_dt_emissao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="reg_prof_dt_emissao_s" name="reg_prof_dt_emissao_s" placeholder="Data de emissao do Registro Profissional do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_emissao']); ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_orgao_expedidor_s">Órgão expedidor: <span class="text-warning" grupo="input_text" subgrupo="reg_prof" value="<?= $rsServidorDocumento['reg_prof_orgao_expedidor'];?>"><?= $rsServidorDocumento['reg_prof_orgao_expedidor']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="reg_prof_orgao_expedidor_s" name="reg_prof_orgao_expedidor_s" placeholder="Órgão expedidor do Registro Profissional do servidor" value="<?= $rsServidorAtualizacaoDocumento['reg_prof_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_dt_validade_s">Data de validade: <span class="text-warning" grupo="input_text" subgrupo="reg_prof" value="<?= data_volta($rsServidorDocumento['reg_prof_dt_validade']);?>"><?= data_volta($rsServidorDocumento['reg_prof_dt_validade']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="reg_prof_dt_validade_s" name="reg_prof_dt_validade_s" placeholder="Data de validade do Registro Profissional do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['reg_prof_dt_validade']); ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> CARTEIRA NACIONAL DE HABILITAÇÃO</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_cnh'] == 0 && $rsServidorAtualizacaoProva['situacao_cnh'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_cnh'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_cnh'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_cnh'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_cnh'] ;?></span>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_numero_s">CNH - Número: <span class="text-warning" grupo="input_number" subgrupo="cnh" value="<?= $rsServidorDocumento['cnh_numero'];?>"><?= $rsServidorDocumento['cnh_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="cnh_numero_s" name="cnh_numero_s" placeholder="Número da CNH do servidor" value="<?= $rsServidorAtualizacaoDocumento['cnh_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_categoria_s">CNH - Categoria: <span class="text-warning" grupo="select" subgrupo="cnh" value="<?= $rsServidorDocumento['cnh_categoria'];?>"><?= $rsServidorDocumento['cnh_categoria']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="cnh_categoria_s" name="cnh_categoria_s" class="form-control select2" style="width: 100%;" placeholder="selecione a categoria da CNH do servidor">
                  <option value="">Escolha uma opção</option>
                  <option value="A"  <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'A'  ? 'selected="selected"' : '' ?>>A</option>
                  <option value="B"  <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'B'  ? 'selected="selected"' : '' ?>>B</option>
                  <option value="AB" <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'AB' ? 'selected="selected"' : '' ?>>AB</option>
                  <option value="C"  <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'C'  ? 'selected="selected"' : '' ?>>C</option>
                  <option value="AC" <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'AC' ? 'selected="selected"' : '' ?>>AC</option>
                  <option value="D"  <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'D'  ? 'selected="selected"' : '' ?>>D</option>
                  <option value="AD" <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'AD' ? 'selected="selected"' : '' ?>>AD</option>
                  <option value="E"  <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'E'  ? 'selected="selected"' : '' ?>>E</option>
                  <option value="AE" <?= $rsServidorAtualizacaoDocumento['cnh_categoria'] == 'AE' ? 'selected="selected"' : '' ?>>AE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_dt_emissao_s">Data de Emissão: <span class="text-warning" grupo="input_text" subgrupo="cnh" value="<?= data_volta($rsServidorDocumento['cnh_dt_emissao']);?>"><?= data_volta($rsServidorDocumento['cnh_dt_emissao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_dt_emissao_s" name="cnh_dt_emissao_s" placeholder="Data de emissao da CNH do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_emissao']); ?>" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_orgao_expedidor_s">Órgão expedidor: <span class="text-warning" grupo="input_text" subgrupo="cnh" value="<?= $rsServidorDocumento['cnh_orgao_expedidor'];?>"><?= $rsServidorDocumento['cnh_orgao_expedidor']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="cnh_orgao_expedidor_s" name="cnh_orgao_expedidor_s" placeholder="Órgão expedidor da CNH do servidor" value="<?= $rsServidorAtualizacaoDocumento['cnh_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_dt_validade_s">Data de validade: <span class="text-warning" grupo="input_text" subgrupo="cnh" value="<?= data_volta($rsServidorDocumento['cnh_dt_validade']);?>"><?= data_volta($rsServidorDocumento['cnh_dt_validade']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_dt_validade_s" name="cnh_dt_validade_s" placeholder="Data de validade da CNH do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_validade']); ?>" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_primeira_habilitacao_s">Data da primeira habilitação: <span class="text-warning" grupo="input_text" subgrupo="cnh" value="<?= data_volta($rsServidorDocumento['cnh_dt_primeira_habilitacao']);?>"><?= data_volta($rsServidorDocumento['cnh_dt_primeira_habilitacao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_primeira_habilitacao_s" name="cnh_primeira_habilitacao_s" placeholder="Data da primeira habilitação do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['cnh_dt_primeira_habilitacao']); ?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO NACIONAL DE ESTRANGEIRO</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_rne'] == 0 && $rsServidorAtualizacaoProva['situacao_rne'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_rne'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_rne'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_rne'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_rne'] ;?></span>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_numero_s">Número<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_number" subgrupo="rne" value="<?= $rsServidorDocumento['rne_numero'];?>"><?= $rsServidorDocumento['rne_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="1" id="rne_numero_s" name="rne_numero_s" placeholder="Número do RNE do servidor" value="<?= $rsServidorAtualizacaoDocumento['rne_numero']; ?>" allempty/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_dt_emissao_s">Data de emissao<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="rne" value="<?= data_volta($rsServidorDocumento['rne_dt_emissao']);?>"><?= data_volta($rsServidorDocumento['rne_dt_emissao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="rne_dt_emissao_s" name="rne_dt_emissao_s" placeholder="Data de emissao do RNE do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['rne_dt_emissao']); ?>" allempty/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_orgao_expedidor_s">Órgão expedidor<span class="text-danger" validator></span>: <span class="text-warning" grupo="input_text" subgrupo="rne" value="<?= $rsServidorDocumento['rne_orgao_expedidor'];?>"><?= $rsServidorDocumento['rne_orgao_expedidor']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rne_orgao_expedidor_s" name="rne_orgao_expedidor_s" placeholder="Órgão expedidor do RNE do servidor" value="<?= $rsServidorAtualizacaoDocumento['rne_orgao_expedidor']; ?>" allempty/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="estrang_casado_brasileiro_s">Casado com brasileiro(a)<span class="text-danger"></span>? <span class="text-danger"><?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'Sim' : 'Não';?></span></label>
              <div class="form-group ichack-input mt-10">
                <label>
                  <input type="radio" id="estrang_casado_brasileiro_Sim" name="estrang_casado_brasileiro_s" class="square-purple" <?= $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'checked="checked"' : ''; ?> value="1"> Sim
                </label>
                <label>
                  <input type="radio" id="estrang_casado_brasileiro_Nao" name="estrang_casado_brasileiro_s" class="square-purple" <?= $rsServidorAtualizacaoDocumento['estrangeiro_casado_brasileiro'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Não
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="estrang_filho_brasileiro_s">Tem filho brasileiro(a)<span class="text-danger"></span>? <span class="text-danger"><?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'Sim' : 'Não'; ?></span></label>
              <div class="form-group ichack-input mt-10">
                <label>
                  <input type="radio" id="estrang_filho_brasileiro_Sim" name="estrang_filho_brasileiro_s" class="square-purple" <?= $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'checked="checked"' : ''; ?> value="1"> Sim
                </label>
                <label>
                  <input type="radio" id="estrang_filho_brasileiro_Nao" name="estrang_filho_brasileiro_s" class="square-purple" <?= $rsServidorAtualizacaoDocumento['estrangeiro_filho_brasileiro'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Não
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> FGTS</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_fgts'] == 0 && $rsServidorAtualizacaoProva['situacao_fgts'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_fgts'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_fgts'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_fgts'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_fgts'] ;?></span>
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
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_numero_s">Número: <span class="text-warning" grupo="input_number" subgrupo="fgts" value="<?= $rsServidorDocumento['fgts_numero'];?>"><?= $rsServidorDocumento['fgts_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="fgts_numero_s" name="fgts_numero_s" placeholder="Número do FGTS do servidor" value="<?= $rsServidorAtualizacaoDocumento['fgts_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_opcao_s">Opção: <span class="text-danger"><?= $rsServidorDocumento['fgts_opcao']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="fgts_opcao_s" name="fgts_opcao_s" placeholder="Opção do FGTS do servidor" value="<?= $rsServidorAtualizacaoDocumento['fgts_opcao']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_conta_vinculada_banco_s">C. bancaria vinculada: <span class="text-danger"><?= $rsServidorDocumento['fgts_conta_vinculada_banco']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="fgts_conta_vinculada_banco_s" name="fgts_conta_vinculada_banco_s" placeholder="Conta bancária vinculada ao FGTS do servidor" value="<?= $rsServidorAtualizacaoDocumento['fgts_conta_vinculada_banco']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_dt_retificacao_s">Data de retificação: <span class="text-danger"><?= data_volta($rsServidorDocumento['fgts_dt_retificacao']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="fgts_dt_retificacao_s" name="fgts_dt_retificacao_s" placeholder="Data de retificação do FGTS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacaoDocumento['fgts_dt_retificacao']); ?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </form>
</section>
