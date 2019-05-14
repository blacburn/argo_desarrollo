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

$cadenaInfoRegistroPresupuestalporDisponibilidad = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaInfoRegistroPresupuestalporDisponibilidad .= "&procesarAjax=true";
$cadenaInfoRegistroPresupuestalporDisponibilidad .= "&action=index.php";
$cadenaInfoRegistroPresupuestalporDisponibilidad .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaInfoRegistroPresupuestalporDisponibilidad .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaInfoRegistroPresupuestalporDisponibilidad .= $cadenaInfoRegistroPresupuestalporDisponibilidad . "&funcion=consultarInfoRP";
$cadenaInfoRegistroPresupuestalporDisponibilidad .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaInfoRegistroPresupuestalporDisponibilidad = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaInfoRegistroPresupuestalporDisponibilidad, $enlace);

// URL definitiva
$urlInfoRegistroPresupuestalporDisponibilidad = $url . $cadenaInfoRegistroPresupuestalporDisponibilidad;



// Variables
$cadenaRegistroPresupuestalporDisponibilidad = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaRegistroPresupuestalporDisponibilidad .= "&procesarAjax=true";
$cadenaRegistroPresupuestalporDisponibilidad .= "&action=index.php";
$cadenaRegistroPresupuestalporDisponibilidad .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaRegistroPresupuestalporDisponibilidad .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaRegistroPresupuestalporDisponibilidad .= $cadenaRegistroPresupuestalporDisponibilidad . "&funcion=consultarRegistroDisponibilidad";
$cadenaRegistroPresupuestalporDisponibilidad .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaRegistroPresupuestalporDisponibilidad = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaRegistroPresupuestalporDisponibilidad, $enlace);

// URL definitiva
$urlRegistroPresupuestalporDisponibilidad = $url . $cadenaRegistroPresupuestalporDisponibilidad;


$cadenaconsultaInRP = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaconsultaInRP .= "&procesarAjax=true";
$cadenaconsultaInRP .= "&action=index.php";
$cadenaconsultaInRP .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaconsultaInRP .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaconsultaInRP .= $cadenaconsultaInRP . "&funcion=consultarRp";
$cadenaconsultaInRP .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaconsultaInRP = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaconsultaInRP, $enlace);

// URL definitiva
$consultaInRP = $url . $cadenaconsultaInRP;

$cadenainactivarRp = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenainactivarRp .= "&procesarAjax=true";
$cadenainactivarRp .= "&action=index.php";
$cadenainactivarRp .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenainactivarRp .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenainactivarRp .= $cadenainactivarRp . "&funcion=inactivarrp";
$cadenainactivarRp .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenainactivarRp = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenainactivarRp, $enlace);

// URL definitiva
$inactivarRp = $url . $cadenainactivarRp;

// Variables
$cadenadocumento = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenadocumento .= "&procesarAjax=true";
$cadenadocumento .= "&action=index.php";
$cadenadocumento .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenadocumento .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenadocumento .= $cadenadocumento . "&funcion=generarDocumento";
$cadenadocumento .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenadocumento = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenadocumento, $enlace);

// URL definitiva
$urlDocumento = $url . $cadenadocumento;


// Variables
$cadenaACodificarDependencia = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarDependencia .= "&procesarAjax=true";
$cadenaACodificarDependencia .= "&action=index.php";
$cadenaACodificarDependencia .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarDependencia .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarDependencia .= $cadenaACodificarDependencia . "&funcion=consultarDependencia";
$cadenaACodificarDependencia .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaDependencia = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarDependencia, $enlace);

// URL definitiva
$urlFinalDependencia = $url . $cadenaDependencia;


// Variables
$cadenaACodificarComCargo = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarComCargo .= "&procesarAjax=true";
$cadenaACodificarComCargo .= "&action=index.php";
$cadenaACodificarComCargo .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarComCargo .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarComCargo .= $cadenaACodificarComCargo . "&funcion=consultarComCargo";
$cadenaACodificarComCargo .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaComCargo = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarComCargo, $enlace);

// URL definitiva
$urlFinalComCargo = $url . $cadenaComCargo;



