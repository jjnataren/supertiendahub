(function ($) {

    let dataTable = null;
    let dataTableSelection = null;
    let dataTableUpdated = null;

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

    let contenidoDefault = 'No definido';

    let settings = {
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex === 0 && newIndex === 1) {
                if (isTableEmpty(dataTable)) {
                    return false;
                }
            }
            if (currentIndex === 1 && newIndex === 2) {

            }
            return true;
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            if (currentIndex === 1 && priorIndex === 0) {
                generarTablaSeleccion();
            }
        },
        enableAllSteps: false,
        enableKeyNavigation: false,
        enablePagination: false,
        forceMoveForward: true,
        labels: {
            cancel: 'Cancelar',
            current: 'Actual',
            finish: 'Terminar',
            next: 'Siguiente',
            previous: 'Anterior'
        }
    };

    let generarSnapshotView = function (data) {
        $('#snap_name').text(data.nombre);
        $('#snap_desc').text(data.descripcion);
        $('#snap_records_value').text(data.numero_registros);
        $('#snap_records_date').text(data.fecha_creacion);
    };

    let generarTablaSeleccion = function () {
        if (!$.fn.dataTable.isDataTable("#prestashop_table_selection")) {
            dataTableSelection = $('#prestashop_table_selection').DataTable({
                data: getCurrentSelection(),
                columns: [
                    {"data": "sku", defaultContent: contenidoDefault},
                    {"data": "precio", defaultContent: contenidoDefault},
                    {"data": "precio_original", defaultContent: contenidoDefault},
                ],
                language: language
            });
        } else {
            dataTableSelection.clear();
            dataTableSelection.rows.add(getCurrentSelection());
            dataTableSelection.draw();
        }
    };

    let generarTablaSincronizacion = function (data) {
        if (!$.fn.dataTable.isDataTable("#prestashop_table")) {
            dataTable = $('#prestashop_table').DataTable({
                data: data,
                columns: [
                    {"data": "sku"},
                    {"data": "id_prestashop", defaultContent: contenidoDefault},
                    {"data": "marca", defaultContent: contenidoDefault},
                    {"data": "serie", defaultContent: contenidoDefault},
                    {"data": "precio", defaultContent: contenidoDefault},
                    {"data": "precio_original", defaultContent: contenidoDefault},
                    {"data": "cambio", defaultContent: contenidoDefault},
                    {"data": "tipo_cambio", render: formatTipoCambio, defaultContent: contenidoDefault}
                ],
                language: language
            });
            $('#prestashop_table tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                if (dataTable.rows('.selected').data().length > 0) {
                    $('#update_button').prop('disabled', false);
                } else {
                    $('#update_button').prop('disabled', true);
                }
            });
        } else {
            dataTable.clear();
            dataTable.rows.add(data);
            dataTable.draw();
        }
        scrollable();
    };

    let formatTipoCambio = function (data, type, row) {
        if (type === 'display' && (data === undefined || data === null)) {
            return 'No definido';
        }

        if (type === 'display') {
            if (data === 0) {
                return 'Cambio de precio'
            } else if (data === 1) {
                return 'Alta en tienda';
            } else if (data === 2) {
                return 'Habilitar en tienda';
            } else if (data === 3) {
                return 'Inhabilitar en tienda';
            } else if (data === 4) {
                return 'Sin cambios';
            } else if (data === 5) {
                return 'Alta en sistema';
            } else if (data === 6) {
                return 'Cambio de cantidad';
            }

            return data;
        }

        return data;
    };

    let generarTablaActualizacion = function (data) {
        if (!$.fn.dataTable.isDataTable("#prestashop_table_updated")) {
            dataTableUpdated = $('#prestashop_table_updated').DataTable({
                data: data,
                columns: [
                    {"data": "sku", defaultContent: contenidoDefault},
                    {"data": "id_prestashop", defaultContent: contenidoDefault},
                    {"data": "marca", defaultContent: contenidoDefault},
                    {"data": "serie", defaultContent: contenidoDefault},
                    {"data": "precio", defaultContent: contenidoDefault},
                    {"data": "precio_original", defaultContent: contenidoDefault},
                    {"data": "cambio", defaultContent: contenidoDefault}
                ],
                language: language
            });
        } else {
            dataTableUpdated.clear();
            dataTableUpdated.rows.add(data);
            dataTableUpdated.draw();
        }
    };

    let synchronizeAction = function () {
        $.ajax({
            url: '/articulo-prestashop/synchronize',
            dataType: 'json',
            contentType: 'json',
            beforeSend: function () {
                $('#synchronize_button')
                    .html('<i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                generarTablaSincronizacion(data);
            },
            error: function (msg) {
                console.log(msg);
                swal({
                    title: 'Ocurri&oacute; un error.',
                    text: 'Por favor consulte a su proveedor',
                    type: 'error'
                });
            },
            complete: function () {
                $('#synchronize_button')
                    .html('<i class="fa fa-search"></i>Buscar')
                    .prop('disabled', false);
            }
        });

    };

    let isTableEmpty = function (table) {
        return table === null || table.data().length === 0;
    };


    let getCurrentSelection = function () {
        if (dataTable !== null) {
            return dataTable.rows('.selected').data().toArray();
        }

        return [];
    };

    let clickUpdate = function () {
        $.ajax({
            url: '/articulo-prestashop/update-prices',
            method: 'POST',
            dataType: 'json',
            contentType: 'json',
            data: JSON.stringify(dataTable.rows('.selected').data().toArray()),
            beforeSend: function () {
                $('#update_button')
                    .html('<i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                generarTablaActualizacion(data);
            },
            error: function (msg) {
                console.log(msg);
                swal({
                    title: 'Ocurri&oacute; un error.',
                    text: 'Por favor consulte a su proveedor',
                    type: 'error'
                });
            },
            complete: function () {
                $('#update_button')
                    .html('<i class="fa fa-refresh"></i>Actualizar')
                    .prop('disabled', true);
                $.pjax.reload({
                    container: '#prestashop_articles'
                });
            }
        });
    };

    let clickSnapshot = function () {
        $.ajax({
            url: '/articulo-prestashop-snap/create-snapshot',
            success: function (data) {
                console.log(data);
                generarSnapshotView(data);
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
    };

    let wizardNext = function () {
        $('#wizard').steps("next");
    };

    let scrollable = function () {
        console.log('Entre al scroll');
        $('.content').css({"overflow": "scroll"})
    };

    $('#wizard').steps(settings);
    $('#synchronize_button').on('click', synchronizeAction);
    $('#update_button').on('click', clickUpdate);
    $('#snapshot_button').on('click', clickSnapshot);
    $('#synchronize_button_next').on('click', wizardNext);
    $('#validation_button_next').on('click', wizardNext);
    $('#snapshot_button_next').on('click', wizardNext);


})(jQuery);