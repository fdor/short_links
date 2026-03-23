$(function() {
    $('#ok-button').on('click', function() {
        var error = $('#error');
        var url = $('#url').val();
        error.html('');

        $.post("/site/validate", {
            url: url,
            _csrf: yii.getCsrfToken()
        }, function(response) {
            if (response.success) {
                $('#container').html(response.message);
            } else {
                error.html(response.message);
            }
        }, 'json').fail(function() {
            error.html('ошибка сервера');
        });
    });
});
