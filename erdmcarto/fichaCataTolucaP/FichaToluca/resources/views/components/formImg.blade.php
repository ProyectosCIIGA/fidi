<?php


?>

@extends('layouts.index')
@section('title')
    Imagenes
@endsection
@section('css')
    <link href="{{ asset('css/images.css') }}" rel="stylesheet">
@endsection
@section('content')
@if (session('errorimagen'))
{{-- Muestra de sweetalert en caso de error de petición --}}
    <script src="{{ asset('js/errorimagenes.js') }}"></script>
@endif
    <div class="jumbotron">
        <div class="jumboCenter">
            <form method="get">
                <label for="cuenta">Cuenta de la foto que quieres anexar fotos</label>
                <input type="text" name="cPredial" placeholder="Cuenta a cargar fotos">
                <button class="btn btn-primary">Buscar cuenta</button>
            </form>
        </div>
    </div>
        @if ($rowImg == 0)
        <div>
            <?php if(count(config("constant.mensajesComprobacion")) > 0){ for($i=0;$i<count(config("constant.mensajesComprobacion"));$i++){ ?>
                <p style="text-align: center; "> <span class="badge badge-warning "style="color:black !important" ><?php echo config("constant.mensajesComprobacion")[$i]; ?></span> </p>
            <?php } } ?>
        
        <p style="text-align: center;"> FOTOS PARA CUENTA:{{$cuenta}} <span class="badge badge-success">Cuenta></span> </p>
        <form action="{{ route('cargar_fotos') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="jumboCenter">
                <div class="card cardFoto">
                    <div>
                        <img class="card-img-top imgCard" src="{{ asset('img/icons/camera.jpg') }}">
                    </div>
                    <div class="card-body cardEnBloque">
                        <div>
                            <label for="dz1" class="btn btn-success">Cargar archivos</label>
                        </div>
                        <div class="preview">
                            <p>Sin archivos seleccionados</p>
                        </div>
                        <input type="hidden" name="cuenta" value="{{$cuenta}}">
                        <input class="" id="dz1" type="file" name="foto1[]" multiple hidden>
                    </div>
                </div>
            </div>
            <div class="jumboCenter">
                <button type="submit" class="btn btn-success" name="cargarFotos">Cargar fotos</button>
            </div>
        </form>
    </div>
        @endif
        @if ($rowImg!=0)
            
    <div class="my-5 mx-5">
        <p style="text-align: center;"> FOTOS PARA CUENTA: <span class="badge badge-info">Cuenta</span> </p>
        <h3 style="text-shadow: 0px 0px 2px #717171;"><img
                src="https://img.icons8.com/external-prettycons-flat-prettycons/47/null/external-picture-multimedia-prettycons-flat-prettycons.png" />
            Evidencia Fotográfica</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Ortofoto año 2016*</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-success">Antecedente _1</span>
                    <span class="badge bg-info" onClick="verFoto()"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_1" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Ortofoto año 2022*</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-success">Actual _2</span>
                    <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_2" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua*</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-warning">Año 2022 _3</span>
                    <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_3" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-warning">Año 2022 _4</span>
                    <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_4" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-warning">Año 2022 _5</span>
                    <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_5" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form form-group">
                    <label for="exampleFormControlFile1">Fotografia Oblicua</label>&nbsp;&nbsp;&nbsp;<span
                        class="badge bg-warning">Año 2022 _6</span>
                    <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
                    <input type="file" class="form-control-file" name="_6" data-toggle="tooltip"
                        data-placement="top" title="Adjuntar archivo de imagen .png" accept=".png">
                </div>
            </div>
        </div>
        <hr>
        <div class="md-form form-group">
            <label for="exampleFormControlFile1">Croquis de construcciones* &nbsp;&nbsp;&nbsp;<span
                    class="badge bg-success">Croquis con Cotas _7</span>
            </label>
            <span class="badge bg-info" onClick="verFoto('')"> Ver foto </span>
            <input type="file" class="form-control-file" name="_7" data-toggle="tooltip" data-placement="top"
                title="Adjuntar archivo de imagen .png" accept=".png">
        </div>
        {{-- Modal de visor --}}
        <div class="modal fade" id="visorFoto" tabindex="-1" role="dialog" aria-labelledby="visor1"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visor1">Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visorImg">
                            <img id="imgVisorFull" src="" alt="Sin Foto">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
@endsection
@section('js')
    <script src="{{ asset('js/images.js') }}"></script>
@endsection