// Variables
$cadenaACodificarComRol = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarComRol .= "&procesarAjax=true";
$cadenaACodificarComRol .= "&action=index.php";
$cadenaACodificarComRol .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarComRol .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarComRol .= $cadenaACodificarComRol . "&funcion=consultarComRol";
$cadenaACodificarComRol .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaComRol = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarComRol, $enlace);

// URL definitiva
$urlFinalComRol = $url . $cadenaComRol;


//Variables
$cadenaACodificarExpDep = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificarExpDep .= "&procesarAjax=true";
$cadenaACodificarExpDep .= "&action=index.php";
$cadenaACodificarExpDep .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarExpDep .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarExpDep .= $cadenaACodificarExpDep . "&funcion=consultarDepartamentoAjax";
$cadenaACodificarExpDep .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$cadenaExpDep = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificarExpDep, $enlace );

// URL definitiva
$urlFinalExpDep = $url . $cadenaExpDep;



//Variables
$cadenaACodificarExpCiu = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificarExpCiu .= "&procesarAjax=true";
$cadenaACodificarExpCiu .= "&action=index.php";
$cadenaACodificarExpCiu .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarExpCiu .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarExpCiu .= $cadenaACodificarExpCiu . "&funcion=consultarCiudadAjax";
$cadenaACodificarExpCiu .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$cadenaExpCiu = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificarExpCiu, $enlace );

// URL definitiva
$urlFinalExpCiu = $url . $cadenaExpCiu;


?>
<script type='text/javascript'>
var i;
     var numeracion;
    //----------------------------Configuracion Paso a Paso--------------------------------------


