<?php

    function comprobacionNombreFoto($referencia, $nombreNuevo, $subName){
        global $mensajesComprobacion;
        $img=pathinfo($_FILES[$referencia]['name'],PATHINFO_FILENAME);
        $imgtemp=$_FILES[$referencia]['tmp_name'];
        $ext=pathinfo($_FILES[$referencia]['name'],PATHINFO_EXTENSION);
        
        if($ext <> 'png'){
            $mensajesComprobacion[] = $_FILES[$referencia]['name']." - No es un archivo con extension valida";
            return -1;
        }else
            $nomImg = $nombreNuevo.$subName.'.'.$ext;
        
        return $nomImg;
    }

    function updateCampoFoto($refBDCampo, $nuevoValor, $tokenID){
        
        global $mensajesComprobacion, $cnx;
        
        $sqlUpdateF = "UPDATE imgFicha SET $refBDCampo = ? where tokenCactuales = ?";
        $prov = sqlsrv_prepare($cnx,$sqlUpdateF, array(&$nuevoValor, &$tokenID));
        if(sqlsrv_execute( $prov ) and $prov != false){
            return true;
        }else{
            $mensajesComprobacion[] = "Error al actualizar campo: ".$referencia;
            return false;
        }

    }

    function comprobacionTipologias(){
        global $mensajesComprobacion;
        $i = 1;
        $cantidad = 0;
        while(true){
            if(isset($_POST['CCC'.$i])){
                $cantidad++;
                if(trim($_POST['CCC'.$i]) == '' or trim($_POST['AREA'.$i]) == '' or trim($_POST['NIVEL'.$i]) == ''){
                    $mensajesComprobacion[] = "Campos vacios para la nueva tipologia";
                    break;
                }
                
            }else{
                break;
            }
            $i++;
        }
        
        if($cantidad == 0){
            $mensajesComprobacion[] = "No tiene tipologias, debe ingresar los datos";
        }
        
        if(count($mensajesComprobacion) == 0){
            return 1;
        }else
            return 0;
    }
        
    function reLlenadoCampos(){
        global $infoCuenta, $infoTipologias;
        
        $infoCuenta['cuenta'] = $_POST['cuenta'];
        $infoCuenta['curt'] = $_POST['curt'];
        $infoCuenta['clave'] = $_POST['clave'];
        $infoCuenta['frente'] = $_POST['frente'];
        $infoCuenta['factor'] = $_POST['factor'];
        $infoCuenta['fondo'] = $_POST['fondo'];
        $infoCuenta['factor1'] = $_POST['factor1'];
        $infoCuenta['posicion'] = $_POST['posicion'];
        $infoCuenta['factor2'] = $_POST['factor2'];
        $infoCuenta['valorm18'] = $_POST['valorm18'];
        $infoCuenta['valorm19'] = $_POST['valorm19'];
        $infoCuenta['valorm22'] = $_POST['valorm22'];
        $infoCuenta['valorAV'] = $_POST['valorAV'];
        $infoCuenta['usoDeSuelo'] = $_POST['usoDeSuelo'];
        $infoCuenta['observaciones'] = $_POST['observaciones'];
        $infoCuenta['estadoEdificacion'] = $_POST['estadoEdificiacion'];
        $infoCuenta['topografia'] = $_POST['topografia'];
        $infoCuenta['factorTopografia'] = $_POST['factorTopografia'];
        $infoCuenta['tipoServicioActual'] = $_POST['tipoServicioActual'];
        $infoCuenta['giroActual'] = $_POST['giroActual'];
        $infoCuenta['valorm23'] = $_POST['valorm23'];
        $infoCuenta['valorAV18'] = $_POST['valorAV18'];
        $infoCuenta['valorAV19'] = $_POST['valorAV19'];
        $infoCuenta['valorAV22'] = $_POST['valorAV22'];
        $infoCuenta['tokenCat'] = $_POST['tokenCuenta'];

        $i = 1;
        while(true){
            if(isset($_POST['CCC'.$i])){

                $tipologias = array('ccc' => '', 'area' => '', 'nivel' => '', 'id' => '');
                $tipologias['ccc'] = $_POST['CCC'.$i];
                $tipologias['area'] = $_POST['AREA'.$i];
                $tipologias['nivel'] = $_POST['NIVEL'.$i];

                $infoTipologias[] = $tipologias;
            }else{
                break;
            }
            
            $i++;
        }
    }
        
    function printRaro(){
        echo '<script>alert("Si funciona");</script>';
    }


?>