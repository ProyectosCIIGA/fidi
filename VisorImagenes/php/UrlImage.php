<?php
require "cnx.php";
header('Content-Type: application/json; charset=utf-8');

$cuenta = $_GET['cuenta'];
$bd = $_GET['bd'];
$sql = "SELECT urlS3 FROM fotosVisorS3 WHERE cuenta='$cuenta'";
$cnx = conexion($bd);
$exec = sqlsrv_query($cnx, $sql);
$rows = array();
while ($row = sqlsrv_fetch_array($exec, SQLSRV_FETCH_ASSOC)) {
    foreach ($row as $key => $value) {
        $row[$key] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }
    $rows[] = $row;
}

$jsonData = json_encode($rows, JSON_UNESCAPED_UNICODE);

if ($jsonData === false) {
    die(json_encode(array('error' => 'Error al convertir los datos en formato JSON')));
}

echo $jsonData;
