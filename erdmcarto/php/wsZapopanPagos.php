<?php
//https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/wsZapopanPagos.php?cta=1114046848
require "../../acnxerdm/cnx.php";

//************************ peticion CURL***********************************************
$curl = curl_init();
$cuenta=$_GET['cta'];

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pagos.zapopan.gob.mx/WSNotificaciones/SolicitarAdeudo',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "despacho": {
        "id": "379",
        "clave": "/pYj4c0WlwI/62hp#8-S4a6Lo"
    },
    "cuenta": "'.$cuenta.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//******************** fin peticion CURL***********************************************


$items = json_decode($response, true);
    
if(isset($items)){
    
    $tokenGen=date('His').rand(100,999).rand(100,999);
    $fechaInsert=date('d-m-Y');
    $horaInsert=date('H:i:s');
    $curt = str_replace("'", "", $items["CURT"]);
    $cuentaPredial = $items["CUENTADEPREDIAL"];
    $propietario = $items["NOMBRECOMPLETOPROPIETARIO"];
    $claveCatastral = $items["CLAVECATASTRAL"];
    $claveSectorial = $items["CLAVESECTORIAL"];
    $superficieTerreno = $items["SUPERFICIETERRENOTOTAL"];
    $superficieConstruccion = $items["SUPERFICIECONSTRUCCIONTOTAL"];
    $valorCatastral = $items["VALORCATASTRAL"];
    $domicilioWS = $items["UBICACION"];
//**********************************************************************************
    $BIM_INICIAL_FINAL=$items["BIM_INICIAL_FINAL"];
    $VAL_FISCAL_2017=$items["VAL_FISCAL_2017"];
    $VAL_FISCAL_2018=$items["VAL_FISCAL_2018"];
    $VAL_FISCAL_2019=$items["VAL_FISCAL_2019"];
    $VAL_FISCAL_2020=$items["VAL_FISCAL_2020"];
    $VAL_FISCAL_2021=$items["VAL_FISCAL_2021"];
    $VAL_FISCAL_2022=$items["VAL_FISCAL_2022"];
    $IMPUESTO_2017=$items["IMPUESTO_2017"];
    $IMPUESTO_2018=$items["IMPUESTO_2018"];
    $IMPUESTO_2019=$items["IMPUESTO_2019"];
    $IMPUESTO_2020=$items["IMPUESTO_2020"];
    $IMPUESTO_2021=$items["IMPUESTO_2021"];
    $IMPUESTO_2022=$items["IMPUESTO_2022"];
    $TASA_2017=$items["TASA_2017"];
    $TASA_2018=$items["TASA_2018"];
    $TASA_2019=$items["TASA_2019"];
    $TASA_2020=$items["TASA_2020"];
    $TASA_2021=$items["TASA_2021"];
    $TASA_2022=$items["TASA_2022"];
    $ACTUALIZACION_2017=$items["ACTUALIZACION_2017"];
    $ACTUALIZACION_2018=$items["ACTUALIZACION_2018"];
    $ACTUALIZACION_2019=$items["ACTUALIZACION_2019"];
    $ACTUALIZACION_2020=$items["ACTUALIZACION_2020"];
    $ACTUALIZACION_2021=$items["ACTUALIZACION_2021"];
    $ACTUALIZACION_2022=$items["ACTUALIZACION_2022"];
    $CORRIENTE_2017=$items["RECARGOS_CORRIENTE_2017"];
    $CORRIENTE_2018=$items["RECARGOS_CORRIENTE_2018"];
    $CORRIENTE_2019=$items["RECARGOS_CORRIENTE_2019"];
    $CORRIENTE_2020=$items["RECARGOS_CORRIENTE_2020"];
    $CORRIENTE_2021=$items["RECARGOS_CORRIENTE_2021"];
    $CORRIENTE_2022=$items["RECARGOS_CORRIENTE_2022"];
    $REZAGO_2017=$items["RECARGOS_REZAGO_2017"];
    $REZAGO_2018=$items["RECARGOS_REZAGO_2018"];
    $REZAGO_2019=$items["RECARGOS_REZAGO_2019"];
    $REZAGO_2020=$items["RECARGOS_REZAGO_2020"];
    $REZAGO_2021=$items["RECARGOS_REZAGO_2021"];
    $REZAGO_2022=$items["RECARGOS_REZAGO_2022"];
    $MULTA_2017=$items["MULTA_2017"];
    $MULTA_2018=$items["MULTA_2018"];
    $MULTA_2019=$items["MULTA_2019"];
    $MULTA_2020=$items["MULTA_2020"];
    $MULTA_2021=$items["MULTA_2021"];
    $MULTA_2022=$items["MULTA_2022"];
//**********************************************************************************
    
    $generales="insert into generales (token,fechaInsert,horaInsert,curt,cuentaPredial,propietario,claveCatastral,claveSectorial,superficieTerreno,superficieConstruccion,valorCatastral,domicilioWS,BIM_INICIAL_FINAL,VAL_FISCAL_2017,VAL_FISCAL_2018,VAL_FISCAL_2019,VAL_FISCAL_2020,VAL_FISCAL_2021,VAL_FISCAL_2022,IMPUESTO_2017,IMPUESTO_2018,IMPUESTO_2019,IMPUESTO_2020,IMPUESTO_2021,IMPUESTO_2022,TASA_2017,TASA_2018,TASA_2019,TASA_2020,TASA_2021,TASA_2022,ACTUALIZACION_2017,ACTUALIZACION_2018,ACTUALIZACION_2019,ACTUALIZACION_2020,ACTUALIZACION_2021,ACTUALIZACION_2022,CORRIENTE_2017,CORRIENTE_2018,CORRIENTE_2019,CORRIENTE_2020,CORRIENTE_2021,CORRIENTE_2022,REZAGO_2017,REZAGO_2018,REZAGO_2019,REZAGO_2020,REZAGO_2021,REZAGO_2022,MULTA_2017,MULTA_2018,MULTA_2019,MULTA_2020,MULTA_2021,MULTA_2022)
    values ('$tokenGen','$fechaInsert','$horaInsert','$curt','$cuentaPredial','$propietario','$claveCatastral','$claveSectorial','$superficieTerreno','$superficieConstruccion',
    '$valorCatastral','$domicilioWS','$BIM_INICIAL_FINAL','$VAL_FISCAL_2017','$VAL_FISCAL_2018','$VAL_FISCAL_2019','$VAL_FISCAL_2020','$VAL_FISCAL_2021','$VAL_FISCAL_2022','$IMPUESTO_2017','$IMPUESTO_2018','$IMPUESTO_2019','$IMPUESTO_2020','$IMPUESTO_2021','$IMPUESTO_2022','$TASA_2017','$TASA_2018','$TASA_2019','$TASA_2020','$TASA_2021','$TASA_2022','$ACTUALIZACION_2017','$ACTUALIZACION_2018','$ACTUALIZACION_2019','$ACTUALIZACION_2020','$ACTUALIZACION_2021','$ACTUALIZACION_2022','$CORRIENTE_2017','$CORRIENTE_2018','$CORRIENTE_2019','$CORRIENTE_2020','$CORRIENTE_2021','$CORRIENTE_2022','$REZAGO_2017','$REZAGO_2018','$REZAGO_2019','$REZAGO_2020','$REZAGO_2021','$REZAGO_2022','$MULTA_2017','$MULTA_2018','$MULTA_2019','$MULTA_2020','$MULTA_2021','$MULTA_2022')";
    sqlsrv_query($cnx,$generales) or die ('No se ejecuto la consulta insert generales');
    
    
    $va="select id_generales from generales
    where token='$tokenGen'";
    $val=sqlsrv_query($cnx,$va);
    $valida=sqlsrv_fetch_array($val);
    
if(isset($valida)){
    
$idGenrales=$valida['id_generales'];
    
//****************desglose bimestral***************************************************
$listaItems = $items["DESGLOSE_BIMESTRAL"];
    for ($i = 0; $i<count($listaItems); $i++){

        $anio=$listaItems[$i]["anio"];
        $bim=$listaItems[$i]["bim"];
        $valor_fiscal=$listaItems[$i]["valor_fiscal"];
        $impuesto=$listaItems[$i]["impuesto"];
        
        $desglose="insert into desgloseBim (id_generales,anio,bim,valorFiscal,impuesto)
        values ('$idGenrales','$anio','$bim','$valor_fiscal','$impuesto')";
        sqlsrv_query($cnx,$desglose) or die ('No se ejecuto la consulta insert desgloseBim');
        }
//**************fin desglose bimestral***************************************************
//***************historial pagos*********************************************************
$listaItemsHist = $items["HISTORIAL_PAGOS"];
    for ($n = 0; $n<count($listaItemsHist); $n++){

        $oid=$listaItemsHist[$n]["oid"];
        $folio=$listaItemsHist[$n]["folioformavalorada"]; //no se agrega folio y queda en NULL
        $fecha=$listaItemsHist[$n]["fecha"];
        $total=number_format($listaItemsHist[$n]["total"],3);
        
//    echo 'oid: '.$oid.'<br>folio: '.'<br>Fecha: '.$fecha.'<br>Total: '.$total.'<hr>'; //folio llega en array
        
        $historial="insert into historialPagos (id_generales,oid,folioFormaValorada,fecha,total)
        values ('$idGenrales','$oid','$folio','$fecha','$total')";
        sqlsrv_query($cnx,$historial) or die ('No se ejecuto la consulta insert historialPagos');
        }
//***************fin historial pagos******************************************************
    
    echo '<meta http-equiv="refresh" content="0,url=../../../implementta/modulos/determinaciones/zapopanpredial.php?clvCL='.$_GET['clvCL'].'&crt='.$_GET['crt'].'&exp='.$_GET['exp'].'&fRes='.$_GET['fRes'].'&flo='.$_GET['flo'].'">';
    
    }
}






















?>




