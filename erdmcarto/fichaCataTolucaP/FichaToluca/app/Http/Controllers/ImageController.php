<?php

namespace App\Http\Controllers;

use App\Models\imgFicha;
use Aws\S3\S3Client;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request)
    {
       
        header('Location: ../../../CargaFotosCatTolucaP/cargaFotosTolucaPCuenta.php');
        die();
        
    }
    
   
}
