<?php

require './vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

session_start();

$serverName = "51.222.44.135";
$connectionInfo = array( 'Database'=>'implementtaTolucaP', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');

$cnxTolP = sqlsrv_connect($serverName, $connectionInfo);
date_default_timezone_set('America/Mexico_City');

$mensajesComprobacion = array();
$listaDeArchivos = array('_1' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_2' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_3' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_4' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_5' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_6' => array('nombreArchivo' => '','rutaTemporal' => ''),
                         '_7' => array('nombreArchivo' => '','rutaTemporal' => '') );


function comprobacionNombreFoto($referencia, $nombreNuevo, $index){
    global $mensajesComprobacion, $listaDeArchivos;
    $img=pathinfo($_FILES[$referencia]['name'][$index],PATHINFO_FILENAME);
    $imgtemp=$_FILES[$referencia]['tmp_name'][$index];
    $ext=pathinfo($_FILES[$referencia]['name'][$index],PATHINFO_EXTENSION);

    $errorNombre = false;

    $datosNombre = explode("_", $img);

    if(count($datosNombre) < 2)
        $datosNombre[] = '';
    else if (count($datosNombre) > 2){
        $mensajesComprobacion[] = $_FILES[$referencia]['name'][$index]." - NO COINCIDE CON EL FORMATO DEL NOMBRE, MAS DE UN _ !!";
        $errorNombre = true;
    }

    if($datosNombre[0] <> $nombreNuevo){
        $mensajesComprobacion[] = $_FILES[$referencia]['name'][$index]." - NO COINCIDE CON LA CUENTA!!";
        $errorNombre = true;
    }

    if(array_key_exists('_'.$datosNombre[1], $listaDeArchivos) == false){
        $mensajesComprobacion[] = $_FILES[$referencia]['name'][$index]." - NO COINCIDE CON LA ULTIMA TERMINACION!!";
        $errorNombre = true;
    }

    if($errorNombre){
        return -1;
    }

    if($ext <> 'png' && $ext <> 'jpg' && $ext <> 'jpeg'){
        $mensajesComprobacion[] = $_FILES[$referencia]['name'][$index]." - No es un archivo con extension valida";
        return -1;
    }else{
        $nomImg = $nombreNuevo.'_'.$datosNombre[1].'.'.$ext;
        $listaDeArchivos[ '_'.$datosNombre[1] ]['nombreArchivo'] = $nomImg;
        $listaDeArchivos[ '_'.$datosNombre[1] ]['rutaTemporal'] = $imgtemp;
    }

    return $nomImg;
}

function comprobacionNombreSimple($referencia, $nombreNuevo, $terminacion){
    global $mensajesComprobacion, $listaDeArchivos;
    $img=pathinfo($_FILES[$referencia]['name'],PATHINFO_FILENAME);
    $imgtemp=$_FILES[$referencia]['tmp_name'];
    $ext=pathinfo($_FILES[$referencia]['name'],PATHINFO_EXTENSION);

    $errorNombre = false;

    $datosNombre = explode("_", $img);

    if(count($datosNombre) < 2)
        $datosNombre[] = '';
    else if (count($datosNombre) > 2){
        $mensajesComprobacion[] = $_FILES[$referencia]['name']." - NO COINCIDE CON EL FORMATO DEL NOMBRE, MAS DE UN _ !!";
        $errorNombre = true;
    }

    if($datosNombre[0] <> $nombreNuevo){
        $mensajesComprobacion[] = $_FILES[$referencia]['name']." - NO COINCIDE CON LA CUENTA!!";
        $errorNombre = true;
    }

    print_r($datosNombre);
    if( $terminacion <> '_'.$datosNombre[1] ){
        $mensajesComprobacion[] = $_FILES[$referencia]['name']." - NO COINCIDE CON LA ULTIMA TERMINACION!!";
        $errorNombre = true;
    }

    if($errorNombre){
        return -1;
    }

    if($ext <> 'png' && $ext <> 'jpg' && $ext <> 'jpeg'){
        $mensajesComprobacion[] = $_FILES[$referencia]['name']." - No es un archivo con extension valida";
        return -1;
    }else{
        $nomImg = $nombreNuevo.'_'.$datosNombre[1].'.'.$ext;
    }

    return $nomImg;
}


function updateCampoFoto($refBDCampo, $nuevoValor, $cuenta){

    global $mensajesComprobacion, $cnxTolP;

    $sqlUpdateF = "UPDATE imgFicha SET $refBDCampo = ? where cuentaPredial = ?";
    $prov = sqlsrv_prepare($cnxTolP,$sqlUpdateF, array(&$nuevoValor, &$cuenta));
    if(sqlsrv_execute( $prov ) and $prov != false){
        return true;
    }else{
        $mensajesComprobacion[] = "Error al actualizar campo: ".$referencia;
        return false;
    }

}

function generarUrl($archivoSubir, $sClient, $refKey){
    
    if($archivoSubir['@metadata']['statusCode'] == 200){
    
        $command = $sClient->getCommand('GetObject', array(
            'Bucket' => 'fichascatas',
            'Key' => $refKey,
        ));
        $request = $sClient->createPresignedRequest($command, '+200 minutes');

        // Get the actual presigned-url
        $signedUrl = (string)$request->getUri();
        return $signedUrl;
        //echo $signedUrl;

    }else{
        return false;
        echo "Error subiendo archivo ".$archivoSubir['@metadata']['statusCode']."</br>";
    }
    
}

function borrarImagen($sClient, $refKeyBorrar){
    
    $result = $sClient->deleteObject([
        'Bucket' => 'fichascatas',
        'Key'    => $refKeyBorrar
    ]);

    if ($result['DeleteMarker'] != true)
    {
        exit('Error: ' . $keyname . ' no pudo ser eliminado.' . PHP_EOL);
    }     
}

if(isset($_POST['cargarFotos'])){
    
    $consulta = "SELECT * FROM imgFicha WHERE cuentaPredial = ?";
    $cuentaFind = sqlsrv_prepare($cnxTolP,$consulta,array($_GET['cPredial']));
    if(sqlsrv_execute($cuentaFind) == false or $cuentaFind == false){
        die( "Consulta de ya existente en IMG ". print_r( sqlsrv_errors(), true));
    }else{
        $row =  sqlsrv_fetch_array($cuentaFind);
        if($row == null){
            
            $s3 = S3Client::factory([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAQAVQA6VN3G4QA5GC',
                'secret' => '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',
                ]
            ]);


            if(isset($_FILES['foto1']) && $_FILES['foto1']['error'] <> 4 && $_FILES['foto1']['name'][0] <> ''){
                //print_r($_FILES['foto1']['tmp_name']);
                //print_r($_FILES['foto1']['name']);
                //echo pathinfo($_FILES['foto1']['name'][0], PATHINFO_FILENAME);

                for($i = 0;$i < count($_FILES['foto1']['name']);$i++ ){
                    $nombreFoto = comprobacionNombreFoto('foto1',$_GET['cPredial'],$i);
                    //$imgtemp=$_FILES['foto1']['tmp_name'][$i];
                    
                    //$rutaS3 = 'toluca/fotos/';
                    $rutaS3 = '../fotos/';

                    if($nombreFoto <> -1){
                        /*
                        $archivoSubir = $s3->putObject([
                            'Bucket' => 'fichascatas',
                            'Key' => $rutaS3.$nombreFoto,
                            'SourceFile' => $imgtemp
                        ]);
                        $url = generarUrl($archivoSubir,$s3,$rutaS3.$nombreFoto);
                        */
                    }
                }

                if( $listaDeArchivos['_1']['nombreArchivo'] <> '' and $listaDeArchivos['_2']['nombreArchivo'] <> '' and $listaDeArchivos['_3']['nombreArchivo'] <> '' and  $listaDeArchivos['_7']['nombreArchivo'] <> ''  and count($mensajesComprobacion) == 0){

                    $datos = array('img_1' => '','img_2' => '','img_3' => '','img_4' => '','img_5' => '','img_6' => '','img_7' => '',
                                           'url_1' => '','url_2' => '','url_3' => '','url_4' => '','url_5' => '','url_6' => '','url_7' => '');

                    for($i = 1;$i <= count($listaDeArchivos);$i++){
                        if($listaDeArchivos['_'.$i]['nombreArchivo'] <> '' ){
                            //echo 'Se insertara el archivo -> <span class="badge badge-warning">'.$archivo['nombreArchivo'].'</span> de la direccion <span class="badge badge-warning">'.$archivo['rutaTemporal'].'</span> </br>';

                            $claveNombre = $rutaS3.$listaDeArchivos['_'.$i]['nombreArchivo'];
/*
                            $archivoSubir = $s3->putObject([
                            'Bucket' => 'fichascatas',
                            'Key' => $claveNombre,
                            'SourceFile' => $listaDeArchivos['_'.$i]['rutaTemporal']
                            ]);
                            $url = generarUrl($archivoSubir, $s3, $claveNombre);

                            $datos['img_'.$i] = $claveNombre;
                            $datos['url_'.$i] = $url;
                            */
                            $src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
                            $datos['img_'.$i] = $claveNombre;
                            $datos['url_'.$i] = $src.$listaDeArchivos['_'.$i]['nombreArchivo'];

                            if (file_exists($claveNombre)) {
                                unlink($claveNombre);
                            }
                            move_uploaded_file($listaDeArchivos['_'.$i]['rutaTemporal'],$claveNombre);

                        }
                    }

                    $registro="insert into imgFicha (tokenCactuales,cuentaPredial,img_1,img_2,img_3,img_4,img_5,img_6,img_7,urlFoto_1,urlFoto_2,urlFoto_3,urlFoto_4,urlFoto_5,urlFoto_6,urlFoto_7) 
                            values ('',?,
                                    ?,?,?,?,
                                    ?,?,?,?,
                                    ?,?,?,?,
                                    ?,?)";


                    $cuenta = $_GET['cPredial'];
                    $arrayInsert = array($cuenta, $datos['img_1'], $datos['img_2'], $datos['img_3'], $datos['img_4'], $datos['img_5'], $datos['img_6'], $datos['img_7'], 
                                                  $datos['url_1'], $datos['url_2'], $datos['url_3'], $datos['url_4'], $datos['url_5'], $datos['url_6'], $datos['url_7']);

                    sqlsrv_query($cnxTolP,$registro, $arrayInsert) or die ('No se ejecuto Insert de las fotos '.print_r( sqlsrv_errors(), true));

                    echo '<script> alert("Exito subiendo los archivos") </script>';
                    echo '<meta http-equiv="refresh" content="0 , url=cargaFotosTolucaPCuenta.php"';

                }else{
                    $mensajesComprobacion[] = "No se subira nada revisa los errores o Faltan Archivos, Los terminacion _1, _2, _3 y _7 son indispensables";
                }


            }else{
                $mensajesComprobacion[] = "Sin archivos seleccionados";
            }
            
        }else{
            $mensajesComprobacion[] = "Ya se insertaron Fotos a esta cuenta, no puedes insertar de nuevo";
        }
    }
}

