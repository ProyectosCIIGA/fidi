<?php 

$database = "";
$plaza = $_GET['plaza'];

require 'configConexiones.php';



    $serverName = "51.222.44.135";
    $connectionInfo = array( 'Database' => $database, 'UID'=>'sa', 'PWD'=>'vrSxHH3TdC');
    $cnx = sqlsrv_connect($serverName, $connectionInfo);
    date_default_timezone_set('America/Mexico_City');

    $cruce = " SELECT a.Cuenta, b.cuenta as CuentaPos FROM Implementta a right join [dbo].[PosicionesActualizar] b on a.cuenta=b.cuenta where a.Cuenta is null ";
    $datosCruze = sqlsrv_query($cnx, $cruce);

    $row = null;
    if($datosCruze != false){
        $row = sqlsrv_fetch_array($datosCruze);
        
        header("Pragma: public");
        header("Expires: 0");
        $filename = "cuentasSinCruce.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    }else{
        print_r(sqlsrv_errors() );
        exit();
    }




?>
<table>
    <tbody>
        <tr>
            <th>
                <h4>Cuentas no encontradas</h4>
            </th>
        </tr>
        <?php while($row != null){ ?>
        <tr>
            <td><?php echo $row['CuentaPos']; ?></td>
        </tr>
        <?php $row = sqlsrv_fetch_array($datosCruze); } ?>
    </tbody>
</table>