<?php
require 'vendor/autoload.php';

require('../fpdf/fpdf.php');

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$s3 = S3Client::factory([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => [
        'key' => 'AKIAQAVQA6VN3G4QA5GC',
        'secret' => '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',
    ]
]);


class PDF extends FPDF
{
          function Header()
          {
             $this->Image('../img/backFicha.jpg', 1, 1, 220);
             // Arial bold 17
             $this->SetFont('Arial','B',19);
              //195 tamaño hoja
              
              
                $this->Ln(30);
                $this->SetFont('Arial','',10);
                $this->SetTextColor(0,0,0);
                $this->Cell(13,5,'CURT: ',0,0,'L');
                $this->SetTextColor(224,0,0);
                $this->Cell(100,5, $_GET['crt'],0,0,'L');
                $this->SetTextColor(0,0,0);
                $this->Cell(83,5,utf8_decode('Fecha de Elaboración: ').date('d/m/Y'),0,1,'R');
                $this->Ln(5);
          }
// Pie de página
function Footer(){
    // Arial italic 8
    $this->SetFont('Arial','I',8);
     // Posición: a 1,5 cm del final
    $this->SetY(-15);
    $this->Cell(0,10,utf8_decode(''.$this->PageNo().'/{nb}'),0,0,'R');
    $this->SetFont('Arial','',6);
    $this->SetY(-50);
//    $this->MultiCell(195,3,utf8_decode($texto),0,'L',0);
    }
}


require "../../acnxerdm/cnx.php";
    $token=$_GET['clvCL'];
    $emp="select * from fichaResult
    where tokenResult='$token'";
    $empl=sqlsrv_query($cnx,$emp);
    $empleado=sqlsrv_fetch_array($empl);

    $fo="select * from footer";
    $foo=sqlsrv_query($cnx,$fo);
    $footer=sqlsrv_fetch_array($foo);
    $texto=$footer['text'];

$idResult=$empleado['id_fichaResult'];




	$pdf = new PDF('P', 'mm', 'Letter');
    $pdf->SetAutoPageBreak(true,10); 
	$pdf->AliasNbPages();
	$pdf->AddPage();



$file_pdf = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/aFiles_PDF/'.$empleado['CPredial'].'_FichaCatastral.pdf';
$file_headers_pdf = @get_headers($file_pdf);
if(!$file_headers_pdf || $file_headers_pdf[0] == 'HTTP/1.1 404 Not Found'){
    $archivo=$empleado['CPredial'].'_FichaCatastral.pdf';
} else{
    $archivo=$empleado['CPredial'].'_FichaCatastral.pdf';
    $ruta = '../../../fotosZapopan/aFiles_PDF/';
    unlink($ruta.$archivo);
    //$archivo=$empleado['CPredial'].'_FichaCatastral_R_'.date('is').rand(100,999).'.pdf';
}

    $pdf->SetTitle($archivo);





//****************************************************************
//$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('CLAVE UNICA'),1,1,'C',1);

$pdf->Cell(19.6,4,utf8_decode('Estado'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Región'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Mpio.'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Zona'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Loc.'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Sector'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Manzana'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Predio'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Edificio'),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode('Unidad'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(19.6,4,utf8_decode($empleado['Estado']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Region']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Municipio']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Zona']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Loc']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Sector']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Manzana']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Predio']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Edificio']),1,0,'C');
$pdf->Cell(19.6,4,utf8_decode($empleado['Unidad']),1,1,'C');
//**************************************************************

//$pdf->Ln(5);

//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DATOS DE IDENTIFICACION'),1,1,'C',1);

