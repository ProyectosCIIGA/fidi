<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $pl="SELECT * FROM documento";
    $plz=sqlsrv_query($cnx,$pl);
    $plaza=sqlsrv_fetch_array($plz);
    
    $pro="SELECT * FROM proveniente";
    $prov=sqlsrv_query($cnx,$pro);
    $prove=sqlsrv_fetch_array($prov);
//*********************************** INICIO INSERT PLZ *******************************************************
if(isset($_POST['save'])){
    $nombre=trim($_POST['nombre']);
    $url=trim($_POST['url']);
    $lastUpdate=date('Y-m-d').'T'.date('H:i:s');
    $val="select * from documento
    where nombreDocumento='$nombre'";
    $vali=sqlsrv_query($cnx,$val);
    $valida=sqlsrv_fetch_array($vali);
if($valida){
    echo '<script>alert("El nombre de documento ya esta agregado. \nVerifique registro")</script>';
    echo '<meta http-equiv="refresh" content="0,url=addDocto.php">';
} else{
    $documento="insert into documento (nombreDocumento,url,lastUpdate) values ('$nombre','$url','$lastUpdate')";
		sqlsrv_query($cnx,$documento) or die ('No se ejecuto la consulta isert nuevo docto');
        echo '<meta http-equiv="refresh" content="0,url=addDocto.php">';
    }
}
//************************ FIN INSERT PLZ ******************************************************************
//****************************ACTUALIZAR DATOS DE USUARIO******************************************************
if(isset($_POST['update'])){
    $iddocto=$_POST['iddocto'];
    $name=$_POST['nombre'];
    $url=$_POST['url'];
    $lastUpdate=date('Y-m-d').'T'.date('H:i:s').'_updt';
    
    $datos="update documento set nombreDocumento='$name',url='$url',lastUpdate='$lastUpdate'
    where id_documento='$iddocto'";
    sqlsrv_query($cnx,$datos) or die ('No se ejecuto la consulta update datosdocto');
    echo '<meta http-equiv="refresh" content="0,url=addDocto.php">';
}
//****************************FIN ACTUALIAR DATOS DE USUARIO***************************************************    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nuevo Documento | FIDI</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<script src="../js/peticionAjax.js"></script>-->
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
        padding-top:2%;
        padding-bottom:1%;
}
    .padding {
        padding-right:20%;
        padding-left:20%;
    }
    </style>
<?php require "include/nav.php"; ?>
</head>
<body>
<div class="container">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Sistema Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/color/48/null/google-docs--v1.png"/> Agregar nuevo modulo de documentos</h4>
<form action="" method="post">
<div class="jumbotron">
    <div class="form-group" style="text-align:center;">
        <label for="exampleInputEmail1">Nombre del documento: *</label>
        <input style="text-align:center;" type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre del modulo de documentos (Max 25 caracteres)" minlength="3" maxlength="25" required autofocus>
    </div>
    
    <div class="form-group" style="text-align:center;">
        <label for="exampleInputEmail1">URL del modulo: *</label>
        <input style="text-align:center;" type="text" class="form-control form-control-sm" name="url" placeholder="Direccion URl del modulo" minlength="1" maxlength="1490" required>
    </div>
    
    <small id="e" class="form-text text-muted" style="font-size:14px;">*Todos los campos son requeridos.</small>
<div style="text-align:right;">
        <button type="submit" class="btn btn-primary btn-sm" name="save"><i class="fas fa-plus"></i> Agregar nuevo modulo</button>
</div>
        </div>
</form>

    
    
    
<hr>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/external-anggara-flat-anggara-putra/32/null/external-edit-user-interface-anggara-flat-anggara-putra-5.png"/> Editar modulos de documentos</h4>
    <hr>
</div>
    
<div class="container">
<?php if(isset($plaza)){ ?>

<table class="table table-sm table-hover">
  <thead>
    <tr align="left">
      <th scope="col">Modulo de Documentos</th>
      <th scope="col">URL de datos</th>
      <th scope="col" style="text-align:center;">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php do{ ?>  
    <tr align="left">
      <td><?php echo utf8_encode($plaza['nombreDocumento']) ?></td>
      <td><a href="<?php echo utf8_encode($plaza['url']) ?>" target="_blank"><?php echo utf8_encode(substr($plaza['url'],0,70)).'...' ?></a></td>
      <td style="text-align:center;">
          
        <a href="" class="btn btn-outline-dark btn-sm" style="padding:0%;border:0px;" data-toggle="modal" data-target="#datos<?php echo $plaza['id_documento'] ?>"><span aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Editar modulo"><img src="https://img.icons8.com/external-anggara-flat-anggara-putra/30/null/external-edit-user-interface-anggara-flat-anggara-putra-5.png"/></span></a>

        <a href="delete.php?poneModulo=1&md=<?php echo $plaza['id_documento'].'&plz=6465465&modulo=65465999&ch=06385533' ?>" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="right" style="padding:0%;border:0px;" title="Eliminar modulo" onclick="return Confirmar('¿Esta seguro que decea eliminar el modulo <?php echo $plaza['nombreDocumento'] ?>?')"><img src="https://img.icons8.com/fluency/30/null/delete-forever.png"/></a>
          
        </td>
    </tr>
  </tbody>
<!-- *********************************MODAL PARA ACTUALIZAR UDATOS *************************************************** -->
<form action="" method="post">
<div class="modal fade" id="datos<?php echo $plaza['id_documento'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-shadow: 0px 0px 2px #717171;"><img src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/50/null/external-Edit-user-interface-febrian-hidayat-flat-febrian-hidayat.png"/> Editar modulo de documentos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group" style="text-align:center;">
            <label for="exampleInputEmail1">Nombre del documento: *</label>
            <input style="text-align:center;" type="text" class="form-control form-control-sm" name="nombre" value="<?php echo $plaza['nombreDocumento'] ?>" minlength="3" maxlength="25" required autofocus>
        </div>

        <div class="form-group" style="text-align:center;">
            <label for="exampleInputEmail1">URL del modulo: *</label>
            <input style="text-align:center;" type="text" class="form-control form-control-sm" name="url" value="<?php echo $plaza['url'] ?>" minlength="1" maxlength="1490" required>
        </div>
          
      </div>
      <div class="modal-footer">
          <input type="hidden" class="form-control" name="iddocto" value="<?php echo $plaza['id_documento'] ?>" placeholder="Agregar marca">
          <button type="submit" class="btn btn-primary btn-sm" name="update">Actualizar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-chevron-left"></i> Salir</button>
      </div>
    </div>
  </div>
</div>
</form>
    
    
    
<!-- ***********************************FIN MODAL ACTUALIZAR DATOS *************************************************** -->   
<?php } while($plaza=sqlsrv_fetch_array($plz)); ?>
    </table>
    
<?php } else{ ?>
    <div class="alert alert-info" role="alert">
      <i class="fas fa-info-circle"></i> Todavia no hay modulos de documentos.
    </div>
<?php } ?>
<br><hr><br>
<div style="text-align:center;">
    <a href="config.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regrasar a  ver usuarios</a>
</div>
    </div>
<br><br><br><br>
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
<script>
    function Confirmar(Mensaje){
        return (confirm(Mensaje))?true:false;
    }
</script>      
</html>