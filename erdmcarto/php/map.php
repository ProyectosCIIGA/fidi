<!DOCTYPE html>
<?php
session_start();
//if(isset($_SESSION['user'])){
require "include/lib.php";
//require "../../acnxerdm/cnx.php";
require "conect.php";
$plz = $_GET['plz'];

$maNL = "SELECT * FROM plaza
    inner join mapa on mapa.id_plaza=plaza.id_plaza
    where plaza.id_plaza='$plz'";
$mapNL = sqlsrv_query($cnxa, $maNL);
$mapaNL = sqlsrv_fetch_array($mapNL);

if (isset($_GET['mp'])) {
  $mp = $_GET['mp'];
  $ma = "SELECT * FROM plaza    
    inner join mapa on mapa.id_plaza=plaza.id_plaza
    where plaza.id_plaza='$plz' AND mapa.id_mapa='$mp'";
  $map = sqlsrv_query($cnxa, $ma);
  $mapa = sqlsrv_fetch_array($map);
}

if (isset($_POST['saveclave'])) {
  $plz = $_GET['plz'];
  $direct = $_GET['mp'];
  $busca = $_POST['busqueda'];


  if (($plz == 25) or ($plz == 2030) or ($plz == 2040) or ($plz == 2037)) {
    $cuentaRep = $busca; //solo aplica en MexicaliA y LaPiedadP por cuentas con guion
  } else {
    $cuentaRep = str_replace("-", "", $busca); //remplazar guiones por nada ""
  }

  echo '<meta http-equiv="refresh" content="0,url=map.php?plz=' . $plz . '&mp=' . $direct . '&src=' . $busca . '&srcRep=' . $cuentaRep . '&clv=1">';
}
if (isset($_GET['clv'])) {
  $buscar = $_GET['srcRep'];
  $ur = "SELECT top 1 * FROM implementta
    where Propietario LIKE '%$buscar%'
    or Cuenta LIKE '$buscar'";
  $url = sqlsrv_query($cnx, $ur);
  $direccion = sqlsrv_fetch_array($url);
  if ($_GET['plz'] == 2037) {
    $sql_determinacion = "select cuenta from determinacionesp where cuenta='$buscar'";
    $determinacion_cnx = sqlsrv_query($cnx, $sql_determinacion);
    $determinacion = sqlsrv_fetch_array($determinacion_cnx);

    $sql_fotos = "select cuenta from fotosVisorS3 where cuenta='$buscar'";
    $fotos_cnx = sqlsrv_query($cnx, $sql_fotos);
    $fotos = sqlsrv_fetch_array($fotos_cnx);
  }
}
?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Cartografia | ERDM</title>
  <link rel="icon" href="../icono/icon.png">
  <link href="../css/styles.css" rel="stylesheet" />
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../js/peticionAjax.js"></script>
  <style>
    body {
      background-image: url(../img/back.jpg);
      background-repeat: no-repeat;
      background-size: 100%;
      background-attachment: fixed;
      /*        overflow-x:hidden;*/
      /*        overflow-y:hidden;*/
    }

    body {
      font-family: sans-serif;
      font-style: normal;
      font-weight: bold;
      font-size: 95%;
    }

    #map {
      height: 500px;
      width: 100%;
    }

    .jumbotron {
      background: rgba(83, 83, 83, 0.2);
    }

    .btn-whatsapp {
      display: block;
      width: 70px;
      height: 70px;
      color: #fff;
      position: fixed;
      left: 20px;
      bottom: 20px;
      border-radius: 50%;
      line-height: 80px;
      text-align: center;
      z-index: 999;
    }

    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    #map,
    #pano {
      float: left;
      height: 100%;
      width: 50%;
    }
  </style>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading border-bottom bg-light"><a href="acceso.php"><img src="../img/logoFIDI.png" height="50" alt=""></a></div><br>
      <div class="list-group list-group-flush">
        <h5 style="text-shadow: 1px 1px 2px #717171;text-align:center;"><?php echo 'Plaza: ' . utf8_encode($mapaNL['nombreplaza']) ?></h5>
        <?php do { ?>
          <a class="list-group-item list-group-item-action list-group-item-light p-3" href="map.php?plz=<?php echo $_GET['plz'] . '&mp=' . $mapaNL['id_mapa'] ?>"><i class="fas fa-map-marked-alt"></i> <?php echo utf8_encode($mapaNL['nombreMapa']) ?></a>

        <?php } while ($mapaNL = sqlsrv_fetch_array($mapNL)); ?>
        <?php if (isset($_GET['mp'])) { ?>
          <br>
          <div class="form-row align-items-center container">
            <!--
    <form action="" method="post">
    <div class="col-auto">
        <h6 style="text-shadow: 0px 0px 2px #717171;">Buscar</h6>
      <div class="input-group mb-2">
        <input type="text" class="form-control" name="cuenta" placeholder="Buscar algo" required>
        <div class="input-group-prepend">
        <button type="submit" class="btn btn-outline-primary" name="saveclave"><i class="fas fa-search"></i></button>
        </div>
      </div>
    <h6 style="text-shadow: 0px 0px 1px #717171;" class="small">Busqueda por numero de cuenta o nombre de propietario en mapa <? php // echo $mapa['nombreMapa'] 
                                                                                                                              ?>.</h6>    
    </div>
    </form>
-->
            <!--******************************************************************************************-->
            <form action="" method="post">
              <div class="row justify-content-center justify-content-md-center">
                <h6 style="text-shadow: 0px 0px 2px #717171;">Buscar</h6>
                <div class="input-group col-md-15 justify-content-center">
                  <input type="text" class="form-control" placeholder="Buscar algo" name="busqueda" id="busqueda" required autofocus>
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-primary" name="saveclave"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
              <input type="hidden" value="<?php echo $_GET['plz'] ?>" name="num2" id="num2">
              <input type="hidden" value="<?php echo $_GET['mp'] ?>" name="mp" id="mp">
              <div id="tabla_resultado" style="text-align:left;">
                <!-- **********tabla resultado******** -->
              </div>
              <h6 style="text-shadow: 0px 0px 1px #717171;" class="small">Busqueda por numero de cuenta o nombre de propietario en mapa <?php echo utf8_encode($mapa['nombreMapa']) ?>.</h6>
              <!--******************************************************************************************-->
            </form>
          </div>
          <?php if (isset($_GET['clv'])) {
            if (isset($direccion)) {
          ?>
              <div style="text-align:center;">
                <hr>
                <h6 style="text-shadow: 0px 0px 2px #717171;">Ciudadano: <?php echo utf8_encode(ucwords(strtolower($direccion['Propietario']))) ?></h6>
                <a href="profile.php?ncnt=<?php echo $direccion['Cuenta'] . '&plz=' . $_GET['plz'] . '&mp=' . $_GET['mp'] ?>" class="btn btn-dark btn-sm" target="_blank"><i class="fas fa-user-alt"></i> Perfil del ciudadano</a>
                <hr>
              </div>
            <?php } else { ?>
              <div class="alert alert-danger" role="alert">
                No hay resultados en Implementta para esta búsqueda.
              </div>
            <?php       } ?>

            <?php
            if ($_GET['plz'] == 2037) {
              if (isset($determinacion)) {
            ?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" target="_blank" href="https://gallant-driscoll.198-71-62-113.plesk.page/implementta/modulos/toluca-p/public/PDFDeterminacion/<?php echo $determinacion['cuenta'] ?>">
                  <i class="fa-solid fa-file-pdf fa-beat"></i> Determinación</a>
              <?php } else { ?>

                <a class="list-group-item list-group-item-action list-group-item-light p-3" target="_blank" href="https://gallant-driscoll.198-71-62-113.plesk.page/implementta/login.php">
                  <i class="fa-solid fa-file-pdf fa-beat"></i> Generar Determinación</a>

              <?php       }
              if (isset($fotos)) {
              ?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" target="_blank" href="../../VisorImagenes/index.php?cta=<?php echo $fotos['cuenta'] ?>">
                  <i class="fa-solid fa-images fa-beat"></i> Visor de imágenes</a>
              <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                  No hay imágenes
                </div>
            <?php
              } 
              if($buscar=='101-20-535-13-00-0000'){?>
                <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" target="_blank" href="https://gallant-driscoll.198-71-62-113.plesk.page/implementta/modulos/recorrido/files/">
                <i class="fa-solid fa-vr-cardboard fa-beat"></i> Recorrido virtual</a> -->
                    <?php
                }
                if($buscar=='101-20-537-01-00-0000'){?>
                <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" target="_blank" href="https://gallant-driscoll.198-71-62-113.plesk.page/implementta/modulos/recorrido190723/files/">
                <i class="fa-solid fa-vr-cardboard fa-beat"></i> Recorrido virtual</a> -->
                    <?php
                }
                  
            }
            ?>
        <?php

          }
        } ?>
      </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
      <!-- Top navigation-->
      <!--
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-link" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <? php // if(isset($_GET['mp'])){ 
                        ?>
                            <h6 style="text-shadow: 0px 0px 2px #717171;"><? php // echo 'Mapa: '.$mapa['nombreMapa'] 
                                                                          ?></h6>
                        <? php // } 
                        ?>    
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <a class="nav-item nav-link" href="acceso.php">| Inicio |</a>
                                <a class="nav-item nav-link" href="logout.php">| Salir <i class="fas fa-sign-out-alt"></i>|</a>
                            </ul>
                        </div>
                    </div>
                </nav>
