<?php

require '../../acnxerdm/cnx.php';

$infoFicha = array('id_fichaResult' => '','id_footer' => '','registroInsert' => '','horaInsert' => '','Estado' => '','Region' => '','Municipio' => '','Loc' => '','Zona' => '','Sector' => '','Manzana' => '','Predio' => '','Edificio' => '','Unidad' => '','CCatastral' => '','CPredial' => '','NPropietario' => '','RSocial' => '','Calle' => '','NumExterior' => '','NumInterior' => '','Colonia' => '','CP' => '','SupTerreno' => '','SupConstruccion' => '','VTerreno' => '','VConstruccion' => '','VCatastral' => '','TServicio' => '','Giro' => '','Superficie' => '','Valor' => '','Frente' => '','FactorF' => '','Fondo' => '','FactorFo' => '','Posicion' => '','FactorP' => '','ValorAvenida' => '','Topografia' => '','FactorT' => '','ValorT' => '','EstadoEdificacion' => '','UsoSuelo' => '','ConstruccionH' => '','ConstruccionA' => '','Diferencia' => '','tokenResult' => '','tipoServicioA' => '','giroA' => '','observaciones' => '');

$infoConstrucciones = array();
$infoCatastral = array();
$cuentaActualizarExist = true;
///Cuenta con la que probar TestAB123

