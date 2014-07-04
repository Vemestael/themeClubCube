mbc.gateway.addClass('PageContacts', function(properties) {

    //PRIVATE VARIABLES
    var _pageContacts = this;
    var _defaults = {
        form: '#formContacts'
        ,loader: '#formContactsLoader'
        ,success: '#formContactsSuccess'
        ,sendAnother: '#formContactsSendAnother'
    };
    var _properties = $.extend(_defaults, properties);
    var _globals = {
        form: null
        ,loader: null
        ,success: null
        ,sendAnother: null
        ,validate:null
    };

    //PRIVATE METHODS
    var _init = function() {
        mbc.gateway.base.Class.apply(_pageContacts, [_properties]);
        _pageContacts.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _pageContacts.create();
    };

    var _config = function() {
        _globals.form = $(_properties.form);
        _globals.loader = $(_properties.loader);
        _globals.success = $(_properties.success);
        _globals.sendAnother = $(_properties.sendAnother);
    };

    var _setup = function() {
        _globals.validate = _globals.form.validate();
        _globals.form.ajaxForm({
            dataType:  'json',
            beforeSubmit: _beforeSubmitForm,
            success:   _successForm
        });
    };

    var _setBinds = function() {
        _binds().setSendAnotherClickBinds();
    };

    var _binds = function() {
        var $window = $(window);
        return {
            setSendAnotherClickBinds: function() {
                _globals.sendAnother.unbind('click').bind('click', function(e) {
                    e.preventDefault();
                    _globals.form.trigger('reset');
                    _globals.success.slideUp('slow', function() {
                        _globals.form.slideDown('slow');
                    });
                });
            }
        }
    };

    var _setCustomMethods = function() {
        _pageContacts.globals.customResurrect = function() {};
        _pageContacts.globals.customDestroy = function() {};
    };

    var _beforeSubmitForm = function(arr, form, options) {
        _globals.loader.show();
    };

    var _successForm = function(response) {
        _globals.loader.hide();
        if(response.success) {
            /**
             * TODO
             * сделать отслеживание событий с глобальной привязкой к аналитике
             */
//            _gaq.push(['_trackEvent', 'signUpForm', 'gol', 'Регистрация']);
            _globals.form.slideUp('slow', function() {
                _globals.success.slideDown('slow');
            });
        } else {
            var errors = {};
            for (var key in response.errors) {
                if(key != 'errors'){
                    errors.push({key: response.errors[key]});
                }
            }
            _globals.validate.showErrors(errors);
        }
    }

    //PUBLIC METHODS

    //GO!
    _init();
});