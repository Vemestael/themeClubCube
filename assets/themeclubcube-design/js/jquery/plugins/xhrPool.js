/**
 * Плагин позволяющий останавливать все ajax запросы.
 * Пример использования $.xhrPool.abortAll();
 */
(function($) {
    $.xhrPool = {};

    $.xhrPool.abortAll = function() {
        $.each(this, function(pool, map) {
            $.each(map, function(idx, jqXHR) {
                if(jqXHR && jqXHR.readystate != 4){
                    jqXHR.abort();
                }
                $.xhrPool[pool].splice(idx, 1);
            });
        });
    };

    $.xhrPool.abort = function(pool) {
        if (typeof this[pool] != "undefined") {
            $.each(this[pool], function(idx, jqXHR) {
                try {jqXHR.abort();} catch (e) {}
                $.xhrPool[pool].splice(idx, 1);
            });
        }
    };

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        var pool = options.xhrpool || "global";

        if ( ! $.xhrPool[pool]) {
            $.xhrPool[pool] = [];
        }

        $.xhrPool[pool].push(jqXHR);
    });
})(jQuery);