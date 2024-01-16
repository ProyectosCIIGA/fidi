<?php
session_start();
if((isset($_SESSION['user'])) and ($_SESSION['tipousuario'] == '1')){
    
    
    
    
    
//if((isset($_SESSION['user'])) and ($_SESSION['tipousuario'] == '1') and ($_SESSION['user'] <> 20)){
require "../../acnxerdm/cnx.php";
    $id_usuarioNuevo=$_SESSION['user'];
    $us="SELECT * FROM usuarionuevo
    where id_usuarioNuevo='$id_usuarioNuevo'";
    $use=sqlsrv_query($cnx,$us);
    $user=sqlsrv_fetch_array($use);
    
//*********************************** INICIO INSERT PLZ *******************************************************
if(isset($_POST['add'])){
    $idplz=$_POST['plz'];
    $idusuario=$_POST['idusuario'];
    
    $val="select id_plaza from acceso where id_plaza='$idplz' AND id_usuarioNUevo='$idusuario'";
    $vali=sqlsrv_query($cnx,$val);
    $valida=sqlsrv_fetch_array($vali);
if($valida){
    echo '<script>alert("El usuario ya tiene registrada esta plaza. \nVerifique registro")</script>';
    echo '<meta http-equiv="refresh" content="0,url=config.php">';
} else{
    $unidad="insert into acceso values ('$idusuario','$idplz')";
		sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert nuevo colaborador');
        echo '<script>alert("Acceso agregado correctamente")</script>';
        echo '<meta http-equiv="refresh" content="0,url=config.php">';
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
<title>Administrador | FIDI</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/busquedaAjax.js"></script>
<style>
  body {
        background-image: url(../img/back.jpg);
        background-repeat: repeat;
        background-size: 100%;
        background-attachment: fixed;
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
    <h4 style="text-shadow: 1px 1px 2px #717171;"><i class="fas fa-users-cog"></i> Administrador: <?php echo utf8_encode(ucwords(strtolower($user['nombre'].' '.$user['app'].' '.$user['apm']))) ?></h4>
<hr>
    
    <div class="form-row">
        <div class="col-md-6">
            <div style="text-align:left;">
                <a href="addusr.php" class="btn btn-secondary btn-sm"><i class="fas fa-user-plus"></i> Nuevo Usuario</a>
                <a href="addplz.php" class="btn btn-secondary btn-sm"><i class="far fa-building"></i> Plazas Stratimex</a>
                <a href="addDocto.php" class="btn btn-secondary btn-sm"><i class="fas fa-folder-open"></i> Documentos</a>
            </div>
        </div>
        <div class="col-md-6">
         <div class="justify-content-center justify-content-md-center">
            <div >
              <div class="input-group col-md-15 justify-content-center">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control border border-secondary" placeholder="Buscar nombre o usuario" name="alumnos" id="busqueda" required autofocus>
              </div>
            </div>
          </div>
        </div>
    </div>
<br>
    
    
<!--
    <section id="tabla_resultado" style="text-align:center;">
     **********tabla resultado******** 
            <h3>algo desde config</h3>

    </section>  
-->
<div id="tabla_resultado"> 
<!--**********tabla resultado******** -->
</div>

    
     

    <br><br><br>
</div>
<?php } else{
    header('location:logout.php');
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
<script>
    function Confirmar(Mensaje){
        return (confirm(Mensaje))?true:false;
    }
</script>      
</html>