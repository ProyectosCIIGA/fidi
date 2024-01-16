<?php
//header('Content-Type: text/html; charset=UTF-8');
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['doctos']))){
require "../../acnxerdm/cnx.php";

    $cuenta= $_GET['fic'];
//**************************************************************************
    $con="select * from tipologias
    where CLAVES=$cuenta";
    $construccion=sqlsrv_query($cnx,$con);
    $construccionActual=sqlsrv_fetch_array($construccion);

$superficieCons=0;
do{
    $superficieCons += $construccionActual['AREA'];
    
}while($construccionActual=sqlsrv_fetch_array($construccion));
//**************************************************************************
//***************************FOOTER***********************************************
    $fo="select * from footer";
    $foot=sqlsrv_query($cnx,$fo);
    $footer=sqlsrv_fetch_array($foot);

//*****************************FIN FOOTER******************************************
    
//**************************************************************************
    $va17="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores17=sqlsrv_query($cnx,$va17);
    $valores2017=sqlsrv_fetch_array($valores17);

//**************************************************************************

    $va18="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores18=sqlsrv_query($cnx,$va18);
    $valores2018=sqlsrv_fetch_array($valores18);

//**************************************************************************

    $va19="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores19=sqlsrv_query($cnx,$va19);
    $valores2019=sqlsrv_fetch_array($valores19);

//**************************************************************************

    $va20="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores20=sqlsrv_query($cnx,$va20);
    $valores2020=sqlsrv_fetch_array($valores20);

//**************************************************************************

    $va21="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores21=sqlsrv_query($cnx,$va21);
    $valores2021=sqlsrv_fetch_array($valores21);

//**************************************************************************

    $va22="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $valores22=sqlsrv_query($cnx,$va22);
    $valores2022=sqlsrv_fetch_array($valores22);

//**************************************************************************


    $fichasQuery="select tipologias.CLAVES,tipologias.CCC,tipologias.AREA,tipologias.NIVEL,padron.Cuenta_predial,
    padron.CURT as CURTtipologias,padron.Estado,padron.RegionCatastral,padron.Municipio,padron.ZonaCata,
    padron.Localidad,padron.SectorCat,padron.Manzana,padron.Predio,padron.Edificio,
    padron.Unidad,padron.Clave as clavePadron,padron.Propietario,padron.razonSocial,padron.Calle,padron.NumeroExterno,
    padron.NumeroInterno,padron.Colonia,padron.CP,padron.Superficie_de_Terreno,padron.Superficie_de_Construccion,
    padron.Valor_de_Terreno,padron.Valor_de_construccion,padron.ValorCatastral,padron.Tipo_de_Servicio,padron.Giro,
    padron.Frente as frentePadron,padron.Factor,padron.Fondo as fondoPadron,padron.Factor1,padron.Posicion,padron.Factor2,padron.Valorm2_1718,
    padron.Valorm2_19 as valor2_19Padron,padron.Valorm2_2022,padron.ValordeAV,padron.UsodeSuelo as usoSuelo,padron.ConstruccionActual,
    padron.Observaciones,cuentasActuales.cuentaPredial,cuentasActuales.CURT,cuentasActuales.Clave,
    cuentasActuales.Frente,cuentasActuales.Factor as factorCuentas,cuentasActuales.Fondo,cuentasActuales.Factor1 as factorUno,
    cuentasActuales.Posicion as posicionCuentas,cuentasActuales.Factor2 as factorDos,cuentasActuales.Valorm2_17_18,cuentasActuales.Valorm2_19,
    cuentasActuales.Valorm2_20_22,cuentasActuales.ValorAV,cuentasActuales.UsodeSuelo,cuentasActuales.Observaciones as observacionesCuentas,cuentasActuales.estadoEdificacion,cuentasActuales.Topografia,cuentasActuales.factorTopografia,
    cuentasActuales.tipodeServicio_Actual,cuentasActuales.giro_Actual,
    tablasValor.CCC as CCCvalor,tablasValor.VALOR2022,tablasValor.VALOR2021,tablasValor.VALOR2020,tablasValor.VALOR2019,tablasValor.VALOR2018,
    tablasValor.VALOR2017,tablasValor.EDAD,tablasValor.CALIDAD,tablasValor.estadoConservacion from tipologias
    inner join PadronCataZapopan as padron on padron.Cuenta_predial=tipologias.CLAVES
    inner join cuentasActuales on cuentasActuales.cuentaPredial=padron.Cuenta_predial
    inner join tablasValor on tablasValor.CCC=tipologias.CCC
    where tipologias.CLAVES=$cuenta";
    $fichasQueryResult=sqlsrv_query($cnx,$fichasQuery);
    $fichas=sqlsrv_fetch_array($fichasQueryResult); 
    
    $CURT=$fichas['CURTtipologias'];
    
//if valor es nulo**************************************
    $valM2_22=$fichas['Valorm2_20_22'];
    if($fichas['Valorm2_20_22'] == NULL){
        $valM2_22=1;
    } else{
        $valM2_22=$fichas['Valorm2_20_22'];
    }
//******************************************************
    
//********************** execute ficha **************************************
if(isset($_POST['save'])){
    
    $cPredialRep=$_POST['cuentaPredial'];
    
    $re="select * from fichaResult
    where CPredial='$cPredialRep'";
    $rep=sqlsrv_query($cnx,$re);
    $repetida=sqlsrv_fetch_array($rep);    
    
if(isset($repetida)){
    
    $tokenResult=$repetida['tokenResult'];
    
    echo '<script>alert("Ya existe un registro de ficha catastral para esta cuenta predial. No se agregara un nuevo registro, si requiere modificaciones notifique al área de sistemas.")</script>';
    
    echo '<meta http-equiv="refresh" content="0,url=buscarFicha.php">';
    echo '<script type="text/javascript">window.open("../pdf/fichaCatastral.php?clvCL='.$tokenResult.'&crt='.$CURT.'&cut='.$tokenResult.'");</script>';
    
} else{
    
    $idFooter=1;
    $regInsert=date('Y-m-d');
    $horaInsert=date('H:i:s');
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
    $TServicioA=$_POST['tipoServicioA'];
    $GiroA=$_POST['giroA'];
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
    $observaciones=$_POST['observaciones'];
    $tokenResult=rand(100,999).rand(100,999).date('Ymdhis');
    
    $unidad="insert into fichaResult (id_footer,registroInsert,horaInsert,Estado,Region,Municipio,Zona,Loc,Sector,Manzana,Predio,Edificio,Unidad,CCatastral,CPredial,NPropietario,RSocial,Calle,NumExterior,NumInterior,Colonia,CP,SupTerreno,SupConstruccion,VTerreno,VConstruccion,VCatastral,TServicio,Giro,Superficie,Valor,Frente,FactorF,Fondo,FactorFo,Posicion,FactorP,ValorAvenida,Topografia,FactorT,ValorT,EstadoEdificacion,UsoSuelo,ConstruccionH,ConstruccionA,Diferencia,tokenResult,tipoServicioA,giroA,observaciones) values ('$idFooter','$regInsert','$horaInsert','$Estado','$Region','$Municipio','$Zona','$Loc','$Sector','$Manzana','$Predio','$Edificio','$Unidad','$CCatastral','$CPredial','$NPropietario','$RSocial','$Calle','$NumExterior','$NumInterior','$Colonia','$CP','$SupTerreno','$SupConstruccion','$VTerreno','$VConstruccion','$VCatastral','$TServicio','$Giro','$Superficie','$Valor','$Frente','$FactorF','$Fondo','$FactorFo','$Posicion','$FactorP','$ValorAvenida','$Topografia','$FactorT','$ValorT','$EstadoEdificacion','$UsoSuelo','$ConstruccionH','$ConstruccionA','$Diferencia','$tokenResult','$TServicioA','$GiroA','$observaciones')";
	sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert nueva plz');
//*********************************validad id*********************************************************************************
    $di="select id_fichaResult from fichaResult
    where tokenResult=$tokenResult"; 
    $idfic=sqlsrv_query($cnx,$di);
    $idFicha=sqlsrv_fetch_array($idfic);
    
    $idFichaResult=$idFicha['id_fichaResult'];
//*********************************validad id*********************************************************************************
    
    
    
    
    
    
    
    
    
    
    
//************************************2017************************************************************************************
//insert valCatastrales
    $anio17='2017';
    $SupTerreno17=$_POST['supTerreno17'];
    $ValorConstruccion17=$_POST['valor17'];
    $ValorTerreno17=$_POST['valorTerreno17'];
    $SupConstruccion17=$_POST['supConstruccion17'];
    $ValorConst17=$_POST['valorConstruccion17'];
    $ValorCatastral17=$_POST['valorCatastral17'];
    $tokenValCatas17=$tokenResult;
    $descri17="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio17','$SupTerreno17','$ValorConstruccion17','$ValorTerreno17','$SupConstruccion17','$ValorConst17','$ValorCatastral17','$tokenValCatas17')";
    sqlsrv_query($cnx,$descri17) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a17="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas17"; 
    $aa17=sqlsrv_query($cnx,$a17);
    $idValCatastrales17=sqlsrv_fetch_array($aa17);
    
    $idValoresCata17=$idValCatastrales17['id_valCatastrales'];
//validad id
        $superficie17 = 0;
        $valorContruct17 = 0;
        $valNivel17=0;
        do{
        $valorConstruccion17= $valores2017['AREA'] * $valores2017['VALOR2017'];
           if($valores2017['NIVEL'] >= 4){
               $valNivel17=$valores2017['NIVEL'];
           }
          $superficie17 += $valores2017['AREA'];
          $valorContruct17 += $valorConstruccion17;
           
            $anioDescript17='2017';
            $id_fichaResult17=$idFichaResult;
            $id_valCatastrales17=$idValoresCata17;
            $CCC17=$valores2017['CCC'];
            $M2_17=$valores2017['AREA'];
            $Valor17='$'.number_format($valores2017['VALOR2017'],2);
            $Niveles17=$valores2017['NIVEL'];
            $TipoEdad17=$valores2017['EDAD'];
            $Calidad17=$valores2017['CALIDAD'];
            $Conservacion17=$valores2017['estadoConservacion'];
            $valorConst17='$'.number_format($valorConstruccion17,2);
            $descri17="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult17','$id_valCatastrales17','$anioDescript17','$CCC17','$M2_17','$Valor17','$Niveles17','$TipoEdad17','$Calidad17','$Conservacion17','$valorConst17')";
            sqlsrv_query($cnx,$descri17) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2017=sqlsrv_fetch_array($valores17));
//************************************2017************************************************************************************
    
    
    
    
//************************************2018************************************************************************************
//insert valCatastrales
    $anio18='2018';
    $SupTerreno18=$_POST['supTerreno18'];
    $ValorConstruccion18=$_POST['valor18'];
    $ValorTerreno18=$_POST['valorTerreno18'];
    $SupConstruccion18=$_POST['supConstruccion18'];
    $ValorConst18=$_POST['valorConstruccion18'];
    $ValorCatastral18=$_POST['valorCatastral18'];
    $tokenValCatas18=$tokenResult;
    $descri18="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio18','$SupTerreno18','$ValorConstruccion18','$ValorTerreno18','$SupConstruccion18','$ValorConst18','$ValorCatastral18','$tokenValCatas18')";
    sqlsrv_query($cnx,$descri18) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a18="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas18"; 
    $aa18=sqlsrv_query($cnx,$a18);
    $idValCatastrales18=sqlsrv_fetch_array($aa18);
    
    $idValoresCata18=$idValCatastrales18['id_valCatastrales'];
//validad id
        $superficie18 = 0;
        $valorContruct18 = 0;
        $valNivel18=0;
        do{
        $valorConstruccion18= $valores2018['AREA'] * $valores2018['VALOR2018'];
           if($valores2018['NIVEL'] >= 4){
               $valNivel18=$valores2018['NIVEL'];
           }
          $superficie18 += $valores2018['AREA'];
          $valorContruct18 += $valorConstruccion18;
           
            $anioDescript18='2018';
            $id_fichaResult18=$idFichaResult;
            $id_valCatastrales18=$idValoresCata18;
            $CCC18=$valores2018['CCC'];
            $M2_18=$valores2018['AREA'];
            $Valor18='$'.number_format($valores2018['VALOR2018'],2);
            $Niveles18=$valores2018['NIVEL'];
            $TipoEdad18=$valores2018['EDAD'];
            $Calidad18=$valores2018['CALIDAD'];
            $Conservacion18=$valores2018['estadoConservacion'];
            $valorConst18='$'.number_format($valorConstruccion18,2);
            $descri18="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult18','$id_valCatastrales18','$anioDescript18','$CCC18','$M2_18','$Valor18','$Niveles18','$TipoEdad18','$Calidad18','$Conservacion18','$valorConst18')";
            sqlsrv_query($cnx,$descri18) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2018=sqlsrv_fetch_array($valores18));
//************************************2018************************************************************************************
    
    
    
    
    
    
//************************************2019************************************************************************************
//insert valCatastrales
    $anio19='2019';
    $SupTerreno19=$_POST['supTerreno19'];
    $ValorConstruccion19=$_POST['valor19'];
    $ValorTerreno19=$_POST['valorTerreno19'];
    $SupConstruccion19=$_POST['supConstruccion19'];
    $ValorConst19=$_POST['valorConstruccion19'];
    $ValorCatastral19=$_POST['valorCatastral19'];
    $tokenValCatas19=$tokenResult;
    $descri19="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio19','$SupTerreno19','$ValorConstruccion19','$ValorTerreno19','$SupConstruccion19','$ValorConst19','$ValorCatastral19','$tokenValCatas19')";
    sqlsrv_query($cnx,$descri19) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a19="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas19"; 
    $aa19=sqlsrv_query($cnx,$a19);
    $idValCatastrales19=sqlsrv_fetch_array($aa19);
    
    $idValoresCata19=$idValCatastrales19['id_valCatastrales'];
//validad id
        $superficie19 = 0;
        $valorContruct19 = 0;
        $valNivel19=0;
        do{
        $valorConstruccion19= $valores2019['AREA'] * $valores2019['VALOR2019'];
           if($valores2019['NIVEL'] >= 4){
               $valNivel19=$valores2019['NIVEL'];
           }
          $superficie19 += $valores2019['AREA'];
          $valorContruct19 += $valorConstruccion19;
           
            $anioDescript19='2019';
            $id_fichaResult19=$idFichaResult;
            $id_valCatastrales19=$idValoresCata19;
            $CCC19=$valores2019['CCC'];
            $M2_19=$valores2019['AREA'];
            $Valor19='$'.number_format($valores2019['VALOR2019'],2);
            $Niveles19=$valores2019['NIVEL'];
            $TipoEdad19=$valores2019['EDAD'];
            $Calidad19=$valores2019['CALIDAD'];
            $Conservacion19=$valores2019['estadoConservacion'];
            $valorConst19='$'.number_format($valorConstruccion19,2);
            $descri19="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult19','$id_valCatastrales19','$anioDescript19','$CCC19','$M2_19','$Valor19','$Niveles19','$TipoEdad19','$Calidad19','$Conservacion19','$valorConst19')";
            sqlsrv_query($cnx,$descri19) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2019=sqlsrv_fetch_array($valores19));
//************************************2019************************************************************************************
    
    
    
    
    
    
//************************************2020************************************************************************************
//insert valCatastrales
    $anio20='2020';
    $SupTerreno20=$_POST['supTerreno20'];
    $ValorConstruccion20=$_POST['valor20'];
    $ValorTerreno20=$_POST['valorTerreno20'];
    $SupConstruccion20=$_POST['supConstruccion20'];
    $ValorConst20=$_POST['valorConstruccion20'];
    $ValorCatastral20=$_POST['valorCatastral20'];
    $tokenValCatas20=$tokenResult;
    $descri20="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio20','$SupTerreno20','$ValorConstruccion20','$ValorTerreno20','$SupConstruccion20','$ValorConst20','$ValorCatastral20','$tokenValCatas20')";
    sqlsrv_query($cnx,$descri20) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a20="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas20"; 
    $aa20=sqlsrv_query($cnx,$a20);
    $idValCatastrales20=sqlsrv_fetch_array($aa20);
    
    $idValoresCata20=$idValCatastrales20['id_valCatastrales'];
//validad id
        $superficie20 = 0;
        $valorContruct20 = 0;
        $valNivel20=0;
        do{
        $valorConstruccion20= $valores2020['AREA'] * $valores2020['VALOR2020'];
           if($valores2020['NIVEL'] >= 4){
               $valNivel20=$valores2020['NIVEL'];
           }
          $superficie20 += $valores2020['AREA'];
          $valorContruct20 += $valorConstruccion20;
           
            $anioDescript20='2020';
            $id_fichaResult20=$idFichaResult;
            $id_valCatastrales20=$idValoresCata20;
            $CCC20=$valores2020['CCC'];
            $M2_20=$valores2020['AREA'];
            $Valor20='$'.number_format($valores2020['VALOR2020'],2);
            $Niveles20=$valores2020['NIVEL'];
            $TipoEdad20=$valores2020['EDAD'];
            $Calidad20=$valores2020['CALIDAD'];
            $Conservacion20=$valores2020['estadoConservacion'];
            $valorConst20='$'.number_format($valorConstruccion20,2);
            $descri20="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult20','$id_valCatastrales20','$anioDescript20','$CCC20','$M2_20','$Valor20','$Niveles20','$TipoEdad20','$Calidad20','$Conservacion20','$valorConst20')";
            sqlsrv_query($cnx,$descri20) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2020=sqlsrv_fetch_array($valores20));
//************************************2020************************************************************************************
    
    
    
    
    
    
    
    
    
//************************************2021************************************************************************************
//insert valCatastrales
    $anio21='2021';
    $SupTerreno21=$_POST['supTerreno21'];
    $ValorConstruccion21=$_POST['valor21'];
    $ValorTerreno21=$_POST['valorTerreno21'];
    $SupConstruccion21=$_POST['supConstruccion21'];
    $ValorConst21=$_POST['valorConstruccion21'];
    $ValorCatastral21=$_POST['valorCatastral21'];
    $tokenValCatas21=$tokenResult;
    $descri21="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio21','$SupTerreno21','$ValorConstruccion21','$ValorTerreno21','$SupConstruccion21','$ValorConst21','$ValorCatastral21','$tokenValCatas21')";
    sqlsrv_query($cnx,$descri21) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a21="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas21"; 
    $aa21=sqlsrv_query($cnx,$a21);
    $idValCatastrales21=sqlsrv_fetch_array($aa21);
    
    $idValoresCata21=$idValCatastrales21['id_valCatastrales'];
//validad id
        $superficie21 = 0;
        $valorContruct21 = 0;
        $valNivel21=0;
        do{
        $valorConstruccion21= $valores2021['AREA'] * $valores2021['VALOR2021'];
           if($valores2021['NIVEL'] >= 4){
               $valNivel21=$valores2021['NIVEL'];
           }
          $superficie21 += $valores2021['AREA'];
          $valorContruct21 += $valorConstruccion21;
           
            $anioDescript21='2021';
            $id_fichaResult21=$idFichaResult;
            $id_valCatastrales21=$idValoresCata21;
            $CCC21=$valores2021['CCC'];
            $M2_21=$valores2021['AREA'];
            $Valor21='$'.number_format($valores2021['VALOR2021'],2);
            $Niveles21=$valores2021['NIVEL'];
            $TipoEdad21=$valores2021['EDAD'];
            $Calidad21=$valores2021['CALIDAD'];
            $Conservacion21=$valores2021['estadoConservacion'];
            $valorConst21='$'.number_format($valorConstruccion21,2);
            $descri21="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult21','$id_valCatastrales21','$anioDescript21','$CCC21','$M2_21','$Valor21','$Niveles21','$TipoEdad21','$Calidad21','$Conservacion21','$valorConst21')";
            sqlsrv_query($cnx,$descri21) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2021=sqlsrv_fetch_array($valores21));
//************************************2021************************************************************************************
    
    
    
    
    
    
    
//************************************2022************************************************************************************
//insert valCatastrales
    $anio22='2022';
    $SupTerreno22=$_POST['supTerreno22'];
    $ValorConstruccion22=$_POST['valor22'];
    $ValorTerreno22=$_POST['valorTerreno22'];
    $SupConstruccion22=$_POST['supConstruccion22'];
    $ValorConst22=$_POST['valorConstruccion22'];
    $ValorCatastral22=$_POST['valorCatastral22'];
    $tokenValCatas22=$tokenResult;
    $descri22="insert into valCatastrales (anio,supTerreno,valor,valTerreno,supConstruct,valorConstruct,valorCatastral,tokenValCatas)
    values ('$anio22','$SupTerreno22','$ValorConstruccion22','$ValorTerreno22','$SupConstruccion22','$ValorConst22','$ValorCatastral22','$tokenValCatas22')";
    sqlsrv_query($cnx,$descri22) or die ('No se ejecuto la consulta valCatastrales');
//fin insert valCatastrales
//validad id
    $a22="select id_valCatastrales from valCatastrales
    where tokenValCatas=$tokenValCatas22"; 
    $aa22=sqlsrv_query($cnx,$a22);
    $idValCatastrales22=sqlsrv_fetch_array($aa22);
    
    $idValoresCata22=$idValCatastrales22['id_valCatastrales'];
//validad id
        $superficie22 = 0;
        $valorContruct22 = 0;
        $valNivel22=0;
        do{
        $valorConstruccion22= $valores2022['AREA'] * $valores2022['VALOR2022'];
           if($valores2022['NIVEL'] >= 4){
               $valNivel22=$valores2022['NIVEL'];
           }
          $superficie22 += $valores2022['AREA'];
          $valorContruct22 += $valorConstruccion22;
           
            $anioDescript22='2022';
            $id_fichaResult22=$idFichaResult;
            $id_valCatastrales22=$idValoresCata22;
            $CCC22=$valores2022['CCC'];
            $M2_22=$valores2022['AREA'];
            $Valor22='$'.number_format($valores2022['VALOR2022'],2);
            $Niveles22=$valores2022['NIVEL'];
            $TipoEdad22=$valores2022['EDAD'];
            $Calidad22=$valores2022['CALIDAD'];
            $Conservacion22=$valores2022['estadoConservacion'];
            $valorConst22='$'.number_format($valorConstruccion22,2);
            $descri22="insert into descriptConstruct (id_fichaResult,id_valCatastrales,anioDescript,ccc,m2,valor,niveles,tipo_edad,calidad,conservacion,valConstruct) 
            values ('$id_fichaResult22','$id_valCatastrales22','$anioDescript22','$CCC22','$M2_22','$Valor22','$Niveles22','$TipoEdad22','$Calidad22','$Conservacion22','$valorConst22')";
            sqlsrv_query($cnx,$descri22) or die ('No se ejecuto la consulta isert descriptConstruct');
          }while($valores2022=sqlsrv_fetch_array($valores22));
//************************************2022************************************************************************************
    
    
    
    
//    echo '<script>alert("Alert desde Querys php")</script>';
    
    echo '<meta http-equiv="refresh" content="0,url=buscarFicha.php">';
    echo '<script type="text/javascript">window.open("../pdf/fichaCatastral.php?clvCL='.$tokenResult.'&crt='.$CURT.'&cut='.$tokenResult.'");</script>';
    
    }
}
//******************** fin execute ficha ************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Valuacion Catastral - FIDI</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/peticionAjax.js"></script>
<style>
  body {
        background-image: url(../img/back.jpg);
        background-repeat: repeat;
        background-size: 100%;
/*        background-attachment: fixed;*/
        overflow-x: hidden; /* ocultar scrolBar horizontal*/
    }
        body{
    font-family: sans-serif;
    font-style: normal;
    font-weight:bold;
    width: 100%;
    height: 100%;
    margin-top:-1%;
    padding-top:0px;
}
    .jumbotron {
        margin-top:0%;
        margin-bottom:0%;
        padding-top:3%;
        padding-bottom:2%;
}
    .padding {
        padding-right:35%;
        padding-left:35%;
    }
    </style>
<?php require "include/nav.php"; ?>
</head>
<body>
<div class="container">
   <form action="" method="post">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Fichas Catastrales Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/fluency/40/000000/project-setup--v3.png"/> Valuaciones Catastrales Zapopan, Jalisco</h4>
  <hr>
<!--  *********************************************************************************************************************************************-->
<div class="jumbotron">
    <h4 style="text-shadow: 1px 1px 2px #717171;">Clave unica</h4>
    
    <table class="table table-light table-sm table-bordered ">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Estado</th>
          <th scope="col">Region</th>
          <th scope="col">Municipio</th>
          <th scope="col">Zona</th>
          <th scope="col">Loc</th>
          <th scope="col">Sector</th>
          <th scope="col">Manzana</th>
          <th scope="col">Predio</th>
          <th scope="col">Edificio</th>
          <th scope="col">Unidad</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="estado" placeholder="Estado"  value="<?php  echo $fichas['Estado'] ?>" autofocus></td>
          <td><input type="text" class="form-control" name="region" placeholder="Region" value="<?php  echo $fichas['RegionCatastral'] ?>" ></td>
          <td><input type="text" class="form-control" name="municipio" placeholder="Municipio" value="<?php  echo $fichas['Municipio'] ?>" ></td>
          <td><input type="text" class="form-control" name="zona" placeholder="Zona" value="<?php  echo $fichas['ZonaCata'] ?>" ></td>
          <td><input type="text" class="form-control" name="loc" placeholder="Loc" value="<?php  echo $fichas['Localidad'] ?>" ></td>
          <td><input type="text" class="form-control" name="sector" placeholder="Sector" value="<?php  echo $fichas['SectorCat'] ?>" ></td>
          <td><input type="text" class="form-control" name="manzana" placeholder="Manzana" value="<?php  echo $fichas['Manzana'] ?>" ></td>
          <td><input type="text" class="form-control" name="predio" placeholder="Predio" value="<?php  echo $fichas['Predio'] ?>" ></td>
          <td><input type="text" class="form-control" name="edificio" placeholder="Edificio" value="<?php  echo $fichas['Edificio'] ?>" ></td>
          <td><input type="text" class="form-control" name="unidad" placeholder="Unidad" value="<?php  echo $fichas['Unidad'] ?>" ></td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Datos de identificacion</h5>
    <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Clave Catastral: *</label>
    <input type="text" class="form-control" name="claveCatastral" placeholder="Clave Catastral" value="<?php echo $fichas['Clave'] ?>" >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Cuenta Predial: *</label>
    <input type="text" class="form-control" name="cuentaPredial" placeholder="Cuenta Predial" value="<?php  echo $fichas['Cuenta_predial'] ?>" >
          </div>
        </div>
        </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Datos del propietario</h5>
     <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Nombre: *</label>
    <input type="text" class="form-control" name="nombreP" placeholder="Nombre" value="<?php  echo utf8_encode($fichas['Propietario']) ?>"  >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Razon Social: *</label>
    <input type="text" class="form-control" name="razonSocial" placeholder="Razon Social" value="<?php  echo utf8_encode($fichas['razonSocial']) ?>" >
          </div>
        </div>
        </div>
    <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Calle: *</label>
    <input type="text" class="form-control" name="calle" placeholder="Calle" value="<?php  echo utf8_encode($fichas['Calle']) ?>" >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Numero Ext: *</label>
    <input type="text" class="form-control" name="numExt" placeholder="Numero Ext" value="<?php  echo $fichas['NumeroExterno'] ?>" >
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Numero Int: *</label>
    <input type="text" class="form-control" name="numInt" placeholder="Numero Int" value="<?php  echo $fichas['NumeroInterno'] ?>" >
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Colonia: *</label>
    <input type="text" class="form-control" name="colonia" placeholder="Colonia" value="<?php  echo utf8_encode($fichas['Colonia']) ?>" >
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">C.P: *</label>
    <input type="text" class="form-control" name="cp" placeholder="C.P" value="<?php  echo $fichas['CP'] ?>">
          </div>
        </div>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Historico del Predio</h5>
       <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Sup. Terreno (m2): *</label>
    <input type="text" class="form-control" name="supTerreno" placeholder="Sup. Terreno (m2)" value="<?php  echo $fichas['Superficie_de_Terreno'] ?>" >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Sup. Construccion (m2): *</label>
    <input type="text" class="form-control" name="supConstruccion" placeholder="Sup. Construccion (m2)" value="<?php  echo $fichas['Superficie_de_Construccion'] ?>" >
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Valor Terreno: *</label>
    <input type="text" class="form-control" name="valorTerreno" placeholder="Valor Terreno" value="<?php  echo '$'.number_format($fichas['Valor_de_Terreno'],2) ?>" >
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Valor Construccion: *</label>
    <input type="text" class="form-control" name="valorConstruccionn" placeholder="Valor Construccion" value="<?php  echo '$'.number_format($fichas['Valor_de_construccion'],2) ?>">
          </div>
        </div>
      <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Valor Catastral: *</label>
    <input type="text" class="form-control" name="valorCatastral" placeholder="Valor Catastral" value="<?php  echo '$'.number_format($fichas['ValorCatastral'],2) ?>">
          </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Tipo de Servicio (Historico): *</label>
    <input type="text" class="form-control" name="tipoServicio" placeholder="Tipo de Servicio" value="<?php  echo $fichas['Tipo_de_Servicio'] ?>" >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Giro (Historico): *</label>
    <input type="text" class="form-control" name="giro" placeholder="Giro" value="<?php  echo $fichas['Giro'] ?>">
          </div>
        </div>
    </div>
        
<!--******************************************************************************************************************************-->









    <div class="form-row">
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Tipo de Servicio (Actual): *</label>
    <input type="text" class="form-control" name="tipoServicioA" placeholder="Tipo de Servicio" value="<?php  echo $fichas['tipodeServicio_Actual'] ?>" >
          </div>
        </div>
        <div class="col">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Giro (Actual): *</label>
    <input type="text" class="form-control" name="giroA" placeholder="Giro" value="<?php  echo $fichas['giro_Actual'] ?>">
          </div>
        </div>
    </div>
        
        
        
        
        
<!--******************************************************************************************************************************-->
    <hr>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <h5 style="text-shadow: 1px 1px 2px #717171;">Datos del terreno</h5>
 <div class="container">
    <table class="table table-light table-sm table-bordered ">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Superficie</th>
          <th scope="col">Valor (m2)</th>
          <th scope="col">Frente(m)</th>
          <th scope="col">Factor</th>
          <th scope="col">Fondo(m)</th>
          <th scope="col">Factor</th>
          <th scope="col">Posición</th>
          <th scope="col">Factor</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td> <input type="text" class="form-control" name="superficie" value="<?php  echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor1" value="<?php  echo '$'.number_format($valM2_22,2) ?>" ></td>
          
<!--          **********************************************************************************
         
         -->
         
         
         
         
         
         
         
         
         
         
         
          <td><input type="text" class="form-control" name="frente(m)" value="<?php  echo $fichas['Frente'] ?>" ></td>
          <td><input type="text" class="form-control" name="factorF" value="<?php  echo $fichas['factorCuentas'] ?>" ></td>
          <td><input type="text" class="form-control" name="fondo(m)" value="<?php  echo $fichas['Fondo'] ?>" ></td>
          <td><input type="text" class="form-control" name="factorFo" value="<?php  echo $fichas['factorUno'] ?>" ></td>
          <td><input type="text" class="form-control" name="posicion" value="<?php  echo $fichas['posicionCuentas'] ?>" ></td>
          <td><input type="text" class="form-control" name="factorP" value="<?php  echo $fichas['factorDos'] ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Valor de avenida</th>
          <th scope="col">Topografia</th>
          <th scope="col">Factor</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Estado de edificación</th>
          <th scope="col">Uso de suelo</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
    <?php if($fichas['ValorAV'] == NULL){
        $valorAvenida=0.00;
    } else{
        $valorAvenida=$fichas['ValorAV'];
    } ?>
          <td><input type="text" class="form-control" name="valorA" value="<?php  echo '$'.number_format($valorAvenida,2) ?>" ></td>
          
          
<!--    ****************************************************************-->
          <td><input type="text" class="form-control" name="topografia" value="<?php  echo $fichas['Topografia'] ?>"></td>
          <td><input type="text" class="form-control" name="factorT" value="<?php  echo $fichas['factorTopografia']?>"></td>
<!--    //************************************************************************-->
          
          
    <?php
    if($fichas['factorCuentas'] == NULL){
        $factorCuenta=1;
    } else{
        $factorCuenta=$fichas['factorCuentas'];
    }
    if($fichas['factorUno'] == NULL){
        $factorUno=1;
    } else{
        $factorUno=$fichas['factorUno'];
    }
    if($fichas['factorDos'] == NULL){
        $factorDos=1;
    } else{
        $factorDos=$fichas['factorDos'];
    }
    if($fichas['factorTopografia'] == NULL){
        $factorTopografia=1;
    } else{
        $factorTopografia=$fichas['factorTopografia'];
    }
    
    
    
    if($valM2_22 > $valorAvenida){
        $ValTerreno=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia; 
     } else if($valM2_22 < $valorAvenida){
        $ValTerreno=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
     } ?>
          
          <td><input type="text" class="form-control" name="valorTerreno1" value="<?php  echo '$'.number_format($ValTerreno,2) ?>" ></td>
          
          <td><input type="text" class="form-control" name="estadoEdi" value="<?php  echo $fichas['estadoEdificacion'] ?>" ></td>
          
          
          <td><input type="text" class="form-control" name="usoS" value="<?php  echo $fichas['UsodeSuelo'] ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Diferencia de contrucción</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Contruccion Historica (m2)</th>
          <th scope="col">Construccion actual (m2)</th>
          <th scope="col">Diferencia (m2)</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="construccionHistorica" value="<?php  echo $fichas['Superficie_de_Construccion'] ?>" ></td>
         
          <td><input type="text" class="form-control" name="construccionActual" value="<?php  echo $superficieCons ?>" ></td>
          
    <?php 
        $construccionHistorica=$fichas['Superficie_de_Construccion'];
        $diferencia=$superficieCons - $construccionHistorica;
            ?>      
          <td><input type="text" class="form-control" name="diferencia" value="<?php echo $diferencia ?>" ></td>
          
          
          
        </tr>
      </tbody>
    </table>
    </div>
    <hr>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2017</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie = 0;
        $valorContruct = 0;
        $valNivel=0;
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc17" value="<?php echo $valores2017['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_17" value="<?php echo $valores2017['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC17" value="<?php echo '$'.number_format($valores2017['VALOR2017'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles17" value="<?php echo $valores2017['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad17" value="<?php echo $valores2017['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad17" value="<?php echo $valores2017['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion17" value="<?php echo $valores2017['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion= $valores2017['AREA'] * $valores2017['VALOR2017'];
           
           if($valores2017['NIVEL'] >= 4){
               $valNivel=$valores2017['NIVEL'];
           }
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA17" value="<?php echo '$'.number_format($valorConstruccion,2) ?>" ></td>
        </tr>
        <?php 
          $superficie += $valores2017['AREA'];
          $valorContruct += $valorConstruccion;
           
           
           
           
           
           
           
          }while($valores2017=sqlsrv_fetch_array($valores17));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2017 (del 4to al 6to bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno17" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor17" value="<?php echo '$'.number_format($fichas['Valorm2_17_18'],2) ?>" ></td>
          
    <?php
        if($fichas['Valorm2_17_18'] > $valorAvenida){
            $valTerreno=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_17_18'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno17" value="<?php echo '$'.number_format($valTerreno,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion17" value="<?php echo $superficie ?>" ></td>
          
<!--****************************************************************recorrer suma de valor******************************** -->
          
          
    <?php if($valNivel >= 4){
      $valorContructResult = $valorContruct * 1.1;
     } else{
        $valorContructResult = $valorContruct;
     }
    ?>  
        
          <td><input type="text" class="form-control" name="valorConstruccion17" value="<?php echo '$'.number_format($valorContructResult,2) ?>" ></td>
        <?php 
            $valCatastral=$valTerreno + $valorContructResult;
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral17" value="<?php echo '$'.number_format($valCatastral,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->
    
    
    
    
    
    
    
    
    
    

   
   
   
    
    
    
    
    
    
    
    
    
<hr>
















<!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2018</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie18 = 0;
        $valorContruct18 = 0;
        $valNivel18=0;
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc18" value="<?php echo $valores2018['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_18" value="<?php echo $valores2018['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC18" value="<?php echo '$'.number_format($valores2018['VALOR2018'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles18" value="<?php echo $valores2018['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad18" value="<?php echo $valores2018['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad18" value="<?php echo $valores2018['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion18" value="<?php echo $valores2018['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion18= $valores2018['AREA'] * $valores2018['VALOR2018'];
           
            if($valores2018['NIVEL'] >= 4){
               $valNivel18=$valores2018['NIVEL'];
           }
           
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA18" value="<?php echo '$'.number_format($valorConstruccion18,2) ?>" ></td>
        </tr>
        <?php 
          $superficie18 += $valores2018['AREA'];
          $valorContruct18 += $valorConstruccion18;
          }while($valores2018=sqlsrv_fetch_array($valores18));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2018 (del 1ro al 6to bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno18" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor18" value="<?php echo '$'.number_format($fichas['Valorm2_17_18'],2) ?>" ></td>
          
    <?php
        if($fichas['Valorm2_17_18'] > $valorAvenida){
            $valTerreno18=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_17_18'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno18=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno18" value="<?php echo '$'.number_format($valTerreno18,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion18" value="<?php echo $superficie18 ?>" ></td>
          
          
    <?php if($valNivel18 >= 4){
      $valorContructResult18 = $valorContruct18 * 1.1;
     } else{
        $valorContructResult18 = $valorContruct18;
     }
    ?>  
         
          <td><input type="text" class="form-control" name="valorConstruccion18" value="<?php echo '$'.number_format($valorContructResult18,2) ?>" ></td>
        <?php 
            $valCatastral18=$valTerreno18 + $valorContructResult18;   
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral18" value="<?php echo '$'.number_format($valCatastral18,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->
    
    
   
   
   
   
   
   
   
   
   
   
   
   
   
   <hr>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   <!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2019</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie19 = 0;
        $valorContruct19 = 0;
                     
                     
                     
                     
                     
        $valNivel19=0;
                     
                     
                     
                     
                     
                     
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc19" value="<?php echo $valores2019['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_19" value="<?php echo $valores2019['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC19" value="<?php echo '$'.number_format($valores2019['VALOR2019'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles19" value="<?php echo $valores2019['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad19" value="<?php echo $valores2019['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad19" value="<?php echo $valores2019['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion19" value="<?php echo $valores2019['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion19= $valores2019['AREA'] * $valores2019['VALOR2019'];
           
           
           
           
           
        if($valores2019['NIVEL'] >= 4){
               $valNivel19=$valores2019['NIVEL'];
           }
           
           
           
           
           
           
           
           
           
           
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA19" value="<?php echo '$'.number_format($valorConstruccion19,2) ?>" ></td>
        </tr>
        <?php 
          $superficie19 += $valores2019['AREA'];
          $valorContruct19 += $valorConstruccion19;
          }while($valores2019=sqlsrv_fetch_array($valores19));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2019 (del 1ro al 6to bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno19" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor19" value="<?php echo '$'.number_format($fichas['Valorm2_19'],2) ?>" ></td>
          
    <?php
        if($fichas['Valorm2_19'] > $valorAvenida){
            $valTerreno19=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_19'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno19=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno19" value="<?php echo '$'.number_format($valTerreno19,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion19" value="<?php echo $superficie19 ?>" ></td>
          
          
          
          
          
    <?php if($valNivel19 >= 4){
      $valorContructResult19 = $valorContruct19 * 1.1;
     } else{
        $valorContructResult19 = $valorContruct19;
     }
    ?>  
         
         
         
         
         
         
          <td><input type="text" class="form-control" name="valorConstruccion19" value="<?php echo '$'.number_format($valorContructResult19,2) ?>" ></td>
        <?php 
            $valCatastral19=$valTerreno19 + $valorContructResult19;
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral19" value="<?php echo '$'.number_format($valCatastral19,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->
  
  
  
   
   
   
   
   
<hr>




   <!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2020</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie20 = 0;
        $valorContruct20 = 0;
        $valNivel20=0;
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc20" value="<?php echo $valores2020['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_20" value="<?php echo $valores2020['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC20" value="<?php echo '$'.number_format($valores2020['VALOR2020'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles20" value="<?php echo $valores2020['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad20" value="<?php echo $valores2020['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad20" value="<?php echo $valores2020['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion20" value="<?php echo $valores2020['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion20= $valores2020['AREA'] * $valores2020['VALOR2020'];
           
           if($valores2020['NIVEL'] >= 4){
               $valNivel20=$valores2020['NIVEL'];
           }
           
           
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA20" value="<?php echo '$'.number_format($valorConstruccion20,2) ?>" ></td>
        </tr>
        <?php 
          $superficie20 += $valores2020['AREA'];
          $valorContruct20 += $valorConstruccion20;
          }while($valores2020=sqlsrv_fetch_array($valores20));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2020 (del 1ro al 6to bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno20" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor20" value="<?php echo '$'.number_format($valM2_22,2) ?>" ></td>
          
    <?php
        if($valM2_22 > $valorAvenida){
            $valTerreno20=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno20=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno20" value="<?php echo '$'.number_format($valTerreno20,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion20" value="<?php echo $superficie20 ?>" ></td>
          
          
    <?php if($valNivel20 >= 4){
      $valorContructResult20 = $valorContruct20 * 1.1;
     } else{
        $valorContructResult20 = $valorContruct20;
     }
    ?>  
         
         
         
         
          <td><input type="text" class="form-control" name="valorConstruccion20" value="<?php echo '$'.number_format($valorContructResult20,2) ?>" ></td>
        <?php 
            $valCatastral20=$valTerreno20 + $valorContructResult20;
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral20" value="<?php echo '$'.number_format($valCatastral20,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->








<hr>




















   <!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2021</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie21 = 0;
        $valorContruct21 = 0;
        $valNivel21=0;
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc21" value="<?php echo $valores2021['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_21" value="<?php echo $valores2021['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC21" value="<?php echo '$'.number_format($valores2021['VALOR2021'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles21" value="<?php echo $valores2021['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad21" value="<?php echo $valores2021['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad21" value="<?php echo $valores2021['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion21" value="<?php echo $valores2021['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion21= $valores2021['AREA'] * $valores2021['VALOR2021'];
           
           
        if($valores2021['NIVEL'] >= 4){
               $valNivel21=$valores2021['NIVEL'];
           }
           
           
           
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA21" value="<?php echo '$'.number_format($valorConstruccion21,2) ?>" ></td>
        </tr>
        <?php 
          $superficie21 += $valores2021['AREA'];
          $valorContruct21 += $valorConstruccion21;
          }while($valores2021=sqlsrv_fetch_array($valores21));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2021 (del 1ro al 6to bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno21" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor21" value="<?php echo '$'.number_format($valM2_22,2) ?>" ></td>
          
    <?php
        if($valM2_22 > $valorAvenida){
            $valTerreno21=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno21=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno21" value="<?php echo '$'.number_format($valTerreno21,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion21" value="<?php echo $superficie21 ?>" ></td>
          
          
          
    <?php if($valNivel21 >= 4){
      $valorContructResult21 = $valorContruct21 * 1.1;
     } else{
        $valorContructResult21 = $valorContruct21;
     }
    ?>  
         
         
         
         
         
          <td><input type="text" class="form-control" name="valorConstruccion21" value="<?php echo '$'.number_format($valorContructResult21,2) ?>" ></td>
        <?php 
            $valCatastral21=$valTerreno21 + $valorContructResult21;
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral21" value="<?php echo '$'.number_format($valCatastral21,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->





   
   
    
    
    
    
    
    <hr>
    
    
    
    
    
    
    
    
    
   <!--********************************************************************************************************************************************-->
    <h5 style="text-shadow: 1px 1px 2px #717171;">Descripcion de construccion 2022</h5>
      <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">CCC</th>
          <th scope="col">M2</th>
          <th scope="col">Valor</th>
          <th scope="col">Niveles</th>
          <th scope="col">Tipo/Edad</th>
          <th scope="col">Calidad</th>
          <th scope="col">Conservacion</th>
          <th scope="col">Valor de construccion</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        $superficie22 = 0;
        $valorContruct22 = 0;
        $valNivel22=0;
        do{ ?>
        <tr align="center">
          <td><input type="text" class="form-control" name="ccc22" value="<?php echo $valores2022['CCC'] ?>" ></td>
          <td><input type="text" class="form-control" name="m2_22" value="<?php echo $valores2022['AREA'] ?>" ></td>
          <td><input type="text" class="form-control" name="valorC22" value="<?php echo '$'.number_format($valores2022['VALOR2022'],2) ?>" ></td>
          <td><input type="text" class="form-control" name="niveles22" value="<?php echo $valores2022['NIVEL'] ?>" ></td>
          <td><input type="text" class="form-control" name="tipo/edad22" value="<?php echo $valores2022['EDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="calidad22" value="<?php echo $valores2022['CALIDAD'] ?>" ></td>
          <td><input type="text" class="form-control" name="conservacion22" value="<?php echo $valores2022['estadoConservacion'] ?>" ></td>
        <?php  
        $valorConstruccion22= $valores2022['AREA'] * $valores2022['VALOR2022'];
           
        if($valores2022['NIVEL'] >= 4){
               $valNivel22=$valores2022['NIVEL'];
           }
           
           
           
        ?>          
          <td><input type="text" class="form-control" name="valorConstruccionA22" value="<?php echo '$'.number_format($valorConstruccion22,2) ?>" ></td>
        </tr>
        <?php 
          $superficie22 += $valores2022['AREA'];
          $valorContruct22 += $valorConstruccion22;
          }while($valores2022=sqlsrv_fetch_array($valores22));
          ?>
      </tbody>
    </table>
    </div>
    <hr>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Valores catastrales 2022 (del 1ro al 2do bimestre)</h5>
    <div class="container">
    <table class="table table-light table-sm table-bordered table-hover">
      <thead>
        <tr class="table-dark" style="color:#4b4b4b">
          <th scope="col">Sup. del terreno(m2)</th>
          <th scope="col">Valor(m2)</th>
          <th scope="col">Valor Terreno</th>
          <th scope="col">Sup. Construcción(m2)</th>
          <th scope="col">Valor Construccion</th>
          <th scope="col">Valor Catastral</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><input type="text" class="form-control" name="supTerreno22" value="<?php echo $fichas['Superficie_de_Terreno'] ?>" ></td>
          <td><input type="text" class="form-control" name="valor22" value="<?php echo '$'.number_format($valM2_22,2) ?>" ></td>
          
    <?php 
        if($valM2_22 > $valorAvenida){
            $valTerreno22=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno22=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
        ?>      
          <td><input type="text" class="form-control" name="valorTerreno22" value="<?php echo '$'.number_format($valTerreno22,2) ?>" ></td>
 
          <td><input type="text" class="form-control" name="supConstruccion22" value="<?php echo $superficie22 ?>" ></td>
          
    <?php if($valNivel22 >= 4){
      $valorContructResult22 = $valorContruct22 * 1.1;
     } else{
        $valorContructResult22 = $valorContruct22;
     }
    ?> 
         
          <td><input type="text" class="form-control" name="valorConstruccion22" value="<?php echo '$'.number_format($valorContructResult22,2) ?>" ></td>
        <?php 
            $valCatastral22=$valTerreno22 + $valorContructResult22;
            ?>  
          <td><input type="text" class="form-control" name="valorCatastral22" value="<?php echo '$'.number_format($valCatastral22,2) ?>" ></td>
        </tr>
      </tbody>
    </table>
    </div>
<!--********************************************************************************************************************************************-->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <hr>
    
<div class="form-group">
    <h6 style="text-shadow: 0px 0px 2px #717171;">Observaciones en croquis de construcciones:</h6>
    <textarea class="form-control" name="observaciones" rows="3"><?php echo utf8_encode($fichas['observacionesCuentas']) ?></textarea>
</div>
<hr>
<div class="form-group">
    <h5 style="text-shadow: 0px 0px 2px #717171;">Pie de pagina ficha:</h5>
    <p style="font-weight:normal;text-shadow: 0px 0px 1px #717171;"><?php echo $footer['text'] ?></p>
    <hr>
</div>
   
   
   
   
   
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    <small id="e" class="form-text text-muted" style="font-size:14px;">*Campos requeridos.</small>
    <br><hr>
    <div style="text-align:center;">
     <button type="submit" class="btn btn-primary btn-sm" name="save"><i class="fas fa-file-pdf"></i> Generar ficha catastral</button>
     <a href="buscarFicha.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Cancelar</a>
    </div>
    </div>
    
       <br><br><br>
    
   </form>
</div>
<?php } else{
    header('location:../../login.php');
}
require "include/footer.php";
    ?>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/popper.min.js"></script>    
<script src="../js/bootstrap.js"></script>  
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
    function Confirmar(Mensaje){
        return (confirm(Mensaje))?true:false;
    }
</script>      
</html>