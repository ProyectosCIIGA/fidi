<?php
session_start();
if((isset($_SESSION['user'])) and (isset($_SESSION['tipousuario']))){
require "../../acnxerdm/cnx.php";
//*****************************************************************
if(isset($_GET['poneUser'])){
    
    $id_usuarioNuevo=$_GET['usr'];
    
    $va="select * from usuarioNuevo
    where estado=1 and id_usuarioNuevo=$id_usuarioNuevo";
    $val=sqlsrv_query($cnx,$va);
    $valida=sqlsrv_fetch_array($val);
    
    if($valida){
        echo '<script> alert("Este usuario es administrador Fidi, no puede ser eliminado.")</script>';
        echo '<meta http-equiv="refresh" content="0,url=config.php">'; 
    } else{
        $delusr="DELETE FROM usuario WHERE id_usuarioNuevo='$id_usuarioNuevo'";
        sqlsrv_query($cnx,$delusr);

        $del="DELETE FROM usuarionuevo WHERE id_usuarioNuevo='$id_usuarioNuevo'";
        sqlsrv_query($cnx,$del);

        echo '<script> alert("Resgistro Eliminado.")</script>';
        echo '<meta http-equiv="refresh" content="0,url=config.php">';   
    }
}
//**************************************************************
if(isset($_GET['poneacces'])){
    $id_acceso=$_GET['acces'];
    $usr=$_GET['usr'];
    
    $delaccess="DELETE FROM acceso WHERE id_acceso='$id_acceso'";
    sqlsrv_query($cnx,$delaccess);
    
    echo '<meta http-equiv="refresh" content="0,url=permisoPlz.php?usr='.$usr.'&plz=65&crhm=950721&idus=659898895">';
}
//**************************************************************
//**************************************************************
if(isset($_GET['poneaccesModule'])){
    $id_acceso=$_GET['acces'];
    $usr=$_GET['usr'];
    
    $delaccessMod="DELETE FROM accessDoctos WHERE id_accessDoctos='$id_acceso'";
    sqlsrv_query($cnx,$delaccessMod);
    
    echo '<meta http-equiv="refresh" content="0,url=doctosAccess.php?usr='.$usr.'&plz=65&crhm=950721&idus=659898895">';
}
//********************************************************
if(isset($_GET['poneplz'])){
    $idplz=$_GET['plz'];
    
    $delaccess="DELETE FROM plaza WHERE id_plaza='$idplz'";
    sqlsrv_query($cnx,$delaccess);
        echo '<script> alert("Resgistro plaza Eliminado.")</script>';
    echo '<meta http-equiv="refresh" content="0,url=addplz.php">';
}
//****************************************************************************************
if(isset($_GET['poneurl'])){
    $idplz=$_GET['plz'];
    $idurl=$_GET['url'];
    
    $delaccess="DELETE FROM mapa WHERE id_plaza='$idplz' AND id_mapa='$idurl'";
    sqlsrv_query($cnx,$delaccess);
        echo '<script> alert("URL de mapa Eliminada.")</script>';
    echo '<meta http-equiv="refresh" content="0,url=urlMap.php?plz='.$idplz.'">';
}        
//****************************************************************************************
if(isset($_GET['poneorigen'])){
    $idorigen=$_GET['origen'];
    
    $delaccess="DELETE FROM proveniente WHERE id_proveniente='$idorigen'";
    sqlsrv_query($cnx,$delaccess);
        echo '<script> alert("Resgistro origen de datos Eliminado.")</script>';
    echo '<meta http-equiv="refresh" content="0,url=origen.php">';
}
//****************************************************************************************
//****************************************************************************************
if(isset($_GET['poneModulo'])){
    $idModulo=$_GET['md'];
    
    $delDocto="DELETE FROM documento WHERE id_documento='$idModulo'";
    sqlsrv_query($cnx,$delDocto);
        echo '<script> alert("Resgistro modulo de documentos Eliminado.")</script>';
    echo '<meta http-equiv="refresh" content="0,url=addDocto.php">';
}
//****************************************************************************************
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    } else{
        echo '<script> alert("Su usuario no tiene permisos para esta direccion URL.")</script>';
        header('location:../../login.php');
    }
?>