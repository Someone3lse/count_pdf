<?php
include_once ('template/topo.php');
include_once ('template/header.php');
include_once ('template/sidebar.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT 
  sc.id, 
  sc.rh_servidor_id, 
  s.nome AS servidor_nome, 
  sc.rh_servidor_tipo_id, 
  sc.contrato_numero, 
  sc.dt_publicacao, 
  sc.contrato_dt_inicio, 
  sc.contrato_dt_fim, 
  sc.contrato_fim_indefinido, 
  sc.situacao, 
  sc.bsc_unidade_organizacional_id, 
  sc.setor, 
  sc.bsc_municipio_id, 
  sc.desligamento_dt, 
  sc.desligamento_tipo, 
  sc.eo_cargo_id, 
  sc.status 
  FROM rh_servidor_contrato AS sc 
  LEFT JOIN rh_servidor AS s ON s.id = sc.rh_servidor_id 
  WHERE sc.id = ?");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContrato = $stmt->fetch(PDO::FETCH_ASSOC);
if (is_array($rsServidorContrato) && sizeof($rsServidorContrato) <= 0) {
  $rsServidor['id'] = 0;
  $rsServidor['rh_servidor_id'] = '';
  $rsServidor['servidor_nome'] = '';
  $rsServidor['rh_servidor_tipo_id'] = '';
  $rsServidor['contrato_numero'] = '';
  $rsServidor['contrato_dt_inicio'] = '';
  $rsServidor['contrato_dt_fim'] = '';
  $rsServidor['contrato_fim_indefinido'] = '';
  $rsServidor['situacao'] = '';
  $rsServidor['bsc_unidade_organizacional_id'] = '';
  $rsServidor['uo_nome'] = '';
  $rsServidor['setor'] = '';
  $rsServidor['bsc_municipio_id'] = '';
  $rsServidor['desligamento_dt'] = '';
  $rsServidor['desligamento_tipo'] = '';
  $rsServidor['status'] = '';
}
$stmt = $db->prepare("
  SELECT 
  sca.id, 
  sca.rh_servidor_contrato_id, 
  sca.salario, 
  sca.periodicidade, 
  sca.funcao_nome, 
  sca.funcao_descricao, 
  sca.dt_vigorar, 
  sca.dt_publicacao, 
  sca.hora_entrada, 
  sca.hora_inervalo_entrada, 
  sca.hora_intervalo_saida, 
  sca.hora_saida, 
  sca.status 
  FROM rh_servidor_contrato_alteracao AS sca
  WHERE sca.rh_servidor_contrato_id = ? 
  ORDER BY sca.dt_vigorar ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContratoAlteracoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  scf.id, 
  scf.rh_servidor_contrato_id, 
  scf.aquisitivo_dt_inicio, 
  scf.aquisitivo_dt_fim, 
  scf.gozo_dt_inicio, 
  scf.gozo_dt_fim, 
  scf.obs, 
  scf.status 
  FROM rh_servidor_contrato_ferias AS scf
  WHERE scf.rh_servidor_contrato_id = ? 
  ORDER BY scf.aquisitivo_dt_inicio ASC;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsServidorContratoFerias = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  m.id, 
  m.nome 
  FROM bsc_municipio AS m
  WHERE m.bsc_estado_id = 1 
  ORDER BY m.nome ASC;");
$stmt->execute();
$rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  uo.id, 
  uo.nome, 
  uo.status, 
  uo.dt_cadastro, 
  uo.seg_usuario_id, 
  uo.bsc_unidade_organizacional_tipo_id 
  FROM bsc_unidade_organizacional AS uo 
  ORDER BY uo.nome ASC;");
$stmt->execute();
$rsUnidadesOrganizacionais = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  st.id, 
  st.nome, 
  st.status 
  FROM rh_servidor_tipo AS st 
  WHERE st.status = 1 
  ORDER BY st.nome ASC;");
$stmt->execute();
$rsServidorTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  st.id, 
  st.nome, 
  st.status 
  FROM eo_cargo AS st 
  WHERE st.status = 1 
  ORDER BY st.nome ASC;");
$stmt->execute();
$rsCargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <div class="content-header">
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Atualização Cadastral do Contrato do Servidor</li>
          </ol>
        </nav>
      </div>
    </div>
      <div class="box box-solid bg-info">
        <div class="box-header">
          <h4 class="box-title font-weight-bold">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon rounded-circle font-size-30"><i class="fal fa-file-signature mr-10"></i></div>
              <span id="titulo_form"> <?= $id == 0 ? ' ATUALIZAÇÃO CADASTRAL DO' : ' EDIÇÃO CADASTRAL DO'; ?> CONTRATO DO SERVIDOR</span>
            </div>
          </h4>
          <!-- <a href="#" class="waves-effect waves-light btn btn-rounded btn-success mb-5 pull-right d-md-flex d-none">NOVO USUÁRIO</a> -->
        </div>

        <div class="box-body wizard-content">
          <div id="div_servidor" class="tab-wizard vertical wizard-circle">
            <?php
            include_once ('view/rh/servidor_contrato/cadastrar_contrato.php');
            include_once ('view/rh/servidor_contrato/cadastrar_contrato_alteracao.php');
            include_once ('view/rh/servidor_contrato/cadastrar_contrato_ferias.php');
            ?>
          </div>
          <!-- </form> -->
          <div class="box-footer text-center">
            <button type="button" id="btn_cancelar"  class="btn btn-rounded btn-danger mr-1"  ><i class="ti-eraser"></i> Cancelar</button>
            <button type="button" id="btn_anterior"  class="btn btn-rounded btn-info mr-1"    ><i class="ti-arrow-left"></i> Salvar e Retroceder</button>
            <button type="button" id="btn_proximo"   class="btn btn-rounded btn-info mr-1"    >Salvar e Avançar <i class="ti-arrow-right"></i></button>
            <button type="button" id="btn_finalizar" class="btn btn-rounded btn-success mr-1" >Salvar e Finalizar <i class="ti-check"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<?php
include_once ('template/footer.php');
//include_once ('template/control_sidebar.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_contrato/cadastrar_contrato.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_contrato/cadastrar_contrato_alteracao.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_contrato/cadastrar_contrato_ferias.js"></script>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/rh/servidor_contrato/cadastrar.js"></script>