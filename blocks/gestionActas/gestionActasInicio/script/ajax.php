<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// URL base
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url .= $this->miConfigurador->getVariableConfiguracion("site");
$url .= "/index.php?";
// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=consultaContrato";
$cadenaACodificar .= "&usuario=" . $_REQUEST['usuario'];
$cadenaACodificar .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlVigenciaContrato = $url . $cadena;


// Variables
$cadenaACodificarCN = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarCN .= "&procesarAjax=true";
$cadenaACodificarCN .= "&action=index.php";
$cadenaACodificarCN .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarCN .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarCN .= "&funcion=consultaContratoConsecutivo";
$cadenaACodificarCN .= "&usuario=" . $_REQUEST['usuario'];
$cadenaACodificarCN .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarCN, $enlace);

// URL definitiva
$urlConsecutivoContrato = $url . $cadena;

// Variables
$cadenaACodificarFF = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarFF .= "&procesarAjax=true";
$cadenaACodificarFF .= "&action=index.php";
$cadenaACodificarFF .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarFF .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarFF .= "&funcion=consultaFechaFin";
$cadenaACodificarFF .= "&usuario=" . $_REQUEST['usuario'];
$cadenaACodificarFF .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarFF, $enlace);

// URL definitiva
$urlFechaFin = $url . $cadena;


// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=consultarProveedorFiltro";
$cadenaACodificar .= "&usuario=" . $_REQUEST['usuario'];
$cadenaACodificar .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlContratista = $url . $cadena;


$cadenaACodificarInformacionConvenio = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarInformacionConvenio .= "&procesarAjax=true";
$cadenaACodificarInformacionConvenio .= "&action=index.php";
$cadenaACodificarInformacionConvenio .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarInformacionConvenio .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarInformacionConvenio .= $cadenaACodificarInformacionConvenio . "&funcion=consultarInfoConvenio";
$cadenaACodificarInformacionConvenio .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaACodificarInformacionConvenio = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarInformacionConvenio, $enlace);

// URL definitiva
$urlInformacionConvenio = $url . $cadenaACodificarInformacionConvenio;

$cadenaACodificarInformacionContratistaUnico = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarInformacionContratistaUnico .= "&procesarAjax=true";
$cadenaACodificarInformacionContratistaUnico .= "&action=index.php";
$cadenaACodificarInformacionContratistaUnico .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarInformacionContratistaUnico .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarInformacionContratistaUnico .= $cadenaACodificarInformacionContratistaUnico . "&funcion=consultarInfoContratistaUnico";
$cadenaACodificarInformacionContratistaUnico .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaACodificarInformacionContratistaUnico = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarInformacionContratistaUnico, $enlace);

// URL definitiva
$urlInformacionContratistaUnico = $url . $cadenaACodificarInformacionContratistaUnico;

$cadenaACodificarInformacionSociedadTemporal = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarInformacionSociedadTemporal .= "&procesarAjax=true";
$cadenaACodificarInformacionSociedadTemporal .= "&action=index.php";
$cadenaACodificarInformacionSociedadTemporal .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarInformacionSociedadTemporal .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarInformacionSociedadTemporal .= $cadenaACodificarInformacionSociedadTemporal . "&funcion=consultarInfoSociedadTemporal";
$cadenaACodificarInformacionSociedadTemporal .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaACodificarInformacionSociedadTemporal = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarInformacionSociedadTemporal, $enlace);

// URL definitiva
$urlInformacionSociedadTemporal = $url . $cadenaACodificarInformacionSociedadTemporal;

$urlInformacionRP = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$urlInformacionRP .= "&procesarAjax=true";
$urlInformacionRP .= "&action=index.php";
$urlInformacionRP .= "&bloqueNombre=" . $esteBloque ["nombre"];
$urlInformacionRP .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$urlInformacionRP .= $urlInformacionRP . "&funcion=consultarInfoRP";
$urlInformacionRP .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$urlInformacionRP = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($urlInformacionRP, $enlace);

