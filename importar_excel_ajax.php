<?php
    //validamos que el archivo exista y tenga informacion
    if(is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel'])>0){
        //
        require_once 'PHPExcel/Classes/PHPExcel.php';
        require_once 'conexion.php';

        $tmpfname = $_FILES['archivoexcel']['tmp_name'];

        //variable para leer el excel
        $leerexcel = PHPExcel_IOFactory::createReaderForFile($tmpfname);

        //cargar excel
        $excelobj = $leerexcel -> load($tmpfname);

        //cargar en la hoja 
        $hoja = $excelobj ->getSheet(0);
        $filas = $hoja->getHighestRow();

        echo "<table id='tabla_detalle' class='table-responsive' style='width:100%;
        table-layout:fixed'>
         <thead>
           <tr bgcolor= 'black' style='color:#FFFFFF'>
             <td>Numero Factura</td>
             <td>Codigo predio</td>
             <td>Valor Neto</td>
             <td>Apellido</td>
             <td>Nombre</td>
           </tr>
         </thead><tbody id='tbody_tabla_detalle'>";
         for($row = 2; $row<=$filas; $row++){
            $numerofactura= $hoja ->getCell('A'.$row)->getValue();
            $codigopredio= $hoja ->getCell('B'.$row)->getValue();
            $valor= $hoja ->getCell('C'.$row)->getValue();
            $apellido= $hoja ->getCell('D'.$row)->getValue();
            $nombre= $hoja ->getCell('E'.$row)->getValue();
             echo "<tr>";
             echo "<td>.$numerofactura.</td>";
             echo "<td>.$codigopredio.</td>";
             echo "<td>.$valor.</td>";
             echo "<td>.$apellido.</td>";
             echo "<td>.$nombre.</td>";
             echo "</tr>";
         }
         echo  "</tbody></table>";

    }
?>