<?php
$serverName = "51.222.44.135";
    $connectionInfoa = array( 'Database'=>'cartomaps', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnxa = sqlsrv_connect($serverName, $connectionInfoa);
    date_default_timezone_set('America/Mexico_City');

//***************** CONX A KPIMPLEMENTTA*****************************************
    $connectionInfoa = array( 'Database'=>'kpimplementta', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnxkpi = sqlsrv_connect($serverName, $connectionInfoa);
//******************FIN CNX KPIMPLEMENTTA****************************************

$plz=$_GET['plz'];

    $pro="SELECT * FROM plaza
    inner join proveniente on proveniente.id_proveniente=plaza.id_proveniente
    where plaza.id_plaza='$plz'";
    $prov=sqlsrv_query($cnxa,$pro);
    $proveniente=sqlsrv_fetch_array($prov);

if(isset($proveniente)){
    $connectionInfo = array( 'Database'=>$proveniente['data'], 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);
}



//if($_GET['plz']==1){
//    $connectionInfo = array( 'Database'=>'implementtaTijuanaA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==2){
//    //echo 'conect a plz Tecate';
//    $connectionInfo = array( 'Database'=>'implementtaTecateA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==3){
//    //echo 'conect a plz Ensenada';
//    $connectionInfo = array( 'Database'=>'implementtaEnsenadaA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==4){
//    //echo 'conect a plz Durango Agua';
//    $connectionInfo = array( 'Database'=>'implementtaDurangoA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==5){
//    //echo 'conect a plz Navolato Predial';
//    $connectionInfo = array( 'Database'=>'implementtaNavolatoP', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==6){
//    //echo 'conect a plz Piedras Negras Predial';
//    $connectionInfo = array( 'Database'=>'implementtaPiedrasNegras', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==7){
//    //echo 'conect a plz Torreon';
//    $connectionInfo = array( 'Database'=>'implementtaTorreonA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==8){
//    //echo 'conect a plz Los Reyes La Paz Agua';
//    $connectionInfo = array( 'Database'=>'implementtaLosReyesLaPazA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==9){
//    //echo 'conect a plz Mexicali Agua';
//    $connectionInfo = array( 'Database'=>'implementtaMexicaliA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==10){
//    //echo 'conect a plz Tijuana Predial';
//    $connectionInfo = array( 'Database'=>'implementtaTijuanaP', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==16){
//    //echo 'conect a plz La Paz BC';
//    $connectionInfo = array( 'Database'=>'implementtaLaPaz', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==19){
//    //echo 'conect a plz Los Reyes La Paz Predial';
//    $connectionInfo = array( 'Database'=>'implementtaLosReyesLaPazP', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//} else if($_GET['plz']==20){
//    //echo 'conect a plz Los Reyes La Paz Predial';
//    $connectionInfo = array( 'Database'=>'implementtaEnsenadaA', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//}
















?>