if(isset($_POST['actualizarFotos']) and isset($_GET['cPredial']) ){
    $cuentaActualizar = $_GET['cPredial'];
    //$rutaS3Toluca = "toluca/fotos/";
    $rutaS3Toluca = '../fotos/';


    $consultaImg = "SELECT * FROM imgFicha WHERE cuentaPredial = ?";
    $cuentaImg = sqlsrv_prepare($cnxTolP,$consultaImg,array($_GET['cPredial']));
    if(sqlsrv_execute($cuentaImg) == false or $cuentaImg == false){
        die("Consulta UPDATE Error:  ". print_r( sqlsrv_errors(), true));
    }else{
        $rowImg =  sqlsrv_fetch_array($cuentaImg);
        if($rowImg == null){
            $mensajesComprobacion[] = "INTENTAS ACTUALIZAR UNA CUENTA QUE NO ESTA REGISTRADA";
        }else{
            
            $s3 = S3Client::factory([
                    'version' => 'latest',
                    'region' => 'us-east-1',
                    'credentials' => [
                        'key' => 'AKIAQAVQA6VN3G4QA5GC',
                        'secret' => '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',
                        ]
                    ]);


            if(isset($_FILES['_1']) && $_FILES['_1']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_1',$cuentaActualizar,'_1');
                $imgtemp=$_FILES['_1']['tmp_name'];

                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_1'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_1',$url,$cuentaActualizar) == false or updateCampoFoto('img_1',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_2']) && $_FILES['_2']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_2',$cuentaActualizar,'_2');
                $imgtemp=$_FILES['_2']['tmp_name'];

                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_2'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){
                        
                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_2',$url,$cuentaActualizar) == false or updateCampoFoto('img_2',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_3']) && $_FILES['_3']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_3',$cuentaActualizar,'_3');
                $imgtemp=$_FILES['_3']['tmp_name'];

                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_3'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_3',$url,$cuentaActualizar) == false or updateCampoFoto('img_3',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_4']) && $_FILES['_4']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_4',$cuentaActualizar,'_4');
                $imgtemp=$_FILES['_4']['tmp_name'];

                if($nombreFoto <> -1){
                    
                   $claveNombre = $rowImg['img_4'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);
                        
                        if(updateCampoFoto('urlFoto_4',$url,$cuentaActualizar) == false or updateCampoFoto('img_4',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_5']) && $_FILES['_5']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_5',$cuentaActualizar,'_5');
                $imgtemp=$_FILES['_5']['tmp_name'];

                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_5'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_5',$url,$cuentaActualizar) == false or updateCampoFoto('img_5',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_6']) && $_FILES['_6']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_6',$cuentaActualizar,'_6');
                $imgtemp=$_FILES['_6']['tmp_name'];

                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_6'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_6',$url,$cuentaActualizar) == false or updateCampoFoto('img_6',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }

            }
            if(isset($_FILES['_7']) && $_FILES['_7']['error'] <> 4){
                $nombreFoto = comprobacionNombreSimple('_7',$cuentaActualizar,'_7');
                $imgtemp=$_FILES['_7']['tmp_name'];
                if($nombreFoto <> -1){
                    
                    $claveNombre = $rowImg['img_7'];
                    //if($claveNombre == '')
                        $claveNombre = $rutaS3Toluca.$nombreFoto;
                    /*
                    $archivoSubir = $s3->putObject([
                        'Bucket' => 'fichascatas',
                        'Key' => $claveNombre,
                        'SourceFile' => $imgtemp
                        ]);
                    $url = generarUrl($archivoSubir, $s3, $claveNombre);
*/
$src = 'https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/fotos/';
$url = $src.$nombreFoto;
                    if($url != false){

                        if (file_exists($claveNombre)) {
                            unlink($claveNombre);
                        }
                        move_uploaded_file($imgtemp,$claveNombre);

                        if(updateCampoFoto('urlFoto_7',$url,$cuentaActualizar) == false or updateCampoFoto('img_7',$claveNombre,$cuentaActualizar) == false){
                            //borrarImagen($s3, $claveNombre);
                        }
                    }
                }
            }

                ///********************************* Redireccionamiento a actualizar
            if(count($mensajesComprobacion) == 0){
                echo '<meta http-equiv="refresh" content="0 , url=cargaFotosTolucaPCuenta.php?cPredial='.$cuentaActualizar.'"';
            }
               
            
       }
    }
}

