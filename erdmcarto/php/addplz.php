<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
    $pl="SELECT * FROM plaza
    left join proveniente on proveniente.id_proveniente=plaza.id_proveniente";
    $plz=sqlsrv_query($cnx,$pl);
    $plaza=sqlsrv_fetch_array($plz);
    
    $pro="SELECT * FROM proveniente";
    $prov=sqlsrv_query($cnx,$pro);
    $prove=sqlsrv_fetch_array($prov);
//*********************************** INICIO INSERT PLZ *******************************************************
if(isset($_POST['save'])){
    $nombre=$_POST['nombre'];
    $origen=$_POST['prov'];
    $val="select * from plaza
    where nombreplaza='$nombre'";
    $vali=sqlsrv_query($cnx,$val);
    $valida=sqlsrv_fetch_array($vali);
if($valida){
    echo '<script>alert("El nombre de plaza ya esta agregado. \nVerifique registro")</script>';
    echo '<meta http-equiv="refresh" content="0,url=addplz.php">';
} else{
    $unidad="insert into plaza values ('$origen','$nombre')";
		sqlsrv_query($cnx,$unidad) or die ('No se ejecuto la consulta isert nueva plz');
        echo '<script>alert("Plaza agregada correctamente")</script>';
        echo '<meta http-equiv="refresh" content="0,url=addplz.php">';
    }
}
//************************ FIN INSERT PLZ ******************************************************************
//****************************ACTUALIZAR DATOS DE USUARIO******************************************************
if(isset($_POST['update'])){
    $idplaza=$_POST['idplz'];
    $name=$_POST['nombreplz'];
    $prov=$_POST['prov'];
    
    $datos="update plaza set nombreplaza='$name',id_proveniente='$prov'
    where id_plaza='$idplaza'";
    sqlsrv_query($cnx,$datos) or die ('No se ejecuto la consulta update datosart');
    echo '<script> alert("Resgistro Actulizado.")</script>'; 
    echo '<meta http-equiv="refresh" content="0,url=addplz.php">';
}
//****************************FIN ACTUALIAR DATOS DE USUARIO***************************************************    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Plazas | FIDI</title>
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
    <h4 style="text-shadow: 1px 1px 2px #717171;"><i class="far fa-building"></i> Agregar nueva plaza</h4>
<form action="" method="post">
<div class="jumbotron">
    <div class="form-group" style="text-align:center;">
    <label for="exampleInputEmail1">Nombre de la plaza: *</label>
    <input style="text-align:center;" type="text" class="form-control" name="nombre" placeholder="Nombre de la nueva plaza" required>
  </div>
    
    
    <div class="form-row">
    <div class="col-md-6">
    <div class="md-form form-group">
        <label for="exampleInputEmail1">Origen de datos: *</label>
            <select name="prov" class="form-control" required>
                <option value="">Selecciona una opcion</option>
        <?php do{ ?>
                <option value="<?php echo $prove['id_proveniente'] ?>"><?php echo utf8_encode(ucwords(strtolower($prove['nombreProveniente']))) ?></option>
        <?php } while($prove=sqlsrv_fetch_array($prov)); ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">

        </div>
    </div>
    <small id="e" class="form-text text-muted" style="font-size:14px;">*Todos los campos son requeridos.</small>
<div style="text-align:right;">
        <button type="submit" class="btn btn-primary " name="save"><i class="fas fa-plus"></i> Agregar nueva plaza</button>
</div>
        </div>
</form>
<br>    
<div style="text-align:left;">
    <a href="origen.php" class="btn btn-dark btn-sm"><i class="fas fa-database"></i> Nuevo origen de datos</a></div>    
<hr>
    <h3 style="text-shadow: 1px 1px 2px #717171;"><i class="fas fa-wrench"></i> Editar plazas</h3>
    <hr>
</div>
    
    
    
    
<div class="container">
<table class="table table-sm table-hover">
  <thead>
    <tr align="left">
      <th scope="col">Plaza</th>
      <th scope="col">Origen de datos</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php do{ ?>  
    <tr align="left">
      <td><?php echo utf8_encode($plaza['nombreplaza']) ?></td>
      <td><?php echo utf8_encode($plaza['nombreProveniente']) ?></td>
      <td>
    <a href="urlMap.php?plz=<?php echo $plaza['id_plaza'] ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="left" title="Agregar URL de mapa"><i class="fas fa-map-marked-alt"></i> Mapas</a>
    
    <a href="image.php?plz=<?php echo $plaza['id_plaza'] ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar imagen de vista"><i class="fas fa-image"></i></a>
          
    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#datos<?php echo $plaza['id_plaza'] ?>"><span aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Datos de plaza"><i class="far fa-edit"></i></span></a>
          
    <a href="delete.php?poneplz=1&plz=<?php echo $plaza['id_plaza'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar plaza" onclick="return Confirmar('¿Esta seguro que decea eliminar la plaza <?php echo $plaza['nombreplaza'] ?>?')"><i class="far fa-trash-alt"></i></a>
        </td>
    </tr>
  </tbody>
<!-- *********************************MODAL PARA ACTUALIZAR UDATOS *************************************************** -->
<form action="" method="post">
<div class="modal fade" id="datos<?php echo $plaza['id_plaza'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-shadow: 0px 0px 2px #717171;">Editar nombre de plaza</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<?php  
        $pro="SELECT * FROM proveniente";
        $prov=sqlsrv_query($cnx,$pro);
        $prove=sqlsrv_fetch_array($prov);
          ?>
        <label for="exampleInputEmail1">Editar nombre de plaza: </label>
        <input type="text" class="form-control" name="nombreplz" value="<?php echo utf8_encode($plaza['nombreplaza']) ?>" required>
          <br>
        <div class="md-form form-group">
        <label for="exampleInputEmail1">Datos provenientes: *</label>
            <select name="prov" class="form-control" required>
            <option value="<?php echo $plaza['id_proveniente'] ?>"><?php echo utf8_encode($plaza['nombreProveniente']) ?></option>
        <?php do{ ?>
            <option value="<?php echo $prove['id_proveniente'] ?>"><?php echo utf8_encode(ucwords(strtolower($prove['nombreProveniente']))) ?></option>
        <?php } while($prove=sqlsrv_fetch_array($prov)); ?>
            </select>
        </div>
          
      </div>
      <div class="modal-footer">
          <input type="hidden" class="form-control" name="idplz" value="<?php echo $plaza['id_plaza'] ?>" placeholder="Agregar marca">
          <button type="submit" class="btn btn-primary" name="update">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
</form>
    
    
    
<!-- ***********************************FIN MODAL ACTUALIZAR DATOS *************************************************** -->   
<?php } while($plaza=sqlsrv_fetch_array($plz)); ?>
    </table>
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