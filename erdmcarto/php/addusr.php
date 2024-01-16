<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $pl="SELECT * FROM plaza";
    $plz=sqlsrv_query($cnx,$pl);
    $plaza=sqlsrv_fetch_array($plz);
//*********************************** INICIO INSERT USR *******************************************************
if(isset($_POST['save'])){
    $nombre=$_POST['nombre'];
    $app=$_POST['app'];
    $apm=$_POST['apm'];
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $rol=$_POST['rol'];
    $create=date('YmdHi').'insert';
    $estado=2;
    
    $val="select * from usuarionuevo
    where correo='$correo'";
    $vali=sqlsrv_query($cnx,$val);
    $valida=sqlsrv_fetch_array($vali);
if($valida){
    echo '<script>alert("Ya existe un usuario registrado con este correo electrónico. \nVerifique registro")</script>';
    echo '<meta http-equiv="refresh" content="0,url=addusr.php">';
} else{
    $unidad="insert into usuarionuevo values ('$nombre','$app','$apm','$correo',$estado)";
		sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert usuarionuevo');
    
    $vala="select * from usuarionuevo
    where correo='$correo'";
    $valia=sqlsrv_query($cnx,$vala);
    $validaa=sqlsrv_fetch_array($valia);
    
    $idusr=$validaa['id_usuarioNuevo'];
    $clv="insert into usuario values ('$idusr','$clave','$create','$rol')";
		sqlsrv_query($cnx,$clv) or die ('No se ejecuto la consulta isert usuario');
        echo '<script>alert("Usuario agregado correctamente")</script>';
        echo '<meta http-equiv="refresh" content="0,url=config.php">';
    }
}
//************************ FIN INSERT USR ******************************************************************  
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
    <h3 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/fluency/48/null/group.png"/> Nuevo Usuario</h3>
<div class="jumbotron">  
    <div class="form-row">
        <div class="col-md-4">
            <div class="md-form form-group">
                <label for="exampleInputEmail1">Nombre(s): *</label>
                <input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre(s) del usuario" required autofocus>
            </div>
        </div>
        
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Apellido Paterno: *</label>
    <input type="text" class="form-control form-control-sm" name="app" placeholder="Apellido Paterno" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Apellido Materno: *</label>
    <input type="text" class="form-control form-control-sm" name="apm" placeholder="Apellido Materno" required>
          </div>
        </div>
    </div>
<hr>    
    <div class="form-row">
        <div class="col-md-4">
          <div class="md-form form-group">
              <label for="exampleInputEmail1">Correo electronico ERDM: *</label>
              <input type="email" class="form-control form-control-sm" name="correo" placeholder="nombre@erdm.mx" required>
          </div>
        </div>
        <div class="col-md-4">   
          <div class="md-form form-group">
            <label for="exampleInputEmail1">Contraseña: *</label>
            <div class="input-group col-md-15 justify-content-center">
                <div class="input-group-prepend">
                <button type="button" class="btn btn-primary btn-sm" onclick="return Confirmar('1')"><i class="fas fa-key"></i></button>
                </div>
                <input id="tabla_resultado" type="text" class="form-control form-control-sm" name="clave" placeholder="Contraseña (minimo 6 digitos sin simbolos)" minlength="6" maxlength="50" required>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
            <div class="md-form form-group">
                <label for="exampleInputEmail1">Rol de Usuario: *</label>
                <select name="rol" class="form-control form-control-sm" required>
                    <option value="">Selecciona una opción</option>
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
                <button type="submit" class="btn btn-primary btn-sm" name="save"><i class="fas fa-user-plus"></i> Agregar nuevo usuario</button>
                <a href="config.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Cancelar</a>
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