(function ($) {

    let validarConfiguracion = function () {
        $.ajax({
            url: '/articulo-prestashop-config/proof-service',
            dataType: 'json',
            contentType: 'json',
            beforeSend: function () {
                $('#validate_conifg')
                    .html('<i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                if (data) {
                    swal({
                        title: '&Eacute;xito.',
                        text: 'Los datos son correctos.',
                        type: 'success',
                        showCancelButton: false,
                    });
                } else {
                    swal({
                        title: 'Error.',
                        text: 'Los datos no son correctos.',
                        type: 'warning',
                        showCancelButton: false,
                    });
                }
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
                $('#validate_conifg')
                    .html('Validar configuraci&oacute;n')
                    .prop('disabled', false);
            }
        });
    };

    $('#validate_conifg').on('click', validarConfiguracion);
})(jQuery);