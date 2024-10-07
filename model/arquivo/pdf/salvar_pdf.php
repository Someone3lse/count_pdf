<?php
$db                   = Conexao::getInstance();
//$atualizacaoId        = strip_tags(@$_POST['id']);
//$provaInstrucaoId     = @$_POST['prova_instrucao_id'];
$arquivos             = @$_FILES;
// $status               = 1;
$arquivosGerais       = array();
$error                = false;
$mensagem             = '';

foreach ($arquivos['name'] as $kArquivo => $vArquivo) {
  $nomeReal = basename($vArquivo);
  $retornoArquivo = salvarArquivo($arquivos['error'][$kArquivo], $nomeReal, $arquivos["tmp_name"][$kArquivo]);
  if ($retornoArquivo['existe']) {
    if (!$retornoArquivo['erro']) {
      $arquivosGerais[$kArquivo]['nome']       = $nomeReal;
      $arquivosGerais[$kArquivo]['nomeFisico'] = $retornoArquivo['arquivoNome'];
      $arquivosGerais[$kArquivo]['tamanho']    = $arquivos['size'][$kArquivo];
      $arquivosGerais[$kArquivo]['qtdPag']     = 10;
    } else {
      $arquivosGerais[$kArquivo]['erro'] = true;
      $arquivosGerais[$kArquivo]['mensagem'] = $retornoArquivo['mensagem'];
    }
  }
}
echo json_encode($arquivosGerais);
exit();
try {
  $db->beginTransaction();
  if (!$error) {
    foreach ($arquivosGerais as $kArquivo => $vArquivo) {
      $stmt = $db->prepare('
      INSERT INTO arquivo 
      (nome, 
        nome_fisico, 
        tamanho, 
        qtd_pag, 
        status,  
        dt_cadastro) 
      VALUES
      (?, ?, ?, ?, ?, NOW());');
      $stmt->bindValue(1, $vArquivo['nome']);
      $stmt->bindValue(2, $vArquivo['nomeFisico']);
      $stmt->bindValue(3, $vArquivo['tamanho']);
      $stmt->bindValue(4, $vArquivo['qtdPag']);
      $stmt->bindValue(5, 1);
      $stmt->execute();
      $arquivosGerais[$kArquivo]['id']      = $db->lastInsertId();
      $arquivosGerais[$kArquivo]['msg']     = 'success';
      $arquivosGerais[$kArquivo]['retorno'] = 'Arquivo enviado com sucesso.';
    }
  }
  $db->commit();
  $retorno['msg']     = 'success';
  $retorno['retorno'] = 'Arquivos enviados com sucesso.';
  echo json_encode($retorno);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $retorno['msg'] = 'error';
  $retorno['retorno'] = "Erro ao tentar enviar os arquivos: +" . $e->getMessage();
  echo json_encode($retorno);
  exit();
}

function salvarArquivo($error, $nome, $tmp_nome) {
  // $tiposPermitidos = array('pdf', 'jpg', 'png', 'jpeg', 'mov'); 
  $tiposPermitidos = array('pdf'); 
  $pastaDestino = 'uploads/';
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