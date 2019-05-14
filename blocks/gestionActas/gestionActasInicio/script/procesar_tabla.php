<script type='text/javascript'>

    $(function () {

        $('#tablaContratosAprobados').ready(function () {

            var table = $('#tablaContratosAprobados').dataTable({
                    "aaSorting": [[ 5, "desc" ]] ,  
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
                        {sWidth: "8%"}, 
                        {sWidth: "8%"}, 
                        {sWidth: "16%"}, 
                        {sWidth: "14%"},
                        {sWidth: "8%"},
                        {sWidth: "8%"},
                        {sWidth: "8%"},
                        {sWidth: "7%"},
                        {sWidth: "5%"},
                        {sWidth: "5%"},
                       {sWidth: "7%"}, 
                       {sWidth: "7%"}, 
                       {sWidth: "7%"}  
                    ]

                });



        });


        $('#tablaContratosAprobadosNov').ready(function () {

            var table = $('#tablaContratosAprobadosNov').dataTable({
                    "aaSorting": [[ 5, "desc" ]] ,  
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
                        {sWidth: "8%"}, 
                        {sWidth: "8%"}, 
                        {sWidth: "8%"}, 
                        {sWidth: "12%"}, 
                        {sWidth: "10%"},
                        {sWidth: "8%"},
                        {sWidth: "8%"},
                        {sWidth: "8%"},
                        {sWidth: "7%"},
                        {sWidth: "5%"},
                        {sWidth: "5%"},
                       {sWidth: "7%"}, 
                       {sWidth: "7%"}, 
                       {sWidth: "7%"}  
                    ]

                });



        });
        

    });
    $(function () {

        $('#tablaPolizas').ready(function () {

            var table = $('#tablaPolizas').dataTable({
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
                    {sWidth: "10%"},
                    {sWidth: "20%"},
                    {sWidth: "15%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                   
             
                   
                ]

            });



        });

    });
    $(function () {

        $('#tablaAmparos').ready(function () {

            var table = $('#tablaAmparos').dataTable({
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
                    {sWidth: "10%"},
                    {sWidth: "20%"},
                    {sWidth: "15%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                    {sWidth: "10%"},
                 
                   
                ]

            });



        });

    });



</script>
