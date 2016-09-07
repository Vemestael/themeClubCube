"use strict";
appMakeBeCool.gateway.addClass('FormValidate', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _formValidate = this,
        _defaults = {
            // elements
            forms: [],
            controlLabels: '.control-label',
            inputs: '.form-control',
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            forms: [],
            controlLabels: null,
            inputs: null,
            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_formValidate, [_properties]);
            if (!_globals.preloaded) {
                return _formValidate.init();
            }
            _formValidate.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _formValidate.create();
        },

        _config = function () {
            _globals.controlLabels = $(_properties.controlLabels);
            _globals.inputs = $(_properties.inputs);
            if (_properties.forms.length) {
                for (var i in _properties.forms) {
                    _globals.forms.push($(_properties.forms[i]));
                }
            }
        },

        _setup = function () {

            if (_globals.forms.length) {
                //console.log(_globals.forms);
                for (var i in _globals.forms) {
                    _globals.forms[i].validate({
                        rules: {
                            name: {
                                minlength: 2
                            },
                            email: {
                                required: true,
                                email: true
                            },
                        },
                        messages: {
                            name: typeof global.validationMessages.name === 'undefined' ? '' : global.validationMessages.name,
                            surname: typeof global.validationMessages.surname === 'undefined' ? '' : global.validationMessages.surname,
                            fullName: typeof global.validationMessages.fullName === 'undefined' ? '' : global.validationMessages.fullName,
                            brand: typeof global.validationMessages.brand === 'undefined' ? '' : global.validationMessages.brand,
                            date: typeof global.validationMessages.date === 'undefined' ? '' : global.validationMessages.date,
                            country: typeof global.validationMessages.country === 'undefined' ? '' : global.validationMessages.country,
                            phone: typeof global.validationMessages.phone === 'undefined' ? '' : global.validationMessages.phone,
                            address: typeof global.validationMessages.address === 'undefined' ? '' : global.validationMessages.address,
                            addresses: typeof global.validationMessages.addresses === 'undefined' ? '' : global.validationMessages.addresses,
                            url: typeof global.validationMessages.url === 'undefined' ? '' : global.validationMessages.url,
                            email: typeof global.validationMessages.email === 'undefined' ? '' : global.validationMessages.email,
                            text: typeof global.validationMessages.text === 'undefined' ? '' : global.validationMessages.text,
                        }

                        //messages: jQuery.extend(jQuery.validator.messages, global.validationMessages)
                    });
                }
                _initMaskedInput();
            }
        },

        _setBinds = function () {
            _binds().setFocusInputBind();
            _binds().setFocusOutInputBind();
        },

        _binds = function () {
            return {
                setFocusInputBind: function () {
                    _formValidate.bind(_globals.inputs, 'focusin', function (e) {
                        _inputFocus(e.target);
                    });
                },
                setFocusOutInputBind: function () {
                    _formValidate.bind(_globals.inputs, 'focusout', function (e) {
                        _inputFocusOut(e.target);
                    });
                },
            }
        },

        _triggers = function () {
            return {}
        },
        _inputFocus = function (input) {
            var $input = $(input);
            var $label = null;
            if ($input.length) {
                $label = $('label[for="' + $input.attr('id') + '"]');
                $label.addClass('active');
            }
        },
        _inputFocusOut = function (input) {
            var $input = $(input);
            var $label = null;
            if ($input.length && !$input.val().length) {
                $label = $('label[for="' + $input.attr('id') + '"]');
                $label.removeClass('active');
            }
        },

        _initMaskedInput = function () {
            $('input[name="phone"]').mask("+9 (999) 999-99-99");
            $('input[name="date"]').mask("99 / 99 / 9999");
        },

        _setCustomMethods = function () {
            _formValidate.globals.customResurrect = function () {
            };
            _formValidate.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _formValidate.addMethod('init', function () {
        _formValidate.bind($window, _formValidate.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});