$(function(){
    if(global.cultureKey != 'en') {
        downloadJSAtOnload(designUrl+'js/jquery/plugins/validation/localization/messages_'+global.cultureKey+'.js');
    }
    appMakeBeCool.gateway.init();
});