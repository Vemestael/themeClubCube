"use strict";
appMakeBeCool.gateway.addClass('BgImages', function (properties, $, $window, $document) {
  //PRIVATE VARIABLES
  var _bgimages = this,
    _defaults = {
      // elements
      bgImages: '.bg-image',
      volunteerClass: '.ablock-item'
      // prop
      // data
      // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      // elements
      bgImages: null,
      volunteerNodes: null,
      // prop
      preloaded: false
    },

    //PRIVATE METHODS
    _init = function () {
      appMakeBeCool.gateway.base.Class.apply(_bgimages, [_properties]);
      if (!_globals.preloaded) {
        return _bgimages.init();
      }
      _bgimages.globals.customCreate = function () {
        _config();
        _setup();
        _setBinds();
        _setCustomMethods();
      }
      _bgimages.create();
    },

    _config = function () {
      _globals.bgImages = $(_properties.bgImages);
      _globals.volunteerNodes = $(_properties.volunteerClass);
    },

    _setup = function () {

      //Set detection
      if (_globals.bgImages.length) {
        _globals.bgImages.each(function () {
          var $node = $(this);
          var imgUrl = $node.data('bgimage');
          $node.css({
            backgroundImage: "url('" + imgUrl + "')"
          });
        });
      }
      
      if (_globals.volunteerNodes.length && $window.width() >= 1280) {
        _globals.volunteerNodes.each(function () {
          var $node = $(this);
          var imgUrl = $node.data('bgimage');
          $node.css({
            backgroundImage: "url('" + imgUrl + "')"
          });
        });
      }
    },

    _setBinds = function () {

    },

    _binds = function () {
      return {

      }
    },

    _triggers = function () {
      return {

      }
    },

    _setCustomMethods = function () {
      _bgimages.globals.customResurrect = function () {}
      _bgimages.globals.customDestroy = function () {}
    }

  //PUBLIC METHODS
  _bgimages.addMethod('init', function () {
    _bgimages.bind($window, _bgimages.globals.classType + '_Init', function (e, data, el) {
      _globals.preloaded = true;
      _init();
    });
  });

  //GO!
  _init();
});