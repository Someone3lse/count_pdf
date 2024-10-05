<?php
$db = Conexao::getInstance();
$id = strip_tags(@$_POST['id']);
$msg = array();
$mensagem = "";
$msg['retorno'] = "";
try {
  //VERIFICA SE O NOME DO PROJETO JÁ FOI INFORMADO
  if ($id != '' && $id != null) {
    $rsUOs = array();
    $stmt = $db->prepare('
      SELECT 
      uo.id, 
      uo.nome, 
      uo.status 
      FROM bsc_unidade_organizacional AS uo 
      RIGHT JOIN eo_setor_unidade_organizacional AS suo ON suo.bsc_unidade_organizacional_id = uo.id 
      GROUP BY uo.id 
      ORDER BY uo.nome;');
    $stmt->execute();
    $rsUOs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (sizeof($rsUOs) > 0) {
      foreach ($rsUOs as $kObj => $vObj) {
        $rsSetores = array();
        $stmt = $db->prepare('
          SELECT 
          s.id, 
          s.nome, 
          suo.id AS suo_id, 
          s.status, 
          suo.eo_setor_id AS setor_id  
          FROM eo_setor AS s 
          RIGHT JOIN eo_setor_unidade_organizacional AS suo ON suo.eo_setor_id = s.id 
          WHERE suo.bsc_unidade_organizacional_id = ? 
          GROUP BY s.id, suo.id 
          ORDER BY s.nome;');
        $stmt->bindValue(1, $vObj['id']);
        $stmt->execute();
        $rsSetores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rsUOs[$kObj]['setores'] = $rsSetores;
        $rsSetoresUsuario = array();
        $stmt = $db->prepare('
          SELECT a.id, 
          a.seg_usuario_id_atestador, 
          a.eo_setor_unidade_organizacional_id, 
          s.id AS setor_id 
          FROM rh_atestador AS a 
          LEFT JOIN eo_setor_unidade_organizacional AS suo ON suo.id = a.eo_setor_unidade_organizacional_id 
          LEFT JOIN eo_setor AS s ON s.id = suo.eo_setor_id 
          WHERE suo.bsc_unidade_organizacional_id = ? AND a.seg_usuario_id_atestador = ?;');
        $stmt->bindValue(1, $vObj['id']);
        $stmt->bindValue(2, $id);
        $stmt->execute();
        $rsSetoresUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rsUOs[$kObj]['setoresUsuario'] = $rsSetoresUsuario;
      }
    }
    if (sizeof($rsUOs) > 0 ) {
      foreach ($rsUOs as $kObj => $vObj) {
        $msg['retorno'] .= '<div class="row">';
        $msg['retorno'] .= '  <div class="col-md-12">';
        $msg['retorno'] .= '    <label><b>'.$vObj['nome'].':</b></label>';
        $msg['retorno'] .= '    <br>';
        $msg['retorno'] .= '  </div>';
        foreach ($vObj['setores'] as $kObjSetor => $vObjSetor) {
          $checked = '';
          if (array_search($vObjSetor['setor_id'], array_column($vObj['setoresUsuario'], 'setor_id')) !== false) {
            $checked = 'checked="true"';
          }
          $msg['retorno'] .= '  <div class="col-md-3">';
          $msg['retorno'] .= '      <div class="form-group">';
          $msg['retorno'] .= '        <br>';
          $msg['retorno'] .= '        <div class="checkbox checkbox-success">';
          $msg['retorno'] .= '        <input type="checkbox" class="filled-in chk-col-primary" id="suo_'.$vObjSetor['suo_id'].'" name="suo_id[]" value="'.$vObjSetor['suo_id'].'"/ '. $checked .'><label for="suo_'.$vObjSetor['suo_id'].'">'.$vObjSetor['nome'].'</label>';
          $msg['retorno'] .= '      </div>';
          $msg['retorno'] .= '    </div>';
          $msg['retorno'] .= '  </div>';
        }
        $msg['retorno'] .= '  </div>';
        $msg['retorno'] .= '</div>';
      }
    } else {
      $msg['retorno'] = '<span>Nenhuma setor associado a unidades organizacionais encontrado!</span>';
    }
    $msg['msg'] = 'success';
    echo json_encode($msg);
    exit();
  } else {
    $msg['msg'] = 'success';
    $msg['retorno'] = '<div class="row">
    <div class="col-md-12">
    <div class="form-group">
    <label>Selecione, primeiro, um usuário!</label>
    </div>
    </div>
    </div>';
    echo json_encode($msg);
  }
} catch (PDOException $e) {
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar buscar os setores: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>