if(isset($_POST['actualiza']) and isset($_GET['editar'])){
    
        $cPredial = $_GET['editar'];   
        $tokenResult = $_POST['tkResult'];
    
        $estado = $_POST['estado'];
        $region = $_POST['region'];
        $municipio = $_POST['municipio'];
        $localidad = $_POST['localidad'];
        $zona = $_POST['zona'];
        $sector = $_POST['sector'];
        $manzana = $_POST['manzana'];
        $predio = $_POST['predio'];
        $edificio = $_POST['edificio'];
        $unidad = $_POST['unidad'];
        $cCatastral = $_POST['cCatastral'];
        $nPropietario = $_POST['nPropie'];
        $rSocial = $_POST['rSocial'];
        $calle = $_POST['calle'];
        $numExt = $_POST['numExt'];
        $numInt = $_POST['numInt'];
        $colonia = $_POST['colonia'];
        $cp = $_POST['cp'];
        $supTerreno = $_POST['supTerreno'];
        $supConstruccion = $_POST['supConstru'];
        $vTerreno = $_POST['vTerreno'];
        $vConstruccion = $_POST['vConstruccion'];
        $vCatastral = $_POST['vCatastral'];
        $tServicio = $_POST['tServicio'];
        $giro = $_POST['giro'];
        $superficie = $_POST['superficie'];
        $valor = $_POST['valor'];
        $frente = $_POST['frente'];
        $factorF = $_POST['factorF'];
        $fondo = $_POST['fondo'];
        $factorFo = $_POST['factorFO'];
        $posicion = $_POST['posicion'];
        $factorP = $_POST['factorP'];
        $valorAV = $_POST['valorAV'];
        $topografia = $_POST['topografia'];
        $factorT = $_POST['factorT'];
        $valorT = $_POST['valorT'];
        $estadoEdificacion = $_POST['estadoEdificacion'];
        $usoSuelo = $_POST['usoSuelo'];
        $construccionH = $_POST['cosntruccionH'];
        $construccionA = $_POST['construccionA'];
        $diferencia = $_POST['diferencia'];
        $tipoServicioA = $_POST['tipoServicioA'];
        $giroA = $_POST['giroA'];
        $observaciones = $_POST['observaciones'];
    
        $sqlUpdate = "UPDATE fichaResult SET Estado = '$estado' ,Region = '$region' ,Municipio = '$municipio' ,Zona = '$zona' ,Loc = '$localidad' ,Sector = '$sector' ,Manzana = '$manzana' ,Predio = '$predio' ,Edificio = '$edificio' ,Unidad = '$unidad' ,CCatastral = '$cCatastral' ,NPropietario = '$nPropietario' ,RSocial = '$rSocial' ,Calle = '$calle' ,NumExterior = '$numExt' ,NumInterior = '$numInt' ,Colonia = '$colonia' ,CP = '$cp' ,SupTerreno = '$supTerreno' ,SupConstruccion = '$supConstruccion' ,VTerreno = '$vTerreno' ,VConstruccion = '$vConstruccion' ,VCatastral = '$vCatastral' ,TServicio = '$tServicio' ,Giro = '$giro' ,Superficie = '$superficie' ,Valor = '$valor' ,Frente = '$frente' ,FactorF = '$factorF' ,Fondo = '$fondo' ,FactorFo = '$factorFo' ,Posicion = '$posicion' ,FactorP = '$factorP' ,ValorAvenida = '$valorAV' ,Topografia = '$topografia' ,FactorT = '$factorT' ,ValorT = '$valorT' ,EstadoEdificacion = '$estadoEdificacion' ,UsoSuelo = '$usoSuelo' ,ConstruccionH = '$construccionH' ,ConstruccionA = '$construccionA' ,Diferencia = '$diferencia' , tipoServicioA = '$tipoServicioA' ,giroA = '$giroA' ,observaciones = '$observaciones' where CPredial = '$cPredial' ";

        $prov = sqlsrv_prepare($cnx,$sqlUpdate);

        if(sqlsrv_execute( $prov ) and $prov != false){
            $i = 1;

            //*** UPDATE PARA LOS DATOS DE CONSTRUCCION  **************
            while(true){
                if(isset($_POST['cccDC'.$i])){

                    $id = $_POST['idDC'.$i];
                   
                    $anio = $_POST['anioDC'.$i]; //Este cuenta?
                    $ccc = $_POST['cccDC'.$i];
                    $mts = $_POST['m2DC'.$i];
                    $valor = $_POST['valorDC'.$i];
                    $nivel = $_POST['nivelesDC'.$i];
                    $tipoEdad = $_POST['tipoEdadDC'.$i];
                    $calidad = $_POST['calidadDC'.$i];
                    $conservacion = $_POST['conservacionDC'.$i];
                    $valConstruc = $_POST['valConstruc'.$i];
                                        
                    $sqlUpdateDC = "UPDATE descriptConstruct SET anioDescript = '$anio' ,ccc = '$ccc' ,m2 = '$mts' ,valor = '$valor' ,niveles = '$nivel' ,tipo_edad = '$tipoEdad' ,calidad = '$calidad' ,conservacion = '$conservacion' ,valConstruct = '$valConstruc' WHERE id_descrptConstruct = $id ";
                    $prov = sqlsrv_prepare($cnx,$sqlUpdateDC);
                    if(sqlsrv_execute( $prov ) == false){
                        die("DescriptConstruct -  ".print_r( sqlsrv_errors(), true));
                    }
                }else{
                    break;
                }
                $i++;
            }
            //**---------------*****--------------*****-------
            
            $j = 1;
            //*** UPDATE PARA LOS DATOS DE VALORES CATASTRALES ********
            while(true){
                if(isset($_POST['valorVC'.$j])){
                    
                    $id = $_POST['idVC'.$j];

                    $supTerreno = $_POST['supTerrenoVC'.$j];
                    $valor = $_POST['valorVC'.$j];
                    $valTerreno = $_POST['valTerrenoVC'.$j];
                    $supConstruct = $_POST['supConstructVC'.$j];
                    $valorConstruct = $_POST['valorConstructVC'.$j];
                    $valorCatas = $_POST['valorCatastralVC'.$j];
                    
                    $sqlUpdateVC = "UPDATE valCatastrales SET supTerreno = '$supTerreno' ,valor = '$valor' ,valTerreno = '$valTerreno' ,supConstruct = '$supConstruct' ,valorConstruct = '$valorConstruct' ,valorCatastral = '$valorCatas' WHERE id_valCatastrales = $id";
                    $prov = sqlsrv_prepare($cnx,$sqlUpdateVC);
                    if(sqlsrv_execute( $prov ) == false){
                        die("valCatastrales -  ".print_r( sqlsrv_errors(), true));
                    }
                }else{
                    break;
                }
                $j++;
            }
            //**---------------*****--------------*****-------
            
            echo '<meta http-equiv="refresh" content="0 ,url=editFicha.php?editar='.$_GET['editar'].'"';
            
        }else
            die(print_r( sqlsrv_errors(), true));
}

