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
$cadenaACodificar .= "&funcion=SeleccionTipoBien";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlFinal = $url . $cadena;

// Variables
$cadenaACodificarProveedor = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarProveedor .= "&procesarAjax=true";
$cadenaACodificarProveedor .= "&action=index.php";
$cadenaACodificarProveedor .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarProveedor .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarProveedor .= "&funcion=consultaProveedor";
$cadenaACodificarProveedor .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarProveedor, $enlace);

// URL definitiva
$urlFinalProveedor = $url . $cadena;

// Variables
$cadenaACodificarNumeroOrden = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarNumeroOrden .= "&procesarAjax=true";
$cadenaACodificarNumeroOrden .= "&action=index.php";
$cadenaACodificarNumeroOrden .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarNumeroOrden .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarNumeroOrden .= $cadenaACodificarNumeroOrden . "&funcion=consultarDependencia";
$cadenaACodificarNumeroOrden .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena16 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarNumeroOrden, $enlace);

// URL definitiva
$urlFinal16 = $url . $cadena16;



// Variables
$cadenaACodificarNumeroOrden = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarNumeroOrden .= "&procesarAjax=true";
$cadenaACodificarNumeroOrden .= "&action=index.php";
$cadenaACodificarNumeroOrden .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarNumeroOrden .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarNumeroOrden .= $cadenaACodificarNumeroOrden . "&funcion=consultarNumeroOrden";
$cadenaACodificarNumeroOrden .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlaceNumeroOrden = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaNumeroOrden = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarNumeroOrden, $enlace);

// URL definitiva
$urlFinalNumeroOrden = $url . $cadenaNumeroOrden;



// Variables
$cadenaACodificariva = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificariva .= "&procesarAjax=true";
$cadenaACodificariva .= "&action=index.php";
$cadenaACodificariva .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificariva .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificariva .= "&funcion=consultarIva";
$cadenaACodificariva .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaiva = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificariva, $enlace);

// URL definitiva
$urlFinaliva = $url . $cadenaiva;


$cadenaACodificarProveedorFiltro = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarProveedorFiltro .= "&procesarAjax=true";
$cadenaACodificarProveedorFiltro .= "&action=index.php";
$cadenaACodificarProveedorFiltro .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarProveedorFiltro .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarProveedorFiltro .= $cadenaACodificarProveedorFiltro . "&funcion=consultarProveedorFiltro";
$cadenaACodificarProveedorFiltro .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaACodificarProveedorFiltro = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarProveedorFiltro, $enlace);

// URL definitiva
$urlProveedorFiltro = $url . $cadenaACodificarProveedorFiltro;

// Variables
$cadenaACodificarDependencia = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarDependencia .= "&procesarAjax=true";
$cadenaACodificarDependencia .= "&action=index.php";
$cadenaACodificarDependencia .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarDependencia .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarDependencia .= $cadenaACodificarDependencia . "&funcion=consultarDependencias";
$cadenaACodificarDependencia .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaDependencia = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarDependencia, $enlace);

// URL definitiva
$urlFinalDependencia = $url . $cadenaDependencia;

// Variables
$cadenaACodificarValorIva = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarValorIva .= "&procesarAjax=true";
$cadenaACodificarValorIva .= "&action=index.php";
$cadenaACodificarValorIva .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarValorIva .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarValorIva .= $cadenaACodificarValorIva . "&funcion=consultarValorIva";
$cadenaACodificarValorIva .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadenaValorIva = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarValorIva, $enlace);

// URL definitiva
$urlFinalVAlorIva = $url . $cadenaValorIva;






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
$cadenaACodificar .= "&funcion=consultaContratista";
$cadenaACodificar .= "&usuario=" . $_REQUEST['usuario'];
$cadenaACodificar .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlContratista = $url . $cadena;


//Variables
$cadenaACodificarArchivo = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarArchivo .= "&procesarAjax=true";
$cadenaACodificarArchivo .= "&action=index.php";
$cadenaACodificarArchivo .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarArchivo .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarArchivo .= $cadenaACodificarArchivo . "&funcion=verificarArchivo";
$cadenaACodificarArchivo .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");

$cadenaArchivo = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarArchivo, $enlace);

