mbc.gateway.addClass('NormalMode', function(properties) {
	//PRIVATE VARIABLES
	var _normalMode = this;
	var _defaults = {};
	var _properties = $.extend(_defaults, properties);
	var _globals = {
		siteObj: null,
		preloaded: false
	};

	//PRIVATE METHODS
	var _init = function() {
        mbc.gateway.classes.SiteSub.apply(_normalMode, [_properties]);
        if(!_globals.preloaded) {
            return _normalMode.init();
        }
        _config();
        _setup();
        _setBinds();
        _setEventBinds();
        _instantiateClasses();
        _setCustomMethods();
    };
    var _config = function() {	};
    var _setup = function() {
        $('body').addClass('effect-mode');
    };
	
    var _setBinds = function() {};
	
    var _binds = function() {
        $window = $(window);
            return {}
    };
	
    _setEventBinds = function() {};
	
	_eventBinds = function() {	
        var $window = $(window);
        return {}
	};
	
	var _extendClasses = function() {};
	
	var _instantiateClasses = function() {
        _globals.siteObj.createClassInstance('pageContacts', _globals.siteObj.classes.PageContacts, {classId: 'PageContacts'}, _globals.siteObj.base.Class);
	};
	
	var _setCustomMethods = function() {
        _normalMode.globals.customResurrect = function() {};
        _normalMode.globals.customDestroy = function() {};
    };
	
	//PUBLIC METHODS
	this.addMethod('init', function() {	
        _globals.siteObj = _normalMode.getSiteObj();
        $(window).bind('siteConfigComplete', function() {
            _globals.preloaded = true;
            _init();
        });

//        _globals.siteObj.utils.extend(_globals.siteObj.classes.Loader, _globals.siteObj.base.Class);
//        _globals.siteObj.createClassInstance('loader', _globals.siteObj.classes.Loader, {classId: 'Loader', csstransitions: false});

    });
        
    this.addMethod('getSiteObj', function() {
        return mbc.gateway;
    });

    //GO!
    _init();
});