<?php 
    require "../../acnxerdm/cnx.php";
    $modo = 1; // 1 para modo de Insertar y 2 para modo Actualizar
    $cuentaExistente = 0;
    $tablaCuentasA = "insertCuentasActuales";
    $tablaTipologias = "insertTipologias";
    
    session_start();

    $infoCuenta = array('cuenta' => '', 'curt' => '', 'clave' => '', 'frente' => '', 'factor' => '', 'fondo' => '', 'factor1' => '', 'posicion' => '', 'factor2' => '', 'valorm18' => '', 'valorm19' => '', 
                   'valorm22' => '', 'valorAV' => '', 'usoDeSuelo' => '', 'observaciones' => '', 'estadoEdificacion' => '', 'topografia' => '', 'factorTopografia' => '', 'tipoServicioActual' => '',
                   'giroActual' => '', 'valorm23' => '');

    $infoTipologias = array();
    $mensajesComprobacion = array();


//*******************************************************************
if(isset($_GET['cpred'])){
$cuentaPred=trim($_GET['cpred']);
    $va="select top 10 Cuenta_predial,CURT,Clave from PadronCataZapopan2023
    where Cuenta_predial='$cuentaPred'";
    $val=sqlsrv_query($cnx,$va);
    $valida=sqlsrv_fetch_array($val);
    
    $infoCuenta['cuenta'] = $valida['Cuenta_predial'];
    $infoCuenta['curt'] = $valida['CURT'];
    $infoCuenta['clave'] = $valida['Clave'];
}
//****************************************************************************************************

    if(isset($_POST['enviarTabla'])){
        
        $img_1=$_FILES['_1']['name'];
        $img_1temp=$_FILES['_1']['tmp_name'];
        $ext_1=pathinfo($img_1,PATHINFO_EXTENSION);
//        $img_2=$_FILES['_2']['name'];
//        $img_2temp=$_FILES['_2']['tmp_name'];
//        $ext_2=pathinfo($img_2,PATHINFO_EXTENSION);
//        $img_3=$_FILES['_3']['name'];
//        $img_3temp=$_FILES['_3']['tmp_name'];
//        $ext_3=pathinfo($img_3,PATHINFO_EXTENSION);
//        $img_4=$_FILES['_4']['name'];
//        $img_4temp=$_FILES['_4']['tmp_name'];
//        $ext_4=pathinfo($img_4,PATHINFO_EXTENSION);
//        $img_5=$_FILES['_5']['name'];
//        $img_5temp=$_FILES['_5']['tmp_name'];
//        $ext_5=pathinfo($img_5,PATHINFO_EXTENSION);
//        $img_6=$_FILES['_6']['name'];
//        $img_6temp=$_FILES['_6']['tmp_name'];
//        $ext_6=pathinfo($img_6,PATHINFO_EXTENSION);
//        $img_7=$_FILES['_7']['name'];
//        $img_7temp=$_FILES['_7']['tmp_name'];
//        $ext_7=pathinfo($img_7,PATHINFO_EXTENSION);
        if($ext_1 <> 'PNG'){
            echo '<script>alert("La imagen [_1] seleccionada ['.$ext_1.'] deben estar en formato .png");</script>';
        } else if($ext_2 <> 'PNG'){
            echo '<script>alert("La imagen [_2] seleccionada deben estar en formato .png");</script>';
        } else if($ext_3 <> 'PNG'){
            echo '<script>alert("La imagen [_3] seleccionada deben estar en formato .png");</script>';
        } else if($ext_4 <> 'PNG'){
            echo '<script>alert("La imagen [_4] seleccionada deben estar en formato .png");</script>';
        } else if($ext_5 <> 'PNG'){
            echo '<script>alert("La imagen [_5] seleccionada deben estar en formato .png");</script>';
        } else if($ext_6 <> 'PNG'){
            echo '<script>alert("La imagen [_6] seleccionada deben estar en formato .png");</script>';
        } else if($ext_7 <> 'PNG'){
            echo '<script>alert("La imagen [_7] seleccionada deben estar en formato .png");</script>';
        } else{
               /*             
        $fecha = date('d-m-y').' 00:00:00';
        $cuenta = $_POST['cuenta'];
        $curt = $_POST['curt'];
        $clave = $_POST['clave'];
        $frente = $_POST['frente'];
        $factor = $_POST['factor'];
        $fondo = $_POST['fondo'];
        $factor1 = $_POST['factor1'];
        $posicion = $_POST['posicion'];
        $factor2 = $_POST['factor2'];
        $valorm18 = $_POST['valorm18'];
        $valorm19 = $_POST['valorm19'];
        $valorm22 = $_POST['valorm22'];
        $valorAV = $_POST['valorAV'];
        $usoDeSuelo = $_POST['usoDeSuelo'];
        $observaciones = $_POST['observaciones'];
        $estadoEdificacion = $_POST['estadoEdificiacion'];
        $topografia = $_POST['topografia'];
        $factorTopografia = $_POST['factorTopografia'];
        $tipoServicioAnual = $_POST['tipoServicioActual'];
        $giroActual = $_POST['giroActual'];
        $valorm23 = $_POST['valorm23'];
        $tokenCactuales = $_POST['cuenta'].date('YmdHis').rand(100,999);
        
        $sqlCuentaExistente = "SELECT COUNT(*) FROM $tablaCuentasA WHERE cuentaPredial = ?";
        $p = sqlsrv_prepare($cnx,$sqlCuentaExistente, array(&$cuenta ));
        
        if(sqlsrv_execute( $p )){
            $row = sqlsrv_fetch_array($p);
            if($row[0] > 0){
                $cuentaExistente = 1;
                
                reLlenadoCampos();
            
            } else{
                
                if(comprobacionTipologias()){
                    $sqlInsert = "INSERT INTO $tablaCuentasA(FechaCarga, cuentaPredial, CURT, Clave, Frente, Factor, Fondo, Factor1, Posicion, Factor2, Valorm2_17_18, Valorm2_19, Valorm2_20_22, ValorAV, UsodeSuelo, Observaciones, estadoEdificacion, Topografia, factorTopografia, tipodeServicio_Actual, giro_Actual, Valorm2_23) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $prov = sqlsrv_prepare($cnx,$sqlInsert, array(&$fecha, &$cuenta, &$curt, &$clave, &$frente, &$factor, &$fondo, &$factor1, &$posicion, &$factor2, &$valorm18, &$valorm19, &$valorm22, &$valorAV, &$usoDeSuelo, &$observaciones, &$estadoEdificacion, &$topografia, &$factorTopografia, &$tipoServicioAnual, &$giroActual, &$valorm23,$tokenCactuales));
                    if(sqlsrv_execute( $prov )){
                        $i = 1;
                        $exitoInsert = true;
                        while(true){
                            if(isset($_POST['CCC'.$i])){
                                $ccc = $_POST['CCC'.$i];
                                $area = $_POST['AREA'.$i];
                                $nivel = $_POST['NIVEL'.$i];
                                $sqlInsert = "INSERT INTO $tablaTipologias(CLAVES,CCC, AREA, NIVEL) VALUES(?,?,?,?)";
                                $prov = sqlsrv_prepare($cnx,$sqlInsert, array(&$cuenta,&$ccc,&$area,&$nivel));
                                if(sqlsrv_execute( $prov ) == false){
                                    $exitoInsert = false;
                                }
                                print("  Impri -> ".$sqlInsert);
                            }else{
                                break;
                            }
                            $i++;
                        }
                        
//*********************************************** INSERT FOTOS FICHA ***********************************************************
                        
                    $nomImg_1=$cuenta.'_1.'.$ext;
                    $nomImg_2=$cuenta.'_2.'.$ext;
                    $nomImg_3=$cuenta.'_3.'.$ext;
                    $nomImg_4=$cuenta.'_4.'.$ext;
                    $nomImg_5=$cuenta.'_5.'.$ext;
                    $nomImg_6=$cuenta.'_6.'.$ext;
                    $nomImg_7=$cuenta.'_7.'.$ext;
                    move_uploaded_file($img_1temp,'../doctos/Ortofoto 2016/'.$nomImg_1);
                    move_uploaded_file($img_2temp,'../doctos/Ortofoto 2022/'.$nomImg_2);
                    move_uploaded_file($img_3temp,'../doctos/Fotos Oblicuas/'.$nomImg_3);
                    move_uploaded_file($img_4temp,'../doctos/Fotos Oblicuas/'.$nomImg_4);
                    move_uploaded_file($img_5temp,'../doctos/Fotos Oblicuas/'.$nomImg_5);
                    move_uploaded_file($img_6temp,'../doctos/Fotos Oblicuas/'.$nomImg_6);
                    move_uploaded_file($img_7temp,'../doctos/Croquis_con_Cotas/'.$nomImg_7);
                        
                    $registro="insert into imgFicha (tokenCactuales,cuentaPredial,img_1,img_2,img_3,img_4,img_5,img_6,img_7) 
                    values ('$tokenCactuales','$cuenta','$nomImg_1','$nomImg_2','$nomImg_3','$nomImg_4','$nomImg_5','$nomImg_6','$nomImg_7')";
                    sqlsrv_query($cnx,$registro) or die ('No se ejecuto la consulta isert incidencias');
                        
//********************************************* FIN INSERT FOTOS FICHA *********************************************************
                        
                        if($exitoInsert){
                            echo '<script>alert("Se guardo la cuenta correctamente")</script>';
                            echo '<meta http-equiv="refresh" content="0 ,url=cuentasTipologias.php"';
                        }
                    }else
                        die(print_r( sqlsrv_errors(), true));
                }
                
            }
        }else
            die(print_r( sqlsrv_errors(), true));
            */
    }
}

