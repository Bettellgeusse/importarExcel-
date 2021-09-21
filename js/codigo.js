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
                   document.getElementById("btn_registrar").disabled=false;
            }
       });
       return false;
    }
    //funcion registra excel, la cual se encarga de cargarlo en la base de datos 
    function Registrar_Excel(){
      var contador=0;
      var arrelgo_numerofactura= new Array();
      var arrelgo_codigopredio = new Array();
      var arrelgo_valor = new Array();
      var arrelgo_apellido = new Array();
      var arrelgo_nombre = new Array();

      $("#tabla_detalle tbody#tbody_tabla_detalle tr" ).each(function(){
        arrelgo_numerofactura.push($(this).find('td').eq(0).text());
        arrelgo_codigopredio.push($(this).find('td').eq(1).text());
        arrelgo_valor.push($(this).find('td').eq(2).text());
        arrelgo_apellido.push($(this).find('td').eq(3).text());
        arrelgo_nombre.push($(this).find('td').eq(4).text());
        contador++;
      })
      if(contador==0){
        return Swal.fire("Mensaje De Advertencia","la tabla debe de tener un dato como minimo","warning");
      }
      var numerofactura= arrelgo_numerofactura.toString();
      var codigopredio = arrelgo_codigopredio.toString();
      var valor = arrelgo_valor.toString();
      var apellido = arrelgo_apellido.toString();
      var nombre = arrelgo_nombre.toString(); 
      $.ajax({
        url:'controlador_registro.php',
        type:'post',
        data:{
            factura:numerofactura,
            codigo:codigopredio,
            valor:valor,
            nombre:nombre,
            apellido:apellido
        }
      }).done(function(resp){
         if(resp==1){
           Swal.fire("Mensaje De Confirmacion","Datos Cargados","sucess");
         }else{
          Swal.fire("Mensaje De error","Datos NO registrados","error");
         }
      })

    }