// URL definitiva
$urlInformacionRPFinal = $url . $urlInformacionRP;

// Variables
$cadenadocumento = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenadocumento .= "&procesarAjax=true";
$cadenadocumento .= "&action=index.php";
$cadenadocumento .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenadocumento .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenadocumento .= $cadenadocumento . "&funcion=generarDocumento";
$cadenadocumento .= "&usuario=" . $_REQUEST ['usuario'];
if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

    $cadenadocumento .= "&accesoCondor=true";
}
$cadenadocumento .= "&usuario=" . $_REQUEST ['usuario'];
$cadenadocumento .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenadocumento = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenadocumento, $enlace);

// URL definitiva
$urlDocumento = $url . $cadenadocumento;

// Variables
$cadenadocumentoNov = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenadocumentoNov .= "&procesarAjax=true";
$cadenadocumentoNov .= "&action=index.php";
$cadenadocumentoNov .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenadocumentoNov .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenadocumentoNov .= $cadenadocumentoNov . "&funcion=generarDocumentoNov";
$cadenadocumentoNov .= "&usuario=" . $_REQUEST ['usuario'];
if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

    $cadenadocumentoNov .= "&accesoCondor=true";
}
$cadenadocumentoNov .= "&usuario=" . $_REQUEST ['usuario'];
$cadenadocumentoNov .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenadocumentoNov = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenadocumentoNov, $enlace);

// URL definitiva
$urlDocumentoNov = $url . $cadenadocumentoNov;
?>
<script type='text/javascript'>

    //----------------------------Configuracion Paso a Paso--------------------------------------
    $("#ventanaA").steps({
        headerTag: "h3",
        bodyTag: "section",
        enableAllSteps: true,
        enablePagination: true,
        transitionEffect: "slideLeft",
        labels: {
            cancel: "Cancelar",
            current: "Paso Siguiente :",
            pagination: "Paginación",
            finish: "Regresar",
            next: "Siquiente",
            previous: "Atras",
            loading: "Cargando ..."
        }

    });
