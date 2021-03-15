$(document).ready(function() {
    $('.save-button').each(function(index) {
        var $el = $(this);
        var id = $el.attr('data-id');
        var url = $el.attr('data-url');
        var tags = $el.attr('data-tags');
        var token = $el.attr('data-token');
        var webformatURL = $el.attr('data-webformatURL');
        var largeImageURL = $el.attr('data-largeImageURL');

        var data = {
            id: id,
            webformatURL: webformatURL,
            largeImageURL: largeImageURL,
            tags: tags,
            _token: token
        };

        $el.click(function () {
            $.post(url, data)
                .done(function(res) {
                    alert(res);
                })
                .fail(function (err ) {
                    alert('Server error: Something went wrong.');
                });
        });
    });
});
