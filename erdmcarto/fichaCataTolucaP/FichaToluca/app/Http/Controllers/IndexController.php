<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index($id_documento){
       
// dd($id_documento);
        return view('components.search',['id_documento'=>$id_documento]);
    }
    public function show(Request $request)
    {
        //Se optiene el valor 
        $data = trim($request->valor);
        //Se busca la cuenta en base  la cuenta
        $result = DB::table('GC203T05')
            ->select(['CLAVE_CATA'])
            ->where('CLAVE_CATA', 'like', $data)->limit(5)
            ->get();
        //Retorna una respuesta de tipo json con un estado y el resultado de la consulta
        return response()->json([
            "estado" => 1,
            "result" => $result,

        ]);
    }

}