$cuentaValida = false;
$rowImg = null;

if(isset($_GET['cPredial']) ){

    $consulta = "SELECT * FROM GC203T05 WHERE CLAVE_CATA = ?";
    $cuentaFind = sqlsrv_prepare($cnxTolP,$consulta,array($_GET['cPredial']));
    if(sqlsrv_execute($cuentaFind) == false or $cuentaFind == false){
        die( print_r( sqlsrv_errors(), true));
    }else{
        $row =  sqlsrv_fetch_array($cuentaFind);
        if($row == null){
            $mensajesComprobacion[] = "La cuenta no esta en el Padron no puedes subir fotos a esta Cuenta";
        }else{
            
            $consultaImg = "SELECT * FROM imgFicha WHERE cuentaPredial = ?";
            $cuentaImg = sqlsrv_prepare($cnxTolP,$consultaImg,array($_GET['cPredial']));
            if(sqlsrv_execute($cuentaImg) == false or $cuentaImg == false){
                die("Consulta por fotos ya subidas  ". print_r( sqlsrv_errors(), true));
            }else{
                $rowImg =  sqlsrv_fetch_array($cuentaImg);
                if($rowImg != null){
                    $mensajesComprobacion[] = "Actualizacion de Fotos";
                }else
                    $cuentaValida = true;
            }
        }
    }
    
    
    
}

