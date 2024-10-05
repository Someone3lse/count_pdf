<?php 
if ($_SESSION['foto_cut'] == "") {
  $_SESSION['foto_cut'] = "picture.jpg";
}
?>
<aside class="main-sidebar">
  <input type="hidden" id="zatu_id" name="zatu_id" value="<?= $_SESSION['zatu_id'] ;?>">
  <input type="hidden" id="zatu_nome" name="zatu_nome" value="<?= $_SESSION['nome'] ;?>">
  <!-- sidebar-->
  <section class="sidebar"> 
    <div class="user-profile px-10 py-15">
      <div class="d-flex align-items-center">     
        <div class="image">
          <a href="<?= PORTAL_URL ;?>view/seg/usuario/foto">
            <img id="img_user" src="<?= AVATAR_FOLDER. $_SESSION['foto_cut']; ?>" class="avatar avatar-lg" alt="User Image">
          </a>
        </div>
        <div class="info ml-10">
          <p class="mb-0">Bem-Vindo</p>
          <h5 class="mb-0"><?= $_SESSION['nome'] ;?></h5>
        </div>
      </div>
    </div>  
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= PORTAL_URL; ?>dashboard"><i class="fal fa-desktop"></i> DASHBOARD</a>
      </li>
      <li class="header">ATESTAÇÃO DE VÍNCULO</li>
      <li>
        <a href="<?= PORTAL_URL; ?>view/rh/atestacao/dashboard"><i class="fal fa-id-badge"></i><span>ATESTAÇÕES</span></a>
      </li>
      <li class="header">GESTÃO DE PROCESSOS</li>
      <li>
        <a href="<?= PORTAL_URL; ?>view/rh/servidor_atualizacao/dashboard"><i class="fal fa-id-badge"></i><span>PROCESSOS</span></a>
      </li>
      <li class="header">SERVIDORES</li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-briefcase"></i>
          <span>GESTÃO</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_contrato/dashboard"><i class="ti-more"></i>CONTRATOS - LISTAGEM</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_contrato/cadastrar"><i class="ti-more"></i>CONTRATOS - CADASTRO</a></li> -->
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor/dashboard"><i class="ti-more"></i>SERVIDORES - LISTAGEM</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor/cadastrar"><i class="ti-more"></i>SERVIDORES - CADASTRO</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor/acesso"><i class="ti-more"></i>SERVIDORES - ACESSO</a></li>
        </ul>
      </li>
      <li class="header">ADMINISTRAÇÃO</li>
      <li class="treeview">
        <a href="#">
          <i class="fal fa-building"></i>
          <span>ESTRUTURA ORGANIZACIONAL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= PORTAL_URL; ?>view/eo/empregador/dashboard"><i class="ti-more"></i>PREFEITURA</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/bsc/unidade_organizacional_tipo/dashboard"><i class="ti-more"></i>TIPOS DE SECRETARIAS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/eo/setor/dashboard"><i class="ti-more"></i>SETORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/bsc/unidade_organizacional/dashboard"><i class="ti-more"></i>SECRETARIAS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/eo/cargo/dashboard"><i class="ti-more"></i>CARGOS</a></li>
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
          <li><a href="<?= PORTAL_URL; ?>view/rh/servidor_tipo/dashboard"><i class="ti-more"></i>SERVIDORES - TIPOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/atestador/dashboard"><i class="ti-more"></i>GERÊNCIA DE CHEFES IMEDIATOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/rh/conferidor/dashboard"><i class="ti-more"></i>GERÊNCIA DE VALIDADORES DE DADOS</a></li>
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
          <li><a href="<?= PORTAL_URL; ?>view/seg/usuario/dashboard"><i class="ti-more"></i>USUÁRIOS - LISTAGEM</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/seg/usuario/cadastrar"><i class="ti-more"></i>USUÁRIOS - CADASTRO</a></li>
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
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/servidor"><i class="ti-more"></i>SERVIDORES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/servidor_sem_atualizacao"><i class="ti-more"></i>SERVIDORES S/ATUALIZAÇÃO</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/atestacoes"><i class="ti-more"></i>ATESTAÇÕES</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/sacad/servidor_atualizacao"><i class="ti-more"></i>PROCESSOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/atestador"><i class="ti-more"></i>CHEFES IMEDIATOS</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/rh/validador"><i class="ti-more"></i>VALIDADORES RH</a></li>
          <li><a href="<?= PORTAL_URL; ?>view/relatorio/seg/usuario"><i class="ti-more"></i>USUÁRIOS</a></li>
        </ul>
      </li>
      <li><a href="<?= PORTAL_URL; ?>logout"><i class="far fa-power-off"></i> SAIR</a></li> 
    </ul>
  </section>
  <!-- <div class="sidebar-footer"> -->
    <!-- item-->
    <!-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" ti tle="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a> -->
    <!-- item-->
    <!-- <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a> -->
    <!-- item-->
    <!-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a> -->
    <!-- </div> -->
  </aside>