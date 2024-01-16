<?php
session_start();
require "../../acnxerdm/cnx.php";

?>
<form action="querys.php" method="GET">
    
<?php if(isset($_POST['alumnos'])) {

    $busqueda=$_POST['alumnos'];
    
    $usa="SELECT top 15 * FROM usuarionuevo
    inner join usuario on usuario.id_usuarioNuevo=usuarionuevo.id_usuarioNuevo
    where usuarionuevo.nombre LIKE '%$busqueda%'
    or usuarionuevo.app LIKE '%$busqueda%'
    or usuarionuevo.apm LIKE '%$busqueda%'
    or usuarionuevo.correo LIKE '%$busqueda%'
    order by usuarionuevo.id_usuarioNuevo ASC";
    $usea=sqlsrv_query($cnx,$usa);
    $usera=sqlsrv_fetch_array($usea);
    
?>
<?php if(isset($usera)){ ?>
<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Usuario</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php do{ ?>
    <tr>
      <td><?php echo utf8_encode($usera['nombre'].' '.$usera['app'].' '.$usera['apm']) ?><?php if($usera['estado']==1){ ?> <i class="fas fa-user-shield"></i> <?php } else if($usera['rol']=='documentos'){ ?> <i class="fas fa-layer-group"></i> <?php } ?></td>
      <td><?php echo $usera['correo'] ?></td>
      <td><a href="updateUsr.php?usr=<?php echo $usera['id_usuarioNuevo'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Actualizar usuario"><i class="fas fa-user"></i></a>
          
<?php if($usera['rol']=='documentos'){ ?>
    <a href="doctosAccess.php?usr=<?php echo $usera['id_usuarioNuevo'].'&plz=65&crhm=950721&idus=659898895' ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar editor de documentos" ><i class="fas fa-folder-open"></i></a>
<?php } else{ ?>
    <a href="permisoPlz.php?usr=<?php echo $usera['id_usuarioNuevo'].'&plz=65&crhm=950721&idus=659898895' ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar plaza" ><i class="fas fa-cubes"></i></a>
<?php } ?>
          
    <a href="delete.php?poneUser=1&usr=<?php echo $usera['id_usuarioNuevo'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar usuario" onclick="return Confirmar('¿Esta seguro que desea eliminar al usuario <?php echo $usera['nombre'].' '.$usera['app'] ?>?')"><i class="far fa-trash-alt"></i></a>
        </td>
    </tr>
  </tbody>        
    <?php } while($usera=sqlsrv_fetch_array($usea)); ?>
</table>
    <?php } else{ ?>
        <div class="alert alert-info" role="alert">
          <i class="fas fa-info-circle"></i> No hay resultados para <?php echo '"'.$busqueda.'"' ?>
        </div>
    <?php } ?>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php } else{
    
    $usa="SELECT * FROM usuarionuevo
    inner join usuario on usuario.id_usuarioNuevo=usuarionuevo.id_usuarioNuevo
    order by usuarionuevo.id_usuarioNuevo ASC";
    $usea=sqlsrv_query($cnx,$usa);
    $usera=sqlsrv_fetch_array($usea);
    
?>
<?php if(isset($usera)){ ?>
<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Usuario</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php do{ ?>
    <tr>
      <td><?php echo utf8_encode($usera['nombre'].' '.$usera['app'].' '.$usera['apm']) ?><?php if($usera['estado']==1){ ?> <i class="fas fa-user-shield"></i> <?php } else if($usera['rol']=='documentos'){ ?> <i class="fas fa-layer-group"></i> <?php } ?></td>
      <td><?php echo $usera['correo'] ?></td>
      <td><a href="updateUsr.php?usr=<?php echo $usera['id_usuarioNuevo'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Actualizar usuario"><i class="fas fa-user"></i></a>
          
<?php if($usera['rol']=='documentos'){ ?>
    <a href="doctosAccess.php?usr=<?php echo $usera['id_usuarioNuevo'].'&plz=65&crhm=950721&idus=659898895' ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar editor de documentos" ><i class="fas fa-folder-open"></i></a>
<?php } else{ ?>
    <a href="permisoPlz.php?usr=<?php echo $usera['id_usuarioNuevo'].'&plz=65&crhm=950721&idus=659898895' ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar plaza" ><i class="fas fa-cubes"></i></a>
<?php } ?>
          
    <a href="delete.php?poneUser=1&usr=<?php echo $usera['id_usuarioNuevo'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar usuario" onclick="return Confirmar('¿Esta seguro que desea eliminar al usuario <?php echo $usera['nombre'].' '.$usera['app'] ?>?')"><i class="far fa-trash-alt"></i></a>
        </td>
    </tr>
  </tbody>        
    <?php } while($usera=sqlsrv_fetch_array($usea)); ?>
</table>
    <?php } else{ ?>
        <div class="alert alert-info" role="alert">
          <i class="fas fa-info-circle"></i> No hay resultados
        </div>
    <?php } ?>
    
    
    
    
    
    
<?php } ?>


</form>


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
