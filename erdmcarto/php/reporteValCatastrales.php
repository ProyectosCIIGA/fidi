<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['doctos']))){
require "../../acnxerdm/cnx.php";
    
//****************************CONSULTA POR FECHA REGISTRO**************************************************
if(isset($_GET['busca'])){
    $ini=$_GET['inicial'];
    $fin=$_GET['final'];
    
    $va="select fichaResult.registroInsert,fichaResult.CPredial,padron.CURT,valCatastrales.anio,fichaResult.SupTerreno,valCatastrales.supConstruct,
    valCatastrales.valTerreno,valCatastrales.valorConstruct,valCatastrales.valorCatastral,fichaResult.EstadoEdificacion,tasa=0.23 from PadronCataZapopan as padron
    inner join fichaResult on fichaResult.CPredial=padron.Cuenta_predial
    inner join valCatastrales on valCatastrales.tokenValCatas=fichaResult.tokenResult
    where fichaResult.registroInsert between '$ini' and '$fin'";
    $val=sqlsrv_query($cnx,$va);
    $valua=sqlsrv_fetch_array($val);
    
}
//****************************FIN CONSULTA POR FECHA REGISTRO**********************************************
    
    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Valuaciones Catastrales</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/peticionCuentaPredial.js"></script>
-->
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
    <h1 style="text-shadow: 1px 1px 2px #717171;">Fichas Catastrales Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/cotton/40/000000/graph-report--v2.png"/> Reporte de Valuaciones Catastrales</h4>
  <hr>
  
  
<div class="row" style="margin-left:31.3%;text-align:center;"> 
<form action="" method="get">
        <div class="form-row" style="text-align:center;">
        <div class="col-md-2.5">
          <div class="md-form form-group">
            <input type="date" name="inicial" class="form-control" value="<?php echo date('Y-m-d') ?>" required style="width:auto;" autofocus>
          </div>
        </div>
        <div class="col-md-2.5">
          <div class="md-form form-group">
              <i class="fas fa-arrows-alt-h"></i>
          </div>
        </div>
        <div class="col-md-2.5">
          <div class="md-form form-group">
            <input type="date" name="final" class="form-control" value="<?php echo date('Y-m-d') ?>" required style="width:auto;">
          </div>
        </div>   
      </div>
    <button type="submit" class="btn btn-primary btn-sm" name="busca"><i class="fas fa-search"></i> Buscar</button>
</form>
</div>
  
  
   
   
<?php if(isset($valua)){ 
        
        $nu="select count(id_fichaResult) as numReg from fichaResult
        where registroInsert between '$ini' and '$fin'";
        $num=sqlsrv_query($cnx,$nu);
        $numReg=sqlsrv_fetch_array($num);

    ?>
  
<br> 
 <div class="alert alert-info" role="alert">
   <h5 style="text-shadow: 0px 0px 2px #717171;">Registros de fichas catastrales encontrados: <?php echo $numReg['numReg'] ?></h5>
   
   <h5 style="text-shadow: 0px 0px 2px #717171;">En el intervalo de fechas: <?php echo $_GET['inicial'].' al '.$_GET['final'] ?></h5>
   <hr>
    <div style="text-align:center;">
        <a href="excelDownload.php?inicial=<?php echo $_GET['inicial'].'&final='.$_GET['final'] ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Descargar archivo Excel</a>
    </div>
</div>
<br>
  
  
  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    <br><hr>
    <div style="text-align:center;">
<!--        <button type="submit" class="btn btn-success btn-sm" name="update"><i class="fas fa-file-excel"></i> Descargar archivo Excel</button>-->
        <a href="buscarFicha.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar</a>
    </div>
    
<?php } else{ ?>
  
    <br><br>
    <div class="alert alert-info" role="alert">
      <i class="fas fa-info-circle"></i> Selecciona una fecha de búsqueda<br>
      <small>La búsqueda se refiere al intervalo de fechas donde se formaron fichas catastrales en Fidi. Se muestran solo registros generados previamente en formato ficha catastral.</small>
    </div>
   
    <br><hr>
    <div style="text-align:center;">
        <a href="buscarFicha.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar</a>
    </div>
    
<?php } ?>
   
   
   
   
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