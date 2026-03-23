$(function() {
    $('#ok-button').on('click', function() {
        var error = $('#error');
        var result = $('#result');
        var url = $('#url').val();
        error.html('');
        result.html('');

        if (!url) {
            error.html('Введите ссылку');
            return;
        }

        $.post("/site/validate", {
            url: url,
            _csrf: yii.getCsrfToken()
        }, function(response) {
            if (response.success) {
                result.html('' +
                    '<img style="width:500px" src="' + response.qrcode + '" />' +
                    '<a target="_blank" href="' + response.link + '">' + response.link + '</a>'
                );
            } else {
                error.html(response.message);
            }
        }, 'json').fail(function() {
            error.html('ошибка сервера');
        });
    });
});
