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

    $('#snapshot_button').on('click', clickSnapshot);

})(jQuery);