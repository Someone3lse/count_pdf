<strong><div id="step-#index#" class="icones"><i class="mdi mdi-human-child"></i></div><span>DEPENDENTE</span></strong>
<section class="pt-0">
  <form id="form_servidor_dependente" class="" name="form_servidor_dependente" method="post" action="">
    <input type="hidden" id="dependente_servidor_atualizacao_id" name="id" class="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <?php
    $countDependentes = 0;
    if (sizeof($rsServidorAtualizacaoDependentes) > 0) {
      foreach ($rsServidorAtualizacaoDependentes as $kObjDependente => $vObjDependente) {
        $countDependentes ++;
        ?>
        <div id="box_dependente" class="box_dependente box box-outline-primary">
          <input type="hidden" id="dependente_id_s_<?= $countDependentes ;?>" name="dependente_id_s[]" value="<?= $vObjDependente['id'] ;?>">
          <input type="hidden" id="dependente_id_old_s_<?= $countDependentes ;?>" name="dependente_id_old_s[]" value="<?= $vObjDependente['sacad_servidor_dependente_id_old'] ;?>">
          <div class="box-header">
            <h5 class="mb-0"><strong>DEPENDENTE - <span><?= $countDependentes; ?></span></strong></h5>
            <?php 
            if ($vObjDependente['id'] > 0 && $vObjDependente['situacao_dependente'] == 0 && $vObjDependente['situacao_dependente'] != NULL) {
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
                    <span><?= $vObjDependente['obs_dependente'] ;?></span>
                  </div>
                </div>
              </div>
              <?php
            }
            if ($vObjDependente['situacao_dependente'] == 1) {
              ?>
              <div class="alert alert-success mt-10 mb-0 pl-5">Informações aceitas pelo setor de RH</div>
              <?php
              if ($vObjDependente['obs_dependente'] != '') {
                ?>
                <div class="row mt-2">
                  <div class="col-md-2">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span>OBSERVAÇÃO: </span>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group alert alert-success mb-0 pl-5">
                      <span><?= $vObjDependente['obs_dependente'] ;?></span>
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
                  <label for="dependente_codigo_s">Código: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['codigo']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="1" id="dependente_codigo_s_<?= $countDependentes ;?>" name="dependente_codigo_s[]" placeholder="Código do dependente do servidor" value="<?= $vObjDependente['codigo']; ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="dependente_nome_s">Nome<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['nome']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['nome']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="dependente_nome_s_<?= $countDependentes ;?>" name="dependente_nome_s[]" placeholder="Nome do dependente do servidor" value="<?= $vObjDependente['nome']; ?>" allempty/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_cpf_s">CPF<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['cpf']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['cpf']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control cpf_format" minlength="14" id="dependente_cpf_s_<?= $countDependentes ;?>" name="dependente_cpf_s[]" placeholder="CPF do dependente do servidor" title="exemplo: 999.999.999-99" value="<?= $vObjDependente['cpf']; ?>" allempty/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_parent_grau_s">Grau de parentesco<span class="text-danger" validator>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_nome']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <select id="dependente_parent_grau_s_<?= $countDependentes ;?>" name="dependente_parent_grau_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o grau de parentesco dependente do servidor" allempty>
                      <option></option>
                      <?php
                      foreach ($rsParentescosGraus as $kObj => $vObj) {
                        ?>
                        <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['bsc_parentesco_grau_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_parent_grau_outro_s">Outro grau de parentesco: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_outro']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['parentesco_grau_outro']; ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control" minlength="3" id="dependente_parent_grau_outro_s_<?= $countDependentes ;?>" name="dependente_parent_grau_outro_s[]" placeholder="Outro grau de parentesco do dependente do servidor" value="<?= $vObjDependente['parentesco_grau_outro']; ?>"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-10">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_dt_nasc_s">Data de nascimento<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_nascimento']); ?>"><?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_nascimento']); ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dependente_dt_nasc_s_<?= $countDependentes ;?>" name="dependente_dt_nasc_s[]" placeholder="Data de nascimento do dependente do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vObjDependente['dt_nascimento']); ?>" allempty/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_dt_casamento_s">Data de casamento: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_casamento']); ?>"><?= data_volta($rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['dt_casamento']); ?></span></label>
                  <div class="input-group mb-3 controls">
                    <input type="text" class="form-control date_format" minlength="10" id="dependente_dt_casamento_s_<?= $countDependentes ;?>" name="dependente_dt_casamento_s[]" placeholder="Data de casamento com o dependente do servidor" title="exemplo: 31/12/2000" value="<?= data_volta($vObjDependente['dt_casamento']); ?>"/>
                  </div>
                </div>
              </div>
            </div>
            <div id="div_benef">
              <div class="row mt-10">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_s">Beneficiário de pensão? <span class="text-danger" validator></label>
                    <div class="form-group ichack-input mt-10">
                      <label onclick="benefClick(this);">
                        <input type="radio" id="dependente_benef_s_N_<?= $countDependentes ;?>" name="dependente_benef_s_<?= $countDependentes ;?>" class="dependente_benef_s radio_benef_n square-purple" value="N" <?= $vObjDependente['benef_rg_numero'] == '' && $vObjDependente['id'] != 0 ? 'checked="checked"' : '' ;?> allempty> Não
                      </label>
                      <label onclick="benefClick(this);">
                        <input type="radio" id="dependente_benef_s_S_<?= $countDependentes ;?>" name="dependente_benef_s_<?= $countDependentes ;?>" class="dependente_benef_s radio_benef_s square-purple" value="S" <?= $vObjDependente['benef_rg_numero'] != '' ? 'checked="checked"' : '' ;?>> Sim
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div id="div_benef_dados" <?= $vObjDependente['benef_rg_numero'] == '' ? 'style="display: none;"' : '' ;?>>
                <div class="row mt-2">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="dependente_benef_autos_s">Número dos autos<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_autos_numero']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_autos_numero']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="3" id="dependente_benef_autos_s_<?= $countDependentes ;?>" name="dependente_benef_autos_s[]" placeholder="Núnmero dos autos" value="<?= $vObjDependente['benef_autos_numero']; ?>" required/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_rg_numero_s">RG - Número<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_numero']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_numero']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="3"  maxlength="15" id="dependente_benef_rg_numero_s_<?= $countDependentes ;?>" name="dependente_benef_rg_numero_s[]" placeholder="Número do RG do dependente" value="<?= $vObjDependente['benef_rg_numero']; ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_rg_dt_emissao_s">RG - Data de emissao<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_dt_emissao']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_dt_emissao']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control date_format" minlength="10" id="dependente_benef_rg_dt_emissao_s_<?= $countDependentes ;?>" name="dependente_benef_rg_dt_emissao_s[]" placeholder="Data de emissao do RG do dependente" title="exemplo: 31/12/2000" value="<?= data_volta($vObjDependente['benef_rg_dt_emissao']); ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger"></span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_orgao_expedidor']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_rg_orgao_expedidor']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="3" id="dependente_benef_rg_orgao_expedidor_s_<?= $countDependentes ;?>" name="dependente_benef_rg_orgao_expedidor_s[]" placeholder="Órgão expedidor do RG do dependente" value="<?= $vObjDependente['benef_rg_orgao_expedidor']; ?>"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_tel_res_s">Telefone residencial: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_residencial']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_residencial']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control tel_format" minlength="13" id="dependente_benef_tel_res_s_<?= $countDependentes ;?>" name="dependente_benef_tel_res_s[]" placeholder="Telefone residencial do dependente" title="exemplo: (68)3222-2222" value="<?= $vObjDependente['benef_tel_residencial']; ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_tel_cel_s">Telefone celular<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_celular']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_tel_celular']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control cel_format" minlength="13" id="dependente_benef_tel_cel_s_<?= $countDependentes ;?>" name="dependente_benef_tel_cel_s[]" placeholder="Telefone celular do dependente" title="exemplo: (68)9.9999-9999" value="<?= $vObjDependente['benef_tel_celular']; ?>" required/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="dependente_benef_end_log_s">Logradouro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_logradouro']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_logradouro']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="5" id="dependente_benef_end_log_s_<?= $countDependentes ;?>" name="dependente_benef_end_log_s[]" placeholder="Logradouro do endereço do dependente" value="<?= $vObjDependente['benef_end_logradouro']; ?>" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="dependente_benef_end_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_numero']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_numero']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="1" id="dependente_benef_end_num_s_<?= $countDependentes ;?>" name="dependente_benef_end_num_s[]" placeholder="Número do endereço do dependente" value="<?= $vObjDependente['benef_end_numero']; ?>" required/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="dependente_benef_end_comp_s">Complemento: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_complemento']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_complemento']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="1" id="dependente_benef_end_comp_s_<?= $countDependentes ;?>" name="dependente_benef_end_comp_s[]" placeholder="Complemento do endereço do dependente" value="<?= $vObjDependente['benef_end_complemento']; ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="dependente_benef_end_bairro_s">Bairro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_bairro']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_bairro']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="2" id="dependente_benef_end_bairro_s_<?= $countDependentes ;?>" name="dependente_benef_end_bairro_s[]" placeholder="Bairro do endereço do dependente" value="<?= $vObjDependente['benef_end_bairro']; ?>" required/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_end_cep_s">CEP<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_cep']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_end_cep']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control cep_format" minlenght="10" maxlength="10" id="dependente_benef_end_cep_s_<?= $countDependentes ;?>" name="dependente_benef_end_cep_s[]" placeholder="CEP do endereço do dependente" title="exemplo: 69.900-000" value="<?= $vObjDependente['benef_end_cep']; ?>" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_end_estado_s">Estado<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_estado_nome']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <select id="dependente_benef_end_estado_s_<?= $countDependentes ;?>" name="dependente_benef_end_estado_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do dependente" onchange="benefCarregaMun(this);" required>
                          <option value=""></option>
                          <?php
                          foreach ($rsEstados as $kObj => $vObj) {
                            ?>
                            <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_estado_id'] ? 'selected="selected"' : ''; ?>><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_end_municipio_s">Município<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_municipio_nome']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <select id="dependente_benef_end_municipio_s_<?= $countDependentes ;?>" name="dependente_benef_end_municipio_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do dependente" required>
                          <?php
                          if ($vObjDependente['benef_bsc_municipio_id'] != 0) {
                            foreach ($vObjDependente['benefMunicipios'] as $kObj => $vObj) {
                              ?>
                              <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_bsc_municipio_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                              <?php
                            }
                          } else {
                            ?>
                            <option value="">Selecione primeiro o Estado do beneficiário</option>
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
                      <label for="dependente_benef_banco_conta_tipo_s">Tipo de conta bancaria<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_conta_tipo_nome']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <select id="dependente_benef_banco_conta_tipo_s_<?= $countDependentes ;?>" name="dependente_benef_banco_conta_tipo_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Tipo de Conta" required>
                          <option value=""></option>
                          <?php
                          foreach ($rsBancoContaTipos as $kObj => $vObj) {
                            ?>
                            <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_bsc_banco_conta_tipo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="dependente_benef_banco_s">Banco<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_banco_nome']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <select id="dependente_benef_banco_s_<?= $countDependentes ;?>" name="dependente_benef_banco_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Banco" required>
                          <option value=""></option>
                          <?php
                          foreach ($rsBancos as $kObj => $vObj) {
                            ?>
                            <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_bsc_banco_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
                      <label for="dependente_benef_bancario_agencia_s">Agência<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_agencia']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_agencia']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="4" id="dependente_benef_bancario_agencia_s_<?= $countDependentes ;?>" name="dependente_benef_bancario_agencia_s[]" maxlength="6" placeholder="Agência bancaria do dependente" value="<?= $vObjDependente['benef_bancario_agencia']; ?>" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_bancario_conta_s">Conta<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_conta']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_conta']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="3" id="dependente_benef_bancario_conta_s_<?= $countDependentes ;?>" name="dependente_benef_bancario_conta_s[]" maxlength="15" placeholder="Conta bancária do dependente" value="<?= $vObjDependente['benef_bancario_conta']; ?>" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_bancario_op_s">Operação/Variação: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_op']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_bancario_op']; ?></span></label>
                      <div class="input-group mb-3 controls">
                        <input type="text" class="form-control" minlength="1" id="dependente_benef_bancario_op_s_<?= $countDependentes ;?>" name="dependente_benef_bancario_op_s[]" maxlength="3" placeholder="Operação/Variação bancária do dependente" value="<?= $vObjDependente['benef_bancario_op']; ?>"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="div_repres">
                  <div class="row mt-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_s">Representante legal<span class="text-danger">*</span>? <span class="text-warning" grupo="radio" subgrupo="dependente" value=""></span></label>
                        <div class="form-group ichack-input mt-10">
                          <label onclick="represClick(this);">
                            <input type="radio" id="dependente_benef_repres_s_N_<?= $countDependentes ;?>" name="dependente_benef_repres_s_<?= $countDependentes ;?>" class="dependente_benef_repres_s radio_repres_n square-purple" value="N" <?= $vObjDependente['benef_repres_nome'] == '' && $vObjDependente['id'] != 0 ? 'checked="checked"' : '' ;?> required> Não
                          </label>
                          <label onclick="represClick(this);">
                            <input type="radio" id="dependente_benef_repres_s_S_<?= $countDependentes ;?>" name="dependente_benef_repres_s_<?= $countDependentes ;?>" class="dependente_benef_repres_s radio_repres_s square-purple" value="S" <?= $vObjDependente['benef_repres_nome'] != '' ? 'checked="checked"' : '' ;?>> Sim
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="div_repres_dados" <?= $vObjDependente['benef_repres_nome'] == '' ? 'style="display: none;"' : '' ;?>>
                    <div class="row mt-10">
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="dependente_benef_repres_nome_s">Nome<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_nome']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_nome']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="3" id="dependente_benef_repres_nome_s_<?= $countDependentes ;?>" name="dependente_benef_repres_nome_s[]" placeholder="Nome do representante do beneficio" value="<?= $vObjDependente['benef_repres_nome']; ?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="dependente_benef_repres_cpf_s">CPF<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_cpf']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_cpf']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control cpf_format" minlength="" id="dependente_benef_repres_cpf_s_<?= $countDependentes ;?>" name="dependente_benef_repres_cpf_s[]" placeholder="CPF do representante legal" value="<?= $vObjDependente['benef_repres_cpf']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_rg_numero_s">RG - Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_numero']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_numero']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="3" id="dependente_benef_repres_rg_numero_s_<?= $countDependentes ;?>" name="dependente_benef_repres_rg_numero_s[]" placeholder="Número do RG do representante" value="<?= $vObjDependente['benef_repres_rg_numero']; ?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_rg_dt_emissao_s">RG - Data de emissao<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_dt_emissao']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_dt_emissao']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control date_format" minlength="10" id="dependente_benef_repres_rg_dt_emissao_s_<?= $countDependentes ;?>" name="dependente_benef_repres_rg_dt_emissao_s[]" placeholder="Data de emissao do RG do representante" title="exemplo: 31/12/2000" value="<?= data_volta($vObjDependente['benef_repres_rg_dt_emissao']); ?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_orgao_expedidor']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_rg_orgao_expedidor']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="3" id="dependente_benef_repres_rg_orgao_expedidor_s_<?= $countDependentes ;?>" name="dependente_benef_repres_rg_orgao_expedidor_s[]" placeholder="Órgão expedidor do RG do representante" value="<?= $vObjDependente['benef_repres_rg_orgao_expedidor']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_tel_res_s">Telefone residencial: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_residencial']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_residencial']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control tel_format" minlength="13" id="dependente_benef_repres_tel_res_s_<?= $countDependentes ;?>" name="dependente_benef_repres_tel_res_s[]" placeholder="Telefone residencial do representante" title="exemplo: (68)3222-2222" value="<?= $vObjDependente['benef_repres_tel_residencial']; ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_tel_cel_s">Telefone celular<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_celular']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_tel_celular']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control cel_format" minlength="13" id="dependente_benef_repres_tel_cel_s_<?= $countDependentes ;?>" name="dependente_benef_repres_tel_cel_s[]" placeholder="Telefone celular do representante" title="exemplo: (68)9.9999-9999" value="<?= $vObjDependente['benef_repres_tel_celular']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_log_s">Logradouro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_logradouro']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_logradouro']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="5" id="dependente_benef_repres_end_log_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_log_s[]" placeholder="Logradouro do endereço do representante" value="<?= $vObjDependente['benef_repres_end_logradouro']; ?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_numero']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_numero']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="1" id="dependente_benef_repres_end_num_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_num_s[]" placeholder="Número do endereço do representante" value="<?= $vObjDependente['benef_repres_end_numero']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_comp_s">Complemento: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_complemento']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_complemento']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" id="dependente_benef_repres_end_comp_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_comp_s[]" placeholder="Complemento do endereço do representante" value="<?= $vObjDependente['benef_repres_end_complemento']; ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_bairro_s">Bairro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_bairro']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_bairro']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control" minlength="2" id="dependente_benef_repres_end_bairro_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_bairro_s[]" placeholder="Bairro do endereço do representante" value="<?= $vObjDependente['benef_repres_end_bairro']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-10">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_cep_s">CEP<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value="<?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_cep']; ?>"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_end_cep']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <input type="text" class="form-control cep_format" id="dependente_benef_repres_end_cep_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_cep_s[]" placeholder="CEP do endereço do representante" title="exemplo: 69.900-000" value="<?= $vObjDependente['benef_repres_end_cep']; ?>" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_estado_s">Estado<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_estado_nome']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <select id="dependente_benef_repres_end_estado_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_estado_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do representante" onchange="benefRepresCarregaMun(this);" required>
                              <option value=""></option>
                              <?php
                              foreach ($rsEstados as $kObj => $vObj) {
                                ?>
                                <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_repres_estado_id'] ? 'selected="selected"' : ''; ?>><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="dependente_benef_repres_end_municipio_s">Município<span class="text-danger">*</span>: <span class="text-danger"><?= $rsServidorDependentes[array_search($vObjDependente['sacad_servidor_dependente_id_old'], array_column($rsServidorDependentes, 'id'))]['benef_repres_municipio_nome']; ?></span></label>
                          <div class="input-group mb-3 controls">
                            <select id="dependente_benef_repres_end_municipio_s_<?= $countDependentes ;?>" name="dependente_benef_repres_end_municipio_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do representante" required>
                              <?php
                              if ($vObjDependente['benef_repres_bsc_municipio_id'] != 0) {
                                foreach ($vObjDependente['benefRepresMunicipios'] as $kObj => $vObj) {
                                  ?>
                                  <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $vObjDependente['benef_repres_bsc_municipio_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
                                  <?php
                                }
                              } else {
                                ?>
                                <option value="">Selecione primeiro o Estado do representante do beneficiário</option>
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
            </div>
          </div>
          <div class="box-footer text-center mb-15">
            <button type="button" id="btn_del_dependente_<?= $countDependentes ;?>" class="btn_del_dependente btn btn-rounded btn-danger mr-1" onclick="dependenteFormDel($(this))">
              <i class="ti-trash"></i> Remover Dependente
            </button>
            <button type="button" id="btn_add_dependente_<?= $countDependentes ;?>" class="btn_add_dependente btn btn-rounded btn-success" onclick="dependenteFormAdd($(this))">
              <i class="ti-plus"></i> Novo Dependente
            </button>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
      <div id="box_dependente" class="box_dependente box box-outline-primary">
        <input type="hidden" id="dependente_id_s" name="dependente_id_s[]" value="0">
        <input type="hidden" id="dependente_id_old_s" name="dependente_id_old_s[]" value="0">
        <div class="box-header">
          <h5 class="mb-0"><strong>DEPENDENTE - <span>1</span></strong></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_codigo_s">Código: <span class="text-warning" grupo="input_text" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="dependente_codigo_s" name="dependente_codigo_s[]" placeholder="Código do dependente do servidor" value=""/>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="dependente_nome_s">Nome<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="3" id="dependente_nome_s" name="dependente_nome_s[]" placeholder="Nome do dependente do servidor" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_cpf_s">CPF<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control cpf_format" minlength="14" id="dependente_cpf_s" name="dependente_cpf_s[]" placeholder="CPF do dependente do servidor" title="exemplo: 999.999.999-99" value="" allempty/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_parent_grau_s">Grau de parentesco<span class="text-danger" validator>: <span class="text-warning" grupo="select" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <select id="dependente_parent_grau_s" name="dependente_parent_grau_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o grau de parentesco dependente do servidor" allempty>
                    <option></option>
                    <?php
                    foreach ($rsParentescosGraus as $kObj => $vObj) {
                      ?>
                      <option value="<?= $vObj['id']; ?>"><?= $vObj['nome']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_parent_grau_outro_s">Outro grau de parentesco: <span class="text-warning" grupo="select" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control" minlength="5" id="dependente_parent_grau_outro_s" name="dependente_parent_grau_outro_s[]" placeholder="Outro grau de parentesco do dependente do servidor" value=""/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_dt_nasc_s">Data de nascimento<span class="text-danger" validator>: <span class="text-warning" grupo="input_text" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dependente_dt_nasc_s" name="dependente_dt_nasc_s[]" placeholder="Data de nascimento do dependente do servidor" title="exemplo: 31/12/2000" value="" allempty/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="dependente_dt_casamento_s">Data de casamento: <span class="text-warning" grupo="input_text" subgrupo="dependente" value=""></span></label>
                <div class="input-group mb-3 controls">
                  <input type="text" class="form-control date_format" minlength="10" id="dependente_dt_casamento_s" name="dependente_dt_casamento_s[]" placeholder="Data de casamento com o dependente do servidor" title="exemplo: 31/12/2000" value=""/>
                </div>
              </div>
            </div>
          </div>
          <div id="div_benef">
            <div class="row mt-2">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dependente_benef_s">Beneficiário de pensão? <span class="text-danger" validator></label>
                  <div class="form-group ichack-input mt-10">
                    <label onclick="benefClick(this);">
                      <input type="radio" id="dependente_benef_s_N_1" name="dependente_benef_s_1" class="dependente_benef_s radio_benef_n square-purple" value="N" allempty> Não
                    </label>
                    <label onclick="benefClick(this);">
                      <input type="radio" id="dependente_benef_s_S_1" name="dependente_benef_s_1" class="dependente_benef_s radio_benef_s square-purple" value="S"> Sim
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div id="div_benef_dados" style="display: none;">
              <div class="row mt-2">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="dependente_benef_autos_s">Número dos autos<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente"></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="3" id="dependente_benef_autos_s" name="dependente_benef_autos_s[]" placeholder="Núnmero dos autos" value="" required/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-10">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_rg_numero_s">RG - Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="3" id="dependente_benef_rg_numero_s" name="dependente_benef_rg_numero_s[]" placeholder="Número do RG do dependente" value=""/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_rg_dt_emissao_s">RG - Data de emissao<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control date_format" minlength="10" id="dependente_benef_rg_dt_emissao_s" name="dependente_benef_rg_dt_emissao_s[]" placeholder="Data de emissao do RG do dependente" title="exemplo: 31/12/2000" value=""/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="3" id="dependente_benef_rg_orgao_expedidor_s" name="dependente_benef_rg_orgao_expedidor_s[]" placeholder="Órgão expedidor do RG do dependente" value=""/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-10">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_tel_res_s">Telefone residencial: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control tel_format" minlength="13" id="dependente_benef_tel_res_s" name="dependente_benef_tel_res_s[]" placeholder="Telefone residencial do dependente" title="exemplo: (68)3222-2222" value=""/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_tel_cel_s">Telefone celular<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control cel_format" minlength="13" id="dependente_benef_tel_cel_s" name="dependente_benef_tel_cel_s[]" placeholder="Telefone celular do dependente" title="exemplo: (68)9.9999-9999" value="" required/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="dependente_benef_end_log_s">Logradouro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="5" id="dependente_benef_end_log_s" name="dependente_benef_end_log_s[]" placeholder="Logradouro do endereço do dependente" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="dependente_benef_end_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="1" id="dependente_benef_end_num_s" name="dependente_benef_end_num_s[]" placeholder="Número do endereço do dependente" value="" required/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dependente_benef_end_comp_s">Complemento: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="1" id="dependente_benef_end_comp_s" name="dependente_benef_end_comp_s[]" placeholder="Complemento do endereço do dependente" value=""/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dependente_benef_end_bairro_s">Bairro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="2" id="dependente_benef_end_bairro_s" name="dependente_benef_end_bairro_s[]" placeholder="Bairro do endereço do dependente" value="" required/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-10">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_end_cep_s">CEP<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control cep_format" minlength="10" id="dependente_benef_end_cep_s" name="dependente_benef_end_cep_s[]" placeholder="CEP do endereço do dependente" title="exemplo: 69.900-000" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_end_estado_s">Estado<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                    <div class="input-group mb-3 controls">
                      <select id="dependente_benef_end_estado_s" name="dependente_benef_end_estado_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do dependente" onchange="benefCarregaMun(this);" required>
                        <option value=""></option>
                        <?php
                        foreach ($rsEstados as $kObj => $vObj) {
                          ?>
                          <option value="<?= $vObj['id']; ?>" ><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_end_municipio_s">Município<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                    <div class="input-group mb-3 controls">
                      <select id="dependente_benef_end_municipio_s" name="dependente_benef_end_municipio_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do dependente" required>
                        <option value="">Selecione primeiro o Estado do beneficiário</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-10">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_banco_conta_tipo_s">Tipo de conta bancaria<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                    <div class="input-group mb-3 controls">
                      <select id="dependente_benef_banco_conta_tipo_s" name="dependente_benef_banco_conta_tipo_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Tipo de Conta" required>
                        <option value=""></option>
                        <?php
                        foreach ($rsBancoContaTipos as $kObj => $vObj) {
                          ?>
                          <option value="<?= $vObj['id']; ?>" ><?= $vObj['nome']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="dependente_benef_banco_s">Banco<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                    <div class="input-group mb-3 controls">
                      <select id="dependente_benef_banco_s" name="dependente_benef_banco_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Banco" required>
                        <option value=""></option>
                        <?php
                        foreach ($rsBancos as $kObj => $vObj) {
                          ?>
                          <option value="<?= $vObj['id']; ?>" ><?= $vObj['nome']; ?></option>
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
                    <label for="dependente_benef_bancario_agencia_s">Agência<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="4" id="dependente_benef_bancario_agencia_s" name="dependente_benef_bancario_agencia_s[]"  maxlength="6" placeholder="Agência bancaria do dependente" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_bancario_conta_s">Conta<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="4" id="dependente_benef_bancario_conta_s" name="dependente_benef_bancario_conta_s[]"  maxlength="15" placeholder="Conta bancária do dependente" value="" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dependente_benef_bancario_op_s">Operação/Variação: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                    <div class="input-group mb-3 controls">
                      <input type="text" class="form-control" minlength="1" id="dependente_benef_bancario_op_s" name="dependente_benef_bancario_op_s[]"  maxlength="3" placeholder="Operação/Variação bancária do dependente" value=""/>
                    </div>
                  </div>
                </div>
              </div>
              <div id="div_repres">
                <div class="row mt-2">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dependente_benef_repres_s">Representante legal<span class="text-danger">*</span>? <span class="text-warning" grupo="radio" subgrupo="dependente" value=""></span></label>
                      <div class="form-group ichack-input mt-10">
                        <label onclick="represClick(this);">
                          <input type="radio" id="dependente_benef_repres_s_N_1" name="dependente_benef_repres_s_1" class="dependente_benef_repres_s radio_repres_n square-purple" value="N" required> Não
                        </label>
                        <label onclick="represClick(this);">
                          <input type="radio" id="dependente_benef_repres_s_S_1" name="dependente_benef_repres_s_1" class="dependente_benef_repres_s radio_repres_s square-purple" value="S"> Sim
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="div_repres_dados" style="display: none;">
                  <div class="row mt-10">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="dependente_benef_repres_nome_s">Nome<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="3" id="dependente_benef_repres_nome_s" name="dependente_benef_repres_nome_s[]" placeholder="Nome do representante do beneficio" value="" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_cpf_s">CPF<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control cpf_format" minlength="14" id="dependente_benef_repres_cpf_s" name="dependente_benef_repres_cpf_s[]" placeholder="CPF do representante legal" value="" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-10">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_rg_numero_s">RG - Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="3" maxlength="15" id="dependente_benef_repres_rg_numero_s" name="dependente_benef_repres_rg_numero_s[]" placeholder="Número do RG do representante" value=" required"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_rg_dt_emissao_s">RG - Data de emissao<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control date_format" minlength="10" id="dependente_benef_repres_rg_dt_emissao_s" name="dependente_benef_repres_rg_dt_emissao_s[]" placeholder="Data de emissao do RG do representante" title="exemplo: 31/12/2000" value="" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_rg_orgao_expedidor_s">RG - Órgão expedidor<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="3" id="dependente_benef_repres_rg_orgao_expedidor_s" name="dependente_benef_repres_rg_orgao_expedidor_s[]" placeholder="Órgão expedidor do RG do representante" value="" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-10">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_tel_res_s">Telefone residencial: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control tel_format" minlength="13" id="dependente_benef_repres_tel_res_s" name="dependente_benef_repres_tel_res_s[]" placeholder="Telefone residencial do representante" title="exemplo: (68)3222-2222" value=""/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_tel_cel_s">Telefone celular<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control cel_format" minlength="13" id="dependente_benef_repres_tel_cel_s" name="dependente_benef_repres_tel_cel_s[]" placeholder="Telefone celular do representante" title="exemplo: (68)9.9999-9999" value="" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_log_s">Logradouro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="5" id="dependente_benef_repres_end_log_s" name="dependente_benef_repres_end_log_s[]" placeholder="Logradouro do endereço do representante" value="" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_num_s">Número<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="1" id="dependente_benef_repres_end_num_s" name="dependente_benef_repres_end_num_s[]" placeholder="Número do endereço do representante" value="" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_comp_s">Complemento: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="1" id="dependente_benef_repres_end_comp_s" name="dependente_benef_repres_end_comp_s[]" placeholder="Complemento do endereço do representante" value=""/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_bairro_s">Bairro<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control" minlength="2" id="dependente_benef_repres_end_bairro_s" name="dependente_benef_repres_end_bairro_s[]" placeholder="Bairro do endereço do representante" value="" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-10">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_cep_s">CEP<span class="text-danger">*</span>: <span class="text-warning" grupo="input_text" subgrupo="dependente" ></span></label>
                        <div class="input-group mb-3 controls">
                          <input type="text" class="form-control cep_format" minlength="10" id="dependente_benef_repres_end_cep_s" name="dependente_benef_repres_end_cep_s[]" placeholder="CEP do endereço do representante" title="exemplo: 69.900-000" value="" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_estado_s">Estado<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                        <div class="input-group mb-3 controls">
                          <select id="dependente_benef_repres_end_estado_s" name="dependente_benef_repres_end_estado_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Estado do representante" onchange="benefRepresCarregaMun(this);" required>
                            <option value=""></option>
                            <?php
                            foreach ($rsEstados as $kObj => $vObj) {
                              ?>
                              <option value="<?= $vObj['id']; ?>" ><?= ($vObj['nome'].' - '.$vObj['sigla']); ?></option>
                              <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="dependente_benef_repres_end_municipio_s">Município<span class="text-danger">*</span>: <span class="text-danger"></span></label>
                        <div class="input-group mb-3 controls">
                          <select id="dependente_benef_repres_end_municipio_s" name="dependente_benef_repres_end_municipio_s[]" class="form-control select2" style="width: 100%;" placeholder="selecione o Município do representante" required>
                            <option value="">Selecione primeiro o Estado do representante do beneficiário</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-center mb-15">
          <button type="button" id="btn_del_dependente_1" class="btn_del_dependente btn btn-rounded btn-danger mr-1" onclick="dependenteFormDel($(this))">
            <i class="ti-trash"></i> Remover Dependente
          </button>
          <button type="button" id="btn_add_dependente_1" class="btn_add_dependente btn btn-rounded btn-success" onclick="dependenteFormAdd($(this))">
            <i class="ti-plus"></i> Novo Dependente
          </button>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
</section>