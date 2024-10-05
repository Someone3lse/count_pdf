<?php
$displayRegMilitar        = $rsServidor['sexo'] == 'F' ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="fal fa-address-card"></i></div><span>DOCUMENTOS</span></strong>
<section class="pt-0">
  <form id="form_servidor_documento" class="" name="form_servidor_documento" method="post" action="">
    <input type="hidden" id="documento_servidor_id" class="servidor_id" name="id" value="<?= $id; ?>">
    <input type="hidden" id="servidor_documento_id_s" name="servidor_documento_id_s" value="<?= $rsServidorDocumento['id']; ?>">
    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO GERAL (RG)</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_numero_s">RG - Número<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rg_numero_s" name="rg_numero_s" placeholder="Número do RG do servidor" value="<?= $rsServidorDocumento['rg_numero']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_dt_emissao_s">RG - Data de emissao<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="rg_dt_emissao_s" name="rg_dt_emissao_s" placeholder="Data de emissao do RG do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['rg_dt_emissao']); ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rg_orgao_expedidor_s" name="rg_orgao_expedidor_s" placeholder="Órgão expedidor do RG do servidor" value="<?= $rsServidorDocumento['rg_orgao_expedidor']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> PIS/PASEP</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_numero_s">Número<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_numero_s" name="pis_numero_s" placeholder="Número do PIS do servidor" value="<?= $rsServidorDocumento['pis_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_dt_cadastro_s">Data de cadastro<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="pis_dt_cadastro_s" name="pis_dt_cadastro_s" placeholder="Data de cadastro do PIS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['pis_dt_cadastro']); ?>" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_dom_bancario_s">Domicilio bancario<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_dom_bancario_s" name="pis_dom_bancario_s" placeholder="Domicilio bancario do PIS do servidor" value="<?= $rsServidorDocumento['pis_domicilio_bancario']; ?>"/>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_banco_numero_s">N. do banco<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_banco_numero_s" name="pis_banco_numero_s" placeholder="Número do banco do PIS do servidor" value="<?= $rsServidorDocumento['pis_banco_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_agencia_s">Agencia bancária<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_agencia_s" name="pis_agencia_s" placeholder="Agencia bancária do PIS do servidor" value="<?= $rsServidorDocumento['pis_agencia']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pis_agencia_end_s">Endereço da agencia<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pis_agencia_end_s" name="pis_agencia_end_s" placeholder="Endereço da agencia bancária do PIS do servidor" value="<?= $rsServidorDocumento['pis_agencia_end']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> CARTEIRA DE TRABALHO E PREVIDÊNCIA SOCIAL</strong></h5>
      </div>
      <div class="box-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="ctps_numero_s">Número<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_numero_s" name="ctps_numero_s" placeholder="Número da CTPS do servidor" value="<?= $rsServidorDocumento['ctps_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="ctps_seire_s">Série<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_seire_s" name="ctps_seire_s" placeholder="Série da CTPS do servidor" value="<?= $rsServidorDocumento['ctps_serie']; ?>"/>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_dt_emissao_s">Data de emissao<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="ctps_dt_emissao_s" name="ctps_dt_emissao_s" placeholder="Data de emissao da CTPS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['ctps_dt_emissao']); ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_orgao_expedidor_s">Órgão expedidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="ctps_orgao_expedidor_s" name="ctps_orgao_expedidor_s" placeholder="Órgão expedidor da CTPS do servidor" value="<?= $rsServidorDocumento['ctps_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ctps_primeiro_emprego_ano_s">Ano do primeiro emprego<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="4" maxlength="4" id="ctps_primeiro_emprego_ano_s" name="ctps_primeiro_emprego_ano_s" placeholder="Ano do primeiro emprego do servidor" value="<?= $rsServidorDocumento['ctps_primeiro_emprego_ano']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong>TÍTULO DE ELEITOR</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_numero_s">Número<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="eleitor_numero_s" name="eleitor_numero_s" placeholder="Número do Titulo de Eleitor do servidor" value="<?= $rsServidorDocumento['eleitor_numero']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_zona_s">Zona<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="eleitor_zona_s" name="eleitor_zona_s" placeholder="Zona do Titulo de Eleitor do servidor" value="<?= $rsServidorDocumento['eleitor_zona']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_secao_s">Seção<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="eleitor_secao_s" name="eleitor_secao_s" placeholder="Seção do Titulo de Eleitor do servidor" value="<?= $rsServidorDocumento['eleitor_secao']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eleitor_cidade_s">Cidade<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="eleitor_cidade_s" name="eleitor_cidade_s" class="form-control select2_eleitor_cidade" style="width: 100%;" placeholder="selecione a cidade do Tituto de Eleitor do servidor" required>
                  <?php
                  if (isset($rsServidorDocumento['eleitor_bsc_municipio_id'])) {
                    ?>
                    <option value="<?= $rsServidorDocumento['eleitor_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorDocumento['eleitor_municipio_nome'].' - '.$rsServidorDocumento['eleitor_estado_sigla']; ?></option>
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
              <label for="eleitor_insc_orgao_classe_s">Inscrição em órgão de classe<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="eleitor_insc_orgao_classe_s" name="eleitor_insc_orgao_classe_s" placeholder="Inscrição em órgão de classe do servidor" value="<?= $rsServidorDocumento['eleitor_insc_orgao_classe']; ?>"/>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>

    <div id="div_registro_militar" <?= $displayRegMilitar ;?>>
      <div class="box box box-outline-primary">
        <div class="box-header">
          <h5 class="mb-0"><strong> REGISTRO MILITAR (APENAS PARA HOMENS)</strong></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_numero_s">Número<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_militar_numero_s" name="reg_militar_numero_s" placeholder="Número do Registro Militar do servidor" value="<?= $rsServidorDocumento['reg_militar_numero']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_categoria_s">Categoria<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_militar_categoria_s" name="reg_militar_categoria_s" placeholder="Categoria do Registro Militar do servidor" value="<?= $rsServidorDocumento['reg_militar_categoria']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="reg_militar_emissao_ano_s">Ano de emissão<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="number" class="form-control" minlength="4" maxlength="4" id="reg_militar_emissao_ano_s" name="reg_militar_emissao_ano_s" placeholder="Ano de emissão do Registro Militar do servidor" value="<?= $rsServidorDocumento['reg_militar_emissao_ano']; ?>"/>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_militar_orgao_expedidor_s">Órgão expedidor<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_militar_orgao_expedidor_s" name="reg_militar_orgao_expedidor_s" placeholder="Órgão expedidor do Registro Militar do servidor" value="<?= $rsServidorDocumento['reg_militar_orgao_expedidor']; ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="reg_militar_especie_s">Espécie<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="reg_militar_especie_s" name="reg_militar_especie_s" placeholder="Espécie do Registro Militar do servidor" value="<?= $rsServidorDocumento['reg_militar_especie']; ?>"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO PROFISSIONAL</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_profissional_numero_s">Número<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="reg_profissional_numero_s" name="reg_profissional_numero_s" placeholder="Número do Registro Profissional do servidor" value="<?= $rsServidorDocumento['reg_prof_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_dt_emissao_s">Data de emissao<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="reg_prof_dt_emissao_s" name="reg_prof_dt_emissao_s" placeholder="Data de emissao do Registro Profissional do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['reg_prof_dt_emissao']); ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_orgao_expedidor_s">Órgão expedidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="reg_prof_orgao_expedidor_s" name="reg_prof_orgao_expedidor_s" placeholder="Órgão expedidor do Registro Profissional do servidor" value="<?= $rsServidorDocumento['reg_prof_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="reg_prof_dt_validade_s">Data de validade<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="reg_prof_dt_validade_s" name="reg_prof_dt_validade_s" placeholder="Data de validade do Registro Profissional do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['reg_prof_dt_validade']); ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> Carteira Nacional de Habilitação</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_numero_s">CNH - Número<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="cnh_numero_s" name="cnh_numero_s" placeholder="Número da CNH do servidor" value="<?= $rsServidorDocumento['cnh_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_categoria_s">CNH - Categoria<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="cnh_categoria_s" name="cnh_categoria_s" class="form-control select2" style="width: 100%;" placeholder="selecione a categoria da CNH do servidor">
                  <option value="">Escolha uma opção</option>
                  <option value="A"  <?= $rsServidorDocumento['cnh_categoria'] == 'A'  ? 'selected="selected"' : '' ?>>A</option>
                  <option value="B"  <?= $rsServidorDocumento['cnh_categoria'] == 'B'  ? 'selected="selected"' : '' ?>>B</option>
                  <option value="AB" <?= $rsServidorDocumento['cnh_categoria'] == 'AB' ? 'selected="selected"' : '' ?>>AB</option>
                  <option value="C"  <?= $rsServidorDocumento['cnh_categoria'] == 'C'  ? 'selected="selected"' : '' ?>>C</option>
                  <option value="AC" <?= $rsServidorDocumento['cnh_categoria'] == 'AC' ? 'selected="selected"' : '' ?>>AC</option>
                  <option value="D"  <?= $rsServidorDocumento['cnh_categoria'] == 'D'  ? 'selected="selected"' : '' ?>>D</option>
                  <option value="AD" <?= $rsServidorDocumento['cnh_categoria'] == 'AD' ? 'selected="selected"' : '' ?>>AD</option>
                  <option value="E"  <?= $rsServidorDocumento['cnh_categoria'] == 'E'  ? 'selected="selected"' : '' ?>>E</option>
                  <option value="AE" <?= $rsServidorDocumento['cnh_categoria'] == 'AE' ? 'selected="selected"' : '' ?>>AE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_dt_emissao_s">Data de Emissão<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_dt_emissao_s" name="cnh_dt_emissao_s" placeholder="Data de emissao da CNH do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['cnh_dt_emissao']); ?>" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_orgao_expedidor_s">Órgão expedidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="cnh_orgao_expedidor_s" name="cnh_orgao_expedidor_s" placeholder="Órgão expedidor da CNH do servidor" value="<?= $rsServidorDocumento['cnh_orgao_expedidor']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_dt_validade_s">Data de validade<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_dt_validade_s" name="cnh_dt_validade_s" placeholder="Data de validade da CNH do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['cnh_dt_validade']); ?>" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cnh_primeira_habilitacao_s">Data da primeira habilitação<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="cnh_primeira_habilitacao_s" name="cnh_primeira_habilitacao_s" placeholder="Data da primeira habilitação do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['cnh_dt_primeira_habilitacao']); ?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> REGISTRO NACIONAL DE ESTRANGEIRO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_numero_s">Número<span class="text-danger" validator></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="rne_numero_s" name="rne_numero_s" placeholder="Número do RNE do servidor" value="<?= $rsServidorDocumento['rne_numero']; ?>" allempty/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_dt_emissao_s">Data de emissao<span class="text-danger" validator></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="rne_dt_emissao_s" name="rne_dt_emissao_s" placeholder="Data de emissao do RNE do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['rne_dt_emissao']); ?>" allempty/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="rne_orgao_expedidor_s">Órgão expedidor<span class="text-danger" validator></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="rne_orgao_expedidor_s" name="rne_orgao_expedidor_s" placeholder="Órgão expedidor do RNE do servidor" value="<?= $rsServidorDocumento['rne_orgao_expedidor']; ?>" allempty/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- <div class="box box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> FGTS</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_numero_s">Número<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="3" id="fgts_numero_s" name="fgts_numero_s" placeholder="Número do FGTS do servidor" value="<?= $rsServidorDocumento['fgts_numero']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_opcao_s">Opção<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="fgts_opcao_s" name="fgts_opcao_s" placeholder="Opção do FGTS do servidor" value="<?= $rsServidorDocumento['fgts_opcao']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_conta_vinculada_banco_s">C. bancaria vinculada<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="fgts_conta_vinculada_banco_s" name="fgts_conta_vinculada_banco_s" placeholder="Conta bancária vinculada ao FGTS do servidor" value="<?= $rsServidorDocumento['fgts_conta_vinculada_banco']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="fgts_dt_retificacao_s">Data de retificação<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="fgts_dt_retificacao_s" name="fgts_dt_retificacao_s" placeholder="Data de retificação do FGTS do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorDocumento['fgts_dt_retificacao']); ?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="form-group">
          <label for="estrang_casado_brasileiro_s">Casado com brasileiro(a)<span class="text-danger"></span>? </label>
          <div class="form-group ichack-input mt-10">
            <label>
              <input type="radio" id="estrang_casado_brasileiro_Sim" name="estrang_casado_brasileiro_s" class="square-purple" <?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] == '1' ? 'checked="checked"' : ''; ?> value="1"> Sim
            </label>
            <label>
              <input type="radio" id="estrang_casado_brasileiro_Nao" name="estrang_casado_brasileiro_s" class="square-purple" <?= $rsServidorDocumento['estrangeiro_casado_brasileiro'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Não
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="estrang_filho_brasileiro_s">Tem filho brasileiro(a)<span class="text-danger"></span>? </label>
          <div class="form-group ichack-input mt-10">
            <label>
              <input type="radio" id="estrang_filho_brasileiro_Sim" name="estrang_filho_brasileiro_s" class="square-purple" <?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] == '1' ? 'checked="checked"' : ''; ?> value="1"> Sim
            </label>
            <label>
              <input type="radio" id="estrang_filho_brasileiro_Nao" name="estrang_filho_brasileiro_s" class="square-purple" <?= $rsServidorDocumento['estrangeiro_filho_brasileiro'] == '0' ? 'checked="checked"' : ''; ?> value="0"> Não
            </label>
          </div>
        </div>
      </div>
    </div>

  </form>
</section>