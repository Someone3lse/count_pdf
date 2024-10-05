Left side column. contains the logo and sidebar -->
<?php 
if ($_SESSION['servidor_foto_cut'] == "") {
  $_SESSION['servidor_foto_cut'] = "picture.jpg";
}
$db = Conexao::getInstance();
$stmt = $db->prepare("
  SELECT cpf  
  FROM seg_servidor 
  WHERE id = ?;");
$stmt->bindValue(1, $_SESSION['servidor_zatu_id']);
$stmt->execute();
$rsSegServidorSidebar = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar"> 
    <div class="user-profile px-10 py-15">
      <div class="d-flex align-items-center">     
        <div class="image">
          <a href="<?= PORTAL_URL ;?>view/seg/servidor/foto">
            <img id="img_user" src="<?= AVATAR_FOLDER. $_SESSION['servidor_foto_cut']; ?>" class="avatar avatar-lg" alt="User Image">
          </a>
        </div>
        <div class="info ml-10">
          <p class="mb-0">Bem-Vindo</p>
          <h5 class="mb-0"><?= $_SESSION['servidor_nome'] ;?></h5>
        </div>
      </div>
      <hr>
      <span class="dados_usuario">CPF: <?= $rsSegServidorSidebar['cpf'] ;?> <!-- <a href="<?= PORTAL_URL ;?>view/servidor_impressao" target="_blank" title="Imprimir suas informações."><i class="fal fa-print"></i></a> --></span>
    </div>  
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= PORTAL_URL; ?>servidor_dashboard"><i class="fal fa-desktop"></i> DASHBOARD</a>
      </li>
      <li class="header">MÓDULOS</li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-id-badge"></i>
          <span>ATUALIZAÇÃO CADASTRAL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php 
          if (
            sizeof($rsServidorAtualizacoes) <= 0 
            || 
            (
              sizeof($rsServidorAtualizacoes) > 0 
              && 
              end($rsServidorAtualizacoes)['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 10 
              && 
              (
                ($rsSegServidor['ano_hoje'] > end($rsServidorAtualizacoes)['situacaoServidorUltima']['ano'] 
                  ? ($rsSegServidor['ano_hoje'] - end($rsServidorAtualizacoes)['situacaoServidorUltima']['ano']) * 12 + $rsSegServidor['mes_hoje'] 
                  : $rsSegServidor['mes_hoje']
                ) - end($rsServidorAtualizacoes)['situacaoServidorUltima']['mes'] > 3
              )
              &&
              $rsSegServidor['mes_hoje'] == end($rsServidorAtualizacoes)['nasc_mes']
            )
          ) 
          {
            ?>
            <li>
              <a id="menu_a_recadastro" href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/cadastrar"><i class="ti-more"></i>RECADASTRAMENTO ANUAL</a>
            </li>
            <?php
          } else {
            ?>
            <li style="pointer-events:none; opacity:0.6;">
              <a id="menu_a_recadastro" href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/cadastrar"><i class="ti-more"></i>RECADASTRAMENTO ANUAL</a>
            </li>
            <?php
          }
          if (
            sizeof($rsServidorAtualizacoes) > 0 
            && 
            end($rsServidorAtualizacoes)['situacaoServidorUltima']['sacad_situacao_servidor_atualizacao_id'] == 10 
            && 
            $rsSegServidor['mes_hoje'] != end($rsServidorAtualizacoes)['nasc_mes']
          ) {
            ?>
            <li>
              <a id="menu_a_atualizacao" href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/cadastrar"><i class="ti-more"></i>CRIAR PROCESSO DE ALTERAÇÃO DE DADOS</a>
            </li>
            <li>
              <a href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/dashboard"><i class="ti-more"></i>LISTAR PROCESSOS</a>
            </li>
            <?php
          } else {
            ?>
            <li style="pointer-events:none; opacity:0.6;">
              <a id="menu_a_atualizacao" href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/cadastrar"><i class="ti-more"></i>CRIAR PROCESSO DE ALTERAÇÃO DE DADOS</a>
            </li>
            <li>
              <a href="<?= PORTAL_URL; ?>view/sacad/servidor_atualizacao/dashboard"><i class="ti-more"></i>LISTAR PROCESSOS</a>
            </li>
            <?php
          }
          ?>
        </ul>
      </li>
      <!-- <li class="treeview">
        <a href="#">
          <i class="fal fa-money-check-alt"></i>
          <span>INFORMAÇÕES FINANCEIRAS</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>EM DESENVLVIMENTO</li>
        </ul>
      </li> -->

      <!-- <li class="header">ADMINISTRAÇÃO</li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-building"></i>
          <span>ESTRUTURA ORGANIZACIONAL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= PORTAL_URL; ?>view/eo/cargo/dashboard"><i class="ti-more"></i>CARGOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/eo/empregador/dashboard"><i class="ti-more"></i>EMPREGADORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/eo/setor/dashboard"><i class="ti-more"></i>SETORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/bsc/unidade_organizacional/dashboard"><i class="ti-more"></i>INSTITUIÇÕES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/bsc/unidade_organizacional_tipo/dashboard"><i class="ti-more"></i>TIPOS DE INSTITUIÇÕES</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fal fa-briefcase"></i>
          <span>RECURSOS HUMANOS</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_contrato/dashboard"><i class="ti-more"></i>CONTRATOS DE SERVIDORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_contrato/cadastrar"><i class="ti-more"></i>NOVO CONTRATO DE SERVIDOR</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_tipo/dashboard"><i class="ti-more"></i>TIPOS DE SERVIDOR</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor/dashboard"><i class="ti-more"></i>LISTA DE SERVIDORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor/cadastrar"><i class="ti-more"></i>NOVO SERVIDOR</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-user"></i>
          <span>USUÁRIO</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= PORTAL_URL; ?>view/seg/usuario/dashboard"><i class="ti-more"></i>USUÁRIOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/seg/usuario/cadastrar"><i class="ti-more"></i>NOVO USUÁRIO</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-file-alt"></i>
          <span>RELATÓRIO</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/sacad/relatorio"><i class="ti-more"></i>ATUALIZAÇÕES CADASTRAIS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/relatorio"><i class="ti-more"></i>SERVIDORES</a></li>
        </ul>
      </li> -->
      <li><a href="<?= PORTAL_URL; ?>servidor_logout"><i class="far fa-power-off"></i> SAIR</a></li> 
    </ul>
  </section>
  <!-- <div class="sidebar-footer"> -->
    <!-- item-->
    <!-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a> -->
    <!-- item-->
    <!-- <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a> -->
    <!-- item-->
    <!-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a> -->
  <!-- </div> -->
</aside>
<!-- ./ Left side column. contains the logo and sidebar -->