<?php
//inicio la sesion
session_start();
?>
@extends('layouts.index')
@section('title')
    Formulario
@endsection
@section('content')
    <div class="container position-static">
        @foreach ($datos as $item)
        <h1 class="text-shadow">Nueva Ficha Catastral</h1>
        <h5 class="text-shadow"><img src="https://img.icons8.com/color/48/null/new-by-copy.png" /> Cuenta Actual [{{$item->CLAVE_CATA}}]
            Toluca Predial
        </h5>
        <hr />
        <form action="{{ route('guardar-ficha') }}" method="post" novalidate>
            @csrf
            
                {{-- contnedor uno --}}
                <div class="row rounded tarjet_content py-4 px-2 m-2">
                    <p class="rounded bg-info text-white btn_info_p">
                        <img src="https://img.icons8.com/fluency/25/null/search.png" />
                        Cedula de Investigación Catastral
                    </p>
                    {{-- linea 1 del form del primer contenedor --}}
                    <div class="row">
                        <input type="hidden" value="{{$id_documento}}" name="id_documento">
                        <input type="hidden" value="{{$id_usuario}}" name="id_usuario">
                        {{-- input folio --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="folio">Folio: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('folio')
                            border border-danger rounded-2
                            @enderror"
                                    name="folio" placeholder="Folio" value="{{ old('folio') }}">
                                @error('folio')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input fecha --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="fecha">Fecha: *</label>
                                <input type="date"
                                    class="form-control form-control-sm
                            @error('fecha')
                            border border-danger rounded-2
                            @enderror"
                                    name="fecha" value="{{ old('fecha') }}">
                                @error('fecha')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input motivo --}}
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label for="motivo">Motivo: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('motivo')
                            border border-danger rounded-2
                            @enderror"
                                    name="motivo" placeholder="Motivo" value="Actualización de Información">
                                @error('motivo')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input clave catastral --}}
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label for="clavec">Clave Catastral: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('clavec')
                            border border-danger rounded-2
                            @enderror"
                                    name="clavec" placeholder="Clave Catastral" value="{{ $item->CLAVE_CATA }}" readonly>
                                @error('clavec')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- linea 2 del form del primer contenedor --}}
                    <div class="row">
                        {{-- input calle --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="calle">Calle: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('calle')
                            border border-danger rounded-2
                        @enderror"
                                    name="calle" placeholder="Calle" value="{{ $item->DOMICILIO }}">
                                @error('calle')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input numext --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="numext">Núm. Ext: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('numext')
                            border border-danger rounded-2
                        @enderror"
                                    name="numext" placeholder="N. Ext" value="{{ $item->NUMEXT }}">
                                @error('numext')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input numint --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="numint">Núm. Int: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('numint')
                            border border-danger rounded-2
                        @enderror"
                                    name="numint" placeholder="Núm. Int" value="{{ $item->NUMINTP }}">
                                @error('numint')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input cp --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="cp">C.P: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('cp')
                            border border-danger rounded-2
                        @enderror"
                                    name="cp" placeholder="Codigo Postal" value="{{ $item->CODPOST }}">
                                @error('cp')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- INPUT COLONIA --}}
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label for="colonia">Col. Fracc. Barrio: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('colonia')
                            border border-danger rounded-2
                        @enderror"
                                    name="colonia" placeholder="Col. Fracc. Barrio" value="{{ $item->COLONIA }}">
                                @error('colonia')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- linea 3 del form del primer contenedor --}}
                    <div class="row">
                        {{-- input localidad --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="localidad">Localidad: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('localidad')
                            border border-danger rounded-2
                        @enderror"
                                    name="localidad" placeholder="Localidad" value="{{ old('localidad') }}">
                                @error('localidad')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input municiopio --}}
                        <div class="col-md-2">
                            <div class="md-form form-group">
                                <label for="municipio">Municipio: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('municipio')
                            border border-danger rounded-2
                        @enderror"
                                    name="municipio" placeholder="Municipio" value="TOLUCA DE LERDO">
                                @error('municipio')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input regimen --}}
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label for="regimen">Régimen de Propiedad: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('regimen')
                            border border-danger rounded-2
                        @enderror"
                                    name="regimen" placeholder="Régimen de Propiedad" value="{{ $item->REGPROP }}">
                                @error('regimen')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input uso --}}
                        <div class="col-md-4">
                            <div class="md-form form-group">
                                <label for="uso">Uso de Suelo: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                        @error('uso')
                            border border-danger rounded-2
                        @enderror"
                                    name="uso" placeholder="Uso de Suelo" value="{{ $item->USO }}">
                                @error('uso')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- linea separadora --}}
                <hr class="hrIzq" />
                {{-- contenedor 2 --}}
                <div class="row rounded tarjet_content py-4 px-2 m-2">
                    <p class="rounded bg-info text-white btn_info_p">
                        <img src="https://img.icons8.com/fluency/25/null/reservation-2--v2.png" />
                        Datos del propietario o poseedor
                    </p>
                    {{-- linea 1 del segundo contenedor --}}
                    <div class="row">
                        {{-- input propietario --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="propietario">Propietario: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('propietario')
                            border border-danger rounded-2
                            @enderror"
                                    name="propietario" placeholder="Nombre del propietario"
                                    value="{{ $item->PMNPROP }}">
                                @error('propietario')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input rfc --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="rfc">RFC: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('rfc')
                            border border-danger rounded-2
                            @enderror"
                                    name="rfc" placeholder="RFC" value="{{ $item->RFC }}">
                                @error('rfc')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input curp --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="curp">Curp: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('curp')
                            border border-danger rounded-2
                            @enderror"
                                    name="curp" placeholder="Curp"value="{{ $item->CURP }}">
                                @error('curp')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input calle2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="calle2">Calle: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('calle2')
                            border border-danger rounded-2
                            @enderror"
                                    name="calle2" placeholder="Calle" value="{{$seccionadas->Calle }}">
                                @error('calle2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- linea 2 del contenedor 2 --}}
                    <div class="row">
                        {{-- input numext2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="numext2">Núm. Ext: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('numext2')
                            border border-danger rounded-2
                            @enderror"
                                    name="numext2" placeholder="N. Ext" value="{{ $item->NUMEXT }}">
                                @error('numext2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input numint2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="numint2">Núm. Int: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('numint2')
                            border border-danger rounded-2
                            @enderror"
                                    name="numint2" placeholder="Núm. Int" value="{{ $item->NUMINTP }}">
                                @error('numint2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input telefono --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="telefono">Teléfono: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('telefono')
                            border border-danger rounded-2
                            @enderror"
                                    name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input estado --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="estado">Estado: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('estado')
                            border border-danger rounded-2
                            @enderror"
                                    name="estado" placeholder="Estado" value="{{ old('estado') }}">
                                @error('estado')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- linea 3 del contenedor 2 --}}
                    <div class="row">
                        {{-- input municipio2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="municipio2">Municipio: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('municipio2')
                            border border-danger rounded-2
                            @enderror"
                                    name="municipio2" placeholder="Municipio" value="TOLUCA">
                                @error('municipio2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input localidad2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="localidad2">Localidad: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('localidad2')
                            border border-danger rounded-2
                            @enderror"
                                    name="localidad2" placeholder="Localidad" value="{{ old('localidad2') }}">
                                @error('localidad2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input cp2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="cp2">C.P: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('cp2')
                            border border-danger rounded-2
                            @enderror"
                                    name="cp2" placeholder="Codigo Postal" value="{{ old('cp2') }}">
                                @error('cp2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- input colonia2 --}}
                        <div class="col-md-3">
                            <div class="md-form form-group">
                                <label for="colonia2">Col. Fracc. Barrio: *</label>
                                <input type="text"
                                    class="form-control form-control-sm
                            @error('colonia2')
                            border border-danger rounded-2
                            @enderror"
                                    name="colonia2" placeholder="Col. Fracc. Barrio" value="{{$seccionadas->direccion3 }}">
                                @error('colonia2')
                                    <div class="text-danger text-center text-footer">
                                        *Campo requerido
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="hrIzq" />
                {{-- tabla terreno actual --}}
                <div>
                    <table class="table table-hover table-sm table-dark my-2">
                        <thead class="table-dark">

                            <tr>
                                <th colspan="24" style="text-align:center;">DATOS DEL TERRENO ACTUALES</th>
                            </tr>
                            <tr>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Sup.
                                    Terreno (m2)</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Frente
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Fondo
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Posicion
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Topografía</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Irreg.
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Área
                                    Insc.</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Sup.
                                    Aprov.</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Factor
                                    Aplicable</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    B.V.
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    A.H.
                                </td>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda1">
                                    {{ number_format($tabla[0]->SUPTERRTOT, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda2">
                                    {{ number_format($tabla[0]->FRENTE, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda3">
                                    {{ number_format($tabla[0]->NFRENTE, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda4">
                                    {{ number_format($tabla[0]->FONDO, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda5">
                                    {{ number_format($tabla[0]->NFFONDO, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda6">
                                    {{ number_format($tabla[0]->UBICACION, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;" id="celda7">
                                    {{ number_format($tabla[0]->NFUBIC, 2) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda8">
                                    {{ number_format($tabla[0]->NFTOPOGR, 2) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda9">
                                    {{ number_format($tabla[0]->NFIRREG, 5) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda10">
                                    {{ number_format($tabla[0]->NFAREA, 2) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda11">
                                    {{ number_format($tabla[0]->NFSUPAPR, 2) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda12">
                                    {{ number_format($FA, 5) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda13">
                                    <input type="text" style="width: 80px" class="form-control " name="bh"
                                        placeholder="B.H." value="{{ old('bh') }}">
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;" id="celda14">
                                    <input type="text" style="width: 80px" class="form-control" name="ah"
                                        placeholder="A.H." value="{{ old('ah') }}">
                                </td>

                            </tr>
                            {{-- linea para pintar --}}
                            <tr>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color1" id="color"
                                        onchange="cambia_color()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color2" id="color2"
                                        onchange="cambia_color2()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color3" id="color3"
                                        onchange="cambia_color3()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color4" id="color4"
                                        onchange="cambia_color4()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color5" id="color5"
                                        onchange="cambia_color5()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color6" id="color6"
                                        onchange="cambia_color6()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color7" id="color7"
                                        onchange="cambia_color7()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color8" id="color8"
                                        onchange="cambia_color8()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color9" id="color9"
                                        onchange="cambia_color9()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color10" id="color10"
                                        onchange="cambia_color10()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color11" id="color11"
                                        onchange="cambia_color11()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color12" id="color12"
                                        onchange="cambia_color12()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color13" id="color13"
                                        onchange="cambia_color13()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="color14" id="color14"
                                        onchange="cambia_color14()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <hr class="hrDer" />
                {{-- tabla terreno actualizado --}}
                <div>
                    <table class="table table-hover table-sm table-dark my-2">
                        <thead class="table-dark">

                            <tr>
                                <th colspan="24" style="text-align:center;">DATOS DEL TERRENO ACTUALIZADO</th>
                            </tr>
                            <tr>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Sup.
                                    Terreno (m2)</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Frente
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Fondo
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Posicion
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Topografía</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Irreg.
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Área
                                    Insc.</td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    Sup.
                                    Aprov.</td>
                                
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    B.V.
                                </td>
                                <td colspan="2" scope="col" class="table-light border" style="text-align:center;">
                                    A.H.
                                </td>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda1">
                                    <input type="text" style="width: 80px" class="form-control " name="supterreno"
                                        placeholder="supterreno" value="{{ $tabla[0]->SUPTERRTOT }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda2">
                                    <input type="text" style="width: 80px" class="form-control " name="frente1"
                                        placeholder="frente1" value="{{ round($tabla[0]->FRENTE,2) }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda3">
                                    <input type="text" style="width: 80px" class="form-control " name="frente2"
                                        placeholder="frente2" value="{{ $tabla[0]->NFRENTE }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda4">
                                    <input type="text" style="width: 80px" class="form-control " name="fondo1"
                                        placeholder="fondo1" value="{{ round($tabla[0]->FONDO,2) }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda5">
                                    <input type="text" style="width: 80px" class="form-control " name="fondo2"
                                        placeholder="fondo2" value="{{ $tabla[0]->NFFONDO }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda6">
                                    <input type="text" style="width: 80px" class="form-control " name="posicion1"
                                        placeholder="posicion1" value="{{ $tabla[0]->UBICACION }}">
                                    </td>
                                <td colspan="1" class="table-light border" style="text-align:center;"id="mcelda7">
                                    <input type="text" style="width: 80px" class="form-control " name="posicion2"
                                        placeholder="posicion2" value="{{ $tabla[0]->NFUBIC }}">
                                    </td>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda8">
                                    <input type="text" style="width: 80px" class="form-control " name="topografia"
                                        placeholder="topografia" value="{{ $tabla[0]->NFTOPOGR }}">
                                    </td>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda9">
                                    <input type="text" style="width: 80px" class="form-control " name="irreg"
                                        placeholder="irreg" value="{{ $tabla[0]->NFIRREG }}">
                                    </td>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda10">
                                    <input type="text" style="width: 80px" class="form-control " name="area"
                                        placeholder="area" value="{{ $tabla[0]->NFAREA }}">
                                    </td>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda11">
                                    <input type="text" style="width: 80px" class="form-control " name="supaprov"
                                        placeholder="supaprov" value="{{ $tabla[0]->NFSUPAPR }}">
                                    </td>
                                
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda13">
                                    <input type="text" style="width: 80px" class="form-control " name="bh2"
                                    placeholder="B.H." value="{{ old('bh2') }}"></td>
                                <td colspan="2" class="table-light border" style="text-align:center;"id="mcelda14">
                                    <input type="text" style="width: 80px" class="form-control " name="ah2"
                                    placeholder="A.H." value="{{ old('ah2') }}"></td>
                                
                                </td>
                            </tr>
                            {{-- linea para pintar --}}
                            <tr>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor1" id="mcolor"
                                        onchange="mcambia_color()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor2" id="mcolor2"
                                        onchange="mcambia_color2()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor3" id="mcolor3"
                                        onchange="mcambia_color3()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor4" id="mcolor4"
                                        onchange="mcambia_color4()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor5" id="mcolor5"
                                        onchange="mcambia_color5()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor6" id="mcolor6"
                                        onchange="mcambia_color6()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor7" id="mcolor7"
                                        onchange="mcambia_color7()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor8" id="mcolor8"
                                        onchange="mcambia_color8()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor9" id="mcolor9"
                                        onchange="mcambia_color9()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor10" id="mcolor10"
                                        onchange="mcambia_color10()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor11" id="mcolor11"
                                        onchange="mcambia_color11()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor13" id="mcolor13"
                                        onchange="mcambia_color13()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="mcolor14" id="mcolor14"
                                        onchange="mcambia_color14()">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            @endforeach
            <hr class="hrIzq" />
            {{-- valores catastrales actuales --}}
            <div>
                <table class="table table-hover table-sm table-dark my-2">
                    <thead class="table-dark">

                        <tr>
                            <th colspan="19" style="text-align:center;">VALORES CATASTRALES ACTUALES</th>
                        </tr>
                        <tr>
                            <td colspan="1" class="table-light border" style="text-align:center;">Número</td>
                            <td colspan="1" class="table-light border" style="text-align:center;">Tipología</td>
                            <td colspan="2" class="table-light border" style="text-align:center;">Superficie (ml, m2,
                                m3) </td>
                            <td colspan="1" class="table-light border" style="text-align:center;">Niveles</td>
                            <td colspan="1" class="table-light border" style="text-align:center;">Edad</td>
                            <td colspan="1" class="table-light border" style="text-align:center;">G.C.</td>
                            <td colspan="3" class="table-light border" style="text-align:center;">Factor Aplicable
                            </td>
                            <td colspan="4" class="table-light border" style="text-align:center;">Ocupación Actual
                            </td>
                            <td colspan="3" class="table-light border" style="text-align:center;">Valor Construcción
                            </td>
                            <td colspan="2" class="table-light border" style="text-align:center;">Color</td>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($valoresca as $item)
                            <tr>
                                <td id="fila1" colspan="1" class="table-light border" style="text-align:center;">
                                    {{ $i += 1 }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    {{ $item->TIPOLOGIA }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    {{ number_format($item->SUPCONS, 2) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    {{ number_format($item->NIVCONS, 0) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    {{ round($item->ANIODECONS) }}</td>
                                <td colspan="1" class="table-light border" style="text-align:center;">
                                    {{ number_format($item->ESTADOCONS, 0) }}</td>
                                <td colspan="3" class="table-light border" style="text-align:center;">
                                    {{ number_format($item->FACTORNIV, 5) }}</td>
                                <td colspan="4" class="table-light border" style="text-align:center;">{{$item->DESCRCLCAT}}</td>
                                <td colspan="3" class="table-light border" style="text-align:center;">${{ number_format($item->VALORCONS, 2) }}</td>
                                <td colspan="2" class="table-light border" style="text-align:center;">
                                    <select class="form-select text-footer" name="actualestr{{ $i }}">
                                        <option value="#FFFFFF">Blanco</option>
                                        <option value="#FDEE00">Amarillo</option>
                                        <option value="#7FD43D">Verde</option>
                                        <option value="#F5564C">Rojo</option>
                                    </select>
                                </td>
                            </tr>
                            
                        @endforeach
                        <input type="hidden" name="i" id="" value="{{$i}}">
                        <tr>
                            <td colspan="2" class="table-light border" style="text-align:center;">Construcción total
                            </td>
                            <td colspan="2" class="table-light border" style="text-align:center;">{{number_format($construccion_t->CT,2)}}</td>
                            <td colspan="6" class="table-light border" style="text-align:center;"></td>
                            <td colspan="4" class="table-light border" style="text-align:center;">Valor Construcción
                                Total </td>
                            <td colspan="5" class="table-light border" style="text-align:center;">${{number_format($construccion_t->VCT,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="table-light border" style="text-align:center;">Valor Terreno Actual
                            </td>
                            <td colspan="8" class="table-light border" style="text-align:center;">Valor Construcción
                                Actual</td>
                            <td colspan="6" class="table-light border" style="text-align:center;">Valor Catastral
                                Actual</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="table-light border" style="text-align:center;">${{number_format($valor_ta->VTERRPROP,2)}}</td>
                            <td colspan="8" class="table-light border" style="text-align:center;">${{number_format($construccion_t->VCT,2)}}</td>
                            <td colspan="6" class="table-light border" style="text-align:center;">${{number_format($valor_ca,2)}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <hr class="hrDer" />
            {{-- boton cancelar y crear ficha --}}
            <div class="d-flex gap-4 btn_info_div">
                
                <a href="{{ url()->previous() }}" type="button" class="btn bg-warning bg-gradient text-white"><img
                                src="https://img.icons8.com/fluency/30/null/cancel.png" />Cancelar</a>
                <button class="btn bg-success bg-gradient text-white">
                    <img src="https://img.icons8.com/fluency/30/null/pdf.png" />
                    Generar ficha
                </button>
            </div>
        </form>
    </div>

    {{-- Modal de  DATOS DEL TERRENO ACTUALIZADO
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DATOS DEL TERRENO ACTUALES</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('modalTerrenoActualizado') }}" method="post" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">

                            <label for="supTerrenoM2" class="form-label">supTerreno</label>
                            <input type="text" class="form-control" id="supTerrenoM2" name="supTerrenoM2">
                        </div>
                        <div class="mb-3">
                            <label for="frente1M2" class="form-label">frente1M</label>
                            <input type="text" class="form-control" id="frente1M2" name="frente1M2">
                        </div>
                        <div class="mb-3">
                            <label for="frente2M2" class="form-label">frente2M</label>
                            <input type="text" class="form-control" id="frente2M2" name="frente2M2">
                        </div>
                        <div class="mb-3">
                            <label for="fondo1M2" class="form-label">fondo1</label>
                            <input type="text" class="form-control" id="fondo1M2" name="fondo1M2">
                        </div>
                        <div class="mb-3">
                            <label for="fondo2M2" class="form-label">fondo2</label>
                            <input type="text" class="form-control" id="fondo2M2" name="fondo2M2">
                        </div>
                        <div class="mb-3">
                            <label for="posicion1M2" class="form-label">posicion1</label>
                            <input type="text" class="form-control" id="posicion1M2" name="posicion1M2">
                        </div>
                        <div class="mb-3">
                            <label for="posicion2M2" class="form-label">posicion2</label>
                            <input type="text" class="form-control" id="posicion2M2" name="posicion2M2">
                        </div>
                        <div class="mb-3">
                            <label for="topografiaM2" class="form-label">topografia</label>
                            <input type="text" class="form-control" id="topografiaM2" name="topografiaM2">
                        </div>
                        <div class="mb-3">
                            <label for="irregM2" class="form-label">irreg</label>
                            <input type="text" class="form-control" id="irregM2" name="irregM2">
                        </div>
                        <div class="mb-3">
                            <label for="areaM2" class="form-label">area</label>
                            <input type="text" class="form-control" id="areaM2" name="areaM2">
                        </div>
                        <div class="mb-3">
                            <label for="supaprobM2" class="form-label">supaprob</label>
                            <input type="text" class="form-control" id="supaprobM2" name="supaprobM2">
                        </div>
                        <div class="mb-3">
                            <label for="factorM2" class="form-label">factor</label>
                            <input type="text" class="form-control" id="factorM2" name="factorM2">
                        </div>
                        <div class="mb-3">
                            <label for="bvM2" class="form-label">bv</label>
                            <input type="text" class="form-control" id="bvM2" name="bvM2">
                        </div>
                        <div class="mb-3">
                            <label for="ahM2" class="form-label">ah</label>
                            <input type="text" class="form-control" id="ahM2" name="ahM2">
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><img
                                src="https://img.icons8.com/fluency/30/null/cancel.png" />
                            Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    {{-- Carga del modal con datos --}}
    {{-- <script src="{{ asset('js/modalTerreno.js') }}"></script> --}}
    <script src="{{ asset('js/cambiar_color.js') }}"></script>
    <script src="{{ asset('js/mcambiar_color.js') }}"></script>
@endsection
