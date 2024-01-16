<?php
    $database = "";
$plazaNombre = "";
    
    switch ($plaza) {
        case '0':
            $plazaNombre = "Tijuana Agua";
            $database = 'implementtaTijuanaA';
            break;
        case '1':
            $plazaNombre = "Tijuana Predial";
            $database = 'implementtaTijuanaP';
            break;
        case '2':
            $plazaNombre = "Tecate Agua";
            $database = 'implementtaTecateA';
            break;
        case '3':
            $plazaNombre = "Tecate Predial";
            $database = 'implementtaTecateP';
            break;
        case '4':
            $plazaNombre = "Coacalco Agua";
            $database = 'implementtaCoacalcoA';
            break;
        case '5':
            $plazaNombre = "Ensenada Agua";
            $database = 'implementtaEnsenadaA';
            break;
        case '6':
            $plazaNombre = "La Piedad Predial";
            $database = 'implementtaLaPiedadP';
            break;
        case '7':
            $plazaNombre = "Mexicali Agua";
            $database = 'implementtaMexicaliA';
            break;
        case '8':
            $plazaNombre = "Toluca Agua";
            $database = 'implementtaTolucaA';
            break;
        case '9':
            $plazaNombre = "Toluca Predial";
            $database = 'implementtaTolucaP';
            break;
        case '10':
            $plazaNombre = "Zapopan Predial";
            $database = 'implementtaZapopanP';
            break;
    }



    $serverName = "51.222.44.135";
    $connectionInfo = array( 'Database'=> $database, 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);
    date_default_timezone_set('America/Mexico_City');


?>