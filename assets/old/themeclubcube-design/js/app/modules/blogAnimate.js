appMakeBeCool.gateway.addClass('BlogAnimate', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _blogAnimate = this,
    _defaults = {
        // elements
        blogs: '.blog-item',
        blogsTile: '.blog-item-def'

        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        blogs: null,
        blogsTile: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_blogAnimate, [_properties]);
        if(!_globals.preloaded) {
            return _blogAnimate.init();
        }
        _blogAnimate.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _blogAnimate.create();
    },

    _config = function() {
        _globals.blogs = $(_properties.blogs);
        _globals.blogsTile = $(_properties.blogsTile);
    },

    _setup = function() {
        if(_globals.blogs.length){
            new EventAnimate( _globals.blogs);
        }
        if(_globals.blogsTile.length){
            new EventAnimate( _globals.blogsTile);
        }
    },

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    _setCustomMethods = function() {
        _blogAnimate.globals.customResurrect = function() {};
        _blogAnimate.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _blogAnimate.addMethod('init', function() {
        _blogAnimate.bind($window, _blogAnimate.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});