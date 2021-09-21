<?php
 require 'modelo_excel.php';
 $ME = new Modelo_Excel();

 //recibir los datos desde mi js por ajax
 $numerofactura = htmlspecialchars($_POST['factura'],ENT_QUOTES,'UTF-8');
 $codigo = htmlspecialchars($_POST['codigo'],ENT_QUOTES,'UTF-8');
 $valor = htmlspecialchars($_POST['valor'],ENT_QUOTES,'UTF-8');
 $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
 $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');

 //convertir mi string en un arreglo
 //cuando encuentra una , lo separa y convierte en arreglo
 $array_numerofactura = explode(",",$numerofactura);
 $array_codigo = explode(",",$codigo);
 $array_valor = explode(",",$valor);
 $array_nombre = explode(",",$nombre);
 $array_apellido = explode(",",$apellido);
 for($i = 0; $i<count($array_numerofactura); $i++){
     $consulta = $ME -> Registrar_Excel($array_numerofactura[$i],$array_codigo[$i],$array_valor[$i],$array_nombre[$i],$array_apellido[$i]);
 }

 echo $consulta;


?>