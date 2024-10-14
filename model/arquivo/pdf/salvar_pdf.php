<?php
use \setasign\Fpdi\Fpdi;
require_once('assets/plugins/fpdf186/fpdf.php');
require_once('assets/plugins/fpdi2_6_1/src/autoload.php');

$db                   = Conexao::getInstance();
$arquivos             = @$_FILES;
$arquivosGerais       = array();
$error                = false;
$mensagem             = "";
$pastaDestino         = "uploads/";
foreach ($arquivos as $kArquivo => $vArquivo) {
  foreach ($vArquivo['name'] as $kArquivoSub => $vArquivoSub) {
    $nomeReal = basename($vArquivoSub);
    $retornoArquivo = salvarArquivo($vArquivo["error"][$kArquivoSub], $nomeReal, $vArquivo["tmp_name"][$kArquivoSub]);
    $arquivosGerais[$kArquivoSub]["retorno"] = $retornoArquivo;
    if ($retornoArquivo["existe"]) {
      if (!$retornoArquivo["erro"]) {
        $document = new Fpdi();
        $pageCount = $document->setSourceFile($GLOBALS["pastaDestino"].$retornoArquivo["arquivoNome"]);
        $document->close();
        $arquivosGerais[$kArquivoSub]["nome"]       = $nomeReal;
        $arquivosGerais[$kArquivoSub]["nomeFisico"] = $retornoArquivo["arquivoNome"];
        $arquivosGerais[$kArquivoSub]["tamanho"]    = $vArquivo["size"][$kArquivoSub];
        $arquivosGerais[$kArquivoSub]["qtdPag"]     = $pageCount;
        $arquivosGerais[$kArquivoSub]["erro"]       = false;
        $arquivosGerais[$kArquivoSub]["mensagem"]   = "sucesso";
      } else {
        $arquivosGerais[$kArquivoSub]["erro"]       = true;
        $arquivosGerais[$kArquivoSub]["mensagem"]   = $retornoArquivo["mensagem"];
      }
    }
  }
}
try {
  $db->beginTransaction();
  if (!$error) {
    foreach ($arquivosGerais as $kArquivo => $vArquivo) {
      $stmt = $db->prepare("
      INSERT INTO arquivo 
      (nome, 
        nome_fisico, 
        tamanho, 
        qtd_pag, 
        status,  
        dt_cadastro) 
      VALUES
      (?, ?, ?, ?, ?, NOW());");
      $stmt->bindValue(1, $vArquivo["nome"]);
      $stmt->bindValue(2, $vArquivo["nomeFisico"]);
      $stmt->bindValue(3, $vArquivo["tamanho"]);
      $stmt->bindValue(4, $vArquivo["qtdPag"]);
      $stmt->bindValue(5, 1);
      $stmt->execute();
      $arquivosGerais[$kArquivo]["id"]      = $db->lastInsertId();
      $arquivosGerais[$kArquivo]["msg"]     = "success";
      $arquivosGerais[$kArquivo]["retorno"] = "Arquivo enviado com sucesso.";
    }
  }
  $db->commit();
  $retorno["msg"]     = "success";
  $retorno["retorno"] = "Arquivos enviados com sucesso.";
  echo json_encode($retorno);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $retorno["msg"] = "error";
  $retorno["retorno"] = "Erro ao tentar enviar os arquivos: +" . $e->getMessage();
  echo json_encode($retorno);
  exit();
}

function salvarArquivo($error, $nome, $tmp_nome) {
  // $tiposPermitidos = array("pdf", "jpg", "png", "jpeg", "mov"); 
  $tiposPermitidos = array("pdf"); 
  $arquivoNome = "";
  $erro = false;
  $existe = false;
  $message = "";
  if ($error === UPLOAD_ERR_OK) {
    $existe = true;
    $dateNow = new DateTime();
    $arquivoTipo = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $arquivoNomeGravar = uniqid(rand(), true) . "-" . $dateNow->format("YmdHis") . "." . $arquivoTipo;
    $caminhoArquivoGravar = $GLOBALS["pastaDestino"] . $arquivoNomeGravar;
    if(in_array($arquivoTipo, $tiposPermitidos)){ 
      if(move_uploaded_file($tmp_nome, $caminhoArquivoGravar)){ 
        $arquivoNome = $arquivoNomeGravar;
      }else{ 
        $erro = true;
        $message = "Desculpe, Ocorreu um erro ao enviar seu arquivo."; 
      } 
    }else{ 
      $erro = true;
      $message = "Desculpe, apenas arquivos PDF têm permissão para serem enviados."; 
    }
  } else {
    $erro = true;
    $existe = false;
    switch ($error) {
      case UPLOAD_ERR_INI_SIZE:
      $message = "O arquivo enviado excede a diretiva upload_max_filesize em php.ini";
      break;
      case UPLOAD_ERR_FORM_SIZE:
      $message = "O arquivo enviado excede a diretiva MAX_FILE_SIZE que foi especificada no formulário HTML";
      break;
      case UPLOAD_ERR_PARTIAL:
      $message = "O arquivo carregado foi carregado apenas parcialmente";
      break;
      case UPLOAD_ERR_NO_FILE:
      $message = "Nenhum arquivo foi enviado";
      break;
      case UPLOAD_ERR_NO_TMP_DIR:
      $message = "Faltando uma pasta temporária";
      break;
      case UPLOAD_ERR_CANT_WRITE:
      $message = "Falha ao gravar arquivo no disco";
      break;
      case UPLOAD_ERR_EXTENSION:
      $message = "Upload de arquivo interrompido por extensão";
      break;
      default:
      $message = "Erro de upload desconhecido";
    }
  }
  return array("arquivoNome" => $arquivoNome, "erro" => $erro, "existe" => $existe, "mensagem" => $message);
}
?>