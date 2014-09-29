appMakeBeCool.gateway.addClass('ThemeMode', function(properties, $, $window, $document) {
	//PRIVATE VARIABLES
	var _themeMode = this,
	_defaults = {
        // classes ans styles
        classMode: 'theme-mode'
    },
	_properties = $.extend(_defaults, properties),
	_globals = {
		siteObj: null,
		preloaded: false
    },

	//PRIVATE METHODS
	_init = function() {
        appMakeBeCool.gateway.classes.SiteMode.apply(_themeMode, [_properties])
        if(!_globals.preloaded) {
            return _themeMode.init();
        }
        _config();
        _extendClasses();
        _instantiateClasses();
        _setup();
        _setBinds();
        _setCustomMethods();
        _themeMode.trigger(_themeMode.globals.classType+'_Complete');
    },

    _config = function() {
        _globals.siteObj = _themeMode.getSiteObj();
    },

    _extendClasses = function() {
        _globals.siteObj.utils.extend(_globals.siteObj.classes.Images, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.LoaderMain, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.FullHeightSlider, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.EventAnimate, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.BlogAnimate, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.Partners, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.ScrollAtOnce, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.MenuToTop, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.TopEventsSlider, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.TicketsEventsSlider, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.GallerySlider, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.FormContacts, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.FormSubscribe, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.GalleryPage, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.Sharrre, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.EventsTickets, _globals.siteObj.base.Class);
        _globals.siteObj.utils.extend(_globals.siteObj.classes.DropDownClick, _globals.siteObj.base.Class);
    },

    _instantiateClasses = function() {
        _globals.siteObj.createClassInstance('images', _globals.siteObj.classes.Images, {classId: 'Images'});
        _globals.siteObj.createClassInstance('loaderMain', _globals.siteObj.classes.LoaderMain, {classId: 'LoaderMain'});
        _globals.siteObj.createClassInstance('fullHeightSlider', _globals.siteObj.classes.FullHeightSlider, {classId: 'FullHeightSlider'});
        _globals.siteObj.createClassInstance('eventAnimate', _globals.siteObj.classes.EventAnimate, {classId: 'EventAnimate'});
        _globals.siteObj.createClassInstance('blogAnimate', _globals.siteObj.classes.BlogAnimate, {classId: 'BlogAnimate'});
        _globals.siteObj.createClassInstance('partners', _globals.siteObj.classes.Partners, {classId: 'Partners'});
        _globals.siteObj.createClassInstance('scrollAtOnce', _globals.siteObj.classes.ScrollAtOnce, {classId: 'ScrollAtOnce'});
        _globals.siteObj.createClassInstance('menuToTop', _globals.siteObj.classes.MenuToTop, {classId: 'MenuToTop'});
        _globals.siteObj.createClassInstance('topEventsSlider', _globals.siteObj.classes.TopEventsSlider, {classId: 'TopEventsSlider'});
        _globals.siteObj.createClassInstance('ticketsEventsSlider', _globals.siteObj.classes.TicketsEventsSlider, {classId: 'TicketsEventsSlider'});
        _globals.siteObj.createClassInstance('gallerySlider', _globals.siteObj.classes.GallerySlider, {classId: 'GallerySlider'});
        _globals.siteObj.createClassInstance('formContacts', _globals.siteObj.classes.FormContacts, {classId: 'FormContacts'});
        _globals.siteObj.createClassInstance('formSubscribe', _globals.siteObj.classes.FormSubscribe, {classId: 'FormSubscribe'});
        _globals.siteObj.createClassInstance('galleryPage', _globals.siteObj.classes.GalleryPage, {classId: 'GalleryPage'});
        _globals.siteObj.createClassInstance('sharrre', _globals.siteObj.classes.Sharrre, {classId: 'Sharrre'});
        _globals.siteObj.createClassInstance('eventsTickets', _globals.siteObj.classes.EventsTickets, {classId: 'EventsTickets'});
        _globals.siteObj.createClassInstance('dropDownClick', _globals.siteObj.classes.DropDownClick, {classId: 'DropDownClick'});
    },

    _setup = function() {
        $('body').addClass(_properties.classMode);
    },

    _setBinds = function() {
        _binds().setCompleteBind();
        _binds().setImage_CompleteBind();
        _binds().setFullHeightSlider_BigSliderBind();
        _binds().setScrollAtOnce_ToggleBind();
    },
	
	_binds = function() {
        return {
            setCompleteBind: function() {
                _themeMode.bind($window, _themeMode.globals.classType+'_Complete', function(e, data){
                    _themeMode.trigger('LoaderMain_Init', data);
                    _themeMode.trigger('Images_Init', data);
                });
            },
            setImage_CompleteBind: function(){
                _themeMode.bind($window, 'Images_ImagesComplete', function(e, data){
                    _themeMode.trigger('FullHeightSlider_Init', data);
                    _themeMode.trigger('LoaderMain_End', data);
                    _themeMode.trigger('TopEventsSlider_Init', data);
                    _themeMode.trigger('TicketsEventsSlider_Init', data);
                    _themeMode.trigger('GallerySlider_Init', data);
                    _themeMode.trigger('EventAnimate_Init', data);
                    _themeMode.trigger('BlogAnimate_Init', data);
                    _themeMode.trigger('Partners_Init', data);
                    _themeMode.trigger('MenuToTop_Init', data);
                    _themeMode.trigger('FormContacts_Init', data);
                    _themeMode.trigger('FormSubscribe_Init', data);
                    _themeMode.trigger('GalleryPage_Init', data);
                    _themeMode.trigger('Sharrre_Init', data);
                    _themeMode.trigger('EventsTickets_Init', data);
                    _themeMode.trigger('DropDownClick_Init', data);
                });
            },
            setFullHeightSlider_BigSliderBind: function(){
                _themeMode.bind($window, 'FullHeightSlider_BigSlider', function(e, data){
                    _themeMode.trigger('ScrollAtOnce_Init', data);
                });
            },
            setScrollAtOnce_ToggleBind: function(){
                _themeMode.bind($window, 'ScrollAtOnce_Toggle', function(e, data){
                    _themeMode.trigger('FullHeightSlider_Action', data);
                });
            }
        }
    },
	
	_setCustomMethods = function() {
        _themeMode.globals.customResurrect = function() {};
        _themeMode.globals.customDestroy = function() {};
    };
	
	//PUBLIC METHODS
    _themeMode.addMethod('init', function() {
        _themeMode.bind($window, 'siteConfigComplete', function() {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});