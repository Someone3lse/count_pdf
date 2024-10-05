<strong><div id="step-#index#" class="icones"><i class="fal fa-money"></i></div><span>BANCÁRIO</span></strong>
<section class="pt-0">
  <form id="form_servidor_bancario" class="" name="form_servidor_bancario" method="post" action="">
    <input type="hidden" id="bancario_servidor_atualizacao_id" name="id" class="servidor_atualizacao_id" value="<?= $rsServidorAtualizacao['id']; ?>">
    <input type="hidden" id="servidor_atualizacao_bancario_id_s" name="servidor_atualizacao_bancario_id_s" value="<?= $rsServidorAtualizacaoBancario['id']; ?>">
    <div class="box box-outline-primary">
      <div class="box-header">
        <strong>DADOS BANCÁRIOS</strong>
      </div>
      <div class="box-body">
        <div class="row mt-10">
          <div class="col-md-2">
          </div>
          <div class="col-md-18">
            <div class="form-group">
              <span>As informações bancárias não podem ser atualizadas automaicamente por este meio!</span><br>
              <span>As alterações bancárias podem ser feitas pessoalmente junto à entidade contratante!</span>
            </div>
          </div>
          <div class="col-md-2">
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="bancario_banco_conta_tipo_s">Tipo de conta bancária: <span class="text-danger"><?= $rsServidorBancario['conta_tipo_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-4">
            <div class="form-group">
              <label for="bancario_banco_s">Banco: <span class="text-danger"><?= $rsServidorBancario['banco_codigo'].' - '.$rsServidorBancario['banco_nome']; ?></span></label>
              <div class="input-group mb-3 controls">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="bancario_agencia_s">Agencia: <span class="text-danger"><?= $rsServidorBancario['bancario_agencia']; ?></span></label>
              <div class="input-group mb-3 controls">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="bancario_conta_s">Conta: <span class="text-danger"><?= $rsServidorBancario['bancario_conta']; ?></span></label>
              <div class="input-group mb-3 controls">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="bancario_op_s">Banco - Op: <span class="text-danger"><?= $rsServidorBancario['bancario_op']; ?></span></label>
              <div class="input-group mb-3 controls">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>