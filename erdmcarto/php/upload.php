<?php
require "../../acnxerdm/cnx.php";
$confoto=$_POST['confoto'];

if($confoto == 0){
    $archivo=$_FILES['doc']['name'];
    $archivotemp=$_FILES['doc']['tmp_name'];
    $ext=pathinfo($archivo,PATHINFO_EXTENSION);
        if(($ext=='jpg') or ($ext=='jpeg') or ($ext=='png') or ($ext=='PNG') or ($ext=='JPEG') or ($ext=='JPG')){
            $nombrearchivo=rand(100,999).'_'.rand(1000,9999).'_'.date('Ymd_His').'.'.$ext;
            
            $fecha=$_POST['fecha'];
            $idplaza=$_POST['idplaza'];
            
            $registro="insert into image (id_plaza,IMGname,fecha) values ('$idplaza','$nombrearchivo','$fecha')";
            sqlsrv_query($cnx,$registro) or die ('No se ejecuto la consulta insert image Plaza');
            
            move_uploaded_file($archivotemp,'../img/IMGplz/'.$nombrearchivo);
            echo '<script>alert("Imagen de plaza agregada correctamente");</script>';
            echo '<meta http-equiv="refresh" content="0,url=image.php?plz='.$idplaza.'">';
        } else{
    $idplaza=$_POST['idplaza'];
    echo '<script>alert("El archivo seleccionado debe estar en formato jpg, jpeg o png");</script>';
    echo '<meta http-equiv="refresh" content="0,url=image.php?plz='.$idplaza.'">';
    }
    
} else{
    
    $archivo=$_FILES['doc']['name'];
    $archivotemp=$_FILES['doc']['tmp_name'];
    $ext=pathinfo($archivo,PATHINFO_EXTENSION);
        if(($ext=='jpg') or ($ext=='jpeg') or ($ext=='png') or ($ext=='PNG') or ($ext=='JPEG') or ($ext=='JPG')){
            $nombrearchivo=rand(100,999).'_'.rand(1000,9999).'_'.date('Ymd_His').'.'.$ext;
            $fecha=$_POST['fecha'];
            $idplaza=$_POST['idplaza'];
            $pe="select * from image
            where id_plaza='$idplaza'";
            $per=sqlsrv_query($cnx,$pe);
            $perfil=sqlsrv_fetch_array($per);
            
        if(isset($perfil['IMGname'])){
            unlink('../img/IMGplz/'.$perfil['IMGname']);
        }
            
            $registro="update image set IMGname='$nombrearchivo',fecha='$fecha' where id_plaza='$idplaza'";
            sqlsrv_query($cnx,$registro) or die ('No se ejecuto la consulta update image Plaza');
            move_uploaded_file($archivotemp,'../img/IMGplz/'.$nombrearchivo);
            echo '<script>alert("Imagen de plaza actualizada correctamente");</script>';
            echo '<meta http-equiv="refresh" content="0,url=image.php?plz='.$idplaza.'">';
        } else{
    $idplaza=$_POST['idplaza'];
    echo '<script>alert("El archivo seleccionado debe estar en formato jpg, jpeg o png");</script>';
    echo '<meta http-equiv="refresh" content="0,url=image.php?plz='.$idplaza.'">';
    }
}
?>