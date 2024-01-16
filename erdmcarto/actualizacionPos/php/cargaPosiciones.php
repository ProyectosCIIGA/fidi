<?php

require_once('../lib/PhpSpreadsheet/vendor/autoload.php');
$serverName = "51.222.44.135";
$connectionInfo = array( 'Database'=>'cartomaps', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
$cn1 = sqlsrv_connect($serverName, $connectionInfo);
date_default_timezone_set('America/Mexico_City');
    $c1 = $_GET['id_usuario'];
    $c2 = "SELECT * FROM usuarionuevo
  where id_usuarioNuevo='$c1'";
    $admin1 = sqlsrv_query($cn1, $c2);
    $Ad = sqlsrv_fetch_array($admin1);
//    $serverName = "51.222.44.135";
//    $connectionInfo = array( 'Database'=>'implementtaTijuanaP', 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
//    $cnx = sqlsrv_connect($serverName, $connectionInfo);
//    date_default_timezone_set('America/Mexico_City');

    if(isset($_GET['plaza']) ){
        $plaza = $_GET['plaza'];
        require 'configConexiones.php';
    }

    if(isset($_GET['errorCruze']) ){
        $plaza = $_GET['plaza'];
        echo '<script> window.open("excelCuentasNoCruce.php?plaza='.$plaza.'"); </script>';
    }

    function comprobacionNombre($nombreNuevo){
        $errorNombre = false;

        $datosNombre = explode(".", $nombreNuevo);

        if(count($datosNombre) != 2)
            return false;

        if($datosNombre[1] == 'xls' or $datosNombre[1] == 'xlsx'){
            return true;
        }else
            return false;
    }

    function obtenerCamposBD($nombreTabla, $conexion){
        $nombresCamposBD = array();

        if( $conexion == false ) {
                echo '<script> alert("No Hay conexcion"); </script>';
        }else{
            $sql = "SELECT TOP 1 * FROM $nombreTabla";
            $stmt = sqlsrv_prepare( $conexion, $sql );
            $camposBD = sqlsrv_field_metadata( $stmt );
            foreach( $camposBD as $fieldMetadata ) {
                foreach( $fieldMetadata as $name => $value) {
                    if($name === 'Name' ){//and $value != 'FechaCarga' and $value != 'Valorm2_23'){
                        $nombresCamposBD[] = $value;
                    }
                }
            }
        }
        return $nombresCamposBD; 
    }

function generarValues($num){
    $values = 'VALUES(?,?,?)';
    
    for($i = 1;$i < $num/3; $i++){
        $values = $values.', (?,?,?)';
    }
    
    return $values;
}


if(isset($_POST['actualiza']) ){
        
    $sp2 = sqlsrv_query($cnx,"EXEC sp_Actualizalatlog;");
    if( $sp2 == false ){
        echo "SP Fallo ";
        print_r(sqlsrv_errors() );
        exit();
    }

    while (sqlsrv_next_result($sp2) != null){};

    if( sqlsrv_errors() ){
        echo "Es mi Segundo SP:  ";
        print_r(sqlsrv_errors() );
        exit();
    }
    
    echo '<script>alert("Se actualizaron correctamente")</script>';
    echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?id_usuario='.$c1.'">';

}

if(isset($_POST['selectPlaza']) ){
    $plaza = $_POST['plz'];
    echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?plaza='.$plaza.'&id_usuario='.$c1.'">';
}

if(isset($_POST['cargaEx'])){

        $plaza = $_GET['plaza'];
//    $plaza = $_POST['plz'];
//    require 'configConexiones.php';
//    
        $ext = '';
        $archivo = '';
        if(isset($_FILES['ex']) and $_FILES['ex']['error'] <> 4){
            $archivo = $_FILES['ex']['name'];
            $archivotemp = $_FILES['ex']['tmp_name'];
            $ext = pathinfo($archivo,PATHINFO_EXTENSION);
        }

        if(comprobacionNombre( $archivo ) ){
            $exitoUpload = 0;
            
            $fileName = $archivotemp;
            if(file_exists($fileName)){
                
                $tablaGlobal = "PosicionesActualizar";
                
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($fileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadDataOnly(true);

                $spreadsheet = $reader->load($fileName);
                $dataExcel = $spreadsheet->getSheet(0)->toArray(null,false,false,false); 
                $primerFila = $dataExcel[0];
                
                $token = date('dmyhis').rand(1000,9999);
                
                $camposBD = obtenerCamposBD($tablaGlobal, $cnx);
                
                $camposDeExcel = array();
                for($x=0;$x<count($primerFila);$x++){
                    if(trim($primerFila[$x]) == '' ){ // AQUI MODIFICAR CUANDO SE QUIERAN OMITIR CAMPOS DEL EXCEL-------- ******** -------- ******
                        break;
                    }
                    $camposDeExcel[] = $primerFila[$x];
                }
                
                $plantilla = true;
                for($i = 0; $i < count($camposDeExcel); $i++){
                    if($camposBD[$i] != $camposDeExcel[$i]){
                        $plantilla = false;
                        break;
                    }
                }
                
                if($plantilla == false){
                    echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?errorPlantilla&plaza='.$plaza.'&id_usuario='.$c1.'"';
                } else {
                    
                    sqlsrv_query( $cnx,"DELETE FROM PosicionesActualizar" );
                    
                    $insertConsulta = " INSERT INTO PosicionesActualizar(cuenta, latitud, longitud) ";       
                                        
                    for($x=1;$x<count($dataExcel);$x++){
                        
                        if(trim($dataExcel[$x][0]) == ''){
                            break;
                        }
                        
                        $filaExcel[] = trim($dataExcel[$x][0]);
                        $filaExcel[] = $dataExcel[$x][1];
                        $filaExcel[] = $dataExcel[$x][2];

                        if(count($filaExcel) == 300){//Deben ser multiplos de 3
                            if(sqlsrv_query($cnx,$insertConsulta.generarValues(count($filaExcel)),$filaExcel) == false ){
                                print_r(sqlsrv_errors() );
                                sqlsrv_query( $cnx,"DELETE FROM PosicionesActualizar" );
    //                            sqlsrv_rollback( $cnx );
                                exit();
                            }
                            $filaExcel = array();
                        }
                    }
                    
                    if(count($filaExcel) > 0){
                        if(sqlsrv_query($cnx,$insertConsulta.generarValues(count($filaExcel)),$filaExcel) == false){
                            print_r(sqlsrv_errors() );
                            sqlsrv_query( $cnx,"DELETE FROM PosicionesActualizar" );
//                            sqlsrv_rollback( $cnx );
                            exit();
                        }
                        $filaExcel = array();
                    }
                    
                    
                    $cruce = " SELECT count(*) FROM Implementta a inner join [dbo].[PosicionesActualizar] b on a.cuenta=b.cuenta ";
                    $count = sqlsrv_query($cnx, $cruce);
                    
                    $countTotal = sqlsrv_query($cnx, "SELECT count(*) FROM PosicionesActualizar");
                    
                    if($count != false and $countTotal != false){
                        $row = sqlsrv_fetch_array($count);
                        $rowTotal = sqlsrv_fetch_array($countTotal);
                        
                        if($row[0] != $rowTotal[0]){
                            //sqlsrv_query( $cnx,"DELETE FROM PosicionesActualizar" );
                            
                            echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?count='.$row[0].'&errorCruze&plaza='.$plaza.'&id_usuario='.$c1.'"';
                        }
                    }
                    
                echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?ok=1&count='.$row[0].'&plaza='.$plaza.'&id_usuario='.$c1.'">';
                                       
                }
            }
        }else{
            echo '<meta http-equiv="refresh" content="0,url=cargaPosiciones.php?errorFile&plaza='.$plaza.'&id_usuario='.$c1.'">';
        }
        
    }
    
    
?>
<?php 

if(isset($Ad['estado']) and $Ad['estado'] == 1){ ?>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Actualizacion de Posiciones</title>
        <link rel="icon" href="../../icono/icon.png">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
    <!--********************************INICIO NAVBAR***************************************************************-->

    <br>
    <nav class="navbar navbar-expand-lg navbar-light">
  <a href="acceso.php"><img src="../../img/logoFIDI.png" width="150" height="110" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php if (isset($_SESSION['tipousuario'])) { ?>
        <a class="nav-item nav-link" href="config.php">| <i class="fas fa-users-cog"></i> Administrador |</a>
      <?php } ?>
      <a class="nav-item nav-link" href="../../php/acceso.php">| Inicio |</a>
      <?php if ((isset($_SESSION['fichas'])) and ($_SESSION['fichas'] == 3) or (isset($_SESSION['tipousuario']))) { ?>
        <a class="nav-item nav-link" href="../../php/accesDoctos.php">| <i class="far fa-file-alt"></i> Documentos |</a>
      <?php } ?>
      <a class="nav-item nav-link" href="../../php/logout.php">| Salir <i class="fas fa-sign-out-alt"></i>|</a>
    </ul>
  </div>
</nav>
        <?php //require '../../../include/implementtaNav1.php' ?>
    <!--*************************************NAVBAR*************************************************************-->
        
        <style>
            
            .jumboC{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-left: 15px;
                margin-right: 15px;
            }
            
            .contenMain{
                display: flex;
                flex-direction: column;
                width: 100%;
                align-items: center;
                justify-content: center;
            }
            
            .dropFile{
                display: flex;
                width: 35%;
                height: 450px;
                align-items: center;
                justify-content: center;
                border-color: red;
                border: 20px;
                box-shadow: 2px 2px 15px #888888;
                border-radius: 15px;
            }
            .imgFile{
                width: 50px;
                height: 50px;
                margin-right: 2px;
            }
            
            .labelF {
                font-family: arial;
                color: white;
                background-color: #008FC6;
                cursor: pointer;
            }
            .textF{
                font-family: arial;
                font-size: 14px;
                text-align: center;
            }
            
            .zoneConfig{
                width: 35%;
                margin-left: 10px;
                transition: 0.5s;
                text-align: center;
            }

            .lds-dual-ring {
              display: inline-block;
              width: 80px;
              height: 80px;
            }
            .lds-dual-ring:after {
              content: " ";
              display: block;
              width: 64px;
              height: 64px;
              margin: 8px;
              border-radius: 50%;
              border: 6px solid #0A6FF9;
              border-color: #0A6FF9 transparent #0A6FF9 transparent;
              animation: lds-dual-ring 1.2s linear infinite;
            }
            @keyframes lds-dual-ring {
              0% {
                transform: rotate(0deg);
              }
              100% {
                transform: rotate(360deg);
              }
            }
        
        </style>

    </head>
    <body>
        <div class="jumboC">
            <div class="textF">
                <h1> Actualizaciones de Posiciones </h1>
                <?php if(isset($_GET['plaza']) ){ echo "<h3>Conectado a $plazaNombre</h3>"; }
                    if( isset($cnx) and $cnx == false ){ echo "<span class='badge badge-danger'> No Hay conexion al servidor, revise el internet</span>"; }?>
                <?php
                    if(isset($_GET['errorFile'])){
                        echo "<span class='badge badge-warning'> El archivo seleccionado debe estar en formato XLS o XLSX</span>";
                    }else if(isset($_GET['errorPlantilla'])){
                        echo "<span class='badge badge-warning'> No coincide la Plantilla del Excel revisela . . .  </span>&nbsp;&nbsp;<button class=".'"btn btn-info"'." onclick=".'"downloadPlantilla()"'.">Descargar Plantilla</button>";
                    }else if(isset($_GET['errorCruze'])){
                        echo "<span class='badge badge-warning'> Cruzan: ".$_GET['count']." cuentas, se descargara un Registro con las cuentas que no se encontraron, Reviselo.</span>";
                    }else if(isset($_GET['count'])){
                        echo "<span class='badge badge-success'> Cruzan: ".$_GET['count']." cuentas </span>";
                    }
                ?>
            </div>
            <br/>
            <div class='contenMain' >
                <div class="dropFile" >
                    <?php if(isset($_GET['plaza'])){ ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="jumboC">
                            <label for="exFile" class="btn labelF" ><img class="imgFile"  src="../img/excel128px.png" for="exFile" >Seleccionar Archivo</label>
                            <br/>
                            <input id="exFile" type="file" name="ex" hidden>
                            <h4 class="textF" id="fileSelected"></h4>
                            <button id="cargaEx" class="btn btn-primary" name="cargaEx" onclick="cargaRegistros('Cargando registros')" >Cargar el excel con los datos</button>
                            
                            <div id="resp"></div>
                            <div id="load" class="lds-dual-ring" hidden></div>
                            <div id="conteo"></div>
                        </div>
                    </form>
                    <?php }else{ ?>
                    <form method="post">
                        <div class="jumboC">
                            <h4 class="textF" id="fileSelected">Selecciona la plaza en donde actualizar posiciones.</h4>
                            <button class="btn btn-primary" name="selectPlaza" >Seleccionar Plaza</button>
                            <br/>
                            <div>
                                <select name="plz" >
                                    <option value="0">Tijuana Agua</option>
                                    <option value="1">Tijuana Predial</option>
                                    <option value="2">Tecate Agua</option>
                                    <option value="3">Tecate Predial</option>
                                    <option value="4">Coacalco Agua</option>
                                    <option value="5">Ensenada Agua</option>
                                    <option value="6">La Piedad Predial</option>
                                    <option value="7">Mexicali Agua</option>
                                    <option value="8">Toluca Agua</option>
                                    <option value="9">Toluca Predial</option>
                                    <option value="10">Zapopan Predial</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
                <br/>
                <?php if(isset($_GET['ok']) ){ ?>
                <div class="zoneConfig">
                
                    <form method="post">
                      
                        <button class="btn btn-success" name="actualiza" onclick="cargaText('Actualizando Posiciones')" >Actualizar </button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
        
        <script>
            function downloadPlantilla(){
                window.open("Plantilla Posiciones.xlsx");
            }
            
            function cargaText(texto){
                document.getElementById("load").hidden = false;
                
                $('#resp').html(texto+" . . .");
            }
            
            function cargaRegistros(texto){
                document.getElementById("load").hidden = false;
                
                $('#resp').html(texto+" . . .");
                <?php if(isset($_GET['plaza'])){ 
                echo 'obtenerRegistros(); setInterval(obtenerRegistros, 2000);';
                }?>
            }
        
            document.getElementById('exFile').addEventListener('change', function(e) {
                console.log("Cambiando por ExFile");
              if (e.target.files[0]) {
                  const text = document.getElementById("fileSelected");
                  text.append('Archivo seleccionado: ' + e.target.files[0].name);
              }
            });
            
            <?php if(isset($_GET['plaza'])){ ?>
            function obtenerRegistros()
            {   
                $.ajax(
                  'countReg.php?plaza=<?php echo $_GET['plaza']; ?>',
                  {
                      success: function(data) {

                        $('#conteo').html("Registros insertados: " + data);
                      },
                      error: function() {
                        
                      }
                  }
                );
            }
            <?php } ?>
            
        </script>
    </body>
    <?php // require "../../../../include/footer.php" ?>
    <!--*************************INICIO FOOTER***********************************************************************-->   
    <nav class="navbar sticky-bottom navbar-expand-lg navbar-dark" style="background-color: #111111;">
        <span class="navbar-text" style="font-size:12px;font-weigth:bold;color:#e3e3e3;">
        Sistema FIDI<br>
        Estrategas de México <i class="far fa-registered"></i><br>
        Centro de Inteligencia Informática y Geografía Aplicada
        <hr style="width:105%;border-color:#e3e3e3;">
        Creado y diseñado por © <?php echo date('Y') ?> Estrategas de México<br>
        </span><hr style="width:20%;">
        <span class="navbar-text" style="font-size:12px;font-weigth:bold;color:#e3e3e3;">
        </span>
        <ul class="navbar-nav mr-auto">
            <br><br><br><br><br><br><br><br>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <img src="../../img/logoBottonFIDI.png" width="220" height="130" alt="">
            <img src="../../img/logoBotton.png" width="240" height="100" alt="">
        </form>
    </nav>
    <!--***********************************FIN FOOTER****************************************************************-->  
</html>

<?php }else{ 
    header('location:../../../login.php');
} ?>