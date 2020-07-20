function downloadJSAtOnload(src, complete) {
    var element = document.createElement("script");
    element.src = src;
    document.body.appendChild(element);

    if( typeof complete === 'function'){
        element.onload = function(){
            complete();
        }
    }
}

function downloadCSSAtOnload(src, complete) {
    var element = document.createElement("link");
    element.href = src;
    element.rel = 'stylesheet';
    element.type = 'text/css';
    document.body.appendChild(element);

    if( typeof complete === 'function'){
        element.onload = function(){
            complete();
        }
    }
}
 
function downloadJSCSSAtOnloadAll() {
    if(typeof cssDeferred != "undefined" && cssDeferred != '') {
        downloadCSSAtOnload(cssDeferred, function(){
            if(typeof jsDeferred != "undefined") {
                downloadJSAtOnload(jsDeferred);
            }
        });
    } else if(typeof jsDeferred != "undefined" && jsDeferred != '') {
        downloadJSAtOnload(jsDeferred);
    }
}

function checkJquery(jquerySource) {
    if(jquerySource != '') {
        downloadJSAtOnload(jquerySource, function(){
            downloadJSCSSAtOnloadAll();
        });
    } else {
        downloadJSCSSAtOnloadAll();
    }
}

if (window.addEventListener)
    window.addEventListener("load", checkJquery(jquerySource), false);
else if (window.attachEvent)
    window.attachEvent("onload", checkJquery(jquerySource));
else window.onload = checkJquery(jquerySource);