if(isset($_GET['editar'])){
                
        $cuenta = $_GET['editar'];
        $sqlConsulta = "SELECT * FROM fichaResult WHERE CPredial = ?";
        
        $prov = sqlsrv_prepare($cnx,$sqlConsulta, array(&$cuenta));
        //*************************** Seccion para llenar datos de la cuenta a Actualizar
        if(sqlsrv_execute( $prov )){
            $row = sqlsrv_fetch_array($prov);
            
            if( $row != null and $row != false){
                
                $infoFicha['id_fichaResult'] = $row['id_fichaResult'];
                $infoFicha['id_footer'] = $row['id_footer'];
                $infoFicha['registroInsert'] = $row['registroInsert'];
                $infoFicha['horaInsert'] = $row['horaInsert'];
                $infoFicha['Estado'] = $row['Estado'];
                $infoFicha['Region'] = $row['Region'];
                $infoFicha['Municipio'] = $row['Municipio'];
                $infoFicha['Loc'] = $row['Loc'];
                $infoFicha['Zona'] = $row['Zona'];
                $infoFicha['Sector'] = $row['Sector'];
                $infoFicha['Manzana'] = $row['Manzana'];
                $infoFicha['Predio'] = $row['Predio'];
                $infoFicha['Edificio'] = $row['Edificio'];
                $infoFicha['Unidad'] = $row['Unidad'];
                $infoFicha['CCatastral'] = $row['CCatastral'];
                $infoFicha['CPredial'] = $row['CPredial'];
                $infoFicha['NPropietario'] = $row['NPropietario'];
                $infoFicha['RSocial'] = $row['RSocial'];
                $infoFicha['Calle'] = $row['Calle'];
                $infoFicha['NumExterior'] = $row['NumExterior'];
                $infoFicha['NumInterior'] = $row['NumInterior'];
                $infoFicha['Colonia'] = $row['Colonia'];
                $infoFicha['CP'] = $row['CP'];
                $infoFicha['SupTerreno'] = $row['SupTerreno'];
                $infoFicha['SupConstruccion'] = $row['SupConstruccion'];
                $infoFicha['VTerreno'] = $row['VTerreno'];
                $infoFicha['VConstruccion'] = $row['VConstruccion'];
                $infoFicha['VCatastral'] = $row['VCatastral'];
                $infoFicha['TServicio'] = $row['TServicio'];
                $infoFicha['Giro'] = $row['Giro'];
                $infoFicha['Superficie'] = $row['Superficie'];
                $infoFicha['Valor'] = $row['Valor'];
                $infoFicha['Frente'] = $row['Frente'];
                $infoFicha['FactorF'] = $row['FactorF'];
                $infoFicha['Fondo'] = $row['Fondo'];
                $infoFicha['FactorFo'] = $row['FactorFo'];
                $infoFicha['Posicion'] = $row['Posicion'];
                $infoFicha['FactorP'] = $row['FactorP'];
                $infoFicha['ValorAvenida'] = $row['ValorAvenida'];
                $infoFicha['Topografia'] = $row['Topografia'];
                $infoFicha['FactorT'] = $row['FactorT'];
                $infoFicha['ValorT'] = $row['ValorT'];
                $infoFicha['EstadoEdificacion'] = $row['EstadoEdificacion'];
                $infoFicha['UsoSuelo'] = $row['UsoSuelo'];
                $infoFicha['ConstruccionH'] = $row['ConstruccionH'];
                $infoFicha['ConstruccionA'] = $row['ConstruccionA'];
                $infoFicha['Diferencia'] = $row['Diferencia'];
                $infoFicha['tokenResult'] = $row['tokenResult'];//
                $infoFicha['tipoServicioA'] = $row['tipoServicioA'];
                $infoFicha['giroA'] = $row['giroA'];
                $infoFicha['observaciones'] = $row['observaciones'];
                    
                $sqlConsultaD = "select d.* from descriptConstruct d join fichaResult f on d.id_fichaResult = f.id_fichaResult where f.CPredial = ?";
                $prov = sqlsrv_prepare($cnx,$sqlConsultaD, array($cuenta));
                //*************************** Seccion para llenar datos de las Construcciones
                if(sqlsrv_execute( $prov )){
                    $row = sqlsrv_fetch_array($prov);
                    if($row != null){
                        do{
                            $description = array('anioDescript' => $row['anioDescript'], 
                                                 'id_descrptConstruct' => $row['id_descrptConstruct'],
                                                 'id_fichaResult' => $row['id_fichaResult'], 
                                                 'ccc' => $row['ccc'], 
                                                 'm2' => $row['m2'],
                                                 'valor' => $row['valor'],
                                                 'niveles' => $row['niveles'],
                                                 'tipo_edad' => $row['tipo_edad'],
                                                 'calidad' => $row['calidad'],
                                                 'conservacion' => $row['conservacion'],
                                                 'valConstruct' => $row['valConstruct']
                                                );
                            
                            $infoConstrucciones[] = $description;
                            
                        }while( $row = sqlsrv_fetch_array($prov) );
                    }
                    
                }else
                    print_r(sqlsrv_errors());
                //***************** ************************** *******************
                
                
                $sqlConsultaV = "select v.* from valCatastrales v join fichaResult f on v.tokenValCatas = f.tokenResult where f.CPredial = ?";
                $prov = sqlsrv_prepare($cnx,$sqlConsultaV, array($cuenta));
                //*************************** Seccion para llenar datos los Valores Catastrales
                if(sqlsrv_execute( $prov )){
                    $row = sqlsrv_fetch_array($prov);
                    if($row != null){
                        do{
                            $valCatastral = array('id_valCatastrales' => $row['id_valCatastrales'], 
                                                 'anio' => $row['anio'], 
                                                 'supTerreno' => $row['supTerreno'], 
                                                 'valor' => $row['valor'],
                                                 'valTerreno' => $row['valTerreno'],
                                                 'supConstruct' => $row['supConstruct'],
                                                 'valorConstruct' => $row['valorConstruct'],
                                                 'valorCatastral' => $row['valorCatastral'],
                                                 'tokenValCatas' => $row['tokenValCatas']
                                                );
                            
                            $infoCatastral[] = $valCatastral;
                            
                        }while( $row = sqlsrv_fetch_array($prov) );
                    }
                }else
                    print_r(sqlsrv_errors());
                //***************** ************************** *******************
                
                    
            }else{
                $cuentaActualizarExist = false;
            }
            //***************** ************************** *******************
        }else
            print_r(sqlsrv_errors());
        
}

     
?> 

  
  <html>
   
   <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Ficha Catastral</title>
    <link rel="icon" href="../icono/icon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<!--    <script src="../js/dropzone.js"></script>-->

    <style>
        body {
            background-image: url(../img/back.jpg);
            background-repeat: repeat;
            background-size: 100%;
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
        .visorImg {
            height: 400px;
            width: 450px;
            align-items: center;
        }

        body {
            font-family: sans-serif;
            font-style: normal;
            font-weight: bold;
            width: 100%;
            height: 100%;
            margin-top: -1%;
            padding-top: 0px;
        }
        
        .jumbotron {
            padding-bottom:1%;
            padding-top:1%;
        }
        
        .cuentasInfo {
            margin-top: 0%;
            margin-bottom: 0%;
            padding-top: 0%;
            padding-bottom: 2%;
            padding-left: 7%;
            padding-right: 7%;
        }

        td {
            padding-left: 5px;
            padding-right: 5px;

        }

        td input {
            padding-left: 1px;
            padding-right: 1px;
            width: 100%
        }

        .hrIzq {
            height: 3px;
            background-image: linear-gradient(90deg, #2685E5, transparent);

            border: 0;
        }

        .hrDer {
            height: 3px;
            background-image: linear-gradient(270deg, #2685E5, transparent);

            border: 0;
        }

        .botonGuardar {
            padding: 5px;
            display: flex;
            justify-content: center;
        }

    </style>
    <?php require "../php/include/nav.php"; ?>
    </head>
    <body>
        <div class="cuentasInfo">
            <?php if($cuentaActualizarExist == false){ ?>
                <span class="badge badge-warning"> No existe la cuenta a querer actualizar</span>
            <?php } ?>
            <h2>Editar PDF</h2>
            <div class="row">
                <div class="col-sm col-lg-2">
                    <label>Hora de creacion</label>
                </div>
                <div class="col-sm col-lg-2">
                    <label>15/05/2023</label>
                </div>
            </div>
            <form method="post">
                <div class="form-row">
                        <input type="hidden" name="tkResult" value="<?php echo $infoFicha['tokenResult']; ?>" >
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Estado: *</label>
                                <input type="text" class="form-control form-control-sm" name="estado" placeholder="Estado" value="<?php echo $infoFicha['Estado']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Region: *</label>
                                <input type="text" class="form-control form-control-sm" name="region" placeholder="Region" value="<?php echo $infoFicha['Region']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Municioio: *</label>
                                <input type="text" class="form-control form-control-sm" name="municipio" placeholder="Municipio" value="<?php echo $infoFicha['Municipio']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                       <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Localidad: *</label>
                                <input type="text" class="form-control form-control-sm" name="localidad" placeholder="Localidad" value="<?php echo $infoFicha['Loc']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Zona: *</label>
                                <input type="text" class="form-control form-control-sm" name="zona" placeholder="Zona" value="<?php echo $infoFicha['Zona']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Sector: *</label>
                                <input type="text" class="form-control form-control-sm" name="sector" placeholder="Sector" value="<?php echo $infoFicha['Sector']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Manzana: </label>
                                <input type="text" class="form-control form-control-sm" name="manzana" placeholder="Manzana" value="<?php echo $infoFicha['Manzana']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Predio: </label>
                                <input type="text" class="form-control form-control-sm" name="predio" placeholder="Predio" value="<?php echo $infoFicha['Predio']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Edificio: </label>
                                <input type="text" class="form-control form-control-sm" name="edificio" placeholder="Edificio" value="<?php echo $infoFicha['Edificio']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Unidad: </label>
                                <input type="text" class="form-control form-control-sm" name="unidad" placeholder="Unidad" value="<?php echo $infoFicha['Unidad']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Cuenta Catastral: *</label>
                                <input type="text" class="form-control form-control-sm" name="cCatastral" placeholder="Cuenta Catastral" value="<?php echo $infoFicha['CCatastral']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >NPropietario: *</label>
                                <input type="text" class="form-control form-control-sm" name="nPropie" placeholder="NPropietario" value="<?php echo $infoFicha['NPropietario']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Razon social: *</label>
                                <input type="text" class="form-control form-control-sm" name="rSocial" placeholder="Razon Social" value="<?php echo $infoFicha['RSocial']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Calle: </label>
                                <input type="text" class="form-control form-control-sm" name="calle" placeholder="Calle" value="<?php echo $infoFicha['Calle']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Numero Exterior: </label>
                                <input type="text" class="form-control form-control-sm" name="numExt" placeholder="Numero Exterior" value="<?php echo $infoFicha['NumExterior']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Numero Interio: </label>
                                <input type="text" class="form-control form-control-sm" name="numInt" placeholder="Numero Interior" value="<?php echo $infoFicha['NumInterior']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >Colonia: </label>
                                <input type="text" class="form-control form-control-sm" name="colonia" placeholder="Colonia" value="<?php echo $infoFicha['Colonia']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label >C.P.: </label>
                                <input type="text" class="form-control form-control-sm" name="cp" placeholder="Codigo Postal" value="<?php echo $infoFicha['CP']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Superficie de Terreno: </label>
                                <input type="text" class="form-control form-control-sm" name="supTerreno" placeholder="Superficie de Terreno" value="<?php echo $infoFicha['SupTerreno']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Superficie de Construccion: </label>
                                <input type="text" class="form-control form-control-sm" name="supConstru" placeholder="Superficie de Construccion" value="<?php echo $infoFicha['SupConstruccion']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >VTerreno: </label>
                                <input type="text" class="form-control form-control-sm" name="vTerreno" placeholder="VTerreno" value="<?php echo $infoFicha['VTerreno']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >VConstruccion: </label>
                                <input type="text" class="form-control form-control-sm" name="vConstruccion" placeholder="VConstruccion" value="<?php echo $infoFicha['VConstruccion']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >VCatastral: </label>
                                <input type="text" class="form-control form-control-sm" name="vCatastral" placeholder="VCatastral" value="<?php echo $infoFicha['VCatastral']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >TServicio: </label>
                                <input type="text" class="form-control form-control-sm" name="tServicio" placeholder="TServicio" value="<?php echo $infoFicha['TServicio']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Giro: </label>
                                <input type="text" class="form-control form-control-sm" name="giro" placeholder="Giro" value="<?php echo $infoFicha['Giro']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Superficie: </label>
                                <input type="text" class="form-control form-control-sm" name="superficie" placeholder="Superficie" value="<?php echo $infoFicha['Superficie']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Valor: </label>
                                <input type="text" class="form-control form-control-sm" name="valor" placeholder="Valor" value="<?php echo $infoFicha['Valor']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Frente: </label>
                                <input type="text" class="form-control form-control-sm" name="frente" placeholder="Frente" value="<?php echo $infoFicha['Frente']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >FactorF: </label>
                                <input type="text" class="form-control form-control-sm" name="factorF" placeholder="Factor F" value="<?php echo $infoFicha['FactorF']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Fondo: </label>
                                <input type="text" class="form-control form-control-sm" name="fondo" placeholder="Fondo" value="<?php echo $infoFicha['Fondo']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >FactorFo: </label>
                                <input type="text" class="form-control form-control-sm" name="factorFO" placeholder="Factor FO" value="<?php echo $infoFicha['FactorFo']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >Posicion: </label>
                                <input type="text" class="form-control form-control-sm" name="posicion" placeholder="Posicion" value="<?php echo $infoFicha['Posicion']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label >FactorP: </label>
                                <input type="text" class="form-control form-control-sm" name="factorP" placeholder="Factor P" value="<?php echo $infoFicha['FactorP']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor AV: </label>
                                <input type="text" class="form-control form-control-sm" name="valorAV" placeholder="Valor AV" value="<?php echo $infoFicha['ValorAvenida']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Topografia: </label>
                                <input type="text" class="form-control form-control-sm" name="topografia" placeholder="Topografia" value="<?php echo $infoFicha['Topografia']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >FactorT: </label>
                                <input type="text" class="form-control form-control-sm" name="factorT" placeholder="Factor T" value="<?php echo $infoFicha['FactorT']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >ValorT: </label>
                                <input type="text" class="form-control form-control-sm" name="valorT" placeholder="Valor T" value="<?php echo $infoFicha['ValorT']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor AV: </label>
                                <input type="text" class="form-control form-control-sm" name="valorAV" placeholder="Valor Avenida" value="<?php echo $infoFicha['ValorAvenida']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Estado de Edificacion: </label>
                                <input type="text" class="form-control form-control-sm" name="estadoEdificacion" placeholder="Estado de Edificiacion" value="<?php echo $infoFicha['EstadoEdificacion']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Uso de Suelo: </label>
                                <input type="text" class="form-control form-control-sm" name="usoSuelo" placeholder="Uso de Suelo" value="<?php echo $infoFicha['UsoSuelo']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >ConstruccionH: </label>
                                <input type="text" class="form-control form-control-sm" name="cosntruccionH" placeholder="Construccion H" value="<?php echo $infoFicha['ConstruccionH']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >ConstruccionA: </label>
                                <input type="text" class="form-control form-control-sm" name="construccionA" placeholder="Construccion A" value="<?php echo $infoFicha['ConstruccionA']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Diferencia: </label>
                                <input type="text" class="form-control form-control-sm" name="diferencia" placeholder="Diferencia" value="<?php echo $infoFicha['Diferencia']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Tipo de ServicioA: </label>
                                <input type="text" class="form-control form-control-sm" name="tipoServicioA" placeholder="Tipo de ServicioA" value="<?php echo $infoFicha['tipoServicioA']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >GiroA: </label>
                                <input type="text" class="form-control form-control-sm" name="giroA" placeholder="Giro A" value="<?php echo $infoFicha['giroA']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-6">
                            <div class="md-form form-group">
                                <label >Observaciones: </label>
                                <input type="text" class="form-control form-control-sm" name="observaciones" placeholder="Observaciones" value="<?php echo $infoFicha['observaciones']; ?>" >
                            </div>
                        </div>
                </div>
                <?php for($i = 0;$i<count($infoConstrucciones);$i++){ ?>
                <h2>Descripcion de construccion Año <?php echo $infoConstrucciones[$i]['anioDescript']; ?> </h2>

                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Año: </label>
                                <input type="text" class="form-control form-control-sm" name="anioDC<?php echo $i+1 ?>" placeholder="Año" value="<?php echo $infoConstrucciones[$i]['anioDescript']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >CCC: </label>
                                <input type="text" class="form-control form-control-sm" name="cccDC<?php echo $i+1 ?>" placeholder="CCC" value="<?php echo $infoConstrucciones[$i]['ccc']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >M2: </label>
                                <input type="text" class="form-control form-control-sm" name="m2DC<?php echo $i+1 ?>" placeholder="Metros Cuadrados" value="<?php echo $infoConstrucciones[$i]['m2']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor: </label>
                                <input type="text" class="form-control form-control-sm" name="valorDC<?php echo $i+1 ?>" placeholder="Valor" value="<?php echo $infoConstrucciones[$i]['valor']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Niveles: </label>
                                <input type="text" class="form-control form-control-sm" name="nivelesDC<?php echo $i+1 ?>" placeholder="Niveles" value="<?php echo $infoConstrucciones[$i]['niveles']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Tipo de edad: </label>
                                <input type="text" class="form-control form-control-sm" name="tipoEdadDC<?php echo $i+1 ?>" placeholder="Tipo de Edad" value="<?php echo $infoConstrucciones[$i]['tipo_edad']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Calidad: </label>
                                <input type="text" class="form-control form-control-sm" name="calidadDC<?php echo $i+1 ?>" placeholder="Calidad" value="<?php echo $infoConstrucciones[$i]['calidad']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Conservacion: </label>
                                <input type="text" class="form-control form-control-sm" name="conservacionDC<?php echo $i+1 ?>" placeholder="Conservacion" value="<?php echo $infoConstrucciones[$i]['conservacion']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor Construccion: </label>
                                <input type="text" class="form-control form-control-sm" name="valConstruc<?php echo $i+1 ?>" placeholder="Valor Construccion" value="<?php echo $infoConstrucciones[$i]['valConstruct']; ?>" >
                            </div>
                        </div>
                        <input type="hidden" name="idDC<?php echo $i+1 ?>" value='<?php echo $infoConstrucciones[$i]['id_descrptConstruct']; ?>'>
                </div>
                <?php } ?>
                
                <?php for($i = 0;$i<count($infoCatastral);$i++){ ?>
                <h3>Valores catastrales Año <?php echo $infoCatastral[$i]['anio']; ?></h3>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Año: </label>
                                <input type="text" class="form-control form-control-sm" name="anioVC<?php echo $i+1 ?>" placeholder="Año" value="<?php echo $infoCatastral[$i]['anio']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Superficie de Terreno: </label>
                                <input type="text" class="form-control form-control-sm" name="supTerrenoVC<?php echo $i+1 ?>" placeholder="Superficie de Terreno" value="<?php echo $infoCatastral[$i]['supTerreno']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor: </label>
                                <input type="text" class="form-control form-control-sm" name="valorVC<?php echo $i+1 ?>" placeholder="Valor" value="<?php echo $infoCatastral[$i]['valor']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor Terreno: </label>
                                <input type="text" class="form-control form-control-sm" name="valTerrenoVC<?php echo $i+1 ?>" placeholder="Valor Terreno" value="<?php echo $infoCatastral[$i]['valTerreno']; ?>" >
                            </div>
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Superficie de Terreno: </label>
                                <input type="text" class="form-control form-control-sm" name="supConstructVC<?php echo $i+1 ?>" placeholder="Superficie de Terreno" value="<?php echo $infoCatastral[$i]['supConstruct']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor de construccion: </label>
                                <input type="text" class="form-control form-control-sm" name="valorConstructVC<?php echo $i+1 ?>" placeholder="Valor de construccion" value="<?php echo $infoCatastral[$i]['valorConstruct']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label >Valor Catastral: </label>
                                <input type="text" class="form-control form-control-sm" name="valorCatastralVC<?php echo $i+1 ?>" placeholder="Valor Catastral" value="<?php echo $infoCatastral[$i]['valorCatastral']; ?>" >
                            </div>
                        </div>
                        <input type="hidden" name="idVC<?php echo $i+1 ?>" value='<?php echo $infoCatastral[$i]['id_valCatastrales']; ?>'>
                </div>
                <?php } ?>
                
                <button name="actualiza" class="btn btn-primary">Actualizar</button>
            </form>
            
            
            
            
            
            
        </div>
    </body>

</html>
