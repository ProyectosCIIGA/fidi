
<?php 
require "../../acnxerdm/cnx.php";

    $va="select fichaResult.registroInsert,fichaResult.CPredial,padron.CURT,valCatastrales.anio,fichaResult.SupTerreno,valCatastrales.supConstruct,
    valCatastrales.valTerreno,valCatastrales.valorConstruct,valCatastrales.valorCatastral,fichaResult.EstadoEdificacion,tasa=0.23 from PadronCataZapopan as padron
    inner join fichaResult on fichaResult.CPredial=padron.Cuenta_predial
    inner join valCatastrales on valCatastrales.tokenValCatas=fichaResult.tokenResult where fichaResult.CPredial in (select cuentaPredial from [dbo].[nuevaCActuales])";
    $val=sqlsrv_query($cnx,$va);
    $valua=sqlsrv_fetch_array($val);





header("Pragma: public");
header("Expires: 0");
$filename = 'Valuaciones_Catastrales_'.date('d_m_Y_H_i_s_').'.xls';
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

?>

<style>
    table, th, td {
      border:1px solid black;
    }
</style>

<table>
  <thead>
    <tr>
      <th scope="col">Cuenta</th>
      <th scope="col">CURT</th>
      <th scope="col">Año</th>
      <th scope="col">Bimestre</th>
      <th scope="col">Superficie terreno</th>
      <th scope="col">Superficie construccion</th>
      <th scope="col">Valor terreno</th>
      <th scope="col">Valor Construccion</th>
      <th scope="col">Valor fiscal</th>
      <th scope="col">Estado Edificación</th>
      <th scope="col">Tasa</th>
    </tr>
  </thead>
  <tbody>
<?php do{ ?>
  
  <?php// if ?>
  
   <?php if(($valua['anio'] <> '2017') and ($valua['anio'] <> '2022')){
        
    $i = 1;
    while ($i <= 6) { ?>
     
    <tr>
      <td><?php echo "'".$valua['CPredial'] ?></td>
      <td><?php echo "'".$valua['CURT'] ?></td>
      <td><?php echo $valua['anio'] ?></td>
      <td><?php echo $i ?></td>
      <td><?php echo $valua['SupTerreno'] ?></td>
      <td><?php echo $valua['supConstruct'] ?></td>
      <td><?php echo $valua['valTerreno'] ?></td>
      <td><?php echo $valua['valorConstruct'] ?></td>
      <td><?php echo $valua['valorCatastral'] ?></td>
      <td><?php echo $valua['EstadoEdificacion'] ?></td>
      <td><?php echo '0.23' ?></td>
    </tr>
        
        
<?php 
    $i++;
        }
    } else if($valua['anio'] == '2017'){
        
    $n = 5;
    while ($n <= 6) { ?>
     
    <tr>
      <td><?php echo "'".$valua['CPredial'] ?></td>
      <td><?php echo "'".$valua['CURT'] ?></td>
      <td><?php echo $valua['anio'] ?></td>
      <td><?php echo $n ?></td>
      <td><?php echo $valua['SupTerreno'] ?></td>
      <td><?php echo $valua['supConstruct'] ?></td>
      <td><?php echo $valua['valTerreno'] ?></td>
      <td><?php echo $valua['valorConstruct'] ?></td>
      <td><?php echo $valua['valorCatastral'] ?></td>
      <td><?php echo $valua['EstadoEdificacion'] ?></td>
      <td><?php echo '0.23' ?></td>
    </tr>
        
        
<?php 
    $n++;
        } ?>
        
        
<?php } else if($valua['anio'] == '2022'){ 

 $o = 1;
    while ($o <= 6) { ?>
     
    <tr>
      <td><?php echo "'".$valua['CPredial'] ?></td>
      <td><?php echo "'".$valua['CURT'] ?></td>
      <td><?php echo $valua['anio'] ?></td>
      <td><?php echo $o ?></td>
      <td><?php echo $valua['SupTerreno'] ?></td>
      <td><?php echo $valua['supConstruct'] ?></td>
      <td><?php echo $valua['valTerreno'] ?></td>
      <td><?php echo $valua['valorConstruct'] ?></td>
      <td><?php echo $valua['valorCatastral'] ?></td>
      <td><?php echo $valua['EstadoEdificacion'] ?></td>
      <td><?php echo '0.23' ?></td>
    </tr>
        
        
<?php 
    $o++;
        } 
        } ?>








<?php } while($valua=sqlsrv_fetch_array($val)); ?>
  </tbody>
</table>
