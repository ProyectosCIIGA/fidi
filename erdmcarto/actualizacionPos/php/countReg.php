<?php
$plaza = $_GET['plaza'];
require 'configConexiones.php';

if( $cnx == false ) {
    echo 'REVISE INTERNET';
}else{
    $resp = '';

    $countTotal = sqlsrv_query($cnx, "SELECT count(*) FROM PosicionesActualizar");

    if($countTotal != false){
        $rowTotal = sqlsrv_fetch_array($countTotal);
        $resp = $rowTotal[0];
    }else{
        $resp = '-1';
    }

    echo $resp;
}