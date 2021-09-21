<?php
 class Modelo_Excel{
     private $conexion;
     function __construct(){
         require_once'modelo_conexion.php';
         $this->conexion = new conexion();
         $this->conexion->conectar();
     }

     
    function Registrar_Excel($numerofactura,$codigo,$valor,$nombre,$apellido){
        $sql = "call PA_REGISTRAR_FACTURAS('$numerofactura','$codigo','$valor','$nombre','$apellido')";
        if ($resultado = $this->conexion->conexion->query($sql)){
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        }
        else{
            return 0;
        }
        $this->conexion->Cerrar_Conexion();
    }

 }
?>