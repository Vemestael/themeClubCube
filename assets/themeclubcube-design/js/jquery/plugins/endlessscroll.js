(function($) {
    var vars = {
        page : 1
    }

    $.fn.endlessscroll = function(options) {

        var settings = $.extend({
            'container'      : '#containerItems',
            'pages'          : '#pages',
            'total'          : 0,
            'loader'         : '#pagination-loader',
        }, options);

        var stopped=0;
        var content;
        var prefixItem = 'page=';
        var nowItem = 0;
        var procent = 0;

        vars.total = settings.total;
        var loader = $(settings.loader);
        var init = function() {
            vars.page = 1;
            $(settings.pages).hide();
        }

        var show = function() {
            var checkAjax = $(settings.container).parent().hasClass('blocks');
            var url = $(settings.pages + ' .next a').attr('href');
            if (typeof url != "undefined") {
                var arr = url.split('?');
                if(stopped == 0){
                    if(arr[1].substr(prefixItem.length) != vars.page) {
                        vars.page = arr[1].substr(prefixItem.length);
                        stopped = 1;
                        $.ajax({
                            type: "POST",
                            url: url,
                            dataType: "html",
                            cache: false,
                            beforeSend: function(jqXHR){
                                loader.addClass('active');
                                $.ajaxPrefilter(jqXHR);
                            },
                            success: function (data) {
                                loader.removeClass('active');
                                if(checkAjax == $(settings.container).parent().hasClass('blocks')){
                                    var html = $(data).find(settings.container).html();
                                    var pages = $(data).find(settings.pages);
                                    $(settings.container).append(html);
                                    $(settings.pages).remove();
                                    pages.after(settings.container);
                                    pages.hide();
                                    stopped = 0;
                                }
                            }
                        });
                    }
                }
            }
        }

        $(window).scroll(function() {
            if (($(document).height()-$(window).height()-$(document).scrollTop()) < 300) {
                show();
            }
        });

        return this.each(function(){
            init();
        });
    };
})(jQuery);