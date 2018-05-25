(function ($) {

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

    $('#synchronize_button').click(function () {

        $.ajax({
            url: '/articulo-prestashop/synchronize',
            timeout: 0,
            success: function (data) {
                console.log(data);
            },
            error: function (msg) {
                console.log(msg);
            }
        });

    });

})(jQuery);