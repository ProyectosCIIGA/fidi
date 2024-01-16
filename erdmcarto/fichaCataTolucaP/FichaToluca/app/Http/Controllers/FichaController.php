<?php

namespace App\Http\Controllers;

use App\Models\accessDoctos;
use App\Models\colorVCActuales;
use App\Models\fichaToluca;
use App\Models\GC203T04;
use App\Models\GC203T05;
use App\Models\GC203T06;
use App\Models\imgFicha;
use App\Models\callesSeccionadas;
use App\Models\cartomaps;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
// use Illuminate\Pagination\Paginator; 

class FichaController extends Controller
{
    // use WithPagination;
    public function index(Request $request)
    {

        $datos = GC203T05::join('GC203T04', 'GC203T05.CLAVE_CATA', '=', 'GC203T04.CLAVE_CATA')
            ->join('cat_regimen', 'GC203T04.REGPROP', '=', 'cat_regimen.regimen')
            ->join('cat_uso', 'GC203T05.DESTINO', '=', 'cat_uso.uso')
            ->select([
                'GC203T05.CLAVE_CATA', 'GC203T04.DOMICILIO', 'GC203T04.NUMEXT', 'GC203T05.NUMINTP', 'GC203T04.CODPOST',
                'GC203T04.COLONIA', 'cat_regimen.descripcion as REGPROP', 'cat_uso.descripcion as USO',
                'GC203T05.PMNPROP', 'GC203T05.RFC', 'GC203T05.CURP', 'GC203T05.CLAVE_CATA'
            ])
            ->where('GC203T05.CLAVE_CATA', $request->cuenta)->get();
            //obtenemos los datos de la tabla callesseccionadas$
        $seccionadas = callesSeccionadas::select([
            'Calle','direccion3'
        ])
        ->where('ClaveCatastral',$request->cuenta)
        ->first();
        $tabla = GC203T04::select([
            'SUPTERRTOT', 'FRENTE', 'NFRENTE', 'FONDO', 'NFFONDO', 'UBICACION',
            'NFUBIC', 'NFTOPOGR', 'NFIRREG', 'NFAREA', 'NFSUPAPR'
        ])
            ->where('GC203T04.CLAVE_CATA', $request->cuenta)->get();
        //guardaremos 
        $valoresca=DB::select('select concat(GC203T06.USO,GC203T06.CLASECONST,GC203T06.CATEGCONST) AS TIPOLOGIA,
        GC203T06.SUPCONS,
        GC203T06.NIVCONS,
        GC203T06.ANIODECONS,
        GC203T06.ESTADOCONS,
        GC203T06.FACTORNIV,
        GC203T06.VALORCONS,
        cat_ocupaciones.DESCRCLCAT
        from cat_ocupaciones,GC203T06 where cat_ocupaciones.USO = GC203T06.USO and cat_ocupaciones.CLASECONST = GC203T06.CLASECONST and 
        cat_ocupaciones.CATEGCONST = GC203T06.CATEGCONST and GC203T06.CLAVE_CATA=?', [$request->cuenta]);

       
        //CONSTRUCCION TOTAL
        $construccion_t = GC203T06::select([
            DB::raw("sum(SUPCONS) AS CT"),
            DB::raw("sum(VALORCONS) AS VCT")
        ])
            ->where('CLAVE_CATA', $request->cuenta)->first();
        //VALOR TERRENO ACTUAL
        $valor_ta = GC203T05::select([
            'VTERRPROP'
        ])
            ->where('CLAVE_CATA', $request->cuenta)->first();
        //VALOR CATASTRAL ACTUAL
        $valor_ca = $valor_ta->VTERRPROP + $construccion_t->VCT;
        $i = 0;
        $FA = $tabla[0]->NFRENTE * $tabla[0]->NFFONDO * $tabla[0]->NFUBIC * $tabla[0]->NFTOPOGR * $tabla[0]->NFIRREG * $tabla[0]->NFAREA * $tabla[0]->NFSUPAPR;
        return view('components.formCataToluca', ['seccionadas'=>$seccionadas,'datos' => $datos, 'tabla' => $tabla, 'FA' => $FA, 'valoresca' => $valoresca, 'i' => $i, 'construccion_t' => $construccion_t, 'valor_ta' => $valor_ta, 'valor_ca' => $valor_ca, 'id_documento' => $request->id_documento, 'id_usuario' => $request->id_usuario]);
    }
    public function store(Request $request)
    {
        // dd('hola');
        // $request->validate([
        //     'folio' => ['required'],
        //     'fecha' => ['required'],
        //     'motivo' => ['required'],
        //     'clavec' => ['required'],
        //     'calle' => ['required'],
        //     'numext' => ['required'],
        //     'numint' => ['required'],
        //     'cp' => ['required'],
        //     'colonia' => ['required'],
        //     'localidad' => ['required'],
        //     'municipio' => ['required'],
        //     'regimen' => ['required'],
        //     'uso' => ['required'],
        //     'propietario' => ['required'],
        //     'rfc' => ['required'],
        //     'curp' => ['required'],
        //     'calle2' => ['required'],
        //     'numext2' => ['required'],
        //     'numint2' => ['required'],
        //     'telefono' => ['required'],
        //     'estado' => ['required'],
        //     'municipio2' => ['required'],
        //     'localidad2' => ['required'],
        //     'cp2' => ['required'],
        //     'colonia2' => ['required'],

        // ]);
        // dd($request->all());
        //validamos si la cuenta ya tiene una ficha creada





        $count = fichaToluca::where('clavec', $request->clavec)
            ->count();
        //si existe
        if ($count != 0) {
            //eliminamos el registro
            $deleted = fichaToluca::where('clavec', $request->clavec)->delete();
        }
        //declaramos un nuevo registro
        $registrar = new fichaToluca();
        $registrar->folio = $request->folio;
        $registrar->fecha = $request->fecha;
        $registrar->motivo = $request->motivo;
        $registrar->clavec = $request->clavec;
        $registrar->calle1 = $request->calle;
        $registrar->numext1 = $request->numext;
        $registrar->numint1 = $request->numint;
        $registrar->cp1 = $request->cp;
        $registrar->colonia1 = $request->colonia;
        $registrar->localidad = $request->localidad;
        $registrar->municipio1 = $request->municipio;
        $registrar->regimen = $request->regimen;
        $registrar->uso = $request->uso;
        $registrar->propietario = $request->propietario;
        $registrar->rfc = $request->rfc;
        $registrar->curp = $request->curp;
        $registrar->calle2 = $request->calle2;
        $registrar->numext2 = $request->numext2;
        $registrar->numint2 = $request->numint2;
        $registrar->telefono = $request->telefono;
        $registrar->estado = $request->estado;
        $registrar->municipio2 = $request->municipio2;
        $registrar->localidad2 = $request->localidad2;
        $registrar->cp2 = $request->cp2;
        $registrar->colonia2 = $request->colonia2;
        $registrar->bh = $request->bh;
        $registrar->ah = $request->ah;
        $registrar->color1 = $request->color1;
        $registrar->color2 = $request->color2;
        $registrar->color3 = $request->color3;
        $registrar->color4 = $request->color4;
        $registrar->color5 = $request->color5;
        $registrar->color6 = $request->color6;
        $registrar->color7 = $request->color7;
        $registrar->color8 = $request->color8;
        $registrar->color9 = $request->color9;
        $registrar->color10 = $request->color10;
        $registrar->color11 = $request->color11;
        $registrar->color12 = $request->color12;
        $registrar->color13 = $request->color13;
        $registrar->color14 = $request->color14;
        $registrar->mcolor1 = $request->mcolor1;
        $registrar->mcolor2 = $request->mcolor2;
        $registrar->mcolor3 = $request->mcolor3;
        $registrar->mcolor4 = $request->mcolor4;
        $registrar->mcolor5 = $request->mcolor5;
        $registrar->mcolor6 = $request->mcolor6;
        $registrar->mcolor7 = $request->mcolor7;
        $registrar->mcolor8 = $request->mcolor8;
        $registrar->mcolor9 = $request->mcolor9;
        $registrar->mcolor10 = $request->mcolor10;
        $registrar->mcolor11 = $request->mcolor11;
        $registrar->mcolor12 = $request->mcolor12;
        $registrar->mcolor13 = $request->mcolor13;
        $registrar->mcolor14 = $request->mcolor14;
        $registrar->supterreno = $request->supterreno;
        $registrar->frente1 = $request->frente1;
        $registrar->frente2 = $request->frente2;
        $registrar->fondo1 = $request->fondo1;
        $registrar->fondo2 = $request->fondo2;
        $registrar->posicion1 = $request->posicion1;
        $registrar->posicion2 = $request->posicion2;
        $registrar->topografia = $request->topografia;
        $registrar->irreg = $request->irreg;
        $registrar->area = $request->area;
        $registrar->supaprov = $request->supaprov;
        $registrar->bh2 = $request->bh2;
        $registrar->ah2 = $request->ah2;
        $registrar->save();



        //validamos si la tabla valores catastrales actuales ya tiene color
        $coun_vca = colorVCActuales::where('clavec', $request->clavec)
            ->count();
        if ($coun_vca != 0) {
            //eliminamos el registro
            $deleted_vca = colorVCActuales::where('clavec', $request->clavec)->delete();
        }
        // dd($request->actualestr.3);
        //declaramos un nuevo registro

        for ($i = 1; $i <= $request->i; $i++) {
            $registrar_vca = new colorVCActuales();
            $dato = 'actualestr' . $i;
            $registrar_vca->numero = $i;
            $registrar_vca->clavec = $request->clavec;
            $registrar_vca->color = $request->$dato;
            $registrar_vca->save();
        }



        if ($registrar->save()) {

            return '<script type="text/javascript">window.open("ficha/' . $request->clavec . '/' . $request->id_documento . '/' . $request->id_usuario . '")</script>' .
            redirect()->action(
                    [IndexController::class, 'index']
            )->with('id_documento',$request->id_documento);
            // return redirect()->route('ficha', ['clavec' => $request->clavec, 'id_documento' => $request->id_documento, 'id_usuario' => $request->id_usuario]);
            // return route('ficha', ['clavec' => $request->clavec]);

        }
    }
    public function ficha($clavec, $id_documento, $id_usuario)
    {
        
        require public_path("php/cnx.php");
        require public_path("vendor/autoload.php");
      
        //gatos nenerales
        $datos = fichaToluca::select([
            'folio',
            'fecha',
            'motivo',
            'clavec',
            'calle1',
            'numext1',
            'numint1',
            'cp1',
            'colonia1',
            'localidad',
            'municipio1',
            'regimen',
            'uso',
            'propietario',
            'rfc',
            'curp',
            'calle2',
            'numext2',
            'numint2',
            'telefono',
            'estado',
            'municipio2',
            'localidad2',
            'colonia2',
            'cp2',
            'bh',
            'ah',
            'color1',
            'color2',
            'color3',
            'color4',
            'color5',
            'color6',
            'color7',
            'color8',
            'color9',
            'color10',
            'color11',
            'color12',
            'color13',
            'color14',
            'mcolor1',
            'mcolor2',
            'mcolor3',
            'mcolor4',
            'mcolor5',
            'mcolor6',
            'mcolor7',
            'mcolor8',
            'mcolor9',
            'mcolor10',
            'mcolor11',
            'mcolor12',
            'mcolor13',
            'mcolor14',
            'supterreno',
            'frente1',
            'frente2',
            'fondo1',
            'fondo2',
            'posicion1',
            'posicion2',
            'topografia',
            'irreg',
            'area',
            'supaprov',
            'factoraplicable',
            'bh2',
            'ah2'
        ])
            ->where('clavec', $clavec)->first();

            $vcactuales=DB::select('select concat(GC203T06.USO,GC203T06.CLASECONST,GC203T06.CATEGCONST) AS TIPOLOGIA,
        GC203T06.SUPCONS,
        GC203T06.NIVCONS,
        GC203T06.ANIODECONS,
        GC203T06.ESTADOCONS,
        GC203T06.FACTORNIV,
        GC203T06.VALORCONS,
        cat_ocupaciones.DESCRCLCAT
        from cat_ocupaciones,GC203T06 where cat_ocupaciones.USO = GC203T06.USO and cat_ocupaciones.CLASECONST = GC203T06.CLASECONST and 
        cat_ocupaciones.CATEGCONST = GC203T06.CATEGCONST and GC203T06.CLAVE_CATA=?', [$clavec]);

       
        $vcactuales_color = colorVCActuales::select([
            'numero',
            'color'
        ])
            ->where('clavec', $clavec)->orderby('numero')->get();
        //datos del terreno actuales
        $tabla1 = GC203T04::select([
            'SUPTERRTOT', 'FRENTE', 'NFRENTE', 'FONDO', 'NFFONDO', 'UBICACION',
            'NFUBIC', 'NFTOPOGR', 'NFIRREG', 'NFAREA', 'NFSUPAPR'
        ])
            ->where('GC203T04.CLAVE_CATA', $clavec)->first();
        //factor aplicable
        $FA = $tabla1->NFRENTE * $tabla1->NFFONDO * $tabla1->NFUBIC * $tabla1->NFTOPOGR * $tabla1->NFIRREG * $tabla1->NFAREA * $tabla1->NFSUPAPR;
        //CONSTRUCCION TOTAL
        $construccion_t = GC203T06::select([
            DB::raw("sum(SUPCONS) AS CT"),
            DB::raw("sum(VALORCONS) AS VCT")
        ])
            ->where('CLAVE_CATA', $clavec)->first();
        //VALOR TERRENO ACTUAL
        $valor_ta = GC203T05::select([
            'VTERRPROP'
        ])
            ->where('CLAVE_CATA', $clavec)->first();
        //VALOR CATASTRAL ACTUAL
        $valor_ca = $valor_ta->VTERRPROP + $construccion_t->VCT;
        $i = 0;
        //VALIDAR SI TIENE FOTOS
        $countfotos = imgFicha::where('cuentaPredial', $clavec)->count();
        if ($countfotos != 0) {
            //consultar fotos
            $fotos = imgFicha::select([
                'urlFoto_1',
                'urlFoto_2',
                'urlFoto_3',
                'urlFoto_4',
                'urlFoto_5',
                'urlFoto_6',
                'urlFoto_7'
            ])
                ->where('cuentaPredial', $clavec)->first();
                // dd($fotos);
        } else {

            //consultar fotos
            $fotos = 0;
        }
        //    dd($fotos->urlFoto_6);

        $pdf = Pdf::loadView('pdf.fichaToluca', ['vcactuales' => $vcactuales, 'vcactuales_color' => $vcactuales_color, 'i' => $i, 'datos' => $datos, 'tabla1' => $tabla1, 'FA' => $FA, 'construccion_t' => $construccion_t, 'valor_ta' => $valor_ta, 'valor_ca' => $valor_ca, 'fotos' => $fotos, 'countfotos' => $countfotos, 'clavec' => $clavec]);
        //aumentamos la ficha al usuario
       


        $sql_id_accessDoctos = "SELECT id_accessDoctos FROM accessDoctos     
 WHERE id_documento = '$id_documento' and id_usuarioNuevo='$id_usuario'";
        $cnx_sql = sqlsrv_query($cnx, $sql_id_accessDoctos);
        $id_accessDoctos = sqlsrv_fetch_array($cnx_sql);
        // dd($id_accessDoctos['id_accessDoctos'],date('d-m-Y'),date('h:i:s'),date('d'));
        $id_accessDoctos = $id_accessDoctos['id_accessDoctos'];
        $fecha = date('d-m-Y');
        $hora = date('h:i:s');
        $dia = date('d');
        $nombreFile = $clavec . ".pdf";
        $urlFile = "urlFile";
        //Donde guardar el documento
        $rutaGuardado = public_path("fichas\\" . $nombreFile);
        //validamos si ya tiene un pdf creado con esa cuenta
        $sql_count_nombreFile = "SELECT count(id_doctoCreado) as count FROM doctoCreado     
 WHERE nombreFile = '$nombreFile'";
        $cnx_count_nombreFile = sqlsrv_query($cnx, $sql_count_nombreFile);
        $count_nombreFile = sqlsrv_fetch_array($cnx_count_nombreFile);
 //guardar archivo
//  $s3 = S3Client::factory([
//     'version' => '2006-03-01',
//     'region' => 'us-east-1',
//     'credentials' => [
//         'key' => 'AKIAQAVQA6VN3G4QA5GC',
//         'secret' => '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',
//     ]
// ]);


        //Renderiza el archivo primero
        $pdf->render();
        //Guardalo en una variable
        $output = $pdf->output();
        
        
        
        $archivo="toluca/pdf/".$nombreFile;
        try{
            
            // if (file_exists($rutaGuardado)) {
                
            //     $archivoSubir = $s3->putObject([
            //         'Bucket' => 'fichascatas',
            //         'Key' => $archivo,
            //         'SourceFile' => $rutaGuardado
            //     ]);
            //     dd($clavec);
                
    
            //     unlink($rutaGuardado);
            // }
            
            
            
                // $command = $s3->getCommand('GetObject', array(
                //     'Bucket' => 'fichascatas',
                //     'Key' => $archivo,
                // ));
            
                // $signedUrl = $command->createPresignedUrl('+8 years');
                // // $request = $s3->createPresignedRequest($command, '+200 minutes');
            
                // if($signedUrl){
                //     if ($count_nombreFile['count'] != 0) {
                //         $ficha = "update doctoCreado set fecha='$fecha',hora='$hora',dia=' $dia',urlFile='$signedUrl' where nombreFile = '$nombreFile'";
                //         //eliminar el documento en public
                        
                //     } else {
                //         $ficha = "insert into doctoCreado (id_accessDoctos,fecha,hora,dia,nombreFile,urlFile) values ('$id_accessDoctos','$fecha',' $hora',' $dia','$nombreFile','$signedUrl')";
                //     }
                //     sqlsrv_query($cnx, $ficha);
                //     return $pdf->stream();
                // }else {
                //     return back()->with('errorsubirficha', 'mensaje');
                // }
                $signedUrl='https://gallant-driscoll.198-71-62-113.plesk.page/cartomaps/erdmcarto/fichaCataTolucaP/FichaToluca/public/fichas/'.$nombreFile;

                     if ($count_nombreFile['count'] != 0) {
                        if (file_exists($rutaGuardado)) {
                        unlink($rutaGuardado);
                        }
                        file_put_contents($rutaGuardado, $output);
                        $ficha = "update doctoCreado set fecha='$fecha',hora='$hora',dia=' $dia',urlFile='$signedUrl' where nombreFile = '$nombreFile'";
                        //eliminar el documento en public
                        
                    } else {
                        $ficha = "insert into doctoCreado (id_accessDoctos,fecha,hora,dia,nombreFile,urlFile) values ('$id_accessDoctos','$fecha',' $hora',' $dia','$nombreFile','$signedUrl')";
                    }
                    sqlsrv_query($cnx, $ficha);
                    return $pdf->stream();
                
        } catch (S3Exception $e) {
            dd($e);
        }
    
   
   
}

        
    
    public function viewFichasNow(Request $request){
        require public_path("php/cnx.php");
        $fecha = date('d-m-Y');
        //consultamos las fichas creadas al dia de hoy poe el usuario 
        $sql_ficha = "SELECT count(id_doctoCreado) as count FROM doctoCreado, accessDoctos     
        WHERE doctoCreado.id_accessDoctos = accessDoctos.id_accessDoctos and doctoCreado.fecha='$fecha' and  accessDoctos.id_usuarioNuevo='$request->id_usuario'";
        $cnx_sql_ficha = sqlsrv_query($cnx, $sql_ficha);
        $ficha = sqlsrv_fetch_array($cnx_sql_ficha);
        // dd($ficha);
        if($ficha['count']==0){
            return back()->with('errorviewfichasnow', 'Para realizar un mandamiento de ejecucion predial se necesita realizar un requerimiento');
        }
        else{
            return view('components.viewFichas',['id_usuario'=>$request->id_usuario,'contador'=>0]);
        }
       
    }
    public function viewFichasall($id_usuario){
        
        $count_fichas=accessDoctos::on('sqlsrv2')->join('doctoCreado as dc','accessDoctos.id_accessDoctos','=','dc.id_accessDoctos')
            
            ->where('accessDoctos.id_usuarioNuevo',$id_usuario)
            ->count();
        
        
        if($count_fichas == 0){
            return back()->with('errorviewfichasnow', 'Para realizar un mandamiento de ejecucion predial se necesita realizar un requerimiento');
        }
        else{
            $fichas=accessDoctos::on('sqlsrv2')->join('doctoCreado as dc','accessDoctos.id_accessDoctos','=','dc.id_accessDoctos')
            ->select(['id_doctoCreado','nombreFile','urlFile','hora','fecha'])
            ->where('accessDoctos.id_usuarioNuevo',$id_usuario)
            ->paginate(18);
            // $this->resetPage();
            return view('components.viewFichasall',['contador'=>0,'fichas'=>$fichas]);
        }
       
    }
}
