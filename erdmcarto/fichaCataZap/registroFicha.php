<?php
session_start();
if(((isset($_SESSION['user'])) and (isset($_SESSION['fichas']))) or ($_SESSION['user'] == 1) or ($_SESSION['user'] == 3) or ($_SESSION['user'] == 5)){
require "../../acnxerdm/cnx.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fichas catastrales Fidi</title>
<link rel="icon" href="../icono/icon.png">
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" id="theme-styles">
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
    font-weight:bold;
    width: 100%;
    height: 100%;
    margin-top:-1%;
    padding-top:0px;
}
    
    </style>
<?php require "../php/include/nav.php";
//*****************************************************************************
if(isset($_POST['findCuenta'])){
$cuentaPred=trim($_POST['cuenta']);
    $va="select top 100 Cuenta_predial,Propietario from PadronCataZapopan2023
    where Cuenta_predial='$cuentaPred'";
    $val=sqlsrv_query($cnx,$va);
    $valida=sqlsrv_fetch_array($val);
    
    if(isset($valida)){
        echo '<meta http-equiv="refresh" content="0,url=cuentasTipologias.php?cta=11142235687&test='.date('Ymd').'&cpred='.$valida['Cuenta_predial'].'">';
    } else{
        echo "<script>
                let timerInterval
                Swal.fire({
                  title: 'La cuenta no existe',
                  html: 'La cuenta no existe en el padron Zapopan Predial 2023',
                  icon: 'error',
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
            </script>";
        echo '<meta http-equiv="refresh" content="2,url=registroFicha.php">';
    }
}
//*****************************************************************************
    ?>
</head>
<body>
<div class="container">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Fichas catastrales Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/fluency/48/null/gender-neutral-user.png"/> Mi perfil Carlos Rafael Hernandez Magos</h4>
<hr><br>
    
<div class="card-columns">
    <div class="card text-center">
      <div class="card-header">
        <img src="https://img.icons8.com/color/30/null/add--v1.png"/> Nuevo
      </div>
      <div class="card-body">
        <h5 class="card-title">Zapopan Predial</h5>
        <p class="card-text">Crear una nueva ficha catastral</p><br>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCuenta">
          <i class="fas fa-file"></i> Ir a nueva ficha
        </button>
      </div>
<!--
      <div class="card-footer text-muted">
        2 days ago
      </div>
-->
    </div>

     <div class="card text-center">
      <div class="card-header">
        <img src="https://img.icons8.com/fluency/30/null/today.png"/> Mis fichas
      </div>
      <div class="card-body">
        <h5 class="card-title">Fichas del día <span class="badge badge-success">15</span></h5>
        <p class="card-text">Fichas creadas el dia de hoy <br><?php echo date('d/m/Y') ?></p>
        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Ir a ver mis fichas</a>
      </div>
<!--
      <div class="card-footer text-muted">
        2 days ago
      </div>
-->
    </div>

     <div class="card text-center">
      <div class="card-header">
         <img src="https://img.icons8.com/color/30/null/order-history.png"/> Mi historial
      </div>
      <div class="card-body">
        <h5 class="card-title">Total de fichas <span class="badge badge-warning">15,000</span></h5>
        <p class="card-text">Total de fichas generadas al dia <?php echo date('d/m/Y') ?></p>
        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Ir a buscar fichas</a>
      </div>
<!--
      <div class="card-footer text-muted">
        2 days ago
      </div>
-->
    </div>
    
<form action="" method="post">
<!--**************************************** Modal **********************************************************-->
<div class="modal fade" id="modalCuenta" tabindex="-1" role="dialog" aria-labelledby="modalCuenta" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="form-group" style="text-align:center;">
            <label for="exampleInputEmail1">Cuenta Predial: *</label>
            <input style="text-align:center;" type="text" class="form-control" name="cuenta" placeholder="Ingresa una cuenta predial" required autofocus>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-chevron-left"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm" name="findCuenta"><i class="fas fa-drafting-compass"></i> Ir a crear ficha</button>
      </div>
    </div>
  </div>
</div>
<!--************************************** Fin Modal **********************************************************-->
</form>
  
  
  
  
</div>
    
    
<br><br><br>
    
    
    
    
    
<div style="text-align:center;">
    <a href="../php/accesDoctos.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar</a>
</div>
    
    
    
    
    

    
    
    
    
    
    
    <br><br><br>
    </div>
<?php } else{
    header('location:../../login.php');
}
require "../php/include/footer.php";
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














