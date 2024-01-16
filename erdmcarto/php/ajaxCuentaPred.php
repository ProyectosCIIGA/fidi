<?php 
    if(isset($_POST['alumnos'])) {
        
    require "../../acnxerdm/cnx.php";
        
    $buscara=$_POST['alumnos'];
    //$plazaa=$_POST['num2'];
    $ura="SELECT top 20 * FROM PadronCataZapopan
    where Cuenta_predial='$buscara'
    or Propietario LIKE '%$buscara%'
    or razonSocial LIKE '%$buscara%'";
    $urla=sqlsrv_query($cnx,$ura);
    $direcciona=sqlsrv_fetch_array($urla);
        
        
        
if(isset($direcciona)){
?>

<table class="table table-hover table-sm" style="font-weight:normal;text-shadow:0px 0px 1px #717171;font-size:90%">
  <thead class="thead-dark">
    <tr>
    <tr>
      <th scope="col">Cuenta Predial</th>
      <th scope="col">CURT</th>
      <th scope="col">Propietario</th>
      <th scope="col">Razón Social</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
   <?php do{ ?>
    <tr>
      <td><?php echo $direcciona['Cuenta_predial'] ?></td>
      <td><?php echo $direcciona['CURT'] ?></td>
      <td><?php echo utf8_encode($direcciona['Propietario']) ?></td>
      <td><?php echo utf8_encode($direcciona['razonSocial']) ?></td>
      <td>
         <?php// if(isset($direcciona['Cuenta_predial'])){ ?>
          <a href="ficha.php?fic=<?php echo $direcciona['Cuenta_predial'].'&cuenta=6155625111&clave=987367aa' ?>" class="btn btn-primary btn-sm"><i class="far fa-file"></i> Ver ficha</a>
          <?php// } else{ ?>
<!--              <span class="badge badge-warning">No hay Cuenta Predial</span>-->
          <?php// } ?>
      </td>
    </tr>
    <?php }while($direcciona=sqlsrv_fetch_array($urla)); ?>
  </tbody>
</table>
<small><i class="fas fa-info-circle"></i> Mostrando el top 20 de registros en búsqueda</small>
<?php } else{ ?>
        <div class="alert alert-warning" role="alert" style="color:#000000;">
            <img src="https://img.icons8.com/color/40/000000/error--v1.png"/> No se encuentran resultados para "<?php echo $_POST['alumnos'] ?>"
        </div>
<?php } ?>

<?php //********************** SI NO BUSCA NADA ENTONCES MUESTRA EL ALERT ******************************************** ?>

<?php } else{ ?>
<hr>
<!--
        <div class="alert alert-info" role="alert">
            <img src="https://img.icons8.com/fluency/40/000000/username.png"/> Buscar cuenta predial o nombre del propietario
        </div>
-->
<?php } ?>


























