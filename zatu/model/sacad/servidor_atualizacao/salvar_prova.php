<?php
$db                   = Conexao::getInstance();
$id                   = strip_tags(@$_POST['servidor_atualizacao_prova_id_s']);
$atualizacaoId        = strip_tags(@$_POST['id']);
$provaInstrucaoId     = @$_POST['prova_instrucao_id'];
$provaDependenteId    = @$_POST['prova_dependente_id'];
$provaVinculoId       = @$_POST['prova_vinculo_id'];
$arquivos             = @$_FILES;
$status               = 1;

$arquivosGerais       = array();
$arquivosInstrucoes   = array();
$arquivosDependentes  = array();
$arquivosVinculos     = array();
$retorno              = array();
$error = false;

foreach ($arquivos as $kArquivo => $vArquivo) {
  $arquivosGerais[$kArquivo]['arquivoNome'] = '';
  $arquivoNome = '';
  $erro = false;
  $existe = false;
  foreach ($vArquivo['name'] as $kArquivoSub => $vArquivoSub) {
    $retornoArquivo = salvarArquivo($vArquivo['error'][$kArquivoSub], basename($vArquivo["name"][$kArquivoSub]), $vArquivo["tmp_name"][$kArquivoSub]);
    if ($retornoArquivo['existe']) {
      if (!$retornoArquivo['erro']) {
        $gerais = true;
        foreach ($provaInstrucaoId as $kProvaInstruacaoId => $vProvaInstruacaoId) {
          if ($kArquivo == 'prova_instrucao_'. $vProvaInstruacaoId) {
            $gerais = false;
            if ($kArquivoSub == 0) {
              $arquivosInstrucoes[$kArquivo]['instrucaoAtualizacaoId'] = strip_tags($vProvaInstruacaoId);
              $arquivosInstrucoes[$kArquivo]['arquivoNome'] = $retornoArquivo['arquivoNome'];
            } else {
              $arquivosInstrucoes[$kArquivo]['arquivoNome'] = $arquivosInstrucoes[$kArquivo]['arquivoNome'] . '#&#' . $retornoArquivo['arquivoNome'];
            }
          }
        }
        foreach ($provaDependenteId as $kProvaDependenteId => $vProvaDependenteId) {
          if ($kArquivo == 'prova_dependente_'. $vProvaDependenteId) {
            $gerais = false;
            if ($kArquivoSub == 0) {
              $arquivosDependentes[$kArquivo]['dependenteAtualizacaoId'] = strip_tags($vProvaDependenteId);
              $arquivosDependentes[$kArquivo]['arquivoNome'] = $retornoArquivo['arquivoNome'];
            } else {
              $arquivosDependentes[$kArquivo]['arquivoNome'] = $arquivosDependentes[$kArquivo]['arquivoNome'] . '#&#' . $retornoArquivo['arquivoNome'];
            }
          }
        }
        foreach ($provaVinculoId as $kProvaVinculoId => $vProvaVinculoId) {
          if ($kArquivo == 'prova_vinculo_'. $vProvaVinculoId) {
            $gerais = false;
            if ($kArquivoSub == 0) {
              $arquivosVinculos[$kArquivo]['instrucaoAtualizacaoId'] = strip_tags($vProvaVinculoId);
              $arquivosVinculos[$kArquivo]['arquivoNome'] = $retornoArquivo['arquivoNome'];
            } else {
              $arquivosVinculos[$kArquivo]['arquivoNome'] = $arquivosVinculos[$kArquivo]['arquivoNome'] . '#&#' . $retornoArquivo['arquivoNome'];
            }
          }
        }
        if ($gerais) {
          if ($kArquivoSub == 0) {
            $arquivosGerais[$kArquivo]['arquivoNome'] = $retornoArquivo['arquivoNome'];
          } else {
            $arquivosGerais[$kArquivo]['arquivoNome'] = $arquivosGerais[$kArquivo]['arquivoNome'] . '#&#' . $retornoArquivo['arquivoNome'];
          }
        }
      } else {
        $retorno['msg'] = 'error';
      }
    }
  }
}

