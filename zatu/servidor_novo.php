<?php
// VERIFICAÇÕES DE SESSÕES
if(isset($_SESSION['servidor_zatu_id'])) {
  ?>
  <script type="text/javascript"> window.location.href = '<?= PORTAL_URL ;?>servidor_dashboard';</script>
  <?php
  exit();
}
$servidor_zatu_id      = isset($_POST['servidor_zatu_id']) ? $_POST['servidor_zatu_id'] : '';
$urlanterior  = isset($_POST['urlanterior']) ? $_POST['urlanterior'] : '';
  // RANDONIZADOR DE IMAGENS DO BACKGROUND
  // $dir_name     = "assets/images/fotos/";
  // $handle       = opendir($dir_name);
  // $i = 0;
  // while($file = readdir($handle)) {
  // 	if($file != "." && $file != ".." && $file != ".DS_Store") {
  // 		$photos[$i] = "$file";
  // 		$i ++;
  // 	}
  // }
  // closedir($handle);
  // $img = IMG_FOLDER."fotos/".$photos[array_rand($photos)];

$stmt = $db->prepare("
  SELECT 
  uo.id AS id, 
  uo.nome AS nome, 
  uo.status AS status 
  FROM bsc_unidade_organizacional AS uo 
  ORDER BY uo.nome ASC;");
$stmt->execute();
$rsUOs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- METAS BEGIN -->
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- METAS END -->
  <!-- FAVICON BEGIN -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON_SISTEMA; ?>">
  <title>:: ZATU | Registro servidor ::</title>
  <!-- FAVICON END -->
  <!-- CSS PLUGINS BEGIN -->
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>vendors_css.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>style.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>login.css">
  <link rel="stylesheet" href="<?= CSS_FOLDER; ?>skin_color.css">
  <!-- Style-->  
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= ASSETS_FOLDER ?>fonts/fonts.css">
  <!-- CSS PLUGINS BEGIN -->
  <!-- CSS CUSTON BEGIN -->
  <!-- CSS CUSTON END -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= PORTAL_URL ?>assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= PORTAL_URL ?>assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PORTAL_URL ?>assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= PORTAL_URL ?>assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= PORTAL_URL ?>assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition theme-primary bg-img login" style="background-image: url(http://localhost:80/zatu/assets/images/fundo_esquerdo.png) , url(http://localhost:80/zatu/assets/images/fundo_direito.png);">
  <header class="servidor">
    <div class="elementos">
      <span class="zatu"><img src="<?= PORTAL_URL ?>assets/images/zatu-logo.svg" alt=""></span>
    </div>
    <!-- <a href="#" class="pull-right btn-login"><i class="fal fa-user"></i> <br> LOGIN</a> -->
  </header>
  <div class="container h-p100 mt-60">
    <!-- <a href="<?= PORTAL_URL ?>servidor_login" class="back-login"><i class="fal fa-arrow-circle-left"></i> VOLTAR AO LOGIN</a> -->
    <div class="row align-items-center justify-content-md-center h-p100">	
      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="bg-white">
              <div class="p-20">
                <span class="prefeitura">
                  <img src="<?= PORTAL_URL ?>assets/images/logo-prefeitura.svg" alt="">
                </span>
                <div class="text-center mb-5">
                  <br><h2 style="color: #000;">Olá, que bom ter você aqui!</h2>
                  <h2 class="servidor">Registre-se</h2><br>
                </div>
                <form id="form_servidor_novo" name="form_servidor_novo" method="post" action="#">
                  <input type="hidden" id="zatu_servidor_id" name="zatu_servidor_id" value="<?= $servidor_zatu_id ;?>">
                  <input type="hidden" id="url_anterior" name="url_anterior" value="<?= $urlanterior ;?>">
                  <div class="text-center mb-5">
                    <h5>Por favor, introduza suas informações de acordo com as fornecidas para o RH. A verificação da sua identidade é necessária para permitir seu acesso ao sistema.</h5>
                  </div>
                  <div id="div_nome" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" id="nome" name="nome" placeholder="Nome" value="" minlength="3" />
                    </div>
                  </div>
                  <div id="div_cpf" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fal fa-id-card"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent cpf_format" id="cpf" name="cpf" placeholder="CPF" value="" minlength="14" />
                    </div>
                  </div>
                  <div id="div_matricula" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fal fa-id-card"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" id="matricula" name="matricula" placeholder="Matrícula" value="" minlength="1" />
                    </div>
                  </div>
                  <div id="div_mae_nome" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" id="mae_mome" name="mae_mome" placeholder="Nome completo da mãe" value="" minlength="3" />
                    </div>
                  </div>
                  <div id="div_email" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-envelope"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" id="email" name="email" placeholder="E-mail" value="" minlength="5" />
                    </div>
                  </div>
                  <div id="div_repetir_email" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-envelope"></i></span>
                      </div>
                      <input type="text" class="form-control pl-15 bg-transparent" id="repetir_email" name="repetir_email" placeholder="Repetir E-mail" value="" minlength="5" />
                    </div>
                  </div>
                  <div id="div_senha" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-lock-alt"></i></span>
                      </div>
                      <input type="password" class="form-control pl-15 bg-transparent" id="senha" name="senha" placeholder="Senha" value="" minlength="6" />
                      <button class="btn" id="togglePass" onclick="showSenha()" type="button"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="help-info mb-15" style="display: none;">
                      Sua senha deve conter de 6 a 32 caracteres.
                      Não pode conter o seus dados pessoais como: nome, cpf ou data de nascimento. 
                      Você pode aumentar a segurança da sua senha usando uma mistura de: Números, 
                      letras (maiúsculas e minúsculas) e caracteres especiais.
                    </div>
                  </div>
                  <div id="div_repetir_senha" class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fal fa-lock-alt"></i></span>
                      </div>
                      <input type="password" class="form-control pl-15 bg-transparent" id="repetir_senha" name="repetir_senha" placeholder="Repetir senha" value="" minlength="6" />
                      <button class="btn" id="togglePassRepete" onclick="showRepeteSenha()" type="button"><i class="fas fa-eye"></i></button>
                    </div>
                    <small id="senhal_help" class="form-text text-muted text-left">Nunca compartilhe sua senha com outros.</small>
                  </div>
                  <div class="col-12">
                    <p class=" text-center">Ao realizar o registro dos seus dados, automaticamente você está aceitando os termos. 
                      <a href="#" data-toggle="modal" data-target="#termos" class="text-danger">Termos de Responsabilidade</a>
                      e 
                      <a href="#" data-toggle="modal" data-target="#tratamento_dados" class="text-danger">Termos de Tratamento de Dados</a>
                    </p>

                  </div>
                  <div class="col-12 text-center">
                    <button class="btn btn-warning mt-10" onclick="window.location= '<?= PORTAL_URL ;?>servidor_login'; return false;">Voltar</button>
                    <button type="submit" class="btn btn-success mt-10">Registrar</button>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="fog-pwd text-center">
                        <a href="<?= PORTAL_URL ?>servidor_login" class="hover-warning"><br><i class="ion ion-locked"></i> Já está registrado? Acesse aqui!</a><br>
                      </div>
                    </div>
                  </div>
                </form>
              </div>						
            </div>
          </div>
        </div>
      </div>
      <div class="servidor-novo">
        &copy; Wessix. Todos os direitos reservados.
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="termos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">TERMO DE RESPONSABILIDADE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Antes de prosseguir o acesso a página de Recadastramento Anual, você deve ler e concordar com os seguintes termos e condições:</p>
          <p>1. Você declara sob as penas da lei que observará as seguintes normas abaixo:</p>
          <ul>
            <li>A senha de acesso aos dados é individual e intransferível;</li>
            <li>Impedir o acesso de terceiros por meio de sua senha;</li>
            <li>Manter o sigilo de sua senha) não dando conhecimento a nenhuma outra pessoa;</li>
            <li>Sair de seu acesso e/ou identificação ao final de cada sessão de consulta/inclusão/alteração;</li>
            <li>Notificar imediatamente ao Órgão Setorial/Subsetorial de Recursos Humanos, quando tomar conhecimento da ocorrência de uso não autorizado de sua senha ou de circunstâncias que
            apontem para a possibilidade de quebra da segurança de sua senha;</li>
            <li>Responsabilizar-se por todas as ações que ocorrerem mediante o uso de sua senha.</li>
          </ul>
          <p>2. Você é responsável pelo uso adequado, dentro dos padrões apropriados para o sistema, estando ciente que através de seu CPF e a SENHA haverá o registro de todo acesso ao sistema de recadastramento, bem como, a identificação, a qualquer tempo, de todas as operações efetuadas.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="tratamento_dados" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">TERMO GERAL DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Este documento visa registrar a manifestação livre, informada e inequívoca pela qual o Titular concorda com o tratamento de seus dados pessoais para finalidade específica, em conformidade com a Lei nº 13.709 – Lei Geral de Proteção de Dados Pessoais (LGPD).
          Ao assinar o presente termo, o Titular consente e concorda que a Prefeitura de Tarauacá, através do SISTEMA ZATU, doravante denominada Controlador, tome decisões referentes ao tratamento de seus dados pessoais, bem como realize o tratamento de seus dados pessoais, envolvendo operações como as que se referem a coleta, produção, recepção, classificação, utilização, acesso, reprodução, transmissão, distribuição, processamento, arquivamento, armazenamento, eliminação, avaliação ou controle da informação, modificação, comunicação, transferência, difusão ou extração, em razão do contrato de trabalho, disponha dos meus dados pessoais e dados pessoais sensíveis, de acordo com os artigos 7° e 11° da Lei n° 13.709/2018, conforme disposto neste termo:</p>
          <p><strong>CLÁUSULA PRIMEIRA</strong></p>
          <p><strong>Dados Pessoais</strong></p>
          <br>
          <p>O Titular autoriza o Controlador a realizar o tratamento, ou seja, a utilizar os seguintes dados pessoais, para os fins que serão relacionados na cláusula segunda:</p>
          <ul>
            <li>Nome completo</li>
            <li>Data de nascimento;</li>
            <li>Número e imagem da Carteira de Identidade (RG);</li>
            <li>Número e imagem do Cadastro de Pessoas Físicas (CPF);</li>
            <li>Número e imagem do Título de Eleitor;</li>
            <li>Número e imagem do Certificado de Reservista;</li>
            <li>Número e imagem da Carteira Nacional de Habilitação (CNH) (quando necessário para a função contratada);</li>
            <li>Número e Imagem do cartão de vale transporte (quando utilizado pelo empregado);</li>
            <li>Número e imagem do Programa de Integração Social (PIS);</li>
            <li>CTPS física e/ou digital;</li>
            <li>Fotografia 3×4;</li>
            <li>Imagem da Certidão de Casamento ou Declaração de União Estável;</li>
            <li>Imagem do Diploma de Graduação (Nível de instrução ou escolaridade);</li>
            <li>Endereço completo;</li>
            <li>Números de telefone, WhatsApp e endereços de e-mail;</li>
            <li>Banco, agência e número de contas bancárias;</li>
            <li>Nome de usuário e senha específicos para uso dos serviços da Controladora;</li>
            <li>Comunicação, verbal e escrita, mantida entre o Titular e o Controlador;</li>
            <li>Exames e atestados médicos, especialmente admissionais, periódicos, incluídos de retorno por afastamento superior a 30 dias em caso de doença, acidente ou parto, de mudança de função, demissionais e ainda aqueles que atestem doença ou acidente;</li>
            <li>Certidão de nascimento dos filhos menores de 14 anos, Carteira de vacinação dos menores de 7 anos, e atestado de matrícula e frequência escolar semestral dos maiores de 4 anos;</li>
            <li>Documentos que sejam inseridos por mim no SISTEMA ZATU que não esteja relacionado acima, por exemplo: Número e Imagem da Carteira Profissional, etc.).</li>
          </ul>

          <p><strong>CLÁUSULA SEGUNDA</strong></p>
          <p><strong>Finalidade do Tratamento dos Dados</strong></p>
          <br>
          <p>O Titular autoriza que a Controladora utilize os dados pessoais e dados pessoais sensíveis listados neste termo para as seguintes finalidades:</p>
          <ul>
            <li>Cumprir as obrigações contratuais com a Prefeitura de Tarauacá, legais e regulatórias do SISTEMA ZATU, em razão de suas atividades;</li>
            <li>Execução de seus Programas e prestação de serviços;</li>
            <li>Realizar a comunicação com a Prefeitura de Tarauacá para fins de atualização cadastral para cumprimento de obrigações decorrentes da legislação trabalhista e previdenciária;</li>
            <li>Para procedimentos de admissão e execução do contrato de trabalho, inclusive após seu término;</li>
            <li>Para cumprimento, pela Controladora, de obrigações impostas por órgãos de fiscalização;</li>
            <li>A pedido do titular dos dados;</li>
            <li>Para o exercício regular de direitos em processo judicial, administrativo ou arbitral;</li>
            <li>Para a proteção da vida ou da incolumidade física do titular ou de terceiros;</li>
            <li>Para a tutela da saúde, exclusivamente, em procedimento realizado por profissionais de saúde, serviços de saúde ou autoridade sanitária;</li>
          </ul>
          <p>Parágrafo Primeiro: Caso seja necessário o compartilhamento de dados com terceiros que não tenham sido relacionados nesse termo ou qualquer alteração contratual posterior, será ajustado novo termo de consentimento para este fim (§ 6° do artigo 8° e § 2° do artigo 9° da Lei n° 13.709/2018).</p>
          <p>Parágrafo Segundo: Em caso de alteração na finalidade, que esteja em desacordo com o consentimento original, a Controladora deverá comunicar o Titular, que poderá revogar o consentimento, conforme previsto na cláusula sexta através dos canais de comunicação da Prefeitura de Tarauacá.</p>

          <p><strong>CLÁUSULA TERCEIRA</strong></p>
          <p><strong>Compartilhamento de Dados</strong></p>

          <p>A Controladora fica autorizada a compartilhar os dados pessoais do Titular com outros agentes de tratamento de dados, caso seja necessário para as finalidades listadas neste instrumento, desde que, sejam respeitados os princípios da boa-fé, finalidade, adequação, necessidade, livre acesso, qualidade dos dados, transparência, segurança, prevenção, não discriminação e responsabilização e prestação de contas.</p>

          <p><strong>CLÁUSULA QUARTA</strong></p>
          <p><strong>Responsabilidade pela Segurança dos Dados</strong></p>

          <p>A Controladora se responsabiliza por manter medidas de segurança, técnicas e administrativas suficientes a proteger os dados pessoais do Titular e à Autoridade Nacional de Proteção de Dados (ANPD), comunicando ao Titular, caso ocorra algum incidente de segurança que possa acarretar risco ou dano relevante, conforme artigo 48 da Lei n° 13.709/2020.</p>

          <p><strong>CLÁUSULA QUINTA</strong></p>
          <p><strong>Término do Tratamento dos Dados</strong></p>

          <p>À Controladora, é permitido manter e utilizar os dados pessoais do Titular durante todo o período contratualmente firmado com a Prefeitura de Tarauacá para as finalidades relacionadas nesse termo e ainda após o término da contratação para cumprimento de obrigação legal ou impostas por órgãos de fiscalização, nos termos do artigo 16 da Lei n° 13.709/2018.</p>

          <p><strong>CLÁUSULA SEXTA</strong></p>
          <p><strong>Direito de Revogação do Consentimento</strong></p>

          <p>O Titular poderá revogar seu consentimento, a qualquer tempo, por e-mail ou por carta escrita, conforme o artigo 8°, § 5°, da Lei n° 13.709/2020.</p>
          <p>O Titular fica ciente de que a Controladora poderá permanecer utilizando os dados para as seguintes finalidades:</p>
          <ul>
            <li>Para cumprimento de obrigações decorrentes da legislação trabalhista e previdenciária, incluindo o disposto em Acordo ou Convenção Coletiva da categoria da Controladora;</li>
            <li>Para procedimentos de admissão e execução do contrato de trabalho, inclusive após seu término;</li>
            <li>Para cumprimento, pela Controladora, de obrigações impostas por órgãos de fiscalização;</li>
            <li>Para o exercício regular de direitos em processo judicial, administrativo ou arbitral;</li>
            <li>Para a proteção da vida ou da incolumidade física do titular ou de terceiros;</li>
            <li>Para a tutela da saúde, exclusivamente, em procedimento realizado por profissionais de saúde, serviços de saúde ou autoridade sanitária;</li>
            <li>Quando necessário para atender aos interesses legítimos do controlador ou de terceiros, exceto no caso de prevalecerem direitos e liberdades fundamentais do titular que exijam a proteção dos dados pessoais.</li>
          </ul>

          <p><strong>CLÁUSULA SÉTIMA</strong></p>
          <p><strong>Tempo de Permanência dos Dados Recolhidos</strong></p>

          <p>O titular fica ciente de que a Controladora deverá permanecer com os seus dados pelo período mínimo de guarda de documentos trabalhistas, previdenciários, bem como os relacionados à segurança e saúde no trabalho, mesmo após o encerramento do vínculo empregatício.</p>

          <p><strong>CLÁUSULA OITAVA</strong></p>
          <p><strong>Vazamento de Dados ou Acessos Não Autorizados – Penalidades</strong></p>

          <p>As partes poderão entrar em acordo, quanto aos eventuais danos causados, caso exista o vazamento de dados pessoais ou acessos não autorizados, e caso não haja acordo, a Controladora tem ciência que estará sujeita às penalidades previstas no artigo 52 da Lei n° 13.709/2018</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<!-- JAVASCRIPT PLUGINS BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>vendors.min.js"></script>
<script type="text/javascript" src="<?= ICONS_FOLDER; ?>feather-icons/feather.min.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>livequery-1.3.6/livequery.min.js"></script>
<script type="text/javascript" src="<?= ASSETS_FOLDER; ?>vendor_components/select2/dist/js/select2.full.js"></script>
<script type="text/javascript" src="<?= PLUGINS_FOLDER; ?>jquery-mask-1.14/jquery.mask.js"></script>
<!-- JAVASCRIPT UTILS BEGIN -->
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>projeto.utils.js"></script>
<script type="text/javascript" src="<?= UTILS_FOLDER; ?>utils.js"></script>
<!-- JAVASCRIPT UTILS END -->
<!-- JAVASCRIPT CUSTON BEGIN -->
<script type="text/javascript" src="<?= JS_FOLDER; ?>servidor_novo.js"></script>
  <!-- JAVASCRIPT CUSTON END -->