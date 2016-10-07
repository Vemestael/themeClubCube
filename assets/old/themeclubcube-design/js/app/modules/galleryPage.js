appMakeBeCool.gateway.addClass('GalleryPage', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _galleryPage = this,
    _defaults = {
        // elements
        galleryContainer: '#galleryContainer',
        galleryText: '#galleryText',
        scrollButton: '#scrollButton',
        borderGallery: '#borderGallery',
        galleryCount: '#galleryCount',
        imagesCounter: '#imagesCounter',
        allImagesBlock: '#allImagesBlock',
        allImgContainers: '.gallery-tile',
        imageLightBox: '#imagelightbox',
        imageLightBoxWrap: '.imageLightboxWrap'
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        galleryContainer: null,
        galleryText: null,
        scrollButton: null,
        borderGallery: null,
        galleryCount: null,
        imagesCounter: null,
        allImagesBlock: null,
        allImgContainers: null,
        currentImageContainer: null,

        // data
        galleryLightBox: null,
        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_galleryPage, [_properties]);
        if(!_globals.preloaded) {
            return _galleryPage.init();
        }
        _galleryPage.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _galleryPage.create();
    },

    _config = function() {
        _globals.galleryContainer = $(_properties.galleryContainer);
        _globals.galleryText = $(_properties.galleryText);
        _globals.scrollButton = $(_properties.scrollButton);
        _globals.borderGallery = $(_properties.borderGallery);
        _globals.galleryCount = $(_properties.galleryCount);
        _globals.imagesCounter = $(_properties.imagesCounter);
        _globals.allImagesBlock = $(_properties.allImagesBlock);
        _globals.allImgContainers = $(_properties.allImgContainers);
    },

    _setup = function() {
        _globals.galleryLightBox = _globals.allImgContainers.imageLightbox({
            allowedTypes: 'png|jpg|jpeg|gif', // string;
            animationSpeed: 250, // integer;
            preloadNext: true, // bool;            silently preload the next image
            enableKeyboard: true, // bool;            enable keyboard shortcuts (arrows Left/Right and Esc)
            quitOnEnd: false, // bool;            quit after viewing the last image
            quitOnImgClick: false, // bool;            quit when the viewed image is clicked
            quitOnDocClick: true, // bool;            quit when anything but the viewed image is clicked
            onStart: function() {
                _showGalleryPicture();
            }, // function/bool;   calls function when the lightbox starts
            onEnd: function() {
                _exitGalleryPicture();
            }, // function/bool;   calls function when the lightbox quits
            onLoadStart: function() {
                _galleryLoader(true);
            }, // function/bool;   calls function when the image load begins
            onLoadEnd: function() {
                _galleryLoader(false);
                _showGalleryPicture();
                _imgCounter();
            } // function/bool;   calls function when the image finishes loading
        })
    },

    _setBinds = function() {
        _binds().setScrollButtonBind();
        _binds().setAllImageBlockBind();
        _binds().setAllImgContainersBind();
    },

    _binds = function() {
        return {
            setScrollButtonBind: function(){
                _globals.scrollButton.unbind('click touchend');
                _globals.scrollButton.bind('click touchend', function() {
                    if (_globals.galleryText.hasClass('active')) {
                        _globals.scrollButton.find('.scroll-down-inner').text('about this event');
                        _globals.galleryContainer.animate({
                            top: 0
                        }, 700);
                        setTimeout(function() {
                            _globals.galleryContainer.removeClass('top');
                            _globals.galleryText.removeClass('active');
                            $('html,body').scrollTop(0);
                        }, 700);
                        _globals.scrollButton.removeClass('active top');
                        _globals.borderGallery.removeClass('active');
                    } else {
                        _globals.borderGallery.addClass('active');
                        _globals.scrollButton.addClass('active top');
                        _globals.scrollButton.find('.scroll-down-inner').text('to gallery');
                        _globals.galleryContainer.addClass('top');
                        _globals.galleryContainer.animate({
                            top: -(_globals.galleryContainer.outerHeight())
                        }, 700);
                        _globals.galleryText.addClass('active');
                        $('html, body').animate({
                            scrollTop: 0
                        }, 700);
                    }
                })
            },
            setAllImageBlockBind: function(){
                _globals.allImagesBlock.on('click', function() {
                    _globals.galleryLightBox.quitImageLightbox();
                });
            },
            setAllImgContainersBind: function(){
                _globals.allImgContainers.on('click', function() {
                    _globals.curentImageContainer = $(this);
                });
            }
        };
    },

    _triggers = function(){
        return {};
    },

    //Counts current image on init of gallery
    _countImages = function() {
        var imagesLength = _globals.allImgContainers.length;
        var currentImageNumber = 1;
        for (var i = 0; i < imagesLength; i++) {
            if (_globals.allImgContainers[i].href === $(_globals.currentImageContainer).attr('href')) {
                currentImageNumber = i + 1;
            }
        }
        _globals.imagesCounter.text(currentImageNumber + '/' + imagesLength);
    },

    _imgCounter = function() {
        var $openedImage = $(_properties.imageLightBox);
        var $target = $(_properties.allImgContainers + '[href="' + $openedImage.attr('src') + '"]');
        var index = $target.index(_properties.allImgContainers);
        _globals.imagesCounter.text((index + 1) + '/' + _globals.allImgContainers.length);
    },

    _clickGalleryNavigation = function(direction) {
        var $openedImage = $(_properties.imageLightBox);
        var $target = $(_properties.allImgContainers + '[href="' + $openedImage.attr('src') + '"]');
        var index = $target.index(_properties.allImgContainers);
        if (direction === 'left') {
            index = index - 1;
            if (!_globals.allImgContainers.eq(index).length) {
                index = _globals.allImgContainers.length;
            }
        } else {
            index = index + 1;
            if (!_globals.allImgContainers.eq(index).length) {
                index = 0;
            }
        }
        _globals.galleryLightBox.switchImageLightbox(index);
        return false;
    },

    _showGalleryPicture = function() {
        if (!$(_properties.imageLightBoxWrap).length) {
            var wrapper = '<div class="imageLightboxWrap"></div>';
            // var loader = '<img class="loader-gif" src="'+ designUrl +'images/ajax-loader.gif" alt="">';
            var loader = '<div class="loader-gall"><div class="fr-bl"></div><div class="sc-bl"></div><div class="thr-bl"></div><div class="fth-bl"></div></div>';
            var prevNavigation = '<div class="lightbox-prev"></div>';
            var nextNavigation = '<div class="lightbox-next"></div>';
            $(wrapper).appendTo('body');
            $(loader).appendTo('body');
            $(prevNavigation).appendTo('body');
            $(nextNavigation).appendTo('body');

            $('.lightbox-prev').unbind('click touchend').bind('click touchend', function() {
                _clickGalleryNavigation('left');
            });
            $('.lightbox-next').unbind('click touchend').bind('click touchend', function() {
                _clickGalleryNavigation('right');
            });
        } else {
            $(_properties.imageLightBoxWrap).fadeIn();
            $('.lightbox-prev').show();
            $('.lightbox-next').show();
            $('.loader-gall').show();
        };
        _globals.scrollButton.hide();
        _globals.galleryCount.hide();
        _globals.allImagesBlock.show();
        _countImages();
    },

    _exitGalleryPicture = function() {
        var $wrapper = $(_properties.imageLightBoxWrap);
        var $prevNavigation = $('.lightbox-prev');
        var $nextNavigation = $('.lightbox-next');
        var $loader = $('.loader-gall');
        $loader.hide();
        $wrapper.fadeOut();
        $prevNavigation.hide();
        $nextNavigation.hide();
        _globals.allImagesBlock.hide();
        _globals.scrollButton.show();
        _globals.galleryCount.show();
    },

    _galleryLoader = function(flag) {
        var $loader = $('.loader-gall');
        if (flag === true) {
            $loader.show();
        } else {
            $loader.hide();
        }
    },

    _setCustomMethods = function() {
        _galleryPage.globals.customResurrect = function() {};
        _galleryPage.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _galleryPage.addMethod('init', function() {
        _galleryPage.bind($window, _galleryPage.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});