<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $idplz=$_GET['plz'];
    $pl="SELECT * FROM plaza
    where id_plaza='$idplz'";
    $plz=sqlsrv_query($cnx,$pl);
    $plaza=sqlsrv_fetch_array($plz);
//************************************************************************
    $idplz=$_GET['plz'];
    $pe="select * from image
    where id_plaza='$idplz'";
    $per=sqlsrv_query($cnx,$pe);
    $perfil=sqlsrv_fetch_array($per);
//************************************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Agregar Imagen a plaza</title>
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
    <h1 style="text-shadow: 1px 1px 2px #717171;">Plataforma Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/color/48/000000/add-image.png"/> Agregar imagen a plaza <?php echo utf8_encode($plaza['nombreplaza']) ?></h4>
    
    
<form action="upload.php" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col-sm-6">
    <div style="text-align:center;">
        <br>
        
<?php if(isset($perfil)){ ?>
    <a href="../img/IMGplz/<?php echo $perfil['IMGname'] ?>" target="_blank"><img src="../img/IMGplz/<?php echo $perfil['IMGname'] ?>" width="60%" style="box-shadow: 2px 2px 5px #717171;"></a>
<?php } else{ ?>
    <img src="../img/default.jpg" class="img-fluid" alt="Responsive image" width="60%" style="box-shadow: 2px 2px 5px #717171;">    
<?php } ?>
   
       <br><br>
    <div class="alert alert-info" role="alert" style="padding-top:0%;padding-bottom:0%;font-weight:normal;">
      <i class="fas fa-info-circle"></i> Antes de cargar una nueva imagen, asegúrese de verificar el tamaño correcto de la plantilla. <br>Medidas requeridas: 444px por 242px Resolución maxima de 120pp
        <a href="../img/IMGplz/Plantilla_IMG_Fidi_plzs.pptx" download="Plantilla_IMG_Fidi_plazas.pptx"><i class="fas fa-download"></i> Descargar plantilla para crear imagen</a>
    </div>
    
    </div>
  </div>
  <div class="col-sm-6">
      <br><hr>
      <div class="form-group">
        <label for="exampleFormControlFile1">Cargar imagen de plaza</label>
        <input type="file" class="form-control-file" name="doc" required>
      </div>
      <input type="hidden" class="form-control" name="fecha" value="<?php echo date('Y-m-d_H:i:s') ?>" required readonly>
      <input type="hidden" class="form-control" name="idplaza" value="<?php echo $plaza['id_plaza'] ?>" required readonly>
      
      
       <?php if(isset($perfil)){ ?>
       <input type="hidden" class="form-control" name="confoto" value="1" required readonly>
        <?php } else{ ?>
        <input type="hidden" class="form-control" name="confoto" value="0" required readonly>
        <?php } ?>
        
        
        
      <hr>
        <div class="alert alert-info small" role="alert" style="padding-top:0%;padding-bottom:0%;">
          <i class="fas fa-info-circle"></i> Es probable que para ver los cambios deba cerrar sesión e iniciar nuevamente.
        </div>
  </div>
</div>
<br><br>
    <div style="text-align:center;">
        <button type="submit" class="btn btn-primary btn-sm" name="submit" onclick="return Confirmara('¿Está seguro que desea actualizar su imagen de perfil?')"><i class="fas fa-pen"></i> Guardar imagen de plaza</button>
        <a href="addplz.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar a ver Plazas</a>
    </div>
</form>
<br>








</div>
<br><br>
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