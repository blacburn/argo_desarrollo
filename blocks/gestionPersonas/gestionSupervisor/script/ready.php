window.onload = detectarCarga;

function detectarCarga() {
    $('#botonesRegSup').fadeOut(1);
    
	$('#marcoDatosBasicosPer').fadeOut(1);
    $('#marcoDatosLoad').fadeOut(1000, function (){
    	document.getElementById('estateTab').click();
		$('#marcoDatosBasicosPer').fadeIn(300);
	});

	$('#marcoDatosBasicosPerRe').fadeOut(1);
    $('#marcoDatosLoadRe').fadeOut(1000, function (){
		$('#marcoDatosBasicosPerRe').fadeIn(300);
	});
}

$( ".widget input[type=submit], .widget a, .widget button" ).button();

$("#accordionR").bwlAccordion({
		search: false,
        theme: 'theme-blue',
        toggle: true,
        animation: 'faderight'
    });

<?php ?>

// Asociar el widget de validación al formulario
$("#gestionSupervisor").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#gestionSupervisor").submit(function() {
$resultado=$("#gestionSupervisor").validationEngine("validate");
if ($resultado) {
return true;
}
return false;
});
});



$("#<?php echo $this->campoSeguro('sede') ?>").width(420);
$("#<?php echo $this->campoSeguro('sede') ?>").select2();

$("#<?php echo $this->campoSeguro('dependencia') ?>").width(720);
$("#<?php echo $this->campoSeguro('dependencia') ?>").select2();

$("#<?php echo $this->campoSeguro('funcionario') ?>").width(720);
$("#<?php echo $this->campoSeguro('funcionario') ?>").select2();

$("#<?php echo $this->campoSeguro('interventor') ?>").width(720);
$("#<?php echo $this->campoSeguro('interventor') ?>").select2();

$("#<?php echo $this->campoSeguro('tipo_supervisor') ?>").width(220);
$("#<?php echo $this->campoSeguro('tipo_supervisor') ?>").select2();

$("#<?php echo $this->campoSeguro('cargo') ?>").width(420);
$("#<?php echo $this->campoSeguro('cargo') ?>").select2();


$("#<?php echo $this->campoSeguro('cargo_rt') ?>").width(420);
$("#<?php echo $this->campoSeguro('cargo_rt') ?>").select2();




$('#<?php echo $this->campoSeguro('fecha_fin')?>').datepicker({
    dateFormat: 'dd/mm/yy',
    yearRange: '0:+50',
    changeYear: true,
    changeMonth: true,
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
        dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        
        
});
       
$('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker({
        dateFormat: 'dd/mm/yy',
        yearRange: '0:+50',
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
            
            
});


$( function() {
    var dateFormat = "dd/mm/yy",
        from = $( '#<?php echo $this->campoSeguro('fecha_inicio')?>' )
            .datepicker({
            defaultDate: "+1w",
                yearRange: '0:+0',
                changeYear: true,
                changeMonth: true,
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
            })
            .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
            }),
        to = $( '#<?php echo $this->campoSeguro('fecha_fin')?>' ).datepicker({
            defaultDate: "+1w",
                yearRange: '0:+50',
                changeYear: true,
                changeMonth: true,
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
        })
        .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
        });

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }
} );



$('#<?php echo $this->campoSeguro('fecha_fin_mod')?>').datepicker({
    dateFormat: 'dd/mm/yy',
    yearRange: '0:+0',
    changeYear: true,
    changeMonth: true,
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
        dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        
        
});
       
$('#<?php echo $this->campoSeguro('fecha_inicio_mod')?>').datepicker({
        dateFormat: 'dd/mm/yy',
        yearRange: '0:+0',
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
            
            
});




$( function() {
    var dateFormat = "dd/mm/yy",
        from = $( '#<?php echo $this->campoSeguro('fecha_inicio_mod')?>' )
            .datepicker({
            defaultDate: "+1w",
                yearRange: '0:+0',
                changeYear: true,
                changeMonth: true,
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
            })
            .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
            }),
        to = $( '#<?php echo $this->campoSeguro('fecha_fin_mod')?>' ).datepicker({
            defaultDate: "+1w",
                yearRange: '0:+0',
                changeYear: true,
                changeMonth: true,
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
        })
        .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
        });

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }
} );

$("#<?php echo $this->campoSeguro('fecha_fin_mod') ?>").datepicker( "option", "minDate", dateAdd($("#<?php echo $this->campoSeguro('fecha_inicio_hidden') ?>").val(), 2) );
$("#<?php echo $this->campoSeguro('fecha_fin_mod') ?>").datepicker( "option", "maxDate", dateAdd($("#<?php echo $this->campoSeguro('fecha_fin_hidden') ?>").val(), 1) );

$("#<?php echo $this->campoSeguro('fecha_inicio_mod') ?>").datepicker('disable');
$("#<?php echo $this->campoSeguro('fecha_inicio_mod') ?>").datepicker( "option", "disabled", true );