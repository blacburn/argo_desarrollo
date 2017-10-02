<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=Consulta";
$cadenaACodificar .= "&usuario=" . $_REQUEST ['usuario'];
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

    $_REQUEST ['funcionario'] = $_REQUEST ['usuario'];
    $cadenaACodificar .= "&accesoCondor='true'";
}

if (isset($_REQUEST ['funcionario']) && $_REQUEST ['funcionario'] != '') {
    $funcionario = $_REQUEST ['funcionario'];
} else {
    $funcionario = '';
}

if (isset($_REQUEST ['sede']) && $_REQUEST ['sede'] != '') {
    $sede = $_REQUEST ['sede'];
} else {
    $sede = '';
}

if (isset($_REQUEST ['dependencia']) && $_REQUEST ['dependencia'] != '') {
    $dependencia = $_REQUEST ['dependencia'];
} else {
    $dependencia = '';
}

if (isset($_REQUEST ['ubicacion']) && $_REQUEST ['ubicacion'] != '') {
    $ubicacion = $_REQUEST ['ubicacion'];
} else {
    $ubicacion = '';
}

$arreglo = array(
    'funcionario' => $funcionario,
    'sede' => $sede,
    'dependencia' => $dependencia,
    'ubicacion' => $ubicacion
);

$arreglo = serialize($arreglo);

$cadenaACodificar .= "&arreglo=" . $arreglo;

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlFinal = $url . $cadena;
?>
<script type='text/javascript'>

    $(function () {


        $('#tablaTitulos').ready(function () {


            var table = $('#tablaTitulos').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "300px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "15%"},
                    {sWidth: "15%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "15%"},
                    {sWidth: "15%"},
                    {sWidth: "15%"},
                   
                  

                ]

            });



        });

    });

    $(function () {


        $('#tablaAdicionPresupuesto').ready(function () {


            var table = $('#tablaAdicionPresupuesto').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "20%"},
                    {sWidth: "15%"},
                           
                ]

            });



        });

    });
    $(function () {


        $('#tablaAdicionTiempo').ready(function () {


            var table = $('#tablaAdicionTiempo').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "20%"},
                  
                    
                ]

            });



        });

    });


    $(function () {


        $('#tablaAnulaciones').ready(function () {


            var table = $('#tablaAnulaciones').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "15%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "20%"},
                   
                  

                ]

            });



        });

    });
    $(function () {


        $('#tablacesiones').ready(function () {


            var table = $('#tablacesiones').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "15%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "15%"},
                   
                   

                ]

            });



        });

    });
    $(function () {


        $('#tablareducciones').ready(function () {


            var table = $('#tablareducciones').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "15%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    

                ]

            });



        });

    });
    $(function () {


        $('#tablacambioSupervisor').ready(function () {


            var table = $('#tablacambioSupervisor').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "12.5%"},
                   
                   

                ]

            });



        });

    });
    $(function () {


        $('#tablasuspension').ready(function () {


            var table = $('#tablasuspension').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "12.5%"},
                    

                ]

            });



        });

    });
    $(function () {


        $('#tablaotras').ready(function () {


            var table = $('#tablaotras').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "20px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "12.5%"},
                   
                   

                ]

            });



        });

    });


    $(function () {


        $('#tablaNovedadesContrato').ready(function () {


            var table = $('#tablaNovedadesContrato').dataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                info: true,
                "scrollY": "200px",
                "scrollCollapse": false,
                "bLengthChange": false,
                "bPaginate": false,
                "aoColumns": [
                    {sWidth: "5%"},
                    {sWidth: "10%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "5%"},
                    {sWidth: "12.5%"},
                    {sWidth: "12.5%"},
                    {sWidth: "5%"}

                ]

            });



        });

    });







</script>