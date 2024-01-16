<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Iniciar sesión | Fidi</title>
<link rel="icon" href="erdmcarto/icono/icon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="erdmcarto/css/bootstrap.css">
<link href="erdmcarto/fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" id="theme-styles">
<style> 
  body{
        background-image: url(erdmcarto/img/back.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        background-attachment: fixed;
    }
  body{
    font-family: sans-serif;
    font-style: normal;
    font-weight:normal;
    width: 100%;
    height: 100%;
}
    
/*********************************************/
    
    
ul#navigation {
    position: fixed;
    margin: 0px;
    padding: 0px;
    top: 50px;
    left: 0px;
    list-style: none;
    z-index:9999;
}

ul#navigation li {
    width: 100px;
}

ul#navigation li a {
    display: block;
    margin-left: -85px;
    width: 130px;
    height: 40px;
    background-color:#CFCFCF;
    background-repeat:no-repeat;
    background-position:center center;
    border:2px solid #AFAFAF;
    -moz-border-radius:0px 10px 10px 0px;
    -webkit-border-bottom-right-radius: 10px;
    -webkit-border-top-right-radius: 10px;
    -khtml-border-bottom-right-radius: 10px;
    -khtml-border-top-right-radius: 10px;
    opacity: 0.7;
}
    </style>
</head>
<body>
<?php 
//**************************************************************************************************************
$_SESSION['fecha']=date('YmdHis');
if(isset($_POST['login'])){
require "acnxerdm/cnx.php";
    $correo=$_POST['correo'];
    $password=$_POST['pass'];
    $login = "SELECT * FROM usuarionuevo 
        inner join usuario on usuarionuevo.id_usuarioNuevo=usuario.id_usuarioNuevo
        WHERE usuarionuevo.correo = '$correo' and usuario.clave='$password'";
        $datos=sqlsrv_query($cnx,$login);
        $log=sqlsrv_fetch_array($datos);
        
			if($log){
                

                
                
//                if($log['estado']=='3'){
//                    $_SESSION['fichas']='3'; //sesion de fichasCatas
//                }
                
                
                
                
                
                $_SESSION['user']=$log['id_usuarioNuevo'];
              
                $fecha=$_SESSION['fecha'];
                $id_usuarioNuevo=$log['id_usuarioNuevo'];
                
                $idusr=$log['id_usuario'];
                $fecha=date('Y-m-d');
                $hora=date('H:i:s');
                $dia=date('w');
                
                $login="UPDATE usuario SET acceso='$fecha' WHERE id_usuarioNuevo='$id_usuarioNuevo'";
                sqlsrv_query($cnx,$login);  // actualizar
                
                $accesos="insert into accesos (id_usuario,fecha,hora,dia) values ('$idusr','$fecha','$hora',$dia)";
                sqlsrv_query($cnx,$accesos) or die ('No se ejecuto la consulta isert reg accesos'); //Insert accesos
                
                echo "<script>
                    let timerInterval
                    Swal.fire({
                      title: 'Iniciando sesión ',
                      icon: 'success',
                      timer: 1000,
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
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                      }
                    })
                </script>";
                
                
                if($log['estado']=='1'){
                  $_SESSION['admin']='1';
                    $_SESSION['tipousuario']='1';
                    echo '<meta http-equiv="refresh" content="1,url=erdmcarto/php/acceso.php">';
                } else if($log['rol']==NULL){
                  $_SESSION['admin']='0';
                    $_SESSION['tipousuario']='visor';
                    echo '<meta http-equiv="refresh" content="1,url=erdmcarto/php/acceso.php">';
                } else if($log['rol']=='visor'){
                  $_SESSION['admin']='0';
                    $_SESSION['tipousuario']='visor';
                    echo '<meta http-equiv="refresh" content="1,url=erdmcarto/php/acceso.php">';
                } else if($log['rol']=='documentos'){
                  $_SESSION['admin']='0';
                    $_SESSION['tipousuario']='documentos';
                    echo '<meta http-equiv="refresh" content="1,url=erdmcarto/php/accesDoctos.php">';
                }
                
                
			} else{
                echo "<script>
                        let timerInterval
                        Swal.fire({
                          title: '¡Error!',
                          html: 'Los datos de acceso no son correctos <br>Intenta nuevamente.',
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
                echo '<meta http-equiv="refresh" content="2,url=login.php">';
			}
    }
//***************************************************************************************************************************  
?>
<br>
<!--*********************TARGETA INICIO DE SESION*****************************************************-->
<form class="form-inline" method="post">
<div class="row no-gutters" style="width:20rem;margin:auto;">
 <a href="#">
     <img src="erdmcarto/img/login.png" class="card-img-top" alt="..."></a>
<div class="card-body">
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
  </div>
  <input type="email" name="correo" class="form-control border border-secondary form-control-sm" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
  </div>
  <input type="password" name="pass" class="form-control border border-secondary form-control-sm" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
</div>
      <button  type="submit" name="login" class="btn btn-primary btn-sm" id="botones" data-toggle="tooltip" data-placement="bottom" title="Iniciar Sesion">Iniciar Sesion</button><br>
<!--
       <span style="font-size:14px"><a href="registro.php">Registrarte</a></span><br>
       <span style="font-size:14px"><a href="#" data-toggle="modal" data-target="#lostpass">¿Olvidaste tu contraseña?</a></span>
-->
  </div>
</div>
    </form>
<!--***********************************************FIN TARGETA INICIO DE SESION*****************************************************--> 
    
<ul id="navigation">
    
    <li class="Imagen1"><a href="tel:6673201349" data-toggle="tooltip" data-placement="top" title="Enviar correo" style="color: #000000;text-decoration: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Llamar <img src="erdmcarto/img/icons8-llamada-saliente-48.png" class="img-fluid" alt="Responsive image" width="27%"></a></li>

    <li class="Imagen2"><a href="https://api.whatsapp.com/send?phone=528116887160" data-toggle="tooltip" data-placement="top" title="Enviar correo" target="_blank" style="color: #000000;text-decoration: none;">WhattsApp <img src="erdmcarto/img/icons8-phone-call-47.png" class="img-fluid" alt="Responsive image" width="25%"></a></li>
    
    <li class="Imagen3"><a href="mailto:cartografia.ciiga@erdm.mx" data-toggle="tooltip" data-placement="top" title="Enviar correo" target="_blank" style="color: #000000;text-decoration: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Correo <img src="erdmcarto/img/icons8-correo-48.png" class="img-fluid" alt="Responsive image" width="25%"></a></li>
    
</ul>

    </body>
    <footer class="text-center">
      <div class="container">
         <span class="navbar-text" style="font-size:11px;font-weigth:bold;">Sistema Fidi Cartografia<br>
             Centro de Inteligencia Informática y Geografía Aplicada<br>
             Creado y diseñado por © <?php echo date('Y') ?> Estrategas de México<hr>
             Contacto: <i class="fas fa-phone-alt"></i> 667 320 1349 o <i class="fas fa-phone-alt"></i> 81 1688 7160 <i class="fas fa-envelope"></i> cartografia.ciiga@erdm.mx
          </span> 
      </div>
    </footer>
<script src="erdmcarto/js/jquery-3.4.1.min.js"></script>
<script src="erdmcarto/js/bootstrap.js"></script>
<script>
    
    
    /* sacado de http://carlitoxenlaweb.blogspot.com.es/2012/10/menu-lateral-flotante-con-jquery-y-css.html */

$(function() {
  $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);
 
  $('#navigation > li').hover(
    function () {
 $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
    },
    function () {
 $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
    }
  );
});
    
    
    </script>    
</html>