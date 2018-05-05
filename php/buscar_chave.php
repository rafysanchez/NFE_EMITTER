<?php
require_once 'conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp-master/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp-master/config/config.json');
$nfe->setModelo('55');

$ultNSU = 0; // se estiver como zero irá retornar os dados dos ultimos 15 dias até o limite de 50 registros
             // se for diferente de zero irá retornar a partir desse numero os dados dos
             // últimos 15 dias até o limite de 50 registros

$numNSU = 0; // se estiver como zero irá usar o ultNSU
             // se for diferente de zero não importa o que está contido em ultNSU será retornado apenas
             // os dados deste NSU em particular

$tpAmb = '1';// esses dados somente existirão em ambiente de produção pois em ambiente de testes
             // não existem dados de eventos, nem de NFe emitidas para o seu CNPJ

$cnpj = ''; // deixando vazio irá pegar o CNPJ default do config
            // se for colocado um CNPJ tenha certeza que o certificado está autorizado a
            // baixar os dados desse CNPJ pois se não estiver autorizado haverá uma
            // mensagem de erro da SEFAZ

//array que irá conter os dados de retorno da SEFAZ
$aResposta = array();

//essa rotina deve rá ser repetida a cada hora até que o maxNSU retornado esteja contido no NSU da mensagem
//se estiver já foram baixadas todas as referencias a NFe, CTe e outros eventos da NFe e não a mais nada a buscar
//outro detalhe é que não adianta tentar buscar dados muito antigos o sistema irá informar que 
//nada foi encontrado, porque a SEFAZ não mantêm os NSU em base de dados por muito tempo, em 
//geral são mantidos apenas os dados dos últimos 15 dias.
//Os dados são retornados em formato ZIP dento do xml, mas no array os dados 
//já são retornados descompactados para serem lidos
$xml = $nfe->sefazDistDFe('AN', $tpAmb, $cnpj, $ultNSU, $numNSU, $aResposta);

if(count($aResposta['aDoc']) > '0'){
    foreach($aResposta['aDoc'] as $aDoc){
        if($aDoc['schema'] == 'resNFe_v1.00.xsd'){
            $xml_simple_string = simplexml_load_string($aDoc['doc']);
            $read_nfe = mysqli_query($conexao, "SELECT chNFe FROM nfe WHERE chNFe = '".$xml_simple_string->chNFe."'");
            if(mysqli_num_rows($read_nfe) == '0'){
                $data_pasta = date('Ym');
                $create_nfe = mysqli_query($conexao, "INSERT INTO nfe(chNFe, CNPJ, xNome, IE, dhEmi, digVal, dhRecbto, nProt, status, pasta) VALUES('".$xml_simple_string->chNFe."', '".$xml_simple_string->CNPJ."', '".$xml_simple_string->xNome."', '".$xml_simple_string->IE."', '".$xml_simple_string->dhEmi."', '".$xml_simple_string->digVal."', '".$xml_simple_string->dhRecbto."', '".$xml_simple_string->nProt."', '0', '".$data_pasta."')");
            }
        }
    }
    $json_nfe = array(
        'type' => 'success',
        'msg'  => 'Dados carregados com sucesso!'
    );
    echo json_encode($json_nfe);
}
