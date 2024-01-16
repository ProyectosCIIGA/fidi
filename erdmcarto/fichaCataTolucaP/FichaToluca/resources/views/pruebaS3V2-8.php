<?php
require '../../public/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$s3 = S3Client::factory([
    'region' => 'us-east-1',
    'version' => '2006-03-01',
    'credentials' => [
        'key' => 'AKIAQAVQA6VN3G4QA5GC',
        'secret' => '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',
    ]
]);

try {
    
    $key = 'toluca/pruebaV4.jpg';
    $archivoSubir = $s3->putObject([
                    'Bucket' => 'fichascatas',
                    'Key' => $key,
                    'SourceFile' => 'TESTC1_1.png'
                    ]);
    
    print_r($archivoSubir);
    
    /*
    pruebaV2.jpg
    pruebaV3.jpg
    */
/*
    $command = $s3->getCommand('GetObject', array(
        'Bucket' => 'fichascatas',
        'Key' => $key,
    ));

    //$signedUrl = $command->createPresignedUrl('+8 years');
    $signedUrl = $command->createPresignedUrl('200 minutes');
    echo $signedUrl;
*/ 
    
    /*
    $result = $s3->deleteObject(array(
        // Bucket is required
        'Bucket' => 'fichascatas',
        // Key is required
        'Key' => 'toluca/pruebaV4.jpg'
    ));
    
    
    print_r($result);
    */
} catch (S3Exception $e) {
    echo "There was an error uploading the file.\n";
    print($e);
}
?>