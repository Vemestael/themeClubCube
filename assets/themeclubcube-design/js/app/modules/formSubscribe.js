appMakeBeCool.gateway.addClass('FormSubscribe', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _formSubscribe = this,
    _defaults = {
        // elements
        form: '#email-footer-form',
        formSuccessMessage: '#successSubscribe',
        formSuccessLoader: '#loaderSubscribeForm'

        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        form: null,
        formSuccessMessage: null,
        formSuccessLoader: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_formSubscribe, [_properties]);
        if(!_globals.preloaded) {
            return _formSubscribe.init();
        }
        _formSubscribe.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _formSubscribe.create();
    },

    _config = function() {
        _globals.form = $(_properties.form);
        _globals.formSuccessMessage = $(_properties.formSuccessMessage);
        _globals.formSuccessLoader = $(_properties.formSuccessLoader);
    },

    _setup = function() {
        if(_globals.form.length) {
            _globals.form.validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    if($(element).hasClass('error') && !$('label[for='+$(element).attr('id')+']').length){
                        var label = $('<label/>');
                        label.addClass('error').attr('for', $(element).attr('id'));

                        var arrow = $('<span/>');
                        arrow.addClass('subscribe-label-arrow');

                        error.addClass('subscribe-label-inner').removeClass('error');

                        error.insertAfter(element).wrap(label);
                        arrow.insertBefore(error);
                    } else if($(element).hasClass('valid')){
                        $(error).parent('label').remove();
                    }
                },
                success: function(label){
                    $('label[for=email-subscribe]').remove();
                }
            });
            _globals.form.ajaxForm({
                dataType:  'json',
                beforeSubmit: _formBeforeSubmit,
                success:   _formSuccess
            });
        }
    },

    _setBinds = function() {},

    _binds = function() {
        return {}
    },

    _triggers = function(){
        return {}
    },

    _setCustomMethods = function() {
        _formSubscribe.globals.customResurrect = function() {};
        _formSubscribe.globals.customDestroy = function() {};
    },

    _formBeforeSubmit = function(arr, $form, options){
        _globals.formSuccessLoader.removeClass('hide');
    },

    _formSuccess = function(response){
        if(response.success) {
            _globals.form.slideUp('slow', function(){
                _globals.formSuccessMessage.slideDown('slow');
            });
        } else {
            _globals.formSuccessLoader.addClass('hide');
            for (var key in response.errors) {
                var el = $('#'+key);
                el.addClass('error');
            }
        }
    };

    //PUBLIC METHODS
    _formSubscribe.addMethod('init', function() {
        _formSubscribe.bind($window, _formSubscribe.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});