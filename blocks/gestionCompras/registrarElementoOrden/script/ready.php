window.onload = detectarCarga;

function detectarCarga() {
    $('#marcoDatos').show('slow');
}

    <?php

?>

// Asociar el widget de validación al formulario
              $("#registrarElementoOrden").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	
        
        $(function() {
            $("#registrarElementoOrden").submit(function() {
                $resultado=$("#registrarElementoOrden").validationEngine("validate");
                   
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

        setTimeout(function() {
    		$('#marcoDatosBasicosMensaje').hide( "drop", { direction: "up" }, "slow" );
			}, 3000); // <-- time in milliseconds
        
              
              
         $("#ventanaEmergenteContratista" ).dialog({
            height: 700,
            width: 700,
            title: "Datos Convenio",
            autoOpen: false,
         });     
              
                              
        $( "#<?php echo $this->campoSeguro('cantidad')?>" ).keyup(function() {
        
            $("#<?php echo $this->campoSeguro('valor')?>").val('');
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            $("#<?php echo $this->campoSeguro('iva') ?>").select2('val', null); 
            
            
            //resetIva();
            
            
          });  
	
	
	
	 $( "#<?php echo $this->campoSeguro('valor')?>" ).keyup(function() {
        	$("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            $("#<?php echo $this->campoSeguro('iva') ?>").select2('val', null); 
            //resetIva(); 
            cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
            
             precio = Math.round((cantidad * valor)*100)/100;
      
      
            if (precio==0){
            
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            
            }else{
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val(precio);
            
            }

          }); 
	
              

 $('#<?php echo $this->campoSeguro('sedeConsulta')?>').width(290);              	 
 $("#<?php echo $this->campoSeguro('sedeConsulta')?>").select2();  
 
 $('#<?php echo $this->campoSeguro('convenio_solicitante')?>').width(290);              	 
 $("#<?php echo $this->campoSeguro('convenio_solicitante')?>").select2();  

 $('#<?php echo $this->campoSeguro('clase_contrato')?>').width(290);              	 
 $("#<?php echo $this->campoSeguro('clase_contrato')?>").select2();  
 
 $("#<?php echo $this->campoSeguro('dependenciaConsulta')?>").select2();              	            
              	
 
 $('#<?php echo $this->campoSeguro('sede')?>').width(300);
$("#<?php echo $this->campoSeguro('sede')?>").select2();
			
$('#<?php echo $this->campoSeguro('dependencia_solicitante')?>').width(200);
$("#<?php echo $this->campoSeguro('dependencia_solicitante')?>").select2();
			


 $('#<?php echo $this->campoSeguro('funcionario')?>').width(300);
$("#<?php echo $this->campoSeguro('funcionario')?>").select2();
			
$("#<?php echo $this->campoSeguro('clase')?>").select2();
$("#<?php echo $this->campoSeguro('tipo_poliza')?>").select2();

        
             
 $('#<?php echo $this->campoSeguro('numero_entrada_c')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('fecha_entrada')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('clase_entrada')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('razon_social')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('nit_proveedor')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('numero_factura')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('fecha_factura')?>').attr('disabled','');
 
 
 $("#<?php echo $this->campoSeguro('numero_orden')?>").select2();
 $("#<?php echo $this->campoSeguro('tipo_orden')?>").select2();
 $("#<?php echo $this->campoSeguro('nivel')?>").select2();
 $("#<?php echo $this->campoSeguro('numero_entrada')?>").select2();
 
   $('#<?php echo $this->campoSeguro('unidad')?>').width(240);
 $("#<?php echo $this->campoSeguro('unidad')?>").select2();
 
 
 $('#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').datepicker({
dateFormat: 'yy-mm-dd',
maxDate: 0,
changeYear: true,
changeMonth: true,
monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
onSelect: function(dateText, inst) {
var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').datepicker('getDate'));
$('input#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').datepicker('option', 'minDate', lockDate);
},
onClose: function() { 
if ($('input#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').val()!='')
{
$('#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
}else {
$('#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
}
}


});
$('#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').datepicker({
dateFormat: 'yy-mm-dd',
maxDate: 0,
changeYear: true,
changeMonth: true,
monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
onSelect: function(dateText, inst) {
var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').datepicker('getDate'));
$('input#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').datepicker('option', 'maxDate', lockDate);
},
onClose: function() { 
if ($('input#<?php echo $this->campoSeguro('fecha_final_consulta') ?>').val()!='')
{
$('#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
}else {
$('#<?php echo $this->campoSeguro('fecha_inicio_consulta') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
}
}

});
 
 
 
 
 $("#<?php echo $this->campoSeguro('tipo_registro')?>").select2();

 $("#<?php echo $this->campoSeguro('numero_acta') ?>").select2();
 $("#<?php echo $this->campoSeguro('iva')?>").select2();
 $("#<?php echo $this->campoSeguro('bodega')?>").select2();
 $("#<?php echo $this->campoSeguro('tipo_poliza')?>").select2(); 
 
 
 
   $( "#<?php echo $this->campoSeguro('tipo_consulta')?>" ).change(function() {
  
     
                    switch($("#<?php echo $this->campoSeguro('tipo_consulta')?>").val())
                                 {
                           
                                    case '1':


                                      
                                        $("#<?php echo $this->campoSeguro('inf_Elementos')?>").css('display','none'); 


                                    break;


                                    case '2':

                               
                                      $("#<?php echo $this->campoSeguro('inf_Elementos')?>").css('display','block');
                                      
                                      
                                break;
                }
                                      
  
              });  

                  
     
     $( "#<?php echo $this->campoSeguro('tipo_registro')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('tipo_registro')?>").val())
            {
                           
                case '1':
                    
                   
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','block');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','none');

                   

                break;
                
                
                       case '2':
                    
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','none');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','block');
       
                break;
                

                default:
                
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','block');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
        
		  
     $( "#<?php echo $this->campoSeguro('tipo_poliza')?>" ).change(function() {
     
    
        
            switch($("#<?php echo $this->campoSeguro('tipo_poliza')?>").val())
            {
                           
                case '0':
                    
                   
                    $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','none');
                   

                   

                break;
                
                
                case '1':
                    
                  $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','block');
       
                break;
                

                default:
                
                $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
	
	
	
	    

                
                
        $( "#<?php echo $this->campoSeguro('cantidad')?>" ).keyup(function() {
        
            $("#<?php echo $this->campoSeguro('valor')?>").val('');
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            $("#<?php echo $this->campoSeguro('iva') ?>").select2('val', null); 
            
          });  
	
        $( "#<?php echo $this->campoSeguro('valor')?>" ).keyup(function() {
        	$("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            $("#<?php echo $this->campoSeguro('iva') ?>").select2('val', null); 
            
            cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
            
            precio = cantidad * valor;
      
      
            total=Math.round(precio*100)/100;
      
            if (precio==0){
            
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            
            }else{
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val(total);
            
            }

          }); 
          
        
          

        
                        
        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('option', 'minDate', lockDate);
			},
			onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_inicio')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
			
		});
              $('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('option', 'maxDate', lockDate);
			 },
			 onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_final')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
	   });
	   
	    
          






