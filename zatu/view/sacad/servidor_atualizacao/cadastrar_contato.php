<strong><div id="step-#index#" class="icones"><i class="mdi mdi-contact-mail"></i></div><span>CONTATO</span></strong>
<section class="pt-0 pr-0">
  <form id="form_servidor_contato" class="" name="form_servidor_contato" method="post" action="">
    <input type="hidden" id="contato_servidor_atualizacao_id" class="servidor_atualizacao_id" name="id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="servidor_atualizacao_contato_id_s" name="servidor_atualizacao_contato_id_s" value="<?= $rsServidorAtualizacaoContato['id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> ENDEREÇO</strong></h5>
        <?php 
        if ($rsServidorAtualizacaoProva['situacao_end'] == 0 && $rsServidorAtualizacaoProva['situacao_end'] != NULL) {
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
                <span><?= $rsServidorAtualizacaoProva['obs_end'] ;?></span>
              </div>
            </div>
          </div>
          <?php
        }
        if ($rsServidorAtualizacaoProva['situacao_end'] == 1) {
          ?>
          <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
          <?php
          if ($rsServidorAtualizacaoProva['obs_end'] != '') {
            ?>
            <div class="row mt-2">
              <div class="col-md-2">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span>OBSERVAÇÃO: </span>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group alert alert-success mb-0 pl-5">
                  <span><?= $rsServidorAtualizacaoProva['obs_end'] ;?></span>
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
          <div class="col-md-10">
            <div class="form-group">
              <label for="end_log_s">Logradouro<span class="text-danger">*</span>: <span class="text-danger"grupo="input_text" subgrupo="end" value="<?= $rsServidorContato['end_logradouro'];?>"><?= $rsServidorContato['end_logradouro']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="end_log_s" name="end_log_s" placeholder="Logradouro do endereço do servidor" value="<?= $rsServidorAtualizacaoContato['end_logradouro']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="end_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="end" value="<?= $rsServidorContato['end_numero'];?>"><?= $rsServidorContato['end_numero']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="end_num_s" name="end_num_s" placeholder="Número do endereço do servidor" value="<?= $rsServidorAtualizacaoContato['end_numero']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_comp_s">Complemento: <span class="text-danger"><?= $rsServidorContato['end_complemento']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="end_comp_s" name="end_comp_s" placeholder="Complemento do endereço do servidor" value="<?= $rsServidorAtualizacaoContato['end_complemento']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_bairro_s">Bairro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="end" value="<?= $rsServidorContato['end_bairro'];?>"><?= $rsServidorContato['end_bairro']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="2" id="end_bairro_s" name="end_bairro_s" placeholder="Bairro do endereço do servidor" value="<?= $rsServidorAtualizacaoContato['end_bairro']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_cep_s">CEP<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="end" value="<?= $rsServidorContato['end_cep'];?>"><?= $rsServidorContato['end_cep']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cep_format" minlength="10" id="end_cep_s" name="end_cep_s" placeholder="CEP do endereço do servidor" title="exemplo: 69.900-000" value="<?= $rsServidorAtualizacaoContato['end_cep']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_estado_s">Estado<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorContato['end_estado_nome'].($rsServidorContato['end_bsc_municipio_id'] != 0 ? ' - ' : '').$rsServidorContato['end_estado_sigla']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="end_estado_s" name="end_estado_s" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do servidor" required>
                  <option value=""></option>
                  <?php
                  foreach ($rsEstados as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacaoContato['end_estado_id'] ? 'selected="selected"' : ''; ?>><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_municipio_s">Município<span class="text-danger">*</span>: <span class="text-warning" grupo="select" subgrupo="end" value="<?= $rsServidorContato['end_bsc_municipio_id'];?>"><?= $rsServidorContato['end_municipio_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="end_municipio_s" name="end_municipio_s" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do servidor" required>
                  <?php
                  if ($rsServidorAtualizacaoContato['end_bsc_municipio_id'] != 0) {
                    foreach ($rsMunicipios as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacaoContato['end_bsc_municipio_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                      <?php
                    }
                  } else {
                    ?>
                    <option value="">Selecione primeiro o Estado do servidor</option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header">
        <h5 class="mb-0"><strong> CONTATO ELETRÔNICO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_inst_s">E-mail institucional: <span class="text-danger"><?= $rsServidorContato['email_institucional']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="email_inst_s" name="email_inst_s" placeholder="E-mail institucional do servidor" value="<?= $rsServidorAtualizacaoContato['email_institucional']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_pessoal_s">E-mail pessoal: <span class="text-danger"><?= $rsServidorContato['email_pessoal']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control email_format" minlength="5" id="email_pessoal_s" name="email_pessoal_s" placeholder="E-mail pessoal do servidor" value="<?= $rsServidorAtualizacaoContato['email_pessoal']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_alternativo_s">E-mail alternativo: <span class="text-danger"><?= $rsServidorContato['email_alternativo']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control email_format" minlength="5" id="email_alternativo_s" name="email_alternativo_s" placeholder="E-mail alternativo do servidor" value="<?= $rsServidorAtualizacaoContato['email_alternativo']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header">
        <h5 class="mb-0"><strong> NÚMEROS DE CONTATO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="tel_res_s">Telefone residencial: <span class="text-danger"><?= $rsServidorContato['tel_residencial']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control tel_format" minlength="13" id="tel_res_s" name="tel_res_s" placeholder="Telefone residencial do servidor" title="exemplo: (68)3222-2222" value="<?= $rsServidorAtualizacaoContato['tel_residencial']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="tel_cel_s">Telefone celular<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorContato['tel_celular']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="tel_cel_s" name="tel_cel_s" placeholder="Telefone celular do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorAtualizacaoContato['tel_celular']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header">
        <h5 class="mb-0"><strong> CONTATO PARA RECADO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="tel_recado_s">Telefone para recado: <span class="text-danger"><?= $rsServidorContato['tel_recado']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="tel_recado_s" name="tel_recado_s" placeholder="Telefone de recado do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorAtualizacaoContato['tel_recado']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="tel_recado_nome_s">Nome do contato de recado para o servidor: <span class="text-danger"><?= $rsServidorContato['tel_recado_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="tel_recado_nome_s" name="tel_recado_nome_s" placeholder="Nome do contato de recado para o servidor" value="<?= $rsServidorAtualizacaoContato['tel_recado_nome']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tel_recado_parent_grau_s">Grau de parentesco: <span class="text-danger"><?= $rsServidorContato['tel_recado_parentesco_grau_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <select id="tel_recado_parent_grau_s" name="tel_recado_parent_grau_s" class="form-control select2" style="width: 100%;" placeholder="selecione o grau de parentesco do contato de recado">
                  <option value=""></option>
                  <?php
                  foreach ($rsParentescosGraus as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorAtualizacaoContato['tel_recado_bsc_parentesco_grau_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'].' ('.$vObj['grau'].')'; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header">
        <h5 class="mb-0"><strong> CONTATO PARA EMERGÊNCIA</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="cont_emerg_tel__s">Contato Emergencial: <span class="text-danger"><?= $rsServidorContato['contato_emergencia_tel']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="cont_emerg_tel__s" name="cont_emerg_tel__s" placeholder="Telefone do contato de emergência do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorAtualizacaoContato['contato_emergencia_tel']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label for="cont_emerg_nome_s">Nome do contato de emergência do servidor: <span class="text-danger"><?= $rsServidorContato['contato_emergencia_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="cont_emerg_nome_s" name="cont_emerg_nome_s" placeholder="Nome do contato de emergência do servidor" value="<?= $rsServidorAtualizacaoContato['contato_emergencia_nome']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="cont_emerg_end_s">Endereço completo: <span class="text-danger"></span><?= $rsServidorContato['contato_emergencia_end']; ?></label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="cont_emerg_end_s" name="cont_emerg_end_s" placeholder="Endereço completo do contato de emergencia do servidor" value="<?= $rsServidorAtualizacaoContato['contato_emergencia_end']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>