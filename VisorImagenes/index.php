<?php
// $cuenta = $_GET['cta'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Fidi</title>
  <link rel="icon" href="img/icons/logoFIDI.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />
  <link href="css/index.css" rel="stylesheet" />
  <link href="css/zoomImage.css" rel="stylesheet" />
  <style>
   
  </style>
</head>

<body>
  <div class="page-wrapper chiller-theme toggled d-flex" id="wrapper">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <!-- <a href="">Stratimex</a> -->
          <img class="logo" width="150px" height="100px" src="img/icons/logoFIDI.png" />
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <!-- Siderbar Menu  -->
        <div id="contenedor-botones">
        </div>
        <!-- sidebar-menu  -->
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <!-- Version anterior guardar por si las dudas -->
    <!-- <div class="page-content">
      <div class="container-fluid" id="container">
        <img id="image" src="" alt="Imagen" 
        draggable="false"/>
        <div id="floating-div">
          <button onclick="zoomIn()" id="zoom-in"> <span class="	fas fa-plus"></span> </button>
          <button onclick="zoomOut()" id="zoom-out"> <span class="	fas fa-minus"></span></button>
        </div>
      </div>
    </div> -->
    <div class="page-content">
      <div class="container-fluid" id="container">
        <img id="image" src="" alt="Imagen" class='zoom'/>
      </div>
    </div>
    <!-- page-content" -->
  </div>
  <!-- page-wrapper -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/index.js"></script>
  <!-- <script src="js/zoomImage.js"></script> -->
  <script src="js/wheelzoom.js"></script>
	<script>
		wheelzoom(document.querySelector('img.zoom'));
	</script>
  <script src="js/searchCuenta.js"></script>
</body>

</html>