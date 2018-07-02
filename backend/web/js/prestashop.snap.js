(function ($) {

    let clickSnapshot = function () {
        $.ajax({
            url: '/articulo-prestashop-snap/create-snapshot',
            success: function (data) {
                console.log(data);
                swal({
                    title: 'Se gener&oacute; el snapshot.',
                    type: 'success'
                });

                $.pjax.reload({
                    container: '#prestashop_snap'
                });
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

    let clickSnapshotRestore = function () {
        $.ajax({
            url: '/articulo-prestashop-snap/restore-snapshot',
            success: function (data) {
                console.log(data);
                swal({
                    title: 'Se restaur&oacute; el snapshot.',
                    type: 'success'
                });
            },
            error: function (msg) {
                console.log(msg);
                swal({
                    title: 'Ocurri&oacute; un error.',
                    text: 'Por favor consulte a su proveedor',
                    type: 'error'
                });
            },
            beforeSend: function () {
                $('#snapshot_restore_button')
                    .html('<i class="fa fa-spinner fa-spin"></i> Procesando')
                    .prop('disabled', true);
            },
            complete: function () {
                $('#snapshot_restore_button')
                    .text('Restaurar Snapshot')
                    .prop('disabled', false);
            }
        });
    };

    $('#snapshot_button').on('click', clickSnapshot);
    $('#snapshot_restore_button').on('click', clickSnapshotRestore);

})(jQuery);