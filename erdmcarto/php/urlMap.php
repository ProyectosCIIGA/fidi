<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $idplz=$_GET['plz'];
    $pl="SELECT * FROM plaza
    where id_plaza='$idplz'";
    $plz=sqlsrv_query($cnx,$pl);
    $plaza=sqlsrv_fetch_array($plz);
    
    $mp="SELECT * FROM mapa
    where id_plaza='$idplz'";
    $map=sqlsrv_query($cnx,$mp);
    $mapa=sqlsrv_fetch_array($map);
//*********************************** INICIO INSERT PLZ *******************************************************
if(isset($_POST['save'])){
    $nombre=$_POST['nombre'];
    $url=$_POST['url'];
    $val="select * from mapa
    where id_plaza='$idplz' AND url='$url'";
    $vali=sqlsrv_query($cnx,$val);
    $valida=sqlsrv_fetch_array($vali);
if($valida){
    echo '<script>alert("Esta direccion URL ya esta agregada en esta plaza \nVerifique registro")</script>';
    echo '<meta http-equiv="refresh" content="0,url=urlMap.php?plz='.$idplz.'">';
} else{
    $unidad="insert into mapa values ('$idplz','$nombre','$url')";
		sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert nuevo colaborador');
        echo '<script>alert("Plaza agregada correctamente")</script>';
        echo '<meta http-equiv="refresh" content="0,url=urlMap.php?plz='.$idplz.'">';
    }
}
//************************ FIN INSERT PLZ ****************************************************************** 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Agregar Mapa | FIDI</title>
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
    <h4 style="text-shadow: 1px 1px 2px #717171;"><i class="fas fa-map-marked-alt"></i> Agregar mapas a plaza <?php echo $plaza['nombreplaza'] ?></h4>
<form action="" method="post">
    <div class="jumbotron">
    <div class="form-group" style="text-align:center;">
    <label for="exampleInputEmail1">Nombre de mapa: *</label>
    <input style="text-align:center;" type="text" class="form-control" name="nombre" placeholder="Nombre del mapa" required>
  </div>        
    <div class="form-group" style="text-align:center;">
    <label for="exampleInputEmail1">URL de mapa: *</label>
    <input style="text-align:center;" type="text" class="form-control" name="url" placeholder="URL de mapa (sin espacios al inicio ni final)" required>
  </div>
    <small id="e" class="form-text text-muted" style="font-size:14px;">*Todos los campos son requeridos.</small>
<div style="text-align:right;">
        <button type="submit" class="btn btn-primary " name="save"><i class="fas fa-plus"></i> Agregar nueva URL de mapa</button>
</div>
        </div>
<br><hr><br>
    <h3 style="text-shadow: 1px 1px 2px #717171;"><i class="fas fa-atlas"></i> Direcciones de mapas plaza <?php echo utf8_encode($plaza['nombreplaza']) ?></h3>
    <hr>
</form>
</div>
<div class="container" style="padding-left:10%;padding-right:10%;">
<?php if(isset($mapa)){ ?>
<table class="table table-sm table-hover">
  <thead>
    <tr align="center">
      <th scope="col">Nombre de mapa</th>
      <th scope="col">Direccion URL</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php do{ ?>  
    <tr align="center">
      <td><?php echo utf8_encode($mapa['nombreMapa']) ?></td>
      <td><a href="<?php echo $mapa['url'] ?>" class="btn btn-link" target="_blank"><?php echo $mapa['url'] ?></a></td>
      <td><a href="delete.php?poneurl=1&plz=<?php echo $plaza['id_plaza'].'&url='.$mapa['id_mapa'] ?>" class="btn btn-danger btn-sm" onclick="return Confirmar('¿Esta seguro que decea eliminar esta URL?')"><i class="far fa-trash-alt"></i></a></td>
    </tr>
        </tbody>
<?php } while($mapa=sqlsrv_fetch_array($map)); ?>    
    </table>
<?php } else{ ?>
    <div class="alert alert-info" role="alert">
      <i class="fas fa-info-circle"></i> Aun no se han agregado mapas para esta plaza.
    </div>
<?php } ?>           
    <br>
    <center><a href="addplz.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar a ver Plazas</a></center>
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