-->
      <div class="btn-whatsapp">
        <button class="btn btn-link" id="sidebarToggle"><i class="fas fa-bars"></i></button>
      </div>
      <!-- Page content-->
      <?php if (isset($_GET['mp'])) { ?>
        <div class="embed-responsive embed-responsive-16by9">
          <?php if (isset($_GET['clv'])) { ?>
            <iframe src="<?php echo $mapa['url'] . '&find=' . $_GET['src'] ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          <?php } else { ?>
            <iframe src="<?php echo $mapa['url'] ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          <?php } ?>
        </div>
      <?php } else { ?>
        <div class="alert alert-dark" role="alert"><i class="fas fa-chevron-left"></i> Seleccione una opción de mapa</div>
      <?php } ?>
      <?php if ((isset($_GET['clv'])) and (isset($direccion))) { ?>
        <hr>
        <!--    <div class="embed-responsive embed-responsive-16by9" style="box-shadow: 0px 0px 10px #717171;" id="map"></div>-->
        <div id="map"></div>
        <div id="pano"></div>
        <br><br>
      <?php } ?>
    </div>
  </div>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcF4oi3SweowzVYo29ifjqXJsl1eE7C8M&callback=initialize&libraries=&v=weekly" async></script>
  <script>
    function initialize() {
      const fenway = {
        lat: <?php echo $direccion['Latitud']; ?>,
        lng: <?php echo $direccion['Longitud']; ?>
      };
      const map = new google.maps.Map(
        document.getElementById("map") as HTMLElement, {
          center: fenway,
          zoom: 14,
        }
      );
      const panorama = new google.maps.StreetViewPanorama(
        document.getElementById("pano") as HTMLElement, {
          position: fenway,
          pov: {
            heading: 34,
            pitch: 10,
          },
        }
      );
      map.setStreetView(panorama);

    }
  </script>
  <script>
    function initialize() {
      var coord = {
        lat: <?php echo $direccion['Latitud']; ?>,
        lng: <?php echo $direccion['Longitud']; ?>
      };
      const fenway = {
        lat: <?php echo $direccion['Latitud']; ?>,
        lng: <?php echo $direccion['Longitud']; ?>
      };
      const map = new google.maps.Map(document.getElementById("map"), {
        center: fenway,
        zoom: 18
      });
      var marker = new google.maps.Marker({
        position: coord,
        map: map
      });
      const panorama = new google.maps.StreetViewPanorama(
        document.getElementById("pano"), {
          position: fenway,
          pov: {
            heading: 34,
            pitch: 10,
          },
        }
      );
      ////************ MARCADOR AL DAR CLICK*********************
      var infowindow = new google.maps.InfoWindow({
        content: "<?php echo utf8_encode($direccion['Propietario']) . ' Long. ' . $direccion['Longitud'] . ' Lat. ' . $direccion['Latitud']; ?>"
      });
      infowindow.open(map, marker);
      map.setStreetView(panorama, marker);
    }



    //******************************************************************************************************************* 
    //    var coord = {lat:<? php // echo $direccion['Latitud']; 
                            ?> ,lng:<? php // echo $direccion['Longitud']; 
                                    ?>};
    //    var map = new google.maps.Map(document.getElementById('map'),{
    //      zoom: 19,
    //      center: coord,
    //      mapTypeId: google.maps.MapTypeId.SATELLITE //MOSTRAR IMAGEN DE SATELITE PREDETERMINADA
    //    });
    //    var marker = new google.maps.Marker({
    //      position: coord,
    //      map: map
    //    });
    ////************ MARCADOR AL DAR CLICK*********************
    //var infowindow = new google.maps.InfoWindow({
    //  content:"<? php // echo $direccion['propietario'].' Long. '.$direccion['Longitud'].' Lat. '.$direccion['Latitud']; 
                  ?>"
    //});
    //  infowindow.open(map,marker);
    //    
    //google.maps.event.addListener(marker,'click',function() {
    //  map.setZoom(25);
    //  map.setCenter(marker.getPosition());
    //});    
    ////*********** FIN MARCADOR AL DAR CLIC*******************
  </script>
</body>
<?php
//    } else{
//    header('location:../../login.php');
//}
//require "include/footer.php"; 
?>

</html>