//----------------------------Fin Configuracion Paso a Paso--------------------------------------


    $(function () {

        $("#<?php echo $this->campoSeguro('vigencia') ?>").change(function () {
            if($('#<?php echo $this->campoSeguro('vigencia') ?>').val() != ''){
                $('#oneAudit').fadeOut(300);
            }else if($('#<?php echo $this->campoSeguro('clase_contrato') ?>').val() != ''){
                $('#oneAudit').fadeOut(300);
            }else{
                $('#oneAudit').fadeIn(100);
            }
            console.log($('#<?php echo $this->campoSeguro('clase_contrato') ?>').val());
            console.log($('#<?php echo $this->campoSeguro('vigencia') ?>').val());
        });

        $("#<?php echo $this->campoSeguro('clase_contrato') ?>").change(function () {
            if($('#<?php echo $this->campoSeguro('clase_contrato') ?>').val() != ''){
                $('#oneAudit').fadeOut(300);
            }else if($('#<?php echo $this->campoSeguro('vigencia') ?>').val() != ''){
                $('#oneAudit').fadeOut(300);
            }else{
                $('#oneAudit').fadeIn(100);
            }
            console.log($('#<?php echo $this->campoSeguro('clase_contrato') ?>').val());
            console.log($('#<?php echo $this->campoSeguro('vigencia') ?>').val());
        });

        $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val());
            
        });

        $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").keypress(function () {
            $('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val());
            
            if($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val() != ''){
                $('#generalAudit').fadeOut(300);
            }else{
                $('#generalAudit').fadeIn(100);
            }
        });

        $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").change(function () {

            $('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val());

            if($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val() != ''){
                $('#generalAudit').fadeOut(300);
            }else{
                $('#generalAudit').fadeIn(100);
            }

            
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
                    objetoSPAN.innerHTML = "Información del Contratista :<br><br><br>" + "Numero del Contratista: " + data[13] + " <br><br> "
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

    function ELiminarRP(id) {
        $.ajax({
            url: "<?php echo $inactivarRp ?>",
            dataType: "json",
            data: {id: id},
            success: function (data) {
                if (data[0] != " ") {

                    if (data == true) {
                        window.location.reload()
                    }

                }


            }

        });
    }
    ;
    function ConsultarRP(id) {
        $.ajax({
            url: "<?php echo $consultaInRP ?>",
            dataType: "json",
            data: {id: id},
            success: function (data) {
                if (data[0] != " ") {

                    var rubros = "";
                    var valorTotal = 0;
                    for (i = 0; i < data.length; i++) {
                        rubros = rubros + "---| Rubro: " + data[i][2] + " - Valor: " + new Intl.NumberFormat(["ban", "id"]).format(data[i][3]) + "\n";
                        valorTotal = valorTotal + parseFloat(data[i][3]);
                    }

                    $("#<?php echo $this->campoSeguro('inforegistroPresupuestal') ?>").val(
                            "Número de Registro Presupuestal: " + data[0][0] + "\n" +
                            "Rubro(s) Asociado(os): \n " + rubros +
                            "Valor del Registro Presupuestal: " + new Intl.NumberFormat(["ban", "id"]).format(valorTotal) + ""
                            );

                }


            }

        });
    }
    ;

    //--------------Inicio JavaScript y Ajax Registro por Disponibilidad ---------------------------------------------------------------------------------------------    

    $("#<?php echo $this->campoSeguro('numero_disponibilidad_contrato') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('numero_disponibilidad_contrato') ?>").val() != '') {
            consultarRegistroPorDisponibilidad();
        } else {
            $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").attr('disabled', '');
        }

    });

    function consultarRegistroPorDisponibilidad(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlRegistroPresupuestalporDisponibilidad ?>",
            dataType: "json",
            data: {cdp: $("#<?php echo $this->campoSeguro('numero_disponibilidad_contrato') ?>").val(),
                unidad: $("#<?php echo $this->campoSeguro('unidad_ejecutora_hidden') ?>").val(),
                rpseleccion: $("#<?php echo $this->campoSeguro('lista_vigencia_rp') ?>").val()
            },
            success: function (data) {

                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('registro_presupuestal') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].VALOR + "'>" + data[ indice ].INFORMACION + "</option>").appendTo("#<?php echo $this->campoSeguro('registro_presupuestal') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").removeAttr('disabled');

                    $('#<?php echo $this->campoSeguro('registro_presupuestal') ?>').width(400);
                    $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").select2();



                }


            }

        });
    }
    ;


    $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").val() != '') {
            consultarInfoRegistroPresupuestal();
        } else {

        }

    });

    function consultarInfoRegistroPresupuestal(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlInfoRegistroPresupuestalporDisponibilidad ?>",
            dataType: "json",
            data: {cdp: $("#<?php echo $this->campoSeguro('numero_disponibilidad_contrato') ?>").val(),
                unidad: $("#<?php echo $this->campoSeguro('unidad_ejecutora_hidden') ?>").val(),
                rp: $("#<?php echo $this->campoSeguro('registro_presupuestal') ?>").val()},
            success: function (data) {
                if (data[0] != " ") {
                    var rubros = "";
                    var valorTotal = 0;
                    for (i = 0; i < data.length; i++) {
                        rubros = rubros + "---| Rubro: " + data[i][2] + " - Valor: " + new Intl.NumberFormat(["ban", "id"]).format(data[i][3]) + "\n";
                        valorTotal = valorTotal + parseFloat(data[i][3]);
                    }

                    $("#<?php echo $this->campoSeguro('inforegistroPresupuestal') ?>").val(
                            "Número de Registro Presupuestal: " + data[0][0] + "\n" +
                            "Rubro(s) Asociado(os): \n " + rubros +
                            "Valor del Registro Presupuestal: " + new Intl.NumberFormat(["ban", "id"]).format(valorTotal) + ""
                            );

                    $("#<?php echo $this->campoSeguro('vigencia_rp_hidden') ?>").val(data[0][4]);

                }


            }

        });
    }
    ;

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