$pdf->Cell(98,4,utf8_decode('Clave Catastral'),1,0,'C');
$pdf->Cell(98,4,utf8_decode('Cuenta Predial'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(98,4,utf8_decode($empleado['CCatastral']),1,0,'C');
$pdf->Cell(98,4,utf8_decode($empleado['CPredial']),1,1,'C');

//*************************************************************

//*************************************************************

//$pdf->SetFont('Arial','B',9);
//$pdf->SetFillColor(217,217,217);
//$pdf->Cell(196,5,utf8_decode('DATOS DEL PROPIETARIO'),1,1,'C',1);
//
//$pdf->Cell(196,4,utf8_decode('Nombre'),1,1,'C');
//
//$pdf->SetFont('Arial','',8);
//$pdf->Cell(196,4,utf8_decode($empleado['NPropietario']),1,1,'C');
//
//
//
//
//$pdf->SetFont('Arial','B',9);
//$pdf->SetFillColor(217,217,217);
//$pdf->Cell(196,4,utf8_decode('Razón Social'),1,1,'C');
//
//$pdf->SetFont('Arial','',8);
//$pdf->Cell(196,4,utf8_decode($empleado['RSocial']),1,1,'C');



$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DATOS DEL PROPIETARIO Y/O RAZÓN SOCIAL'),1,1,'C',1);

$pdf->SetFont('Arial','',8);

if($empleado['RSocial']==NULL){
$pdf->Cell(196,4,utf8_decode(str_replace('  ','',$empleado['NPropietario'])),1,1,'C');
} else{
$pdf->Cell(196,4,utf8_decode(str_replace('  ','',$empleado['NPropietario'].' '.$empleado['RSocial'])),1,1,'C');
}





//*************************************************************


//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);

$pdf->Cell(60,4,utf8_decode('Calle'),1,0,'C');
$pdf->Cell(23,4,utf8_decode('Num. Exterior'),1,0,'C');
$pdf->Cell(23,4,utf8_decode('Num. Interior'),1,0,'C');
$pdf->Cell(60,4,utf8_decode('Colonia'),1,0,'C');
$pdf->Cell(30,4,utf8_decode('C.P.'),1,1,'C');

$pdf->SetFont('Arial','',7);
//$pdf->Cell(60,4,utf8_decode($empleado['Calle']),1,0,'C');
$pdf->Cell(60,4,utf8_decode(str_replace('  ','',$empleado['Calle'])),1,0,'C');
$pdf->Cell(23,4,utf8_decode($empleado['NumExterior']),1,0,'C');
$pdf->Cell(23,4,utf8_decode($empleado['NumInterior']),1,0,'C');
$pdf->Cell(60,4,utf8_decode($empleado['Colonia']),1,0,'C');
$pdf->Cell(30,4,utf8_decode($empleado['CP']),1,1,'C');

//*************************************************************


//$pdf->Ln(5);

//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('HISTORICO DEL PREDIO'),1,1,'C',1);

$pdf->Cell(39.2,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(39.2,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(39.2,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(39.2,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(39.2,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(39.2,4,$empleado['SupTerreno'],1,0,'C');
$pdf->Cell(39.2,4,$empleado['SupConstruccion'],1,0,'C');

$pdf->Cell(39.2,4,$empleado['VTerreno'],1,0,'C');

$pdf->Cell(39.2,4,$empleado['VConstruccion'],1,0,'C');
$pdf->Cell(39.2,4,$empleado['VCatastral'],1,1,'C');

//*************************************************************

//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->Cell(98,4,utf8_decode('Tipo de Servicio (Histórico)'),1,0,'C',1);
$pdf->Cell(98,4,utf8_decode('Giro (Histórico)'),1,1,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->Cell(98,4,utf8_decode($empleado['TServicio']),1,0,'C');
$pdf->Cell(98,4,utf8_decode($empleado['Giro']),1,1,'C');


$pdf->SetFont('Arial','B',9);
$pdf->Cell(98,4,utf8_decode('Tipo de Servicio (Actual)'),1,0,'C',1);
$pdf->Cell(98,4,utf8_decode('Giro (Actual)'),1,1,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->Cell(98,4,utf8_decode($empleado['tipoServicioA']),1,0,'C');
$pdf->Cell(98,4,utf8_decode($empleado['giroA']),1,1,'C');

//*************************************************************

//$pdf->Ln(5);

//***************************196 - 102**********************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DATOS DEL TERRENO'),1,1,'C',1);

$pdf->Cell(47,4,utf8_decode('Superficie'),1,0,'C');
$pdf->Cell(47,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Frente (m)'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Factor'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Fondo (m)'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Factor'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Posición'),1,0,'C');
$pdf->Cell(17,4,utf8_decode('Factor'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(47,4,utf8_decode($empleado['Superficie']),1,0,'C');
$pdf->Cell(47,4,utf8_decode($empleado['Valor']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['Frente']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['FactorF']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['Fondo']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['FactorFo']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['Posicion']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['FactorP']),1,1,'C');

//*************************************************************


//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);

$pdf->Cell(47,4,utf8_decode('Valor de Avenida'),1,0,'C',1);
$pdf->Cell(47,4,utf8_decode('Topografía'),1,0,'C',1);
$pdf->Cell(17,4,utf8_decode('Factor'),1,0,'C',1);
$pdf->Cell(85,4,utf8_decode('Valor Terreno'),1,1,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->Cell(47,4,utf8_decode($empleado['ValorAvenida']),1,0,'C');
$pdf->Cell(47,4,utf8_decode($empleado['Topografia']),1,0,'C');
$pdf->Cell(17,4,utf8_decode($empleado['FactorT']),1,0,'C');
$pdf->Cell(85,4,utf8_decode($empleado['ValorT']),1,1,'C');

//*************************************************************



//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->Cell(98,4,utf8_decode('Estado de Edificación'),1,0,'C',1);
$pdf->Cell(98,4,utf8_decode('Uso de Suelo'),1,1,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->Cell(98,4,utf8_decode($empleado['EstadoEdificacion']),1,0,'C');
$pdf->Cell(98,4,utf8_decode($empleado['UsoSuelo']),1,1,'C');

//*************************************************************

//$pdf->Ln(5);

//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DIFERENCIA DE CONSTRUCCION'),1,1,'C',1);

$pdf->Cell(65.3,4,utf8_decode('Construcción Histórica (m2)'),1,0,'C');
$pdf->Cell(65.3,4,utf8_decode('Construcción actual (m2)'),1,0,'C');
$pdf->Cell(65.3,4,utf8_decode('Diferencia (m2)'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(65.3,4,utf8_decode($empleado['ConstruccionH']),1,0,'C');
$pdf->Cell(65.3,4,utf8_decode($empleado['ConstruccionA']),1,0,'C');
$pdf->Cell(65.3,4,utf8_decode($empleado['Diferencia']),1,1,'C');

//*************************************************************










//$pdf->Ln(85);    //**************cambio hoja



$pdf->Ln(15);












//*********************************2017 COPIA DEL 2018***************************************************************
    $de18c="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2018'";
    $descr18c=sqlsrv_query($cnx,$de18c);
    $descript18c=sqlsrv_fetch_array($descr18c);
//***********************DESCRIPCION DE CONSTRUCCION 2017 COPIA DEL 2018*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2017'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2018c=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript18c['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18c['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18c['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript18c['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18c['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript18c['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript18c['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript18c['valConstruct']),1,1,'C');
    $i2018c++;
} while($descript18c=sqlsrv_fetch_array($descr18c));

$j2018c = 1;
$r2018c = 7 - $i2018c;
while ($j2018c <= $r2018c) {
    $j2018c++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}


if(($i2018c == 8) or ($i2018c == 9) or ($i2018c == 10)){
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Ln(5);
}



//********************fin DESCRIPCION DE CONSTRUCCION 2017 COPIA DEL 2018*****************************************
    $va18c="select * from valCatastrales
    where tokenValCatas='$token' and anio='2018'";
    $val18c=sqlsrv_query($cnx,$va18c);
    $vaCatas18c=sqlsrv_fetch_array($val18c);
//*************************************************************
//$pdf->Ln(15);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2017 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas18c['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18c['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18c['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas18c['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18c['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18c['valorCatastral']),1,1,'C');

//*****************************************************2017 COPIA DEL 2018**************************************************************************























$pdf->Ln(40);







//*********************************2018***************************************************************
    $de18="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2018'";
    $descr18=sqlsrv_query($cnx,$de18);
    $descript18=sqlsrv_fetch_array($descr18);
//***********************DESCRIPCION DE CONSTRUCCION 2018*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2018'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2018=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript18['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript18['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript18['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript18['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript18['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript18['valConstruct']),1,1,'C');
    $i2018++;
} while($descript18=sqlsrv_fetch_array($descr18));

$j2018 = 1;
$r2018 = 7 - $i2018;
while ($j2018 <= $r2018) {
    $j2018++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}


if(($i2018 == 8) or ($i2018 == 9) or ($i2018 == 10)){
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Ln(5);
}



//********************fin DESCRIPCION DE CONSTRUCCION 2018*****************************************
    $va18="select * from valCatastrales
    where tokenValCatas='$token' and anio='2018'";
    $val18=sqlsrv_query($cnx,$va18);
    $vaCatas18=sqlsrv_fetch_array($val18);
//*************************************************************
//$pdf->Ln(15);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2018 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas18['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas18['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas18['valorCatastral']),1,1,'C');

//*****************************************************2018**************************************************************************



















//$pdf->Ln(160);  //****CAMBIO DE HOJA


//$pdf->Ln(5);




if(($i2018 == 8) or ($i2018 == 9) or ($i2018 == 10)){
    $pdf->Ln(15);
}


$pdf->Ln(20);












//*********************************2019***************************************************************
    $de19="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2019'";
    $descr19=sqlsrv_query($cnx,$de19);
    $descript19=sqlsrv_fetch_array($descr19);
//***********************DESCRIPCION DE CONSTRUCCION 2019*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2019'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2019=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript19['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript19['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript19['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript19['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript19['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript19['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript19['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript19['valConstruct']),1,1,'C');
    $i2019++;
} while($descript19=sqlsrv_fetch_array($descr19));



$j2019 = 1;
$r2019 = 7 - $i2019;
while ($j2019 <= $r2019) {
    $j2019++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}


if(($i2019 == 8) or ($i2019 == 9) or ($i2019 == 10)){
    $pdf->Ln(5);
}

//********************fin DESCRIPCION DE CONSTRUCCION 2019*****************************************
    $va19="select * from valCatastrales
    where tokenValCatas='$token' and anio='2019'";
    $val19=sqlsrv_query($cnx,$va19);
    $vaCatas19=sqlsrv_fetch_array($val19);
//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2019 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas19['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas19['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas19['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas19['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas19['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas19['valorCatastral']),1,1,'C');

//*****************************************************2019**************************************************************************














if(($i2019 == 8) or ($i2019 == 9) or ($i2019 == 10)){
    $pdf->Ln(7);
}





$pdf->Ln(20);







//*********************************2020***************************************************************
    $de20="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2020'";
    $descr20=sqlsrv_query($cnx,$de20);
    $descript20=sqlsrv_fetch_array($descr20);
//***********************DESCRIPCION DE CONSTRUCCION 2020*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2020'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2020=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript20['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript20['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript20['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript20['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript20['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript20['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript20['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript20['valConstruct']),1,1,'C');
    $i2020++;
} while($descript20=sqlsrv_fetch_array($descr20));




$j2020 = 1;
$r2020 = 7 - $i2020;
while ($j2020 <= $r2020) {
    $j2020++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}


if(($i2020 == 8) or ($i2020 == 9) or ($i2020 == 10)){
    $pdf->Ln(30);
}




//********************fin DESCRIPCION DE CONSTRUCCION 2020*****************************************
    $va20="select * from valCatastrales
    where tokenValCatas='$token' and anio='2020'";
    $val20=sqlsrv_query($cnx,$va20);
    $vaCatas20=sqlsrv_fetch_array($val20);
//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2020 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas20['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas20['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas20['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas20['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas20['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas20['valorCatastral']),1,1,'C');

//*****************************************************2020**************************************************************************


















if(($i2020 == 8) or ($i2020 == 9) or ($i2020 == 10)){
    $pdf->Ln(15);
}






$pdf->Ln(40);




//************************* cambio de hoja

//$pdf->Ln(170);


//$pdf->Ln(5);































//*********************************2021***************************************************************
    $de21="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2021'";
    $descr21=sqlsrv_query($cnx,$de21);
    $descript21=sqlsrv_fetch_array($descr21);
//***********************DESCRIPCION DE CONSTRUCCION 2021*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2021'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2021=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript21['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript21['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript21['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript21['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript21['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript21['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript21['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript21['valConstruct']),1,1,'C');
    $i2021++;
} while($descript21=sqlsrv_fetch_array($descr21));



$j2021 = 1;
$r2021 = 7 - $i2021;
while ($j2021 <= $r2021) {
    $j2021++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}

if(($i2021 == 8) or ($i2021 == 9) or ($i2021 == 10)){
    $pdf->Ln(5);
}




//********************fin DESCRIPCION DE CONSTRUCCION 2021*****************************************
    $va21="select * from valCatastrales
    where tokenValCatas='$token' and anio='2021'";
    $val21=sqlsrv_query($cnx,$va21);
    $vaCatas21=sqlsrv_fetch_array($val21);
//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2021 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas21['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas21['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas21['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas21['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas21['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas21['valorCatastral']),1,1,'C');

//*****************************************************2021**************************************************************************






if(($i2021 == 8) or ($i2021 == 9) or ($i2021 == 10)){
    $pdf->Ln(20);
}



$pdf->Ln(20);



//$pdf->Ln(5);


//*********************************2022***************************************************************
    $de22="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2022'";
    $descr22=sqlsrv_query($cnx,$de22);
    $descript22=sqlsrv_fetch_array($descr22);
//***********************DESCRIPCION DE CONSTRUCCION 2022*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2022'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2022=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript22['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript22['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript22['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript22['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript22['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript22['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript22['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript22['valConstruct']),1,1,'C');
    $i2022++;
} while($descript22=sqlsrv_fetch_array($descr22));



$j2022 = 1;
$r2022 = 7 - $i2022;
while ($j2022 <= $r2022) {
    $j2022++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}


if(($i2022 == 8) or ($i2022 == 9) or ($i2022 == 10)){
    $pdf->Ln(5);
}





//********************fin DESCRIPCION DE CONSTRUCCION 2022*****************************************
    $va22="select * from valCatastrales
    where tokenValCatas='$token' and anio='2022'";
    $val22=sqlsrv_query($cnx,$va22);
    $vaCatas22=sqlsrv_fetch_array($val22);
//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2022 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas22['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas22['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas22['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas22['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas22['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas22['valorCatastral']),1,1,'C');

//*****************************************************2022**************************************************************************



















$pdf->Ln(20);













if(isset($_GET['anio']) && ($_GET['anio'] == '17b')){
//*********************************2023***************************************************************
    $de23="select * from descriptConstruct
    where id_fichaResult='$idResult' and anioDescript='2023'";
    $descr23=sqlsrv_query($cnx,$de23);
    $descript23=sqlsrv_fetch_array($descr23);
//***********************DESCRIPCION DE CONSTRUCCION 2023*****************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(223,223,223);
$pdf->Cell(196,5,utf8_decode('DESCRIPCION DE CONSTRUCCION 2023'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(22.5,4,utf8_decode('CCC'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('M2'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Valor'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Niveles'),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode('Tipo/Edad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Calidad'),1,0,'C');
$pdf->Cell(22,4,utf8_decode('Conservación'),1,0,'C');
$pdf->Cell(36,4,utf8_decode('Valor de Construcción'),1,1,'C');

$pdf->SetFont('Arial','',8);

$i2023=0;
do{
$pdf->Cell(22.5,4,utf8_decode($descript23['ccc']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript23['m2']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript23['valor']),1,0,'C');
$pdf->Cell(20,4,utf8_decode($descript23['niveles']),1,0,'C');
$pdf->Cell(24.5,4,utf8_decode($descript23['tipo_edad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript23['calidad']),1,0,'C');
$pdf->Cell(22,4,utf8_decode($descript23['conservacion']),1,0,'C');
$pdf->Cell(36,4,utf8_decode($descript23['valConstruct']),1,1,'C');
    $i2023++;
} while($descript23=sqlsrv_fetch_array($descr23));





$j2023 = 1;
$r2023 = 7 - $i2023;
while ($j2023 <= $r2023) {
    $j2023++;
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
}

if(($i2023 == 8) or ($i2023 == 9) or ($i2023 == 10)){
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Cell(22.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(20,4,'----',1,0,'C');
    $pdf->Cell(24.5,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(22,4,'----',1,0,'C');
    $pdf->Cell(36,4,'----',1,1,'C');
    
    $pdf->Ln(5);
}






//********************fin DESCRIPCION DE CONSTRUCCION 2023*****************************************
    $va23="select * from valCatastrales
    where tokenValCatas='$token' and anio='2023'";
    $val23=sqlsrv_query($cnx,$va23);
    $vaCatas23=sqlsrv_fetch_array($val23);
//*************************************************************

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(223,223,223);
$pdf->Cell(196,5,utf8_decode('VALORES CATASTRALES 2023 (del 1ro al 6to bimestre)'),1,1,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,4,utf8_decode('Sup. Terreno (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Terreno'),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode('Sup. Construcción (m2)'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Construcción'),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode('Valor Catastral'),1,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(30,4,utf8_decode($vaCatas23['supTerreno']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas23['valor']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas23['valTerreno']),1,0,'C');
$pdf->Cell(35.6,4,utf8_decode($vaCatas23['supConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas23['valorConstruct']),1,0,'C');
$pdf->Cell(32.6,4,utf8_decode($vaCatas23['valorCatastral']),1,1,'C');

//*****************************************************2023**************************************************************************
}
//if(($i2023 == 8) or ($i2023 == 9) or ($i2023 == 10)){
//    $pdf->Ln(30);
//}
















//************************* cambio de hoja

$pdf->Ln(200);

































//*************************************************************

$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,10,utf8_decode(''),0,1,'C',);
$pdf->Cell(196,7,utf8_decode('EVIDENCIA FOTOGRAFICA'),1,1,'C',1);

$pdf->SetFont('Arial','B',10);




$file_1 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Ortofoto%202016/'.$empleado['CPredial'].'_1.png';
$file_2 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Ortofoto%202022/'.$empleado['CPredial'].'_2.png';
$file_headers_1 = @get_headers($file_1);
$file_headers_2 = @get_headers($file_2);

if((!$file_headers_2 || $file_headers_2[0] == 'HTTP/1.1 404 Not Found') and (!$file_headers_1 || $file_headers_1[0] == 'HTTP/1.1 404 Not Found')){
    
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2016 (Antecedente)'),1,0,'C',1);
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2022 (Actual)'),1,1,'C',1);
    
    $pdf->Cell(98,50,'NO SE ENCUENTRA FOTO [ _1 ]',1);
    $pdf->MultiCell(98,50,'NO SE ENCUENTRA FOTO [ _2 ]',1);
    
} else if(!$file_headers_1 || $file_headers_1[0] == 'HTTP/1.1 404 Not Found'){
//    echo 'NO existe';
    $pdf->SetX(60);
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2022 (Actual)'),1,1,'C',1);
    $pdf->SetX(60);
    $pdf->MultiCell(98,50, $pdf->Image($file_2, $pdf->GetX(), $pdf->GetY(),0,50),1);
    
} else if(!$file_headers_2 || $file_headers_2[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2016 (Antecedente)'),1,0,'C',1);
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2022 (Actual)'),1,1,'C',1);
    
    $pdf->Cell(98,50, $pdf->Image($file_1, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50,'NO SE ENCUENTRA FOTO [_2]',1);
    
} else{
//    echo 'si existe';
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2016 (Antecedente)'),1,0,'C',1);
    $pdf->Cell(98,5,utf8_decode('Ortofoto año 2022 (Actual)'),1,1,'C',1);
    
    $pdf->Cell(98,50, $pdf->Image($file_1, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image($file_2, $pdf->GetX(), $pdf->GetY(),0,50),1);
}









$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(217,217,217);





//   || operador or





$file_3 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Fotos%20Oblicuas/'.$empleado['CPredial'].'_3.png';
$file_4 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Fotos%20Oblicuas/'.$empleado['CPredial'].'_4.png';
$file_5 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Fotos%20Oblicuas/'.$empleado['CPredial'].'_5.png';
$file_6 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Fotos%20Oblicuas/'.$empleado['CPredial'].'_6.png';
$file_headers_3 = @get_headers($file_3);
$file_headers_4 = @get_headers($file_4);
$file_headers_5 = @get_headers($file_5);
$file_headers_6 = @get_headers($file_6);

if(!$file_headers_3 || $file_headers_3[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->Ln(10);
    $pdf->Cell(196,5,utf8_decode('Fotografías Oblicuas año 2022'),1,1,'C',1);
    $pdf->Cell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->Cell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    
} else if(!$file_headers_4 || $file_headers_4[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->Ln(10);
    $pdf->Cell(196,5,utf8_decode('Fotografías Oblicuas año 2022'),1,1,'C',1);
    $pdf->Cell(98,50, $pdf->Image($file_3, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->Cell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    
} else if(!$file_headers_5 || $file_headers_5[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->Ln(10);
    $pdf->Cell(196,5,utf8_decode('Fotografías Oblicuas año 2022'),1,1,'C',1);
    $pdf->Cell(98,50, $pdf->Image($file_3, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image($file_4, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->Cell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
    
} else if(!$file_headers_6 || $file_headers_6[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->Ln(10);
    $pdf->Cell(196,5,utf8_decode('Fotografías Oblicuas año 2022'),1,1,'C',1);
    $pdf->Cell(98,50, $pdf->Image($file_3, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image($file_4, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->Cell(98,50, $pdf->Image($file_5, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image('../img/plantilla.png', $pdf->GetX(), $pdf->GetY(),0,50),1);
        
} else{
    
    $pdf->Ln(10);
    $pdf->Cell(196,5,utf8_decode('Fotografías Oblicuas año 2022'),1,1,'C',1);
    $pdf->Cell(98,50, $pdf->Image($file_3, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image($file_4, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->Cell(98,50, $pdf->Image($file_5, $pdf->GetX(), $pdf->GetY(),0,50),1);
    $pdf->MultiCell(98,50, $pdf->Image($file_6, $pdf->GetX(), $pdf->GetY(),0,50),1);
    
}
//*************************************************************






























//************************* cambio de hoja

$pdf->Ln(70);






































//*************************************************************
































//************************* cambio de hoja

$pdf->Ln(40);

































$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,6,utf8_decode('CROQUIS DE CONSTRUCCIONES'),1,1,'C',1);


$file_7 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Croquis_con_cotas/'.$empleado['CPredial'].'_7.png';
$file_headers_7 = @get_headers($file_7);

if(!$file_headers_7 || $file_headers_7[0] == 'HTTP/1.1 404 Not Found'){
    
    $pdf->MultiCell(196,150,'No se encuentra croquis de construcciones, Croquis_con_cotas [ _7 ]',1);
    
} else{
    
    $pdf->MultiCell(196,150, $pdf->Image($file_7, $pdf->GetX(), $pdf->GetY(),0,150),1);
    
}








$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(196,5,utf8_decode('OBSERVACIONES'),1,1,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(196,10,utf8_decode($empleado['observaciones']),1,'C',0);



//*************************************************************










//***************************** footer ********************************
$pdf->Ln(3);
$pdf->SetFont('Arial','',6);
$pdf->MultiCell(196,3,utf8_decode($texto),0,'J',0);

$pdf->Ln(13);



$pdf->SetFont('Arial','',8.5);
$pdf->Cell(65.3,4.9,utf8_decode(''),0,0,'C');
$pdf->Cell(65.3,4.9,utf8_decode('Ing. Arq. Luis Enrique Mundo Flores'),0,0,'C');
$pdf->Cell(65.3,4.9,utf8_decode('Lic. Gabriel Alberto Lara Castro'),0,1,'C');

$pdf->Cell(65.3,1,utf8_decode('Ing. Ramón Aron Rodríguez Torres'),0,0,'C');
$pdf->Cell(65.3,1,utf8_decode('Jefe de la Unidad de Cartografía y Valuación'),0,0,'C');
$pdf->Cell(65.3,1,utf8_decode('Director de Catastro '),0,1,'C');

$pdf->Cell(65.3,0,'_________________________________',0,0,'C');
$pdf->Cell(65.3,0,'_________________________________',0,0,'C');
$pdf->Cell(65.3,0,'_________________________________',0,1,'C');
$pdf->Ln(2);
$pdf->Cell(65.3,3,utf8_decode('Elaboró'),0,0,'C');
$pdf->Cell(65.3,3,utf8_decode('Revisó'),0,0,'C');
$pdf->Cell(65.3,3,utf8_decode('Autorizó'),0,1,'C');

//*************************** fin footer ******************************























//$pdf->Output($archivo,'I');
$pdf->Output('F', '../../../fotosZapopan/aFiles_PDF/'.$archivo);
$pdf->Output('D',$archivo);

//$pdf->Output('F', '../doctos/'.$archivo);

if (file_exists('../../../fotosZapopan/aFiles_PDF/'.$archivo)) {
    
    $archivoSubir = $s3->putObject([
            'Bucket' => 'fichascatas',
            'Key' => $archivo,
            'SourceFile' => '../../../fotosZapopan/aFiles_PDF/'.$archivo
        ]);
}

if($archivoSubir['@metadata']['statusCode'] == 200){
    
    $command = $s3->getCommand('GetObject', array(
        'Bucket' => 'fichascatas',
        'Key' => $archivo,
    ));

    //$signedUrl = $command->createPresignedUrl('+8 years');
    $request = $s3->createPresignedRequest($command, '+200 minutes');

    // Get the actual presigned-url
    $signedUrl = (string)$request->getUri();
    
    $sqlCuentaUrl = "update insertCuentasActuales set urlFichaPDF = '$signedUrl' where cuentaPredial = '".$empleado['CPredial']."'";
    $p = sqlsrv_query($cnx,$sqlCuentaUrl);
    if($p != false){
       //Se actualizo exitosamente!!!
    }
    
}else{
    
}




?>


<script>window.close();</script>