?>
   
<html>
   <?php
     if( (isset($_SESSION['user'])) 
           and ($_SESSION['tipousuario'] == 'documentos') 
           or ($_SESSION['user'] == 1)
           or ($_SESSION['user'] == 3)
           or ($_SESSION['user'] == 5) ) {
    ?>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Carga Fotos Toluca</title>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link href="../fontawesome/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <!-- Quitar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <style>
            .cardFoto{
                display: flex;
                text-align: center;
                align-content: center;
                justify-content: center;
                font-family: arial;
                font-size: 15px;
                width: 800px;
                height: auto;
                border-color: green;
            }
            .imgCard{
                width: 90px;
                height: 90px;
                justify-content: center;
                text-align: center;
            }
            .jumboCenter{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .cardEnBloque{
                display: block;
            }
            .listaImg{
                display: flex;
                align-items: center;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .zoneBoton{
                display: flex;
                justify-content: flex-end;
                align-items: center;
                width: 15%;
            }
            
            .listaImg label{
                align-items: center;
                padding: 0;
                padding-top: 2px;
                width: 40px;
                height: 20px;
                margin-bottom: 0;
                font-size: 10px;
            }
            .listaImg p{
                margin-bottom: 0;
                margin-left: 5px;
                width: 70%;
                font-size: 12px;
            }
            .sc{
                white-space: unset;
            }

            .visorImg {
                height: 700px;
                width: 100%;
                align-items: center;
            }
            .visorImg img{
                width: 100%;
            }
            body{
                background-repeat: repeat;
    background-size: 100%;
    background-attachment: fixed;
    overflow-x: hidden;
    font-family: sans-serif;
    font-style: normal;
    font-weight: bold;
    width: 100%;
    height: 100%;
    margin-top: -1%;
    padding-top: 0px;
            }
          

        </style>
        <?php require "nav.php"; ?>     
    </head>
    <body>
       
        <div class="container">
            <div class="jumboCenter">
                <form method="get" >
                    <label for="cuenta" >Cuenta de la foto que quieres anexar fotos </label>
                    <input type="text" name="cPredial" placeholder="Cuenta a cargar fotos">
                    <button class="btn btn-primary" >Buscar cuenta</button>
                </form>
            </div>
          <?php if(count($mensajesComprobacion) > 0){ for($i=0;$i<count($mensajesComprobacion);$i++){ ?>
               <p style="text-align: center;"> <span class="badge badge-warning" ><?php echo $mensajesComprobacion[$i]; ?></span> </p>
           <?php } } ?>
           <?php if($cuentaValida == true){ ?>
            <p style="text-align: center;"> FOTOS PARA CUENTA: <span class="badge badge-success" ><?php echo $_GET['cPredial']; ?></span> </p>
            <form method="post" enctype="multipart/form-data">
              <div class="jumboCenter">
              
                <div class="card cardFoto">
                    <div>
                    <img class="card-img-top imgCard" src="camera.jpg">
                    </div>
                    <div class="card-body cardEnBloque">
                        <div>
                            <label for="dz1" class="btn btn-info" >Cargar archivos</label>
                        </div>
                        <div class="preview">
                            <p>Sin archivos seleccionados</p>
                        </div>
                        <input id="dz1" type="file" name="foto1[]" multiple hidden>
                    </div>
                </div>
            
              </div>
              <div class="jumboCenter">
                 <button class="btn btn-primary" name="cargarFotos">Cargar fotos</button>
              </div>
            </form>
            
            <script>
                const zona1 = document.getElementById("dz1");
                
                const preview = document.querySelector('.preview');
                
                zona1.addEventListener("change", updateImageDisplay, false);

                function handleFiles1() {
                    const span1 = document.getElementById("sp1");
                    const fileList = this.files.length;
                    let text = "Archivos seleccionados " + fileList;
                    span1.textContent = text;
                    span1.hidden = false;
                }
                
                function removeFileFromFileList(index) {
                    const dt = new DataTransfer()
                    const input = document.getElementById('dz1')
                    const { files } = input
                    
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i]
                        if (index != i)
                            dt.items.add(file) // here you exclude the file. thus removing it.
                    }
                    
                    input.files = dt.files // Assign the updates list
                    updateImageDisplay();
                }

                const fileTypes = [
                  "image/png"
                ];

                function validFileType(file) {
                  return fileTypes.includes(file.type);
                }
                
                function updateImageDisplay() {
                  while(preview.firstChild) {
                    preview.removeChild(preview.firstChild);
                  }

                  const input = document.getElementById('dz1')
                  const curFiles = input.files;
                  if (curFiles.length === 0) {
                    const para = document.createElement('p');

                    para.textContent = 'Sin archivos seleccionados';
                    preview.appendChild(para);
                  } else {
                  let indexImg = 0;
                    for (const file of curFiles) {
                      const divImg = document.createElement('div');
                      const divBoton = document.createElement('div');
                      divImg.className = "listaImg";
                      divBoton.className = "zoneBoton";
                      
                      const para = document.createElement('p');

                      const deleteBtn = document.createElement('label');
                      deleteBtn.addEventListener("click", function(){
                        removeFileFromFileList(this.id);
                      } );

                      deleteBtn.className = "btn btn-danger";
                      deleteBtn.textContent = "Borrar";

                      if (validFileType(file)) {
                        para.textContent = `${file.name}`;
                        const image = document.createElement('img');
                        image.className = "imgSubir";
                        image.height = "70";
                        image.width = "70";
                        image.title = "Click para ver imagen";
                        image.src = URL.createObjectURL(file);

                        image.addEventListener("click", function(){
                            verFoto(this.src);
                        } );
                        //deleteBtn.id = 'imgD' + indexImg;
                        deleteBtn.id = indexImg;

                        divImg.appendChild(image);
                        divImg.appendChild(para);

                        divBoton.appendChild(deleteBtn)
                        divImg.appendChild(divBoton);
                        

                      } else {
                        let noValido = document.createElement('span');
                        
                        noValido.textContent = `Archivo con nombre ${file.name}: no es un tipo de archivo valido.`;
                        noValido.className = "badge badge-warning sc";
                          
                        deleteBtn.id = indexImg;
                        
                        divImg.appendChild(noValido);
                        divImg.appendChild(deleteBtn);
                      }
                      preview.appendChild(divImg);
                      indexImg++;

                    }

                  }
                }

           </script>

           <?php } ?>
           
           <?php if($rowImg != null){ ?>
            <div>
                <p style="text-align: center;"> FOTOS PARA CUENTA: <span class="badge badge-info" ><?php echo $_GET['cPredial']; ?></span> </p>
               
                <h3 style="text-shadow: 0px 0px 2px #717171;"><img src="https://img.icons8.com/external-prettycons-flat-prettycons/47/null/external-picture-multimedia-prettycons-flat-prettycons.png"/> Evidencia Fotográfica</h3>
                <hr>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Ortofoto año 2016*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-success" >Antecedente _1</span> 
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_1'] ?>')" > Ver foto </span>
                            <input type="file" class="form-control-file" name="_1" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Ortofoto año 2022*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-success">Actual _2</span>
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_2'] ?>')" > Ver foto </span>
                            <input type="file" class="form-control-file" name="_2" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Fotografia Oblicua*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _3</span>
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_3'] ?>')" > Ver foto </span> 
                            <input type="file" class="form-control-file" name="_3" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _4</span>
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_4'] ?>')" > Ver foto </span> 
                            <input type="file" class="form-control-file" name="_4" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _5</span>
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_5'] ?>')" > Ver foto </span>
                            <input type="file" class="form-control-file" name="_5" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _6</span>
                            <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_6'] ?>')" > Ver foto </span>
                            <input type="file" class="form-control-file" name="_6" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Croquis de construcciones* &nbsp;&nbsp;&nbsp;<span class="badge badge-success">Croquis con Cotas _7</span>
                    </label>
                    <span class="badge badge-info verFotoS" onClick="verFoto('<?php echo $rowImg['urlFoto_7'] ?>')" > Ver foto </span> 
                    <input type="file" class="form-control-file" name="_7" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
                <div>
                    <button name="actualizarFotos" class="btn btn-warning"> Subir nuevas Fotos </button>
                </div>
            </form>
            </div>
            
            
            <?php } ?>
            
           
           <script>
                function verFoto(srcF){
                    let modalFoto = document.getElementById('imgVisorFull');
                    modalFoto.src = srcF;
                    
                    $("#visorFoto").modal('show');
                }
            </script>
            
            <div class="modal fade" id="visorFoto" tabindex="-1" role="dialog" aria-labelledby="visor1" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visor1">Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visorImg">
                            <img id="imgVisorFull" src=""  alt="Sin Foto">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            
    
            <a style="width:20 px;" href="../../php/accesDoctos.php" type="button" class="btn btn-secondary"><img
                                     src="https://img.icons8.com/fluency/30/null/cancel.png" />Regresar</a>
       </div>
       
       <?php  
    //    } else{
    //   header('location:../../login.php');
    // } 
    //   require "footer.php";
    ?>
    </body>
    
    <?php } else{
    echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/login.php">';
    }
    
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>