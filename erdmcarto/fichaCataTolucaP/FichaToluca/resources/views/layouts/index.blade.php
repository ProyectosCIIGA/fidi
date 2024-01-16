<?php


    
if(!(isset($_SESSION['user']))){
    echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/logout.php">';
}
else{


if((isset($_SESSION['user'])) and ($_SESSION['tipousuario'] == 'documentos') or ($_SESSION['user'] == 1) or ($_SESSION['user'] == 3) or ($_SESSION['user'] == 5)){
    
?>
@php
    $id=$_SESSION['user'];
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fichas catastrales Fidi @yield('titulo')</title>
    <link rel="icon" href="{{ asset('img/icons/icon.png') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">

    @routes
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css"
        id="theme-styles">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
</head>
<body>
{{-- Mensajes de error de peticiones --}}
     @if (session('errorviewfichasnow'))
     {{-- Muestra de sweetalert en caso de error de petición --}}
         <script src="{{ asset('js/errorviewfichasnow.js') }}"></script>
     @endif
     @if (session('errorsubirficha'))
     {{-- Muestra de sweetalert en caso de error de petición --}}
         <script src="{{ asset('js/errorsubirficha.js') }}"></script>
     @endif
    {{-- Navegador --}}
    <nav class="navbar navbar-expand-lg navbar-light mt-3">
        <a href="">
            <img src="{{ asset('img/bg/logoFIDI.png') }}" class="mx-3" width="120" height="90" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                

                <?php if(isset($_SESSION['tipousuario'])){ ?>   
                <a class="nav-item nav-link" href="../../../../../../../cartomaps/erdmcarto/php/config.php">|<i class="bi bi-person-gear"></i> Administrador |</a>
                <?php } ?>  
                <a class="nav-item nav-link" href="../../../../../../../cartomaps/erdmcarto/php/acceso.php">| Inicio |</a>
                <?php if((isset($_SESSION['fichas'])) and ($_SESSION['fichas'] == 3) or (isset($_SESSION['tipousuario']))){ ?>
                <a class="nav-item nav-link" href="../../../../../../../cartomaps/erdmcarto/php/accesDoctos.php">| <i class="far fa-file-alt"></i><i class="bi bi-file-text"></i> Documentos |</a>
                <?php } ?>
                <a class="nav-item nav-link" href="../../../../../../../cartomaps/erdmcarto/php/logout.php">| Salir <i class="bi bi-box-arrow-right"></i>|</a>
            </ul>
        </div>
    </nav>
    {{-- Componentes --}}
    <div class="container container-height my-1" >
        @yield('content')
    </div>
    {{-- Pie de pagina --}}
    <footer class="" >
        <div class="row justify-content-between">
            <div class="col-3 mx-4 mt-5">
                <p class="fw-bold text-black text-footer">
                    Sistema FIDI
                    <br />
                    Estrategas de México
                    <br />
                    Centro de Inteligencia Informática y Geografía Aplicada
                    <hr class="border border-dark">
                    <span class="text-black text-footer">
                        Creado y diseñado por ©{{ date('Y') }} Estrategas de México<br />
                    </span>
                </p>
            </div>
            <div class="col-4 mt-3">
                <img src="{{ asset('img/bg/logoBottonFIDI.png') }}" width="220" height="130" alt="">
                <img src="{{ asset('img/bg/logoBotton.png') }}" width="240" height="100" alt="">
            </div>
        </div>
    </footer>
    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    @yield('js')
</body>

</html>
<?php } else{
    echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/logout.php">';
}
}

?>