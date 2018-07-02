(function ($) {

    let dataTableMeliHub = null;
    let dataTableMeliOnline = null;
    let dataTablePrestashopHub = null;
    let dataTablePrestashopOnline = null;

    let language = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "&Uacute;ltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };

    let generarTablaHubOnlineMeli = function (data) {
        if (!$.fn.dataTable.isDataTable("#meli_hub_online_table")) {
            dataTableMeliOnline = $('#meli_hub_online_table').DataTable({
                data: data,
                columns: [
                    {"data": "id_meli"},
                    {"data": "reference"},
                    {"data": "price"},
                    {"data": "price_hub"},
                ],
                language: language
            });
        } else {
            dataTableMeliOnline.clear();
            dataTableMeliOnline.rows.add(data);
            dataTableMeliOnline.draw();
        }
    };

    let generarTablaHubOnlinePrestashop = function (data) {
        if (!$.fn.dataTable.isDataTable("#prestashop_hub_online_table")) {
            dataTablePrestashopOnline = $('#prestashop_hub_online_table').DataTable({
                data: data,
                columns: [
                    {"data": "id_prestashop"},
                    {"data": "reference"},
                    {"data": "price"},
                    {"data": "price_hub"},
                ],
                language: language
            });
        } else {
            dataTablePrestashopOnline.clear();
            dataTablePrestashopOnline.rows.add(data);
            dataTablePrestashopOnline.draw();
        }
    };

    let generarTablaHubMeli = function (data) {
        if (!$.fn.dataTable.isDataTable("#meli_hub_table")) {
            dataTableMeliHub = $('#meli_hub_table').DataTable({
                data: data,
                columns: [
                    {"data": "sku"},
                    {"data": "descripcion"},
                    {"data": "precio", render: formatCurrency},
                    {"data": "precio_meli", render: formatCurrency},
                    {"data": "precio_utilidad", render: formatCurrency},
                ],
                language: language
            });
        } else {
            dataTableMeliHub.clear();
            dataTableMeliHub.rows.add(data);
            dataTableMeliHub.draw();
        }
    };

    let generarTablaHubPrestashop = function (data) {
        if (!$.fn.dataTable.isDataTable("#prestashop_hub_table")) {
            dataTablePrestashopHub = $('#prestashop_hub_table').DataTable({
                data: data,
                columns: [
                    {data: "sku"},
                    {data: "descripcion"},
                    {data: "precio", render: formatCurrency},
                    {data: "precio_prestashop", render: formatCurrency},
                    {data: "precio_utilidad", render: formatCurrency},
                ],
                language: language
            });
        } else {
            dataTablePrestashopHub.clear();
            dataTablePrestashopHub.rows.add(data);
            dataTablePrestashopHub.draw();
        }
    };

    let formatCurrency = function (data, type, row) {
        console.log(type);
        console.log(data);

        return type === 'display' ? '$' + data + ' MXN' : data;
    };

    let showHubMeliDiferences = function (e) {
        e.preventDefault();
        console.log(e.target.hash);

        if (e.target.hash === '#tab_ml_sync_comp') {
            $.ajax({
                url: '/articulo-meli/hub-meli',
                dataType: 'json',
                contentType: 'json',
                success: function (data) {
                    console.log(data);
                    generarTablaHubMeli(data);
                },
                error: function (msg) {
                    console.log(msg);
                    swal({
                        title: 'Ocurri&oacute; un error.',
                        text: 'Por favor consulte a su proveedor',
                        type: 'error'
                    });
                },
            });
        } else if (e.target.hash === '#tab_ml_sync_comp_hub') {
            $.ajax({
                url: '/articulo-meli/hub-online-meli',
                dataType: 'json',
                contentType: 'json',
                success: function (data) {
                    console.log(data);
                    generarTablaHubOnlineMeli(data);
                },
                error: function (msg) {
                    console.log(msg);
                    swal({
                        title: 'Ocurri&oacute; un error.',
                        text: 'Por favor consulte a su proveedor',
                        type: 'error'
                    });
                },
            });
        }
    };

    let showHubPrestashopDiferences = function (e) {
        e.preventDefault();
        console.log(e.target.hash);

        if (e.target.hash === '#tab_ps_sync_comp') {
            $.ajax({
                url: '/articulo-prestashop/hub-prestashop',
                dataType: 'json',
                contentType: 'json',
                success: function (data) {
                    console.log(data);
                    generarTablaHubPrestashop(data);
                },
                error: function (msg) {
                    console.log(msg);
                    swal({
                        title: 'Ocurri&oacute; un error.',
                        text: 'Por favor consulte a su proveedor',
                        type: 'error'
                    });
                },
            });
        } else if (e.target.hash === '#tab_sync_ps_pson') {
            $.ajax({
                url: '/articulo-prestashop/hub-online-prestashop',
                dataType: 'json',
                contentType: 'json',
                success: function (data) {
                    console.log(data);
                    generarTablaHubOnlinePrestashop(data);
                },
                error: function (msg) {
                    console.log(msg);
                    swal({
                        title: 'Ocurri&oacute; un error.',
                        text: 'Por favor consulte a su proveedor',
                        type: 'error'
                    });
                },
            });
        }

    };

    $('#tabs_mercadolibre a[data-toggle="tab"]').on('shown.bs.tab', showHubMeliDiferences);
    $('#tabs_prestashop a[data-toggle="tab"]').on('shown.bs.tab', showHubPrestashopDiferences);

})(jQuery);