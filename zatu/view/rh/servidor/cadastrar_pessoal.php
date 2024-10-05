<?php
$displaySitTrab1                  = $rsServidor['rh_situacao_trabalho_id'] <= 1 ? 'style="display: none;"' : '';
$displayMatricula2                = $rsServidor['matricula_2'] == '' ? 'style="display: none;"' : '';
$displaySitTrab2                  = $rsServidor['rh_situacao_trabalho_id_2'] <= 1 ? 'style="display: none;"' : '';
$displayNaturalidadeNacional      = $rsServidor['natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
$displayNaturalidadeExtranjeiro   = $rsServidor['natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="fal fa-user"></i></div><span>PERFIL</span></strong>
<section class="pt-0 pr-0">
  <form id="form_servidor_pessoal" class="" name="form_servidor_pessoal" method="post" action="">
    <input type="hidden" id="pessoal_servidor_id" class="servidor_id" name="id" value="<?= $id; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> PESSOAL</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_s">Nome<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="nome_s" name="nome_s" placeholder="Nome do servidor" value="<?= $rsServidor['nome']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="nome_social_s">Nome social<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="nome_social_s" name="nome_social_s" placeholder="Nome social" value="<?= $rsServidor['nome_social']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="cpf_s">CPF<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cpf_format" minlength="14" id="cpf_s" name="cpf_s" placeholder="CPF do servidor" title="exemplo: 999.999.999-99" value="<?= $rsServidor['cpf']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dt_nasc_s">Data de nascimento<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" id="dt_nasc_s" name="dt_nasc_s" placeholder="Data de nascimento do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['dt_nascimento']); ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="sexo_s">Sexo<span class="text-danger">*</span>: </label>
              <div class="form-group ichack-input mt-10">
                <label>
                  <input type="radio" id="sexo_u_F" name="sexo_s" class="square-purple" <?= $rsServidor['sexo'] == 'F' ? 'checked="checked"' : ''; ?> value="F" required> Feminino
                </label>
                <label>
                  <input type="radio" id="sexo_u_M" name="sexo_s" class="square-purple" <?= $rsServidor['sexo'] == 'M' ? 'checked="checked"' : ''; ?> value="M"> Masculino
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sangue_tipo_s">Tipo sanguíneo<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="sangue_tipo_s" name="sangue_tipo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo sanguíneo do servidor">
                  <option></option>
                  <option value="O-" <?= $rsServidor['sangue_tipo'] == 'O-' ? 'selected="selected"' : '' ?>>O-</option>
                  <option value="O+" <?= $rsServidor['sangue_tipo'] == 'O+' ? 'selected="selected"' : '' ?>>O+</option>
                  <option value="A-" <?= $rsServidor['sangue_tipo'] == 'A-' ? 'selected="selected"' : '' ?>>A-</option>
                  <option value="A+" <?= $rsServidor['sangue_tipo'] == 'A+' ? 'selected="selected"' : '' ?>>A+</option>
                  <option value="B-" <?= $rsServidor['sangue_tipo'] == 'B-' ? 'selected="selected"' : '' ?>>B-</option>
                  <option value="B+" <?= $rsServidor['sangue_tipo'] == 'B+' ? 'selected="selected"' : '' ?>>B+</option>
                  <option value="AB-" <?= $rsServidor['sangue_tipo'] == 'AB-' ? 'selected="selected"' : '' ?>>AB-</option>
                  <option value="AB+" <?= $rsServidor['sangue_tipo'] == 'AB+' ? 'selected="selected"' : '' ?>>AB+</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="raca_s">Raça<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="raca_s" name="raca_s" placeholder="Raça do servidor" value="<?= $rsServidor['raca']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header">
        <h5 class="mb-0"><strong> FILIAÇÃO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="pai_nome_s">Nome do pai<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pai_nome_s" name="pai_nome_s" placeholder="Nome do pai do servidor" value="<?= $rsServidor['pai_nome']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pai_nacionalidade_s">Nacionalidade do pai<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="pai_nacionalidade_s" name="pai_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do pai do servidor">
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['pai_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="pai_profissao_s">Profissão do pai<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pai_profissao_s" name="pai_profissao_s" placeholder="Profissão da mãe do servidor" value="<?= $rsServidor['pai_profissao']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-8">
            <div class="form-group">
              <label for="mae_nome_s">Nome da mãe<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="mae_nome_s" name="mae_nome_s" placeholder="Nome da mãe do servidor" value="<?= $rsServidor['mae_nome']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mae_nacionalidade_s">Nacionalidade da mãe<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="mae_nacionalidade_s" name="mae_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade da mãe do servidor">
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['mae_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="mae_profissao_s">Profissão da mãe<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="mae_profissao_s" name="mae_profissao_s" placeholder="Profissão da mãe do servidor" value="<?= $rsServidor['mae_profissao']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> NATURALIDADE</strong></h5>
      </div>
      <div class="box-body">
        <?php
        $estrangeiroDisabled = '';
        if ($rsServidor['natural_bsc_pais_id'] == 1) {
          $estrangeiroDisabled = 'disabled="true"';
        }
        ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nacionalidade_s">Nacionalidade<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="nacionalidade_s" name="nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do servidor">
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div id="div_naturalide_nacional" <?= $displayNaturalidadeNacional ;?>>
              <div class="form-group">
                <label for="naturalidade_s">Naturalidade<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="naturalidade_s" name="naturalidade_s" class="form-control select2_naturalidade" style="width: 100%;" placeholder="selecione a naturalidade do servidor" <?= isset($rsServidor['natural_bsc_pais_id']) ? '' : 'disabled="true"' ;?> required>
                    <option></option>
                    <?php
                    if (isset($rsServidor['natural_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidor['natural_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidor['natural_municipio_nome'].' - '.$rsServidor['natural_estado_sigla']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="div_naturalide_extrangeiro" <?= $displayNaturalidadeExtranjeiro ;?>>
          <div class="row mt-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_cidade_s">Estrangeiro/Cidade<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_cidade_s" name="nat_est_cidade_s" placeholder="Cidade natural do servidor" value="<?= $rsServidor['natural_estrangeiro_cidade']; ?>" <?= $estrangeiroDisabled ;?> required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_estado_s">Estrangeiro/Estado<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_estado_s" name="nat_est_estado_s" placeholder="Estado natural do servidor" value="<?= $rsServidor['natural_estrangeiro_estado']; ?>" <?= $estrangeiroDisabled ;?> required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_dt_ingresso_s">Data de Ingresso no Brasil<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="nat_est_dt_ingresso_s" name="nat_est_dt_ingresso_s" placeholder="Data de ingresso no Brasil" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['natural_estrangeiro_dt_ingresso']); ?>" <?= $estrangeiroDisabled ;?> required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_cond_trabalho_s">Estrangeiro/Condição de trabalho<span class="text-danger"></span>: </label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_cond_trabalho_s" name="nat_est_cond_trabalho_s" placeholder="Condição de trabalho do servidor" value="<?= $rsServidor['natural_estrangeiro_condicao_trabalho']; ?>" <?= $estrangeiroDisabled ;?>/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> LOCAL DE TRABALHO 1</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="matricula_s">Matricula<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" maxlength="11" id="matricula_s" name="matricula_s" placeholder="Matricula do servidor" value="<?= $rsServidor['matricula']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="empregador_s">Empregador<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="empregador_s" name="empregador_s" class="form-control select2" style="width: 100%;" placeholder="selecione o empregador do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEmpregadores as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_empregador_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome_razao_social']. ($vObj['nome_fantasia'] != '' ? (' - '.$vObj['nome_fantasia']) : ''); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="uo_s">Secretaria de origem<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="uo_s" name="uo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o órgão de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsUOs as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['bsc_unidade_organizacional_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="setor_atual_s">Setor atual de lotação<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="setor_atual_s" name="setor_atual_s" class="form-control select2" style="width: 100%;" placeholder="selecione o setor de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  if ($id != 0) {
                    foreach ($rsSetores as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_setor_unidade_organizacional_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                      <?php
                    }
                  } else {
                    ?>
                    <option value="">Selecione primeiro o órgão de trabalho atual do servidor</option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="servidor_tipo_s">Tipo de Contrato<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="servidor_tipo_s" name="servidor_tipo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de contrato do Servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsServidorTipos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['rh_servidor_tipo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cargo_s">Cargo<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="cargo_s" name="cargo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o cargo do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsCargos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_cargo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="sit_trab_s">Situação atual de trabalho: <span class="text-danger">*</span></label>
              <div class="input-group mb-3 controls">
                <select id="sit_trab_s" name="sit_trab_s" class="form-control select2" style="width: 100%;" placeholder="selecione a situação atual de trabalho do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsSituacoesTrabalho as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['rh_situacao_trabalho_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div id="div_sit_trab_1" <?= $displaySitTrab1 ;?>>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_decreto_s">Número do decreto/portaria: <span class="text-danger">*</span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="sit_decreto_s" name="sit_decreto_s" placeholder="Número do decreto/portaria sobre a situação atual do trabalho do servidor" value="<?= $rsServidor['situacao_trabalho_decreto']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_doe_s">Número do DOE (Diário Oficial do Estado): <span class="text-danger">*</span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="sit_doe_s" name="sit_doe_s" placeholder="Número do DOE sobre a situação atual do trabalho do servidor" value="<?= $rsServidor['situacao_trabalho_doe']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_inicio_s">Data início da situação atual: <span class="text-danger">*</span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_inicio_s" name="sit_dt_inicio_s" placeholder="Data inicio da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['situacao_trabalho_dt_inicio']); ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_fim_s">Data final da situação atual: <span class="text-danger">*</span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_fim_s" name="sit_dt_fim_s" placeholder="Data fim da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['situacao_trabalho_dt_fim']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="sit_obs_s">Observação: <span class="text-danger"></span></label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" id="sit_obs_s" name="sit_obs_s" placeholder="Observação sobre a situação atual do trabalho do servidor"><?= $rsServidor['situacao_trabalho_obs']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> LOCAL DE TRABALHO 2</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="matricula_2_s">Matricula<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" maxlength="11" id="matricula_2_s" name="matricula_2_s" placeholder="Matricula do servidor" value="<?= $rsServidor['matricula_2']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div id="div_matricula_2" <?= $displayMatricula2 ;?>>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="empregador_2_s">Empregador<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="empregador_2_s" name="empregador_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o empregador do servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsEmpregadores as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_empregador_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome_razao_social']. ($vObj['nome_fantasia'] != '' ? (' - '.$vObj['nome_fantasia']) : ''); ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="uo_2_s">Secretaria atual de lotação<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="uo_2_s" name="uo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o órgão de trabalho atual do servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsUOs as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['bsc_unidade_organizacional_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="setor_atual_2_s">Setor atual de lotação<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="setor_atual_2_s" name="setor_atual_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o setor de trabalho atual do servidor" required>
                    <option></option>
                    <?php
                    if ($id != 0) {
                      foreach ($rsSetores as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_setor_unidade_organizacional_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                    } else {
                      ?>
                      <option value="">Selecione primeiro o órgão de trabalho atual do servidor</option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="servidor_tipo_2_s">Tipo de Contrato<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="servidor_tipo_2_s" name="servidor_tipo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de contrato do Servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsServidorTipos as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['rh_servidor_tipo_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cargo_2_s">Cargo<span class="text-danger">*</span>: </label>
                <div class="input-group mb-3 controls">
                  <select id="cargo_2_s" name="cargo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o cargo do servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsCargos as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['eo_cargo_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_trab_2_s">Situação atual de trabalho: <span class="text-danger">*</span></label>
                <div class="input-group mb-3 controls">
                  <select id="sit_trab_2_s" name="sit_trab_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione a situação atual de trabalho do servidor" required>
                    <option></option>
                    <?php
                    foreach ($rsSituacoesTrabalho as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidor['rh_situacao_trabalho_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div id="div_sit_trab_2" <?= $displaySitTrab2 ;?>>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="sit_decreto_2_s">Número do decreto/portaria: <span class="text-danger">*</span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="1" id="sit_decreto_2_s" name="sit_decreto_2_s" placeholder="Número do decreto/portaria sobre a situação atual do trabalho do servidor" value="<?= $rsServidor['situacao_trabalho_decreto_2']; ?>" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="sit_doe_2_s">Número do DOE (Diário Oficial do Estado): <span class="text-danger">*</span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="1" id="sit_doe_2_s" name="sit_doe_2_s" placeholder="Número do DOE sobre a situação atual do trabalho do servidor" value="<?= $rsServidor['situacao_trabalho_doe_2']; ?>" required required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="sit_dt_inicio_2_s">Data início da situação atual: <span class="text-danger">*</span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="sit_dt_inicio_2_s" name="sit_dt_inicio_2_s" placeholder="Data inicio da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['situacao_trabalho_dt_inicio_2']); ?>" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="sit_dt_fim_2_s">Data final da situação atual: <span class="text-danger">*</span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="sit_dt_fim_2_s" name="sit_dt_fim_2_s" placeholder="Data fim da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidor['situacao_trabalho_dt_fim_2']); ?>" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="sit_obs_2_s">Observação: <span class="text-danger"></span></label>
                  <div class="input-group mb-3 controls">
                    <textarea class="form-control" id="sit_obs_2_s" name="sit_obs_2_s" placeholder="Observação sobre a situação atual do trabalho do servidor"><?= $rsServidor['situacao_trabalho_obs_2']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> VACINA - COVID-19</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_nome_s">Nome da última vacina recebida<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="covid_vacina_nome_s" name="covid_vacina_nome_s" placeholder="Nome da vacina recebida" value="<?= $rsServidor['covid_vacina_nome']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_dose_s">Dose da última vacina recebida<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="covid_vacina_dose_s" name="covid_vacina_dose_s" placeholder="Dose recebida da vacina (ex.: dose 3)" value="<?= $rsServidor['covid_vacina_dose']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_lote_s">Lote da última vacina recebida<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="covid_vacina_lote_s" name="covid_vacina_lote_s" placeholder="Lote da vacina recebida" value="<?= $rsServidor['covid_vacina_lote']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_data_s">Data de recebimento da última vacina<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" title="exemplo: 31/12/2000" id="covid_vacina_data_s" name="covid_vacina_data_s" placeholder="Data de recebimento da vacina" value="<?= data_volta($rsServidor['covid_vacina_data']); ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="covid_vacina_end_s">Endereço de recebimento da última vacina<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="covid_vacina_end_s" name="covid_vacina_end_s" placeholder="Lugar/Cidade/Estado" value="<?= $rsServidor['covid_vacina_endereco']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> SAÚDE</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="enf_portador_s">Enfermidade portada<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="enf_portador_s" name="enf_portador_s" placeholder="Enfermidade portada pelo servidor" value="<?= $rsServidor['enfermidade_portador']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="enf_cod_internacional_s">Cód. Inter. da emfermidade<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="enf_cod_internacional_s" name="enf_cod_internacional_s" placeholder="Código internacional da emfermidade do servidor" value="<?= $rsServidor['enfermidade_codigo_internacional']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>