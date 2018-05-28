(function ($) {

    let dataTable = null;

    let synchronizeAction = function () {

        $.ajax({
            url: '/articulo-meli/synchronize',
            beforeSend: function (jqXHR, settings) {
                $('#synchronize_button')
                    .html('<i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                if (!$.fn.dataTable.isDataTable("#meli_table")) {
                    dataTable = $('#meli_table').DataTable({
                        "data": data,
                        "columns": [
                            {"data": "sku"},
                            {"data": "id_meli"},
                            {"data": "marca"},
                            {"data": "serie"},
                            {"data": "precio"},
                            {"data": "cambio"}
                        ]
                    });

                    $('#meli_table tbody').on('click', 'tr', function () {
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

            },
            error: function (msg) {
                console.log(msg);
            },
            complete: function () {
                $('#synchronize_button')
                    .html('<i>Sincronizar</i>')
                    .prop('disabled', false);
            }
        });

    };

    let clickUpdate = function () {
        $.ajax({
            url: '/articulo-meli/update-prices',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(dataTable.rows('.selected').data().toArray()),
            success: function (data) {
                console.log(data);
            },
            error: function (msg) {
                console.log(msg);
            },
            complete: function () {
                location.reload();
            }
        });
    };

    let clickSnapshot = function () {
        $.ajax({
            url: '/articulo-meli-snap/create-snapshot',
            success: function (data) {
                console.log(data);
            },
            error: function (msg) {
                console.log(msg);
            },
            complete: function () {
                location.reload();
            }
        });
    };

    $('#synchronize_button').on('click', synchronizeAction);
    $('#update_button').on('click', clickUpdate);
    $('#snapshot_button').on('click', clickSnapshot);

})(jQuery);