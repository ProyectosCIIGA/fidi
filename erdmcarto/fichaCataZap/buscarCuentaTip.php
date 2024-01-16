<?php 
    require "../../acnxerdm/cnx.php";
    $exitoBuscando = false;
    $tablaCuentasA = "insertCuentasActuales";
    $tablaTipologias = "insertTipologias";
echo $serverName;

    if(isset($_POST['buscarCuenta'])){
        $cuenta = $_POST['cuenta'];
        $sqlBuscar = "SELECT cuentaPredial, CURT, Clave FROM $tablaCuentasA WHERE cuentaPredial = ?";
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
            $exitoBorrando = true;
        }else
            print_r(sqlsrv_errors());
        
        $sqlBuscar = "DELETE FROM $tablaCuentasA WHERE cuentaPredial = ?";
        //$prov = ;
       
        if(sqlsrv_query($cnx,$sqlBuscar, array(&$cuenta))){
            $exitoBorrando = true;
        }else
            print_r( sqlsrv_errors());
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
    <?php //require "include/nav.php"; ?>
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
                                <a href="cuentasTipologias.php?actualizar=<?php echo $row['cuentaPredial'] ?>" class="btn btn-success" title="Actualizar" ><img src="https://img.icons8.com/ios/20/null/refresh--v1.png"/></a>
                                </div>
                                <div style="margin-left: 5px;">
                                    <form method="post">
                                        <input type="hidden" name="cuentaDelete" value="<?php echo $row['cuentaPredial'] ?>" >
                                        <button class="btn btn-outline-danger" name="borrarCuenta" title="Eliminar registro"><img src="https://img.icons8.com/ios/20/null/delete-forever--v1.png"/></button>
                                    </form>
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
    </div>

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
