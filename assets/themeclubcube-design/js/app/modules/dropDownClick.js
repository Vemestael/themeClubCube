appMakeBeCool.gateway.addClass('DropDownClick', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _dropDownClick = this,
    _defaults = {
        // elements
        dropdown: '.dropdown',
        dropdownToggle: '.dropdown-toggle'
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        dropdown: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_dropDownClick, [_properties]);
        if(!_globals.preloaded) {
            return _dropDownClick.init();
        }
        _dropDownClick.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _dropDownClick.create();
    },

    _config = function() {
        _globals.dropdown = $(_properties.dropdown);
    },

    _setup = function() {
//        _globals.dropdown.hover(function(){
//            _dropDownClick.unbind($(_properties.dropdownToggle, this), 'click');
//            _dropDownClick.bind($(_properties.dropdownToggle, this), 'click', function(e, data, el) {
//                window.location = $(el).attr('href');
//            });
//        });
    },

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    _setCustomMethods = function() {
        _dropDownClick.globals.customResurrect = function() {};
        _dropDownClick.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _dropDownClick.addMethod('init', function() {
        _dropDownClick.bind($window, _dropDownClick.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});