//----------------------------Fin Configuracion Paso a Paso--------------------------------------


    $(function () {


        $("#ventanaEmergenteContratista").dialog({
            height: 700,
            width: 900,
            title: "Datos Convenio",
            autoOpen: false,
        });

        $("#ventanaEmergenteActaInicio").dialog({
            height: 450,
            width: 900,
            title: "Datos Convenio",
            autoOpen: false,
        });


        //--------------Inicio JavaScript y Ajax RP Seleccionado ---------------------------------------------------------------------------------------------    
        $("#<?php echo $this->campoSeguro('vigencia_por_contrato') ?>").change(function () {

            if ($("#<?php echo $this->campoSeguro('vigencia_por_contrato') ?>").val() != '') {
              // $("#<?php echo $this->campoSeguro('consecutivo_por_contrato') ?>").select2("val", "");
                consultaNumeroContrato($("#<?php echo $this->campoSeguro('vigencia_por_contrato') ?>").val());
            }

        });
//        
//        $("#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>").change(function () {
//            
//            alert('aaa');
//            if ($("#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>").val() != '') {
//                alert('aaa');
//                consultaFechaFin($("#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>").val());
//                
//            }
//
//        });

        $('#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>').datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            minDate: $('#<?php echo $this->campoSeguro('fecha_inicio_validacion') ?>').val(),
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            onSelect: function (dateText, inst) {
                var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>').datepicker('getDate'));
                $('input#<?php echo $this->campoSeguro('fecha_final_acta') ?>').datepicker('option', 'minDate', lockDate);
            },
            onClose: function () {
                if ($('input#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>').val() != '')
                {
                    if($("#<?php echo $this->campoSeguro('id_novedad') ?>").length > 0 ){
                        consultaFechaFin($("#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>").val(), $("#<?php echo $this->campoSeguro('id_novedad') ?>").val());
                    }else{
                        consultaFechaFin($("#<?php echo $this->campoSeguro('fecha_inicio_acta') ?>").val(), null);
                    }
                }
            }
        });




        $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val());
        });
        $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").autocomplete({
            minChars: 1,
            serviceUrl: '<?php echo $urlVigenciaContrato; ?>',
            onSelect: function (suggestion) {

                $("#<?php echo $this->campoSeguro('id_contrato') ?>").val(suggestion.data);
            }

        });
        $("#<?php echo $this->campoSeguro('contratista') ?>").autocomplete({
            minChars: 2,
            serviceUrl: '<?php echo $urlContratista; ?>',
            onSelect: function (suggestion) {

                $("#<?php echo $this->campoSeguro('id_contratista') ?>").val(suggestion.data);
            }

        });
    });
    function consultaNumeroContrato(vigencia) {

        $.ajax({
            url: "<?php echo $urlConsecutivoContrato ?>",
            dataType: "json",
            data: {vigencia: vigencia},
            success: function (data) {
                if (data[0] != " ") {
                    $("#<?php echo $this->campoSeguro('consecutivo_por_contrato') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('consecutivo_por_contrato') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].data + "'>" + data[ indice ].data + "</option>").appendTo("#<?php echo $this->campoSeguro('consecutivo_por_contrato') ?>");
                    });
                    $("#<?php echo $this->campoSeguro('consecutivo_por_contrato') ?>").removeAttr('disabled');
                }
            }

        });
    }

    function consultaFechaFin(fecha_inicio, id_novedad) {
        $.ajax({
            url: "<?php echo $urlFechaFin ?>",
            dataType: "json",
            data: {fecha_inicio: fecha_inicio,
                numero_contrato: $("#<?php echo $this->campoSeguro('numero_contrato') ?>").val(),
                vigencia_contrato: $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").val(),
                id_novedad: id_novedad},
            success: function (data) {
                $("#<?php echo $this->campoSeguro('fecha_final_acta') ?>").val(data[0]);
            }

        });
    }


    function VerInfoConvenio(informacionConvenio) {
        $.ajax({
            url: "<?php echo $urlInformacionConvenio ?>",
            dataType: "json",
            data: {codigo: informacionConvenio},
            success: function (data) {
                if (data[0] != " ") {

                    var objetoSPAN = document.getElementById('spandid');
                    objetoSPAN.innerHTML = "Información del Convenio :<br><br><br>" + "Numero de Convenio: " + data[0] + " <br><br> "
                            + "Vigencia: " + data[3] + " <br><br>"
                            + "Nombre: " + data[5] + " <br><br>"
                            + "Descripcion: " + data[4] + " <br><br>"
                            + "Entidad: " + data[6] + " <br><br>"
                            + "Codigo Tesoral: " + data[7] + " <br><br>"
                            + "Fecha Inicio: " + data[8] + " <br><br>"
                            + "Fecha de Finalizacion: " + data[9] + " <br><br>"
                            + "Situacion: " + data[10] + " <br><br>"
                            + "Unidad: " + data[11] + " <br><br>"
                            + "Estado: " + data[12] + " <br><br>"
                            + "Modalidad: " + data[13] + " <br><br>";
                    $("#ventanaEmergenteContratista").dialog('option', 'title', 'Convenio');
                    $("#ventanaEmergenteContratista").dialog("open");
                }
            }

        });
    }

    function VerInfoContratista(identificacion) {
        $.ajax({
            url: "<?php echo $urlInformacionContratistaUnico ?>",
            dataType: "json",
            data: {id: identificacion},
            success: function (data) {
                if (data[0] != " ") {

                    var objetoSPAN = document.getElementById('spandid');
                    objetoSPAN.innerHTML = "Información del Contratista :<br><br><br>" + "Nombre del Contratista: " + data[13] + " <br><br> "
                            + "Documento: " + data[1] + " <br><br>"
                            + "Tipo Persona: " + data[0] + " <br><br>"
                            + "Ciudad de Contacto: " + data[2] + " <br><br>"
                            + "Dirección: " + data[3] + " <br><br>"
                            + "Correo: " + data[4] + " <br><br>"
                            + "Sitio WEB: " + data[5] + " <br><br>"
                            + "Estado: " + data[8] + " <br><br>"
                            + "Tipo Cuenta: " + data[9] + " <br><br>"
                            + "Número de Cuenta: " + data[10] + " <br><br>"
                            + "Entidad Bancaria: " + data[11] + " <br><br>"
                            + "Fecha Registro: " + data[12] + " <br><br>"
                            + "Puntaje: " + data[6] + " <br><br>";
                    $("#ventanaEmergenteContratista").dialog('option', 'title', 'Único Contratista');
                    $("#ventanaEmergenteContratista").dialog("open");
                }
            }

        });
    }


    function VerInfoRegistroActaInicio(identificacion) {
        $.ajax({
            url: "<?php echo $urlInformacionContratistaUnico ?>",
            dataType: "json",
            data: {id: identificacion},
            success: function (data) {
                if (data[0] != " ") {

                    var objetoSPAN = document.getElementById('spandid2');
                    objetoSPAN.innerHTML = "No es posible registrar acta de inicio al presentente Contratista :<br><br><br>" + "Numero del Contratista: " + data[13] + " <br><br> "
                            + "Documento: " + data[1] + " <br><br>"
                            + "Tipo Persona: " + data[0] + " <br><br><br><br>"
                            + "Debido a que el contratista posee un contrato actualmente en ejecución."

                            ;
                    $("#ventanaEmergenteActaInicio").dialog('option', 'title', 'Atención');
                    $("#ventanaEmergenteActaInicio").dialog("open");
                }
            }

        });
    }


    function VerInfoRegistroActaInicioRP(identificacion) {
        $.ajax({
            url: "<?php echo $urlInformacionContratistaUnico ?>",
            dataType: "json",
            data: {id: identificacion},
            success: function (data) {
                if (data[0] != " ") {

                    var objetoSPAN = document.getElementById('spandid2');
                    objetoSPAN.innerHTML = "No es posible registrar acta de inicio al presentente Contratista :<br><br><br>" + "Numero del Contratista: " + data[13] + " <br><br> "
                            + "Documento: " + data[1] + " <br><br>"
                            + "Tipo Persona: " + data[0] + " <br><br><br><br>"
                            + "Debido a que el CDP del contrato no tiene relacionado un RP."

                            ;
                    $("#ventanaEmergenteActaInicio").dialog('option', 'title', 'Atención');
                    $("#ventanaEmergenteActaInicio").dialog("open");
                }
            }

        });
    }


    function VerInfoSociedadTemporal(identificacion) {
        $.ajax({
            url: "<?php echo $urlInformacionSociedadTemporal ?>",
            dataType: "json",
            data: {id: identificacion},
            success: function (data) {
                if (data[0] != " ") {

                    var participantes = "Participantes: <br><br>";
                    for (i = 0; i < data[1].length; i++) {
                        participantes = participantes + "Nombre: " + data[1][i][0] + " | Porcentaje de Participacion:  " + data[1][i][1] + "%<br>";
                    }

                    var objetoSPAN = document.getElementById('spandid');
                    objetoSPAN.innerHTML = "Información de la Sociedad Temporal :<br><br><br>" + "Nombre de la Sociedad: " + data[0][13] + " <br><br> "
                            + "Documento: " + data[0][1] + " <br><br>"
                            + "Tipo Sociedad: " + data[0][0] + " <br><br>"
                            + "Ciudad de Contacto: " + data[0][2] + " <br><br>"
                            + "Dirección: " + data[0][3] + " <br><br>"
                            + "Correo: " + data[0][4] + " <br><br>"
                            + "Sitio WEB: " + data[0][5] + " <br><br>"
                            + "Estado: " + data[0][8] + " <br><br>"
                            + "Tipo Cuenta: " + data[0][9] + " <br><br>"
                            + "Número de Cuenta: " + data[0][10] + " <br><br>"
                            + "Entidad Bancaria: " + data[0][11] + " <br><br>"
                            + "Fecha Registro: " + data[0][12] + " <br><br>"
                            + "Puntaje: " + data[0][6] + " <br><br>"
                            + participantes;
                    $("#ventanaEmergenteContratista").dialog('option', 'title', 'Sociedad Temporal');
                    $("#ventanaEmergenteContratista").dialog("open");
                }
            }

        });
    }


    //--------------Inicio JavaScript y Ajax RP Seleccionado ---------------------------------------------------------------------------------------------    
    $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").val() != '') {
            consultaInfoRp();
        }

    });
    function consultaInfoRp(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlInformacionRPFinal ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").val(),
                unidad: $("#<?php echo $this->campoSeguro('unidad_ejecutora_hidden') ?>").val(),
                vigencia: $("#<?php echo $this->campoSeguro('vigencia_hidden') ?>").val()},
            success: function (data) {
                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('observaciones') ?>").val(
                            "Numero de Registro Presupuestal: " + data[0][0] + "\n" +
                            "Numero de Rubro Asociado: " + data[0][1] + "\n" +
                            "Valor del Registro Presupuestal: " + data[0][2] + "."


                            );
                }


            }

        });
    }
    ;
