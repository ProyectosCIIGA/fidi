<?php
$serverName = "implementta.mx";
    $connectionInfo = array( 'Database'=>'inventario', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);

    $connectionInfo = array( 'Database'=>'implementtaMochisA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnxPlz = sqlsrv_connect($serverName, $connectionInfo);

    date_default_timezone_set('America/Mexico_City');

    $padron="select * from implementta";
    $datos=sqlsrv_query($cnxPlz,$padron);
    $regPad=sqlsrv_fetch_array($datos);

    $estado='Sinaloa';

do{
$direccion=str_replace(" ","+",$regPad['Calle'].'+'.$regPad['Colonia'].'+'.$regPad['Poblacion'].'+'.$estado);
//echo $direccion;

    
    $data = @file_get_contents('https://geocode.search.hereapi.com/v1/geocode?q='.$direccion.'&apiKey=ZtiMAY9sM1v3V0iqbWAqhYitjEAzVn5Mfbe59UKAWHA');
    $items = json_decode($data, true);
    
    if(isset($items)){
         $listaItems = $items["items"];

        for ($i = 0; $i<count($listaItems); $i++){

            $longitud=$listaItems[$i]["position"]["lat"];
            $latitud=$listaItems[$i]["position"]["lng"];

            //$direccion=$listaItems[$i]["title"];
//            $cuenta=$regPad['Cuenta'];
//            echo ' Long: '.$longitud.' Lat: '.$latitud.'<br>'.$direccion.' Cuenta= '.$cuenta.'<hr>';

            $USUARIO=$regPad['Cuenta'];
            $longitud=$longitud;
            $latitud=$latitud;
            $insertHora=date('d-m-Y_H:i:s');
            $respGeocodeDirec=$direccion;

            $LogLat="insert into padronLongLat (USUARIO,longitud,latitud,insertHora) 
            values ('$USUARIO','$longitud','$latitud','$insertHora')";
            sqlsrv_query($cnx,$LogLat) or die ('No se ejecuto la consulta isert reg accesos');
            
            }
        }
    } while($regPad=sqlsrv_fetch_array($datos));

    echo "<script>alert('Proceso de GeoCoding finalizado');</script>";
?>














