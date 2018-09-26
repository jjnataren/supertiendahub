(function ($) {

    let exportar = function (e) {
        console.log(e.currentTarget.getAttribute('data-sku'));
        let row = $('#hub_price_to_ps_table')
            .DataTable()
            .row($(this).parents('tr'));

        $(this)
            .html('<i class="fa fa-spinner fa-spin"></i>')
            .prop('disabled', true);

        $.ajax({
            url: '/articulo-prestashop-price-from-hub/export',
            method: 'POST',
            dataType: 'json',
            contentType: 'json',
            data: e.currentTarget.getAttribute('data-sku'),
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);

                $(this)
                    .html('Exportar Cantidad')
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

    let exportar_todo = function () {

        let content = [];

        $(this)
            .html('<i class="fa fa-spinner fa-spin"></i>')
            .prop('disabled', true);

        let data = $('#hub_price_to_ps_table')
            .DataTable()
            .data()
            .each(function (d) {
                content.push(JSON.parse($(d[4]).attr('data-sku')));
            });

        console.log(content);

        $.ajax({
            url: '/articulo-prestashop-price-from-hub/export-all',
            method: 'POST',
            dataType: 'json',
            contentType: 'json',
            data: JSON.stringify(content),
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);

                swal({
                    title: 'Ocurri&oacute; un error.',
                    text: 'Por favor consulte a su proveedor',
                    type: 'error'
                });
            },
            success: function (data) {
                console.log(data);
                $('#hub_price_to_ps_table')
                    .DataTable()
                    .clear()
                    .draw();
            }
        });

    };

    let redraw = function () {
        $('.export-price').off('click').on('click', exportar);
    };

    $('#hub_price_to_ps_table').on('init.dt', redraw).DataTable().on('draw', redraw);

    $('#export_all_price').on('click', exportar_todo);

})(jQuery);0