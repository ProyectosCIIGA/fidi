<?php 
function conexion($bd)
{
    $serverName = "51.222.44.135";
    $connectionInfo = array('Database' => $bd, 'UID' => 'sa', 'PWD' => 'vrSxHH3TdC');
    // $serverName = "DESKTOP-79KR1H4";
    // $connectionInfo = array('Database' => 'kpis', 'UID' => 'brayan', 'PWD' => '12345');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);
    if ($cnx) {
        return $cnx;
    } else {
        echo "error de conexion";
        die(print_r(sqlsrv_errors(), true));
    }
}