//--------------Fin JavaScript y Convenios x Vigenca --------------------------------------------------------------------------------------------------  
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

    $("#<?php echo $this->campoSeguro('tipo_ordenador') ?>").change(function () {
        if ($("#<?php echo $this->campoSeguro('tipo_ordenador') ?>").val() == 1) {
            $('#divInterventor').fadeOut(10);
            $('#divFuncionario').fadeIn(300);

            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('digito_ordenador') ?>").val('');

        } else if($("#<?php echo $this->campoSeguro('tipo_ordenador') ?>").val() == 2) {
            $('#divFuncionario').fadeOut(10);
            $('#divInterventor').fadeIn(300);

            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('digito_ordenador') ?>").val('');
        } else {
            $('#divFuncionario').fadeOut(300);
            $('#divInterventor').fadeOut(300);

            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('digito_ordenador') ?>").val('');
        }

    });


    $("#<?php echo $this->campoSeguro('funcionario') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('funcionario') ?>").val() != '') {

            var value = $("#<?php echo $this->campoSeguro('funcionario') ?>").val();
            var data = value.split("-");
            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val(data[1]);
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val(data[0]);
            $("#<?php echo $this->campoSeguro('id_ordenador_hidden') ?>").val(data[2]);
            calcularDigitoCedula(data[0]);
        } else{
            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('digito_ordenador') ?>").val('');
        } 

    });

    $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").on('keyup', function(){

        if ($("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val() != '') {
            calcularDigitoCedula($("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val());
        }

    });


    $("#<?php echo $this->campoSeguro('interventor') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('interventor') ?>").val() != '') {

            var value = $("#<?php echo $this->campoSeguro('interventor') ?>").val();
            var data = value.split("-");
            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val(data[1]);
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val(data[0]);
            $("#<?php echo $this->campoSeguro('id_ordenador_hidden') ?>").val(data[2]);
            calcularDigitoCedula(data[0]);
        } else{
            $("#<?php echo $this->campoSeguro('nombre_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('documento_ordenador') ?>").val('');
            $("#<?php echo $this->campoSeguro('digito_ordenador') ?>").val('');
        } 

    });

    $("#<?php echo $this->campoSeguro('rol') ?>").change(function () {
        if ($("#<?php echo $this->campoSeguro('rol') ?>").val() != '') {
            consultarCombinacionRol();
            var cargoOpt = $("#<?php echo $this->campoSeguro('rol') ?> option:selected").text();
            $("#<?php echo $this->campoSeguro('rol_hidden') ?>").val(cargoOpt);
        }

        var cargoOpt = $("#<?php echo $this->campoSeguro('rol') ?> option:selected").text();
        $("#<?php echo $this->campoSeguro('rol_hidden') ?>").val(cargoOpt);

        $.datepicker._clearDate($("#<?php echo $this->campoSeguro('fecha_inicio') ?>").datepicker());
        $.datepicker._clearDate($("#<?php echo $this->campoSeguro('fecha_fin') ?>").datepicker());

        $("#<?php echo $this->campoSeguro('fecha_inicio') ?>").val('');
        $("#<?php echo $this->campoSeguro('fecha_fin') ?>").val('');
    });


    function formatDate(nDate) {
        var date = new Date(nDate);
        date.setHours(0,0,0,0);
        date.setDate(date.getDate() + 1);

          var monthNames = [
            "Enero", "Febrero", "Marzo",
            "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre",
            "Noviembre", "Diciembre"
          ];

          var day = date.getDate();
          var monthIndex = date.getMonth();
          var year = date.getFullYear();
          return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }

    function formatDateAdd(nDate, plus) {
        var date = new Date(nDate);
        date.setHours(0,0,0,0);
        date.setDate(date.getDate() + plus);

          var monthNames = [
            "Enero", "Febrero", "Marzo",
            "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre",
            "Noviembre", "Diciembre"
          ];

          var day = date.getDate();
          var monthIndex = date.getMonth();
          var year = date.getFullYear();
          return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }

    function dateAdd(nDate, plus) {
        var date = new Date(nDate);
        date.setHours(0,0,0,0);
        date.setDate(date.getDate() + plus);
        return date;
    }

    function consultarCombinacionRol(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinalComRol ?>",
            dataType: "json",
            data: {rol: $("#<?php echo $this->campoSeguro('rol') ?>").val()},
            success: function (data) {

                if (data) {

                    var actual = new Date();
                    actual.setHours(0,0,0,0);
                    var dtIni = dateAdd(data[0]['fecha_inicio'], 1);
                    var dtFin = dateAdd(data[0]['fecha_fin'], 1);

                    if(dtFin >= actual && dtIni <= actual){

                        var rolOpt = $("#<?php echo $this->campoSeguro('rol') ?> option:selected").text();


                        swal({
                            title: 'ATENCIÓN',
                            type: 'warning',
                            html:
                                    'No se puede hacer registro de ORDENADOR para:<br><br>'
                                    +'Rol: <b>'+rolOpt+'</b><br>'
                                    +'<br>'
                                    +'Existe ordenador <b>ACTIVO</b>:<br>'
                                    +'<pre>('+data[0]['documento']+') '+ data[0]['nombre_ordenador']+'</pre><br>'
                                    +'No se puede registrar este cargo hasta vencido el mismo en, <b>FECHA DE FIN</b>  (<b>'+formatDateAdd(data[0]['fecha_fin'], 1)+')</b>, por favor tenga en cuenta esto.',
                            confirmButtonText:
                                    'Aceptar'
                        })

                        $("#<?php echo $this->campoSeguro('fecha_inicio') ?>").datepicker( "option", "minDate", dateAdd(data[0]['fecha_fin'], 2) );
                        $("#<?php echo $this->campoSeguro('fecha_fin') ?>").datepicker( "option", "minDate", dateAdd(data[0]['fecha_fin'], 2) );

                        $('#botonesRegSup').fadeOut(1);

                    }else{
                        
                        var rolOpt = $("#<?php echo $this->campoSeguro('rol') ?> option:selected").text();

                        var ci = 0;
                        var tablaHt = "<table id='tableCar'>"+
                                        "<tr>"+
                                            "<th width='15%'>Documento</th>"+
                                            "<th width='35%'>Nombre</th>"+
                                            "<th width='25%'>Inicio</th>"+
                                            "<th width='25%'>Fin</th>"+
                                        "</tr>";
                        while(ci < data.length){
                            tablaHt += "<tr>"+
                                        "<td>"+data[ci]['documento']+"</td>"+
                                        "<td>"+data[ci]['nombre_ordenador']+"</td>"+
                                        "<td>"+formatDate(data[ci]['fecha_inicio'])+"</td>"+
                                        "<td>"+formatDate(data[ci]['fecha_fin'])+"</td>"+
                                      "</tr>";
                            ci++;
                        }
                        tablaHt += "</table>";
                        
                        swal({
                            title: 'IMPORTANTE',
                            type: 'info',
                            html:
                                    'Tenga en cuenta que, actualmente los últimos ordenadores registrados para:<br><br>'
                                    +'Rol: <b>'+rolOpt+'</b><br><br>son,<br><br>'
                                    +tablaHt
                                    +'<br>'
                                    +'No se puede registrar este cargo para una <b>FECHA DE INICIO</b> menor al  <b>'+formatDateAdd(data[0]['fecha_fin'], 2)+'</b>, por favor tenga en cuenta esto.',
                            confirmButtonText:
                                    'Aceptar'
                        })

                        $("#<?php echo $this->campoSeguro('fecha_inicio') ?>").datepicker( "option", "minDate", dateAdd(data[0]['fecha_fin'], 2) );
                        $("#<?php echo $this->campoSeguro('fecha_fin') ?>").datepicker( "option", "minDate", dateAdd(data[0]['fecha_fin'], 2) );

                        $('#botonesRegSup').fadeIn(300);

                    }
                    
                    

                }else{
                    $("#<?php echo $this->campoSeguro('fecha_inicio') ?>").datepicker( "option", "minDate", null );
                    $("#<?php echo $this->campoSeguro('fecha_fin') ?>").datepicker( "option", "minDate", null );

                    $('#botonesRegSup').fadeIn(300);
                }

            }

        });
    }
    ;

    //--------------Inicio JavaScript y Ajax Sede y Dependencia Suepervisor ---------------------------------------------------------------------------------------------    
    $("#<?php echo $this->campoSeguro('sede') ?>").change(function () {
        if ($("#<?php echo $this->campoSeguro('sede') ?>").val() != '') {
            consultarDependenciaSuper();
        } else {
            $("#<?php echo $this->campoSeguro('dependencia') ?>").attr('disabled', '');
        }

    });


    function consultarDependenciaSuper(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinalDependencia ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('sede') ?>").val()},
            success: function (data) {
                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('dependencia') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('dependencia') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].ESF_CODIGO_DEP + "'>" + data[ indice ].ESF_DEP_ENCARGADA + "</option>").appendTo("#<?php echo $this->campoSeguro('dependencia') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('dependencia') ?>").removeAttr('disabled');

                    $("#<?php echo $this->campoSeguro('dependencia') ?>").width(720);
                    $("#<?php echo $this->campoSeguro('dependencia') ?>").select2();

                }


            }

        });
    }
    ;
