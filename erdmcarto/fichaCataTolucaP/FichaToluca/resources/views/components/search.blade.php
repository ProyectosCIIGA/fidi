
<?php

//inicio la sesion
// session_start();
require public_path("php/cnx.php");
// if(!(isset($_SESSION['user']))){
//     echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/logout.php">';
// }
// else{


// if((isset($_SESSION['user'])) and ($_SESSION['tipousuario'] == 'documentos') or ($_SESSION['user'] == 1) or ($_SESSION['user'] == 3) or ($_SESSION['user'] == 5)){
    
// if(isset($_GET['id_documento'])){

    //recibo el id del documento
    // $id_documento=$_GET['id_documento'];
    //recibo el id del usuario
    // $id_usuario=$_SESSION['user'];
    $fecha_hoy=date('d-m-Y');
    
    //consulto todas las fichas que a generado
    // $count_f_now = "SELECT count(id_doctoCreado) as count FROM doctoCreado
    // inner join accessDoctos on doctoCreado.id_accessDoctos=accessDoctos.id_accessDoctos       
    // WHERE id_documento = '$id_documento' and id_usuarioNuevo='$id_usuario' and fecha='$fecha_hoy'";
    // $count_f=sqlsrv_query($cnx,$count_f_now);
    // $now=sqlsrv_fetch_array($count_f);
    
    // $count_f_total = "SELECT count(id_doctoCreado) as count FROM doctoCreado
    // inner join accessDoctos on doctoCreado.id_accessDoctos=accessDoctos.id_accessDoctos       
    // WHERE id_documento = '$id_documento' and id_usuarioNuevo='$id_usuario'";
    // $count_total=sqlsrv_query($cnx,$count_f_total);
    // $total=sqlsrv_fetch_array($count_total);
    // // datos usuario nuevo
    // $us="select * from usuarionuevo
    //      where id_usuarioNuevo=$id_usuario";
    //     $usu=sqlsrv_query($cnx,$us);
    //     $usuario=sqlsrv_fetch_array($usu);
    ?>
    
    @extends('layouts.index')
    @section('title')
        Buscador
    @endsection
    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="mx-5" style="min-height: 70vh">
            <h1 class="text-shadow">Fichas catastrales Fidi</h1>
            <h4 class="text-shadow"><img src="https://img.icons8.com/fluency/48/null/gender-neutral-user.png" />
                {{-- Mi perfil {{ $usuario['nombre'].' '.$usuario['app'].' '.$usuario['apm']}}</h4> --}}
            <hr class="border border-dark">
            <div class="row">
                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <img src="https://img.icons8.com/color/30/null/add--v1.png" /> Nuevo
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Toluca Predial</h5>
                            <p class="card-text">Crear una nueva ficha catastral</p><br>
                            {{-- Boton del modal subir foto --}}
                            <form action="{{ route('formImg') }}" method="post" novalidate>
                                @csrf
                                <input type="hidden" name="id_documento" value="{{$id_documento}}">
                            <button type="submit" class="btn btn-success" style="margin-bottom: 3%" data-bs-toggle="modal"
                                data-bs-target="#subirfoto">
                                <i class="fas fa-file"></i> subir fotos
                            </button>
                            </form>
                            {{-- Boton del modal --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fas fa-file"></i> Ir a nueva ficha
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <img src="https://img.icons8.com/fluency/30/null/today.png" /> Mis fichas
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">Fichas del día <span style="color: black" class="badge badge-success">{{$now['count']}}</span></h5>
                            <p class="card-text">Fichas creadas el dia de hoy <br><?php echo date('d/m/Y'); ?></p>
                            <form action="{{ route('viewFichas') }}" method="post" novalidate>
                                @csrf
                                <input type="hidden" name="id_usuario" value="{{$id_usuario}}">
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-bottom: 3%">
                                <i class="fas fa-eye"></i> Ir a ver mis fichas
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <img src="https://img.icons8.com/color/30/null/order-history.png" /> Mi historial
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Total de fichas <span style="color: black" class="badge badge-warning">{{$total['count']}}</span></h5>
                            <p class="card-text">Total de fichas generadas al dia <br><?php echo date('d/m/Y'); ?></p>
                            
                            <a href="{{route('viewFichasall',['id_usuario'=>$id_usuario])}}" class="btn btn-primary btn-sm" style="margin-bottom: 3%">ir a ver mis fichas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear ficha</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('form') }}" method="post" novalidate>
                        @csrf
    
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cuenta">Clave Catastral: *</label>
                                <input type="hidden" value="{{$id_documento}}" name="id_documento">
                                <input type="hidden" value="{{$id_usuario}}" name="id_usuario">
                                <input type="text" class="form-control" name="cuenta" id="mysearch"
                                    placeholder="Ingresa una clave">
                            </div>
                            {{-- Contenedor de las consultas por jquery --}}
                            <div id="showlist"></div>
                        </div>
                        <div class="modal-footer">
                            {{-- <a href="{{route('form')}}" type="button" id="buttonRedirect" class="btn btn-primary">
                                <i class="fas fa-drafting-compass"></i>
                                    Ir a crear ficha
                            </a> --}}
                            <button type="submit" id="buttonRedirect" class="btn btn-primary">ir a crear ficha</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-chevron-left"></i> Cancelar</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
    @endsection
    @section('js')
        {{-- Script de la ruta y del buscador --}}
        <script src="{{ asset('js/search.js') }}" type="module"></script>
        <script src="{{ asset('js/search_s.js') }}" type="module"></script>
        
    @endsection
    <?php 
    // } 
    // else{
    //     echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/accesDoctos.php">';
    // }
    }
    else{
        echo '<meta http-equiv="refresh" content="1,url=https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/php/logout.php">';
    }
}

    ?>