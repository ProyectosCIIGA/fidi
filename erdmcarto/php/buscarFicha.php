<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['doctos']))){
require "../../acnxerdm/cnx.php";
    
if(isset($_POST['buscar'])){
    $clave=$_POST['clave'];
    echo '<meta http-equiv="refresh" content="0,url=buscarFicha.php?find='.$clave.'&clave=348948423235&post=596658544">';
}
if(isset($_GET['find'])){
    $buscara=$_GET['find'];
    //$plazaa=$_POST['num2'];
    $ura="select top 1 * from tipologias
    inner join PadronCataZapopan as padron on padron.Cuenta_predial=tipologias.CLAVES
    where tipologias.CLAVES='$buscara'";
    $urla=sqlsrv_query($cnx,$ura);
    $direcciona=sqlsrv_fetch_array($urla);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Valuacion Catastral - FIDI</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/peticionCuentaPredial.js"></script>
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
   <form action="" method="post">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Fichas Catastrales Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/color/40/000000/graph-report.png"/> Valuaciones Catastrales Zapopan, Jalisco</h4>
<?php if(isset($_SESSION['tipousuario'])){ ?>
  <a href="editFooter.php" class="badge badge-secondary"><i class="fas fa-pen"></i> Editar pie de pagina</a>
  <a href="reporteValCatastrales.php" class="badge badge-success"><i class="fas fa-check-circle"></i> Reporte de Valuaciones Catastrales</a>
<?php } ?>
  <hr>
<div class="alert alert-info" role="alert">
      <div class="form-row">
        <div class="col-md-6">
            <img src="https://img.icons8.com/fluency/40/000000/username.png"/> Buscar cuenta predial, propietario o razón social
        </div>
        <div class="col-md-6">
          <div class="justify-content-center justify-content-md-center">
            <div>
              <div class="input-group col-md-15 justify-content-center">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
<!--               <button type="submit" name="buscar" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>-->
                </div>
                <input type="text" class="form-control border border-secondary" placeholder="Buscar cuenta predial, propietario o razón social" name="clave" id="busqueda" required autofocus>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<br>
   
   
   
<div id="tabla_resultado"> 
<!--**********tabla resultado******** -->
</div>
    
    
    
    
 
 
 
  <br>
  <div style="text-align:center;">
      <a href="acceso.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Salir de esta pagina</a>
  </div>
  <br><br><br><br><br><br><br><br>
   </form>
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