//--------------Fin JavaScript y Ajax Sede y Dependencia Suepervisor --------------------------------------------------------------------------------------------------   


function calcularDigitoCedula(cadenaCedula){

    var num_primos, control_mod_1, control_mod_2, tamano_cedula, i, digito_verificacion;
                  
    if(isNaN(cadenaCedula)){ 
        $("#<?php echo $this->campoSeguro('digito_ordenador')?>").val(null);
    }
    else{
        num_primos = new Array (16); 
        control_mod_1 = 0; 
        control_mod_2 = 0; 
        tamano_cedula = cadenaCedula.length ;

        num_primos[1]=3;
        num_primos[2]=7;
        num_primos[3]=13; 
        num_primos[4]=17;
        num_primos[5]=19;
        num_primos[6]=23;
        num_primos[7]=29;
        num_primos[8]=37;
        num_primos[9]=41;
        num_primos[10]=43;
        num_primos[11]=47;  
        num_primos[12]=53;  
        num_primos[13]=59; 
        num_primos[14]=67; 
        num_primos[15]=71;
                
        for(i=0 ; i < tamano_cedula ; i++)
        { 
            control_mod_2 = (cadenaCedula.substr(i,1));
            control_mod_1 += (control_mod_2 * num_primos[tamano_cedula - i]);
        } 
        control_mod_2 = control_mod_1 % 11;
                
        if (control_mod_2 > 1){
            digito_verificacion = 11 - control_mod_2;
        }else { 
            digito_verificacion = control_mod_2; 
        }
        $("#<?php echo $this->campoSeguro('digito_ordenador')?>").val(digito_verificacion);
    }
};