try {
  $detalhe['gerais'] = array();
  $detalhe['instrucoes'] = array();
  $detalhe['dependentes'] = array();
  $detalhe['vinculos'] = array();
  $db->beginTransaction();
  if (is_numeric($id) && $id == "" || $id == 0 ) {
    $stmt = $db->prepare('
      INSERT INTO sacad_servidor_atualizacao_prova 
      (prova_pessoal, 
        prova_naturalidade, 
        prova_situacao_trabalho, 
        prova_situacao_trabalho_2, 
        prova_covid_vacina, 
        prova_enfermidade, 
        prova_end, 
        prova_rg, 
        prova_pis, 
        prova_ctps, 
        prova_eleitor, 
        prova_reg_militar, 
        prova_reg_prof, 
        prova_cnh, 
        prova_rne, 
        prova_fgts, 
        prova_reg_civil, 
        prova_averbacao, 
        prova_bancario, 
        status, 
        sacad_servidor_atualizacao_id, 
        dt_cadastro) 
      VALUES
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());');
    $stmt->bindValue(1, $arquivosGerais['prova_pessoal']['arquivoNome']);
    $stmt->bindValue(2, '');
    // $stmt->bindValue(2, $arquivosGerais['prova_naturalidade']['arquivoNome']);
    $stmt->bindValue(3, '');
    // $stmt->bindValue(3, $arquivosGerais['prova_sit_trabalho']['arquivoNome']);
    $stmt->bindValue(4, '');
    // $stmt->bindValue(4, $arquivosGerais['prova_sit_trabalho_2']['arquivoNome']);
    $stmt->bindValue(5, $arquivosGerais['prova_covid_vacina']['arquivoNome']);
    $stmt->bindValue(6, $arquivosGerais['prova_enfermidade']['arquivoNome']);
    $stmt->bindValue(7, $arquivosGerais['prova_end']['arquivoNome']);
    $stmt->bindValue(8, $arquivosGerais['prova_rg']['arquivoNome']);
    $stmt->bindValue(9, $arquivosGerais['prova_pis']['arquivoNome']);
    $stmt->bindValue(10, $arquivosGerais['prova_ctps']['arquivoNome']);
    $stmt->bindValue(11, $arquivosGerais['prova_eleitor']['arquivoNome']);
    $stmt->bindValue(12, $arquivosGerais['prova_reg_militar']['arquivoNome']);
    $stmt->bindValue(13, $arquivosGerais['prova_reg_prof']['arquivoNome']);
    $stmt->bindValue(14, $arquivosGerais['prova_cnh']['arquivoNome']);
    $stmt->bindValue(15, $arquivosGerais['prova_rne']['arquivoNome']);
    $stmt->bindValue(16, '');
    // $stmt->bindValue(16, $arquivosGerais['prova_fgts']['arquivoNome']);
    $stmt->bindValue(17, $arquivosGerais['prova_reg_civil']['arquivoNome']);
    $stmt->bindValue(18, $arquivosGerais['prova_averbacao']['arquivoNome']);
    $stmt->bindValue(19, $arquivosGerais['prova_bancario']['arquivoNome']);
    $stmt->bindValue(20, $status);
    $stmt->bindValue(21, $atualizacaoId);
    $stmt->execute();
    $provaGeralIdNew = $db->lastInsertId();
    $detalhe['gerais']['id'] = $provaGeralIdNew;
    $detalhe['gerais']['msg']     = 'success';
    $detalhe['gerais']['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  } else {
    $stmt = $db->prepare('
      SELECT  
      prova_pessoal, 
      prova_naturalidade, 
      prova_situacao_trabalho, 
      prova_situacao_trabalho_2, 
      prova_covid_vacina, 
      prova_enfermidade, 
      prova_end, 
      prova_rg, 
      prova_pis, 
      prova_ctps, 
      prova_eleitor, 
      prova_reg_militar, 
      prova_reg_prof, 
      prova_cnh, 
      prova_rne, 
      prova_fgts, 
      prova_reg_civil, 
      prova_averbacao, 
      prova_bancario, 
      status, 
      sacad_servidor_atualizacao_id  
      FROM sacad_servidor_atualizacao_prova 
      WHERE id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $rsProvasGeraisOld = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach ($arquivosGerais as $kObj => $vObj) {
      if ($vObj['arquivoNome'] == '' && $rsProvasGeraisOld[$kObj] != '') {
        $arquivosGerais[$kObj]['arquivoNome'] = $rsProvasGeraisOld[$kObj];
      }
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao_prova
      SET  
      prova_pessoal = ?, 
      prova_naturalidade = ?, 
      prova_situacao_trabalho = ?, 
      prova_situacao_trabalho_2 = ?, 
      prova_covid_vacina = ?, 
      prova_enfermidade = ?, 
      prova_end = ?, 
      prova_rg = ?, 
      prova_pis = ?, 
      prova_ctps = ?, 
      prova_eleitor = ?, 
      prova_reg_militar = ?, 
      prova_reg_prof = ?, 
      prova_cnh = ?, 
      prova_rne = ?, 
      prova_fgts = ?, 
      prova_reg_civil = ?, 
      prova_averbacao = ?, 
      prova_bancario = ?, 
      status = ?, 
      dt_cadastro = NOW()
      WHERE id = ?;');
    $stmt->bindValue(1, $arquivosGerais['prova_pessoal']['arquivoNome']);
    $stmt->bindValue(2, '');
    // $stmt->bindValue(2, $arquivosGerais['prova_naturalidade']['arquivoNome']);
    $stmt->bindValue(3, '');
    // $stmt->bindValue(3, $arquivosGerais['prova_sit_trabalho']['arquivoNome']);
    $stmt->bindValue(4, '');
    // $stmt->bindValue(4, $arquivosGerais['prova_sit_trabalho_2']['arquivoNome']);
    $stmt->bindValue(5, $arquivosGerais['prova_covid_vacina']['arquivoNome']);
    $stmt->bindValue(6, $arquivosGerais['prova_enfermidade']['arquivoNome']);
    $stmt->bindValue(7, $arquivosGerais['prova_end']['arquivoNome']);
    $stmt->bindValue(8, $arquivosGerais['prova_rg']['arquivoNome']);
    $stmt->bindValue(9, $arquivosGerais['prova_pis']['arquivoNome']);
    $stmt->bindValue(10, $arquivosGerais['prova_ctps']['arquivoNome']);
    $stmt->bindValue(11, $arquivosGerais['prova_eleitor']['arquivoNome']);
    $stmt->bindValue(12, $arquivosGerais['prova_reg_militar']['arquivoNome']);
    $stmt->bindValue(13, $arquivosGerais['prova_reg_prof']['arquivoNome']);
    $stmt->bindValue(14, $arquivosGerais['prova_cnh']['arquivoNome']);
    $stmt->bindValue(15, $arquivosGerais['prova_rne']['arquivoNome']);
    $stmt->bindValue(16, '');
    // $stmt->bindValue(16, $arquivosGerais['prova_fgts']['arquivoNome']);
    $stmt->bindValue(17, $arquivosGerais['prova_reg_civil']['arquivoNome']);
    $stmt->bindValue(18, $arquivosGerais['prova_averbacao']['arquivoNome']);
    $stmt->bindValue(19, $arquivosGerais['prova_bancario']['arquivoNome']);
    $stmt->bindValue(20, $status);
    $stmt->bindValue(21, $id);
    $stmt->execute();
    $detalhe['gerais']['id']      = $id;
    $detalhe['gerais']['msg']     = 'success';
    $detalhe['gerais']['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  }
  //SALVAR INSTRUCAO
  foreach ($arquivosInstrucoes as $kInstrucao => $vInstrucao) {
    $stmt = $db->prepare('
      SELECT  
      prova_instrucao, 
      status, 
      sacad_servidor_atualizacao_id 
      FROM sacad_servidor_atualizacao_instrucao 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;');
    $stmt->bindValue(1, $vInstrucao['instrucaoAtualizacaoId']);
    $stmt->execute();
    $rsProvasInstrucoesOld = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach ($arquivosInstrucoes as $kObj => $vObj) {
      if ($vObj == '' && $rsProvasInstrucoesOld[$kObj] != '') {
        $arquivosInstrucoes[$kObj] = $rsProvasInstrucoesOld[$kObj];
      }
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao_instrucao
      SET  
      prova_instrucao = ?,  
      status = ?, 
      dt_cadastro = NOW()
      WHERE id = ?;');
    $stmt->bindValue(1, $vInstrucao['arquivoNome']);
    $stmt->bindValue(2, $status);
    $stmt->bindValue(3, $vInstrucao['instrucaoAtualizacaoId']);
    $stmt->execute();
    //MENSAGEM DE SUCESSO
    $detalhe['instrucoes']['msg']     = 'success';
    $detalhe['instrucoes']['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  }
  //SALVAR DEPENDENTE
  foreach ($arquivosDependentes as $kDependente => $vDependente) {
    $stmt = $db->prepare('
      SELECT  
      prova_dependente, 
      status, 
      sacad_servidor_atualizacao_id 
      FROM sacad_servidor_atualizacao_dependente 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;');
    $stmt->bindValue(1, $vDependente['dependenteAtualizacaoId']);
    $stmt->execute();
    $rsProvasDependentesOld = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach ($arquivosDependentes as $kObj => $vObj) {
      if ($vObj == '' && $rsProvasDependentesOld[$kObj] != '') {
        $arquivosDependentes[$kObj] = $rsProvasDependentesOld[$kObj];
      }
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao_dependente
      SET  
      prova_dependente = ?,  
      status = ?, 
      dt_cadastro = NOW()
      WHERE id = ?;');
    $stmt->bindValue(1, $vDependente['arquivoNome']);
    $stmt->bindValue(2, $status);
    $stmt->bindValue(3, $vDependente['dependenteAtualizacaoId']);
    $stmt->execute();
    //MENSAGEM DE SUCESSO
    $detalhe['dependentes']['msg']     = 'success';
    $detalhe['dependentes']['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  }
  //SALVAR VINCULO
  foreach ($arquivosVinculos as $kVinculo => $vVinculo) {
    $stmt = $db->prepare('
      SELECT  
      prova_vinculo, 
      status, 
      sacad_servidor_atualizacao_id 
      FROM sacad_servidor_atualizacao_vinculo 
      WHERE sacad_servidor_atualizacao_id = ? 
      ORDER BY id ASC;');
    $stmt->bindValue(1, $vVinculo['vinculoAtualizacaoId']);
    $stmt->execute();
    $rsProvasVinculosOld = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach ($arquivosVinculos as $kObj => $vObj) {
      if ($vObj == '' && $rsProvasVinculosOld[$kObj] != '') {
        $arquivosVinculos[$kObj] = $rsProvasVinculosOld[$kObj];
      }
    }
    $stmt = $db->prepare('
      UPDATE sacad_servidor_atualizacao_vinculo
      SET  
      prova_vinculo = ?, 
      status = ?, 
      dt_cadastro = NOW()
      WHERE id = ?;');
    $stmt->bindValue(1, $vVinculo['arquivoNome']);
    $stmt->bindValue(2, $status);
    $stmt->bindValue(3, $vVinculo['vinculoAtualizacaoId']);
    $stmt->execute();
    //MENSAGEM DE SUCESSO
    $detalhe['vinculos']['msg']     = 'success';
    $detalhe['vinculos']['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  }
  $db->commit();
  $retorno['msg']     = 'success';
  $retorno['retorno'] = 'Comprovantes de atualizações do servidor cadastrados com sucesso.';
  $retorno['detalhe'] = $detalhe;
  echo json_encode($retorno);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $retorno['msg'] = 'error';
  $retorno['retorno'] = "Erro ao tentar salvar os comprovantes de atualizações do servidor: +" . $e->getMessage();
  echo json_encode($retorno);
  exit();
}

function salvarArquivo($error, $nome, $tmp_nome) {
  // $tiposPermitidos = array('pdf', 'jpg', 'png', 'jpeg', 'mov'); 
  $tiposPermitidos = array('pdf'); 
  $pastaDestino = 'assets/atualizacao_provas/';
  $arquivoNome = '';
  $erro = false;
  $existe = false;
  $message = '';
  if ($error === UPLOAD_ERR_OK) {
    $existe = true;
    $dateNow = new DateTime();
    $arquivoTipo = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $arquivoNomeGravar = uniqid(rand(), true) . '-' . $dateNow->format('YmdHis') . '.' . $arquivoTipo;
    $caminhoArquivoGravar = $pastaDestino . $arquivoNomeGravar;
    if(in_array($arquivoTipo, $tiposPermitidos)){ 
      if(move_uploaded_file($tmp_nome, $caminhoArquivoGravar)){ 
        $arquivoNome = $arquivoNomeGravar;
      }else{ 
        $erro = true;
        $message = 'Desculpe, Ocorreu um erro ao enviar seu arquivo.'; 
      } 
    }else{ 
      $erro = true;
      $message = 'Desculpe, apenas arquivos PDF têm permissão para serem enviados.'; 
    }
  } else {
    $erro = true;
    $existe = false;
    switch ($error) {
      case UPLOAD_ERR_INI_SIZE:
      $message = 'O arquivo enviado excede a diretiva upload_max_filesize em php.ini';
      break;
      case UPLOAD_ERR_FORM_SIZE:
      $message = 'O arquivo enviado excede a diretiva MAX_FILE_SIZE que foi especificada no formulário HTML';
      break;
      case UPLOAD_ERR_PARTIAL:
      $message = 'O arquivo carregado foi carregado apenas parcialmente';
      break;
      case UPLOAD_ERR_NO_FILE:
      $message = 'Nenhum arquivo foi enviado';
      break;
      case UPLOAD_ERR_NO_TMP_DIR:
      $message = 'Faltando uma pasta temporária';
      break;
      case UPLOAD_ERR_CANT_WRITE:
      $message = 'Falha ao gravar arquivo no disco';
      break;
      case UPLOAD_ERR_EXTENSION:
      $message = 'Upload de arquivo interrompido por extensão';
      break;
      default:
      $message = 'Erro de upload desconhecido';
    }
  }
  return array('arquivoNome' => $arquivoNome, 'erro' => $erro, 'existe' => $existe, 'mensagem' => $message);
}
?>