//--------------Fin JavaScript y Convenios x Vigenca --------------------------------------------------------------------------------------------------  


//--------------Gestion Amparos -----------------------------------------------------------------------------------------------------------------------



    $(document).ready(function () {
        var i = 1;
        $("#add_row").click(function () {



            $resultado = $("#gestionPolizas").validationEngine("validate");
            if ($resultado) {



                var lista = "<td>" + (i + 1) + "</td><td><select id='amparo" + i + "' name='amparo" + i + "' class='form-control input-md validate[required]'/></td>";
                $('#addr' + i).html(lista + "\n\
                                        <td><input id='porcentajeamparo" + i + "' name='porcentajeamparo" + i + "' type='text' placeholder='Porcentaje(%)-> 10%'  class='form-control  validate[required] custom[number]'></td>\n\
                                        <td><input id='valoramparo" + i + "'  name='valoramparo" + i + "' type='text' placeholder='Valor'  class='form-control input-md validate[required] custom[number]'  readonly></td>\n\
                                        <td><input id='fechainiamparo" + i + "'  name='fechainiamparo" + i + "' type='text' placeholder='Fecha Inicial'  class='form-control validate[required]  '></td>\n\
                                        <td><input id='fechafinamparo" + i + "'  name='fechafinamparo" + i + "' type='text' placeholder='Fecha Final'  class='form-control  validate[required]   '></td>");
                $('#tab_amparos').append('<tr id="addr' + (i + 1) + '"></tr>');
                var data = jQuery.parseJSON($("#amparosOculto").val());
                if (data[0][0] != " ") {
                    $("<option value=''>Seleccione  ....</option>").appendTo("#amparo" + i);
                    $.each(data, function (indice, valor) {
                        $("<option value='" + data[ indice ].id + "'>" + data[ indice ].nombre + "</option>").appendTo("#amparo" + i);
                    });
                }
                $("#amparo" + i).width(300);
                $("#amparo" + i).select2();
                $('#fechainiamparo' + i).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeYear: true,
                    changeMonth: true,
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    onSelect: function (dateText, inst) {
                        var lockDate = new Date($('#fechainiamparo' + i).datepicker('getDate'));
                        $('input#fechafinamparo' + i).datepicker('option', 'minDate', lockDate);
                    },
                });
                $('#fechafinamparo' + i).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeYear: true,
                    changeMonth: true,
                    minDate: new Date($('#fechainiamparo' + i).datepicker('getDate')),
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    beforeShow: function () {
                        var lockDate = $('#fechainiamparo' + i).val();
                        $('#fechafinamparo' + i).datepicker('option', 'minDate', lockDate);
                    },
                    onClose: function () {
                        var lockDate = $('#fechainiamparo' + i).val();
                        $('#fechafinamparo' + i).datepicker('option', 'minDate', lockDate);
                    }
                });
                $('#porcentajeamparo' + i).keyup(function () {
                    CalcularPorcentajeAmparo(i);
                });
                if (i == 1) {

                    $('#porcentajeamparo0').attr('readonly', true);
                    $('#valoramparo0').attr('readonly', true);
                } else {
                    var temp = i - 1;
                    $('#porcentajeamparo' + temp).attr('readonly', true);
                    $('#valoramparo' + temp).attr('readonly', true);
                }

                i++;
                return true;
            } else {
                return false;
            }


        });
        $("#delete_row").click(function () {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
            if (i == 1) {
                $('#amparo0').attr('readonly', false);
                $('#porcentajeamparo0').attr('readonly', false);
                $('#valoramparo0').attr('readonly', false);
                $('#fechainiamparo0').attr('readonly', false);
                $('#fechafinamparo0').attr('readonly', false);
            }
        });
    });
    function CalcularPorcentajeAmparo(i) {
        var i = i - 1;
        var valorPorcentaje = $("#porcentajeamparo" + i).val();
        if (valorPorcentaje > 0) {
            var valor_contrato = $('#<?php echo $this->campoSeguro('valor_contrato') ?>').val();
            var valor_amparo = (valorPorcentaje * valor_contrato) / 100;
            $("#valoramparo" + i).val(valor_amparo);
        } else {
            $("#valoramparo" + i).val("");
            alert("El porcentaje no es un valor Valido.")
        }
    }


    $("#<?php echo $this->campoSeguro('numero_minimos') ?>").keyup(function () {
        $('#<?php echo $this->campoSeguro('valor') ?>').val($('#<?php echo $this->campoSeguro('numero_minimos') ?>').val() * $('#<?php echo $this->campoSeguro('salario_minimo') ?>').val());
    });
    function GenerarDocumento(NumeroContrato) {
        $.ajax({
            url: "<?php echo $urlDocumento ?>",
            dataType: "json",
            data: {numerocontrato: NumeroContrato, fuentedocumento: $("#fuentedocumento").val()},
            success: function (data) {
                window.open(data, "_target")
            }

        });
    }
    ;
    
    function GenerarDocumentoNov(NumeroContrato) {
        $.ajax({
            url: "<?php echo $urlDocumentoNov ?>",
            dataType: "json",
            data: {numerocontrato: NumeroContrato, fuentedocumento: $("#fuentedocumento").val()},
            success: function (data) {
                window.open(data, "_target")
            }

        });
    }
    ;
    
    function VerAmparos(idDiv) {
        $("#amparodiv" + idDiv).css('display', 'block');
    }
    function CerrarAmparos(idDiv) {
        $("#amparodiv" + idDiv).css('display', 'none');
    }
    function VerMensajeATC() {
        $("#mensajeATC").css('display', 'block');
    }
    function CerrarMensajeATC() {
        $("#mensajeATC").css('display', 'none');
    }



    $("#<?php echo $this->campoSeguro('tipo_acta_inicio') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('tipo_acta_inicio') ?>").val() == 1) {
                $('#marcoContratos').fadeIn(300);
                $('#marcoNovedades').fadeOut(100);
                $('#botonesGestActa').fadeIn(300);
                $("#<?php echo $this->campoSeguro('tipo_acceso') ?>").val('contrato')
        }else if($("#<?php echo $this->campoSeguro('tipo_acta_inicio') ?>").val() == 2){
                $('#marcoContratos').fadeOut(100);
                $('#marcoNovedades').fadeIn(300);
                $('#botonesGestActa').fadeIn(300);
                $("#<?php echo $this->campoSeguro('tipo_acceso') ?>").val('novedad')
        }else{
                $('#marcoContratos').fadeOut(100);
                $('#marcoNovedades').fadeOut(100);
                $('#botonesGestActa').fadeOut(100);
        }

    });




</script>