//**********************************************************************************************************

    if(isset($_POST['actualizarCuenta']) and isset($_GET['actualizar'])){
        $cuentaActualizar = $_GET['actualizar'];
            
        $fecha = date('d-m-y').' 00:00:00';
        //$cuenta = $_POST['cuenta'];
        $curt = $_POST['curt'];
        $clave = $_POST['clave'];
        $frente = $_POST['frente'];
        $factor = $_POST['factor'];
        $fondo = $_POST['fondo'];
        $factor1 = $_POST['factor1'];
        $posicion = $_POST['posicion'];
        $factor2 = $_POST['factor2'];
        $valorm18 = $_POST['valorm18'];
        $valorm19 = $_POST['valorm19'];
        $valorm22 = $_POST['valorm22'];
        $valorAV = $_POST['valorAV'];
        $usoDeSuelo = $_POST['usoDeSuelo'];
        $observaciones = $_POST['observaciones'];
        $estadoEdificacion = $_POST['estadoEdificiacion'];
        $topografia = $_POST['topografia'];
        $factorTopografia = $_POST['factorTopografia'];
        $tipoServicioAnual = $_POST['tipoServicioActual'];
        $giroActual = $_POST['giroActual'];
        $valorm23 = $_POST['valorm23'];
        
        
        $sqlInsert = "UPDATE $tablaCuentasA SET FechaCarga = ?, CURT = ?, Clave = ?, Frente = ?, Factor = ?, Fondo = ?, Factor1 = ?, Posicion = ?, Factor2 = ?, Valorm2_17_18 = ?, Valorm2_19 = ?, Valorm2_20_22 = ?, ValorAV = ?, UsodeSuelo = ?, Observaciones = ?, estadoEdificacion = ?, Topografia = ?, factorTopografia = ?, tipodeServicio_Actual = ?, giro_Actual = ?, Valorm2_23 = ? WHERE cuentaPredial = ?";
        
        $prov = sqlsrv_prepare($cnx,$sqlInsert, array(&$fecha, &$curt, &$clave, &$frente, &$factor, &$fondo, &$factor1, &$posicion, &$factor2, &$valorm18, &$valorm19, &$valorm22, &$valorAV, &$usoDeSuelo, &$observaciones, &$estadoEdificacion, &$topografia, &$factorTopografia, &$tipoServicioAnual, &$giroActual, &$valorm23, &$cuentaActualizar));
        
        if(sqlsrv_execute( $prov ) and $prov != false){
            print("     '$cuentaActualizar' SQL");
            $i = 1;
            
            while(true){
                if(isset($_POST['CCC'.$i])){
                    $ccc = $_POST['CCC'.$i];
                    $area = $_POST['AREA'.$i];
                    $nivel = $_POST['NIVEL'.$i];
                    $id = $_POST['idTip'.$i];
                    $sqlInsert = "UPDATE $tablaTipologias SET CLAVES = ?, CCC = ?, AREA = ?, NIVEL = ? WHERE CLAVES = ? and id_tipologia = ?";
                    $prov = sqlsrv_prepare($cnx,$sqlInsert, array(&$cuentaActualizar,&$ccc,&$area,&$nivel,&$cuentaActualizar,&$id));
                    sqlsrv_execute( $prov );
                    print("  Impri -> ".$sqlInsert);
                }else{
                    break;
                }
                $i++;
            }
            
        }else
            die(print_r( sqlsrv_errors(), true));
    }


    $cuentaActualizarExist = true;

    $tipologiaGuardada = false;
    if(isset($_POST['nuevaTipologia']) and isset($_GET['actualizar'])){
        
        
        $cuenta = $_SESSION['cuentaActual'];
        
        $ccc = trim($_POST['cccNueva']);
        $area = trim($_POST['areaNueva']);
        $nivel = trim($_POST['nivelNueva']);
        
        if( $ccc != '' and $area != '' and $nivel != ''){
            $sqlInsert = "INSERT INTO $tablaTipologias(CLAVES,CCC, AREA, NIVEL) VALUES(?,?,?,?)";
            $prov = sqlsrv_prepare($cnx,$sqlInsert, array(&$cuenta,&$ccc,&$area,&$nivel));
            if(sqlsrv_execute( $prov )){
                echo '<script>alert("Se guardo nueva tipologia correctamente")</script>';
                echo '<meta http-equiv="refresh" content="0 ,url=cuentasTipologias.php?actualizar='.$_GET['actualizar'].'"';
                $tipologiaGuardada = true;
            }else{
                die(print_r( sqlsrv_errors(), true));
            }
        }else{
            $mensajesComprobacion[] = "Campos vacios para la nueva tipologia";
        }
        unset($_POST['nuevaTipologia']);
        unset($_SESSION['cuentaActual']);
    }


    $exitoEliminando = false;
    if(isset($_GET['borrarTipologia']) and isset($_GET['actualizar']) ){
        $id = $_GET['borrarTipologia'];
        $sqlBuscar = "DELETE FROM $tablaTipologias WHERE id_tipologia = ?";
        $prov = sqlsrv_prepare($cnx,$sqlBuscar, array(&$id));
        
        if(sqlsrv_execute( $prov )){
            echo '<script>alert("Se borro tipologia correctamente")</script>';
            echo '<meta http-equiv="refresh" content="0 ,url=cuentasTipologias.php?actualizar='.$_GET['actualizar'].'"';
            $exitoEliminando = true;
        }else{
            die(print_r( sqlsrv_errors(), true));
        }
    }
    
    if(isset($_GET['actualizar'])){
        $modo = 2;
        
        
        
        $cuenta = $_GET['actualizar'];
        $sqlConsulta = "SELECT * FROM $tablaCuentasA WHERE cuentaPredial = ?";
        
        $prov = sqlsrv_prepare($cnx,$sqlConsulta, array(&$cuenta));
        
        if(sqlsrv_execute( $prov )){
            $row = sqlsrv_fetch_array($prov);
            if( $row != null and $row != false){
                    
                    $_SESSION['cuentaActual'] = $_GET['actualizar'];
//                echo $_SESSION['cuentaActual'];
                
                    $infoCuenta['cuenta'] = $row['cuentaPredial'];
                    $infoCuenta['curt'] = $row['CURT'];
                    $infoCuenta['clave'] = $row['Clave'];
                    $infoCuenta['frente'] = $row['Frente'];
                    $infoCuenta['factor'] = $row['Factor'];
                    $infoCuenta['fondo'] = $row['Fondo'];
                    $infoCuenta['factor1'] = $row['Factor1'];
                    $infoCuenta['posicion'] = $row['Posicion'];
                    $infoCuenta['factor2'] = $row['Factor2'];
                    $infoCuenta['valorm18'] = ($row['Valorm2_17_18']);
                    $infoCuenta['valorm19'] = $row['Valorm2_19'];
                    $infoCuenta['valorm22'] = $row['Valorm2_20_22'];
                    $infoCuenta['valorAV'] = floatval($row['ValorAV']);
                    $infoCuenta['usoDeSuelo'] = $row['UsodeSuelo'];
                    $infoCuenta['observaciones'] = $row['Observaciones'];
                    $infoCuenta['estadoEdificacion'] = $row['estadoEdificacion'];
                    $infoCuenta['topografia'] = $row['Topografia'];
                    $infoCuenta['factorTopografia'] = $row['factorTopografia'];
                    $infoCuenta['tipoServicioActual'] = $row['tipodeServicio_Actual'];
                    $infoCuenta['giroActual'] = $row['giro_Actual'];
                    $infoCuenta['valorm23'] = $row['Valorm2_23'];
                    
            }else{
                $cuentaActualizarExist = false;
            }
        }else
            print_r(sqlsrv_errors());
        
        $sqlConsulta = "SELECT * FROM $tablaTipologias WHERE CLAVES = ?";
        
        $prov = sqlsrv_prepare($cnx,$sqlConsulta, array(&$cuenta));
        if(sqlsrv_execute( $prov )){
            $row = sqlsrv_fetch_array($prov);
            if( $row != null and $row != false){
                do{ 
                    $tipologias = array('ccc' => '', 'area' => '', 'nivel' => '', 'id' => '');
                    $tipologias['ccc'] = $row['CCC'];
                    $tipologias['area'] = $row['AREA'];
                    $tipologias['nivel'] = $row['NIVEL'];
                    $tipologias['id'] = $row['id_tipologia'];
                    
                    $infoTipologias[] = $tipologias;
                }while($row = sqlsrv_fetch_array($prov));
            }else
                $mensajesComprobacion[] = "no hay tipologias";
        }else
            echo "Fallo la consulta de las tipologias a la cuenta";
    }else{
       $infoTipologias[] = array('ccc' => '', 'area' => '', 'nivel' => '');
    }

    function comprobacionTipologias(){
        global $mensajesComprobacion;
        $i = 1;
        $cantidad = 0;
        while(true){
            if(isset($_POST['CCC'.$i])){
                $cantidad++;
                if(trim($_POST['CCC'.$i]) == '' or trim($_POST['AREA'.$i]) == '' or trim($_POST['NIVEL'.$i]) == ''){
                    $mensajesComprobacion[] = "Campos vacios para la nueva tipologia";
                    break;
                }
                
            }else{
                break;
            }
            $i++;
        }
        
        if($cantidad == 0){
            $mensajesComprobacion[] = "No tiene tipologias, debe ingresar los datos";
        }
        
        if(count($mensajesComprobacion) == 0){
            return 1;
        }else
            return 0;
    }
        
    function reLlenadoCampos(){
        global $infoCuenta, $infoTipologias;
        
        $infoCuenta['cuenta'] = $_POST['cuenta'];
        $infoCuenta['curt'] = $_POST['curt'];
        $infoCuenta['clave'] = $_POST['clave'];
        $infoCuenta['frente'] = $_POST['frente'];
        $infoCuenta['factor'] = $_POST['factor'];
        $infoCuenta['fondo'] = $_POST['fondo'];
        $infoCuenta['factor1'] = $_POST['factor1'];
        $infoCuenta['posicion'] = $_POST['posicion'];
        $infoCuenta['factor2'] = $_POST['factor2'];
        $infoCuenta['valorm18'] = $_POST['valorm18'];
        $infoCuenta['valorm19'] = $_POST['valorm19'];
        $infoCuenta['valorm22'] = $_POST['valorm22'];
        $infoCuenta['valorAV'] = $_POST['valorAV'];
        $infoCuenta['usoDeSuelo'] = $_POST['usoDeSuelo'];
        $infoCuenta['observaciones'] = $_POST['observaciones'];
        $infoCuenta['estadoEdificacion'] = $_POST['estadoEdificiacion'];
        $infoCuenta['topografia'] = $_POST['topografia'];
        $infoCuenta['factorTopografia'] = $_POST['factorTopografia'];
        $infoCuenta['tipoServicioActual'] = $_POST['tipoServicioActual'];
        $infoCuenta['giroActual'] = $_POST['giroActual'];
        $infoCuenta['valorm23'] = $_POST['valorm23'];

        $i = 1;
        while(true){
            if(isset($_POST['CCC'.$i])){

                $tipologias = array('ccc' => '', 'area' => '', 'nivel' => '', 'id' => '');
                $tipologias['ccc'] = $_POST['CCC'.$i];
                $tipologias['area'] = $_POST['AREA'.$i];
                $tipologias['nivel'] = $_POST['NIVEL'.$i];

                $infoTipologias[] = $tipologias;
                }else{
                    break;
                }
                $i++;
        }
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
            /*        background-attachment: fixed;*/
            overflow-x: hidden;
            /* ocultar scrolBar horizontal*/
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
        <?php if($tipologiaGuardada){ ?>
            <div style="display: flex; justify-content: center;">
                <label style="color:green;">Se guardo tipologia exitosamente </label>
            </div>
        <?php } if($exitoEliminando){ ?>
            <div style="display: flex; justify-content: center;">
                <label style="color:green;">Se Elimino tipologia exitosamente </label>
            </div>
        <?php } if($cuentaActualizarExist == false){ ?>
        <h2> No existen registros a actualizar con esa cuenta </h2>
        <?php } ?>
        <form method="post">
            <div>
    <h1 style="text-shadow: 1px 1px 2px #717171;">Nueva Ficha Catastral</h1>
    <h5 style="text-shadow: 0px 0px 2px #717171;"><img src="https://img.icons8.com/color/48/null/new-by-copy.png"/> Cuenta Actual [<?php echo $_GET['cpred'] ?>] Zapopan Predial</h5>
                <hr>
            <?php if($cuentaExistente == 1){ ?>
                <span class="badge badge-danger"> - Cuenta ya existente - </span>
            <?php } ?>

            <?php if(count($mensajesComprobacion) > 0){
                    for($i=0;$i<count($mensajesComprobacion);$i++){ ?>
            <span class="badge badge-danger"> <?php echo $mensajesComprobacion[$i] ?> </span>
            <?php   } } ?>
            <div class="jumbotron">
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="cuenta">Cuenta: *</label>
                            <input type="text" class="form-control form-control-sm" name="cuenta" placeholder="Cuenta" value="<?php echo $infoCuenta['cuenta'] ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="curt">CURT: *</label>
                            <input type="text" class="form-control form-control-sm" name="curt" placeholder="CURT" value="<?php echo $infoCuenta['curt'] ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="clave">Clave: *</label>
                            <input type="text" class="form-control form-control-sm" name="clave" placeholder="Clave" value="<?php echo $infoCuenta['clave'] ?>" readonly required>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="form-row">
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="frente">Frente: *</label>
                            <input type="text" class="form-control form-control-sm" name="frente" placeholder="Frente" value="<?php echo $infoCuenta['frente'] ?>" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="factor">Factor: *</label>
                            <input type="text" class="form-control form-control-sm" name="factor" placeholder="Factor" value="<?php echo $infoCuenta['factor'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="fondo">Fondo: *</label>
                            <input type="text" class="form-control form-control-sm" name="fondo" placeholder="Fondo" value="<?php echo $infoCuenta['fondo'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="factor1">Factor 1: *</label>
                            <input type="text" class="form-control form-control-sm" name="factor1" placeholder="Factor1" value="<?php echo $infoCuenta['factor1'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="posicion">Posicion: *</label>
                            <input type="text" class="form-control form-control-sm" name="posicion" placeholder="Posicion" value="<?php echo $infoCuenta['posicion'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="factor2">Factor 2: *</label>
                            <input type="text" class="form-control form-control-sm" name="factor2" placeholder="Factor 2" value="<?php echo $infoCuenta['factor2'] ?>" required>
                        </div>
                    </div>
                </div>
                </div>
                
                
                <hr class="hrIzq" />
            <div class="jumbotron">
                <div class="form-row">
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="valorm18">Valorm 2017-18: *</label>
                            <input type="text" class="form-control form-control-sm" name="valorm18" placeholder="Valorm 2017-2018" value="<?php echo $infoCuenta['valorm18'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="valorm19">Valorm 2019: *</label>
                            <input type="text" class="form-control form-control-sm" name="valorm19" placeholder="Valorm 2019" value="<?php echo $infoCuenta['valorm19'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="valorm22">Valorm 2020-22: *</label>
                            <input type="text" class="form-control form-control-sm" name="valorm22" placeholder="Valorm 2020-2022" value="<?php echo $infoCuenta['valorm22'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="valorm23">Valorm 2023: *</label>
                            <input type="text" class="form-control form-control-sm" name="valorm23" placeholder="Valorm 2023" value="<?php echo $infoCuenta['valorm23'] ?>" required>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="valorAV">Valor AV: *</label>
                            <input type="text" class="form-control form-control-sm" name="valorAV" placeholder="Valor AV" value="<?php echo $infoCuenta['valorAV'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form form-group">
                            <label for="usoDeSuelo">Uso de Suelo: *</label>
                            <input type="text" class="form-control form-control-sm" name="usoDeSuelo" placeholder="Uso de suelo" value="<?php echo $infoCuenta['usoDeSuelo'] ?>" required>
                        </div>
                    </div>
                </div>
                </div>
                
                <hr class="hrDer" />
                
        <div class="jumbotron">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="md-form form-group">
                            <label for="observaciones">Observaciones: </label>
<!--
                            <select class="form-control form-control-sm" name="observaciones" required>
                                <option value="">Selecciona una opcion</option>
                                <option value="">Predio de uso habitacional a 1,2 y 3 niveles de construcción.</option>
                            </select>
-->
                            <input type="text" class="form-control form-control-sm" name="observaciones" placeholder="Observaciones" value="<?php echo $infoCuenta['observaciones'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="topografia">Topografia: *</label>
                                <select class="form-control form-control-sm" name="topografia" required>
                                    <option value="">Selecciona una opcion</option>
                                    <option value="">A desnivel</option>
                                    <option value="">A nivel de piso</option>
                                </select>
<!--                            <input type="text" class="form-control" name="topografia" placeholder="Uso de suelo" value="<?php// echo $infoCuenta['topografia'] ?>">-->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form form-group">
                            <label for="factorTopografia">Factor de topografia: *</label>
                            <input type="text" class="form-control form-control-sm" name="factorTopografia" placeholder="Factor de topografia" value="<?php echo $infoCuenta['factorTopografia'] ?>" required>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="estadoEdificacion">Estado de edificacion: *</label>
<!--
                                <select class="form-control form-control-sm" name="estadoEdificiacion" required>
                                    <option value="">Selecciona una opcion</option>
                                    <option value="">Edificado</option>
                                </select>
-->
                            <input type="text" class="form-control form-control-sm" name="estadoEdificiacion" placeholder="Estado de edificacion" value="Edificado" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="tipoServicioActual">Tipo de servicio Actual: *</label>
                                <select class="form-control form-control-sm" name="tipoServicioActual" required>
                                    <option value="">Selecciona una opcion</option>
                                    <option value="">Habitacional</option>
                                    <option value="">Comercial</option>
                                    <option value="">Industrial</option>
                                    <option value="">Servicios</option>
                                    <option value="">Equipamiento</option>
                                    <option value="">Mixto</option>
                                </select>
<!--                            <input type="text" class="form-control" name="tipoServicioActual" placeholder="Tipo de servicio Actual" value="<?php// echo $infoCuenta['tipoServicioActual'] ?>">-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form form-group">
                            <label for="giroActual">Giro actual: *</label>
                                <select class="form-control form-control-sm" name="giroActual" required>
                                    <option value="">Selecciona una opcion</option>
                                    <option value="">Habitacional</option>
                                    <option value="">Comercial</option>
                                    <option value="">Fabrica/Industria</option>
                                    <option value="">Servicios</option>
                                    <option value="">Equipamiento</option>
                                    <option value="">Habitacional/Comercial</option>
                                    <option value="">Habitacional/Industrial</option>
                                    <option value="">Habitacional/Servicios</option>
                                    <option value="">Comercial/Industrial</option>
                                    <option value="">Comercial/Servicios</option>
                                    <option value="">Industrial/Servicios</option>
                                </select>
<!--                            <input type="text" class="form-control" name="giroActual" placeholder="Giro actual" value="<?php// echo $infoCuenta['giroActual'] ?>">-->
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
            
            
            
            
            
    <div class="jumbotron">
      
      
      <h3 style="text-shadow: 0px 0px 2px #717171;"><img src="https://img.icons8.com/external-prettycons-flat-prettycons/47/null/external-picture-multimedia-prettycons-flat-prettycons.png"/> Evidencia Fotográfica</h3>
      <hr>
      
        <div class="form-row">
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Ortofoto año 2016*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-success">Antecedente _1</span>
                    <input type="file" class="form-control-file" name="_1" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Ortofoto año 2022*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-success">Actual _2</span>
                    <input type="file" class="form-control-file" name="_2" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
        </div>
        
        
      <hr>
      
      
       
        <div class="form-row">
            <div class="col-md-3">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua*</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _3</span>
                    <input type="file" class="form-control-file" name="_3" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-3">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _4</span>
                    <input type="file" class="form-control-file" name="_4" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-3">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _5</span>
                    <input type="file" class="form-control-file" name="_5" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-3">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span class="badge badge-warning">Año 2022 _6</span>
                    <input type="file" class="form-control-file" name="_6" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
        </div>
        
        <hr>
        
        
            <div class="md-form form-group">
                <label for="exampleFormControlFile1">Croquis de construcciones* &nbsp;&nbsp;&nbsp;<span class="badge badge-success">Croquis con Cotas _7</span>
                </label>
                <input type="file" class="form-control-file" name="_7" data-toggle="tooltip" data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
            </div>
<!--
    <input type="hidden" class="form-control" name="usr" value="<?php// echo $_GET['usr'] ?>" required>
    <input type="hidden" class="form-control" name="alta" value="<?php// echo date('Y/m/d_H:i:s') ?>" required>
-->
</div>
   
    <small id="e" class="form-text text-muted" style="font-size:14px;"><i class="fas fa-info-circle"></i> Campos requeridos marcados con (*).</small>
            
            
            
            
            
            
            
            <div id="tipologiasTabla">
                <hr class="hrIzq" />
                <div style="display: flex; align-items: center; justify-content: center; ">
                    <h2>Tipologias de la cuenta</h2>
                </div>
                <hr class="hrDer" />
                <div class="table-responsive" style="display: flex; align-items: center; justify-content: center; ">
                    <table class="table" id="tipologiasTabla" style="width: 75%;">
                        <tr style="text-align: center;">
                            <th>CCC* </th>
                            <th>AREA* </th>
                            <th>NIVEL* </th>
                            <?php if($modo == 2){ ?> <th>Acciones </th> <?php } ?>
                        </tr>
                        <tbody id="tipologiasTbody" style="text-align: center;">
                            <?php if($modo == 1) { ?>
                            <tr>
                                <td><input name="CCC1" type="text" required/></td>
                                <td><input name="AREA1" type="text" required/></td>
                                <td><input name="NIVEL1" type="text" required/></td>
                            </tr>
                            <?php } if($modo == 2){ 
                                for($i=0;$i<count($infoTipologias);$i++){
                            ?>
                            <tr>
                                <input type=hidden name="idTip<?php echo ($i+1) ?>" value="<?php echo $infoTipologias[$i]['id'] ?>" />
                                <td><input name="CCC<?php echo ($i+1) ?>" type="text" value="<?php echo $infoTipologias[$i]['ccc'] ?>" required /></td>
                                <td><input name="AREA<?php echo ($i+1) ?>" type="text" value="<?php echo $infoTipologias[$i]['area'] ?>" required /></td>
                                <td><input name="NIVEL<?php echo ($i+1) ?>" type="text" value="<?php echo $infoTipologias[$i]['nivel'] ?>" required /></td>
                                <td>
                                    <a href="cuentasTipologias.php?actualizar=<?php echo $_GET['actualizar'] ?>&borrarTipologia=<?php echo $infoTipologias[$i]['id'] ?>" class="btn btn-outline-danger" title="Eliminar registro : <?php echo $infoTipologias[$i]['id'] ?>" ><img src="https://img.icons8.com/ios/20/null/delete-forever--v1.png"/></a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="botonGuardar">
                <?php if($modo == 1){ ?>
                <input class="btn btn-primary btn-sm" type="submit" name="enviarTabla" value="Generar ficha catastral">
                <?php } if($modo == 2){ ?>
                <input class="btn btn-outline-primary btn-sm" type="submit" name="actualizarCuenta" value="Actualizar datos">
                <?php } ?>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </form>
        <?php if($modo == 2){  ?>
        <h2>Guardar nueva tipologia a la cuenta: </h2>
        <form method="post">
                <div class="form-row">
                    <div class="col">
                        <div class="md-form form-group">
                            <label for="cccNueva">CCC:* </label>
                            <input type="text" class="form-control" name="cccNueva" placeholder="Nuevo CCC" value="" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form form-group">
                            <label for="areaNueva">AREA:* </label>
                            <input type="text" class="form-control" name="areaNueva" placeholder="Nueva Area" value="" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form form-group">
                            <label for="nivelNueva">NIVEL:* </label>
                            <input type="text" class="form-control" name="nivelNueva" placeholder="Nuevo Nivel" value="" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form form-group">
                            <input class="btn btn-outline-primary" type="submit" name="nuevaTipologia" value="Agregar la nueva tipologia">
                        </div>
                    </div>
                </div>
        </form>
        
        <?php } if($modo == 1){ ?>
        <button class="btn btn-success btn-sm" onclick="agregarTipologia()"><i class="fas fa-plus"></i> Nueva tipologia</button>
        <button class="btn btn-danger btn-sm" onclick="quitarTipologia()"><i class="fas fa-times"></i> Remover ultima tipologia</button>
        <?php } ?>
        
        
        
        
    <br><br><br>    
       
       
       
        
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        
        
        
    </div>
     
    <?php 
        require "../php/include/footer.php";
    ?>
</body>

<script>
    function agregarTipologia() {
        var table = document.getElementById("tipologiasTbody");

        var row = table.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);

        var ccc = document.createElement("INPUT");
        var area = document.createElement("INPUT");
        var nivel = document.createElement("INPUT");

        ccc.setAttribute("type", "text");
        area.setAttribute("type", "text");
        nivel.setAttribute("type", "text");
        
        ccc.setAttribute("name", "CCC" + table.rows.length);
        area.setAttribute("name", "AREA" + table.rows.length);
        nivel.setAttribute("name", "NIVEL" + table.rows.length);
        
        ccc.require = true;
        area.require = true;
        nivel.require = true;
        
        //cell1.innerHTML = document.getElementById("nombreC").value;
        cell1.appendChild(ccc);
        cell2.appendChild(area);
        cell3.appendChild(nivel);

    }

    function quitarTipologia() {
        var table = document.getElementById("tipologiasTbody");
        table.deleteRow(-1);
    }

</script>

<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>

</html>
