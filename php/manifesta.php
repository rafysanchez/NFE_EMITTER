<?php
require_once 'conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp-master/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp-master/config/config.json');
$nfe->setModelo('55');

//210200 – Confirmação da Operação
//210210 – Ciência da Operação
//210220 – Desconhecimento da Operação
//210240 – Operação não Realizada ===> é obritatoria uma justificativa para esse caso
$read_manifesta = mysqli_query($conexao, "SELECT chNFe FROM nfe WHERE status = '0'");
if(mysqli_num_rows($read_manifesta) > '0'){
    foreach($read_manifesta as $read_manifesta_view){
        $chave = $read_manifesta_view['chNFe'];
        $tpAmb = '1';
        $xJust = '';
        $tpEvento = '210210'; //ciencia da operação
        $aResposta = array();
        $xml = $nfe->sefazManifesta($chave, $tpAmb, $xJust = '', $tpEvento = '210210', $aResposta);
        $update_manifesta = mysqli_query($conexao, "UPDATE nfe SET status = '1' WHERE chNFe = '".$read_manifesta_view['chNFe']."'");
    }
    $json_manifesta = array(
        'type' => 'success',
        'msg'  => 'Dados manifestados com sucesso!'
    );
}else{
    $json_manifesta = array(
        'type' => 'error',
        'msg'  => 'Nenhum manifesto para ser feito!'
    );
}
echo json_encode($json_manifesta);
