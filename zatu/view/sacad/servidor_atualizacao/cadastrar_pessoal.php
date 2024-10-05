<?php
$displaySitTrab1                  = $rsServidorAtualizacao['rh_situacao_trabalho_id'] <= 1 ? 'style="display: none;"' : '';
$displaySitTrab2                  = $rsServidorAtualizacao['rh_situacao_trabalho_id_2'] <= 1 ? 'style="display: none;"' : '';
$displayNaturalidadeNacional      = $rsServidorAtualizacao['natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
$displayNaturalidadeExtranjeiro   = $rsServidorAtualizacao['natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
?>
<strong><div id="step-#index#" class="icones"><i class="fal fa-user"></i></div><span>PERFIL</span></strong>
<section class="pt-0 pr-0">
  <form id="form_servidor_pessoal" class="" name="form_servidor_pessoal" method="post" action="">
    <input type="hidden" id="seg_servidor_id" class="seg_servidor_id" name="seg_servidor_id" value="<?= $id; ?>">
    <input type="hidden" id="pessoal_servidor_id" class="servidor_id" name="servidor_id" value="<?= $rsServidor['id']; ?>">
    <input type="hidden" id="tipo_atualizacao" class="tipo_atualizacao" name="tipo_atualizacao" value="<?= $tipoAtualizacao; ?>">
    <input type="hidden" id="pessoal_servidor_atualizacao_id" class="servidor_atualizacao_id" name="id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="situacao_servidor_atualizacao_id" class="situacao_servidor_atualizacao_id" name="situacao_servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> PESSOAL</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_pessoal'] == 0 && $rsServidorAtualizacaoProva['situacao_pessoal'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_pessoal'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_pessoal'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_pessoal'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_pessoal'] ;?></span>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
      <div class="box-body">
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label>Matricula 1: <span class="text-warning"><?= $rsServidor['matricula']; ?></span></label>
              <?php 
              if ($rsServidor['matricula_2'] != '') { 
                ?>
                <br/>
                <label>Matricula 2: <span class="text-warning"><?= $rsServidor['matricula_2']; ?></span></label>
                <?php 
              } 
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>CPF: <span class="text-warning"><?= $rsServidor['cpf']; ?></span></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Data de nascimento: <span class="text-warning"><?= data_volta($rsServidor['dt_nascimento']); ?></span></label>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-8">
            <div class="form-group">
              <label for="nome_s">Nome<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidor['nome'];?>"><?= $rsServidor['nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="nome_s" name="nome_s" placeholder="Nome do servidor" value="<?= $rsServidorAtualizacao['nome']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="nome_social_s">Nome social: <span class="text-danger" value="<?= $rsServidor['nome_social'];?>"><?= $rsServidor['nome_social']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="nome_social_s" name="nome_social_s" placeholder="Nome social" value="<?= $rsServidorAtualizacao['nome_social']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="sexo_s">Sexo<span class="text-danger">*</span>: <span class="text-warning" grupo="radio" subgrupo="rg" value="<?= $rsServidor['sexo'];?>"><?= $rsServidor['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></span></label>
              <div class="form-group ichack-input mt-10">
                <label>
                  <input type="radio" id="sexo_u_F" name="sexo_s" class="square-purple" <?= $rsServidorAtualizacao['sexo'] != 'M' ? 'checked="checked"' : ''; ?> value="F"> Feminino
                </label>
                <label>
                  <input type="radio" id="sexo_u_M" name="sexo_s" class="square-purple" <?= $rsServidorAtualizacao['sexo'] == 'M' ? 'checked="checked"' : ''; ?> value="M"> Masculino
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="sangue_tipo_s">Tipo sanguíneo: <span class="text-danger" value="<?= $rsServidor['sangue_tipo'];?>"><?= $rsServidor['sangue_tipo']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="sangue_tipo_s" name="sangue_tipo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo sanguíneo do servidor">
                  <option></option>
                  <option value="O-" <?= $rsServidorAtualizacao['sangue_tipo'] == 'O-' ? 'selected="selected"' : '' ?>>O-</option>
                  <option value="O+" <?= $rsServidorAtualizacao['sangue_tipo'] == 'O+' ? 'selected="selected"' : '' ?>>O+</option>
                  <option value="A-" <?= $rsServidorAtualizacao['sangue_tipo'] == 'A-' ? 'selected="selected"' : '' ?>>A-</option>
                  <option value="A+" <?= $rsServidorAtualizacao['sangue_tipo'] == 'A+' ? 'selected="selected"' : '' ?>>A+</option>
                  <option value="B-" <?= $rsServidorAtualizacao['sangue_tipo'] == 'B-' ? 'selected="selected"' : '' ?>>B-</option>
                  <option value="B+" <?= $rsServidorAtualizacao['sangue_tipo'] == 'B+' ? 'selected="selected"' : '' ?>>B+</option>
                  <option value="AB-" <?= $rsServidorAtualizacao['sangue_tipo'] == 'AB-' ? 'selected="selected"' : '' ?>>AB-</option>
                  <option value="AB+" <?= $rsServidorAtualizacao['sangue_tipo'] == 'AB+' ? 'selected="selected"' : '' ?>>AB+</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="raca_s">Raça: <span class="text-danger" value="<?= $rsServidor['raca'];?>"><?= $rsServidor['raca']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="raca_s" name="raca_s" placeholder="Raça do servidor" value="<?= $rsServidorAtualizacao['raca']; ?>"/>
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
              <label for="pai_nome_s">Nome do pai: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidor['pai_nome'];?>"><?= $rsServidor['pai_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pai_nome_s" name="pai_nome_s" placeholder="Nome do pai do servidor" value="<?= $rsServidorAtualizacao['pai_nome']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pai_nacionalidade_s">Nacionalidade do pai: <span class="text-danger" value="<?= $rsServidor['pai_natural_bsc_pais_id'];?>"><?= $rsServidor['pai_nacionalidade_nome'] ;?></span></label>
              <div class="input-group mb-3 controls">
                <select id="pai_nacionalidade_s" name="pai_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do pai do servidor">
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['pai_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="pai_profissao_s">Profissão do pai: <span class="text-danger" value="<?= $rsServidor['pai_profissao'];?>"><?= $rsServidor['pai_profissao']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="pai_profissao_s" name="pai_profissao_s" placeholder="Profissão da mãe do servidor" value="<?= $rsServidorAtualizacao['pai_profissao']; ?>"/>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="row mt-10">
          <div class="col-md-8">
            <div class="form-group">
              <label for="mae_nome_s">Nome da mãe<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidor['mae_nome'];?>"><?= $rsServidor['mae_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="mae_nome_s" name="mae_nome_s" placeholder="Nome da mãe do servidor" value="<?= $rsServidorAtualizacao['mae_nome']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mae_nacionalidade_s">Nacionalidade da mãe<span class="text-danger">*</span>: <span class="text-danger" value="<?= $rsServidor['mae_natural_bsc_pais_id'];?>"><?= $rsServidor['mae_nacionalidade_nome'] ;?></span></label>
              <div class="input-group mb-3 controls">
                <select id="mae_nacionalidade_s" name="mae_nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade da mãe do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['mae_natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="mae_profissao_s">Profissão da mãe: <span class="text-danger" value="<?= $rsServidor['mae_profissao'];?>"><?= $rsServidor['mae_profissao']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="mae_profissao_s" name="mae_profissao_s" placeholder="Profissão da mãe do servidor" value="<?= $rsServidorAtualizacao['mae_profissao']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box-header">
        <h5 class="mb-0"><strong> NATURALIDADE</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nacionalidade_s">Nacionalidade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="rg" value="<?= $rsServidor['natural_bsc_pais_id'];?>"><?= $rsServidor['nacionalidade_nome'] ;?></span></label>
              <div class="input-group mb-3 controls">
                <select id="nacionalidade_s" name="nacionalidade_s" class="form-control select2" style="width: 100%;" placeholder="selecione a nacionalidade do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsPaises as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['natural_bsc_pais_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nacionalidade']; ?></option>
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
                <label for="naturalidade_s">Naturalidade<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="rg" value="<?= $rsServidor['natural_bsc_municipio_id'];?>"><?= $rsServidor['natural_municipio_nome'].(isset($rsServidor['natural_bsc_municipio_id']) ? ' - ' : '').$rsServidor['natural_estado_sigla']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <select id="naturalidade_s" name="naturalidade_s" class="form-control select2_naturalidade" style="width: 100%;" placeholder="selecione a naturalidade do servidor" <?= isset($rsServidorAtualizacao['natural_bsc_municipio_id']) ? '' : 'disabled="true"' ?> required>
                    <option></option>
                    <?php
                    if (isset($rsServidorAtualizacao['natural_bsc_municipio_id'])) {
                      ?>
                      <option value="<?= $rsServidorAtualizacao['natural_bsc_municipio_id']; ?>" selected="selected"><?= $rsServidorAtualizacao['natural_municipio_nome'].' - '.$rsServidorAtualizacao['natural_estado_sigla']; ?></option>
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
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_cidade_S">Naturalidade/Cidade<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidor['natural_estrangeiro_cidade'];?>"><?= $rsServidor['natural_estrangeiro_cidade']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_cidade_S" name="nat_est_cidade_S" placeholder="Cidade natural do servidor" value="<?= $rsServidorAtualizacao['natural_estrangeiro_cidade']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_estado_s">Naturalidade/Estado<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= $rsServidor['natural_estrangeiro_estado'];?>"><?= $rsServidor['natural_estrangeiro_estado']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_estado_s" name="nat_est_estado_s" placeholder="Estado natural do servidor" value="<?= $rsServidorAtualizacao['natural_estrangeiro_estado']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_dt_ingresso_s">Data de Ingresso no Brasil<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="rg" value="<?= data_volta($rsServidor['natural_estrangeiro_dt_ingresso']);?>"><?= data_volta($rsServidor['natural_estrangeiro_dt_ingresso']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="nat_est_dt_ingresso_s" name="nat_est_dt_ingresso_s" placeholder="Data de ingresso no Brasil" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacao['natural_estrangeiro_dt_ingresso']); ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nat_est_cond_trabalho_s">Condição de trabalho: <span class="text-danger" value="<?= $rsServidor['natural_estrangeiro_condicao_trabalho'];?>"><?= $rsServidor['natural_estrangeiro_condicao_trabalho']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="nat_est_cond_trabalho_s" name="nat_est_cond_trabalho_s" placeholder="Condição de trabalho do servidor" value="<?= $rsServidorAtualizacao['natural_estrangeiro_condicao_trabalho']; ?>"/>
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
        <label>Matricula 1: <span class="text-warning"><?= $rsServidor['matricula']; ?></span></label>
        <input type="hidden" id="matricula_s" name="matricula_s" value="<?= $rsServidor['matricula']; ?>">
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_situacao_trabalho'] == 0 && $rsServidorAtualizacaoProva['situacao_situacao_trabalho'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_situacao_trabalho'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_situacao_trabalho'] != '') {
            ?>
            <div class="row mt-10">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho'] ;?></span>
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
          <div class="col-md-8">
            <div class="form-group">
              <label for="empregador_s">Empregador<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador" value="<?= $rsServidor['eo_empregador_id'];?>"><?= $rsServidor['empregador_razao_social']. ($rsServidor['empregador_fantasia'] != '' ? (' - '.$rsServidor['empregador_fantasia']) : ''); ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="empregador_s" name="empregador_s" class="form-control select2" style="width: 100%;" placeholder="selecione o empregador do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEmpregadores as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_empregador_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome_razao_social']. ($vObj['nome_fantasia'] != '' ? (' - '.$vObj['nome_fantasia']) : ''); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="uo_s">Secretaria de origem<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador" value="<?= $rsServidor['bsc_unidade_organizacional_id'];?>"><?= $rsServidor['uo_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="uo_s" name="uo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o órgão de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsUOs as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['bsc_unidade_organizacional_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="setor_atual_s">Setor atual de lotação<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador" value="<?= $rsServidor['eo_setor_id'];?>"><?= $rsServidor['setor_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="setor_atual_s" name="setor_atual_s" class="form-control select2" style="width: 100%;" placeholder="selecione o setor de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsSetores as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_setor_unidade_organizacional_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
              <label for="servidor_tipo_s">Tipo de Contrato<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador" value="<?= $rsServidor['rh_servidor_tipo_id'];?>"><?= $rsServidor['serv_tipo_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="servidor_tipo_s" name="servidor_tipo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de contrato do Servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsServidorTipos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['rh_servidor_tipo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cargo_s">Cargo<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador" value="<?= $rsServidor['eo_cargo_id'];?>"><?= $rsServidor['cargo_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="cargo_s" name="cargo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o cargo do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsCargos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_cargo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="sit_trab_s">Situação atual de trabalho<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="sit_trabalho" value="<?= $rsServidor['rh_situacao_trabalho_id'];?>"><?= $rsServidor['sit_trab_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="sit_trab_s" name="sit_trab_s" class="form-control select2" style="width: 100%;" placeholder="selecione a situação atual de trabalho do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsSituacoesTrabalho as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['rh_situacao_trabalho_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
                <label for="sit_decreto_s">Número do decreto/portaria<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho" value="<?= $rsServidor['situacao_trabalho_decreto'];?>"><?= $rsServidor['situacao_trabalho_decreto']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="sit_decreto_s" name="sit_decreto_s" placeholder="Número do decreto/portaria sobre a situação atual do trabalho do servidor" value="<?= $rsServidorAtualizacao['situacao_trabalho_decreto']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_doe_s">Número do DOE (Diário Oficial do Estado)<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho" value="<?= $rsServidor['situacao_trabalho_doe'];?>"><?= $rsServidor['situacao_trabalho_doe']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="sit_doe_s" name="sit_doe_s" placeholder="Número do DOE sobre a situação atual do trabalho do servidor" value="<?= $rsServidorAtualizacao['situacao_trabalho_doe']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_inicio_s">Data início da situação atual<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho" value="<?= data_volta($rsServidor['situacao_trabalho_dt_inicio']);?>"><?= data_volta($rsServidor['situacao_trabalho_dt_inicio']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_inicio_s" name="sit_dt_inicio_s" placeholder="Data inicio da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio']); ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_fim_s">Data fim da situação atual<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho" value="<?= data_volta($rsServidor['situacao_trabalho_dt_fim']);?>"><?= data_volta($rsServidor['situacao_trabalho_dt_fim']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_fim_s" name="sit_dt_fim_s" placeholder="Data fim da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="sit_obs_s">Observação: <span class="text-warning" grupo="textarea" subgrupo="sit_trabalho" value="<?= $rsServidor['situacao_trabalho_obs'];?>"><?= $rsServidor['situacao_trabalho_obs']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" id="sit_obs_s" name="sit_obs_s" placeholder="Observação sobre a situação atual do trabalho do servidor"><?= $rsServidorAtualizacao['situacao_trabalho_obs']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary" <?= $rsServidor['matricula_2'] == '' ? 'style="display: none;"' : '' ;?>>
      <div class="box-header">
        <h5 class="mb-0"><strong> LOCAL DE TRABALHO 2</strong></h5>
        <label>Matricula 2: <span class="text-warning"><?= $rsServidor['matricula_2'] ;?></span></label>
        <input type="hidden" id="matricula_2_s" name="matricula_2_s" value="<?= $rsServidor['matricula_2']; ?>">
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] == 0 && $rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho_2'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_situacao_trabalho_2'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_situacao_trabalho_2'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_situacao_trabalho_2'] ;?></span>
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
          <div class="col-md-12">
            <div class="form-group">
              <label for="empregador_2_s">Empregador<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador_2" value="<?= $rsServidor['eo_empregador_id_2'];?>"><?= $rsServidor['empregador_razao_social_2']. ($rsServidor['empregador_fantasia_2'] != '' ? (' - '.$rsServidor['empregador_fantasia_2']) : ''); ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="empregador_2_s" name="empregador_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o empregador do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEmpregadores as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_empregador_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome_razao_social']. ($vObj['nome_fantasia'] != '' ? (' - '.$vObj['nome_fantasia']) : ''); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="uo_2_s">Secretaria atual de lotação<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador_2" value="<?= $rsServidor['bsc_unidade_organizacional_id_2'];?>"><?= $rsServidor['uo_nome_2']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="uo_2_s" name="uo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o órgão de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsUOs as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['bsc_unidade_organizacional_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="setor_atual_2_s">Setor atual de lotação<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador_2" value="<?= $rsServidor['eo_setor_id_2'];?>"><?= $rsServidor['setor_nome_2']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="setor_atual_2_s" name="setor_atual_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o setor de trabalho atual do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsSetores2 as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_setor_unidade_organizacional_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
              <label for="servidor_tipo_2_s">Tipo de Contrato<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador_2" value="<?= $rsServidor['rh_servidor_tipo_id_2'];?>"><?= $rsServidor['serv_tipo_nome_2']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="servidor_tipo_2_s" name="servidor_tipo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de contrato do Servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsServidorTipos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['rh_servidor_tipo_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cargo_2_s">Cargo<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="empregador_2" value="<?= $rsServidor['eo_cargo_id_2'];?>"><?= $rsServidor['cargo_nome_2']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="cargo_2_s" name="cargo_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione o cargo do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsCargos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['eo_cargo_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'] ;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="sit_trab_2_s">Situação atual de trabalho<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="sit_trabalho_2" value="<?= $rsServidor['rh_situacao_trabalho_id_2'];?>"><?= $rsServidor['sit_trab_nome_2']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="sit_trab_2_s" name="sit_trab_2_s" class="form-control select2" style="width: 100%;" placeholder="selecione a situação atual de trabalho do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsSituacoesTrabalho as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacao['rh_situacao_trabalho_id_2'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
                <label for="sit_decreto_2_s">Número do decreto/portaria<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho_2" value="<?= $rsServidor['situacao_trabalho_decreto_2'];?>"><?= $rsServidor['situacao_trabalho_decreto_2']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="sit_decreto_2_s" name="sit_decreto_2_s" placeholder="Número do decreto/portaria sobre a situação atual do trabalho do servidor" value="<?= $rsServidorAtualizacao['situacao_trabalho_decreto_2']; ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_doe_2_s">Número do DOE (Diário Oficial do Estado)<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho_2" value="<?= $rsServidor['situacao_trabalho_doe_2'];?>"><?= $rsServidor['situacao_trabalho_doe_2']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="1" id="sit_doe_2_s" name="sit_doe_2_s" placeholder="Número do DOE sobre a situação atual do trabalho do servidor" value="<?= $rsServidorAtualizacao['situacao_trabalho_doe_2']; ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_inicio_2_s">Data início da situação atual<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho_2" value="<?= data_volta($rsServidor['situacao_trabalho_dt_inicio_2']);?>"><?= data_volta($rsServidor['situacao_trabalho_dt_inicio_2']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_inicio_2_s" name="sit_dt_inicio_2_s" placeholder="Data inicio da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_inicio_2']); ?>" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="sit_dt_fim_2_s">Data fim da situação atual<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="sit_trabalho_2" value="<?= data_volta($rsServidor['situacao_trabalho_dt_fim_2']);?>"><?= data_volta($rsServidor['situacao_trabalho_dt_fim_2']); ?></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="sit_dt_fim_2_s" name="sit_dt_fim_2_s" placeholder="Data fim da situação atual de trabalho do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($rsServidorAtualizacao['situacao_trabalho_dt_fim_2']); ?>" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="sit_obs_2_s">Observação: <span class="text-warning" grupo="textarea" subgrupo="sit_trabalho_2" value="<?= $rsServidor['situacao_trabalho_obs_2'];?>"><?= $rsServidor['situacao_trabalho_obs_2']; ?></span></label>
                <div class="input-group mb-3 controls">
                  <textarea class="form-control" id="sit_obs_2_s" name="sit_obs_2_s" placeholder="Observação sobre a situação atual do trabalho do servidor"><?= $rsServidorAtualizacao['situacao_trabalho_obs_2']; ?></textarea>
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
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_covid_vacina'] == 0 && $rsServidorAtualizacaoProva['situacao_covid_vacina'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_covid_vacina'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_covid_vacina'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_covid_vacina'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_covid_vacina'] ;?></span>
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
              <label for="covid_vacina_nome_s">Nome da última vacina recebida<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="covid_vacina" value="<?= $rsServidor['covid_vacina_nome'];?>"><?= $rsServidor['covid_vacina_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="covid_vacina_nome_s" name="covid_vacina_nome_s" placeholder="Nome da vacina recebida" value="<?= $rsServidorAtualizacao['covid_vacina_nome']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_dose_s">Dose da última vacina recebida<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="covid_vacina" value="<?= $rsServidor['covid_vacina_dose'];?>"><?= $rsServidor['covid_vacina_dose']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="covid_vacina_dose_s" name="covid_vacina_dose_s" placeholder="Dose recebida da vacina (ex.: dose 3)" value="<?= $rsServidorAtualizacao['covid_vacina_dose']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_lote_s">Lote da última vacina recebida<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="covid_vacina" value="<?= $rsServidor['covid_vacina_lote'];?>"><?= $rsServidor['covid_vacina_lote']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="covid_vacina_lote_s" name="covid_vacina_lote_s" placeholder="Lote da vacina recebida" value="<?= $rsServidorAtualizacao['covid_vacina_lote']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="covid_vacina_data_s">Data da última vacina recebida<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="covid_vacina" value="<?= data_volta($rsServidor['covid_vacina_data']);?>"><?= data_volta($rsServidor['covid_vacina_data']); ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control date_format" minlength="10" title="exemplo: 31/12/2000" id="covid_vacina_data_s" name="covid_vacina_data_s" placeholder="Data de recebimento da vacina" value="<?= data_volta($rsServidorAtualizacao['covid_vacina_data']); ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="covid_vacina_end_s">Endereço de recebimento da última vacina<span class="text-danger">*</span>: <span class="text-warning" grupo="textarea" subgrupo="covid_vacina" value="<?= $rsServidor['covid_vacina_endereco'];?>"><?= $rsServidor['covid_vacina_endereco']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="covid_vacina_end_s" name="covid_vacina_end_s" placeholder="Lugar/Cidade/Estado" value="<?= $rsServidorAtualizacao['covid_vacina_endereco']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> SAÚDE</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_enfermidade'] == 0 && $rsServidorAtualizacaoProva['situacao_enfermidade'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_enfermidade'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_enfermidade'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_enfermidade'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_enfermidade'] ;?></span>
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
          <div class="col-md-8">
            <div class="form-group">
              <label for="enf_portador_s">Enfermidade portada: <span class="text-warning" grupo="input_text" subgrupo="saude" value="<?= $rsServidor['enfermidade_portador']; ?>"><?= $rsServidor['enfermidade_portador']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="enf_portador_s" name="enf_portador_s" placeholder="Enfermedade portada pelo servidor" value="<?= $rsServidorAtualizacao['enfermidade_portador']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="enf_cod_internacional_s">Cód. Inter. da emfermidade: <span class="text-danger"><?= $rsServidor['enfermidade_codigo_internacional']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="enf_cod_internacional_s" name="enf_cod_internacional_s" placeholder="Código internacional da emfermidade do servidor" value="<?= $rsServidorAtualizacao['enfermidade_codigo_internacional']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>