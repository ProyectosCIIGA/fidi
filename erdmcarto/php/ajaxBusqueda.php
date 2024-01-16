<?php
if(isset($_POST['alumnos'])) {
require "conect.php";
    
    $buscara=$_POST['alumnos'];
    $plazaa=$_POST['num2'];
    $ura="SELECT top 4 * FROM implementta
    where Propietario LIKE '%$buscara%'";
    $urla=sqlsrv_query($cnx,$ura);
    $direcciona=sqlsrv_fetch_array($urla);
    
if(isset($direcciona)){
    do{

    if(($plazaa == 25) or ($plazaa == 2030) or ($plazaa == 2037)){
        $cuentaRep=$direcciona['Cuenta']; //solo aplica en MexicaliA por cuentas con guion
    } else{
        $cuentaRep=str_replace("-","",$direcciona['Cuenta']); //remplazar guiones por nada ""
    }
        
?>
<a href="map.php?plz=<?php echo $plazaa.'&mp='.$_GET['mp'].'&src='.$direcciona['Cuenta'].'&srcRep='.$cuentaRep.'&clv=1' ?>" style="color:#545454;text-decoration:none;font-style:italic;font-size:70%; text-align:left;" class="btn btn-outline-light btn-sm">* <?php echo utf8_encode($direcciona['Propietario']) ?></a>

<?php } while($direcciona=sqlsrv_fetch_array($urla)); 

} else{
?>
<div class="alert alert-info" role="alert">
  No hay resultados para "<?php echo $buscara ?>"
</div>
<?php } ?>
<br><br>
<?php } else { ?>
    
    <br>
    
<?php     
} ?>