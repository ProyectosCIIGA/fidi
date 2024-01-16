<?php
$serverName = "51.222.44.135";
    $connectionInfo = array( 'Database'=>'cartomaps', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);
    date_default_timezone_set('America/Mexico_City');
?>