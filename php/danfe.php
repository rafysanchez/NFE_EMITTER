<?php
require_once 'conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp-master/bootstrap.php';

use NFePHP\NFe\ToolsNFe;
use NFePHP\Extras\Danfe;
use NFePHP\Common\Files\FilesFolders;

$nfe = new ToolsNFe('../nfephp-master/config/config.json');
$nfe->setModelo('55');

$chave = $_GET['chave'];
$xmlProt = "../nfephp-master/XML/producao/temporarias/{$_GET['pasta']}/{$chave}-retDownnfe.xml";
$docxml = FilesFolders::readFile($xmlProt);
$danfe = new Danfe($docxml, 'P', 'A4', $nfe->aConfig['aDocFormat']->pathLogoFile, 'I', '');
$id = $danfe->montaDANFE();
//$salva = $danfe->printDANFE($pdfDanfe, 'F'); //Salva o PDF na pasta
$abre = $danfe->printDANFE("{$id}-danfe.pdf", 'I'); //Abre o PDF no Navegador



