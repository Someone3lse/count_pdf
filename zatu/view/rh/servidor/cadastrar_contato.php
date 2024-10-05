<strong><div id="step-#index#" class="icones"><i class="mdi mdi-contact-mail"></i></div><span>CONTATO</span></strong>
<section class="pt-0 pr-0">
  <form id="form_servidor_contato" class="" name="form_servidor_contato" method="post" action="">
    <input type="hidden" id="contato_servidor_id" class="servidor_id" name="id" value="<?= $id; ?>">
    <input type="hidden" id="servidor_contato_id_s" name="servidor_contato_id_s" value="<?= $rsServidorContato['id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> NÚMEROS DE CONTATO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="tel_res_s">Telefone residencial<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control tel_format" minlength="13" id="tel_res_s" name="tel_res_s" placeholder="Telefone residencial do servidor" title="exemplo: (68)3222-2222" value="<?= $rsServidorContato['tel_residencial']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="tel_cel_s">Telefone celular<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="tel_cel_s" name="tel_cel_s" placeholder="Telefone celular do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorContato['tel_celular']; ?>" required/>
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
              <label for="tel_recado_s">Telefone para recado<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="tel_recado_s" name="tel_recado_s" placeholder="Telefone de recado do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorContato['tel_recado']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="tel_recado_nome_s">Nome do contato de recado para o servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="tel_recado_nome_s" name="tel_recado_nome_s" placeholder="Nome do contato de recado para o servidor" value="<?= $rsServidorContato['tel_recado_nome']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tel_recado_parent_grau_s">Grau de parentesco<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="tel_recado_parent_grau_s" name="tel_recado_parent_grau_s" class="form-control select2" style="width: 100%;" placeholder="selecione o grau de parentesco do contato de recado">
                  <option></option>
                  <?php
                  foreach ($rsParentescosGraus as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContato['tel_recado_bsc_parentesco_grau_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome'].' ('.$vObj['grau'].')'; ?></option>
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
        <h5 class="mb-0"><strong> CONTATO PARA RECADO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="cont_emerg_tel__s">Contato Emergencial<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cel_format" minlength="13" id="cont_emerg_tel__s" name="cont_emerg_tel__s" placeholder="Telefone do contato de emergência do servidor" title="exemplo: (68)9.9999-9999" value="<?= $rsServidorContato['contato_emergencia_tel']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label for="cont_emerg_nome_s">Nome do contato de emergência do servidor<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="cont_emerg_nome_s" name="cont_emerg_nome_s" placeholder="Nome do contato de emergência do servidor" value="<?= $rsServidorContato['contato_emergencia_nome']; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="cont_emerg_end_s">Endereço completo<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="cont_emerg_end_s" name="cont_emerg_end_s" placeholder="Endereço completo do contato de emergencia do servidor" value="<?= $rsServidorContato['contato_emergencia_end']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> CONTATO ELETRÔNICO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_inst_s">E-mail institucional<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="email_inst_s" name="email_inst_s" placeholder="E-mail institucional do servidor" value="<?= $rsServidorContato['email_institucional']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_pessoal_s">E-mail pessoal<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="email_pessoal_s" name="email_pessoal_s" placeholder="E-mail pessoal do servidor" value="<?= $rsServidorContato['email_pessoal']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email_alternativo_s">E-mail alternativo<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="email_alternativo_s" name="email_alternativo_s" placeholder="E-mail alternativo do servidor" value="<?= $rsServidorContato['email_alternativo']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-outline-primary">
      <div class="box-header">
        <h5 class="mb-0"><strong> ENDEREÇO</strong></h5>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label for="end_log_s">Logradouro<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="5" id="end_log_s" name="end_log_s" placeholder="Logradouro do endereço do servidor" value="<?= $rsServidorContato['end_logradouro']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="end_num_s">Número<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="1" id="end_num_s" name="end_num_s" placeholder="Número do endereço do servidor" value="<?= $rsServidorContato['end_numero']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_comp_s">Complemento<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" id="end_comp_s" name="end_comp_s" placeholder="Complemento do endereço do servidor" value="<?= $rsServidorContato['end_complemento']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_bairro_s">Bairro<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="2" id="end_bairro_s" name="end_bairro_s" placeholder="Bairro do endereço do servidor" value="<?= $rsServidorContato['end_bairro']; ?>" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_cep_s">CEP<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control cep_format" id="end_cep_s" name="end_cep_s" placeholder="CEP do endereço do servidor" title="exemplo: 69.900-000" value="<?= $rsServidorContato['end_cep']; ?>" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_estado_s">Estado<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="end_estado_s" name="end_estado_s" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do servidor" required>
                  <option></option>
                  <?php
                  foreach ($rsEstados as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContato['end_estado_id'] ? 'selected="selected"' : ''; ?>><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="end_municipio_s">Município<span class="text-danger">*</span>: </label>
              <div class="input-group mb-3 controls">
                <select id="end_municipio_s" name="end_municipio_s" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do servidor" required>
                  <?php
                  if ($id != 0) {
                    foreach ($rsMunicipios as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorContato['end_bsc_municipio_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
    </div>
  </form>
</section>