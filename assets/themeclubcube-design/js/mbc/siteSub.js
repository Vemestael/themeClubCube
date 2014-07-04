mbc.gateway.addClass('SiteSub', function(properties) {
    //PRIVATE VARIABLES
    var _siteSub = this;
    var _defaults = {
        subsComplete: []
    };
    var _properties = $.extend(_defaults, properties);
    var _globals = {};

    //PRIVATE METHODS
    var _init = function() {		
        mbc.gateway.base.Class.apply(_siteSub, [_properties]);	
        _siteSub.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods()
        };
        _siteSub.create();
    };
    var _config = function() {};
    var _setup = function() {};	
    var _setBinds = function() {};
    var _setCustomMethods = function() {
        _siteSub.globals.customResurrect = function() {
            //Resurrect Code
        }; 
        _siteSub.globals.customDestroy = function() {
            //Destroy Code
        };
    };	
	
    //PUBLIC METHODS
    this.addMethod('init', function() {		
        //Demo Public Fn	
    });
    this.addMethod('addSubComplete', function(name) {	
        _siteSub.properties.subsComplete.push(name);
    });	
    this.addMethod('checkSubComplete', function(name) {		
        if(!name && _siteSub.properties.subsComplete.length < 1) return _siteSub.logError('name passed to checkSubComplete() is invalid');	
        var ret = false;	
        $.each(_siteSub.properties.subsComplete, function() {	
            if(this == name) ret = true;		
        });
        return ret;
    });	
    this.addMethod('getSiteGlobals', function() {	
        return mbc.gateway.getGlobals();
    });
    this.addMethod('getSiteObj', function() {
        return mbc.gateway;
    });

    //GO!
    _init();
});