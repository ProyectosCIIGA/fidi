<?php
//inicio la sesion
session_start();
require public_path("php/cnx.php");
    $fecha = date('d-m-Y');
        $sql_ficha = "SELECT id_doctoCreado,nombreFile,urlFile,hora,accessDoctos.id_documento FROM doctoCreado, accessDoctos     
        WHERE doctoCreado.id_accessDoctos = accessDoctos.id_accessDoctos and doctoCreado.fecha='$fecha' and accessDoctos.id_usuarioNuevo='$id_usuario'";
        $cnx_sql_ficha = sqlsrv_query($cnx, $sql_ficha);
        $ficha = sqlsrv_fetch_array($cnx_sql_ficha);
?>
@extends('layouts.index')
@section('title')
    Fichas Del Dia
@endsection
@section('content')
<div class="row" style="min-height: 70vh">
    <div class="col-md-6">
        <h1 class="text-shadow">Fichas generadas</h1>
        <table class="table table-dark table-hover table-sm">
            <thead>
                <tr>
                    <th style="text-align:center;">Num.</th>
                    <th style="text-align:center;">Ficha</th>
                    <th style="text-align:center;">Hora de creación</th>
                    <th style="text-align:center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($ficha as $item) --}}
                <?php do{ ?>
                <tr>
                    <td class="table-light">{{$contador+=1}}</td>
                    <td class="table-light">{{$ficha['nombreFile']}}</td>
                    <td class="table-light">{{$ficha['hora']}}</td>
                    <td class="table-light">
                            <input type="hidden" name="url" id="ur[{{$contador}}]" value="{{$ficha['urlFile']}}">
                            <button class="btn" type="submit" onclick="view({{$contador}})"><img src="https://img.icons8.com/fluency/30/null/pdf-2.png"/></button>
                   </td>
                </tr>
                <?php } while($ficha=sqlsrv_fetch_array($cnx_sql_ficha)); ?>
                {{-- @endforeach --}}
            </tbody>
        </table>
        <a style="width:20 px;" href="{{ url()->previous() }}" type="button" class="btn btn-secondary"><img
                                src="https://img.icons8.com/fluency/30/null/cancel.png" />Regresar</a>
    </div>
    
    <div class=" col-md-6">
        <embed id="vistaprevia" type="application/pdf" style="min-width: 100%; height: 70vh" >
    </div>
</div>

@endsection
@section('js')
    {{-- <script src="{{ asset('js/mcambiar_color.js') }}"></script> --}}
    <script>
       function view(posicion){
           
           let valor='ur['+posicion+']';
           let url = document.getElementById( valor).value;
           document.querySelector('#vistaprevia').setAttribute('src',url);
           
       }
    </script>
@endsection