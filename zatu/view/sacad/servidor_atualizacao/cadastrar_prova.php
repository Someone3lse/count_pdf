
<strong><div id="step-#index#" class="icones"><i class="mdi mdi-certificate"></i></div><span>COMPROVANTES</span></strong>
<section class="pt-0">
  <form id="form_servidor_prova" class="" name="form_servidor_prova" method="post" action="">
    <input type="hidden" id="prova_servidor_atualizacao_id" name="id" class="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="servidor_atualizacao_prova_id_s" name="servidor_atualizacao_prova_id_s" value="<?= $rsServidorAtualizacaoProva['id']; ?>">
    <input type="hidden" id="need_prova_sit_trab" value="<?= $rsServidorAtualizacao['rh_situacao_trabalho_id']; ?>">
    <input type="hidden" id="need_prova_sit_trab_2" value="<?= $rsServidorAtualizacao['rh_situacao_trabalho_id_2']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <strong>COMPROVANTES DA ATUALIZAÇÃO CADASTRAL</strong>
      </div>
      <div class="box-body">
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_pessoal" class="form-label">Comprovante de dados pessoais: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_pessoal" name="prova_pessoal[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_pessoal'] != '') {
                  ?>
                  <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $rsServidorAtualizacaoProva['prova_pessoal'] ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                  <?php
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_naturalidade" class="form-label">Comprovante de naturalidade: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_naturalidade" name="prova_naturalidade[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_naturalidade'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_naturalidade']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_empregador" class="form-label">Comprovante de empregador 1: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_empregador" name="prova_empregador" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_empregador'] != '') {
                  ?>
                  <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $rsServidorAtualizacaoProva['prova_empregador'] ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                  <?php
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_situacao_trabalho" class="form-label">Comprovante de Situação atual do Trabalho 1: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_situacao_trabalho" name="prova_situacao_trabalho[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_situacao_trabalho'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_situacao_trabalho']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_empregador_2" class="form-label">Comprovante de empregador 2: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_empregador_2" name="prova_empregador_2[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_empregador_2'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_empregador_2']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_situacao_trabalho_2" class="form-label">Comprovante de Situação atual do Trabalho 2: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_situacao_trabalho_2" name="prova_situacao_trabalho_2[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_situacao_trabalho_2'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_situacao_trabalho_2']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_covid_vacina" class="form-label">Comprovante de Vacina - Covid-19: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_covid_vacina" name="prova_covid_vacina[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_covid_vacina'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_covid_vacina']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_enfermidade" class="form-label">Comprovante de enfermidade: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_enfermidade" name="prova_enfermidade[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_enfermidade'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_enfermidade']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_end" class="form-label">Comprovante de endereço: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_end" name="prova_end[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_end'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_end']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_rg" class="form-label">Comprovante de Registro Geral (RG): </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_rg" name="prova_rg[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_rg'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rg']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_pis" class="form-label">Comprovante de PIS: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_pis" name="prova_pis[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_pis'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_pis']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_ctps" class="form-label">Comprovante de CTPS: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_ctps" name="prova_ctps[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_ctps'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_ctps']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_eleitor" class="form-label">Comprovante de título de eleitor: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_eleitor" name="prova_eleitor[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_eleitor'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_eleitor']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_reg_militar" class="form-label">Comprovante de registro militar: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_reg_militar" name="prova_reg_militar[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_reg_militar'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_militar']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_reg_prof" class="form-label">Comprovante de registro profissional: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_reg_prof" name="prova_reg_prof[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_reg_prof'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_prof']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_cnh" class="form-label">Comprovante de CNH: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_cnh" name="prova_cnh[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_cnh'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_cnh']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_rne" class="form-label">Comprovante de RNE: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_rne" name="prova_rne[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_rne'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_rne']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_fgts" class="form-label">Comprovante de FGTS: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_fgts" name="prova_fgts[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="prova_pessoal" class="form-label">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_fgts'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_fgts']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div> -->
        <?php foreach ($rsServidorAtualizacaoInstrucoes as $kObj => $vObj) {
          ?>
          <div class="row mt-10" style="display: none;">
            <div class="col-md-9">
              <div class="form-group">
                <label for="prova_instrucao" class="form-label">Comprovante de graus de instrução - <?= $kObj+1; ?>: </label>
                <div class="input-group mb-3 controls">
                  <input class="form-control form-control-lg file" id="prova_instrucao_<?= $kObj ;?>" name="prova_instrucao_<?= $vObj['id']; ?>[]" multiple="true" type="file" accept=".pdf, .PDF">
                  <input type="hidden" id='prova_instrucao_id' name="prova_instrucao_id[]" value="<?= $vObj['id']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-label mb-0">arquivo enviado anteriormente: </label>
                <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                  <?php if ($vObj['prova_instrucao'] != '') {
                    $comprovantes = explode('#&#', $vObj['prova_instrucao']);
                    foreach ($comprovantes as $kObjSub => $vObjSub) {
                      ?>
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObjSub ;?>" target="_blank">Comprovante <?= ++$kObjSub;?></a>
                      <?php
                    }
                  } else {
                    ?>
                    <span class="text-danger">Nenhum!</span>
                    <?php 
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_reg_civil" class="form-label">Comprovante de registro civil: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_reg_civil" name="prova_reg_civil[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_reg_civil'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_reg_civil']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_averbacao" class="form-label">Comprovante de averbação: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_averbacao" name="prova_averbacao[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_averbacao'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_averbacao']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php foreach ($rsServidorAtualizacaoDependentes as $kObj => $vObj) {
          ?>
          <div class="row mt-10" style="display: none;">
            <div class="col-md-9">
              <div class="form-group">
                <label for="prova_dependente" class="form-label">Comprovante de dependente - <?= $kObj+1; ?>: </label>
                <div class="input-group mb-3 controls">
                  <input class="form-control form-control-lg file" id="prova_dependente_<?= $kObj ;?>" name="prova_dependente_<?= $vObj['id']; ?>[]" multiple="true" type="file" accept=".pdf, .PDF">
                  <input type="hidden" id='prova_dependente_id' name="prova_dependente_id[]" value="<?= $vObj['id']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-label mb-0">arquivo enviado anteriormente: </label>
                <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                  <?php if ($vObj['prova_dependente'] != '') {
                    $comprovantes = explode('#&#', $vObj['prova_dependente']);
                    foreach ($comprovantes as $kObjSub => $vObjSub) {
                      ?>
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObjSub ;?>" target="_blank">Comprovante <?= ++$kObjSub;?></a>
                      <?php
                    }
                  } else {
                    ?>
                    <span class="text-danger">Nenhum!</span>
                    <?php 
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="row mt-10" style="display: none;">
          <div class="col-md-9">
            <div class="form-group">
              <label for="prova_bancario" class="form-label">Comprovante de dados bancarios: </label>
              <div class="input-group mb-0 controls">
                <input class="form-control form-control-lg file" id="prova_bancario" name="prova_bancario[]" multiple="true" type="file" accept=".pdf, .PDF">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="form-label mb-0">Arquivo enviado anteriormente: </label>
              <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                <?php if ($rsServidorAtualizacaoProva['prova_bancario'] != '') {
                  $comprovantes = explode('#&#', $rsServidorAtualizacaoProva['prova_bancario']);
                  foreach ($comprovantes as $kObj => $vObj) {
                    ?>
                    <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObj ;?>" target="_blank">Comprovante <?= ++$kObj;?></a>
                    <?php
                  }
                } else {
                  ?>
                  <span class="text-danger">Nenhum!</span>
                  <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php foreach ($rsServidorAtualizacaoVinculos as $kObj => $vObj) {
          ?>
          <div class="row mt-10" style="display: none;">
            <div class="col-md-9">
              <div class="form-group">
                <label for="prova_vinculo" class="form-label">Comprovante de vínculo - <?= $kObj+1; ?>: </label>
                <div class="input-group mb-3 controls">
                  <input class="form-control form-control-lg file" id="prova_vinculo_<?= $kObj ;?>" name="prova_vinculo_<?= $vObj['id']; ?>[]" multiple="true" type="file" accept=".pdf, .PDF">
                  <input type="hidden" id='prova_vinculo_id' name="prova_vinculo_id[]" value="<?= $vObj['id']; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-label mb-0">arquivo enviado anteriormente: </label>
                <div class="input-group pt-0 pb-0 alert alert-primary controls" style="font-size: 18px;">
                  <?php if ($vObj['prova_vinculo'] != '') {
                    $comprovantes = explode('#&#', $vObj['prova_vinculo']);
                    foreach ($comprovantes as $kObjSub => $vObjSub) {
                      ?>
                      <a href="<?= ASSETS_FOLDER . 'atualizacao_provas/' . $vObjSub ;?>" target="_blank">Comprovante <?= ++$kObjSub;?></a>
                      <?php
                    }
                  } else {
                    ?>
                    <span class="text-danger">Nenhum!</span>
                    <?php 
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </form>
</section>