<?php
require 'vendor/autoload.php';
require "../../acnxerdm/cnx.php";

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$s3 = S3Client::factory([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => [
        'key' => 'AKIAQAVQA6VN3G4QA5GC',
        'secret' => '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',
    ]
]);

//$archivo = '1114075899_FichaCatastral.pdf';
$archivo = 'CIIGA.png';
//if (file_exists('../../../fotosZapopan/aFiles_PDF/'.$archivo)) {
if (file_exists($archivo)) {
    
    $archivoSubir = $s3->putObject([
            'Bucket' => 'fichascatas',
            'Key' => 'prueba 1/'.$archivo,
            'SourceFile' => $archivo
        ]);
    echo "Entre al if <br/>";
}else
    echo "No Entre al if <br/>";

if($archivoSubir['@metadata']['statusCode'] == 200){
    
    $command = $s3->getCommand('GetObject', array(
        'Bucket' => 'fichascatas',
        'Key' => 'prueba 1/'.$archivo,
    ));

    //$signedUrl = $command->createPresignedUrl('+8 years');
    $request = $s3->createPresignedRequest($command, '+200 minutes');

    // Get the actual presigned-url
    $signedUrl = (string)$request->getUri();
    /*
    $sqlCuentaUrl = "update insertCuentasActuales set urlFichaPDF = '$signedUrl' where cuentaPredial = '1114359587'";
    $p = sqlsrv_query($cnx,$sqlCuentaUrl);
    if($p != false){
        echo "Exito <br/>";
    }else
        print_r( sqlsrv_errors());
    */
}else
    echo "Error subiendo archivo ".$archivoSubir['@metadata']['statusCode']."</br>";

echo $signedUrl;

?>