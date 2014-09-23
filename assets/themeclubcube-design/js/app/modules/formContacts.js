appMakeBeCool.gateway.addClass('FormContacts', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _formContacts = this,
    _defaults = {
        // elements
        contactForm: '#contactForm',
        contactFormSuccessMessage: '#successMessage'

        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        contactForm: null,
        contactFormSuccessMessage: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_formContacts, [_properties]);
        if(!_globals.preloaded) {
            return _formContacts.init();
        }
        _formContacts.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _formContacts.create();
    },

    _config = function() {
        _globals.contactForm = $(_properties.contactForm);
        _globals.contactFormSuccessMessage = $(_properties.contactFormSuccessMessage);
    },

    _setup = function() {
        if(_globals.contactForm.length) {
            _globals.contactForm.validate();
            _globals.contactForm.ajaxForm({
                dataType:  'json',
                beforeSubmit: _formContactBeforeSubmit,
                success:   _formContactSuccess
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
        _formContacts.globals.customResurrect = function() {};
        _formContacts.globals.customDestroy = function() {};
    },

    _formContactBeforeSubmit = function(arr, $form, options){},

    _formContactSuccess = function(response){
        if(response.success) {
            _globals.contactForm.slideUp('slow', function(){
                _globals.contactFormSuccessMessage.slideDown('slow');
            });
        } else {
            for (var key in response.errors) {
                var el = $('#'+key);
                el.addClass('error');
            }
        }
    };

    //PUBLIC METHODS
    _formContacts.addMethod('init', function() {
        _formContacts.bind($window, _formContacts.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});