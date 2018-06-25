(function (yii) {
    yii.confirm = function (message, okCallback, cancelCallback) {
        swal({
            titleText: message,
            type: 'warning',
            showCancelButton: true,
        }).then(function (result) {
            if (result.value) {
                !okCallback || okCallback();
            } else {
                !cancelCallback || cancelCallback();
            }
        });
    };
})(yii);