$("#<?php echo $this->campoSeguro('pais')?>").change(function(){
    if($("#<?php echo $this->campoSeguro('pais')?>").val() != ''){
        consultarDepartamentoExp();
    }else{
        $("#<?php echo $this->campoSeguro('departamento')?>").attr('disabled','');
    }
});
                      
$("#<?php echo $this->campoSeguro('departamento')?>").change(function(){
    if($("#<?php echo $this->campoSeguro('departamento')?>").val() != ''){
        consultarCiudadExp();
    }else{
        $("#<?php echo $this->campoSeguro('ciudad')?>").attr('disabled','');
    }
});

function consultarDepartamentoExp(elem, request, response){
  $.ajax({
    url: "<?php echo $urlFinalExpDep?>",
    dataType: "json",
    data: { valor:$("#<?php echo $this->campoSeguro('pais')?>").val()},
    success: function(data){
        if(data[0]!=" "){
            $("#<?php echo $this->campoSeguro('departamento')?>").html('');
            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('departamento')?>");
            $.each(data , function(indice,valor){
                $("<option value='"+data[ indice ].id_departamento+"'>"+data[ indice ].nombre+"</option>").appendTo("#<?php echo $this->campoSeguro('departamento')?>");
                
            });
            
            $("#<?php echo $this->campoSeguro('departamento')?>").removeAttr('disabled');
            
            //$('#<?php echo $this->campoSeguro('departamentoExpeNat')?>').width(250);
            $("#<?php echo $this->campoSeguro('departamento')?>").select2();
            
            $("#<?php echo $this->campoSeguro('departamento')?>").removeClass("validate[required]");
            $("#<?php echo $this->campoSeguro('pais')?>").removeClass("validate[required]");
            
        }
        
            
    }
                        
   });
};
    
    
    
function consultarCiudadExp(elem, request, response){
  $.ajax({
    url: "<?php echo $urlFinalExpCiu?>",
    dataType: "json",
    data: { valor:$("#<?php echo $this->campoSeguro('departamento')?>").val()},
    success: function(data){ 
        if(data[0]!=" "){
            $("#<?php echo $this->campoSeguro('ciudad')?>").html('');
            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('ciudad')?>");
            $.each(data , function(indice,valor){
                $("<option value='"+data[ indice ].id_ciudad+"'>"+data[ indice ].nombreciudad+"</option>").appendTo("#<?php echo $this->campoSeguro('ciudad')?>");
                
            });
            
            $("#<?php echo $this->campoSeguro('ciudad')?>").removeAttr('disabled');
            
            //$('#<?php echo $this->campoSeguro('ciudadExpeNat')?>').width(250);
            $("#<?php echo $this->campoSeguro('ciudad')?>").select2();
            
            $("#<?php echo $this->campoSeguro('ciudad')?>").removeClass("validate[required]");
            
            }
                
    }
                        
   });
};

</script>
