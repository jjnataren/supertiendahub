(function ($) {

    let importar = function (e) {
        console.log(e.currentTarget.getAttribute('data-sku'));
        let row = $('#ps_to_hub_table')
            .DataTable()
            .row($(this).parents('tr'));

        $(this)
            .html('<i class="fa fa-spinner fa-spin"></i>')
            .prop('disabled', true);

        $.ajax({
            url: '/articulo-prestashop-to-hub/import',
            method: 'POST',
            dataType: 'json',
            contentType: 'json',
            data: e.currentTarget.getAttribute('data-sku'),
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);

                $(this)
                    .html('Importar Cantidad')
                    .prop('disabled', false);

                swal({
                    title: 'Ocurri&oacute; un error.',
                    text: 'Por favor consulte a su proveedor',
                    type: 'error'
                });
            },
            success: function (data) {
                console.log(data);
                row.remove().draw();
            }
        });
    };

    let redraw = function () {
        $('.import').off('click').on('click', importar);
    };

    $('#ps_to_hub_table').on('init.dt', redraw).DataTable().on('draw', redraw);

})(jQuery);