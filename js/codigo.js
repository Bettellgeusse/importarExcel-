      //Cuando hacemos click y subamos un archivo
      $('input[type="file"]').on('change', function(){
        //me toma la extencion de mi archivo y la guarda en la variable ext   
        var ext = $( this ).val().split('.').pop();
        //si es vacio no hace nada
        if ($( this ).val() != '') {
          //valida si es una de la extenciones permitidas
          if(ext == "xls" || ext == "xlsx" ){
           }
          else
           {
            //si NO hay archivo correcto, me limpia el valor y me envia mensaje de error
            $( this ).val('');
            Swal.fire("Error","Extensión no permitida: " + ext+"","error");
           }
        }
    });

    function CargarExcel(){
      var excel = $("#txt_archivo").val();
      //valido si esta vacio
       if(excel===""){
           return Swal.fire("Mensaje De Advertencia","Seleccionar un archivo excel","warning");
       }
       //obejto que contendra mi archivo
       var formData = new FormData();
       //llamo a mi archivo
       var files = $("#txt_archivo")[0].files[0];
       //lo agrego a mi objeto para enviarlo con el nombre archivoexcel
       formData.append('archivoexcel',files);
       //envio de archivo por ajax
       $.ajax({
            url:'importar_excel_ajax.php',
            type:'post',
            data:formData,
            contentType:false,
            processData:false,
            success : function(resp){
                   $("#div_table").html(resp);
            }
       });
       return false;
    }