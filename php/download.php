<?php
require_once 'conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp-master/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp-master/config/config.json');
$nfe->setModelo('55');

$read_download = mysqli_query($conexao, "SELECT chNFe FROM nfe WHERE status = '1'");
if(mysqli_num_rows($read_download) > '0'){
    foreach($read_download as $read_download_view){
        $chNFe = $read_download_view['chNFe'];
        $tpAmb = '1';
        $cnpj = $nfe->aConfig['cnpj'];
        $aResposta = array();

        $resp = $nfe->sefazDownload($chNFe, $tpAmb, $cnpj, $aResposta);
        $update_download = mysqli_query($conexao, "UPDATE nfe SET status = '2' WHERE chNFe = '".$read_download_view['chNFe']."'");
    }
    $json_download = array(
        'type' => 'success',
        'msg'  => 'Dados baixados com sucesso!'
    );
}else{
    $json_download = array(
        'type' => 'error',
        'msg'  => 'Nenhum download para ser feito!'
    );
}
echo json_encode($json_download);

