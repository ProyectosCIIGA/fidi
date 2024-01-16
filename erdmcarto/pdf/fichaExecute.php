<?php
require "../../acnxerdm/cnx.php";

//    $Acue="select * from cuentasActuales where FechaCarga='2022-10-04'";
//    $Acuenta=sqlsrv_query($cnx,$Acue);
//    $AcuentasActuales=sqlsrv_fetch_array($Acuenta);


//    $Acue="select * from cuentasActuales";
//    $Acuenta=sqlsrv_query($cnx,$Acue);
//    $AcuentasActuales=sqlsrv_fetch_array($Acuenta);



    $Acue="select * from nuevaCActuales";
    $Acuenta=sqlsrv_query($cnx,$Acue);
    $AcuentasActuales=sqlsrv_fetch_array($Acuenta);


do{




    $cuenta=$AcuentasActuales['cuentaPredial'];
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
    $Ava17="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores17=sqlsrv_query($cnx,$Ava17);
    $Avalores2017=sqlsrv_fetch_array($Avalores17);

//**************************************************************************

    $Ava18="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores18=sqlsrv_query($cnx,$Ava18);
    $Avalores2018=sqlsrv_fetch_array($Avalores18);

//**************************************************************************

    $Ava19="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores19=sqlsrv_query($cnx,$Ava19);
    $Avalores2019=sqlsrv_fetch_array($Avalores19);

//**************************************************************************

    $Ava20="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores20=sqlsrv_query($cnx,$Ava20);
    $Avalores2020=sqlsrv_fetch_array($Avalores20);

//**************************************************************************

    $Ava21="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores21=sqlsrv_query($cnx,$Ava21);
    $Avalores2021=sqlsrv_fetch_array($Avalores21);

//**************************************************************************

    $Ava22="select * from tipologias
    inner join tablasValor on tipologias.CCC=tablasValor.CCC
    where tipologias.CLAVES=$cuenta";
    $Avalores22=sqlsrv_query($cnx,$Ava22);
    $Avalores2022=sqlsrv_fetch_array($Avalores22);

//**************************************************************************
    
    
//******************************************************************************************************************************************************    
    
    
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
//if(isset($_GET['start'])){
    
    $cPredialRep=$fichas['Cuenta_predial'];
    
    $re="select * from fichaResult
    where CPredial='$cPredialRep'";
    $rep=sqlsrv_query($cnx,$re);
    $repetida=sqlsrv_fetch_array($rep);    
    
//    print_r( $fichas );
//    exit();
    
if(isset($repetida)){
    
//    $tokenResult=$repetida['tokenResult'];
    
//    echo '<script>alert("Ya existe un registro de ficha catastral para esta cuenta predial. No se agregara un nuevo registro, si requiere modificaciones notifique al área de sistemas.")</script>';

//    echo '<script type="text/javascript">window.open("../pdf/fichaCatastralExecute.php?clvCL='.$tokenResult.'&crt='.$CURT.'&cut='.$tokenResult.'");</script>';
    
    $tokenResult=$repetida['tokenResult'];
    $idFichaResult=$repetida['id_fichaResult'];
    $cuentaPredial=$repetida['CPredial'];
    
    $idFicha="delete from descriptConstruct where id_fichaResult='$idFichaResult'";
    sqlsrv_query($cnx,$idFicha);
    
    $tokenValCatas="delete from valCatastrales where tokenValCatas='$tokenResult'";
    sqlsrv_query($cnx,$tokenValCatas);
    
    $poneCuenta="delete from fichaResult where CPredial='$cuentaPredial'";
    sqlsrv_query($cnx,$poneCuenta); 
    
    
}
//} else{
    
    $idFooter=1;
    $regInsert=date('Y-m-d');
    $horaInsert=date('H:i:s');

    
    
    
    
    
    
    
    
                $Estado=$fichas['Estado'];
            $Region=$fichas['RegionCatastral'];
            $Municipio=$fichas['Municipio'];
            $Zona=$fichas['ZonaCata'];
            $Loc=$fichas['Localidad'];
            $Sector=$fichas['SectorCat'];
            $Manzana=$fichas['Manzana'];
            $Predio=$fichas['Predio'];
            $Edificio=$fichas['Edificio'];
            $Unidad=$fichas['Unidad'];
                
                
            $CCatastral=$fichas['Clave'];
            $CPredial=$fichas['Cuenta_predial'];
                
                
            $NPropietario=utf8_encode($fichas['Propietario']);
            $RSocial=utf8_encode($fichas['razonSocial']);
            $Calle=utf8_encode($fichas['Calle']);
            $NumExterior=$fichas['NumeroExterno'];
            $NumInterior=$fichas['NumeroInterno'];
            $Colonia=utf8_encode($fichas['Colonia']);
            $CP=$fichas['CP'];
            $SupTerreno=$fichas['Superficie_de_Terreno'];
            $SupConstruccion=$fichas['Superficie_de_Construccion'];
            $VTerreno='$'.number_format($fichas['Valor_de_Terreno'],2);
            $VConstruccion='$'.number_format($fichas['Valor_de_construccion'],2);
            $VCatastral='$'.number_format($fichas['ValorCatastral'],2);
            $TServicio=$fichas['Tipo_de_Servicio'];
            $Giro=$fichas['Giro'];



            $TServicioA=$fichas['tipodeServicio_Actual'];
            $GiroA=$fichas['giro_Actual'];
  
            $Superficie=$fichas['Superficie_de_Terreno'];
            $Valor='$'.number_format($valM2_22,2);
    
    
    
            $Frente=$fichas['Frente'];
            $FactorF=$fichas['factorCuentas'];
            $Fondo=$fichas['Fondo'];
            $FactorFo=$fichas['factorUno'];
            $Posicion=$fichas['posicionCuentas'];
            $FactorP=$fichas['factorDos'];


    
    
            if($fichas['ValorAV'] == NULL){
                $valorAvenida=0.00;
            } else{
                $valorAvenida=$fichas['ValorAV'];
            } 

            $ValorAvenida='$'.number_format($valorAvenida,2);
    
    
    
            $Topografia=$fichas['Topografia'];
            $FactorT=$fichas['factorTopografia'];
    

    
    
    
    
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
     } 
         
        $ValorT='$'.number_format($ValTerreno,2);

        $EstadoEdificacion=$fichas['estadoEdificacion'];


        $UsoSuelo=$fichas['UsodeSuelo'];
    
    
    
        $ConstruccionH=$fichas['Superficie_de_Construccion'];
        $ConstruccionA=$superficieCons;

        $construccionHistorica=$fichas['Superficie_de_Construccion'];
    
        $Diferencia=$superficieCons - $construccionHistorica;
    
    
    
        $observaciones=utf8_encode($fichas['observacionesCuentas']);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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

    
    
        $superficie = 0;
        $valorContruct = 0;
        $valNivel=0;
        do{ 
            
            
        $valorConstruccion= $Avalores2017['AREA'] * $Avalores2017['VALOR2017'];
           
           if($Avalores2017['NIVEL'] >= 4){
               $valNivel=$Avalores2017['NIVEL'];
           }

          $superficie += $Avalores2017['AREA'];
          $valorContruct += $valorConstruccion;
           
          }while($Avalores2017=sqlsrv_fetch_array($Avalores17));

    
        $SupTerreno17=$fichas['Superficie_de_Terreno'];

        $ValorConstruccion17='$'.number_format($fichas['Valorm2_17_18'],2);
    
        if($fichas['Valorm2_17_18'] > $valorAvenida){
            $valTerreno=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_17_18'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno17='$'.number_format($valTerreno,2);
 
        $SupConstruccion17=$superficie;
          
     if($valNivel >= 4){
      $valorContructResult = $valorContruct * 1.1;
     } else{
        $valorContructResult = $valorContruct;
     }
    
        $ValorConst17='$'.number_format($valorContructResult,2);
      
        $valCatastral=$valTerreno + $valorContructResult;
           
        $ValorCatastral17='$'.number_format($valCatastral,2);
    
    
    
    
    
    
    
    
    
    
    
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
        $valorConstruccion17= $valores2017['AREA'] * $valores2017['VALOR2017'];  //***********************************ERROR 
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
//******************************************************************************************************
    
    
    
    
    
    
        $superficie18 = 0;
        $valorContruct18 = 0;
        $valNivel18=0;
        do{ 
        $valorConstruccion18= $Avalores2018['AREA'] * $Avalores2018['VALOR2018'];
                if($Avalores2018['NIVEL'] >= 4){
                   $valNivel18=$Avalores2018['NIVEL'];
                }
                $superficie18 += $Avalores2018['AREA'];
                $valorContruct18 += $valorConstruccion18;
          }while($Avalores2018=sqlsrv_fetch_array($Avalores18));
    
        $SupTerreno18=$fichas['Superficie_de_Terreno'];
        $ValorConstruccion18='$'.number_format($fichas['Valorm2_17_18'],2);
          
        if($fichas['Valorm2_17_18'] > $valorAvenida){
            $valTerreno18=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_17_18'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno18=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno18='$'.number_format($valTerreno18,2);
        $SupConstruccion18=$superficie18;
          
        if($valNivel18 >= 4){
          $valorContructResult18 = $valorContruct18 * 1.1;
         } else{
            $valorContructResult18 = $valorContruct18;
         }
         
        $ValorConst18='$'.number_format($valorContructResult18,2);
        $valCatastral18=$valTerreno18 + $valorContructResult18;   
        $ValorCatastral18='$'.number_format($valCatastral18,2);
    
    
    
    
    
    
    
    
//******************************************************************************************************
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
    
    
    
    
    
    
        $superficie19 = 0;
        $valorContruct19 = 0;
        $valNivel19=0;
        do{ 
        $valorConstruccion19= $Avalores2019['AREA'] * $Avalores2019['VALOR2019'];
                if($Avalores2019['NIVEL'] >= 4){
                   $valNivel19=$Avalores2019['NIVEL'];
                }
                $superficie19 += $Avalores2019['AREA'];
                $valorContruct19 += $valorConstruccion19;
          }while($Avalores2019=sqlsrv_fetch_array($Avalores19));
    
        $SupTerreno19=$fichas['Superficie_de_Terreno'];
        $ValorConstruccion19='$'.number_format($fichas['Valorm2_19'],2);
          
        if($fichas['Valorm2_19'] > $valorAvenida){
            $valTerreno19=$fichas['Superficie_de_Terreno'] * $fichas['Valorm2_19'] * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno19=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno19='$'.number_format($valTerreno19,2);
        $SupConstruccion19=$superficie19;
          
        if($valNivel19 >= 4){
          $valorContructResult19 = $valorContruct19 * 1.1;
         } else{
            $valorContructResult19 = $valorContruct19;
         }
         
        $ValorConst19='$'.number_format($valorContructResult19,2);
        $valCatastral19=$valTerreno19 + $valorContructResult19;   
        $ValorCatastral19='$'.number_format($valCatastral19,2);
    
    
    
    
    
    
    
    
//******************************************************************************************************
    
    
    
    
    
    
    
    
    
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
//******************************************************************************************************
    
    
    
    
    
    
        $superficie20 = 0;
        $valorContruct20 = 0;
        $valNivel20=0;
        do{ 
        $valorConstruccion20= $Avalores2020['AREA'] * $Avalores2020['VALOR2020'];
                if($Avalores2020['NIVEL'] >= 4){
                   $valNivel20=$Avalores2020['NIVEL'];
                }
                $superficie20 += $Avalores2020['AREA'];
                $valorContruct20 += $valorConstruccion20;
          }while($Avalores2020=sqlsrv_fetch_array($Avalores20));
    
        $SupTerreno20=$fichas['Superficie_de_Terreno'];
        $ValorConstruccion20='$'.number_format($valM2_22,2);
          
        if($valM2_22 > $valorAvenida){
            $valTerreno20=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno20=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno20='$'.number_format($valTerreno20,2);
        $SupConstruccion20=$superficie20;
          
        if($valNivel20 >= 4){
          $valorContructResult20 = $valorContruct20 * 1.1;
         } else{
            $valorContructResult20 = $valorContruct20;
         }
         
        $ValorConst20='$'.number_format($valorContructResult20,2);
        $valCatastral20=$valTerreno20 + $valorContructResult20;   
        $ValorCatastral20='$'.number_format($valCatastral20,2);
    
    
    
    
    
    
    
    
//******************************************************************************************************
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
//******************************************************************************************************
    
    
    
    
    
    
        $superficie21 = 0;
        $valorContruct21 = 0;
        $valNivel21=0;
        do{ 
        $valorConstruccion21= $Avalores2021['AREA'] * $Avalores2021['VALOR2021'];
                if($Avalores2021['NIVEL'] >= 4){
                   $valNivel21=$Avalores2021['NIVEL'];
                }
                $superficie21 += $Avalores2021['AREA'];
                $valorContruct21 += $valorConstruccion21;
          }while($Avalores2021=sqlsrv_fetch_array($Avalores21));
    
        $SupTerreno21=$fichas['Superficie_de_Terreno'];
        $ValorConstruccion21='$'.number_format($valM2_22,2);
          
        if($valM2_22 > $valorAvenida){
            $valTerreno21=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno21=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno21='$'.number_format($valTerreno21,2);
        $SupConstruccion21=$superficie21;
          
        if($valNivel21 >= 4){
          $valorContructResult21 = $valorContruct21 * 1.1;
         } else{
            $valorContructResult21 = $valorContruct21;
         }
         
        $ValorConst21='$'.number_format($valorContructResult21,2);
        $valCatastral21=$valTerreno21 + $valorContructResult21;   
        $ValorCatastral21='$'.number_format($valCatastral21,2);
    
    
    
    
    
    
    
    
//******************************************************************************************************
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
//******************************************************************************************************
    
    
    
    
    
    
        $superficie22 = 0;
        $valorContruct22 = 0;
        $valNivel22=0;
        do{ 
        $valorConstruccion22= $Avalores2022['AREA'] * $Avalores2022['VALOR2022'];
                if($Avalores2022['NIVEL'] >= 4){
                   $valNivel22=$Avalores2022['NIVEL'];
                }
                $superficie22 += $Avalores2022['AREA'];
                $valorContruct22 += $valorConstruccion22;
          }while($Avalores2022=sqlsrv_fetch_array($Avalores22));
    
        $SupTerreno22=$fichas['Superficie_de_Terreno'];
        $ValorConstruccion22='$'.number_format($valM2_22,2);
          
        if($valM2_22 > $valorAvenida){
            $valTerreno22=$fichas['Superficie_de_Terreno'] * $valM2_22 * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         } else if($valM2_22 < $valorAvenida){
            $valTerreno22=$fichas['Superficie_de_Terreno'] * $valorAvenida * $factorCuenta * $factorUno * $factorDos * $factorTopografia;
         }
    
        $ValorTerreno22='$'.number_format($valTerreno22,2);
        $SupConstruccion22=$superficie22;
          
        if($valNivel22 >= 4){
          $valorContructResult22 = $valorContruct22 * 1.1;
         } else{
            $valorContructResult22 = $valorContruct22;
         }
         
        $ValorConst22='$'.number_format($valorContructResult22,2);
        $valCatastral22=$valTerreno22 + $valorContructResult22;   
        $ValorCatastral22='$'.number_format($valCatastral22,2);
    
    
    
    
    
    
    
    
//******************************************************************************************************
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
    
   
    echo '<script type="text/javascript">window.open("../pdf/fichaCatastralExecute.php?clvCL='.$tokenResult.'&crt='.$CURT.'&cut='.$tokenResult.'");</script>';
    
    //}
//}

    
    
    
    
    
    
}while($AcuentasActuales=sqlsrv_fetch_array($Acuenta));
    
     echo '<meta http-equiv="refresh" content="0,url=../php/buscarFicha.php">';
    
    
    
?>
 
 
  
  
  
  
  
  
  
  
<!--<h2>Archivo execute</h2>  -->
  
  
  
  
  
  
  
  
  
  
   
   
