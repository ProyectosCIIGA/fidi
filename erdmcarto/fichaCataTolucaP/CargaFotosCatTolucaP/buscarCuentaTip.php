<?php 
    require "../../acnxerdm/cnx.php";
    $exitoBuscando = false;
    $tablaCuentasA = "insertCuentasActuales";
    $tablaTipologias = "insertTipologias";

session_start();

if(((isset($_SESSION['user'])) and (isset($_SESSION['fichas']))) or ($_SESSION['user'] == 1) or ($_SESSION['user'] == 3) or ($_SESSION['user'] == 5)){
    
    ///------------------------------ Consulta de todas las cuentas del dia
        $idUsuario = $_SESSION['user'];
        $fechaDia = date('Y-m-d');
    
    if(isset($_GET['dia'])){
            
        $cuenta = $_POST['cuenta'];
        $sqlBuscar = "SELECT cuentaPredial, CURT, Clave, urlFichaPDF FROM $tablaCuentasA WHERE FechaCarga between convert(date,'$fechaDia 00:00:00') and convert(date,'$fechaDia 11:59:59') and idUsuarioCreacion = ".$_SESSION['user'];
        $prov = sqlsrv_prepare($cnx,$sqlBuscar, array(&$idUsuario));
        
        if(sqlsrv_execute( $prov )){
            //Exito
        }
    }
    
    ///----------------------------------------------------------------------

    if(isset($_POST['buscarCuenta'])){
        $cuenta = $_POST['cuenta'];
        $sqlBuscar = "SELECT cuentaPredial, CURT, Clave, urlFichaPDF FROM $tablaCuentasA WHERE cuentaPredial = ?";
        $prov = sqlsrv_prepare($cnx,$sqlBuscar, array(&$cuenta));
        
        if(sqlsrv_execute( $prov )){
            $exitoBuscando = true;
        }else
            print_r(sqlsrv_errors());
    }

    if(isset($_POST['borrarCuenta'])){
        $cuenta = $_POST['cuentaDelete'];
        
        $sqlBuscar = "DELETE FROM $tablaTipologias WHERE CLAVES = ?";
        if(sqlsrv_query($cnx,$sqlBuscar, array(&$cuenta))){
            
            $sqlBuscar = "DELETE FROM $tablaCuentasA WHERE cuentaPredial = ?";
            if(sqlsrv_query($cnx,$sqlBuscar, array(&$cuenta))){
                $exitoBorrando = true;
            }else
                print_r( sqlsrv_errors());
            
        }else
            print_r(sqlsrv_errors());
        
        
        //$prov = ;
       
    }
    
    if(isset($_GET['ctaBuscar'])){
        $ctaBuscar = $_GET['ctaBuscar'];
        $sqlBuscar = "SELECT cuentaPredial, CURT, Clave, urlFichaPDF FROM $tablaCuentasA WHERE cuentaPredial = ?";
        $prov = sqlsrv_prepare($cnx,$sqlBuscar, array(&$ctaBuscar));
        
        if(sqlsrv_execute( $prov )){
            $exitoBuscando = true;
        }else
            print_r(sqlsrv_errors());
    }

?>

<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuentas y sus tipologias</title>
    <link rel="icon" href="../icono/icon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css"> 
    <link href="../fontawesome/css/all.css" rel="stylesheet"> 
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

        .container {
            margin-top: 0%;
            margin-bottom: 0%;
            padding-top: 3%;
            padding-bottom: 2%;
            padding-left: 5%;
            padding-right: 5%;
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
    <div class="container">
        <form method="post">
            <div class="form-row" style="align-items: center;">
                <div class="col">
                    <div class="md-form form-group" align="right">
                        <label>Cuenta a buscar: </label>
                    </div>
                </div>
                <div class="col">
                    <div class="md-form form-group">
                        <input type="text" class="form-control" name="cuenta" placeholder="Cuenta" value="">
                    </div>
                </div>
                <div class="col">
                    <div class="md-form form-group">
                        <button class="btn btn-primary" name="buscarCuenta">Buscar</button>
                        <a href="cuentasTipologias.php" class="btn btn-primary" title="Nuevo" >Nuevo</a>
                    </div>
                </div>
            </div>
        </form>
        <?php if($exitoBuscando){ ?>
        <div>
            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cuenta</th>
                        <th scope="col">CURT</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                        $row = sqlsrv_fetch_array($prov);
                        if( $row != null and $row != false){
                        do{ ?>
                        <tr>
                            <td style="padding-top:0.5%;padding-bottom:0.5%;font-size:97%;vertical-align:middle;"><?php echo $row['cuentaPredial'] ?></td>
                            <td style="padding-top:0.5%;padding-bottom:0.5%;font-size:97%;vertical-align:middle;"><?php echo $row['CURT'] ?></td>
                            <td style="padding-top:0.5%;padding-bottom:0.5%;font-size:97%;vertical-align:middle;"><?php echo $row['Clave'] ?></td>
                            <td style="padding-top:0.5%;padding-bottom:0.5%;font-size:97%;vertical-align:middle;  display: flex; ">
                                <div>
                                <a href="cuentasTipologias.php?ref=s&&actualizar=<?php echo $row['cuentaPredial'] ?>" class="btn btn-success" title="Actualizar" ><img src="https://img.icons8.com/ios/20/null/refresh--v1.png"/></a>
                                </div>
                                <div style="margin-left: 5px;">
                                    <button class="btn btn-info" style="height: 35px; margin-right: 5px;" onclick="verPDF('<?php echo $row['urlFichaPDF']; ?>')" title="Ver PDF">Ver</button>
                                    <?php if($_SESSION['user'] == $row['idUsuarioCreacion']){ ?>
                                    <form method="post">
                                        <input type="hidden" name="cuentaDelete" value="<?php echo $row['cuentaPredial'] ?>" >
                                        <button class="btn btn-outline-danger" style="height: 35px;" name="borrarCuenta" title="Eliminar registro"><img src="https://img.icons8.com/ios/20/null/delete-forever--v1.png"/></button>
                                    </form>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }while( $row = sqlsrv_fetch_array($prov) );
                    }else{
                    ?>
                    <tr> No se encontraron resultados </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
        
        <script>
            function verPDF(urlP){
                var pdf = document.getElementById("visorPDF");
                pdf.src = urlP;
                pdf.width = "100%";
                pdf.height = "1200px";
                
            }
        </script>
        <div id="contentPDF">
            <embed id="visorPDF" src="" type="application/pdf" width="0%" height="0px">
        </div>
        <div style="text-align: center;">
            <a href="registroFicha.php" class="btn btn-success btn-sm"> Regresar... </a>
        </div>
        
    </div>

    <?php  } else{
        header('location:../../login.php');
    } 
    require "../php/include/footer.php";
    ?>
    <?php 
        //require "include/footer.php";
    ?>
</body>
    

<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>

</html>
