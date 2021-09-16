<?php
//importar la ruta para manejo de excel y conexion base de datos
require 'PHPExcel/Classes/PHPExcel.php';
require 'conexion.php';

//objetos manipulacion base de datos
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//Archivo excel a cargar en base de datos
$archivos = 'facturas1.xlsx';

//Cargar hoja de excel
$excel = PHPExcel_IOfactory::load($archivos);

//cargar la hoja de calculo que queremos
$excel -> setActiveSheetIndex(0);

//Obtener el numero de filas de nuestro archivo excel
$numerofila = $excel -> setActiveSheetIndex(0)->getHighestRow();

for($i=2; $i<=$numerofila; $i++){
    
    //Recorrido de columanas del excel para cargar en base de datos
    $numerofactura= $excel -> getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
    $codigopredio= $excel -> getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
    $valor= $excel -> getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
    $apellido= $excel -> getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
    $nombre= $excel -> getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
    
    //llenar base de datos
    $consulta = "INSERT INTO usuarios (numfactura, codpredio, valor, apellido, nombre) VALUES ('$numerofactura','$codigopredio','$valor','$apellido', '$nombre')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

}

?>