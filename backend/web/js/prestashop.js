(function ($) {

    let pollInterval = null;

    poll = function (id) {
        $.ajax({
            url: '/articulo-prestashop/status?id=' + id,
            success: function (data) {
                console.log(data);
                if (data) {
                    clearInterval(pollInterval);
                    $('#synchronize_button')
                        .html('<i>Sincronizar</i>')
                        .prop('disabled', false);
                }
            },
            error: function (msg) {
                console.log(msg);
                clearInterval(pollInterval);
                $('#synchronize_button')
                    .html('<i>Sincronizar</i>')
                    .prop('disabled', false);
            },
        })
    };

    synchronizeAction = function () {

        $.ajax({
            url: '/articulo-prestashop/synchronize',
            beforeSend: function (jqXHR, settings) {
                $('#synchronize_button')
                    .html('<i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                pollInterval = setInterval(function () {
                    poll(data);
                }, 5000);
            },
            error: function (msg) {
                console.log(msg);
                $('#synchronize_button')
                    .html('<i>Sincronizar</i>')
                    .prop('disabled', false);
            }
        });

    };

    $('#show_button').click(function () {

        $.ajax({
            url: '/articulo-prestashop/list',
            success: function (data) {
                console.log(data);
            },
            error: function (msg) {
                console.log(msg);
            }
        });

    });

    $('#synchronize_button').click(synchronizeAction);

})(jQuery);