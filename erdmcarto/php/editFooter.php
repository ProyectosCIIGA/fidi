<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['doctos']))){
require "../../acnxerdm/cnx.php";
    
    $fo="select * from footer";
    $foot=sqlsrv_query($cnx,$fo);
    $footer=sqlsrv_fetch_array($foot);
    
if(isset($_POST['update'])){

    $text=$_POST['textoFooter'];
    
 	    $pie="update footer set text='$text'";
		sqlsrv_query($cnx,$pie) or die ('No se ejecuto la consulta update pie de pagina');
        echo '<script>alert("Pie de pagina actualizado correctamente")</script>';
        echo '<meta http-equiv="refresh" content="0,url=buscarFicha.php">';
}
    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editar pie de pagina</title>
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
   <form action="" method="post">
    <h1 style="text-shadow: 1px 1px 2px #717171;">Fichas Catastrales Fidi</h1>
    <h4 style="text-shadow: 1px 1px 2px #717171;"><img src="https://img.icons8.com/color/40/000000/document-footer.png"/> Editar pie de pagina</h4>
  <hr>



    <textarea class="form-control" name="textoFooter" rows="10" minlength="1" maxlength="1200" autofocus> <?php echo $footer['text'] ?>
    </textarea>

<hr>
    <div style="text-align:center;">
        <button type="submit" class="btn btn-primary btn-sm" name="update"><i class="fas fa-pen"></i> Actualizar pie de pagina</button>
        <a href="buscarFicha.php" class="btn btn-dark btn-sm"><i class="fas fa-chevron-left"></i> Regresar</a>
    </div>
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