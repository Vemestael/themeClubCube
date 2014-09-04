appMakeBeCool.gateway.addClass('PromoSlider', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _promoSlider = this,
    _defaults = {
        // elements
        triggerItemsPromo: '.trigger-promo'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        promoItems: null,

        //prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_promoSlider, [_properties]);
        if(!_globals.preloaded) {
            return _promoSlider.init();
        }
        _promoSlider.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _promoSlider.create();
    },
    _config = function() {
        _globals.promoItems = $(_properties.triggerItemsPromo);
    },
    _setup = function() {},
    _setBinds = function() {
        _binds().setPromoBinds();
    },
    _binds = function() {
        return {
            setPromoBinds: function() {
                _globals.promoItems.eq(0).addClass('active');
                _globals.promoItems.hover(function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    setTimeout(function(){
                        _globals.promoItems.removeClass('active');
                        $this.addClass('active');
                    },2);
                });
            }
        };
    },
    _setCustomMethods = function() {
        _promoSlider.globals.customResurrect = function() {};
        _promoSlider.globals.customDestroy = function() {};
    };


    //PUBLIC METHODS
    _promoSlider.addMethod('init', function() {
        _promoSlider.bind($window, _promoSlider.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});