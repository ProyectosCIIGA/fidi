<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $iduser=$_GET['usr'];
    
    $usa="select * from usuarionuevo
    inner join usuario on usuario.id_usuarioNuevo=usuarionuevo.id_usuarioNuevo
    where usuarionuevo.id_usuarioNuevo='$iduser'";
    $usea=sqlsrv_query($cnx,$usa);
    $usera=sqlsrv_fetch_array($usea);
    
//****************************ACTUALIZAR DATOS DE USUARIO******************************************************
if(isset($_POST['update'])){
    $id_usuarioNuevo=$_POST['id_usuarioNuevo'];
    $nombre=$_POST['nombre'];
    $app=$_POST['app'];
    $apm=$_POST['apm'];
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $rol=$_POST['rol'];
    
    $datos="update usuarionuevo set nombre='$nombre',app='$app',apm='$apm',correo='$correo' where id_usuarioNuevo='$id_usuarioNuevo'";
    sqlsrv_query($cnx,$datos) or die (print_r(sqlsrv_errors()));

    $clave="update usuario set clave='$clave',rol='$rol' where id_usuarioNuevo='$id_usuarioNuevo'";
    sqlsrv_query($cnx,$clave) or die ('No se ejecuto la consulta update usuario');

    echo '<meta http-equiv="refresh" content="0,url=updateUsr.php?usr='.$id_usuarioNuevo.'">';
}
//****************************FIN ACTUALIAR DATOS DE USUARIO***************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nuevo Ususario | FIDI</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/generatePass.js"></script>
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
    font-weight:normal;
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
<form action="" method="post">    

    
    
<div class="container">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Sistema Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="../img/user.gif" height="40" /> Actualizar datos de usuario</h4>
    <h5 style="text-shadow: 1px 1px 2px #717171;">Usuario: <?php echo utf8_encode($usera['correo']) ?></h5>
<div class="jumbotron">  
    <div class="form-row">
        <div class="col-md-4">
            <div class="md-form form-group">
                <label for="exampleInputEmail1">Nombre(s): *</label>
                <input type="text" class="form-control form-control-sm" name="nombre" value="<?php echo utf8_encode($usera['nombre']) ?>" required autofocus>
            </div>
        </div>
        
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Apellido Paterno: *</label>
    <input type="text" class="form-control form-control-sm" name="app" value="<?php echo utf8_encode($usera['app']) ?>" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Apellido Materno: *</label>
    <input type="text" class="form-control form-control-sm" name="apm" value="<?php echo utf8_encode($usera['apm']) ?>" required>
          </div>
        </div>
    </div>
<hr>    
    <div class="form-row">
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Correo electronico ERDM: *</label>
              <input type="email" class="form-control form-control-sm" name="correo" value="<?php echo utf8_encode($usera['correo']) ?>" required>
          </div>
        </div>
        <div class="col-md-4">   
          <div class="md-form form-group">
            <label for="exampleInputEmail1">Contraseña: *</label>
            <div class="input-group col-md-15 justify-content-center">
                <div class="input-group-prepend">
                <button type="button" class="btn btn-primary btn-sm" onclick="return Confirmar('1')"><i class="fas fa-key"></i></button>
                </div>
                <input id="tabla_resultado" type="text" class="form-control form-control-sm" name="clave" value="<?php echo $usera['clave'] ?>" minlength="6" maxlength="50" required>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
            <div class="md-form form-group">
                <label for="exampleInputEmail1">Rol de Usuario: *</label>
                <select name="rol" class="form-control form-control-sm" required>
                    <option value="<?php echo $usera['rol'] ?>"><?php echo $usera['rol'] ?></option>
                    <option value="visor">Visor Fidi</option>
                    <option value="documentos">Documentos Fidi</option>
                </select>
            </div>
        </div>
        
    </div>
    
    <small class="form-text text-muted"><i class="fas fa-info-circle"></i> Rol de usuario Visor: Solo acceso a visores con validación de plaza<br>
        Rol de usuario Documentos: Acceso a creación de fichas y descarga de documentos.</small>
    
    
    <hr>
            <div style="text-align:center;">
                <input type="hidden" class="form-control" name="id_usuarioNuevo" value="<?php echo $usera['id_usuarioNuevo'] ?>" required>
                <button type="submit" class="btn btn-primary btn-sm" name="update"><i class="fas fa-user-edit"></i> Actualizar usuario</button>
                <a href="config.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar</a>
            </div>    
        </div>
    </div>    
    
    
    
    
    
    
    
    
</form> 
<br><br><br>
<?php } else{
    header('location:../../login.php');
}
require "../include/footer.php";
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
</html>