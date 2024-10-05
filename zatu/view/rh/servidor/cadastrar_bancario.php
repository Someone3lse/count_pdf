<strong><div id="step-#index#" class="icones"><i class="fal fa-money"></i></div><span>BANCÁRIO</span></strong>
<section class="pt-0">
  <form id="form_servidor_bancario" class="" name="form_servidor_bancario" method="post" action="">
    <input type="hidden" id="bancario_servidor_id" name="id" class="servidor_id" value="<?= $id; ?>">
    <input type="hidden" id="servidor_bancario_id_s" name="servidor_bancario_id_s" value="<?= $rsServidorBancario['id']; ?>">
    <div class="box box-outline-info">
      <div class="box-header">
        <strong>DADOS BANCÁRIOS</strong>
      </div>
      <div class="box-body">
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="bancario_banco_conta_tipo_s">Tipo de conta bancária<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="bancario_conta_tipo_s" name="bancario_conta_tipo_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de conta bancaria do servidor">
                  <option></option>
                  <?php
                  foreach ($rsBancoContaTipos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorBancario['bancario_bsc_banco_conta_tipo_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['nome']; ?></option>
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
              <label for="bancario_banco_s">Banco<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <select id="bancario_banco_s" name="bancario_banco_s" class="form-control select2" style="width: 100%;" placeholder="selecione o tipo de conta bancaria do servidor">
                  <option></option>
                  <?php
                  foreach ($rsBancos as $kObj => $vObj) {
                    ?>
                    <option value="<?= $vObj['id']; ?>" <?= $vObj['id'] == $rsServidorBancario['bancario_bsc_banco_id'] ? 'selected="selected"' : ''; ?>><?= $vObj['codigo'].' - '.$vObj['nome']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="bancario_agencia_s">Agencia<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="bancario_agencia_s" name="bancario_agencia_s" placeholder="Agencia bancária do servidor" value="<?= $rsServidorBancario['bancario_agencia']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="bancario_conta_s">Conta<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="text" class="form-control" minlength="3" id="bancario_conta_s" name="bancario_conta_s" placeholder="Número da conta bancária do servidor" value="<?= $rsServidorBancario['bancario_conta']; ?>"/>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="bancario_op_s">OPERAÇÃO<span class="text-danger"></span>: </label>
              <div class="input-group mb-3 controls">
                <input type="number" class="form-control" minlength="1" id="bancario_op_s" name="bancario_op_s" placeholder="Tipo de operação bancária do servidor" value="<?= $rsServidorBancario['bancario_op']; ?>"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>