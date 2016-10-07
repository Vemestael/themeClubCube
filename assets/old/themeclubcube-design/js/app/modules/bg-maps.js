"use strict";
appMakeBeCool.gateway.addClass('Bgmaps', function (properties, $, $window, $document) {
  var _bgmaps = this,
    _defaults = {
      mapCanvas: '.map-canvas',
      scriptUrl: 'https://maps.googleapis.com/maps/api/js?v=3.exp&' + 'callback=addMapContacts',
      mapObj: {}

    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      mapCanvas: null,
      preloaded: false
    },

    _init = function () {
      appMakeBeCool.gateway.base.Class.apply(_bgmaps, [_properties]);
      if (!_globals.preloaded) {
        return _bgmaps.init();
      }
      _bgmaps.globals.customCreate = function () {
        _config();
        _setup();
        _setBinds();
        _setCustomMethods();
      }
      _bgmaps.create();
    },

    _config = function () {
      _globals.mapCanvas = $(_properties.mapCanvas);
    },

    _setup = function () {
      _loadScripts();
      window.addMapContacts = function () {
        _globals.mapCanvas.each(function () {
          var $mapCanvas = $(this);
          var lat = $mapCanvas.data('lat');
          var long = $mapCanvas.data('long');
          var contentString = '<p>' + $mapCanvas.data('text') + '</p>';

          var infowindow = new google.maps.InfoWindow({content: contentString});
          var contactsLatlng = new google.maps.LatLng(lat, long);
          var mapOptions = {
            zoom: 17,
            panControl: false,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            overviewMapControl: false,
            center: contactsLatlng,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }

          _properties.mapObj = new google.maps.Map($mapCanvas[0], mapOptions);

          var marker = new google.maps.Marker({
            position: contactsLatlng,
            map: _properties.mapObj
          });

        });
      }
    },

    _setBinds = function () {
    },

    _binds = function () {
      return {}
    },

    _triggers = function () {
      return {}
    },
    _toogleMap = function ($btn, $map, $form) {

    },

    _loadScripts = function () {
      var script = document.createElement('script');
      script.type = "text/javascript";
      script.src = _properties.scriptUrl;
      document.body.appendChild(script);
    },

    _setCustomMethods = function () {
      _bgmaps.globals.customResurrect = function () {
      }
      _bgmaps.globals.customDestroy = function () {
      }
    }

  _bgmaps.addMethod('init', function () {
    _bgmaps.bind($window, _bgmaps.globals.classType + '_Init', function (e, data, el) {
      _globals.preloaded = true;
      _init();
    });
  });

  _init();
});