// URL definitiva
$urlFinalArchivo = $url . $cadenaArchivo;
?>
<script type='text/javascript'>

    $('#<?php echo $this->campoSeguro('tipo_consulta') ?>').width(150);
    $("#<?php echo $this->campoSeguro('tipo_consulta') ?>").select2();

    $('#<?php echo $this->campoSeguro('iva') ?>').width(150);
    $("#<?php echo $this->campoSeguro('iva') ?>").select2();

//--------------Inicio JavaScript y Ajax Sede y Dependencia elemento ---------------------------------------------------------------------------------------------    

    $("#<?php echo $this->campoSeguro('iva') ?>").change(function () {
        if ($("#<?php echo $this->campoSeguro('iva') ?>").val() != '') {
            consultarValorIVA();
        }


    });




    $("#<?php echo $this->campoSeguro('sede') ?>").change(function () {

        if ($("#<?php echo $this->campoSeguro('sede') ?>").val() != '') {
            consultarDependencia();
        } else {
            $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").attr('disabled', '');
        }

    });

    function consultarDependencia(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinalDependencia ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('sede') ?>").val()},
            success: function (data) {



                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].ESF_CODIGO_DEP + "'>" + data[ indice ].ESF_DEP_ENCARGADA + "</option>").appendTo("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").removeAttr('disabled');

                    $('#<?php echo $this->campoSeguro('dependencia_solicitante') ?>').width(350);
                    $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").select2();



                }


            }

        });
    }
    ;


    function consultarValorIVA(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinalVAlorIva ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('iva') ?>").val()},
            success: function (data) {



                if (data[0] != " ") {


                    $.each(data, function (indice, valor) {

                        cantidad = Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
                        valor2 = Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
                        iva = Math.round(((cantidad * valor2) * data[ indice ].iva) * 100) / 100;
                        precio = Math.round((cantidad * valor2) * 100) / 100;
                        total = Math.round((precio + iva) * 100) / 100;


                        $("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);

                        $("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);


                    });





                }


            }

        });
    }
    ;

    //--------------Fin JavaScript y Ajax Sede y Dependencia elemento --------------------------------------------------------------------------------------------------   




    function resetIva(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinaliva ?>",
            dataType: "json",
            success: function (data) {




                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('iva') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('iva') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].id_iva + "'>" + data[ indice ].descripcion + "</option>").appendTo("#<?php echo $this->campoSeguro('iva') ?>");

                    });


                    $('#<?php echo $this->campoSeguro('iva') ?>').width(150);
                    $("#<?php echo $this->campoSeguro('iva') ?>").select2();



                }


            }

        });
    }
    ;




    function numero_orden(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinalNumeroOrden ?>",
            dataType: "json",
            data: {valor1: $("#<?php echo $this->campoSeguro('tipo_orden') ?>").val(), valor2: $("#<?php echo $this->campoSeguro('unidad_ejecutora_hidden') ?>").val()},
            success: function (data) {




                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('numero_orden') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('numero_orden') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].value + "'>" + data[ indice ].orden + "</option>").appendTo("#<?php echo $this->campoSeguro('numero_orden') ?>");

                    });


                    $("#<?php echo $this->campoSeguro('numero_orden') ?>").removeAttr('disabled');


                }


            }

        });
    }
    ;


    function consultarDependenciaConsultada(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinal16 ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('sedeConsulta') ?>").val()},
            success: function (data) {
                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].id_dependencia + "'>" + data[ indice ].ESF_DEP_ENCARGADA + "</option>").appendTo("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>").removeAttr('disabled');

                    $('#<?php echo $this->campoSeguro('dependenciaConsulta') ?>').width(300);
                    $("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>").select2();



                }


            }

        });
    }
    ;



    function tipo_bien(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinal ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('nivel') ?>").val()},
            success: function (data) {


                $("#<?php echo $this->campoSeguro('id_tipo_bien') ?>").val(data[0]);
                $("#<?php echo $this->campoSeguro('tipo_bien') ?>").val(data[1]);

                switch ($("#<?php echo $this->campoSeguro('id_tipo_bien') ?>").val())
                {


                    case '2':


                        $("#<?php echo $this->campoSeguro('devolutivo') ?>").css('display', 'none');
                        $("#<?php echo $this->campoSeguro('consumo_controlado') ?>").css('display', 'block');
                        $("#<?php echo $this->campoSeguro('cantidad') ?>").val('1');
                        $('#<?php echo $this->campoSeguro('cantidad') ?>').attr('disabled', '');

                        break;

                    case '3':

                        $("#<?php echo $this->campoSeguro('devolutivo') ?>").css('display', 'block');
                        $("#<?php echo $this->campoSeguro('consumo_controlado') ?>").css('display', 'none');
                        $("#<?php echo $this->campoSeguro('tipo_poliza') ?>").select2();
                        $("#<?php echo $this->campoSeguro('cantidad') ?>").val('1');
                        $('#<?php echo $this->campoSeguro('cantidad') ?>').attr('disabled', '');

                        break;


                        break;


                    default:

                        $("#<?php echo $this->campoSeguro('devolutivo') ?>").css('display', 'none');
                        $("#<?php echo $this->campoSeguro('consumo_controlado') ?>").css('display', 'none');


                        $("#<?php echo $this->campoSeguro('cantidad') ?>").val('');
                        $('#<?php echo $this->campoSeguro('cantidad') ?>').removeAttr('disabled');

                        break;

                }








            }

        });
    }
    ;


    $(function () {

        $(document).ajaxStart(function () {
            swal({
                title: 'Cargando ...',
                type: 'info',
                animation: false,
                showConfirmButton: false,
                customClass: 'animated tada'
            })


        });


        $("#<?php echo $this->campoSeguro('sedeConsulta') ?>").change(function () {
            if ($("#<?php echo $this->campoSeguro('sedeConsulta') ?>").val() != '') {
                consultarDependenciaConsultada();
            } else {
                $("#<?php echo $this->campoSeguro('dependenciaConsulta') ?>").attr('disabled', '');
            }

        });


        $("#<?php echo $this->campoSeguro('nitproveedor') ?>").keyup(function () {


            $('#<?php echo $this->campoSeguro('nitproveedor') ?>').val($('#<?php echo $this->campoSeguro('nitproveedor') ?>').val());


        });




        $("#<?php echo $this->campoSeguro('nitproveedor') ?>").autocomplete({
            minChars: 3,
            serviceUrl: '<?php echo $urlProveedorFiltro; ?>',
            onSelect: function (suggestion) {

                $("#<?php echo $this->campoSeguro('id_proveedor') ?>").val(suggestion.data);
            }

        });




        $("#<?php echo $this->campoSeguro('nivel') ?>").change(function () {

            if ($("#<?php echo $this->campoSeguro('nivel') ?>").val() != '') {

                tipo_bien();

            } else {
            }








        });




        $("#<?php echo $this->campoSeguro('tipo_orden') ?>").change(function () {

            if ($("#<?php echo $this->campoSeguro('tipo_orden') ?>").val() != '') {

                numero_orden();

            } else {
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
                    $("#ventanaEmergenteContratista").dialog('option', 'title', 'Convenio:');
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


    //------------------ Ajax Vigencia Contrato ---------------------------------------------------
    $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").keyup(function () {
        $('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val($('#<?php echo $this->campoSeguro('vigencia_contrato') ?>').val());

    });

    $("#<?php echo $this->campoSeguro('vigencia_contrato') ?>").autocomplete({
        minChars: 2,
        serviceUrl: '<?php echo $urlVigenciaContrato; ?>',
        onSelect: function (suggestion) {

            $("#<?php echo $this->campoSeguro('id_contrato') ?>").val(suggestion.data);
        }


    });

    //------------------ FIN  Ajax Vigencia Contrato ---------------------------------------------------
    //------------------ Ajax Contratista ---------------------------------------------------
    $("#<?php echo $this->campoSeguro('contratista') ?>").autocomplete({
        minChars: 3,
        serviceUrl: '<?php echo $urlContratista; ?>',
        onSelect: function (suggestion) {

            $("#<?php echo $this->campoSeguro('id_contratista') ?>").val(suggestion.data);
        }

    });

    $("#<?php echo $this->campoSeguro('documentos_elementos') ?>").change(function () {

        var file = $("#<?php echo $this->campoSeguro('documentos_elementos') ?>").val();
        var ext = file.substring(file.lastIndexOf("."));

        if (ext !== '.xlsx')
        {
            swal({
                title: 'Problema con el Archivo de Elementos',
                type: 'warning',
                html:
                        'Por favor cambie el archivo por otro en formato.  <i>(xlsx)</i> recuerde que puede descargar el Archivo Plantilla adjunto y cargarlo en este campo con los elementos registrados',
                confirmButtonText:
                        'Ok'
            })
            $("#<?php echo $this->campoSeguro('documentos_elementos') ?>").val(null);
        }
    });

    var sumadorBienes = 0;
    var sumadorServicios = 0;

    $("#btConfirmar").click(function () {

        if ($("#<?php echo $this->campoSeguro('tipo_consulta') ?>").val() == 1) {//ELEMENTO



              if ($("#<?php echo $this->campoSeguro('nombre') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('descripcion') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('cantidad') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('unidad') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('valor') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('iva') ?>").val() != '') {

                if ($.isNumeric($("#<?php echo $this->campoSeguro('cantidad') ?>").val()) && $("#<?php echo $this->campoSeguro('cantidad') ?>").val() > 0 && $.isNumeric($("#<?php echo $this->campoSeguro('valor') ?>").val()) && $("#<?php echo $this->campoSeguro('valor') ?>").val() > 0) {

                    var nFilas = $("#tablaFP2 tr").length;
                    
                     var dep ;
                    var fun;
                    
                    dep= $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?> option:selected").text();
                    fun= $("#<?php echo $this->campoSeguro('funcionario') ?> option:selected").text();
                    
               
                    
                    
                    if(dep==='Seleccione .....'){
                      dep=''; 
                    }
                    if(fun==='Seleccione .....'){
                      fun=''; 
                    }
                    

                    var nuevaFila = "<tr id=\"nFilas\">";
                    nuevaFila += "<td>" + (nFilas) + "</td>";
                    nuevaFila += "<td>1 - ELEMENTO</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('nombre') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('descripcion') ?>").val()) + "</td>";
                    nuevaFila += "<td></td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('cantidad') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('unidad') ?>").val()) + " - " + ($("#<?php echo $this->campoSeguro('unidad') ?> option:selected").text())+ "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('valor') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('iva') ?>").val()) + " - " + ($("#<?php echo $this->campoSeguro('iva') ?> option:selected").text()) + "</td>";
                    nuevaFila += "<td>" + dep + "</td>";
                    nuevaFila += "<td>" + fun + "</td>";
                    nuevaFila += "<th class=\"eliminarItem\" scope=\"row\"><div class = \"widget\">Eliminar</div></th>";
                    nuevaFila += "</tr>";



                    $("#tablaFP2").append(nuevaFila);

                    $("#<?php echo $this->campoSeguro('nombre') ?>").val('');
                    $("#<?php echo $this->campoSeguro('descripcion') ?>").val('');
                    $("#<?php echo $this->campoSeguro('cantidad') ?>").val('');
                    $("#<?php echo $this->campoSeguro('unidad') ?>").val('');
                    $("#<?php echo $this->campoSeguro('valor') ?>").val('');
                    $("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val('');
                    $("#<?php echo $this->campoSeguro('total_iva') ?>").val('');
                    $("#<?php echo $this->campoSeguro('total_iva_con') ?>").val('');
                    $("#<?php echo $this->campoSeguro('iva') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('sede') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('funcionario') ?>").select2("val", -1);








                    $("#<?php echo $this->campoSeguro('tabla_elementos_servicios') ?>").css('display', 'block');
                    
                    
                       fullParamIt = "";
                    $('#tablaFP2 tr').each(function () {

                        /* Obtener todas las celdas */
                        var celdas = $(this).find('td');

                        /* Mostrar el valor de cada celda */
                        celdas.each(function () {
                            fullParamIt += String($(this).html()) + "&";
                        });


                    });

                    $("#<?php echo $this->campoSeguro('idsItems') ?>").val(fullParamIt);
                    
                    

                    $("#<?php echo $this->campoSeguro('countItems') ?>").val(nFilas);
                    //-----------------------------------------------------------------------------
                    //-----------------------------------------------------------------------------


                    swal({
                        title: 'Registro Exitoso !',
                        type: 'success',
                        html:
                                'Los Parámetros de <big>Items de Elemento ó Servicio</big>, ' +
                                'Se Registraron de Forma Correcta.',
                        confirmButtonText:
                                'Ok'
                    })

                    //-----------------------------------------------------------------------------

                } else {
                    swal({
                        title: 'Ocurrio un problema...',
                        type: 'error',
                        html:
                                'Recuerde Diligenciar los Campos Cantidad y Valor como <big>Números</big>, ' +
                                'sin Puntos ni Comas, Gracias.',
                        confirmButtonText:
                                'Ok'
                    })

                }


            } else {

                swal({
                    title: 'Ocurrio un problema...',
                    type: 'error',
                    html:
                            'Los Parámetros de <big>Items de Elemento </big>, ' +
                            'están mal diligenciados o incompletos. No es Posible Registrar.',
                    confirmButtonText:
                            'Ok'
                })
            }
        }
        if ($("#<?php echo $this->campoSeguro('tipo_consulta') ?>").val() == 2) {//SERVICIO

            if ($("#<?php echo $this->campoSeguro('nombre') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('descripcion') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('tiempo_ejecucion') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('cantidad') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('unidad') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('valor') ?>").val() != '' &&
                    $("#<?php echo $this->campoSeguro('iva') ?>").val() != '') {


                if ($.isNumeric($("#<?php echo $this->campoSeguro('cantidad') ?>").val()) &&
                        $("#<?php echo $this->campoSeguro('cantidad') ?>").val() > 0 &&
                        $.isNumeric($("#<?php echo $this->campoSeguro('valor') ?>").val()) &&
                        $("#<?php echo $this->campoSeguro('valor') ?>").val() > 0 &&
                        $.isNumeric($("#<?php echo $this->campoSeguro('tiempo_ejecucion') ?>").val()) &&
                        $("#<?php echo $this->campoSeguro('tiempo_ejecucion') ?>").val() >= 0
                        ) {

                    var nFilas = $("#tablaFP2 tr").length;
                    
                    var dep ;
                    var fun;
                    
                    dep= $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?> option:selected").text();
                    fun= $("#<?php echo $this->campoSeguro('funcionario') ?> option:selected").text();
                    
                    
                    if(dep==='Seleccione .....'){
                      dep=''; 
                    }
                    if(fun==='Seleccione .....'){
                      fun=''; 
                    }


                    var nuevaFila = "<tr id=\"nFilas\">";
                    nuevaFila += "<td>" + (nFilas) + "</td>";
                    nuevaFila += "<td>2 - SERVICIO</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('nombre') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('descripcion') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('tiempo_ejecucion') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('cantidad') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('unidad') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('valor') ?>").val()) + "</td>";
                    nuevaFila += "<td>" + ($("#<?php echo $this->campoSeguro('iva') ?>").val()) + " - " + ($("#<?php echo $this->campoSeguro('iva') ?> option:selected").text()) + "</td>";
                    nuevaFila += "<td>" + dep + "</td>";
                    nuevaFila += "<td>" + fun + "</td>";
                    nuevaFila += "<th class=\"eliminarItem\" scope=\"row\"><div class = \"widget\">Eliminar</div></th>";
                    nuevaFila += "</tr>";



                    $("#tablaFP2").append(nuevaFila);

                    $("#<?php echo $this->campoSeguro('nombre') ?>").val('');
                    $("#<?php echo $this->campoSeguro('descripcion') ?>").val('');
                    $("#<?php echo $this->campoSeguro('tiempo_ejecucion') ?>").val('');
                    $("#<?php echo $this->campoSeguro('cantidad') ?>").val('');
                    $("#<?php echo $this->campoSeguro('unidad') ?>").val('');
                    $("#<?php echo $this->campoSeguro('valor') ?>").val('');
                    $("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val('');
                    $("#<?php echo $this->campoSeguro('total_iva') ?>").val('');
                    $("#<?php echo $this->campoSeguro('total_iva_con') ?>").val('');
                    $("#<?php echo $this->campoSeguro('iva') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('sede') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('dependencia_solicitante') ?>").select2("val", -1);
                    $("#<?php echo $this->campoSeguro('funcionario') ?>").select2("val", -1);






                      fullParamIt = "";
                    $('#tablaFP2 tr').each(function () {

                        /* Obtener todas las celdas */
                        var celdas = $(this).find('td');

                        /* Mostrar el valor de cada celda */
                        celdas.each(function () {
                            fullParamIt += String($(this).html()) + "&";
                        });


                    });




                    $("#<?php echo $this->campoSeguro('tabla_elementos_servicios') ?>").css('display', 'block');
                    
                     $("#<?php echo $this->campoSeguro('idsItems') ?>").val(fullParamIt);
          
                    $("#<?php echo $this->campoSeguro('countItems') ?>").val(nFilas);
                    //-----------------------------------------------------------------------------


                    swal({
                        title: 'Registro Exitoso !',
                        type: 'success',
                        html:
                                'Los Parámetros de <big>Items de Elemento ó Servicio</big>, ' +
                                'Se Registraron de Forma Correcta.',
                        confirmButtonText:
                                'Ok'
                    })

                } else {
                    swal({
                        title: 'Ocurrio un problema...',
                        type: 'error',
                        html:
                                'Recuerde Diligenciar los Campos Cantidad, Valor y Tiempo de Ejecución como <big>Números</big>, ' +
                                'sin Puntos ni Comas, Gracias.',
                        confirmButtonText:
                                'Ok'
                    })

                }


            } else {

                swal({
                    title: 'Ocurrio un problema...',
                    type: 'error',
                    html:
                            'Los Parámetros de <big>Items de Servicio</big>, ' +
                            'están mal diligenciados o incompletos. No es Posible Registrar.',
                    confirmButtonText:
                            'Ok'
                })
            }


        }


    });


    $(document).on("click", ".eliminarItem", function () {

        var parent = $(this).parents().get(0);
        var element = $(parent).text();

        var celdas = $(parent).find('td');

        var tipo_item = String($(celdas[3]).html());

        $(parent).remove();

        fullParamIt = "";
        var contNumeral = 0;
        $('#tablaFP2 tr').each(function () {

            /* Obtener todas las celdas */
            var celdas = $(this).find('td');

            $(celdas[0]).text(contNumeral);

            /* Mostrar el valor de cada celda */
            celdas.each(function () {
                fullParamIt += String($(this).html()) + "&";
            });
            contNumeral = contNumeral + 1;

        });

        $("#<?php echo $this->campoSeguro('idsItems') ?>").val(fullParamIt);


        var countF = $("#tablaFP2 tr").length - 1;

        $("#<?php echo $this->campoSeguro('countItems') ?>").val(countF);


        if (tipo_item === '1 - BIEN') {
            sumadorBienes = sumadorBienes - 1;
        }
        if (tipo_item === '2 - SERVICIO')
        {
            sumadorServicios = sumadorServicios - 1;
        }



    });




    $("#btConfirmarMasivo").click(function () {





        var inputFileImage = document.getElementById("<?php echo $this->campoSeguro('documentos_elementos') ?>");

        fileArchivo = inputFileImage.files[0];

        if (fileArchivo !== undefined) {
            dataArchivo = new FormData();
            dataArchivo.append('file', fileArchivo);
            analizarArchivo();
        } else {
            swal({
                title: 'No se ha cargado ningún archivo',
                type: 'warning',
                html:
                        'Recuerde que puede descargar el Archivo Plantilla adjunto y cargarlo en este campo con los elementos y/o servicios registrados',
                confirmButtonText:
                        'Ok'
            })
        }


    });

    function analizarArchivo(elem, request, response) {

        $.ajax({
            url: "<?php echo $urlFinalArchivo ?>",
            type: "post",
            dataType: "json",
            data: dataArchivo,
            processData: false,
            contentType: false,
            success: function (data) {

                if (data[0] != " ") {



                    $.each(data, function (indice, valor) {


                        if (data[indice].tipo.toUpperCase() == 'ELEMENTO') {
                            var nFilas = $("#tablaFP2 tr").length;

                            var count = nFilas;


                            var nuevaFila = "<tr id=\"nFilas\">";
                            nuevaFila += "<td>" + (nFilas) + "</td>";
                            nuevaFila += "<td>1 - ELEMENTO</td>";
                            nuevaFila += "<td>" + (data[indice].nombre) + "</td>";
                            nuevaFila += "<td>" + (data[indice].descripcion) + "</td>";
                            nuevaFila += "<td>" + (data[indice].tiempo_ejecucion) + "</td>";
                            nuevaFila += "<td>" + (data[indice].cantidad) + "</td>";
                            nuevaFila += "<td>" + (data[indice].unidad) + "</td>";
                            nuevaFila += "<td>" + (data[indice].valor) + "</td>";
                            nuevaFila += "<td>" + (data[indice].iva) + "</td>";
                            nuevaFila += "<td>" + (data[indice].dependencia) + "</td>";
                            nuevaFila += "<td>" + (data[indice].funcionario) + "</td>";
                            nuevaFila += "<th class=\"eliminarItem\" scope=\"row\"><div class = \"widget\">Eliminar</div></th>";
                            nuevaFila += "</tr>";



                            $("#tablaFP2").append(nuevaFila);

                            fullParamIt = "";
                            $('#tablaFP2 tr').each(function () {

                                /* Obtener todas las celdas */
                                var celdas = $(this).find('td');

                                /* Mostrar el valor de cada celda */
                                celdas.each(function () {
                                    fullParamIt += String($(this).html()) + "&";
                                });


                            });







                            $("#<?php echo $this->campoSeguro('idsItems') ?>").val(fullParamIt);

                            $("#<?php echo $this->campoSeguro('countItems') ?>").val(nFilas);

                            sumadorBienes = sumadorBienes + 1;



                        }

                        if (data[indice].tipo.toUpperCase() == 'SERVICIO') {
                            var nFilas = $("#tablaFP2 tr").length;



                            var count = nFilas;



                            var nuevaFila = "<tr id=\"nFilas\">";
                            nuevaFila += "<td>" + (nFilas) + "</td>";
                            nuevaFila += "<td>2 - SERVICIO</td>";
                            nuevaFila += "<td>" + (data[indice].nombre) + "</td>";
                            nuevaFila += "<td>" + (data[indice].descripcion) + "</td>";
                            nuevaFila += "<td>" + (data[indice].tiempo_ejecucion) + "</td>";
                            nuevaFila += "<td>" + (data[indice].cantidad) + "</td>";
                            nuevaFila += "<td>" + (data[indice].unidad) + "</td>";
                            nuevaFila += "<td>" + (data[indice].valor) + "</td>";
                            nuevaFila += "<td>" + (data[indice].iva) + "</td>";
                            nuevaFila += "<td>" + (data[indice].dependencia) + "</td>";
                            nuevaFila += "<td>" + (data[indice].funcionario) + "</td>";
                            nuevaFila += "<th class=\"eliminarItem\" scope=\"row\"><div class = \"widget\">Eliminar</div></th>";
                            nuevaFila += "</tr>";

                            $("#tablaFP2").append(nuevaFila);

                            fullParamIt = "";
                            $('#tablaFP2 tr').each(function () {

                                /* Obtener todas las celdas */
                                var celdas = $(this).find('td');

                                /* Mostrar el valor de cada celda */
                                celdas.each(function () {
                                    fullParamIt += String($(this).html()) + "&";
                                });


                            });






                            $("#<?php echo $this->campoSeguro('idsItems') ?>").val(fullParamIt);

                            $("#<?php echo $this->campoSeguro('countItems') ?>").val(nFilas);
                            sumadorServicios = sumadorServicios + 1;
//                    

                        }
                    });

                    swal({
                        title: 'Registro Exitoso !',
                        type: 'success',
                        html:
                                'Los Parámetros de <big>Items de Elemento ó Servicio</big>, ' +
                                'Se Registraron de Forma Correcta.',
                        confirmButtonText:
                                'Ok'
                    })


                    $("#<?php echo $this->campoSeguro('tabla_elementos_servicios') ?>").css('display', 'block');
                } else {

                    if (data != '') {
                        swal({
                            title: 'Ocurrio un problema...',
                            type: 'error',
                            html:
                                    'Los Datos Registrados en el Archivo de Carga se Encuentran Erroneos. Revisar la celda correspondiente : <br><br><big> ' + data + ' . </big><br><br>' +
                                    'Puede Verificar la GUIA de acuerdo al primer registro del documento plantilla para el correcto formato de los datos.',
                            confirmButtonText:
                                    'Ok'

                        })
                    } else {
                        swal({
                            title: 'Ocurrio un problema...',
                            type: 'error',
                            html:
                                    'Se ha Presentado un Error en la Carga del Archivo,  ' +
                                    'Puede Verificar la Plantilla en la Pestaña GUIA para el correcto formato de los datos.',
                            confirmButtonText:
                                    'Ok'

                        })


                    }


                }

            }
        });
    }
    ;
    //------------------ FIN  Ajax Contratista ---------------------------------------------------

</script>

