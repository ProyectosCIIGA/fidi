<?php
session_start();
//if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    
if(isset($_POST['save'])){
    
    $regInsert=date('d-m-Y H:i:s');
    
    $Estado=$_POST['estado'];
    $Region=$_POST['region'];
    $Municipio=$_POST['municipio'];
    $Zona=$_POST['zona'];
    $Loc=$_POST['loc'];
    $Sector=$_POST['sector'];
    $Manzana=$_POST['manzana'];
    $Predio=$_POST['predio'];
    $Edificio=$_POST['edificio'];
    $Unidad=$_POST['unidad'];
    $CCatastral=$_POST['claveCatastral'];
    $CPredial=$_POST['cuentaPredial'];
    $NPropietario=$_POST['nombreP'];
    $RSocial=$_POST['razonSocial'];
    $Calle=$_POST['calle'];
    $NumExterior=$_POST['numExt'];
    $NumInterior=$_POST['numInt'];
    $Colonia=$_POST['colonia'];
    $CP=$_POST['cp'];
    $SupTerreno=$_POST['supTerreno'];
    $SupConstruccion=$_POST['supConstruccion'];
    $VTerreno=$_POST['valorTerreno'];
    $VConstruccion=$_POST['valorConstruccionn'];
    $VCatastral=$_POST['valorCatastral'];
    $TServicio=$_POST['tipoServicio'];
    $Giro=$_POST['giro'];
    $Superficie=$_POST['superficie'];
    $Valor=$_POST['valor1'];
    $Frente=$_POST['frente(m)'];
    $FactorF=$_POST['factorF'];
    $Fondo=$_POST['fondo(m)'];
    $FactorFo=$_POST['factorFo'];
    $Posicion=$_POST['posicion'];
    $FactorP=$_POST['factorP'];
    $ValorAvenida=$_POST['valorA'];
    $Topografia=$_POST['topografia'];
    $FactorT=$_POST['factorT'];
    $ValorT=$_POST['valorTerreno1'];
    $EstadoEdificacion=$_POST['estadoEdi'];
    $UsoSuelo=$_POST['usoS'];
    $ConstruccionH=$_POST['construccionHistorica'];
    $ConstruccionA=$_POST['construccionActual'];
    $Diferencia=$_POST['diferencia'];
    
    
    $CCC17=$_POST['ccc17'];
    $M2_17=$_POST['m2_17'];
    $Valor17=$_POST['valorC17'];
    $Niveles17=$_POST['niveles17'];
    $TipoEdad17=$_POST['tipo/edad17'];
    $Calidad17=$_POST['calidad17'];
    $Conservacion17=$_POST['conservacion17'];
    $Valor_Cons17=$_POST['valorConstruccionA17'];
    $SupTerreno17=$_POST['supTerreno17'];
    $ValorConstruccion17=$_POST['valor17'];
    $ValorTerreno17=$_POST['valorTerreno17'];
    $SupConstruccion17=$_POST['supConstruccion17'];
    $ValorConst17=$_POST['valorConstruccion17'];
    $ValorCatastral17=$_POST['valorCatastral17'];
    
    
    
    $CCC18=$_POST['ccc18'];
    $M2_18=$_POST['m2_18'];
    $Valor18=$_POST['valorC18'];
    $Niveles18=$_POST['niveles18'];
    $TipoEdad18=$_POST['tipo/edad18'];
    $Calidad18=$_POST['calidad18'];
    $Conservacion18=$_POST['conservacion18'];
    $Valor_Cons18=$_POST['valorConstruccionA18'];
    $SupTerreno18=$_POST['supTerreno18'];
    $ValorConstruccion18=$_POST['valor18'];
    $ValorTerreno18=$_POST['valorTerreno18'];
    $SupConstruccion18=$_POST['supConstruccion18'];
    $ValorConst18=$_POST['valorConstruccion18'];
    $ValorCatastral18=$_POST['valorCatastral18'];
    $CCC19=$_POST['ccc19'];
    $M2_19=$_POST['m2_19'];
    $Valor19=$_POST['valorC19'];
    $Niveles19=$_POST['niveles19'];
    $TipoEdad19=$_POST['tipo/edad19'];
    $Calidad19=$_POST['calidad19'];
    $Conservacion19=$_POST['conservacion19'];
    $Valor_Cons19=$_POST['valorConstruccionA19'];
    $SupTerreno19=$_POST['supTerreno19'];
    $ValorConstruccion19=$_POST['valor19'];
    $ValorTerreno19=$_POST['valorTerreno19'];
    $SupConstruccion19=$_POST['supConstruccion19'];
    $ValorConst19=$_POST['valorConstruccion19'];
    $ValorCatastral19=$_POST['valorCatastral19'];
    $CCC20=$_POST['ccc20'];
    $M2_20=$_POST['m2_20'];
    $Valor20=$_POST['valorC20'];
    $Niveles20=$_POST['niveles20'];
    $TipoEdad20=$_POST['tipo/edad20'];
    $Calidad20=$_POST['calidad20'];
    $Conservacion20=$_POST['conservacion20'];
    $Valor_Cons20=$_POST['valorConstruccionA20'];
    $SupTerreno20=$_POST['supTerreno20'];
    $ValorConstruccion20=$_POST['valor20'];
    $ValorTerreno20=$_POST['valorTerreno20'];
    $SupConstruccion20=$_POST['supConstruccion20'];
    $ValorConst20=$_POST['valorConstruccion20'];
    $ValorCatastral20=$_POST['valorCatastral20'];
    $CCC21=$_POST['ccc21'];
    $M2_21=$_POST['m2_21'];
    $Valor21=$_POST['valorC21'];
    $Niveles21=$_POST['niveles21'];
    $TipoEdad21=$_POST['tipo/edad21'];
    $Calidad21=$_POST['calidad21'];
    $Conservacion21=$_POST['conservacion21'];
    $Valor_Cons21=$_POST['valorConstruccionA21'];
    $SupTerreno21=$_POST['supTerreno21'];
    $ValorConstruccion21=$_POST['valor21'];
    $ValorTerreno21=$_POST['valorTerreno21'];
    $SupConstruccion21=$_POST['supConstruccion21'];
    $ValorConst21=$_POST['valorConstruccion21'];
    $ValorCatastral21=$_POST['valorCatastral21'];
    $CCC22=$_POST['ccc22'];
    $M2_22=$_POST['m2_22'];
    $Valor22=$_POST['valorC22'];
    $Niveles22=$_POST['niveles22'];
    $TipoEdad22=$_POST['tipo/edad22'];
    $Calidad22=$_POST['calidad22'];
    $Conservacion22=$_POST['conservacion22'];
    $Valor_Cons22=$_POST['valorConstruccionA22'];
    $SupTerreno22=$_POST['supTerreno22'];
    $ValorConstruccion22=$_POST['valor22'];
    $ValorTerreno22=$_POST['valorTerreno22'];
    $SupConstruccion22=$_POST['supConstruccion22'];
    $ValorConst22=$_POST['valorConstruccion22'];
    $ValorCatastral22=$_POST['valorCatastral22'];
    
    
    
    
    
    $unidad="insert into fichaResult (registroInsert,Estado,Region,Municipio,Zona,Loc,Sector,Manzana,Predio,Edificio,Unidad,CCatastral,CPredial,NPropietario,RSocial,Calle,NumExterior,NumInterior,Colonia,CP,SupTerreno,SupConstruccion,VTerreno,VConstruccion,VCatastral,TServicio,Giro,Superficie,Valor,Frente,FactorF,Fondo,FactorFo,Posicion,FactorP,ValorAvenida,Topografia,FactorT,ValorT,EstadoEdificacion,UsoSuelo,ConstruccionH,ConstruccionA,Diferencia,CCC17,M2_17,Valor17,Niveles17,TipoEdad17,Calidad17,Conservacion17,Valor_Cons17,SupTerreno17,ValorConstruccion17,ValorTerreno17,SupConstruccion17,ValorConst17,ValorCatastral17,CCC18,M2_18,Valor18,Niveles18,TipoEdad18,Calidad18,Conservacion18,Valor_Cons18,SupTerreno18,ValorConstruccion18,ValorTerreno18,SupConstruccion18,ValorConst18,ValorCatastral18,CCC19,M2_19,Valor19,Niveles19,TipoEdad19,Calidad19,Conservacion19,Valor_Cons19,SupTerreno19,ValorConstruccion19,ValorTerreno19,SupConstruccion19,ValorConst19,ValorCatastral19,CCC20,M2_20,Valor20,Niveles20,TipoEdad20,Calidad20,Conservacion20,Valor_Cons20,SupTerreno20,ValorConstruccion20,ValorTerreno20,SupConstruccion20,ValorConst20,ValorCatastral20,CCC21,M2_21,Valor21,Niveles21,TipoEdad21,Calidad21,Conservacion21,Valor_Cons21,SupTerreno21,ValorConstruccion21,ValorTerreno21,SupConstruccion21,ValorConst21,ValorCatastral21,CCC22,M2_22,Valor22,Niveles22,TipoEdad22,Calidad22,Conservacion22,Valor_Cons22,SupTerreno22,ValorConstruccion22,ValorTerreno22,SupConstruccion22,ValorConst22,ValorCatastral22) values ('$regInsert','$Estado','$Region','$Municipio','$Zona','$Loc','$Sector','$Manzana','$Predio','$Edificio','$Unidad','$CCatastral','$CPredial','$NPropietario','$RSocial','$Calle','$NumExterior','$NumInterior','$Colonia','$CP','$SupTerreno','$SupConstruccion','$VTerreno','$VConstruccion','$VCatastral','$TServicio','$Giro','$Superficie','$Valor','$Frente','$FactorF','$Fondo','$FactorFo','$Posicion','$FactorP','$ValorAvenida','$Topografia','$FactorT','$ValorT','$EstadoEdificacion','$UsoSuelo','$ConstruccionH','$ConstruccionA','$Diferencia','$CCC17','$M2_17','$Valor17','$Niveles17','$TipoEdad17','$Calidad17','$Conservacion17','$Valor_Cons17','$SupTerreno17','$ValorConstruccion17','$ValorTerreno17','$SupConstruccion17','$ValorConst17','$ValorCatastral17','$CCC18','$M2_18','$Valor18','$Niveles18','$TipoEdad18','$Calidad18','$Conservacion18','$Valor_Cons18','$SupTerreno18','$ValorConstruccion18','$ValorTerreno18','$SupConstruccion18','$ValorConst18','$ValorCatastral18','$CCC19','$M2_19','$Valor19','$Niveles19','$TipoEdad19','$Calidad19','$Conservacion19','$Valor_Cons19','$SupTerreno19','$ValorConstruccion19','$ValorTerreno19','$SupConstruccion19','$ValorConst19','$ValorCatastral19','$CCC20','$M2_20','$Valor20','$Niveles20','$TipoEdad20','$Calidad20','$Conservacion20','$Valor_Cons20','$SupTerreno20','$ValorConstruccion20','$ValorTerreno20','$SupConstruccion20','$ValorConst20','$ValorCatastral20','$CCC21','$M2_21','$Valor21','$Niveles21','$TipoEdad21','$Calidad21','$Conservacion21','$Valor_Cons21','$SupTerreno21','$ValorConstruccion21','$ValorTerreno21','$SupConstruccion21','$ValorConst21','$ValorCatastral21','$CCC22','$M2_22','$Valor22','$Niveles22','$TipoEdad22','$Calidad22','$Conservacion22','$Valor_Cons22','$SupTerreno22','$ValorConstruccion22','$ValorTerreno22','$SupConstruccion22','$ValorConst22','$ValorCatastral22')";
	sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert nueva plz');
    
    
    echo '<script>alert("Alert desde Querys php")</script>';
    
    echo '<meta http-equiv="refresh" content="0,url=buscarFicha.php">';
    //echo '<script type="text/javascript">window.open("../pdf/fichaCatastral.php");</script>';
    
    
    
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>