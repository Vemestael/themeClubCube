var mbc = (typeof mbc === 'undefined') ? {} : console.log('Namespace mbc is taken');

mbc.Site = function (siteProperties) {

    /*************************************** PRIVATE ***************************************/

    //PRIVATE VARIABLES
    var _site = {
        properties: $.extend({
            siteInitComplete: function () { }
        }, siteProperties),

        globals: {
            els: {
                win: $(window),
                doc: $(document),
                html: $('html'),
                body: $('body')
            },
            siteConfigured: false,
            imgPreloaderWrapClass: 'img-preloader-wrap',
            imgPreloaderClass: 'loading',
            imgNoPreloadClass: 'img-nopreload',
            imgDataSrc2x: 'data-src2x',
            imgDataSrc: 'data-imgsrc'
        },

        utils: {},
        classes: {},
        classInstances: []
    };

    //PRIVATE METHODS
    _site.init = function (options) {
        var _options = $.extend({ onComplete: function () { } }, options);
        _site.config();
        _site.extendClasses();
        _site.setup();
        _site.setBinds();
        _site.setEventBinds();
        _site.globals.siteConfigured = true;
        $(window).trigger('siteConfigComplete');
        _site.properties.siteInitComplete.call(site, _site);
        _options.onComplete();
        _site.globals.els.win.trigger('siteInitComplete', { options: _options });
    };

    _site.setSiteMode = function() {
        mbc.Data.siteMode = {
            'normalMode': true
        };	
    };

    _site.config = function () {
        _site.globals.winWidth = _site.globals.els.win.width();
        _site.globals.initUrl = window.location.href;

        //extends

        //Define Request Animation Frame
        if (!window.requestAnimationFrame) {
            window.requestAnimationFrame = (
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimationFrame ||
                function (callback) {
                    return window.setTimeout(callback, 1000 / 60);
                }
            );
        }
    };

    _site.setup = function () {};

    _site.setBinds = function () {
        site.binds().setUnloadBind();
    };

    _site.setEventBinds = function () {};

    _site.eventBinds = function () {
        var $window = $(window);
        return {}
    };

    _site.extendClasses = function () {};

    _site.createClassInstance = function (instanceName, classObject, classProperties, classExtends) {
        if (classExtends) _site.utils.extend(classObject, classExtends);
        if (typeof instanceName !== 'string') return console.log('Error: _site.createClassInstance() expects a string for instanceName');
        if (typeof classObject !== 'function') return console.log('Error: _site.createClassInstance() expects a function for classObject');
        var _classProperties = classProperties || {};
        site.classInstances[instanceName] = new classObject(_classProperties);
        return site.classInstances[instanceName];
    };

    _site.getSiteObj = function () {
        return site;
    };

    _site.getSiteSubs = function () {
        var siteSubs = [];	
        if (mbc.Data.siteMode.effectMode) {		
            siteSubs.push({classObject: 'EffectMode', classExtends: 'SiteSub'});		
        }
        return siteSubs;
    };

    //PRIVATE UTILS

    _site.utils = {
        extend: function (subClass, superClass) {
            var F = function () {};
            F.prototype = superClass.prototype;
            subClass.prototype = new F();
            subClass.prototype.constructor = subClass;
            subClass.superclass = superClass.prototype;
            if (superClass.prototype.constructor == Object.prototype.constructor) {
                superClass.prototype.constructor = superClass;
            }
        },
        arrayShiftTo: function (array, index, targetIndex) {
            if (typeof array !== 'object') return console.log('Error: array provided is not of type object');
            if (typeof index !== 'number' || index < 0 || index >= array.length) return console.log('error: index provided is not valid');
            if (typeof targetIndex !== 'number' || targetIndex < 0 || targetIndex >= array.length) return console.log('error: targetIndex provided is not valid');
            var origItem = array[index];
            array.splice(index, 1);
            array.splice(targetIndex, 0, origItem);
            return array;
        },

        trigger: function (name, data) {
            var _data;
            if (!data) _data = {};
            else _data = data;
            if (!name || typeof name !== 'string') return console.log('Error in utils.trigger: No trigger name was provided');
            _site.globals.els.win.trigger(name, _data);
        },
                
        mergeOptions: function (obj1,obj2) {
            var obj3 = {};
            for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
            for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
            return obj3;
        }
    };

    //PRIVATE CLASSES


    /*************************************** PUBLIC ***************************************/

    //PUBLIC VARIABLES
    var site = this;
    $.extend(site, {
        classes: {},
        modules: {},
        base: {},
        classInstances: {},
        pbTest: 0
    });

    //PUBLIC METHODS
    site.init = function () {
        //extend jquery with findAndSelf
        if (!$.fn.findAndSelf) $.fn.findAndSelf = function (selector) { return this.find(selector).andSelf().filter(selector); }
        //Merge mbc.data with global
        mbc.Data = site.utils.mergeOptions(mbc.Data, global);
        
        _site.setSiteMode();
        _site.init();

        _site.utils.extend(site.classes.SiteSub, site.base.Class);
        site.createClassInstances(_site.getSiteSubs());
    };

    site.generateImgs = function (context, options) {
        var $context = $(context);
        var _options = $.extend({ usePreloader: false }, options);
        if ($context.length !== 1) return console.log('Error in generateImgs - context provided is invalid.');
        var i = 0;
        $context.find('['+_site.globals.imgDataSrc+']').each(function () {
            var $this = $(this);
            var imgsrc = site.makeImageResponsive($this);
            //If there is an imgsrc and preloading img
            if (!$this.hasClass(_site.globals.imgNoPreloadClass) && imgsrc) {
                if (_options.usePreloader) site.addImgPreloader($this);
                
                var loadedImg = 0;
                $.imgpreload([imgsrc], {
                    each: function () {
                        loadedImg++;
                        var procent = 100*loadedImg/$context.length;
                        $(window).trigger('documentImageLoad',{procent:procent});
                    },
                    all: function () {
                        setTimeout(function () {
                            //Remove preloader els
                            if (_options.usePreloader) site.removeImgPreloader($this);
                            //Replace src with this data imgsrc
                            $this.attr('src', imgsrc);
                            //Remove the attr so that imgsrc does not evaluate as true for any image that's already been src replaced
                            $this.attr(_site.globals.imgDataSrc, '');
//                            $this.removeClass('placeholder-img');

                            $(window).trigger('documentImagesGenerate');
                        }, _site.globals.simulatedDelay)
                    }
                });
            }
            i++;
        });
    };
    
    site.makeImageResponsive = function(img){
        var viewport = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var image = img.get(0);
        if( image.length === 0 ){
            return;
        }
        ////////HASATTR FUNCTION////////
        var hasAttr;
        if(!image.hasAttribute){ //IE <=7 fix
            hasAttr = function(el, attrName){ //IE does not support Object.Prototype
                return el.getAttribute(attrName) !== null;
            };
        } else {
            hasAttr = function(el, attrName){
                return el.hasAttribute(attrName);
            };
        }
        ////////CHECK IF DISPLAY IS RETINA////////
        var retina = window.devicePixelRatio ? window.devicePixelRatio >= 1.2 ? 1 : 0 : 0;
        ////////LOOP ALL IMAGES////////
        //set attr names
        var srcAttr = ( retina && hasAttr(image, _site.globals.imgDataSrc2x) ) ? _site.globals.imgDataSrc2x : _site.globals.imgDataSrc;
        //check image attributes
        if( !hasAttr(image, srcAttr) ){
            return false;
        }
        //get attributes
        var queries = image.getAttribute(srcAttr);
        //split defined query list
        var queries_array = queries.split(',');
        //loop queries
        for(var j = 0; j < queries_array.length; j++){
            //split each individual query
            var query = queries_array[j].split(':');
            //get condition and response
            var condition = query[0];
            var response = query[1];
            //set empty variables
            var conditionpx;
            var bool;
            //check if condition is below
            if(condition.indexOf('<') !== -1){
                conditionpx = condition.split('<');
                if(queries_array[(j -1)]){
                    var prev_query = queries_array[(j - 1)].split(/:(.+)/);
                    var prev_cond = prev_query[0].split('<');
                    bool =  (viewport <= conditionpx[1] && viewport > prev_cond[1]);
                } else {
                    bool =  (viewport <= conditionpx[1]);
                }
            } else {
                conditionpx = condition.split('>');
                if(queries_array[(j +1)]){
                    var next_query = queries_array[(j +1)].split(/:(.+)/);
                    var next_cond = next_query[0].split('>');				
                    bool = (viewport >= conditionpx[1] && viewport < next_cond[1]);
                } else {
                    bool = (viewport >= conditionpx[1]);
                }
            }
            //check if document.width meets condition
            if(bool){
                var new_source = response;
                return new_source;
                break;
            }
        }
    },
            
    site.addImgPreloader = function (imgEl) {
        $imgEl = $(imgEl);
        if ($imgEl.length !== 1) return console.log('Error in addImgPreloaders - context provided is invalid.');
        if ($imgEl.hasClass(_site.globals.imgNoPreloadClass)) return console.log('No add preload');
        if ($imgEl.parents('.' + _site.globals.imgPreloaderWrapClass).length === 1) return;
        $imgEl.wrap('<div class="' + _site.globals.imgPreloaderWrapClass + '" />');
        $imgEl.parents('.' + _site.globals.imgPreloaderWrapClass).append('<span class="' + _site.globals.imgPreloaderClass + '" />');
    };

    site.removeImgPreloader = function (imgEl) {
        var $img = $(imgEl);
        if ($img.length !== 1) return console.log('Error in removeImgPreloader - imgEl provided is invalid.');
        var $preloadWrap = $img.parents('.' + _site.globals.imgPreloaderWrapClass);
        if ($preloadWrap.length !== 1) return;
        var $preloader = $preloadWrap.find('.' + _site.globals.imgPreloaderClass);
        if ($preloader.length !== 1) return;
        $preloader.remove();
        $img.unwrap();
    };

    site.binds = function () {
        var $window = $(window);
        return {
            setUnloadBind: function () {
                $window.unload(function () {
                    /**
                     * function on load page
                     */
                });
            }
        }
    };

    site.addClass = function (name, Class) {
        site.classes[name] = Class;
    };

    site.createClassInstance = function (instanceName, classObject, classProperties, classExtends) {
        return _site.createClassInstance(instanceName, classObject, classProperties, classExtends);
    };

    site.createClassInstances = function (obj) {
        //{name: 'ClassName', extends: 'ClassExtends'}
        if (obj.length > 0) {
            $.each(obj, function () {
                var _obj = $.extend({
                    instanceName: this.classObject,
                    classObject: this.classObject,
                    classProperties: { classId: this.classObject },
                    classExtends: site.base.Class
                }, this);
                if (typeof _obj.classObject === 'string') _obj.classObject = site.classes[_obj.classObject];
                if (typeof _obj.classExtends === 'string') _obj.classExtends = site.classes[_obj.classExtends];
                _site.createClassInstance(_obj.instanceName, _obj.classObject, _obj.classProperties, _obj.classExtends);
            });
        }
    };

    site.utils = {
        extend: function (subClass, superClass) {
            _site.utils.extend(subClass, superClass);
        },
        arrayShiftTo: function (array, index, targetIndex) {
            return _site.utils.arrayShiftTo(array, index, targetIndex);
        },
        mergeOptions: function (obj1,obj2) {
            return _site.utils.mergeOptions(obj1,obj2);
        }
    };

    site.getGlobals = function () {
        return _site.globals;
    }

    site.getClassInstance = function (instanceName) {
        return site.classInstances[instanceName];
    };

    //BASE CLASS

    site.base.Class = function (properties) {
        //PRIVATE VARS
        var _baseClass = this;
        var _CONSTANTS = {
            VAR_1: null,
            VAR_2: null
        };
        var _defaults = {
            sourceEl: null,
            classId: null,
            classType: null,
            msg: 'This is the default base message',
            debugMode: true,
            classDependents: [],
            triggerSrc: null,
            instanceName: '',
            autoCallCreateComplete: true,
            instanceIdAttr: 'data-omgb-instance-id',
            onCreateComplete: function () { },
            onLoadComplete: function () { },
            onDestroyComplete: function () { }
        };
        //PUBLIC VARS
        _baseClass.properties = $.extend(_defaults, properties);
        _baseClass.globals = {
            classId: '',
            alive: false,
            instantiated: false,
            setupComplete: false,
            createComplete: false,
            loadComplete: false,
            classDependentsInstantiated: false,
            classDependentsInstances: [],
            classType: '',
            timeouts: [],
            intervals: [],
            customCreate: function () { },
            customCreateComplete: function () { },
            customDestroy: function () { },
            customDestroyComplete: function () { },
            customResurrect: function () { },
            customLoadComplete: function () { }
        };

        //PRIVATE METHODS
        var _init = function () {
            _config();
        };
        var _config = function () {
            _baseClass.globals.classType = _baseClass.properties.classType || _baseClass.properties.classId;
            _baseClass.properties.sourceEl = $(_baseClass.properties.sourceEl);
            _baseClass.globals.classId = _baseClass.properties.classId || instance;
        };

        var _setup = function () {};

        //PUBLIC METHODS

        _baseClass.getConstants = function () { return _CONSTANTS; };
        _init();
    };

    site.base.Class.prototype = {
        addMethod: function (name, fn) {
            var _baseClass = this;
            if (!name || typeof fn !== 'function') return _baseClass.logError('addMethod() parameters passed in are invalid');
            if (!_baseClass[name]) _baseClass[name] = fn;
        },

        create: function (options) {
            var _baseClass = this;
            var _options = $.extend({
                createStart: function () { },
                createComplete: function () { }
            }, options);
            if (_baseClass.globals.alive) {
                _baseClass.log(_baseClass);
                return _baseClass.logWarning('Class.create cannot create class, it is already created.');
            }
            _baseClass.globals.alive = true;
            _baseClass.createStart(_options.createStart);
            _baseClass.createClassDependents();
            if (_baseClass.properties.sourceEl.length > 0) _baseClass.properties.sourceEl.attr(_baseClass.properties.instanceIdAttr, _baseClass.globals.classId);
            if (typeof _baseClass.globals.customCreate === 'function' && !_baseClass.globals.instantiated) {
                _baseClass.globals.customCreate();
            } else if (typeof _baseClass.globals.customResurrect === 'function' && _baseClass.globals.instantiated) {
                //if class already loaded, run custom instance resurrection function
                _baseClass.globals.customResurrect();
            }
            _baseClass.globals.setupComplete = true;
            if (_baseClass.properties.autoCallCreateComplete === true) {
                _baseClass.createComplete(_options.createComplete);
            }
            return true;
        },

        destroy: function (options) {
            var _baseClass = this;
            var _options = $.extend({
                destroyStart: function () { },
                destroyComplete: function () { }
            }, options);
            if (!_baseClass.globals.alive) return _baseClass.logWarning('Class.destroy cannot destroy class, it has not been created.');
            //Lets run destroy start callback and wait for possible animations to complete before continuing to shut down
            _baseClass.destroyStart(function () {
                _baseClass.destroyClassDependents();
                if (typeof _baseClass.globals.customDestroy === 'function') _baseClass.globals.customDestroy();
                _baseClass.globals.alive = false;
                _baseClass.destroyComplete(_options.destroyComplete);
            });
            _baseClass.clearAllTimeouts();
            _baseClass.clearAllIntervals();
            return true;
        },

        createClassDependents: function () {
            //Dynamically run through all dependencies provided and create an instance for each.
            var _baseClass = this;
            //create class dependents
            if (_baseClass.globals.classDependentsInstantiated) {
                $.each(_baseClass.globals.classDependentsInstances, function (i) {
                    var _this = this;
                    _this.create();
                });
                return true;
            }
            //instantiate/create class dependents
            if (_baseClass.properties.classDependents.length < 1) return false;
            $.each(_baseClass.properties.classDependents, function () {
                _site.utils.extend(this.obj, site.base.Class);
                var _properties = $.extend({
                    onCreateComplete: function () {
                        setTimeout(function () {
                            if (!_baseClass.globals.createComplete) _baseClass.createComplete();
                        }, 1);
                    }
                }, this.properties);
                /*Look above, very important BUT...needs some reconsideration perhaps*/
                _baseClass.globals.classDependentsInstances.push(new this.obj(_properties));
            });
            _baseClass.globals.classDependentsInstantiated = true;
            return true;
        },

        destroyClassDependents: function () {
            var _baseClass = this;
            if (_baseClass.globals.classDependentsInstances.length < 1) return false;
            $.each(_baseClass.globals.classDependentsInstances, function () {
                var _this = this;
                _this.destroy();
            });
            return true;
        },

        classDependentsStatus: function () {
            var _baseClass = this;
            //if(_baseClass.properties.classDependents)
            if (_baseClass.properties.classDependents.length === 0) return true;
            var _ret = {
                setupComplete: true,
                loadComplete: true
            };
            $.each(_baseClass.properties.classDependents, function (i) {
                if (!_baseClass.globals.classDependentsInstances[i].globals.setupComplete) _ret = $.extend(_ret, { setupComplete: false });
                if (!_baseClass.globals.classDependentsInstances[i].globals.loadComplete) _ret = $.extend(_ret, { loadComplete: false });
            });
            return _ret;
        },

        getInstanceName: function () {
            var _baseClass = this;
            if (_baseClass.properties.instanceName) {
                return _baseClass.properties.instanceName;
            } else {
                return false;
            }
        },

        createStart: function (fn) {
            var _baseClass = this;
            if (typeof fn === 'function') fn();
        },

        createComplete: function (fn) {
            _baseClass = this;
            if (_baseClass.globals.createComplete) return false; /*_baseClass.logWarning('createComplete() has already been successfully executed...is this a necessary warning?');*/
            if (_baseClass.globals.classDependentsInstances.length > 0) _baseClass.loadCompleteChecker();
            if (_baseClass.globals.classDependentsInstances.length > 0 && !_baseClass.classDependentsStatus().setupComplete) {
                return false;
            }
            var _fn = function () {
                if (typeof fn === 'function') fn();
                _baseClass.properties.onCreateComplete();
                _baseClass.globals.customCreateComplete();
                _baseClass.globals.createComplete = true;
                _baseClass.globals.instantiated = true;
                $(window).trigger('classCreateComplete', { classId: _baseClass.properties.classId, classType: _baseClass.globals.classType });
                if (_baseClass.isLoaded()) _baseClass.globals.loadComplete = true;
            };
            if (typeof _fn === 'function') _fn();
            return true;
        },

        loadComplete: function (fn) {
            _baseClass = this;
            var _fn = function () {
                if (typeof fn === 'function') fn();
                _baseClass.properties.onLoadComplete();
                _baseClass.globals.customLoadComplete();
                _baseClass.globals.loadComplete = true;
            };
            _fn();
        },

        destroyStart: function (fn) {
            _baseClass = this;
            $(window).trigger('classDestroyStart', { classId: _baseClass.properties.classId, classType: _baseClass.globals.classType });
            if (typeof fn === 'function') fn();
        },

        destroyComplete: function (fn) {
            _baseClass = this;
            var _fn = function () {
                if (typeof fn === 'function') fn();
                _baseClass.properties.onDestroyComplete();
                _baseClass.globals.customDestroyComplete();
                _baseClass.globals.createComplete = false;
                $(window).trigger('classDestroyComplete', { classId: _baseClass.properties.classId, classType: _baseClass.globals.classType });
            };
            if (typeof fn === 'function') _fn();
        },

        isLoaded: function () {
            _baseClass = this;
            if (!_baseClass.globals.createComplete) return false;
            else if (_baseClass.globals.classDependentsInstances < 1) return true;
            else if (_baseClass.classDependentsStatus().loadComplete) return true;
            else return false;
        },

        loadCompleteChecker: function () {
            var _baseClass = this;
            var __baseClass = _baseClass;
            var interval = __baseClass.setInterval(function () {
                if (__baseClass.isLoaded()) {
                    __baseClass.clearInterval(interval);
                    _baseClass = __baseClass;
                    __baseClass.loadComplete();
                }
            }, 60);
        },

        log: function (msg, obj) {
            var _baseClass = this;
            if (!_baseClass.properties.debugMode) return;
            if (typeof msg === 'object') {
                obj = msg;
                msg = '';
            }

            if (typeof obj !== 'object') obj = '';
            if (typeof console === 'object' && typeof console.log === 'function') {
                console.log(_baseClass.globals.classId + ': ' + msg, obj);
            }
        },

        logError: function (msg, obj) {
            var _baseClass = this;
            _baseClass.log('Error - ' + msg, obj);
        },

        logWarning: function (msg, obj) {
            var _baseClass = this;
            _baseClass.log('Warning - ' + msg, obj);
        },

        logNotice: function (msg, obj) {
            var _baseClass = this;
            _baseClass.log('Notice - ' + msg, obj);
        },

        setInterval: function (fn, duration) {
            var _baseClass = this;
            if (typeof fn !== 'function') return _baseClass.logError('setInterval() fn provided is not a function');
            var _duration = duration || 1;
            var interval = setInterval(fn, duration);
            _baseClass.globals.intervals.push(interval);
            return interval;
        },

        clearInterval: function (id) {
            var _baseClass = this;
            clearInterval(id);
        },

        clearAllIntervals: function () {
            var _baseClass = this;
            if (_baseClass.globals.intervals.length === 0) return false;
            $.each(_baseClass.globals.intervals, function () {
                _baseClass.clearInterval(this);
            });
            _baseClass.globals.intervals = [];
            return true;
        },

        setTimeout: function (fn, duration) {
            var _baseClass = this;
            if (typeof fn !== 'function') return _baseClass.logError('setTimeout() fn provided is not a function');
            var _duration = duration || 1;
            var timeout = setTimeout(fn, duration);
            _baseClass.globals.timeouts.push(timeout);
            return timeout;
        },

        clearTimeout: function (id) {
            var _baseClass = this;
            clearTimeout(id);
        },

        clearAllTimeouts: function () {
            var _baseClass = this;
            if (_baseClass.globals.timeouts.length === 0) return false;
            $.each(_baseClass.globals.timeouts, function () {
                _baseClass.clearTimeout(this);
            });
            _baseClass.globals.timeouts = [];
            return true;
        },

        loadScript: function (src) {
            var _baseClass = this;
            if ($('script').attr('src') === src) return false;
            //Load player api asynchronously.
            var tag = document.createElement('script');
            tag.src = src;
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            return true;
        }
    };
};

mbc.gateway = new mbc.Site({
    siteInitComplete: function(sitePrivate) {		
        var _site = sitePrivate;	
        var site = _site.getSiteObj();		
    }	
});

if(!mbc.gateway) mbc.gateway = new mbc.Site();