<?php
$db                           = Conexao::getInstance();
$id                           = $_POST['dependente_id_s'];
$servidorId                   = strip_tags(@$_POST['id']);
$codigo                       = $_POST['dependente_codigo_s'];
$nome                         = $_POST['dependente_nome_s'];
$cpf                          = $_POST['dependente_cpf_s'];
$ParentescoGrauId             = $_POST['dependente_parent_grau_s'];
$ParentescoGrauOutro          = $_POST['dependente_parent_grau_outro_s'];
$dtNascimento                 = $_POST['dependente_dt_nasc_s'];
$dtCasamento                  = $_POST['dependente_dt_casamento_s'];
$benefAutos                   = $_POST['dependente_benef_autos_s'];
$benefRgNum                   = $_POST['dependente_benef_rg_numero_s'];
$benefRgDtEmis                = $_POST['dependente_benef_rg_dt_emissao_s'];
$benefRgOrgaoEx               = $_POST['dependente_benef_rg_orgao_expedidor_s'];
$benefTelRes                  = $_POST['dependente_benef_tel_res_s'];
$benefTelCel                  = $_POST['dependente_benef_tel_cel_s'];
$benefEndLog                  = $_POST['dependente_benef_end_log_s'];
$benefEndNum                  = $_POST['dependente_benef_end_num_s'];
$benefEndComp                 = $_POST['dependente_benef_end_comp_s'];
$benefEndBairro               = $_POST['dependente_benef_end_bairro_s'];
$benefEndCep                  = $_POST['dependente_benef_end_cep_s'];
$benefEndMunic                = $_POST['dependente_benef_end_municipio_s'];
$benefContaTipo               = $_POST['dependente_benef_banco_conta_tipo_s'];
$benefBanco                   = $_POST['dependente_benef_banco_s'];
$benefBancoAgencia            = $_POST['dependente_benef_bancario_agencia_s'];
$benefBancoConta              = $_POST['dependente_benef_bancario_conta_s'];
$benefBancoOp                 = $_POST['dependente_benef_bancario_op_s'];
$benefRepresNome              = $_POST['dependente_benef_repres_nome_s'];
$benefRepresCpf               = $_POST['dependente_benef_repres_cpf_s'];
$benefRepresRgNum             = $_POST['dependente_benef_repres_rg_numero_s'];
$benefRepresRgDtEmis          = $_POST['dependente_benef_repres_rg_dt_emissao_s'];
$benefRepresRgOrgaoEx         = $_POST['dependente_benef_repres_rg_orgao_expedidor_s'];
$benefRepresTelRes            = $_POST['dependente_benef_repres_tel_res_s'];
$benefRepresTelCel            = $_POST['dependente_benef_repres_tel_cel_s'];
$benefRepresEndLog            = $_POST['dependente_benef_repres_end_log_s'];
$benefRepresEndNum            = $_POST['dependente_benef_repres_end_num_s'];
$benefRepresEndComp           = $_POST['dependente_benef_repres_end_comp_s'];
$benefRepresEndBairro         = $_POST['dependente_benef_repres_end_bairro_s'];
$benefRepresEndCep            = $_POST['dependente_benef_repres_end_cep_s'];
$benefRepresEndMunic          = $_POST['dependente_benef_repres_end_municipio_s'];
// $Cursando                     = $_POST['instrucao_cursando_s'];
$status                       = 1;
// $status                       = strip_tags(@$_POST['status_s']) == "on" ? 1 : 0;
$error                        = false;
$msg                          = array();
$mensagem                     = "";
$ids                          = array();
try {
  $db->beginTransaction();
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  // $id_nome = pesquisar("id", "bsc_unidade_organizacional_tipo", "nome", "LIKE", $nome, "");
  if (is_numeric($servidorId) && $servidorId != "" && $servidorId != 0 ) {
    $stmt = $db->prepare('
      SELECT id 
      FROM rh_servidor_dependente 
      WHERE rh_servidor_id = ? 
      ORDER BY UPPER(id)');
    $stmt->bindValue(1, $servidorId);
    $stmt->execute();
    $rsDependentesOld = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsDependentesOld as $kDependenteOld => $vDependenteOld) {
      if (!in_array($vDependenteOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE  
          FROM rh_servidor_dependente 
          WHERE id = ?');
        $stmt->bindValue(1, $vDependenteOld['id']);
        $stmt->execute();
      }
    }
    if (sizeof($id) > 0){
      foreach ($id as $kId => $vId) {
        if (is_numeric($vId) && $vId != "" && $vId != 0 ) {
          $stmt = $db->prepare('
            UPDATE rh_servidor_dependente 
            SET
            rh_servidor_id = ?, 
            codigo = ?, 
            nome = ?, 
            cpf = ?, 
            bsc_parentesco_grau_id = ?, 
            parentesco_grau_outro = ?, 
            dt_nascimento = ?, 
            dt_casamento = ?, 
            status = ?, 
            benef_rg_numero = ?, 
            benef_rg_dt_emissao = ?, 
            benef_rg_orgao_expedidor = ?, 
            benef_tel_residencial = ?, 
            benef_tel_celular = ?, 
            benef_end_cep = ?, 
            benef_end_logradouro = ?, 
            benef_end_numero = ?, 
            benef_end_complemento = ?, 
            benef_end_bairro = ?, 
            benef_bsc_municipio_id = ?, 
            benef_autos_numero = ?, 
            benef_bsc_banco_conta_tipo_id = ?, 
            benef_bsc_banco_id = ?, 
            benef_bancario_agencia = ?, 
            benef_bancario_conta = ?, 
            benef_bancario_op = ?, 
            benef_repres_nome = ?, 
            benef_repres_cpf = ?, 
            benef_repres_rg_numero = ?, 
            benef_repres_rg_dt_emissao = ?, 
            benef_repres_rg_orgao_expedidor = ?, 
            benef_repres_end_cep = ?, 
            benef_repres_end_logradouro = ?, 
            benef_repres_end_numero = ?, 
            benef_repres_end_complemento = ?, 
            benef_repres_end_bairro = ?, 
            benef_repres_bsc_municipio_id = ?, 
            benef_repres_tel_residencial = ?, 
            benef_repres_tel_celular = ?, 
            dt_cadastro = NOW(), 
            seg_usuario_id = ? 
            WHERE id = ?;');
          $stmt->bindValue(1, $servidorId);
          $stmt->bindValue(2, strip_tags($codigo[$kId]));
          $stmt->bindValue(3, strip_tags($nome[$kId]));
          $stmt->bindValue(4, strip_tags($cpf[$kId]));
          $stmt->bindValue(5, $ParentescoGrauId[$kId] != '' ? strip_tags($ParentescoGrauId[$kId]) : NULL);
          $stmt->bindValue(6, strip_tags($ParentescoGrauOutro[$kId]));
          $stmt->bindValue(7, formata_data(strip_tags($dtNascimento[$kId])));
          $stmt->bindValue(8, formata_data(strip_tags($dtCasamento[$kId])));
          $stmt->bindValue(9, $status);
          $stmt->bindValue(10, strip_tags($benefRgNum[$kId]));
          $stmt->bindValue(11, formata_data(strip_tags($benefRgDtEmis[$kId])));
          $stmt->bindValue(12, strip_tags($benefRgOrgaoEx[$kId]));
          $stmt->bindValue(13, strip_tags($benefTelRes[$kId]));
          $stmt->bindValue(14, strip_tags($benefTelCel[$kId]));
          $stmt->bindValue(15, strip_tags($benefEndCep[$kId]));
          $stmt->bindValue(16, strip_tags($benefEndLog[$kId]));
          $stmt->bindValue(17, strip_tags($benefEndNum[$kId]));
          $stmt->bindValue(18, strip_tags($benefEndComp[$kId]));
          $stmt->bindValue(19, strip_tags($benefEndBairro[$kId]));
          $stmt->bindValue(20, $benefEndMunic[$kId] != '' ? strip_tags($benefEndMunic[$kId]) : NULL);
          $stmt->bindValue(21, strip_tags($benefAutos[$kId]));
          $stmt->bindValue(22, $benefContaTipo[$kId] != '' ? strip_tags($benefContaTipo[$kId]) : NULL);
          $stmt->bindValue(23, $benefBanco[$kId] != '' ? strip_tags($benefBanco[$kId]) : NULL);
          $stmt->bindValue(24, strip_tags($benefBancoAgencia[$kId]));
          $stmt->bindValue(25, strip_tags($benefBancoConta[$kId]));
          $stmt->bindValue(26, strip_tags($benefBancoOp[$kId]));
          $stmt->bindValue(27, strip_tags($benefRepresNome[$kId]));
          $stmt->bindValue(28, strip_tags($benefRepresCpf[$kId]));
          $stmt->bindValue(29, strip_tags($benefRepresRgNum[$kId]));
          $stmt->bindValue(30, formata_data(strip_tags($benefRepresRgDtEmis[$kId])));
          $stmt->bindValue(31, strip_tags($benefRepresRgOrgaoEx[$kId]));
          $stmt->bindValue(32, strip_tags($benefRepresEndCep[$kId]));
          $stmt->bindValue(33, strip_tags($benefRepresEndLog[$kId]));
          $stmt->bindValue(34, strip_tags($benefRepresEndNum[$kId]));
          $stmt->bindValue(35, strip_tags($benefRepresEndComp[$kId]));
          $stmt->bindValue(36, strip_tags($benefRepresEndBairro[$kId]));
          $stmt->bindValue(37, $benefRepresEndMunic[$kId] != '' ? strip_tags($benefRepresEndMunic[$kId]) : NULL);
          $stmt->bindValue(38, strip_tags($benefRepresTelRes[$kId]));
          $stmt->bindValue(39, strip_tags($benefRepresTelCel[$kId]));
          $stmt->bindValue(40, $_SESSION['zatu_id']);
          $stmt->bindValue(41, strip_tags($vId));
          $stmt->execute();
          array_push($ids, $vId);
        } else {
          if ($nome[$kId] != '' && $cpf[$kId] != '' && $ParentescoGrauId[$kId] != '') {
            $stmt = $db->prepare('
              INSERT INTO rh_servidor_dependente 
              (rh_servidor_id, 
                codigo, 
                nome, 
                cpf, 
                bsc_parentesco_grau_id, 
                parentesco_grau_outro, 
                dt_nascimento, 
                dt_casamento, 
                status, 
                benef_rg_numero, 
                benef_rg_dt_emissao, 
                benef_rg_orgao_expedidor, 
                benef_tel_residencial,  
                benef_tel_celular, 
                benef_end_cep, 
                benef_end_logradouro, 
                benef_end_numero, 
                benef_end_complemento, 
                benef_end_bairro, 
                benef_bsc_municipio_id, 
                benef_autos_numero, 
                benef_bsc_banco_conta_tipo_id, 
                benef_bsc_banco_id, 
                benef_bancario_agencia, 
                benef_bancario_conta, 
                benef_bancario_op, 
                benef_repres_nome, 
                benef_repres_cpf,  
                benef_repres_rg_numero, 
                benef_repres_rg_dt_emissao, 
                benef_repres_rg_orgao_expedidor, 
                benef_repres_end_cep, 
                benef_repres_end_logradouro, 
                benef_repres_end_numero, 
                benef_repres_end_complemento, 
                benef_repres_end_bairro, 
                benef_repres_bsc_municipio_id, 
                benef_repres_tel_residencial, 
                benef_repres_tel_celular, 
                dt_cadastro, 
                seg_usuario_id) 
              VALUES
              (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?);');
            $stmt->bindValue(1, $servidorId);
            $stmt->bindValue(2, strip_tags($codigo[$kId]));
            $stmt->bindValue(3, strip_tags($nome[$kId]));
            $stmt->bindValue(4, strip_tags($cpf[$kId]));
            $stmt->bindValue(5, $ParentescoGrauId[$kId] != '' ? strip_tags($ParentescoGrauId[$kId]) : NULL);
            $stmt->bindValue(6, strip_tags($ParentescoGrauOutro[$kId]));
            $stmt->bindValue(7, formata_data(strip_tags($dtNascimento[$kId])));
            $stmt->bindValue(8, formata_data(strip_tags($dtCasamento[$kId])));
            $stmt->bindValue(9, $status);
            $stmt->bindValue(10, strip_tags($benefRgNum[$kId]));
            $stmt->bindValue(11, formata_data(strip_tags($benefRgDtEmis[$kId])));
            $stmt->bindValue(12, strip_tags($benefRgOrgaoEx[$kId]));
            $stmt->bindValue(13, strip_tags($benefTelRes[$kId]));
            $stmt->bindValue(14, strip_tags($benefTelCel[$kId]));
            $stmt->bindValue(15, strip_tags($benefEndCep[$kId]));
            $stmt->bindValue(16, strip_tags($benefEndLog[$kId]));
            $stmt->bindValue(17, strip_tags($benefEndNum[$kId]));
            $stmt->bindValue(18, strip_tags($benefEndComp[$kId]));
            $stmt->bindValue(19, strip_tags($benefEndBairro[$kId]));
            $stmt->bindValue(20, $benefEndMunic[$kId] != '' ? strip_tags($benefEndMunic[$kId]) : NULL);
            $stmt->bindValue(21, strip_tags($benefAutos[$kId]));
            $stmt->bindValue(22, $benefContaTipo[$kId] != '' ? strip_tags($benefContaTipo[$kId]) : NULL);
            $stmt->bindValue(23, $benefBanco[$kId] != '' ? strip_tags($benefBanco[$kId]) : NULL);
            $stmt->bindValue(24, strip_tags($benefBancoAgencia[$kId]));
            $stmt->bindValue(25, strip_tags($benefBancoConta[$kId]));
            $stmt->bindValue(26, strip_tags($benefBancoOp[$kId]));
            $stmt->bindValue(27, strip_tags($benefRepresNome[$kId]));
            $stmt->bindValue(28, strip_tags($benefRepresCpf[$kId]));
            $stmt->bindValue(29, strip_tags($benefRepresRgNum[$kId]));
            $stmt->bindValue(30, formata_data(strip_tags($benefRepresRgDtEmis[$kId])));
            $stmt->bindValue(31, strip_tags($benefRepresRgOrgaoEx[$kId]));
            $stmt->bindValue(32, strip_tags($benefRepresEndCep[$kId]));
            $stmt->bindValue(33, strip_tags($benefRepresEndLog[$kId]));
            $stmt->bindValue(34, strip_tags($benefRepresEndNum[$kId]));
            $stmt->bindValue(35, strip_tags($benefRepresEndComp[$kId]));
            $stmt->bindValue(36, strip_tags($benefRepresEndBairro[$kId]));
            $stmt->bindValue(37, $benefRepresEndMunic[$kId] != '' ? strip_tags($benefRepresEndMunic[$kId]) : NULL);
            $stmt->bindValue(38, strip_tags($benefRepresTelRes[$kId]));
            $stmt->bindValue(39, strip_tags($benefRepresTelCel[$kId]));
            $stmt->bindValue(40, $_SESSION['zatu_id']);
            $stmt->execute();
            $dependenteIdNew = $db->lastInsertId();
            array_push($ids, $dependenteIdNew);
          }
        }
      }
      $db->commit();
      //MENSAGEM DE SUCESSO
      $msg['ids'] = $ids;
      $msg['msg'] = 'success';
      $msg['retorno'] = 'Dados de dependentes do servidor salvos com sucesso.';
      echo json_encode($msg);
      exit();
    }
  } else {
    $db->rollback();
    $msg['tipo'] = 'servidorId';
    $msg['msg'] = 'error';
    $msg['retorno'] = 'Não foi encontrado registro do servidor para vincular os dados de dependentes!';
    echo json_encode($msg);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $msg['msg'] = 'error';
  $msg['retorno'] = 'Erro ao tentar salvar os dados de dependentes do Servidor:'. $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>