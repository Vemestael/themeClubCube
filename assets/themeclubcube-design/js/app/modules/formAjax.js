"use strict";
appMakeBeCool.gateway.addClass('FormAjax', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _formAjax = this,
        _defaults = {
            // elements
            name: '#subscribe-name',
            surename: '#subscribe-surname',
            email: '#subscribe-email',
            country: '#subscribe-country',
            forms: [],
            successMessageSuffix: 'SuccessMessage',
            errorMessageSuffix: 'ErrorMessage',
            signUploads: '.sign-uploads',
            imageError: '.error',
            signAvatar: '.sign-avatar',
            signPhoto: '.sign-photo'

            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            forms: [],
            successMessages: [],
            name: '#subscribe-name',
            surename: '#subscribe-surname',
            email: '#subscribe-email',
            country: '#subscribe-country',
            signUploads: null,
            imageError: null,
            signAvatar: null,
            signPhoto: null,
            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_formAjax, [_properties]);
            if (!_globals.preloaded) {
                return _formAjax.init();
            }
            _formAjax.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _formAjax.create();
        },

        _config = function () {
            if (_properties.forms.length) {
                for (var i in _properties.forms) {
                    _globals.forms.push($(_properties.forms[i]));
                    _globals.successMessages.push($(_properties.forms[i] + _properties.successMessageSuffix));
                }
            }
        },

        _setup = function () {
            if (_globals.forms.length) {
                for (var i in _globals.forms) {
                    _globals.forms[i].ajaxForm({
                        dataType: 'json',
                        beforeSubmit: _formBeforeSubmit,
                        //url: 'http://ottomen.com.ua/mers/form.html',
                        success: _formSuccess
                    });
//                _globals.forms[i].validate();
//                    $("#subscribe").click(function () {
//                        $.ajax({
//                            type: 'POST',
//                            url: "getFormFields.php",
//                            data: {
//                                name: $(_globals.name).val(),
//                                surename: $(_globals.surename).val(),
//                                email: $(_globals.email).val(),
//                                country: $(_globals.country).val()
//                            },
//                            success: function () {
//                                console.log("success")
//                            },
//                            error: console.log("error")
//                        })
//
//                    })
                }
            }
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {}
        },

        _triggers = function () {
            return {}
        },

        _setCustomMethods = function () {
            _formAjax.globals.customResurrect = function () {
            };
            _formAjax.globals.customDestroy = function () {
            };
        },

        _formBeforeSubmit = function (arr, $form, options) {
            return _imageValidation(arr,$form);

        },
        _imageValidation = function(arr, $form){
            var output = true;
            if($form.find(_properties.signAvatar).length > 0) {
                $.each(arr, function (index, value) {
                    if (value.name == 'image' && value.required && !value.value) {
                        $form.find(_properties.signPhoto).addClass('error').siblings(_properties.imageError).show();
                        output = false;
                    }
                });
            }

            return output;
        },

        _formSuccess = function (response, statusText, xhr, $form) {
            if (response) {
                $form.slideUp('slow', function () {
                    var formSuccessMessageId = $form.attr('id') + _properties.successMessageSuffix;
                    $('#' + formSuccessMessageId).slideDown('slow');
                });
            } else {
                //for (var key in response.errors) {
                //    var el = $('#' + key);
                //    el.addClass('error');
                //}

                $form.slideUp('slow', function () {
                    var formErrorsMessageId = $form.attr('id') + _properties.errorMessageSuffix;
                    $('#' + formErrorsMessageId).slideDown('slow');
                });

            }
        };

    //PUBLIC METHODS
    _formAjax.addMethod('init', function () {
        _formAjax.bind($window, _formAjax.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();

});