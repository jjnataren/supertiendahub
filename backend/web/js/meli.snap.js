(function ($) {

    let clickSnapshot = function () {
        $.ajax({
            url: '/articulo-meli-snap/create-snapshot',
            success: function (data) {
                console.log(data);
                swal({
                    title: 'Se gener&oacute; el snapshot.',
                    type: 'success'
                });

                $.pjax.reload({
                    container: '#meli_snap'
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

    $('#snapshot_button').on('click', clickSnapshot);

})(jQuery);