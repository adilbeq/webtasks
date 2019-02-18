(function ($) {

    wp.customize('bg_color', function (value) {
        value.bind(function (newval) {
            $('body').css('background-color', newval);
        });
    });

    wp.customize('jqueryui_slider', function (value) {
        value.bind(function (newval) {
            $('p').css('font-size', newval + 'px');
        });
    });

})(jQuery);