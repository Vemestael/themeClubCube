appMakeBeCool.gateway.addClass('Images', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _images = this,
    _defaults = {
        // elements
        imgPreloaderWrapClass: 'img-preloader-wrap',
        imgPreloaderClass: 'loading',
        imgPreloadClass: 'img-preload',

        // prop
        imgDataSrc2x: 'data-src2x',
        imgDataSrc: 'data-src',
        simulatedDelay: 2,
        loaderClass: '.loading',

        // data
        loaderTemplate: ''
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_images, [_properties]);
        if(!_globals.preloaded) {
            return _images.init();
        }
        _images.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
            _triggers().generateImages();
        };
        _images.create();
    },

    _config = function() {},

    _setup = function() {},

    _setBinds = function() {
        _binds().setGenerateImagesBind();
    },

    _binds = function() {
        return {
            setGenerateImagesBind: function() {
                _images.bind($window, _images.globals.classType+'_GenerateImages', function(e, data, el) {
                    _generateImgs(data);
                });
            }
        };
    },

    _triggers = function(){
        return {
            generateImages: function(data){
                _images.trigger(_images.globals.classType+'_GenerateImages', data);
            },
            imagesComplete: function(data){
                _images.trigger(_images.globals.classType+'_ImagesComplete', data);
            }
        };
    },

    _setCustomMethods = function() {
        _images.globals.customResurrect = function() {};
        _images.globals.customDestroy = function() {};
    },

    _generateImgs = function (options) {
        var _options = $.extend({context:'body', usePreloader: false }, options);
        var $context = $(_options.context);
        if ($context.length !== 1) return console.log('Error in generateImgs - context provided is invalid.');
        var i = 0;
        var imagesSrc = new Array();
        var images = new Array();
        $context.find('['+_properties.imgDataSrc+']').each(function () {
            var $this = $(this);
            var imgsrc = $this.attr('src');
            //if(imgsrc == '') { // src должен быть заполнен по требованиям валидации
                imgsrc = _makeImageResponsive($this);
            //}
            //If there is an imgsrc and preloading img
            if ($this.hasClass(_properties.imgPreloadClass) && imgsrc) {
                if (_options.usePreloader) _addImgPreloader($this);
                if(imgsrc.indexOf(global.baseUrl) !== 0){
                    imgsrc = global.baseUrl+imgsrc;
                }
                imagesSrc.push(imgsrc);
                images.push($this);
            }
            i++;
        });

        var baseLength = global.siteUrl.length;
        if(imagesSrc.length){
            $.imgpreload(imagesSrc, {
                each: function (i) {
                    var $this = this;
                    setTimeout(function () {
                        var j = $.inArray(global.baseUrl+$this.src.substr(baseLength), imagesSrc);
                        var img = images[j];
                        imagesSrc.splice(j,1);
                        images.splice(j,1);
                        //Remove preloader els
                        if (_options.usePreloader) _removeImgPreloader(img);
                        //Replace src with this data imgsrc
                        $(img).attr('src', $this.src);
                        //Remove the attr so that imgsrc does not evaluate as true for any image that's already been src replaced
                        $(img).attr(_properties.imgDataSrc, '');
                        $(img).attr(_properties.imgDataSrc2x, '');
                    }, _properties.simulatedDelay)
                },
                all: function(){
                    _triggers().imagesComplete();
                }
            });
        } else {
            _triggers().imagesComplete();
        }
    },

    _makeImageResponsive = function(img){
        var viewport = $window.innerWidth || $document.documentElement.clientWidth || $document.body.clientWidth;
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
        var retina = $window.devicePixelRatio ? $window.devicePixelRatio >= 1.2 ? 1 : 0 : 0;
        ////////LOOP ALL IMAGES////////
        //set attr names
        var srcAttr = ( retina && hasAttr(image, _properties.imgDataSrc2x) ) ? _properties.imgDataSrc2x : _properties.imgDataSrc;
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

    _addImgPreloader = function (imgEl) {
        $imgEl = $(imgEl);

        if ($imgEl.length !== 1) return console.log('Error in addImgPreloaders - context provided is invalid.');
        if ($imgEl.hasClass(_properties.imgNoPreloadClass)) return console.log('No add preload');
        var parent = $imgEl.parent('figure');
        if (parent.children(_properties.loaderClass).length === 1) return;
        parent.append(_properties.loaderTemplate);
        $imgEl.hide();
    },

    _removeImgPreloader = function (imgEl) {
        var $img = $(imgEl);
        if ($img.length !== 1) return console.log('Error in removeImgPreloader - imgEl provided is invalid.');
        var parent = $img.parent('figure');

        var $preload = parent.children(_properties.loaderClass);
        if ($preload.length !== 1) return;
        $preload.remove();
        $img.show();
    };

    //PUBLIC METHODS
    _images.addMethod('init', function() {
        _images.bind($window, _images.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});